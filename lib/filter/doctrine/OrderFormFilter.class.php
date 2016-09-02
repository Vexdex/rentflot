<?php

/**
 * Order filter form.
 *
 * @package    Rentflot
 * @subpackage filter
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OrderFormFilter extends BaseOrderFormFilter
{
  public function configure()
  {
    parent::configure();
    
    $this->widgetSchema['id'] = new sfWidgetFormInput();
    $this->validatorSchema['id'] = new sfValidatorInteger(array('required' => false));

/*
    $this->widgetSchema['client_id'] = new sfWidgetFormDoctrineChoice(array(
      'model' => $this->getRelatedModelName('Client'), 
      'query' => Doctrine_Query::create()
        ->from('Client c')
        ->orderBy('c.org_name')
        ->addOrderBy('c.name'),
      'add_empty' => true
    ));
*/
    $clients_no_hydration = Doctrine_Query::create()
                                ->select("id, org_name, name, phones")
                                                            ->from('client c')
                                                                                        ->execute(array(), Doctrine::HYDRATE_ARRAY);
                                                                                            $clients_list=array(null=>'');
                                                                                                for($i=0;$i<count($clients_no_hydration);$i++)
                                                                                                    {
                                                                                                          $clients_list[$clients_no_hydration[$i]["id"]]=
                                                                                                                  (($clients_no_hydration[$i]["org_name"]=="")?(""):($clients_no_hydration[$i]["org_name"].", ")).
                                                                                                                          $clients_no_hydration[$i]["name"].
                                                                                                                                  (($clients_no_hydration[$i]["phones"]=="")?(""):(", ".$clients_no_hydration[$i]["phones"]));
                                                                                                                                      }
                                                                                                                                          $this->widgetSchema['client_id'] = new sfWidgetFormChoice(array('choices' => $clients_list));    
    
    
    
    
    $this->widgetSchema['category_id'] = new sfWidgetFormDoctrineChoice(array(
      'model' => 'Category',
      'query' => Doctrine::getTable('Category')->createQuery('c')
        ->leftJoin('c.Translation t WITH t.lang = \''.sfContext::getInstance()->getUser()->getCulture().'\'')
        ->orderBy('c.order'),
      'add_empty' => true
    ));

    $this->validatorSchema['category_id'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema['item_id'] = new magicWidgetFormChoiceWithHidden(array('choices' => array()));
    $this->validatorSchema['item_id'] = new sfValidatorPass(array('required' => false));
    
    $this->widgetSchema['is_archived'] = new sfWidgetFormInputCheckbox();
    $this->validatorSchema['is_archived'] = new sfValidatorBoolean();
    
    $this->widgetSchema['client_phone'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['client_phone'] = new sfValidatorPass(array('required' => false));
  }
  
  protected function addIsArchivedColumnQuery($q, $element, $value) 
  {
    return $q;
  }

  protected function addIdColumnQuery($q, $element, $value)
  {
    if ($value)
    {
      $q->andWhere($q->getRootAlias().'.id = ?', $value);
    }

    return $q;
  }

  protected function addCategoryIdColumnQuery($q, $element, $value)
  {
    if ($value)
    {
      $itemsIds = Doctrine_Query::create()
        ->select('ci.item_id')
        ->from('CategoryItem ci')
        ->where('ci.category_id = ?', $value)
        ->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);

      if ($itemsIds)
      {
        $q->andWhereIn($q->getRootAlias().'.OrderItems.item_id', $itemsIds);
      }
      else
      {
        $q->andWhere('FALSE');
      }
    }
    return $q;
  }

  protected function addItemIdColumnQuery($q, $element, $value)
  {
    if ($value)
    {
      $q->andWhere($q->getRootAlias().'.OrderItems.item_id = ?', $value);
    }
    return $q;
  }

  protected function addClientPhoneColumnQuery($q, $element, $value) 
  {
    if (!empty($value['text']))
    {
      $q->andWhere($q->getRootAlias().'.Client.phones LIKE ?', '%'.$value['text'].'%');      
    }    
    return $q;
  }

  protected function addOrderTypeIdColumnQuery($q, $element, $value)
  {
    if ($value)
    {
      // РФ
      if ($value == 1 || $value == 2)
      {
        $q->andWhere($q->getRootAlias() . '.order_owner_id = ?', 1);
      }
      // Другие
      elseif ($value == 3 || $value == 4)
      {
        $q->andWhere($q->getRootAlias() . '.order_owner_id = ?', 2);
      }

      // 100%
      if ($value == 1 || $value == 3)
      {
        $q->leftJoin($q->getRootAlias() . '.OrderItems oi5 WITH oi5.status_id = ? OR oi5.status_id = ?', array(1, 2));
        $q->andWhere('oi5.id IS NULL');
      }

      // 50%
      if ($value == 2 || $value == 4)
      {
        $orderQuery = Doctrine_Query::create()
         ->select('o1.id')
         ->from('Order o1')
         ->leftJoin('o1.OrderItems oic1 WITH oic1.status_id = 1')
         ->leftJoin('o1.OrderItems oic2 WITH oic2.status_id = 2')
         ->leftJoin('o1.OrderItems oic3 WITH oic3.status_id = 3')
         ->andWhere('oic2.id IS NOT NULL OR (oic1.id IS NOT NULL AND oic3.id IS NOT NULL)');

        $orderIds = array();
        foreach ($orderQuery->fetchArray() as $order_id)
        {
          $orderIds[] = $order_id['id'];
        }

        $q->andWhereIn($q->getRootAlias().'.id', $orderIds);
      }

      // 0%
      if ($value == 5)
      {
        $q->leftJoin($q->getRootAlias() . '.OrderItems oi5 WITH oi5.status_id = ? OR oi5.status_id = ?', array(2, 3));
        $q->andWhere('oi5.id IS NULL');
      }
    }

    return $q;
  }


}
