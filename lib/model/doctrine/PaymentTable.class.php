<?php

/**
 * PaymentTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PaymentTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PaymentTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Payment');
    }
}