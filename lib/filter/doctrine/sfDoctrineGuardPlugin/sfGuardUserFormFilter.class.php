<?php

/**
 * sfGuardUser filter form.
 *
 * @package    CA Web
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrinePluginFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserFormFilter extends PluginsfGuardUserFormFilter
{
  public function configure()
  {
    parent::configure();
    $this->widgetSchema['groups_list']->setOption('multiple', false);
    $this->widgetSchema['groups_list']->setOption('add_empty', true);
  }
}
