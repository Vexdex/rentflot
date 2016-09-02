<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version14 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('order_item_status', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'name' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'length' => '255',
             ),
             'order' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'default' => '1000',
              'length' => '8',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => 'utf8_unicode_ci',
             'charset' => 'utf8',
             ));
        $this->createTable('order_owner', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'name' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'length' => '255',
             ),
             'order' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'default' => '1000',
              'length' => '8',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => 'utf8_unicode_ci',
             'charset' => 'utf8',
             ));
        $this->addColumn('order', 'order_owner_id', 'integer', '8', array(
             ));
        $this->addColumn('order_item', 'status_id', 'integer', '8', array(
             ));
    }

    public function down()
    {
        $this->dropTable('order_item_status');
        $this->dropTable('order_owner');
        $this->removeColumn('order', 'order_owner_id');
        $this->removeColumn('order_item', 'status_id');
    }
}