<?php

/**
 * dynMap actions.
 *
 * @package    Rentflot
 * @subpackage dynMap
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dynMapActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->itemsListQuery = Doctrine_Query::create()
                      ->select('name,link')
                      ->from('pierf')->execute();
    $current_route = $this->getContext()->getRouting()->getCurrentRouteName();

    $breadcrumbs[] = array(
      'text' => $this->getContext()->getI18n()->__($current_route, null, 'menu'),
      'url' => $this->getContext()->getRouting()->generate($current_route, array(), true)
    );

    $this->getContext()->set('breadcrumbs', $breadcrumbs);
	
	if($this->getUser()->getCulture()=="en")
	{
		$this->setTemplate('indexEn');
	}
    $response = $this->getResponse();
    $response->addMeta('description', "Rentflot route map");
    $response->addMeta('keywords', "Rentflot routs");
    $response->setTitle("Rout of motor ship trips");
    $this->getContext()->setH1("Rentflot");
  }
}
