<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version35 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('client_contact', 'created_by', 'integer', '8', array(
             ));
        $this->addColumn('client_contact', 'updated_by', 'integer', '8', array(
             ));
    }

    public function down()
    {
        $this->removeColumn('client_contact', 'created_by');
        $this->removeColumn('client_contact', 'updated_by');
    }
}