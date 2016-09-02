<?php

class frontendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
    sfProjectConfiguration::getActive()->loadHelpers(array('Url', 'MagicDebug', 'MagicString', 'MagicTools', 'Rentflot'));
  }
}
