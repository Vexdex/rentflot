<tr id="order_item_form_<?php echo $order_item->isNew() ? 'new_' : '' ?><?php echo $number ?>" name="order_item_form_<?php echo $number ?>">
  <!-- <td style="width: 1%" class="order_item_number">
    <?php if (!$order_item->isNew()): ?><?php echo $number + 1 ?><?php endif ?>
  </td> -->
  <td style="width: 1%; padding-top: 1px" class="OrderItemStatus">
    <?php echo include_partial('form_order_item_status_id', array('status_id' => $order_item_form['status_id'])) ?>
  </td>
  <td style="width: 22%; text-align: left;" id="order_item_form_<?php echo $order_item->isNew() ? 'new_' : '' ?><?php echo $number ?>_item_id">
    <?php /* <nobr><a href="<?php echo url_for('item_show', array('id' => $order_item_form['item_id']->getValue())) ?>" class="extern" target="_blank"><?php echo $order_item_form['item_id']->render(array('class' => 'order_item_id')) ?></a>&nbsp;<img class="Link" src="/magicLibsPlugin/images/edit.png" onclick="show_item_by_category_form('update', 'order_item_form_<?php echo $order_item->isNew() ? 'new_' : '' ?><?php echo $number ?>')" /></nobr> */ ?>
    <nobr><?php echo $order_item_form['item_id']->render(array('class' => 'order_item_id')) ?>&nbsp;<img class="Link" src="/magicLibsPlugin/images/edit.png" onclick="show_item_by_category_form('update', 'order_item_form_<?php echo $order_item->isNew() ? 'new_' : '' ?><?php echo $number ?>')" /></nobr>
    <?php if ($order_item_form['item_id']->hasError()): ?>
      <div class="Error">&bull; <?php echo __($order_item_form['item_id']->getError()->getMessageFormat(), $order_item_form['item_id']->getError()->getArguments(), 'grid') ?></div>
    <?php endif ?>
  </td>
  <td style="width: 1%">
    <?php echo $order_item_form['count']->render(array('class' => 'order_item_count')) ?> <span class="order_item_unit_type comment"><?php echo $order_item->getItem()->getUnitType() ?></span>
    <?php if ($order_item_form['count']->hasError()): ?>            
      <div class="Error">&bull; <?php echo __($order_item_form['count']->getError()->getMessageFormat(), $order_item_form['count']->getError()->getArguments(), 'grid') ?></div>
    <?php endif ?>
  </td>
  <td style="width: 8%">
    <?php echo $order_item_form['price_uah']->render(array('class' => 'order_item_price_uah')) ?>
    <?php if ($order_item_form['price_uah']->hasError()): ?>            
      <div class="Error">&bull; <?php echo __($order_item_form['price_uah']->getError()->getMessageFormat(), $order_item_form['price_uah']->getError()->getArguments(), 'grid') ?></div>
    <?php endif ?>
  </td>
  <td style="width: 8%">
    <input type="text" class="order_item_amount_uah" />
    <!--
    <?php //echo $order_item_form['amount_uah'] ?>
    <?php //if ($order_item_form['amount_uah']->hasError()): ?>            
      <div class="Error">&bull; <?php //echo __($order_item_form['amount_uah']->getError()->getMessageFormat(), $order_item_form['amount_uah']->getError()->getArguments(), 'grid') ?></div>
    <?php //endif ?>
    -->
  </td>
  <td style="width: 8%" class="AmountPayedUah">
    <?php echo $order_item_form['amount_payed_uah']->render(array('class' => 'order_item_amount_payed_uah')) ?>
    <?php if ($order_item_form['amount_payed_uah']->hasError()): ?>            
      <div class="Error">&bull; <?php echo __($order_item_form['amount_payed_uah']->getError()->getMessageFormat(), $order_item_form['amount_payed_uah']->getError()->getArguments(), 'grid') ?></div>
    <?php endif ?>
  </td>  
  <td style="width: 8%" class="AmountPayedUah">
    <?php echo $order_item_form['amount_payed_bank_uah']->render(array('class' => 'order_item_amount_payed_bank_uah')) ?>
    <?php if ($order_item_form['amount_payed_bank_uah']->hasError()): ?>            
      <div class="Error">&bull; <?php echo __($order_item_form['amount_payed_bank_uah']->getError()->getMessageFormat(), $order_item_form['amount_payed_bank_uah']->getError()->getArguments(), 'grid') ?></div>
    <?php endif ?>
  </td>  
  <td class="admin_info" style="width: 8%">
    <span class="order_item_amount_left_uah"></span>
  </td>    
  <td class="admin_info" style="width: 9%">    
    <?php echo $order_item_form['amount_costs_uah']->render(array('class' => 'order_item_amount_costs_uah')) ?>
    <?php if ($order_item->getItem()->getCommissionPercent()): ?>
      <br/><span class="order_item_commision_percent_link comment" title="Пересчитать">Аг. <?php echo format_price($order_item->getItem()->getCommissionPercent()) ?>%</span>
      <input type="hidden" class="order_item_commision_percent" value="<?php echo $order_item->getItem()->getCommissionPercent() ?>" />
    <?php endif ?>
    <?php if ($order_item_form['amount_costs_uah']->hasError()): ?>            
      <div class="Error">&bull; <?php echo __($order_item_form['amount_costs_uah']->getError()->getMessageFormat(), $order_item_form['amount_costs_uah']->getError()->getArguments(), 'grid') ?></div>
    <?php endif ?>
  </td>  
  <td class="admin_info CostsPayedUah" style="width: 9%">
    <?php echo $order_item_form['amount_costs_payed_uah']->render(array('class' => 'order_item_amount_costs_payed_uah')) ?>
    <?php if ($order_item_form['amount_costs_payed_uah']->hasError()): ?>            
      <div class="Error">&bull; <?php echo __($order_item_form['amount_costs_payed_uah']->getError()->getMessageFormat(), $order_item_form['amount_costs_payed_uah']->getError()->getArguments(), 'grid') ?></div>
    <?php endif ?>
  </td>
  <td class="admin_info" style="width: 8%">
    <span class="order_item_amount_costs_left_uah"></span>
  </td>      
  <td class="admin_info" style="width: 8%">
    <span class="order_item_profit_uah"></span>
  </td>    
  <td style="text-align: center; width: 1%">
    <?php if (!$order_item->isNew()): ?>
      <?php echo $order_item_form['delete']->render(array('value' => $order_item->getId())) ?>
      <?php else: ?>
        <?php echo image_tag('/magicLibsPlugin/images/delete.png', 'id="delete_new" onclick="delete_new_form(\'order_item_form_'.(($order_item->isNew() ? 'new_' : '').$number).'\'); return false;" class="Pointer" title="Удалить"') ?> <br/>                            
    <?php endif ?>      
  </td>
</tr>