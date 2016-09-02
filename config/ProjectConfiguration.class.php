<?php

require_once '../temp/libs/symfony-1.4.11/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfWebBrowserPlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin');
    $this->enablePlugins('magicLibsPlugin');
    sfWidgetFormSchema::setDefaultFormFormatterName('Magic'); 
  }

  // Enable Doctrine callbacks
  public function configureDoctrine(Doctrine_Manager $manager)
  {
    $manager->setAttribute(Doctrine_Core::ATTR_USE_DQL_CALLBACKS, true);
  }  
}
