  public function executeDeactivate(sfWebRequest $request)
  {
    $this-><?php echo $this->getSingularName() ?> = $this->getRoute()->getObject();
    $this-><?php echo $this->getSingularName() ?>->setIsActive(false);
    $this-><?php echo $this->getSingularName() ?>->save();
    $this->getUser()->setFlash('custom_notice', 'deactivate_one_successfull');
    $this->redirect('@<?php echo $this->getSingularName() ?>');
  }
  