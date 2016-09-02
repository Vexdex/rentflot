<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfMailer is the main entry point for the mailer system.
 *
 * This class is instanciated by sfContext on demand.
 *
 * @package    symfony
 * @subpackage mailer
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfMailer.class.php 28841 2010-03-29 08:13:57Z fabien $
 */
class magicMailer extends sfMailer
{  
  public function composeAndSendHtml($from, $to, $subject, $body)
  {    
    $message = $this->compose();
    $message->setSubject($subject);
    $message->setTo($to);
    $message->setFrom($from);
    $message->setBody($body, 'text/html');
    $this->send($message);        
  }
  
  /**
   * $attachments array<Swift_Attachment>
   */   
  public function composeAndSendHtmlWithAttachments($from, $to, $subject, $body, $attachments = array())
  {    
    $message = $this->compose();
    $message->setSubject($subject);
    $message->setTo($to);
    $message->setFrom($from);    
    $message->setBody($body, 'text/html');
    
    if ($attachments)
    {
      foreach ($attachments as $attachment)
      {
        $message->attach($attachment);          
      }
    }
    
    $this->send($message);        
  }
  
}
