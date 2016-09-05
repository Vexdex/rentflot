<?php

/**
 * Order form.
 *
 * @package    Rentflot
 * @subpackage form
 * @author     Infosoft
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OrderForm extends BaseOrderForm
{
  public function configure()
  {
    parent::configure();
    
    unset($this['items_list'], $this['user_id'], $this['created_by'], $this['updated_by']);
    
    $this->embedRelation('OrderItems as order_item');       
    
    // 2016/09/03 vexdex before
    // $this->widgetSchema['date']->setDefault(date('Y-m-d'));
    // 2016/09/03 vexdex after [    
    $this->widgetSchema['date'] = new sfWidgetFormMagicJQueryDate(array(	  
                'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
                'config' => '{changeYear: true, changeMonth: true}',
                'culture' => sfContext::getInstance()->getUser()->getCulture())); 
    // 2016/09/03 vexdex after ]
    
    $minutes = range(0, 59, 10);
    $minute_keys = array();
    foreach ($minutes as $minute)
    {
      $minute_keys[] = sprintf("%02d", $minute);
    }

    $this->widgetSchema['time_from'] = new sfWidgetFormTime(array('can_be_empty' => false, 'format_without_seconds' => '%hour% : %minute%', 'minutes' => array_combine($minutes, $minute_keys)));
    $this->validatorSchema['time_from'] = new sfValidatorTime(array());
    
    $this->widgetSchema['time_to'] = new sfWidgetFormTime(array('can_be_empty' => false, 'format_without_seconds' => '%hour% : %minute%', 'minutes' => array_combine($minutes, $minute_keys)));
    $this->validatorSchema['time_to'] = new sfValidatorTime(array());
    
    /*
    $this->widgetSchema['duration'] = new sfWidgetFormTime(array('format_without_seconds' => '%hour% часов %minute% минут'));
    $this->validatorSchema['duration'] = new sfValidatorTime(array());
    */
    
    //org_name, name
    /*
    $this->widgetSchema['client_id'] = new sfWidgetFormDoctrineChoice(array(
      'model' => $this->getRelatedModelName('Client'), 
      'query' => Doctrine_Query::create()
        ->from('Client c')
        ->orderBy('c.org_name')
        ->addOrderBy('c.name'),
      'add_empty' => true
    ));*/
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


    
    
    $this->validatorSchema['client_id'] = new sfValidatorInteger(array('required' => true));

    $this->widgetSchema['order_owner_id']->setOption('add_empty', false);

    $this->validatorSchema->setPostValidator(new rfValidatorCrossTimeItems(array('order_id' => $this->getObject()->getId())));

    $this->widgetSchema->setNameFormat('order[%s]');
	
	//CRM functionality
	$this->widgetSchema['make_contact'] = new sfWidgetFormInputCheckbox();
    $this->validatorSchema['make_contact'] = new sfValidatorBoolean(array('required' => false));
	$this->widgetSchema['contact_date'] = new sfWidgetFormMagicJQueryDate(array(	  
            'date_widget' => new sfWidgetFormMagicDate(array('can_be_empty' => false)),
            'config' => '{changeYear: true, changeMonth: true}',
            'culture' => sfContext::getInstance()->getUser()->getCulture()));
	$this->validatorSchema['contact_date'] = new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00'));
	$this->widgetSchema['comment'] = new sfWidgetFormTextarea();
    $this->validatorSchema['comment'] = new sfValidatorString(array('required' => false, 'max_length' => 4000));	
		
	$minutes = range(0, 59, 5);
    $minute_keys = array();
    foreach ($minutes as $minute)
    {
        $minute_keys[] = sprintf("%02d", $minute);
    }
	$this->widgetSchema['contact_time'] = new sfWidgetFormTime(array('can_be_empty' => false, 'format_without_seconds' => '%hour% : %minute%', 'minutes' => array_combine($minutes, $minute_keys)));
    $this->validatorSchema['contact_time'] = new sfValidatorTime(array('required' => false));
	$this->setDefault('contact_time', '14:00');
	
	if(count($this->getObject()->getClientContact())>0)
	{
		$all_c=$this->getObject()->getClientContact();
		$this->setDefault('contact_time', $all_c[0]->getContactTime());
		$this->setDefault('make_contact', 'checked');
		$this->setDefault('contact_date', $all_c[0]->getContactDate());
		$this->setDefault('comment', $all_c[0]->getComment());
	}
	//Array ( [hour] => 12 [minute] => 25 ) 
  }
  
  public function addOrderItem($order_item_count, $order_item_exists_count, $item_id = null, $default = null)
  {
    $new_order_item_forms = new BaseForm(); 
    $form_collection = array();    
    for($i = $order_item_exists_count; $i < $order_item_exists_count + $order_item_count; $i++)
    {
      $order_item = new OrderItem();
      if (!empty($item_id))
      {
        $order_item->setItemId($item_id);
      }
      $order_item->setOrder($this->getObject());
      $order_item_form = new OrderItemForm($order_item);
      
      $order_item_form->setDefault('price_uah', $order_item->getItem()->getPriceUah());

      $count_data = explode(':', $default['count_value']);
      $count = 0;
      if ($order_item->getItem()->getUnitTypeId() == 1 && isset($count_data[0]) && isset($count_data[1]))
      {
         //$order_item_form->setDefault('count', number_format(round(intval($count_data[0]) + intval($count_data[1]) / 60, 2), 2, '.', ''));
         $count = round(intval($count_data[0]) + intval($count_data[1]) / 60, 2);
      }
      
      if ($order_item->getItem()->getCommissionPercent())
      {
        $amount_costs_uah = round($order_item->getItem()->getPriceUah() * $count * (1 - $order_item->getItem()->getCommissionPercent() / 100), 2);
        $order_item_form->setDefault('amount_costs_uah', $amount_costs_uah);
      }
      
      $order_item_categories = $order_item->getItem()->getCategories();
      foreach ($order_item_categories as $order_item_category)
      {
        if (in_array($order_item_category->getId(), sfConfig::get('app_category_motor_ships')))
        {
          if ($count)
          {
            $order_item_form->setDefault('count', number_format($count, 2, '.', ''));            
          }
        }
      }
            
      if (isset($default[$i])) 
      {
        foreach($default[$i] as $key => $value)
        {
          $order_item_form->setDefault($key, $value);
        }
      }      
      $form_collection[$i] = $order_item_form;
      $new_order_item_forms->embedForm($i, $order_item_form);      
    }        
    $this->embedForm('order_item_new', $new_order_item_forms);    
    return $form_collection;    
  }    

  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {   
    if (!empty($taintedValues['order_item_new']))
    {
      $new_item_order_forms = new BaseForm();      
      foreach($taintedValues['order_item_new'] as $key => $value)
      {
        $item_order = new OrderItem();
        $item_order->setOrder($this->getObject());
        $item_order_form = new OrderItemForm($item_order);
        $new_item_order_forms->embedForm($key, $item_order_form);
      }
      $this->embedForm('order_item_new', $new_item_order_forms);
    }
    parent::bind($taintedValues, $taintedFiles);
  }  

  public function updateObject($values = null)
  {   
		$order = parent::updateObject($values);
    $order->setUpdatedAt(date('Y-m-d H:i:s'));
		
    return $order;
  }	  

}
