[?php

/**
 * <?php echo $this->getModuleName() ?> module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? '<?php echo $this->params['route_prefix'] ?>' : '<?php echo $this->params['route_prefix'] ?>_'.$action;
  }
  
  public function linkToNew($params)
  {
    return '<li class="GridActionAdd">'.link_to(__($params['label'], array(), 'grid'), '@'.$this->getUrlForAction('new')).'</li>';
  }

  public function linkToEdit($object, $params)
  {
    return '<li class="GridActionEdit">'.link_to(__($params['label'], array(), 'grid'), $this->getUrlForAction('edit'), $object).'</li>';
  }

  public function linkToDelete($object, $params)
  {
    if ($object->isNew())
    {
      return '';
    }

    return '<li class="GridActionDelete">'.link_to(__($params['label'], array(), 'grid'), $this->getUrlForAction('delete'), $object, array('method' => 'delete', 'confirm' => !empty($params['confirm']) ? __('confirm', array(), 'grid') : $params['confirm'])).'</li>';
  }

  public function linkToDeleteContact($object, $params)
  {
    if ($object->isNew())
    {
      return '';
    }

    return ''.link_to(__($params['label'], array(), 'grid'), $this->getUrlForAction('delete'), $object, array('method' => 'delete', 'confirm' => !empty($params['confirm']) ? __('confirm', array(), 'grid') : $params['confirm'])).'';
  }
  public function linkToEditContact($object, $params)
  {
    return ''.link_to(__($params['label'], array(), 'grid'), $this->getUrlForAction('edit'), $object).'';
  }

  public function linkToList($params)
  {
    return '<li class="GridActionList">'.link_to(__($params['label'], array(), 'grid'), '@'.$this->getUrlForAction('list')).'</li>';
  }

  public function linkToSave($object, $params)
  {
    return '<li style="padding-left: 0"><input type="submit" value="'.__($params['label'], array(), 'grid').'" /></li>';
  }

  public function linkToSaveAndAdd($object, $params)
  {
    if (!$object->isNew())
    {
      return '';
    }

    return '<li style="padding-left: 10px"><input type="submit" value="'.__($params['label'], array(), 'grid').'" name="_save_and_add" /></li>';
  }
  
}
