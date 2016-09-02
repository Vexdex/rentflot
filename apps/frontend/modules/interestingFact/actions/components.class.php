<?php
 
 
class interestingFactComponents extends sfComponents
{
  public function executeRandom(sfWebRequest $request)
  {    

    if (!$this->getUser()->hasAttribute('InterestingFact')) 
    {
			$this->getUser()->setAttribute('InterestingFact', array()); 
		}
		
    if (!$this->getUser()->hasAttribute('InterestingFactLastShip')) 
    {
			$this->getUser()->setAttribute('InterestingFactLastShip', -1);
		}
		
    $smart_content = $this->getUser()->getAttribute('InterestingFact');
    $smart_content_last_ship = $this->getUser()->getAttribute('InterestingFactLastShip');
		
    $data = sfConfig::get('app_interesting_facts_data');
    $keys = array_keys($data);
		$size = sizeOf($keys);

		$ship = rand(0, $size - 1);
		while(in_array($ship, $smart_content) || (empty($smart_content) && $smart_content_last_ship == $ship)) 
    {
      $ship = rand(0, $size - 1);
		}
		
		$smart_content[] = $ship;
    $this->getUser()->setAttribute('InterestingFact', $smart_content); 
    $smart_content = $this->getUser()->getAttribute('InterestingFact');
    
    if (count($smart_content) == $size) 
    {
			$this->getUser()->setAttribute('InterestingFact', array());
      $this->getUser()->setAttribute('InterestingFactLastShip',  $ship);
		}    
    
    $this->interesting_fact_key = $data[$ship];
  }
}