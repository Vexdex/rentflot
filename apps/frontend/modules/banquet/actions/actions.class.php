<?php

/**
 * call actions.
 *
 * @package    Rentflot
 * @subpackage call
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class banquetActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function setMeta()
  {
    $current_route = $this->getContext()->getRouting()->getCurrentRouteName();
    $response = $this->getResponse();

    $meta_description = $this->getContext()->getI18n()->__($current_route.'_description', null, 'meta');
    $meta_keywords = $this->getContext()->getI18n()->__($current_route.'_keywords', null, 'meta');
    $meta_title = $this->getContext()->getI18n()->__($current_route.'_title', null, 'meta');
    $meta_h1 = $this->getContext()->getI18n()->__($current_route.'_h1', null, 'meta');

    $response->addMeta('description', $meta_description);
    $response->addMeta('keywords', $meta_keywords);
    $response->setTitle($meta_title);
    $this->getContext()->setH1($meta_h1);
  }
  public function executeIndex(sfWebRequest $request)
  {

    $this->kitchen1 = Doctrine_Query::create()
                 ->from('Kitchen k')
                 ->leftJoin('k.Translation kt WITH kt.lang = \''.$this->getUser()->getCulture().'\'')
                 ->where('k.column = 1')
                 ->execute();
    $this->kitchen2 = Doctrine_Query::create()
                      ->from('Kitchen k')
                      ->leftJoin('k.Translation kt WITH kt.lang = \''.$this->getUser()->getCulture().'\'')
                      ->where('k.column = 2')
                      ->execute();
    $this->kitchen3 = Doctrine_Query::create()
                      ->from('Kitchen k')
                      ->leftJoin('k.Translation kt WITH kt.lang = \''.$this->getUser()->getCulture().'\'')
                      ->where('k.column = 3')
                      ->execute();
    $this->setTemplate("index".$this->getUser()->getCulture());

    $breadcrumbs = array();
    $breadcrumbs[] = array(
      'text' => $this->getContext()->getI18n()->__('banquet', null, 'menu'),
      'url' => $this->getContext()->getRouting()->generate('banquet', array(), true)
    );
    $this->getContext()->set('breadcrumbs', $breadcrumbs);
    $this->setMeta();
  }
  public function executeShow(sfWebRequest $request)
  {

    $slug = $request->getParameter('slug');

    $this->kitchen = Doctrine_Query::create()
      ->from('Kitchen k')
      ->leftJoin('k.Translation kt WITH kt.lang = \''.$this->getUser()->getCulture().'\'')
      ->where('k.slug = ?', $slug)
      ->fetchOne();
    $response = $this->getResponse();
    $response->addMeta('description', $this->kitchen->getDescription());
    $response->addMeta('keywords', $this->kitchen->getKeywords());
    $response->setTitle($this->kitchen->getTitle());
      //$this->partial = 'page_banquet.'.$this->getUser()->getCulture();

    $breadcrumbs = array();
    $breadcrumbs[] = array(
      'text' => $this->getContext()->getI18n()->__('banquet', null, 'menu'),
      'url' => $this->getContext()->getRouting()->generate('banquet', array(), true)
    );
    $breadcrumbs[] = array(
      'text' => $this->kitchen->getName(),
      'url' => $this->getContext()->getRouting()->generate('show_kitchen', array('slug'=>$this->kitchen->getSlug()), true)
    );
    $this->getContext()->set('breadcrumbs', $breadcrumbs);
  }
}
