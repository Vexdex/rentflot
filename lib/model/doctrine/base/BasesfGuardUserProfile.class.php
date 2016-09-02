<?php

/**
 * BasesfGuardUserProfile
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property string $last_name
 * @property string $first_name
 * @property string $patronymic
 * @property string $email
 * @property string $validate
 * @property integer $login_attempts
 * @property timestamp $blocked_at
 * @property boolean $force_change_password
 * @property sfGuardUser $User
 * 
 * @method integer            getUserId()                Returns the current record's "user_id" value
 * @method string             getLastName()              Returns the current record's "last_name" value
 * @method string             getFirstName()             Returns the current record's "first_name" value
 * @method string             getPatronymic()            Returns the current record's "patronymic" value
 * @method string             getEmail()                 Returns the current record's "email" value
 * @method string             getValidate()              Returns the current record's "validate" value
 * @method integer            getLoginAttempts()         Returns the current record's "login_attempts" value
 * @method timestamp          getBlockedAt()             Returns the current record's "blocked_at" value
 * @method boolean            getForceChangePassword()   Returns the current record's "force_change_password" value
 * @method sfGuardUser        getUser()                  Returns the current record's "User" value
 * @method sfGuardUserProfile setUserId()                Sets the current record's "user_id" value
 * @method sfGuardUserProfile setLastName()              Sets the current record's "last_name" value
 * @method sfGuardUserProfile setFirstName()             Sets the current record's "first_name" value
 * @method sfGuardUserProfile setPatronymic()            Sets the current record's "patronymic" value
 * @method sfGuardUserProfile setEmail()                 Sets the current record's "email" value
 * @method sfGuardUserProfile setValidate()              Sets the current record's "validate" value
 * @method sfGuardUserProfile setLoginAttempts()         Sets the current record's "login_attempts" value
 * @method sfGuardUserProfile setBlockedAt()             Sets the current record's "blocked_at" value
 * @method sfGuardUserProfile setForceChangePassword()   Sets the current record's "force_change_password" value
 * @method sfGuardUserProfile setUser()                  Sets the current record's "User" value
 * 
 * @package    Rentflot
 * @subpackage model
 * @author     Infosoft
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasesfGuardUserProfile extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_guard_user_profile');
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('last_name', 'string', 80, array(
             'type' => 'string',
             'length' => 80,
             ));
        $this->hasColumn('first_name', 'string', 80, array(
             'type' => 'string',
             'length' => 80,
             ));
        $this->hasColumn('patronymic', 'string', 80, array(
             'type' => 'string',
             'length' => 80,
             ));
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('validate', 'string', 32, array(
             'type' => 'string',
             'length' => 32,
             ));
        $this->hasColumn('login_attempts', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('blocked_at', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('force_change_password', 'boolean', null, array(
             'type' => 'boolean',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'cascade'));
    }
}