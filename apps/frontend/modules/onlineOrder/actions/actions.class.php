<?php

/**
 * onlineOrder actions.
 *
 * @property   Item $item
 * @property   Category $category
 * @package    Rentflot
 * @subpackage onlineOrder
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class onlineOrderActions extends sfActions
{

  public function executeOnlineOrderForm(sfWebRequest $request)
  {
    $this->forward404Unless($request->isXmlHttpRequest());
    $this->getContext()->getConfiguration()->loadHelpers('Partial');

    $item = Doctrine::getTable('Item')->findOneBySlug($request->getParameter('item_slug'));
    $this->forward404Unless($item);

    $category = Doctrine::getTable('Category')->findOneBySlug($request->getParameter('category_slug'));
    $this->forward404Unless($category);

    $callback = array();
    $hasErrors = false;
    $onlineOrderForm = new PreOrderForm();

    if ($request->isMethod('post'))
    {
      $onlineOrderForm->bind($request->getParameter('order'));

      if ($onlineOrderForm->isValid())
      {
        $orderData = $this->processPreOrderForm($request, $onlineOrderForm, $category, $item);
        $partialData = array_merge(array('form' => $onlineOrderForm, 'item' => $item, 'category' => $category), $orderData);

        $callback = array('function' => 'showOnlineOrderFormThankYouMessage', 'params' => array('message' => get_partial('thank_you', $partialData)));
      }
      else
      {
        $hasErrors = true;
      }
    }

    $responseData = array(
      'form' => get_partial('form_online_order', array('form' => $onlineOrderForm, 'item' => $item, 'category' => $category)),
      'callback' => $callback,
      'has_errors' => $hasErrors
    );

    return $this->renderText(json_encode($responseData));
  }
  
    
  protected function processPreOrderForm($request, $form, $category, $item)
  {
    $comment = '';
    $additionalInformation = array();
    $contacts = array(
      'name' => '',
      'email' => '',
      'phone' => ''
    );

    /*
    $additionalInformation[] = 'Имя: ' . $form->getValue('contact_name');
    $contacts['name'] = $form->getValue('contact_name');

    if ($form->getValue('contact_email'))
    {
      $additionalInformation[] = 'Email: ' . $form->getValue('contact_email');
      $contacts['email'] = $form->getValue('contact_email');
    }

    $additionalInformation[] = 'Телефон: ' . $form->getValue('contact_phone');
    $contacts['phone'] = $form->getValue('contact_phone');

    if ($form->getValue('people_count'))
    {
      $additionalInformation[] = 'Количество гостей на борту: ' . $form->getValue('people_count');
    }
    */

    if ($form->getValue('additional_information'))
    {
      $additionalInformation[] = $form->getValue('additional_information');
    }

    // Create new Client
    $client = new Client();
    $client->setName($form->getValue('contact_name'));
    $client->setEmail($form->getValue('contact_email'));
    $client->setPhones($form->getValue('contact_phone'));
    $client->save();

    // Create new Order
    $order = new Order();
    //$order->setClient(ClientTable::getUnknownClient());
    $order->setClient($client);
    $order->setDate($form->getValue('date'));
    $order->setTimeFrom($form->getValue('time_from'));
    $order->setTimeTo($form->getValue('time_to'));
    $order->setPeopleCount($form->getValue('people_count'));
    $order->setAdditionalInformation(implode("\n", $additionalInformation));
    $order->save();

    // OrderItem
    $duration = time_diff($order->getTimeFrom(), $order->getTimeTo());
    $count = round($duration['hours'] + $duration['minutes'] / 60, 2);
    $orderItem = new OrderItem();
    $orderItem->setOrder($order);
    $orderItem->setItem($item);
    $orderItem->setCount($count);
    $orderItem->setPriceUah($item->getPriceUah());
    $orderItem->save();

    // Send email
    $from = sfConfig::get('app_from_email');
    if (!$from)
    {
      throw new sfException('You must specify "from_email" in app.yml');
    }

    $to = array(sfConfig::get('app_contact_email', 'order@rentflot.ua'));

    if ($form->getValue('contact_email'))
    {
      $to[] = $form->getValue('contact_email');
    }

    $subject = $this->getContext()->getI18N()->__('email_online_order_subject', array('%id%' => $order->getId()), 'order');
    $body = $this->getPartial('email_online_order', array('order' => $order, 'category' => $category, 'item' => $item, 'comment' => $comment, 'contacts' => $contacts));
    $this->getMailer()->composeAndSendHtml($from, $to, $subject, $body);

    return array('order' => $order, 'comment' => $comment, 'contacts' => $contacts);
  }

}
