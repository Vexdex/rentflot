<?php

/**
 * call actions.
 *
 * @package    Rentflot
 * @subpackage call
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class callActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new CallForm();
    $this->setMeta(true);
    
        $breadcrumbs[] = array(
              'text' => $this->getContext()->getI18n()->__("contacts", null, 'menu'),
                    'url' => $this->getContext()->getRouting()->generate("contacts", array(), true)
                        );
                            $breadcrumbs[] = array(
                                  'text' => $this->getContext()->getI18n()->__("callback", null, 'menu'),
                                        'url' => $this->getContext()->getRouting()->generate("call", array(), true)
                                            );
                                                $this->getContext()->set('breadcrumbs', $breadcrumbs);
  }

  public function executeSubmit(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $c=new Callback();
    $c->phone=$request->getParameter('phone');
    $c->save();
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
