<?php

/**
 * payments actions.
 *
 * @package    Rentflot
 * @subpackage payments
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class paymentsActions extends sfActions
{
  protected
    $operationXmlTemplate =
      "<request>
        <version>%version%</version>
        <result_url>%result_url%</result_url>
        <server_url>%server_url%</server_url>
        <merchant_id>%merchant_id%</merchant_id>
        <order_id>%order_id%</order_id>
        <amount>%amount%</amount>
        <currency>%currency%</currency>
        <description>%description%</description>
        <default_phone>%phone%</default_phone>
        <pay_way>%method%</pay_way>
        <language>%culture%</language>
      </request>";

  public function setMeta()
  {
    $current_route = $this->getContext()->getRouting()->getCurrentRouteName();
    $response = $this->getResponse();
    $response->addMeta('description', $this->getContext()->getI18n()->__($current_route.'_description', null, 'meta'));
    $response->addMeta('keywords', $this->getContext()->getI18n()->__($current_route.'_keywords', null, 'meta'));
    $response->setTitle($this->getContext()->getI18n()->__($current_route.'_title', null, 'meta'));
    $this->getContext()->setH1($this->getContext()->getI18n()->__($current_route.'_h1', null, 'meta'));
  }

  public function executeGenerateXmlAndSign(sfWebRequest $request)
  {
    $this->forward404Unless($request->isXmlHttpRequest());

    $xml = $this->getOperationXml($this->getPaymentFormValues($request));
    $signature = sfConfig::get('app_payments_signature', 'SFuRBhiu7nhzXF2QK6Efkkwobyo03l6XDwVpf');

    $xmlEncoded = base64_encode($xml);
    $sgnatureEncoded = base64_encode(sha1($signature . $xml . $signature, 1));

    return $this->renderText(json_encode(array('xml' => $xmlEncoded ,'signature' => $sgnatureEncoded)));
  }

  protected function getPaymentFormValues(sfWebRequest $request)
  {
    $params = array();
    foreach (array('amount', 'currency', 'order_id') as $paramName)
    {
      $params[$paramName] = $request->getParameter('payment_form_' . $paramName);
    }

    return $params;
  }

  protected  function getOperationXml($params = array())
  {
    $defaultParams = array(
      'version' => sfConfig::get('app_payments_version', '1.2'),
      'result_url' => sfConfig::get('app_payments_result_url', $this->getContext()->getRouting()->generate('payments_pay_result', array(), true)),
      'server_url' => sfConfig::get('app_payments_server_url', $this->getContext()->getRouting()->generate('payments_pay_result', array(), true)),
      'merchant_id' => sfConfig::get('app_payments_merchant_id', 'i1564261831'),
      'order_id' => sfConfig::get('app_payments_order_id', 'Autogenerated-' . rand(1000, 10000) . '-' . rand(1000, 10000)),
      'amount' => sfConfig::get('app_payments_amount', '1'),
      'currency' => sfConfig::get('app_payments_amount', 'USD'),
      'description' => sfConfig::get('app_payments_description', ''),
      'method' => sfConfig::get('app_payments_method', 'card'),
      'phone' => sfConfig::get('app_payments_phone', '+380969628221'),
      'culture' => strtoupper($this->getUser()->getCulture() == 'uk' ? 'ua' : $this->getUser()->getCulture())
    );

    $params = sfConfig::get('app_payments_always_use_default_params', false) ? $defaultParams : array_merge($defaultParams, $params);
    $params['description'] = strtr($params['description'], array('%order_id%' => $params['order_id']));

    $paramsWithSpecialKeys = array();
    foreach ($params as $paramName => $paramValue)
    {
      $paramsWithSpecialKeys['%' . $paramName . '%'] = $paramValue;
    }

    return strtr($this->operationXmlTemplate, $paramsWithSpecialKeys);
  }

  public function executePayForServices(sfWebRequest $request)
  {
    $current_route = $this->getContext()->getRouting()->getCurrentRouteName();
    $breadcrumbs = array();

    $breadcrumbs[] = array(
      'text' => $this->getContext()->getI18n()->__($current_route, null, 'menu'),
      'url' => $this->getContext()->getRouting()->generate($current_route, array(), true)
    );
    $this->getContext()->set('breadcrumbs', $breadcrumbs);

    $this->setMeta();
  }

  public function executePayResult(sfWebRequest $request)
  {
    if ($this->getUser()->getFlash('payment_success'))
    {
      $this->redirect('homepage');
    }
    else
    {
      $this->getUser()->setFlash('payment_success', 1);
    }

    $current_route = $this->getContext()->getRouting()->getCurrentRouteName();
    $breadcrumbs = array();

    $breadcrumbs[] = array(
      'text' => $this->getContext()->getI18n()->__('payments_pay_for_services', null, 'menu'),
      'url' => $this->getContext()->getRouting()->generate($current_route, array(), true)
    );
    $this->getContext()->set('breadcrumbs', $breadcrumbs);

    $this->setMeta();
  }
}
