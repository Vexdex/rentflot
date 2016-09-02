<h1>Календарь</h1>

<form name="filter_calendar" id="filter_calendar" method="post"> 
  <?php echo $schedule_form_filter['month']->render(array('onchange' => 'document.filter_calendar.submit()')) ?>  
  <?php if ($schedule_form_filter['month']->hasError()): ?>            
    <div class="Error">&bull; <?php echo __($schedule_form_filter['month']->getError()->getMessageFormat(), $schedule_form_filter['month']->getError()->getArguments(), 'grid') ?></div>
  <?php endif ?>  

  <?php echo $schedule_form_filter['year']->render(array('onchange' => 'document.filter_calendar.submit()')) ?>
  <?php if ($schedule_form_filter['year']->hasError()): ?>            
    <div class="Error">&bull; <?php echo __($schedule_form_filter['year']->getError()->getMessageFormat(), $schedule_form_filter['year']->getError()->getArguments(), 'grid') ?></div>
  <?php endif ?>  
  
  <?php echo $schedule_form_filter['order_type_id']->render(array('onchange' => 'document.filter_calendar.submit()')) ?>  
  <?php if ($schedule_form_filter['order_type_id']->hasError()): ?>            
    <div class="Error">&bull; <?php echo __($schedule_form_filter['order_type_id']->getError()->getMessageFormat(), $schedule_form_filter['order_type_id']->getError()->getArguments(), 'grid') ?></div>
  <?php endif ?>  
  
  <?php echo $schedule_form_filter->renderHiddenFields() ?>
  <!-- <input type="submit" value="Показать" /> -->
</form>

<table cellspacing="0" style="width: 100%">
  <tr>
    <td><h2 style="margin-top: 1em"><?php echo __($calendar_data[0]['month'], null, 'calendar') ?> <?php echo  $calendar_data[0]['year'] ?></h2></td>
    <td style="text-align: right; font-size: 0.9em; vertical-align: bottom; padding-bottom: 3px"><span style="color: red">*</span> &mdash; заказы Рентфлот</span></td>
  </tr>
</table>

<table cellspacing="0" id="calendar-schedule">
  <?php $count_on_row = count($calendar_data[0]['days']) / 7; $count = 0; $j = 0; ?>
  <tr>    
    <th class="DayName" style="width: <?php echo $count_on_row ?>%"><?php echo __($days_data[0], null, 'calendar') ?></th>
    <?php foreach ($calendar_data[0]['days'] as $day): ?>
      <?php if ($count % $count_on_row == 0 && $count != 0): ?></tr><tr><th class="DayName" style="width: <?php echo $count_on_row ?>%"><?php ++$j; echo __($days_data[$j], null, 'calendar') ?></th><?php endif ?>                  
      <td class="Day <?php if ($j == 5 || $j == 6): ?>Holiday<?php endif ?> <?php echo $day['class'] ?>" style="width: <?php echo round(100/$count_on_row, 1)-1 ?>%">
        
        <table cellspacing="0" width="100%">
          <tr>
            <th class="DayNumber" onclick="document.location = '<?php echo url_for('order_new', array('date' => $day['year'].'-'.$day['month'].'-'.$day['day'])) ?>'" title="Добавить заказ на этот день"><?php echo $day['day'] ?></th>
          </tr>
          <tr>
            <td class="DayOrders">
              <?php if (isset($day['order_data'])): ?>
                <?php foreach ($day['order_data'] as $order): ?>
                  <div class="Order">                    
                    <?php if ($order['order']['order_owner_id'] == 1): ?><span style="color: red">*</span><?php endif ?><a
                      class="<?php if (count($order['items'])): ?>TipsyTooltip<?php endif ?>"
                      <?php if (count($order['items'])): ?>  title="<?php $i = 0; foreach ($order['items'] as $item): ?>
                        <?php echo ++$i ?>. <?php echo $item['internal_name'] ?> <?php echo format_price($item['amount_uah']) ?> грн. <br/>
                        <?php endforeach ?>
                        --<br />
                        Сумма: <?php echo format_price($order['amount_info']['amount_uah']) ?> грн.
                        <br />
                        Уже получили: <?php echo format_price($order['amount_info']['amount_total_payed_uah']) ?> грн.
                        <br />
                        Уже отдали: <?php echo format_price($order['amount_info']['amount_costs_payed_uah']) ?> грн."zz                    
                      <?php endif ?> 
                      href="<?php echo url_for('order_show', array('id' => $order['order']->getId())) ?>"><?php echo $order['title'] ?></a>
                    <nobr><span class="Time"><?php echo format_date($order['order']->getTimeFrom(), 'HH') ?><sup style="text-decoration: underline"><?php echo format_date($order['order']->getTimeFrom(), 'mm') ?></sup>-<?php echo format_date($order['order']->getTimeTo(), 'HH') ?><sup style="text-decoration: underline"><?php echo format_date($order['order']->getTimeTo(), 'mm') ?></sup></span></nobr>
                  </div>                                    
                <?php endforeach ?>
              <?php endif ?>
            </td>
          </tr>
        </table>        
      </td>
      <?php $count++ ?>
    <?php endforeach ?>
  </tr>
</table>