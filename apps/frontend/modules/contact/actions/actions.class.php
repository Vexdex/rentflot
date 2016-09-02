<?php

require_once dirname(__FILE__).'/../lib/contactGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/contactGeneratorHelper.class.php';

/**
 * contact actions.
 *
 * @package    Rentflot
 * @subpackage contact
 * @author     Infosoft
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contactActions extends autoContactActions
{
	public function executeEdit(sfWebRequest $request)
	{
		$contact=$this->getRoute()->getObject();
		$client_contacts=Doctrine::getTable('ClientContact')->findByOrderId($contact->getOrderId());
		
		$this->otherContacts=$client_contacts;
		parent::executeEdit($request);
	}
  public function buildQuery()
  {
	$query = parent::buildQuery();
	$filters = $this->getFilters();
	
	if(!isset($filters["show_hidden_contracts"]) || $filters["show_hidden_contracts"]==0)
	{
		$rootAlias=$query->getRootAlias();
		$query
		->andWhere($rootAlias.'.contact_status_id=?',1);
	}
	return $query;
  }

}
