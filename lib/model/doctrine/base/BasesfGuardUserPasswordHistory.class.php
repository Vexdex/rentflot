<?php

/**
 * BasesfGuardUserPasswordHistory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property string $password
 * @property sfGuardUser $sfGuardUser
 * 
 * @method integer                    getUserId()      Returns the current record's "user_id" value
 * @method string                     getPassword()    Returns the current record's "password" value
 * @method sfGuardUser                getSfGuardUser() Returns the current record's "sfGuardUser" value
 * @method sfGuardUserPasswordHistory setUserId()      Sets the current record's "user_id" value
 * @method sfGuardUserPasswordHistory setPassword()    Sets the current record's "password" value
 * @method sfGuardUserPasswordHistory setSfGuardUser() Sets the current record's "sfGuardUser" value
 * 
 * @package    Rentflot
 * @subpackage model
 * @author     Infosoft
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasesfGuardUserPasswordHistory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_guard_user_pwd_hist');
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('password', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}