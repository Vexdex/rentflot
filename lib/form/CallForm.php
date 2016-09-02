<?php


class CallForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'phone'    => new sfWidgetFormInputText()
    ));
  }
}
