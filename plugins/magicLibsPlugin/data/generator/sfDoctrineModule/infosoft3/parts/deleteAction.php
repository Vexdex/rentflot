  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    try
    {
      if ($this->getRoute()->getObject()->delete())
      {
        $this->getUser()->setFlash('notice', 'delete_successfull');
      }
    }
    catch (Exception $e)
    {      
      if (strpos($e->getMessage(), 'integrity constraint') !== false || strpos($e->getMessage(), 'foreign key constraint fails') !== false)
      {      
        $this->getUser()->setFlash('error', 'delete_error_constraint');
        $this->redirect(array('sf_route' => '<?php echo $this->getUrlForAction('edit') ?>', 'id' => $this->getRoute()->getObject()->getId()));
      }
    }
    $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
  }
