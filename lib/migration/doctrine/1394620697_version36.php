<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version36 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('client_contact', 'client_contact_created_by_sf_guard_user_id', array(
             'name' => 'client_contact_created_by_sf_guard_user_id',
             'local' => 'created_by',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => '',
             'onDelete' => 'SET NULL',
             ));
        $this->createForeignKey('client_contact', 'client_contact_updated_by_sf_guard_user_id', array(
             'name' => 'client_contact_updated_by_sf_guard_user_id',
             'local' => 'updated_by',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => '',
             'onDelete' => 'SET NULL',
             ));
        $this->addIndex('client_contact', 'client_contact_created_by', array(
             'fields' => 
             array(
              0 => 'created_by',
             ),
             ));
        $this->addIndex('client_contact', 'client_contact_updated_by', array(
             'fields' => 
             array(
              0 => 'updated_by',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('client_contact', 'client_contact_created_by_sf_guard_user_id');
        $this->dropForeignKey('client_contact', 'client_contact_updated_by_sf_guard_user_id');
        $this->removeIndex('client_contact', 'client_contact_created_by', array(
             'fields' => 
             array(
              0 => 'created_by',
             ),
             ));
        $this->removeIndex('client_contact', 'client_contact_updated_by', array(
             'fields' => 
             array(
              0 => 'updated_by',
             ),
             ));
    }
}