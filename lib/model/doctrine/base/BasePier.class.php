<?php

/**
 * BasePier
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property Doctrine_Collection $Piers
 * 
 * @method string              getName()  Returns the current record's "name" value
 * @method Doctrine_Collection getPiers() Returns the current record's "Piers" collection
 * @method Pier                setName()  Sets the current record's "name" value
 * @method Pier                setPiers() Sets the current record's "Piers" collection
 * 
 * @package    Rentflot
 * @subpackage model
 * @author     Infosoft
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePier extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pier');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Order as Piers', array(
             'local' => 'id',
             'foreign' => 'pier_id'));
    }
}