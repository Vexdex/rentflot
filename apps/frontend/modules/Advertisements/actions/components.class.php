<?php

/**
 * content components.
 *
 * @package    Rentflot
 * @subpackage content
 * @author     Infosoft
 * @version    SVN: $Id: components.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AdvertisementsComponents extends sfComponents
{
  public function executeShowAd(sfWebRequest $request)
  {
    $routing = sfContext::getInstance()->getRouting()->getCurrentRouteName();
	//motor_ships
	//catalog_category
	
	$this->message="";
	$category_slug = "";
	$adv="";
	if($routing=="motor_ships")
	{
		$category_slug = "motor_ships";
	}
	else if($routing=="catalog_category")
	{
		$category_slug = $request->getParameter('category_slug');
	}
	else if($routing=="catalog_item")
  {
    $item = Doctrine_Query::create()
      ->from('Item i')
      ->where('i.slug = ?', $request->getParameter('item_slug'))
      ->fetchOne();
          if($item==null)
                return;
    $order_item_categories = $item->getCategories();
    $adv=$order_item_categories[0]->getAdvertisements();

    /*foreach ($order_item_categories as $order_item_category)
    {
      $adv=$order_item_category[0]->getAdvertisements();
      break;
    }*/
  }
  //else if($routing=="banquet")
  //{
  //  $category_slug = "banquet";
  //}
	else
	{
		$adv = Doctrine_Query::create()->select('*')
		->from('Advertisement c')
		->leftJoin('c.Translation ct WITH ct.lang = \''.$this->getUser()->getCulture().'\'')                    
		->leftJoin('c.Categories cat')
		->groupBy('c.id')
		->having('COUNT(cat.id) = 0')
		->fetchOne();
		
		$this->message=$adv["description"];
		$this->slug=$adv["slug"];
		return;
	}
	if($adv=="")
	{
		$this->category = Doctrine_Query::create()
					->from('Category c')
					->leftJoin('c.Translation ct WITH ct.lang = \''.$this->getUser()->getCulture().'\'')                    
					->where('c.slug = ?', $category_slug)
					->andWhere('c.is_hidden = ?', false)
					->fetchOne();
		if($this->category==null)
        	    return;
		$adv=$this->category->getAdvertisements();
	}
	$this->message=$adv[0]->getDescription();
	$this->slug=$adv[0]->getSlug();
	//if (sfContext::getInstance()->getRouting()->getCurrentRouteName() == 'content')
	//{
		//"content";
	//}
  }
}
