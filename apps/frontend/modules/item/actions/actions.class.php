<?php

require_once dirname(__FILE__).'/../lib/itemGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/itemGeneratorHelper.class.php';

/**
 * item actions.
 *
 * @package    Rentflot
 * @subpackage item
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class itemActions extends autoItemActions
{

  public function executeShow(sfWebRequest $request)
  {
    //$this->item_by_category_form = new ItemByCategoryForm();      
    //parent::executeEdit($request);    
    $item = $this->getRoute()->getObject();
    $category = $item->getCategories()->getFirst();
    
    if (!$category)
    {
      $this->getUser()->setFlash('custom_error', 'flash_item_without_category');
      $this->redirect(array('sf_route' => 'item_edit', 'sf_subject' => $item));
    }
    else
    {    
      $this->redirect($this->generateUrl('catalog_item', array('category_slug' => $category->getSlug(), 'item_slug' => $item->getSlug())));
    }

  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'create_successfull' : 'update_successfull';

      try
      {
        //$form->getObject()->refreshRelated('ItemOrders');
        $item = $form->save();
      } catch (Doctrine_Validator_Exception $e)
      {
        $this->processImages($request, $item);

        $errorStack = $form->getObject()->getErrorStack();
        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ? 's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors)
        {
          $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->processImages($request, $item);
      
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $item)));
      
      // -- Log 
      $this->log(array('ids' => $item->getId()));     
      
      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.'_and_add');

        $this->redirect('@item_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'item_edit', 'sf_subject' => $item));
      }
    }
    else
    {
      $this->processImages($request, $form->getObject());
      $this->getUser()->setFlash('error', 'save_error', false);
    }
  }




  /**
    * Обработка фотографий имущества
    *
    *
    */
	protected function processImages(sfWebRequest $request, $object)
  {
    // Обработка изображений
    $model_name = get_class($object);    
    $this->image_dir = sfConfig::get('sf_upload_dir').'/'.sfConfig::get('app_'.$model_name.'_images_dir', 'property').'/';    
    
    if ($request->getMethod() == sfRequest::PUT || $request->getMethod() == sfRequest::POST )
    { 
      $image_model_name = sfConfig::get('app_'.$model_name.'_images_image_model_name');    
      $image_temp_model_name = sfConfig::get('app_'.$model_name.'_images_image_temp_model_name');
      if ($this->form->isNew())
      {
        $current_image_model_name = sfConfig::get('app_'.$model_name.'_images_image_temp_model_name');            
        $object_id = $request->getParameter('idh');
      }
      else
      {        
        $current_image_model_name = sfConfig::get('app_'.$model_name.'_images_image_model_name');    
        $object_id = $object->getId();
      }    
  
      // Обработка удаления
      $object_image_to_del = $this->getRequestParameter('object_images_remove');
      if (!empty($object_image_to_del)) 
      {
        $delete_query = Doctrine_Query::create()
                          ->delete($current_image_model_name.' p')
                          ->whereIn('p.id', array_keys($object_image_to_del))
                          ->execute();
        // Принудительный коммит
        //Doctrine_Manager::getInstance()->getCurrentConnection()->getDbh()->commit();
      }

      // Обновление порядка		
      $images_order = $this->getRequestParameter('object_images_order');
      $images_order_count = count($images_order);    
      if (!empty($images_order))
      {
        $key = array_keys($images_order);
        $size = sizeOf($key);
        for ($i=0; $i<$size; $i++) 
        {
          if (isset($object_image_to_del[$images_order[$key[$i]]]))
          {
            continue;
          }
          $update_query = Doctrine_Query::create()
                            ->update($current_image_model_name.' p')
                            ->set('p.order', '?', $i+1)
                            ->set('p.title', '?',$_REQUEST["image_title_".$images_order[$key[$i]]])
                            ->set('p.alt', '?',$_REQUEST["image_alt_".$images_order[$key[$i]]])
                            ->set('p.title_en', '?',$_REQUEST["image_title_en_".$images_order[$key[$i]]])
                            ->set('p.alt_en', '?',$_REQUEST["image_alt_en_".$images_order[$key[$i]]])
                            ->where('p.id = ?', $images_order[$key[$i]])
                            ->limit(1)
                            ->execute();
        }
      }
      
      // Обработка только что загруженных изображений			
      $files = $this->getRequest()->getFiles();
      
      // Если нету папки - создаем её
      if (!file_exists($this->image_dir) && !is_file($this->image_dir))
      {
        mkdir($this->image_dir);
      }			
      
      if (!empty($files))
      {             
        //vardump($files);
        // Checking Imagick php extension
        if (!class_exists('Imagick'))
        {
          $this->logMessage('Class "Imagick" for image processing not found', 'err');
          throw new sfInitializationException('Class "Imagick" for image processing not found');
        }
        
        // Loading string helper for transliteration
        sfProjectConfiguration::getActive()->loadHelpers('MagicString');
        sfProjectConfiguration::getActive()->loadHelpers('MagicTools');
      
        $i = 1;
        
        //vardump($_REQUEST);
        //die();
        //    [image_alt_1] => Ð°Ð»ÑŒÑ‚1
        //    [image_title_1] => Ñ‚Ð¸Ñ‚Ð»Ðµ


        foreach ($files['object_images'] as $file)
        {      
          if ($file['error'])
          {
            if ($file['name'])
            {
              $this->logMessage('Error uploading file "'.$file['name'].'"', 'err');
            }
            continue;
          }

          if (!in_array($file['type'], sfConfig::get('app_'.$model_name.'_images_allowed_mime_types', array('image/jpeg','image/gif','image/bmp','image/png'))))
          {
            $this->logMessage('File "'.$file['name'].'" is not in allowed types', 'notice');
            continue;
          }
          
          //vardump($file);
          
          if ($file['size']/1024 > sfConfig::get('app_'.$model_name.'_images_max_file_size', 8000))
          {
            $this->logMessage('File "'.$file['name'].'" is too big', 'notice');
            continue;
          }
          
          // Установка уникального имени файла
          $filename = create_guid();
          $suffix = '';
          $ext = '.jpg';
          while (is_file($this->image_dir.$filename.($suffix?'__'.$suffix:'').$ext))
          {
            if ($suffix)
            {
              $suffix++;
            }
            else {
              $suffix = 2;
            }
          }
          //$new_filename = $filename.($suffix?'__'.$suffix:'').$ext;
          //$new_filename = translit($object->getName())."_".$i.$ext;
          $new_filename = $object->getSlug()."_".$i.$ext;

          $addfile_delta=1;
          while(file_exists($this->image_dir."550x1000_".$new_filename))
          {
            $new_filename = $object->getSlug()."_".($i+$addfile_delta++).$ext;
              //
          }

                  
          // Создание класса с изображением. Стандартный формат - JPG
          $im = new Imagick($file['tmp_name']);
          $im->setImageFormat('jpg');
          
                    
          if ($im->getImageWidth() < sfConfig::get('app_'.$model_name.'_images_min_original_dim', 130) || $im->getImageHeight() < sfConfig::get('app_'.$model_name.'_images_min_original_dim', 130))
          {
            $this->logMessage('File "'.$file['name'].'" is too small', 'notice');
            continue;
          }
          
          // Сохранение оригинала изображения
          if (sfConfig::get('app_'.$model_name.'_images_keep_original', true))
          {
            $im->writeImage($this->image_dir.'orig_'.$new_filename);
          }
          $im->clear();
          $im->destroy();

          // Формирование разных размеров
          //vardump(sfConfig::get('app_'.$model_name.'_images_sizes'));
          $actual_geo="";
          foreach (sfConfig::get('app_'.$model_name.'_images_sizes') as $size)
          {
            $ti = new Imagick($file['tmp_name']);
            $ti->setImageFormat('jpg');
            
            //$ti = clone $im;
            //vardump($size);
            $width = $size['width'];
            $height = $size['height'];
            if ($size['crop'])
            {
              $geo = $ti->getImageGeometry();
              if(($geo['width']/$width) < ($geo['height']/$height))
              {
                $ti->cropImage($geo['width'], floor($height*$geo['width']/$width), 0, ($geo['height']-($height*$geo['width']/$width))/2);
              }
              else
              {
                $ti->cropImage(ceil($width*$geo['height']/$height), $geo['height'], ($geo['width']-($width*$geo['height']/$height))/2, 0);
              }
              $ti->thumbnailImage($width, $height);
            }
            else
            {
              $ti->thumbnailImage($width, $height, true);
            }
                        
            // Наложение watermark если есть соответствующий файл
            if (!empty($size['watermark']))
            {
              $watermark_file = sfConfig::get('sf_web_dir').'/'.'images/watermark/'.$width.'x'.$height.'.png';
              if (is_file($watermark_file))
              {
                $w = new Imagick($watermark_file);
                $ti = draw_watermark($ti, $w);
              }
            }
            
            $ti->writeImage($this->image_dir.$width.'x'.$height.'_'.$new_filename);
            if($width==550 && $height==1000)
            {
              $actual_geo=$ti->getImageGeometry();
            }

            $ti->clear();
            $ti->destroy();
          }
          
          $images_count = Doctrine_Query::create()
                            ->from($current_image_model_name.' p')
                            ->where('p.object_id = ?', $object_id)
                            ->count();
          
          // Добавление изображений в БД
          if  ($images_count < sfConfig::get('app_'.$model_name.'_images_max_count', 50))
          {
            $image = new $current_image_model_name();
            $image->object_id = $object_id;
            $image->filename = $new_filename;
            $image->setTitle($_REQUEST["image_title_".$i]);
            $image->setAlt($_REQUEST["image_alt_".$i]);
            $image->setTitleEn($_REQUEST["image_title_en_".$i]);
            $image->setAltEn($_REQUEST["image_alt_en_".$i]);
            $image->setWidth($actual_geo["width"]);
            $image->setHeight($actual_geo["height"]);

            $image->order = $images_order_count + $i; // by crazzy: order загружаемой фотки больше как минимум на 1 (если перед этим не удалялись фотки) от ордера последеней фотки в базе
            $image->save();            
          }
          else
          {
            $this->getUser()->setFlash('error', 'photos_max_count_reached'); //Количество загруженных фотографий превышает допустимое количество
            break;
          }

          $i++;	
        }  // end foreach
      }
      
      // Обработка изображений, если объект успешно загружен
      if ($this->form->isNew() && $object->getId())
      {        
        $images = Doctrine_Query::create()
                    ->from($image_temp_model_name.' p')
                    ->where('p.object_id = ?', $object_id)
                    ->orderBy('p.order')
                    ->execute();

        foreach ($images as $tmp_image)
        {
          $image = new $image_model_name();
          $image->object_id = $object->getId();
          $image->filename = $tmp_image->getFilename();
          $image->order = $tmp_image->getOrder();
          $image->setTitle($tmp_image->getTitle());
          $image->setAlt($tmp_image->getAlt());
          $image->setTitleEn($tmp_image->getTitleEn());
          $image->setAltEn($tmp_image->getAltEn());
          $image->setWidth($image->getWidth());
          $image->setHeight($image->getHeight());
          $image->save();          
        }

        $this->setNicePhotoName($object->getId());
      }
      
      if ($object->getId())
      {
        // Установка главного изображения
        $main_image_data = Doctrine_Query::create()
                                  ->from($image_model_name.' p')
                                  ->where('p.object_id = ?', $object->getId())
                                  ->orderBy('p.order')
                                  ->fetchOne();

        if ($main_image_data && $main_image_data->getId())
        {
          $object->setMainImageId($main_image_data->getId());
          $object->save();
        }
        else
        {
          // Это очень важная строка, которая решает (upd: решала) баг с коммитом у Oracle
          $object->setMainImageId(null);
          $object->save();
        }
      }
    }
  }
  private function setNicePhotoName($item_id)
  {
    $pdo = Doctrine_Manager::getInstance()->getCurrentConnection()->getDbh();
    $q="SELECT *, ii.id as image_id FROM item i, item_image ii WHERE i.id=ii.object_id AND i.id=".$item_id;
    $stmt = $pdo->prepare($q);
    $stmt->execute();
    $this->image_dir = sfConfig::get('sf_upload_dir').'/'.sfConfig::get('app_Item_images_dir', 'property').'/';
    while($obj=$stmt->fetch())
    {
      $file_path=$this->image_dir.'550x1000_'.$obj["filename"];
      if(file_exists($file_path))
      {
        $im = new Imagick($file_path);
        $actual_geo=$im->getImageGeometry();
        $q="UPDATE item_image SET width=".$actual_geo["width"].",height=".$actual_geo["height"]."  WHERE id=".$obj["image_id"];
        $rs = Doctrine_Manager::getInstance()->getCurrentConnection()->execute($q);
      }
    }
  }
 
}
