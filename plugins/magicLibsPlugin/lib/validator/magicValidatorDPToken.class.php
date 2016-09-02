<?php
/**
 * magicValidatorDPToken prevents form double submit (double post)
 *
 * @package    symfony
 * @subpackage validator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfValidatorCSRFToken.class.php 7902 2008-03-15 13:17:33Z fabien $
 */
class magicValidatorDPToken extends sfValidatorBase
{
  /**
   * @see sfValidatorBase
   */
  protected function configure($options = array(), $messages = array())
  {
    $this->setOption('required', true);
    $this->addRequiredOption('name');
    $this->addMessage('dp_attack', sfContext::getInstance()->getI18N()->__('dp_attack', null, 'grid'));
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {
    $token = sfContext::getInstance()->getUser()->getAttribute($this->getOption('name'));
    sfContext::getInstance()->getUser()->getAttributeHolder()->remove($this->getOption('name'));

    if ($value != $token)
    {
      throw new sfValidatorError($this, 'dp_attack');
    }

    return $value;
  }
}
