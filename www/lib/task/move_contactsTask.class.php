<?php

class move_contactsTask extends sfBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'contacts';
    $this->name             = 'move_contacts';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [move_contacts|INFO] task does things.
Call it with:

  [php symfony contacts:move_contacts|INFO]            
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);

    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration); 
  
    // create Query - select
    $q = Doctrine_Query::create()
                                ->select('c.*, o.*, o.id oid')            
                                ->from('ClientContact c')                                            
                                ->innerJoin('c.Order o ON o.id = c.order_id')
                                ->where('c.contact_date < ?', date('Y-m-d H:i:s'))             
                                ->andWhere('o.is_archived != ?',1);                               
    $contacts = $q->fetchArray();
   
    foreach ($contacts as $contact) {        
        $date = new DateTime(); 
        $date->modify('+1 day');
        $date->modify('+9 hour');
        $date->modify('+30 minute');
        
        // create Query - update
        Doctrine_Query::create()
                            ->update('ClientContact c')
                            ->set('c.contact_date', '?', $date->format('Y-m-d H:i:s'))
                            ->set('c.contact_time', '?', $date->format('H:i:s'))
                            ->set('c.comment', '?', $contact['comment'] . (strlen($contact['comment']) !== 0 AND strlen($contact['comment']) !== Null)  ? $contact['comment'] . "\r\n (AA - automat appoint) " . $contact['contact_date'] : "(AA - automat appoint) ".  $contact['contact_date'])
                            ->where('c.order_id = ?',  $contact['order_id'])
                            ->execute();    
        //   $this->log("For order " . $contact['order_id'] . " made automatic appointment about contacts", sfLogger::INFO);
        } 
  }
}