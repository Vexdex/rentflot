[?php

require_once(dirname(__FILE__).'/../lib/Base<?php echo ucfirst($this->moduleName) ?>GeneratorConfiguration.class.php');
require_once(dirname(__FILE__).'/../lib/Base<?php echo ucfirst($this->moduleName) ?>GeneratorHelper.class.php');

/**
 * <?php echo $this->getModuleName() ?> actions.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: actions.class.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class <?php echo $this->getGeneratedModuleName() ?>Actions extends <?php echo $this->getActionsBaseClass()."\n" ?>
{
  public function preExecute()
  {
    $this->configuration = new <?php echo $this->getModuleName() ?>GeneratorConfiguration();

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName())))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

    $this->helper = new <?php echo $this->getModuleName() ?>GeneratorHelper();
    
    //by Andrey
    $cultures_enabled = sfConfig::get('app_cultures_enabled');
    if (empty($cultures_enabled))
    {
      throw new sfConfigurationException('Cultures doesn\'t enabled in app.yml');      
    }    
    $this->cultures_enabled = array_keys($cultures_enabled);
    
    /*
      -- Log
      Метод log вставлен отдельно в batch для возможности отследить все массовые операции с объектами, 
      Метод log вставлен отдельно в processForm (update и create) для возможности записать id созданного или измененного объекта
    */
    $action = $this->getActionName();      
    if ($action != 'batch' && $action != 'create' && $action != 'update')
    {      
      $this->log(array('ids' => $this->request->getParameter('id') ? $this->request->getParameter('id') : null));    
    }
  }
  
  public function log($data = array(), $authenticated_only = true)
  {
    <?php if (!isset($this->params['log']) || $this->params['log']): ?>
    $user_options = $this->getUser()->getOptions();  
    if (!empty($user_options['log_events']) && !$this->request->isXmlHttpRequest())
    {           
      $username = $this->getUser()->isAuthenticated() ? $this->getUser()->getGuardUser()->__toString() : (isset($data['username']) ? $data['username'] : 'anonymous');      
      $module = isset($data['module']) ? $data['module'] : $this->getModuleName(); 
      $action = isset($data['action']) ? $data['action'] : $this->getActionName();      
      $ids = isset($data['ids']) ? $data['ids'] : null;
      $desc = isset($data['desc']) ? $data['desc'] : null;
      
      // Отключение записи в журнал при заданных параметрах
      if ($authenticated_only && !$this->getUser()->isAuthenticated())
      {
        return false;
      }      
            
      $action_log = new ActionLog();      
      if ($ids)
      {        
        if (is_array($ids))
        {
          if (count($ids) > 1)
          {            
            $action = $action.'N';
            $id_text_key = 'ids';
          }
          else
          {
            $action = $action.'1';
            $id_text_key = 'id';
          }                    
          $ids = implode(', ', $ids);
        }
        $action_log->setIds($ids);
      }            
      
      if ($desc)
      {
        $action_log->setDescription($desc);
      }
      
      $action_log->setModule($module);
      $action_log->setAction($action);      
      $action_log->setUsername($username);                  
      $action_log->setIp($this->request->getRemoteAddress());            
      $action_log->save();  
    }
    <?php endif; ?>      
  }
  

<?php include dirname(__FILE__).'/../../parts/indexAction.php' ?>

<?php if ($this->configuration->hasFilterForm()): ?>
<?php include dirname(__FILE__).'/../../parts/filterAction.php' ?>
<?php endif; ?>

<?php include dirname(__FILE__).'/../../parts/newAction.php' ?>

<?php include dirname(__FILE__).'/../../parts/createAction.php' ?>

<?php include dirname(__FILE__).'/../../parts/editAction.php' ?>

<?php include dirname(__FILE__).'/../../parts/updateAction.php' ?>

<?php if ($this->configuration->getValue('list.object_actions.activate')): ?>
<?php include dirname(__FILE__).'/../../parts/activateAction.php' ?>
<?php endif; ?>

<?php if ($this->configuration->getValue('list.object_actions.deactivate')): ?>
<?php include dirname(__FILE__).'/../../parts/deactivateAction.php' ?>
<?php endif; ?>

<?php include dirname(__FILE__).'/../../parts/deleteAction.php' ?>

<?php if ($this->configuration->getValue('list.batch_actions')): ?>
<?php include dirname(__FILE__).'/../../parts/batchAction.php' ?>
<?php endif; ?>

<?php include dirname(__FILE__).'/../../parts/processFormAction.php' ?>

<?php if ($this->configuration->hasFilterForm()): ?>
<?php include dirname(__FILE__).'/../../parts/filtersAction.php' ?>
<?php endif; ?>

<?php include dirname(__FILE__).'/../../parts/paginationAction.php' ?>

<?php include dirname(__FILE__).'/../../parts/sortingAction.php' ?>
}
