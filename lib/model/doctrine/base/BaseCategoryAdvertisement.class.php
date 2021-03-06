<?php

/**
 * BaseCategoryAdvertisement
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $category_id
 * @property integer $advertisement_id
 * @property Category $Category
 * @property Advertisement $Advertisement
 * 
 * @method integer               getCategoryId()       Returns the current record's "category_id" value
 * @method integer               getAdvertisementId()  Returns the current record's "advertisement_id" value
 * @method Category              getCategory()         Returns the current record's "Category" value
 * @method Advertisement         getAdvertisement()    Returns the current record's "Advertisement" value
 * @method CategoryAdvertisement setCategoryId()       Sets the current record's "category_id" value
 * @method CategoryAdvertisement setAdvertisementId()  Sets the current record's "advertisement_id" value
 * @method CategoryAdvertisement setCategory()         Sets the current record's "Category" value
 * @method CategoryAdvertisement setAdvertisement()    Sets the current record's "Advertisement" value
 * 
 * @package    Rentflot
 * @subpackage model
 * @author     Infosoft
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCategoryAdvertisement extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('category_advertisement');
        $this->hasColumn('category_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('advertisement_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Category', array(
             'local' => 'category_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Advertisement', array(
             'local' => 'advertisement_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}