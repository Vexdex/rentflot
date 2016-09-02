<?php

class magicFileLogger extends sfFileLogger
{
  protected
    $request_id;
  
  public function initialize(sfEventDispatcher $dispatcher, $options = array())
  {
    $this->request_id = uniqid();
    return parent::initialize($dispatcher, $options);
  }
  
  protected function doLog($message, $priority)
  {
    flock($this->fp, LOCK_EX);
    fwrite($this->fp, strtr($this->format, array(
      '%request_id%' => $this->request_id,
      '%type%'     => $this->type,
      '%message%'  => $message,
      '%time%'     => strftime($this->timeFormat),
      '%priority%' => $this->getPriority($priority),
      '%EOL%'      => PHP_EOL,
    )));
    flock($this->fp, LOCK_UN);
  }
}
