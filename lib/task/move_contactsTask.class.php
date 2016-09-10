<?php

class move_contactsTask extends sfBaseTask
{
    protected function configure()
    {
    $this->namespace        = 'contacts';
    $this->name             = 'move_contacts';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [move_contacts|INFO] task does :
    move the unmarked appointments to next day, at 9:30 AM
            
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

        if(count($contacts) !== 0) {
            $i = 0;    
            $newDateAppoint = date_create('now'); // в 00:00      
            $newDateAppoint->modify('+9 hour');
            $newDateAppoint->modify('+30 minute');
            
        foreach ($contacts as $contact) {        
            
            // create Query - update
            Doctrine_Query::create()
                                ->update('ClientContact c')
                                ->set('c.contact_date', '?', $newDateAppoint->format('Y-m-d H:i:s'))
                                ->set('c.contact_time', '?', $newDateAppoint->format('H:i:s'))
                                ->set('c.comment', '?', $contact['comment'] . (strlen($contact['comment']) !== 0 AND strlen($contact['comment']) !== Null)  ? $contact['comment'] . "\r\n перенос напоминания с " . $contact['contact_date'] : "перенос напоминания с ".  $contact['contact_date'] . "\r\n")
                                ->where('c.order_id = ?',  $contact['order_id'])
                                ->execute();    
            //   $this->log("For order " . $contact['order_id'] . " made automatic appointment about contacts", sfLogger::INFO);
            $i++;
            }
            echo "Перенесено " . $i . " пропущенных напоминаний на " .  $newDateAppoint->format('Y-m-d H:i:s') ;
        } else {
            echo "Не обнаружены пропущенные напоминания " ;
        }    
    }
}