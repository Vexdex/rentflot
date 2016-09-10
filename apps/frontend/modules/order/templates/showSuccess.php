<?php /* @var Order $order */ ?>

<?php use_helper('I18N', 'Date') ?>
<?php include_partial('order/assets') ?>

<h1><?php echo __('page_show_title', array(), 'order') ?></h1>

<table cellspacing="0" id="infosoft_grid" style="width: 100%">
  <?php if ($sf_user->hasFlash('notice') || $sf_user->hasFlash('error') || $sf_user->hasFlash('error') || $sf_user->hasFlash('custom_error')): ?>
    <tr>
      <td>
        <?php include_partial('order/flashes') ?>
      </td>
    </tr>
  <?php endif; ?>
  <tr>
    <td>
      <table cellspacing="0" class="GridForm">
        <tr>
          <th><?php echo __('form_id', array(), 'order') ?>:</th>
          <td><?php echo $order->getId() ?></td>
        </tr>                  
        <tr>
          <th><?php echo __('form_is_archived', array(), 'order') ?>:</th>
          <td><?php if ($order->getIsArchived()): ?>Да<?php else: ?>Нет<?php endif ?></td>
        </tr>
        <tr>
          <th><?php echo __('form_order_status', array(), 'order') ?>:</th>
          <td><?php echo $order->getStatus() ?> (<?php echo $order->getOrderOwner() ?>)</td>
        </tr>            
        <tr>
          <th><?php echo __('form_date', array(), 'order') ?>:</th>
          <td><?php echo format_date($order->getDate(), 'dd.MM.yyyy') ?></td>
        </tr>
        <tr>
          <th><?php echo __('form_time_from', array(), 'order') ?>:</th>
          <td><?php echo format_date($order->getTimeFrom(), 'HH:mm') ?></td>
        </tr>    
        <tr>
          <th><?php echo __('form_time_to', array(), 'order') ?>:</th>
          <td><?php echo format_date($order->getTimeTo(), 'HH:mm') ?></td>
        </tr>  
        <tr>
          <th><?php echo __('form_duration', array(), 'order') ?>:</th>
          <td>
            <?php $duration = time_diff($order->getTimeFrom(), $order->getTimeTo()); ?>
            <?php if ($duration): ?>
              <?php echo sprintf('%02d:%02d', $duration['hours'], $duration['minutes']) ?>
            <?php endif ?>
          </td>
        </tr>  
        <tr>
          <th><?php echo __('form_client_id', array(), 'order') ?>:</th>
          <td>
            <?php if ($order->getClient()): ?>           
              <?php echo link_to($order->getClient()->getFullName(), 'client_edit', array('id' => $order->getClient()->getId())) ?>
              <?php if ($order->getClient()->getPhones()): ?>
                <br/>
                <?php echo str_replace("\n", '<br />', $order->getClient()->getPhones()) ?>
              <?php endif ?>
              <?php if ($order->getClient()->getEmail()): ?>
                <br/>
                <a href="<?php echo 'mailto:' . $order->getClient()->getEmail() ?>"><?php echo $order->getClient()->getEmail() ?></a>
              <?php endif ?>
            <?php endif ?>
          </td>
        </tr>
        <tr>
          <th><?php echo __('form_people_count', array(), 'order') ?>:</th>
          <td><?php echo $order->getPeopleCount() ?></td>
        </tr>
        <tr>
          <th><?php echo __('pier', array(), 'order') ?>:</th>
          <td><?php echo nl2br($order->getPier()) ?></td>
        </tr>
        <tr>
          <th><?php echo __('form_additional_information', array(), 'order') ?>:</th>
          <td><?php echo nl2br($order->getAdditionalInformation()) ?></td>
        </tr>
          <tr>
              <th><?php echo __('form_client_information', array(), 'order') ?>:</th>
              <td ><?php echo nl2br($order->getClientInformation()) ?></td>
          </tr>
		<?php if(count($order->getClientContact())>0): ?>
        <tr>
          <th><?php echo __('form_contact_comment', array(), 'order') ?>:<br/>
		  <?php $all_c=$order->getClientContact(); echo date('d.m.y',strtotime($all_c[0]->getContactDate()))?>
		  &nbsp;&nbsp;&nbsp;&nbsp;
		  <?php $all_c=$order->getClientContact(); echo date('H:i',strtotime($all_c[0]->getContactTime()))?>
		  </th>
          <td><?php $cont=$order->getClientContact(); echo nl2br($cont[0]->getComment()) ?></td>
        </tr>		
		<?php endif ?>		
        <?php if ($order->getOrderOwnerId() == 1): ?>
          <tr>
            <th><?php echo __('form_spd_id', array(), 'order') ?>:</th>
            <td><?php echo $order->getSpd() ?></td>
          </tr>
        <?php endif ?>
        <tr>
          <th><?php echo __('form_created_by', array(), 'order') ?>:</th>
          <td><?php echo $order->relatedExists('Creator') ? $order->getCreator()->getName().',' : '' ?> <?php echo format_date($order->getCreatedAt(), 'dd.MM.yyyy, H:mm') ?></td>
        </tr>
        <?php if ($order->getCreatedAt() != $order->getUpdatedAt()): ?>
        <tr>
          <th><?php echo __('form_updated_by', array(), 'order') ?>:</th>
          <td><?php      
           echo  $order->relatedExists('Updator') ? "<strong>последнее изменение: " . $order->getUpdator()->getName() : '?' ?>, <?php echo format_date($order->getUpdatedAt(), 'dd.MM.yyyy, H:mm') . "</strong><br>";
            
            // 2016 09 10 vexdex after [
            foreach ($recordsList as $actions) {
                echo preg_replace("/[\s]\(.*?\)/i", "", $actions->getUserName()). ", ".  date("d.m.Y, H:i", strtotime($actions->getUpdatedAt())) . "<br>";
            }
            // 2016 09 10 vexdex after ]
            
         ?></td>
        </tr>
        <?php endif ?>
      </table>

      <?php $items = $order->getItems(); $order_items = $order->getOrderItems(); ?>
      
      <?php if ($order_items->count()): ?>
        <table cellspacing="0" class="GridForm" id="view_order_item_container">
          <tr>
            <th style="width: 1%">~</th>
            <th style="text-align: left"><?php echo __('form_name', null, 'item') ?></th>
            <th style="width: 1%"><?php echo __('form_unit_type_id', null, 'item') ?></th>
            <th style="width: 1%"><?php echo __('form_count', null, 'order') ?></th>
            <th style="width: 75px"><?php echo __('form_price_uah', null, 'order') ?></th>
            <th style="width: 75px"><?php echo __('form_amount_uah', null, 'order') ?></th>
            <th class="AmountPayedUah" style="width: 75px"><?php echo __('form_amount_payed_uah', null, 'order') ?></th>
            <th class="AmountPayedUah" style="width: 75px"><?php echo __('form_amount_payed_bank_uah', null, 'order') ?></th>
            <th class="admin_info" style="width: 75px"><?php echo __('form_amount_left_uah', null, 'order') ?></th>      
            <th class="admin_info" style="width: 75px"><?php echo __('form_amount_costs_uah', null, 'order') ?></th>
            <th class="admin_info CostsPayedUah" style="width: 75px"><?php echo __('form_amount_costs_payed_uah', null, 'order') ?></th>
            <th class="admin_info" style="width: 75px"><?php echo __('form_amount_costs_left_uah', null, 'order') ?></th>      
            <th class="admin_info" style="width: 75px"><?php echo __('form_profit_uah', null, 'order') ?></th>
          </tr>
          
          <?php foreach($items as $i => $item): ?>
            <tr>
              <td class="OrderItemStatus" style="width: 1%"><span class="OrderItemStatus<?php echo $order_items[$i]->getStatusId() ?>" style="border: none"><?php echo $order_items[$i]->getStatus() ?></span></td>
              <td style="text-align: left"><?php echo link_to($item->getName(), 'item_show', array('id' => $item->getId())) ?></td>
              <td style="width: 1%"><?php echo $item->getUnitType() ?></td>
              <td style="width: 1%"><nobr><?php echo format_price($order_items[$i]->getCount()) ?></nobr></td>
              <td><nobr><?php echo format_price($order_items[$i]->getPriceUah()) ?></nobr></td>
              <td><nobr><?php echo format_price($order_items[$i]->getAmountUah()) ?></nobr></td>
              <td class="AmountPayedUah"><nobr><?php echo format_price($order_items[$i]->getAmountPayedUah()) ?></nobr></td>
              <td class="AmountPayedUah"><nobr><?php echo format_price($order_items[$i]->getAmountPayedBankUah()) ?></nobr></td>
              <td><nobr><?php echo format_price($order_items[$i]->getAmountUah() - $order_items[$i]->getAmountPayedUah() - $order_items[$i]->getAmountPayedBankUah()) //__('form_amount_left_uah', null, 'order') ?></nobr></td>      
              <td><nobr><?php echo format_price($order_items[$i]->getAmountCostsUah()) ?></nobr></td>
              <td class="CostsPayedUah"><nobr><?php echo format_price($order_items[$i]->getAmountCostsPayedUah()) ?></nobr></td>
              <td><nobr><?php echo format_price($order_items[$i]->getAmountCostsUah() - $order_items[$i]->getAmountCostsPayedUah()) // __('form_amount_costs_left_uah', null, 'order') ?></nobr></td>      
              <td><nobr><?php echo format_price($order_items[$i]->getAmountUah() - $order_items[$i]->getAmountCostsUah()) ?></nobr></td>        
            </tr>
          <?php endforeach ?>
          <tr>
            <?php $amount_info = $order->getAmountInfo(); //vardump($amount_info); ?>
            <td colspan="5" style="text-align: right"><strong>Всего</strong>:</td>
            <td style="width: 75px"><nobr><span id="order_item_amount_full_uah"><?php echo format_price($amount_info['amount_uah']) ?></span></nobr></td>
            <td class="AmountPayedUah" style="width: 75px"><nobr><span id="order_item_amount_payed_full_uah"><?php echo format_price($amount_info['amount_payed_uah']) ?></span></nobr></td>
            <td class="admin_info AmountPayedUah" style="width: 75px"><nobr><span id="order_item_amount_payed_bank_full_uah"><?php echo format_price($amount_info['amount_payed_bank_uah']) ?></span></nobr></td>
            <td class="admin_info" style="width: 75px"><nobr><span id="order_item_amount_left_full_uah"><?php echo format_price($amount_info['amount_left_uah']) ?></span></nobr></td>      
            <td class="admin_info" style="width: 75px"><nobr><span id="order_item_amount_costs_full_uah"><?php echo format_price($amount_info['amount_costs_uah']) ?></span></nobr></td>
            <td class="admin_info CostsPayedUah" style="width: 75px"><nobr><span id="order_item_amount_costs_payed_full_uah"><?php echo format_price($amount_info['amount_costs_payed_uah']) ?></span></nobr></td>
            <td class="admin_info" style="width: 75px"><nobr><span id="order_item_amount_costs_left_full_uah"><?php echo format_price($amount_info['amount_costs_left_uah']) ?></span></nobr></td>      
            <td class="admin_info" style="width: 75px"><nobr><span id="order_item_profit_full_uah"><?php echo format_price($amount_info['profit_uah']) ?></span></nobr></td>
          </tr>  
        </table>
      <?php endif ?>  

      <br/>
      <table cellspacing="0">
        <tr>
          <?php if ($order->getOrderTypeId() != 5): ?>
          <td style="padding-right: 30px">
            <?php echo link_to(__('cash_memo', null, 'order'), 'order_print_documents', array('id' => $order->getId(), 'doc_type' => 'cash_memo'), array('class' => 'extern', 'target' => '_blank')) ?><br />
            <?php echo link_to(__('invoice_2011', null, 'order'), 'order_print_documents', array('id' => $order->getId(), 'doc_type' => 'invoice_2011'), array('class' => 'extern', 'target' => '_blank')) ?><br/>
            <?php echo link_to(__('acceptance_certificate_2011', null, 'order'), 'order_print_documents', array('id' => $order->getId(), 'doc_type' => 'acceptance_certificate_2011'), array('class' => 'extern', 'target' => '_blank')) ?><br/>
            <?php echo link_to(__('contract', null, 'order'), 'order_print_documents', array('id' => $order->getId(), 'doc_type' => 'contract'), array('class' => 'extern', 'target' => '_blank')) ?><br/>
            <!--
            <br/>

            <?php echo link_to(__('invoice', null, 'order'), 'order_print_documents', array('id' => $order->getId(), 'doc_type' => 'invoice'), array('class' => 'extern', 'target' => '_blank')) ?><br />
            <?php echo link_to(__('acceptance_certificate', null, 'order'), 'order_print_documents', array('id' => $order->getId(), 'doc_type' => 'acceptance_certificate'), array('class' => 'extern', 'target' => '_blank')) ?>

            -->
            <?php //echo link_to(__('receipt', null, 'order'), 'order_print_documents', array('id' => $order->getId(), 'doc_type' => 'receipt'), array('onclick' => 'window', 'class' => 'extern', 'target' => '_blank')) ?>          
            <!-- <a href="#" onclick="window.open('<?php echo url_for('order_print_documents', array('id' => $order->getId(), 'doc_type' => 'receipt')) ?>'); return false;">2</a> <input name="" type="text" /> грн. -->                
            



          </td>
          <?php endif ?>
          <td class="Actions">
            <ul class="GridActions">
              <li class="GridActionShow">
              <li class="GridActionEdit"><a href="<?php echo url_for('order_edit', array('id' => $order->getId())) ?>">Редактировать</a></li>
              <li class="GridActionList"><a href="<?php echo url_for('order') ?>">Вернуться к списку заказов</a></li>
            </ul>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>