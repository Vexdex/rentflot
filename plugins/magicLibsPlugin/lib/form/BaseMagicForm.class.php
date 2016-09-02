<?php

/**
 * Base project form.
 *
 * @package    MagicLibsPlugin
 * @subpackage form
 * @author     Infosoft 
 * @version    SVN: $Id: BaseForm.class.php 20147 2009-07-13 11:46:57Z FabianLange $
 */
class BaseMagicForm extends sfFormSymfony
{
  protected
    // DP = Double Post, защита от двойной отправки формы
    $DPProtection = false,
    $DPFieldName = '_dp_secret';

  public function configure()
  {
    parent::configure();    

    if ($this->DPProtection)
    {
      $this->validatorSchema[$this->DPFieldName] = new magicValidatorDPToken(array('name' => $this->getDPTokenName()));
      $this->widgetSchema[$this->DPFieldName] = new sfWidgetFormInputHidden();
      $this->setDefault($this->DPFieldName, $this->getDPToken());
    }
  }

  protected function getDPToken()
  {
    $token = sfContext::getInstance()->getUser()->getAttribute($this->getDPTokenName());
    if (!$token)
    {
      $token = md5(session_id().date('s-i-H-d-m-Y-m-d-H-i-s').rand(1, 1000));
      sfContext::getInstance()->getUser()->setAttribute($this->getDPTokenName(), $token);
    }
    return $token;
  }

  protected function getDPTokenName()
  {
    return 'DPProtection_'.get_class($this);
  }

  public function disableDPProtection()
  {
    $this->DPProtection = false;
  }

  public function enableDPProtection()
  {
    $this->DPProtection = true;
  }
}
