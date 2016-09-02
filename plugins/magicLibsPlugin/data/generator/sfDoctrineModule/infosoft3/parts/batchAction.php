  public function executeBatch(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    if (!$ids = $request->getParameter('ids'))
    {
      $this->getUser()->setFlash('error', 'batch_no_items_selected');

      $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
    }

    if (!$action = $request->getParameter('batch_action'))
    {
      $this->getUser()->setFlash('error', 'batch_no_action_selected');
      
      $this->getUser()->setAttribute('ids', $ids);

      $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
    }

    if (!method_exists($this, $method = 'execute'.ucfirst($action)))
    {
      throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
    }

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $validator = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => '<?php echo $this->getModelClass() ?>'));
    try
    {
      // validate ids
      $ids = $validator->clean($ids);

      // -- Log 
      $this->log(array('action' => $action, 'ids' => $ids));     
      
      // execute batch
      $this->$method($request);
    }
    catch (sfValidatorError $e)
    {
      $this->getUser()->setFlash('error', 'delete_error_items_does_not_exists');
    }
    
    $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
  }

  protected function executeBatchDelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $records = Doctrine_Query::create()
      ->from('<?php echo $this->getModelClass() ?>')
      ->whereIn('<?php echo $this->getPrimaryKeys(true) ?>', $ids)
      ->execute();

    try
    {
      foreach ($records as $record)
      {
        $record->delete();
      }
      $this->getUser()->setFlash('notice', 'delete_batch_successfull');
    }
    catch (Exception $e)
    {
      if (strpos($e->getMessage(), 'integrity constraint') !== false || strpos($e->getMessage(), 'foreign key constraint fails') !== false)
      {
        $this->getUser()->setFlash('error', 'delete_batch_error_constraint'.($records->count() > 1 ? '_n' : '_1'));
      }
    }
    
    $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
  }

  
  protected function executeBatchActivate(sfWebRequest $request)
	{
	  $ids = $request->getParameter('ids');
		
		//vardump($ids);

    $records = Doctrine_Query::create()
      ->from('<?php echo $this->getModelClass() ?>')
      ->whereIn('id', $ids);
		
    /*    
    if (!$this->getUser()->getGuardUser()->hasPermission('manage_objects')) {
			$records = $records->andWhere('user_id = ?', $this->getUser()->getGuardUser()->getId());
		}
    */
		
		$records = $records->execute();
		
    foreach ($records as $record)
    {
      $record->setIsActive(1);
    }
		
		$records->save();

    $this->getUser()->setFlash('custom_notice', 'activate_successfull'); // The selected items have been activeted successfully.
    $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
	}


  protected function executeBatchDeactivate(sfWebRequest $request)
	{
		$ids = $request->getParameter('ids');
		
		//vardump($ids);

    $records = Doctrine_Query::create()
      ->from('<?php echo $this->getModelClass() ?>')
      ->whereIn('id', $ids);
			
    /*
    if (!$this->getUser()->getGuardUser()->hasPermission('manage_objects')) {
			$records = $records->andWhere('user_id = ?', $this->getUser()->getGuardUser()->getId());
		}
    */
		
		$records = $records->execute();
		
    foreach ($records as $record)
    {
      $record->setIsActive(0);
    }
		
		$records->save();

    $this->getUser()->setFlash('custom_notice', 'deactivate_successfull'); // The selected items have been deactiveted successfully.
    $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
	}
  