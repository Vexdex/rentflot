<?php

/**
 * ClientContact filter form.
 *
 * @package    Rentflot
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ClientContactFormFilter extends BaseClientContactFormFilter
{
  public function configure()
  {
	  //$this->widgetSchema['created_by']->addOption('order_by',array('username','asc'));
	  
	  $this->widgetSchema['created_by'] = new sfWidgetFormDoctrineChoice(array(
      'model' => $this->getRelatedModelName('User'), 
		'query' => Doctrine_Query::create()
        ->from('sfGuardUser u, u.Profile p')
        ->orderBy('p.last_name'),
      'add_empty' => true
    ));
	
		  $this->widgetSchema['updated_by'] = new sfWidgetFormDoctrineChoice(array(
      'model' => $this->getRelatedModelName('User'), 
		'query' => Doctrine_Query::create()
        ->from('sfGuardUser u, u.Profile p')
        ->orderBy('p.last_name'),
      'add_empty' => true
    ));
	
	/*
      $this->widgetSchema['client_id'] = new sfWidgetFormDoctrineChoice(array(
      'model' => $this->getRelatedModelName('Client'), 
      'query' => Doctrine_Query::create()
        ->from('Client c')
        ->orderBy('c.org_name')
        ->addOrderBy('c.name'),
      'add_empty' => true
    ));*/ //old for client relation
	
	
    $show_hidden_choices = array(
      0 => 'Скрыть выполненные',
      1 => 'Отображать выполненные'
    );
    $this->widgetSchema['show_hidden_contracts'] = new sfWidgetFormChoice(array('choices' => $show_hidden_choices));
	$this->validatorSchema['show_hidden_contracts'] = new sfValidatorChoice(array('choices'=>array(0,1)));
	
  }
}
