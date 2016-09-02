<?php

/**
 * import actions.
 *
 * @package    Rentflot
 * @subpackage import
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class importActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  
  public function executeImport(sfWebRequest $request)
  {
    
    if ($this->getContext()->getConfiguration()->getEnvironment() != 'dev')
    {
      $this->forward404();
    }
    
    $category_ids = array(
      20 => 1,
      21 => 2,
      22 => 3,
      23 => 4,
      24 => 5,
      25 => 6,
      28 => 8,
      29 => 10,
      30 => 7,
      //31 => null, 
      32 => 11,
      33 => 9,
      34 => 12,
      35 => 13,
      36 => 14, 
    );
    
    $q = Doctrine_Manager::connection(); //Doctrine_Manager::getInstance()->getCurrentConnection();
    $pdo = $q->execute('SELECT id FROM dev_rentflot1f.cms_data_shop_categories');    
    $pdo->setFetchMode(Doctrine_Core::FETCH_ASSOC);
    $categories = $pdo->fetchAll();    

    $pdo = $q->execute('SELECT * FROM dev_rentflot1f.cms_data_shop_goods');    
    $pdo->setFetchMode(Doctrine_Core::FETCH_ASSOC);
    $items_old = $pdo->fetchAll();    
    
    foreach ($items_old as $item_old)
    {
      //echo $item_old['id'];      
      //vardump($item_properties_old);      
      //echo count($item_properties_old);
      //vardump($item_properties_old);

      if (!empty($category_ids[$item_old['category_id']]))
      {
        $pdo = $q->execute('SELECT * FROM dev_rentflot1f.cms_data_shop_goods_properties WHERE product_id = '.$item_old['id']);    
        $pdo->setFetchMode(Doctrine_Core::FETCH_ASSOC);
        $item_properties_old = $pdo->fetchAll();    
        
        $items_exists = Doctrine_Query::create()
                        ->from('Item i')  
                        ->leftJoin('i.Translation t WITH t.lang = \''.$this->getUser()->getCulture().'\'')
                        ->where('t.name LIKE ?', '%'.$item_old['name'].'%')
                        ->limit(1)
                        ->execute();
                                
        //echo $item_exists;
        
        if ($items_exists->count() > 0)
        {
          $item_exists = $items_exists[0];
          //echo $item_exists->getId();
          //echo '<br />';
          $category_item = new CategoryItem();
          $category_item->setItemId($item_exists->getId());
          $category_item->setCategoryId($category_ids[$item_old['category_id']]);
          
          if (!$item_exists->getShortDescription() || !$item_exists->getShortDescription())
          {
            if (!$item_exists->getDescription())
            {
              $item_exists->setDescription($item_old['descr']);            
            }
            
            if (!$item_exists->getShortDescription())
            {
              $item_exists->setShortDescription($item_old['short_descr']);
            }
            $item_exists->save();
          }
          
          $category_item->save();        
        }
        else
        {
          $item = new Item();
          $item->setIsActive($item_old['in_stock']);
          
          if (strpos($item_old['name'], '"') !== false)
          {
            //$internal_name = substr($item_old['name'], strpos($item_old['name'], '"'))
            //preg_match_all('/\"(.*)\"(*.)/i');
            //preg_match_all('~"(.*?)(?:"|$)|([^"]+)~',$item_old['name'], $matches, PREG_SET_ORDER);
            preg_match_all('`"([^"]*)"`', $item_old['name'], $matches); 
            $internal_name = $matches[1][0];            
            $item->setInternalName($internal_name);                  
          }
          else
          {
            $item->setInternalName($item_old['name']);                  
          }
          
          $item->setName($item_old['name']);                    
          if ($item_old['category_id'] == 28)
          {
            $item->setUnitTypeId(2);
          }
          else
          {
            $item->setUnitTypeId(1);
          }
          $item->setSlug($item_old['link_name']);
          $item->setOrder($item_old['OrderValue']);
          $item->setDescription($item_old['descr']);
          $item->setShortDescription($item_old['short_descr']);
                    
          foreach ($item_properties_old as $item_property_old)
          {
            //echo count($item_properties_old);
            //vardump($item_property_old);
            //vardump($item_property_old['property_name']);          
            switch ($item_property_old['property_name'])
            {
              case 'ship_function':            
                $item->setTargetUse($item_property_old['property_value']);
              break;
              case 'passenger_capacity':            
                $item->setPassengerCapacity($item_property_old['property_value']);
              break;
              
              case 'basic_info':            
                $item->setBasicInfo($item_property_old['property_value']);
              break;
              case 'equipment':            
                $item->setEquipment($item_property_old['property_value']);
              break;
              case 'crew':            
                $item->setCrew($item_property_old['property_value']);
              break;
              case 'price2':            
                $item->setPrice($item_property_old['property_value']);
              break;
              case 'addit_info':            
                $item->setAdditionalInfo($item_property_old['property_value']);
              break;
              case 'in_sight':            
                $item->setInSight($item_property_old['property_value']);
              break;
              
              case 'price_value1':            
                if ($item_property_old['property_value'] != '-')
                {
                  $item->setPriceValue1($item_property_old['property_value']);
                }
              break;
              case 'price_value2':            
                if ($item_property_old['property_value'] != '-')
                {              
                  $item->setPriceValue2($item_property_old['property_value']);
                }
              break;
              case 'price_value3':            
                if ($item_property_old['property_value'] != '-')
                {               
                  $item->setPriceValue3($item_property_old['property_value']);
                }
              break;
              case 'price_text1':            
                if ($item_property_old['property_value'] != '-')
                {               
                  $item->setPriceText1($item_property_old['property_value']);
                }
              break;
              case 'price_text2':            
                if ($item_property_old['property_value'] != '-')
                {                
                  $item->setPriceText2($item_property_old['property_value']);
                }
              break;
              case 'price_text3':            
                if ($item_property_old['property_value'] != '-')
                {                
                  $item->setPriceText3($item_property_old['property_value']);
                }
              break;

              case 'banquet_places':            
                $item->setInfoText1('банкетных мест');
                if (!empty($item_property_old['property_value']) && $item_property_old['property_value'] != '-')
                {
                  $item->setInfoValue1($item_property_old['property_value']);
                }
              break;
              case 'party_places':            
                $item->setInfoText2('фуршетных мест');
                if (!empty($item_property_old['property_value']) && $item_property_old['property_value'] != '-')
                {
                  $item->setInfoValue2($item_property_old['property_value']);
                }
              break;
              case 'sleep_places':            
                $item->setInfoText3('спальных мест');
                if (!empty($item_property_old['property_value']) && $item_property_old['property_value'] != '-')
                {
                  $item->setInfoValue3($item_property_old['property_value']);
                }
              break;
            }          
          }        
          
          $item->save();
          
          $this->getContext()->getConfiguration()->loadHelpers('MagicString');            
          $this->getUser()->setCulture('en');
          $item->setName(translit($item_old['name']));                  
          $item->save();
          $this->getUser()->setCulture('ru');
                  
          $category_item = new CategoryItem();
          $category_item->setItemId($item->getId());
          $category_item->setCategoryId($category_ids[$item_old['category_id']]);
          $category_item->save();          
          
          /*
            Photos
          */
                    

          $model_name = 'Item';
          $this->image_dir = sfConfig::get('sf_upload_dir').'/'.sfConfig::get('app_'.$model_name.'_images_dir', 'property').'/';
          
          $photos = explode(';', $item_old['photos']);
          
          $i = 0;
          if (count($photos) > 0)
          {
            foreach ($photos as $photo)
            {
              if ($photo)
              {
                
                ++$i;
                
                $item_image = new ItemImage();
                $item_image->setObjectId($item->getId());
                
                //-------------------
                $filename_old = sfConfig::get('sf_web_dir').'/images_old/'.$item->getCategories()->getFirst()->getSlug().'/goods/'.$item->getSlug().'/'.$photo;
                $filename_icon_old = sfConfig::get('sf_web_dir').'/images_old/'.$item->getCategories()->getFirst()->getSlug().'/goods/'.$item->getSlug().'-icon.jpg';
                
                
                // Установка уникального имени файла
                $filename = $item->getSlug().'_'.create_guid();
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
                $new_filename = $filename.($suffix?'__'.$suffix:'').$ext;
                        
                // Создание класса с изображением. Стандартный формат - JPG
                $im = new Imagick($filename_old);
                $im->setImageFormat('jpg');
                
                // Сохранение оригинала изображения
                if (sfConfig::get('app_'.$model_name.'_images_keep_original', true))
                {
                  $im->writeImage($this->image_dir.'orig_'.$new_filename);
                }
                $im->clear();
                $im->destroy();

                // Формирование разных размеров
                //vardump(sfConfig::get('app_'.$model_name.'_images_sizes'));
                
                foreach (sfConfig::get('app_'.$model_name.'_images_sizes') as $size_number => $size)
                {
                  
                  $width = $size['width'];
                  $height = $size['height'];
                  
                  if (!empty($size['crop']))
                  {
                    
                    //  $item_old['category_id'] == 28 Attractions
                    if (($size_number == 4 && $item_old['category_id'] != 28) || ($size_number == 5 && $item_old['category_id'] == 28))
                    {
                      copy($filename_icon_old, $this->image_dir.$width.'x'.$height.'_'.$new_filename);                    
                    }
                    else
                    {                      
                      $ti = new Imagick($filename_old);
                      $ti->setImageFormat('jpg');
                      
                      //$ti = clone $im;
                      //vardump($size);
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
                      //if (!empty($size['watermark']))
                      //{
                        //$watermark_file = sfConfig::get('sf_web_dir').'/'.'images/watermark/'.$width.'x'.$height.'.png';
                        //if (is_file($watermark_file))
                        //{
                          //$w = new Imagick($watermark_file);
                          //$ti = draw_watermark($ti, $w);
                        //}
                      //}
                      
                      $ti->writeImage($this->image_dir.$width.'x'.$height.'_'.$new_filename);
                      $ti->clear();
                      $ti->destroy();
                    }
                  }
                  else
                  {
                    copy($filename_old, $this->image_dir.$width.'x'.$height.'_'.$new_filename);
                  }
                }
                
                //-------------------                   
                
                $item_image->setFilename($new_filename);
                $item_image->save();
                
                if ($i == 1)
                {
                  $item->setMainImageId($item_image->getId());
                  $item->save();
                }
                
              }
            }
          }         
          
          
          
          /*
          
          
          */
          
          

        }
      }
      
    }    
    //$this->forward('default', 'module');
    //echo 1;
  }
  
}
