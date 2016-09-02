<?php

require_once dirname(__FILE__).'/../lib/articleGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/articleGeneratorHelper.class.php';

/**
 * article actions.
 *
 * @package    Rentflot
 * @subpackage article
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class articleActions extends autoArticleActions
{

  public function setMeta($is_static = false, $title = null, $h1 = null, $description = null, $keywords = null)
  {  
    $current_route = $this->getContext()->getRouting()->getCurrentRouteName();    
    $response = $this->getResponse();
    
    $meta_description = $description ? $description : $this->getContext()->getI18n()->__(($is_static ? $current_route : 'default').'_description', null, 'meta');    
    $meta_keywords = $keywords ? $keywords : $this->getContext()->getI18n()->__(($is_static ? $current_route : 'default').'_keywords', null, 'meta');    
    $meta_title = $title ? $title : $this->getContext()->getI18n()->__(($is_static ? $current_route : 'default').'_title', null, 'meta');    
    $meta_h1 = $h1 ? $h1 : $this->getContext()->getI18n()->__(($is_static ? $current_route : 'default').'_h1', null, 'meta');
    
    $response->addMeta('description', $meta_description);
    $response->addMeta('keywords', $meta_keywords);
    $response->setTitle($meta_title);  
    $this->getContext()->setH1($meta_h1);    
  }   
  
  
  public function executeShowFrontend(sfWebRequest $request)
  {
    $slug = $request->getParameter('slug');
    
    $this->article = Doctrine::getTable('Article')->findOneBySlug($slug);
    
    $this->forward404Unless($this->article);
       
    $breadcrumbs = array();
    $breadcrumbs[] = array(
      'text' => $this->getContext()->getI18n()->__('article_frontend_list', null, 'menu'), 
      'url' => $this->getContext()->getRouting()->generate('article_frontend_list', array(), true)
    );          
    
    $breadcrumbs[] = array(
      'text' => $this->getContext()->getI18n()->__($this->article->getName(), null, 'menu'), 
      'url' => $this->getContext()->getRouting()->generate('article_frontend_show', array('slug' => $this->article->getSlug()), true)
    );          
    $this->getContext()->set('breadcrumbs', $breadcrumbs);
        
    $this->setMeta(false, $this->article->getTitle(), $this->article->getH1(), $this->article->getDescription(), $this->article->getKeywords());     
  }
  
  
  public function executeListFrontend(sfWebRequest $request)
  {
    $this->articles = Doctrine_Query::create()
                        ->from('Article a')
                        ->orderBy('a.created_at desc')
                        ->execute();
    
    $breadcrumbs = array();
    $breadcrumbs[] = array(
      'text' => $this->getContext()->getI18n()->__('article_frontend_list', null, 'menu'), 
      'url' => $this->getContext()->getRouting()->generate('article_frontend_list', array(), true)
    );          
    
    $this->getContext()->set('breadcrumbs', $breadcrumbs);
        
    $this->setMeta(true);     
  }

}
