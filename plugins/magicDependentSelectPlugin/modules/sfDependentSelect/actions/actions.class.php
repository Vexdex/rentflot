<?php

/**
 * sfActionsDependentSelect actions
 *
 * @package    symfony
 * @subpackage sfDependentSelectAuto
 * @author
 */

class sfDependentSelectActions extends sfActions
{

  public function executeAjax(sfWebRequest $request)
  {
    $this->forward404Unless($request->isXmlHttpRequest() && $request->isMethod('post'));

    $value = $request->getParameter('value');
    $configName = $request->getParameter('config_name');

    return $this->renderText(json_encode(sfDependentSelectHelper::getChoices($value, $configName)));
  }

}
