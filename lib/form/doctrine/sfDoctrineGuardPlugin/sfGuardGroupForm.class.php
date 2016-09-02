<?php

/**
 * sfGuardGroup form.
 *
 * @package    CA Web
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardGroupForm extends PluginsfGuardGroupForm
{
  public function configure()
  {
    parent::configure();
    $this->widgetSchema['users_list'] = new sfWidgetFormDoctrineChoice(array(
     'model' => 'sfGuardUser', 
     'query' => Doctrine::getTable('sfGuardUser')
                  ->createQuery('u')
                  ->leftJoin('u.Profile'),
      'multiple' => true, 
      'expanded' => true
    ));
    
    $this->widgetSchema['permissions_list']->setOption('expanded', true);
  }
}
