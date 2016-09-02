  public function executeActivate(sfWebRequest $request)
  {
    $this-><?php echo $this->getSingularName() ?> = $this->getRoute()->getObject();
    $this-><?php echo $this->getSingularName() ?>->setIsActive(true);
    $this-><?php echo $this->getSingularName() ?>->save();
    $this->getUser()->setFlash('custom_notice', 'activate_one_successfull');
    $this->redirect('@<?php echo $this->getSingularName() ?>');    
  }
  