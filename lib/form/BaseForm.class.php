<?php

/**
 * Base project form.
 * 
 * @package    CA Web
 * @subpackage form
 * @author     Infosoft 
 * @version    SVN: $Id: BaseForm.class.php 20147 2009-07-13 11:46:57Z FabianLange $
 */
class BaseForm extends sfFormSymfony
{
 
  public function configure()
  {
    parent::configure();    
    unset($this['created_at'], $this['updated_at'], $this['deleted_at']);
  }
  

}
