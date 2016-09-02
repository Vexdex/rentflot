<?php

/**
 * catalog actions.
 *
 * @package    Rentflot
 * @subpackage catalog
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class catalogActions extends sfActions
{
  public function setMeta($category = null, $item = null)
  {
    if (!$category)
    {
      return false;
    }
    
    if (!$item)
    {
      $description = $category->getDescription();
      $keywords = $category->getKeywords();
      $title = $category->getTitle();
      $h1 = $category->getH1();
    }
    else
    {
      $description = str_replace('%%name%%', $item->getName(), $category->getItemDescription());      
      $keywords = str_replace('%%name%%', $item->getName(), $category->getItemKeywords());      
      $title = $item->getName().' » '.$category->getName();
      $h1 = str_replace('%%name%%', $item->getName(), $category->getItemH1());

      if($item->getTitle()!="")
        $title=$item->getTitle();
      if($item->getH1()!="")
        $h1=$item->getH1();
      if($item->getHtmlDescription()!="")
        $description=$item->getHtmlDescription();
      if($item->getHtmlKeywords()!="")
        $keywords=$item->getHtmlKeywords();
    }
    
    $response = $this->getResponse();
    $response->addMeta('description', $description);
    $response->addMeta('keywords', $keywords);
    $response->setTitle($title);  
    $this->getContext()->set('h1', $h1);
  }
  public function executeFixFileNames(sfWebRequest $request)
  {
    if($request->getParameter("pass")=="22xxxTacFF")
    {
      ini_set('memory_limit', '2048M');
      set_time_limit(2200);
      $pdo = Doctrine_Manager::getInstance()->getCurrentConnection()->getDbh();
      $q="SELECT *, ii.id as image_id FROM item i, item_image ii WHERE i.id=ii.object_id";
      $stmt = $pdo->prepare($q);
      $stmt->execute();
      $this->image_dir = sfConfig::get('sf_upload_dir').'/'.sfConfig::get('app_Item_images_dir', 'property').'/';
      $ext = '.jpg';
      while($obj=$stmt->fetch())
      {
        foreach (sfConfig::get('app_Item_images_sizes') as $size)
        {
          $width = $size['width'];
          $height = $size['height'];
          $file_path=$this->image_dir.$width.'x'.$height.'_'.$obj["filename"];
          echo $file_path;
          if(file_exists($file_path))
          {
            $i = 1;
            $new_filename = $obj["slug"]."_".$i.$ext;
            $addfile_delta=1;
            while(file_exists($this->image_dir.$width.'x'.$height.'_'.$new_filename))
            {
              $new_filename = $obj["slug"]."_".($i+$addfile_delta++).$ext;
            }
            $new_file_path=$this->image_dir.$width.'x'.$height.'_'.$new_filename;
            echo " => ".$new_file_path;

            $q="UPDATE item_image SET filename='".$new_filename."' WHERE id=".$obj["image_id"];
            $rs = Doctrine_Manager::getInstance()->getCurrentConnection()->execute($q);
            rename($file_path,$new_file_path);
          }
          else
          {
            echo "{not found}";
          }
          echo "<br/>";
        }
      }
    }
    die;
  }
  public function executeUpdateImagesSize(sfWebRequest $request)
  {
    if($request->getParameter("pass")=="22xxxTacFF")
    {
      ini_set('memory_limit', '2048M');
      set_time_limit(2200);
      $pdo = Doctrine_Manager::getInstance()->getCurrentConnection()->getDbh();
      $q="SELECT *, ii.id as image_id FROM item i, item_image ii WHERE i.id=ii.object_id";
      $stmt = $pdo->prepare($q);
      $stmt->execute();
      $this->image_dir = sfConfig::get('sf_upload_dir').'/'.sfConfig::get('app_Item_images_dir', 'property').'/';
      while($obj=$stmt->fetch())
      {
        $file_path=$this->image_dir.'550x1000_'.$obj["filename"];
        echo $file_path;
        if(file_exists($file_path))
        {
          $im = new Imagick($file_path);

          $actual_geo=$im->getImageGeometry();
          echo " ====> ".$actual_geo["width"]." ".$actual_geo["height"];

          $q="UPDATE item_image SET width=".$actual_geo["width"].",height=".$actual_geo["height"]."  WHERE id=".$obj["image_id"];
          $rs = Doctrine_Manager::getInstance()->getCurrentConnection()->execute($q);
        }
        echo "<br/>";
      }
      die;
    }
  }
  public function executeShowOwnItems(sfWebRequest $request)
  {
    $i18n = $this->getContext()->getI18N();
    $response = $this->getResponse();

    $itemsQuery = Doctrine_Query::create()
        ->from('Item i')
        ->innerJoin('i.CategoryItem ci')
        ->innerJoin('ci.Category c')
        ->leftJoin('i.Translation it WITH it.lang = \''.$this->getUser()->getCulture().'\'')
        ->leftJoin('i.MainImage mi')
        ->where('i.is_active = ?', true)
        ->andWhere('c.is_hidden = ?', false)
        ->orderBy('c.order, i.order');

    if ($this->getUser()->getGuardUser()->relatedExists('Owner'))
    {
      $itemsQuery->andWhere('i.owner_id = ?', $this->getUser()->getGuardUser()->getOwner()->getId());
    }
    else
    {
      $itemsQuery->andWhere('FALSE');
    }

    $this->items = $itemsQuery->execute();

    // breadcrumbs
    $breadcrumbs[] = array(
      'text' => $this->getContext()->getI18n()->__('catalog_own_items', null, 'menu'),
      'url' => $this->getContext()->getRouting()->generate('catalog_own_items', array(), true)
    );

    $this->getContext()->set('breadcrumbs', array_reverse($breadcrumbs));

    // meta
    $response->addMeta('description', $i18n->__('own_ships_description', array(), 'meta'));
    $response->addMeta('keywords', $i18n->__('own_ships_keywords', array(), 'meta'));
    $response->setTitle($i18n->__('own_ships_title', array(), 'meta'));
    $this->getContext()->set('h1', $i18n->__('own_ships_h1', array(), 'meta'));
  }

  
  public function executeShowItem(sfWebRequest $request)
  {
    $category_slug = $request->getParameter('category_slug');
    $item_slug = $request->getParameter('item_slug');
    
    //$this->category = Doctrine::getTable('Category')->findOneBySlug($category_slug);   
        
    $this->category = Doctrine_Query::create()
                    ->from('Category c')
                    ->leftJoin('c.Translation ct WITH ct.lang = \''.$this->getUser()->getCulture().'\'')                    
                    ->where('c.slug = ?', $category_slug)
                    ->andWhere('c.is_hidden = ?', false)
                    ->fetchOne();
    
    $this->forward404Unless($this->category);

    //$this->item = Doctrine::getTable('Item')->findOneBySlug($item_slug);   
    $this->item = Doctrine_Query::create()
                  ->from('Item i')
                  ->leftJoin('i.Images ii')
                  ->leftJoin('i.Translation it WITH it.lang = \''.$this->getUser()->getCulture().'\'')                    
                  ->where('i.slug = ?', $item_slug)
                  ->fetchOne();
    
    
    $this->forward404Unless($this->item);
        
    //$this->items = $this->category->getItems();   
    $this->items = Doctrine_Query::create()
                    ->from('Item i')
                    ->leftJoin('i.CategoryItem ci')
                    ->leftJoin('i.Translation it WITH it.lang = \''.$this->getUser()->getCulture().'\'')                    
                    ->where('ci.category_id = ?', $this->category->getId())
                    ->andWhere('i.is_active = ?', true)
                    ->execute();       
           
    $this->item_template = $this->category->getProductTemplate();
    
    $this->setBreadcrumbs($this->category, $this->item);
    
    $this->setMeta($this->category, $this->item);

    if (!$this->item->getIsActive())
    {
      $this->forward404();

      // Hack
      if (in_array($this->item->getId(), array(43, 13, 7, 440, 25, 24, 22, 32, 86)))
      {
        $this->forward404();

        $response = $this->getResponse();
        $response->setTitle('');
        $response->addMeta('description', $this->category->getDescription());
        $response->addMeta('keywords', $this->category->getKeywords());
        $this->getContext()->set('h1', $this->category->getH1());
        $this->getContext()->set('breadcrumbs', null);
      }

      $this->setTemplate('deactivated');
    }
        else
            {
                  if($this->item->getMainImageId())
                        {
                                $this->getResponse()->setSlot("og_image",sfConfig::get('app_Item_images_path').'550x1000_'.$this->item->getMainImage()->getFilename());
                                      }
                                          }
  }
  

  public function executeShowCategory(sfWebRequest $request)
  {
    $category_slug = $request->getParameter('category_slug');
    
    //$this->category = Doctrine::getTable('Category')->findOneBySlug($category_slug);
    //$this->items = $this->category->getItems();
    
    $this->category = Doctrine_Query::create()
                    ->from('Category c')
                    ->leftJoin('c.Translation ct WITH ct.lang = \''.$this->getUser()->getCulture().'\'')                    
                    ->where('c.slug = ?', $category_slug)
                    ->andWhere('c.is_hidden = ?', false)
                    ->fetchOne();
        
        
    $this->forward404Unless($this->category);
    
    $this->items = Doctrine_Query::create()
                    ->from('Item i')
                    ->leftJoin('i.CategoryItem ci')
                    ->leftJoin('i.Translation it WITH it.lang = \''.$this->getUser()->getCulture().'\'')
                    ->leftJoin('i.MainImage mi')
                    ->where('ci.category_id = ?', $this->category->getId())
                    ->andWhere('i.is_active = ?', true)
                    ->orderBy('i.order asc')
                    ->execute();       
    
    $this->forward404Unless(partial_exists($this->category->getCategoryTemplate()));
    
    $this->category_template = $this->category->getCategoryTemplate();
        
    $this->setBreadcrumbs($this->category);
    
    $this->setMeta($this->category);    
  }
  
  
  private function setBreadcrumbs($category, $item = null)
  {
    $breadcrumbs = array();
    
    // Параход
    if ($item)
    {
      $breadcrumbs[] = array(
        'text' => $item->getName(), 
        'url' => $this->getContext()->getRouting()->generate('catalog_item', array('category_slug' => $category->getSlug(), 'item_slug' => $item->getSlug()), true)
      );    
    }
    
    // Текущая категория
    $breadcrumbs[] = array(
      'text' => $category->getName(), 
      'url' => $this->getContext()->getRouting()->generate('catalog_category', array('category_slug' => $category->getSlug()), true)
    );
    
    // "Папские" категории
    $tmp_category = $category;    
    while($tmp_category->getParentId())
    {
      //$tmp_category = $tmp_category->getParentCategory();
      $tmp_category = Doctrine_Query::create()
                        ->from('Category c')
                        ->leftJoin('c.Translation ct WITH ct.lang = \''.$this->getUser()->getCulture().'\'')                    
                        ->where('c.id = ?', $tmp_category->getParentId())
                        ->fetchOne();
      
      $breadcrumbs[] =  array(
        'text' => $tmp_category->getName(), 
        'url' => $this->getContext()->getRouting()->generate('catalog_category', array('category_slug' => $tmp_category->getSlug()), true)
      );      
    }

    $this->getContext()->set('breadcrumbs', array_reverse($breadcrumbs));
  }
  
  
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }
}
