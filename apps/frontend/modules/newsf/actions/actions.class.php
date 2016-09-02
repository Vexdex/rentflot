<?php

/**
 * call actions.
 *
 * @package    Rentflot
 * @subpackage call
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class newsfActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	  $this->news = Doctrine_Query::create()
		->from('News n')
		->leftJoin('n.Translation nt WITH nt.lang = \''.$this->getUser()->getCulture().'\'')
		->execute();
    $breadcrumbs = array();
    $breadcrumbs[] = array(
      'text' => $this->getContext()->getI18n()->__('news', null, 'menu'),
      'url' => $this->getContext()->getRouting()->generate('newsf_list', array(), true)
    );
    $this->getContext()->set('breadcrumbs', $breadcrumbs);
    $this->setMeta(true);
    /*
    $response = $this->getResponse();
    $response->addMeta('description', $this->adv->getDescription());
    $response->addMeta('keywords', $this->adv->getKeywords());
    $response->setTitle($this->adv->getTitle());*/
  }
  public function executeShow(sfWebRequest $request)
  {
    $slug = $request->getParameter('slug');
    $this->new = Doctrine_Query::create()
                 ->from('News n')
                 ->leftJoin('n.Translation nt WITH nt.lang = \''.$this->getUser()->getCulture().'\'')
                 ->where('n.slug = ?', $slug)
                 ->fetchOne();
    $response = $this->getResponse();
    $response->addMeta('description', $this->new->getDescription());
    $response->addMeta('keywords', $this->new->getKeywords());
    $response->setTitle($this->new->getTitle());

    $breadcrumbs = array();
    $breadcrumbs[] = array(
      'text' => $this->getContext()->getI18n()->__('news', null, 'menu'),
      'url' => $this->getContext()->getRouting()->generate('newsf_list', array(), true)
    );
    $breadcrumbs[] = array(
      'text' => $this->new->getTitle(),
      'url' => $this->getContext()->getRouting()->generate('newsf', array('slug'=>$this->new->getSlug()), true)
    );

    $this->getContext()->set('breadcrumbs', $breadcrumbs);
    $this->setMeta(false, $this->new->getTitle(), $this->new->getName(), $this->new->getDescription(), $this->new->getKeywords());
  }
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
}
