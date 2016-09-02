<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfValidatorSchemaCompare compares several values from an array.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfValidatorSchemaCompare.class.php 21908 2009-09-11 12:06:21Z fabien $
 */
class magicPasswordValidatorSchemaCompare extends sfValidatorSchemaCompare
{

  /**
   * Constructor.
   *
   * Available options:
   *
   *  * left_field:         The left field name
   *  * operator:           The comparison operator
   *                          * self::EQUAL
   *                          * self::NOT_EQUAL
   *                          * self::IDENTICAL
   *                          * self::NOT_IDENTICAL
   *                          * self::LESS_THAN
   *                          * self::LESS_THAN_EQUAL
   *                          * self::GREATER_THAN
   *                          * self::GREATER_THAN_EQUAL
   *  * right_field:        The right field name
   *  * throw_global_error: Whether to throw a global error (false by default) or an error tied to the left field
   *
   * @param string $leftField   The left field name
   * @param string $operator    The operator to apply
   * @param string $rightField  The right field name
   * @param array  $options     An array of options
   * @param array  $messages    An array of error messages
   *
   * @see sfValidatorBase
   */

   
  /**
   * @see sfValidatorBase
   */
  protected function doClean($values)
  {
    
    //vardump($values);
    
    if (null === $values)
    {
      $values = array();
    }

    if (!is_array($values))
    {
      throw new InvalidArgumentException('You must pass an array parameter to the clean() method');
    }

    $leftValue  = isset($values[$this->getOption('left_field')]) ? $values[$this->getOption('left_field')] : null;
    
    if (!$leftValue) 
    {
      return $values;
    }
    
    return parent::doClean($values);
  }

}
