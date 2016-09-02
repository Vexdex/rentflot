<?php

/**
 * Feedback form.
 *
 * @package    megapolis
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FeedbackForm extends BaseForm
{
  public function configure()
  {
    $this->widgetSchema['email'] = new sfWidgetFormInputText();
    $this->validatorSchema['email'] = new magicValidatorEmail();

    $this->widgetSchema['subject_id'] = new sfWidgetFormDoctrineChoice(array(
        'add_empty' => sfContext::getInstance()->getI18n()->__('empty_subject', null, 'feedback'),
        'model' => 'FeedbackSubject',
        'query' => Doctrine::getTable('FeedbackSubject')
                    ->createQuery('і')
                    ->leftJoin('і.Translation t WITH t.lang = \''.sfContext::getInstance()->getUser()->getCulture().'\'')
    ));
    $this->validatorSchema['subject_id'] = new sfValidatorDoctrineChoice(array('model' => 'FeedbackSubject'));

 	  $this->widgetSchema['message'] = new sfWidgetFormTextarea();
     $this->validatorSchema['message'] = new sfValidatorString(array('max_length' => 1000));

	  $this->widgetSchema['captcha'] = new sfWidgetFormMagicCaptcha();
    $this->validatorSchema['captcha'] = new sfValidatorMagicCaptcha();

    $this->widgetSchema->setNameFormat('feedback_form[%s]');
  }
}
