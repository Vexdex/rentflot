<?php
 
class calendarComponents extends sfComponents
{
  
  public function executeShortInfo($request)
  {    
    $data = calendar(2, getdate());
    $this->calendar_data = $data['calendar_data'];
    $this->days_data = $data['days_data'];    
  }

}