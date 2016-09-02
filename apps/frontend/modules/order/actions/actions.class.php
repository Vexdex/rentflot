<?php

require_once dirname(__FILE__).'/../lib/orderGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/orderGeneratorHelper.class.php';

/**
 * order actions.
 *
 * @package    Rentflot
 * @subpackage order
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orderActions extends autoOrderActions
{

  protected function buildQuery()
  {
    $q = parent::buildQuery();

    $filters = $this->getFilters();

    if (!empty($filters['is_archived']))
    {
      $q->andWhere($q->getRootAlias().'.is_archived = ?', true);
    }
    else
    {
      $q->andWhere($q->getRootAlias().'.is_archived = ?', false);
    }

    return $q;
  }
 
  
  protected function executeBatchArchive(sfWebRequest $request)
	{
	  $ids = $request->getParameter('ids');
		
    $records = Doctrine_Query::create()
      ->from('Order')
      ->whereIn('id', $ids);
		
    /*    
    if (!$this->getUser()->getGuardUser()->hasPermission('manage_objects')) {
			$records = $records->andWhere('user_id = ?', $this->getUser()->getGuardUser()->getId());
		}
    */
		
		$records = $records->execute();
		
    foreach ($records as $record)
    {
      $record->setIsArchived(1);
    }
		
		$records->save();

    $this->getUser()->setFlash('custom_notice', 'archive_successfull');
    $this->redirect('order');
	}  

  protected function executeBatchDearchive(sfWebRequest $request)
	{
	  $ids = $request->getParameter('ids');
		
    $records = Doctrine_Query::create()
      ->from('Order')
      ->whereIn('id', $ids);
		
    /*    
    if (!$this->getUser()->getGuardUser()->hasPermission('manage_objects')) {
			$records = $records->andWhere('user_id = ?', $this->getUser()->getGuardUser()->getId());
		}
    */
		
		$records = $records->execute();
		
    foreach ($records as $record)
    {
      $record->setIsArchived(0);
    }
		
		$records->save();

    $this->getUser()->setFlash('custom_notice', 'dearchive_successfull'); // The selected items have been activeted successfully.
    $this->redirect('order');
	}  

  public function executePrintDocument(sfWebRequest $request)
  {
    $order_id = $request->getParameter('id');
    $this->doc_type = $request->getParameter('doc_type');    
    
    $this->forward404Unless(in_array($this->doc_type, sfConfig::get('app_document_types')));
    
    $this->order = Doctrine::getTable('Order')->findOneById($order_id);

    $this->forward404Unless($this->order);
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->order = $this->getRoute()->getObject();
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    $this->item_by_category_form = new ItemByCategoryForm();      

    parent::executeEdit($request);
  }
  
  public function executeUpdate(sfWebRequest $request)
  {
    $this->item_by_category_form = new ItemByCategoryForm();      

    parent::executeUpdate($request);
  }
  
  public function executeNew(sfWebRequest $request)
  {    
    $this->item_by_category_form = new ItemByCategoryForm();      

    parent::executeNew($request);
    
    $date = $request->getParameter('date');    
    if ($date && strtotime($date))
    {
      $this->form->getWidget('date')->setDefault($date);
    }    
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->item_by_category_form = new ItemByCategoryForm();      

    parent::executeCreate($request);
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    /* @var Order $order */

    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'create_successfull' : 'update_successfull';
      
      try
      {
        $order = $form->save();

		if(
			$request->getPostParameter("order[make_contact]") || 
			$request->getPostParameter("order[contact_date]")!="" ||
			$request->getPostParameter("order[comment]")!=""
		)
		{
			if(count($order->getClientContact())>0)
			{
				$all_c= $order->getClientContact();
				$contact = $all_c[0];
			}
			else
			{
				$contact = new ClientContact();
			}
			
			if(!$contact->isNew() && !$request->getPostParameter("order[make_contact]"))
			{
				$contact->delete();
			}
			else
			{			
				$contact->setOrderId($order->getId());
				if($request->getPostParameter("order[contact_date]")!="")
				{
					$dateTime = strtotime($request->getPostParameter("order[contact_date]"));
				}
				else
				{
					$dateTime = time();
				}
				$time=$request->getPostParameter("order[contact_time]");			
				$contact->setContactDate(date('Y.m.d '.$time['hour'].':'.$time['minute'].':00', $dateTime));
				$contact->setContactTime($time['hour'].':'.$time['minute']);
				$contact->setComment($request->getPostParameter("order[comment]"));
				$contact->setContactStatusId(1);
				$contact->save();
			}
		}
		
        // Удаление заказов
        $order_items_values = $form->getValue('order_item');

        if (!empty($order_items_values))
        {          
          foreach ($order_items_values as $order_item_values)
          {          
            if (!empty($order_item_values['delete'])) 
            {
              $order_item = Doctrine_Core::getTable('OrderItem')->findOneById($order_item_values['delete']); 
              if ($order_item)
              {
                $order_item->delete();      
              }
            }
          }
        }

      }
      catch (Doctrine_Exception $e)
      {
        if (strpos($e->getMessage(), 'Integrity constraint violation: 1062 Duplicate entry') !== false)
        {
          $message = 'Duplicate entry';
        }
        else
        {
          $errorStack = $form->getObject()->getErrorStack();

          $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
          foreach ($errorStack as $field => $errors)
          {
            $message .= "$field (" . implode(", ", $errors) . "), ";
          }
          $message = trim($message, ', ');
        }

        $this->getUser()->setFlash('error', $message);

        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $order)));
      
      // -- Log 
      $this->log(array('ids' => $order->getId()));     
      
      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.'_and_add');

        $this->redirect('@order_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        //$this->redirect(array('sf_route' => 'order', 'sf_subject' => $order));
        $this->redirect(array('sf_route' => 'order_show', 'sf_subject' => $order));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'save_error', false);
    }
  }

  // Ajax  
  public function executeCategoryByItem(sfWebRequest $request)
  {
    $this->forward404unless($request->isXmlHttpRequest());

    $item_id = intval($request->getParameter('item_id'));

    if ($item_id)
    {
      $item = Doctrine::getTable('Item')->findOneById($item_id);
      if ($item)
      {
        $categories = $item->getCategories();
        if ($categories->count() > 0)
        {
          return $this->renderText($categories[0]->getId());
        }
      }
    }

    return $this->renderText(false);
  }
  
  // Ajax  
  public function executeAddOrderItem(sfWebRequest $request)
  {
    $this->forward404unless($request->isXmlHttpRequest());
    
    $order_item_count = intval($request->getParameter('order_item_count'));
    $item_id = intval($request->getParameter('item_id'));
    $duration = $request->getParameter('duration');
            
    $order_form = new OrderForm();
    
    $order_item_forms = $order_form->addOrderItem(1, $order_item_count, $item_id, array('count_value' => $duration));
    $order_item_form = $order_item_forms[$order_item_count];

    return $this->renderPartial('form_order_item_short', array('order_item' => $order_item_form->getObject(), 'order_item_form' => $order_form['order_item_new'][$order_item_count], 'number' => $order_item_count));
  }
  
  public function executeShowByClient(sfWebRequest $request)
  {
	 //echo $request->getParameter('id_client');die;
	 $filters = $this->getFilters();
	 $filters["client_id"]=$request->getParameter('client_id');
	 
	 //$this->setTemplate('index');
	 $this->pager = new magicDoctrinePager('Order',50);
	 $this->setTemplate('index');
	 $objectsQuery = Doctrine_Query::create()
		->from('Order o')
		->where('o.client_id = ?',$request->getParameter('id_client'));
	 $this->pager->setQuery($objectsQuery);
	 		if ($request->getParameter('page'))
        {
          $this->pager->setPage($request->getParameter('page'));
        }
		$this->pager->init();
		$this->sort=array(array());
		$this->next_sort_type=array(array());
	 //parent::executeIndex($request);
  }
  
  /*
  public function executeIndex(sfWebRequest $request)
  {
	 //echo $request->getParameter('id_client');die;
	 $filters = $this->getFilters();
	 $filters["client_id"]=$request->getParameter('id_client');
	 parent::executeIndex($request);
  }*/
  

  // Ajax
  public function executeItemListByCategory(sfWebRequest $request)
	{    
    $this->forward404Unless($request->isXmlHttpRequest());

    $categoryId = intval($request->getParameter('category_id'));
    $itemsList = array();

    if ($categoryId)
    {
      $itemsListQuery = Doctrine_Query::create()
        ->select('i.id, it.name, u.name, i.price_uah')
        ->from('Item i')
        ->leftJoin('i.Translation it WITH it.lang = \''.$this->getUser()->getCulture().'\'')
        ->leftJoin('i.CategoryItem ct')
        ->leftJoin('i.UnitType u')
        ->where('ct.category_id = ?', $categoryId)
        ->andWhere('i.is_active = ?', true)
        ->orderBy('it.name');

      $tempItemsList = $itemsListQuery->fetchArray();

      foreach ($tempItemsList as $tempItem)
      {
        //$items_list[$temp_item['id']] =
        $itemsList[] = array($tempItem['id'], $tempItem['Translation'][$this->getUser()->getCulture()]['name'], $tempItem['UnitType']['name'], $tempItem['price_uah']);
      }

      if (empty($itemsList))
      {
        $itemsList = array('error' => 'not_found');
      }
    }

    return $this->renderText(json_encode($itemsList));
  }

  // Ajax
  public function executeShowOrderItemForm(sfWebRequest $request)
  {    
    //$this->forward404unless($request->isXmlHttpRequest());    
    //$relatives_count = intval($request->getParameter('relatives_count'));
    /*
    $order_item_form = new ItemByCategoryForm();
    $order_item_form->getWidgetSchema()->setNameFormat('%s');
    //$relative_form->addPhone(1, array());
    //$relatives_forms = array($relative_form);
    return $this->renderPartial('form_order_item', array('order_item_form' => $order_item_form)); 
    */
  }

  // Ajax
  public function executeSaveClientForm(sfWebRequest $request)
  {    
    $this->forward404unless($request->isXmlHttpRequest());
    
    $client_id = $request->getParameter('client_id');
    $is_new = $request->getParameter('is_new');
    
    $client = null;
    if (!$is_new && $client_id)
    {
      $client = Doctrine::getTable('Client')->findOneById($client_id);
    }
    
    $client_form = new ClientForm($client);  
    
    $client_form->getWidgetSchema()->setNameFormat('%s');

    $data = $request->getParameter('data');
    
    $client_form->bind($data);
        
    if ($client_form->isValid())
    {
      $client = $client_form->save();
      return $this->renderText(json_encode(array('client_id' => $client->getId(), 'org_name' => $client->getOrgName(), 'name' => $client->getName(), 'phones' => $client->getPhones())));
      
    }
    else
    {
      //return $this->renderPartial('form_client', array('client_form' => $client_form)); 
      $this->getContext()->getConfiguration()->loadHelpers('Partial');    
      $client_form_partial = get_partial('form_client', array('client_form' => $client_form));
      return $this->renderText(json_encode(array('client_form_partial' => $client_form_partial))); 
    }
  }

  // Ajax
  public function executeShowClientForm(sfWebRequest $request)
  {    
    $this->forward404unless($request->isXmlHttpRequest());

    $client_id = $request->getParameter('client_id');
    $is_new = $request->getParameter('is_new');
    
    $client = null;
    if (!$is_new && $client_id)
    {
      $client = Doctrine::getTable('Client')->findOneById($client_id);
    }
    
    $client_form = new ClientForm($client);  
    
    $client_form->getWidgetSchema()->setNameFormat('%s');
    
    return $this->renderPartial('form_client', array('client_form' => $client_form));
  }

}
