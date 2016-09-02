<?php

/**
 * content actions.
 *
 * @package    rentflot
 * @subpackage content
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contentActions extends sfActions
{
  public function setMeta()
  {  
    $current_route = $this->getContext()->getRouting()->getCurrentRouteName();    
    $response = $this->getResponse();
    $response->addMeta('description', $this->getContext()->getI18n()->__($current_route.'_description', null, 'meta'));
    $response->addMeta('keywords', $this->getContext()->getI18n()->__($current_route.'_keywords', null, 'meta'));
    $response->setTitle($this->getContext()->getI18n()->__($current_route.'_title', null, 'meta'));  
    $this->getContext()->setH1($this->getContext()->getI18n()->__($current_route.'_h1', null, 'meta'));
  }
  public function executeStatic(sfWebRequest $request)
  {
    //phpinfo();
    $this->page = $request->getParameter('page');
	
	//random ships for index page
	$this->ship1="";
	if($this->page=="index")
	{
	    /*$this->category = Doctrine_Query::create()
                    ->from('Category c')
                    ->leftJoin('c.Translation ct WITH ct.lang = \''.$this->getUser()->getCulture().'\'')                    
                    ->whereIn('c.slug', array("motor_ships_25","motor_ships_50"))
                    ->andWhere('c.is_hidden = ?', false)
                    ->fetchOne();*/
	    $this->items = Doctrine_Query::create()
                    ->from('Item i')
                    ->leftJoin('i.CategoryItem ci')
                    ->leftJoin('i.Translation it WITH it.lang = \''.$this->getUser()->getCulture().'\'')
                    ->leftJoin('i.MainImage mi')
                    ->whereIn('ci.category_id', array(3,4,25))
                    ->andWhere('i.is_active = ?', true)
					->andWhere('i.main_image_id IS NOT NULL')
                    ->orderBy('RAND()')
					->limit(2)
                    ->execute();
					
	    $this->items1 = Doctrine_Query::create()
                    ->from('Item i')
                    ->leftJoin('i.CategoryItem ci')
                    ->leftJoin('i.Translation it WITH it.lang = \''.$this->getUser()->getCulture().'\'')
                    ->leftJoin('i.MainImage mi')
                    ->whereIn('ci.category_id', array(9,10))
                    ->andWhere('i.is_active = ?', true)
					->andWhere('i.main_image_id IS NOT NULL')
                    ->orderBy('RAND()')
					->limit(2)
                    ->execute();
	}

    $this->partial = 'page_'.$this->page.'.'.$this->getUser()->getCulture();
    $this->forward404Unless(partial_exists($this->partial));
    
    $current_route = $this->getContext()->getRouting()->getCurrentRouteName();        
    $breadcrumbs = array();
    if ($current_route == 'map_velikiy' || $current_route == 'map_olgin')
    {
      $breadcrumbs[] = array(
        'text' => $this->getContext()->getI18n()->__('map', null, 'menu'), 
        'url' => $this->getContext()->getRouting()->generate('map', array(), true)
      );      
      
    }
    $breadcrumbs[] = array(
      'text' => $this->getContext()->getI18n()->__($current_route, null, 'menu'), 
      'url' => $this->getContext()->getRouting()->generate($current_route, array(), true)
    );          
    $this->getContext()->set('breadcrumbs', $breadcrumbs);
        
    $this->setMeta();
  }
  
  public function executeError404(sfWebRequest $request)
  {
    //$this->redirect('@real404',301);
    //$this->setLayout('sf_app_dir\templates/layout.php');
    //$this->setTemplate('error404');
    //$this->setTemplate('real404');
    //$this->partial = "real404Success";
    //$this->page="index";
    $this->getResponse()->setStatusCode(404);
    //echo partial_exists($this->partial);die;
  }
  public function executeReal404(sfWebRequest $request)
  {
    //$this->redirect('@motor_ships',301);

    //$this->setTemplate('error404');
    //$this->setTemplate('real404Success');
    $this->getResponse()->setStatusCode(404);
  }  
 
}
