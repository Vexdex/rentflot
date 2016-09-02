<table cellspacing="0" id="infosoft_grid">
  <tr>
    <td style="padding: 0 2px 3px 2px; vertical-align: top;">
      <form name="reports_form_filter" id="reports_form_filter" method="get">
        <table cellspacing="0" class="Filters">
          <tr>
            <th colspan="2"><span>Фильтр</span></th>
          </tr>  
          <tr>
            <td class="FilterName"><?php echo __('filter_item_id', null, 'reports') ?>:</td>      
            <td class="FilterValue">   
              <?php echo $reports_form_filter['item_id'] ?>              
              <?php if ($reports_form_filter['item_id']->hasError()): ?>
                <ul class="ValidatorError"><li><?php echo __($reports_form_filter['item_id']->getError()->getMessageFormat(), $reports_form_filter['item_id']->getError()->getArguments(), 'grid') ?></li></ul>  
              <?php endif ?>
              <div class="Help">Для выбора нескольких позиций удерживайте клавишу Ctrl и затем производите выбор</div>
            </td>
          </tr>
          <tr>
            <td class="FilterName"><?php echo __('filter_owner_id', null, 'reports') ?>:</td>
            <td class="FilterValue">
              <?php echo $reports_form_filter['owner_id'] ?>
              <?php if ($reports_form_filter['owner_id']->hasError()): ?>
              <ul class="ValidatorError"><li><?php echo __($reports_form_filter['owner_id']->getError()->getMessageFormat(), $reports_form_filter['owner_id']->getError()->getArguments(), 'grid') ?></li></ul>
              <?php endif ?>
            </td>
          </tr>
          <tr>
            <td class="FilterName"><?php echo __('filter_date', null, 'reports') ?>:</td>      
            <td class="FilterValue">   
              <?php echo $reports_form_filter['date'] ?>              
              <?php if ($reports_form_filter['date']->hasError()): ?>
                <ul class="ValidatorError"><li><?php echo __($reports_form_filter['date']->getError()->getMessageFormat(), $reports_form_filter['date']->getError()->getArguments(), 'grid') ?></li></ul>  
              <?php endif ?>                                  
            </td>
          </tr>          
          <tr>
            <td class="FilterName"><?php echo __('filter_order_type_id', null, 'reports') ?>:</td>      
            <td class="FilterValue">   
              <?php echo $reports_form_filter['order_type_id'] ?>              
              <?php if ($reports_form_filter['order_type_id']->hasError()): ?>
                <ul class="ValidatorError"><li><?php echo __($reports_form_filter['order_type_id']->getError()->getMessageFormat(), $reports_form_filter['order_type_id']->getError()->getArguments(), 'grid') ?></li></ul>  
              <?php endif ?>                                  
            </td>
          </tr>
          <tr>
            <td class="FilterName"><?php echo __('filter_catering_type', null, 'reports') ?>:</td>      
            <td class="FilterValue">   
              <?php echo $reports_form_filter['catering_type'] ?>
              <?php if ($reports_form_filter['catering_type']->hasError()): ?>
                <ul class="ValidatorError"><li><?php echo __($reports_form_filter['catering_type']->getError()->getMessageFormat(), $reports_form_filter['catering_type']->getError()->getArguments(), 'grid') ?></li></ul>  
              <?php endif ?>                                                
            </td>
          </tr>          
          <tr>
            <td class="FilterName"><?php echo __('filter_is_amount_costs_left_uah', null, 'reports') ?>:</td>      
            <td class="FilterValue">   
              <?php echo $reports_form_filter['is_amount_costs_left_uah'] ?>
              <?php if ($reports_form_filter['is_amount_costs_left_uah']->hasError()): ?>
                <ul class="ValidatorError"><li><?php echo __($reports_form_filter['is_amount_costs_left_uah']->getError()->getMessageFormat(), $reports_form_filter['is_amount_costs_left_uah']->getError()->getArguments(), 'grid') ?></li></ul>  
              <?php endif ?>                                                              
            </td>
          </tr>                    
          <tr>
            <td class="FilterName"><?php echo __('filter_is_amount_left_uah', null, 'reports') ?>:</td>      
            <td class="FilterValue">   
              <?php echo $reports_form_filter['is_amount_left_uah'] ?>
              <?php if ($reports_form_filter['is_amount_left_uah']->hasError()): ?>
                <ul class="ValidatorError"><li><?php echo __($reports_form_filter['is_amount_left_uah']->getError()->getMessageFormat(), $reports_form_filter['is_amount_left_uah']->getError()->getArguments(), 'grid') ?></li></ul>  
              <?php endif ?>                                                              
            </td>
          </tr>                              
          <tr>
            <td class="FilterName"><?php echo __('filter_is_motor_ship', null, 'reports') ?>:</td>      
            <td class="FilterValue">   
              <?php echo $reports_form_filter['is_motor_ship'] ?>
              <?php if ($reports_form_filter['is_motor_ship']->hasError()): ?>
                <ul class="ValidatorError"><li><?php echo __($reports_form_filter['is_motor_ship']->getError()->getMessageFormat(), $reports_form_filter['is_motor_ship']->getError()->getArguments(), 'grid') ?></li></ul>  
              <?php endif ?>                                                              
            </td>
          </tr>                              
          <tr>
            <td colspan="2" style="text-align: center">
              <input type="submit" value="OK" />              
              <?php echo link_to(__('filter_reset', array(), 'grid'), 'report_motor_ship_bills') ?>
              <?php //echo $reports_form_filter->renderHiddenFields() ?>
            </td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
