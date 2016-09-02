[?php

/**
 * Project filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{

  protected function addNumberQuery(Doctrine_Query $q, $field, $values)
  {
    
    $root_alias = $q->getRootAlias();
    $field_name = $this->getFieldName($field);
    
    if (isset($values['is_empty']) && $values['is_empty']) {
      $q->addWhere($root_alias.'.'.$field_name.' IS NULL');
    } else {
        if (!empty($values['from'])) {         
          $q->andWhere($root_alias.'.'.$field_name.'>= ?', $values['from']);
        }    

        if (!empty($values['to'])) {         
          $q->andWhere($root_alias.'.'.$field_name.'<= ?', $values['to']);    
        }
        
        if (!empty($values['text'])) {         
          $q->andWhere($root_alias.'.'.$field_name.'= ?', $values['text']);    
        }
        
      }        
  }


  public function setup()
  {
  }
}
