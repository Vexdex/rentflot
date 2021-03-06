<?php

/**
 * BaseBillType
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property integer $order
 * @property Doctrine_Collection $Bills
 * 
 * @method string              getName()  Returns the current record's "name" value
 * @method integer             getOrder() Returns the current record's "order" value
 * @method Doctrine_Collection getBills() Returns the current record's "Bills" collection
 * @method BillType            setName()  Sets the current record's "name" value
 * @method BillType            setOrder() Sets the current record's "order" value
 * @method BillType            setBills() Sets the current record's "Bills" collection
 * 
 * @package    Rentflot
 * @subpackage model
 * @author     Infosoft
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseBillType extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('bill_type');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('order', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 1000,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Bill as Bills', array(
             'local' => 'id',
             'foreign' => 'type_id'));
    }
}