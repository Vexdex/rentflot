<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version57 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('advertisement', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'slug' => 
             array(
              'type' => 'string',
              'unique' => '1',
              'length' => '255',
             ),
             'created_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'updated_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
             ),
             ));
        $this->createTable('category_advertisement', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'category_id' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '8',
             ),
             'advertisement_id' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '8',
             ),
             'created_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'updated_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
             ),
             ));
        $this->createTable('advertisement_translation', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'primary' => '1',
             ),
             'name' => 
             array(
              'type' => 'string',
              'length' => '255',
             ),
             'title' => 
             array(
              'type' => 'string',
              'length' => '255',
             ),
             'description' => 
             array(
              'type' => 'string',
              'length' => '2000',
             ),
             'keywords' => 
             array(
              'type' => 'string',
              'length' => '2000',
             ),
             'text' => 
             array(
              'type' => 'string',
              'length' => '10000',
             ),
             'lang' => 
             array(
              'fixed' => '1',
              'primary' => '1',
              'type' => 'string',
              'length' => '2',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
              1 => 'lang',
             ),
             ));
    }

    public function down()
    {
        $this->dropTable('advertisement');
        $this->dropTable('category_advertisement');
        $this->dropTable('advertisement_translation');
    }
}