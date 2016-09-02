<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


<?php if ($form->hasGlobalErrors()): ?>
  <div class="Error">
    <?php echo $form->renderGlobalErrors() ?>
  </div>
<?php endif; ?>

<div id="client_dialog" style="display: none" title="">
  <input type="hidden" name="client_form_is_new" id="client_form_is_new" value=""/>
  <div id="client_dialog_form"></div>
  <div style="text-align: center; padding-top: 5px">
    <input type="button" onclick="save_client_form()" value="Сохранить"/>
    <input type="button" onclick="javascript: $('#client_dialog').dialog('close');" value="<?php echo __('close_dialog', null, 'order') ?>"/>
  </div>
</div>


<div id="item_by_category_dialog" style="display: none" title="<?php echo __('add_order_item_title', null, 'order') ?>">
  <div id="item_by_category_dialog_form">
    <?php include_partial('form_item_by_category', array('item_by_category_form' => $item_by_category_form)) ?> 
  </div>  
  <div style="text-align: center; padding-top: 5px">
    <input type="button" onclick="add_order_item('order_item_container');" id="order_item_form_apply" name="order_item_form_apply"/> <!-- button text обновляется через javascript -->
    <input type="button" onclick="javascript: $('#item_by_category_dialog').dialog('close');" value="<?php echo __('close_dialog', null, 'order') ?>"/>
  </div>
</div>


<?php echo form_tag_for($form, '@order', array('enctype'=> "multipart/form-data", 'id' => 'order_form')) ?>
  <table cellspacing="0" class="GridForm">
    <tr>
      <th><?php echo (isset($form['is_archived']) ? $form['is_archived']->renderLabel(__('form_is_archived', array(), 'order')) : $form[$sf_user->getCulture()]['is_archived']->renderLabel(__('form_is_archived', array(), 'order'))) ?>:</th>
      <td id="<?php echo $form->getName().'_'.'is_archived'.'_cell' ?>">
        <?php echo $form['is_archived']->render(); ?>                    
        <?php if ($form['is_archived']->hasError()): ?>            
          <div class="Error">&bull; <?php echo __($form['is_archived']->getError()->getMessageFormat(), $form['is_archived']->getError()->getArguments(), 'grid') ?></div>
        <?php endif; ?>
      </td>
    </tr>  
    <tr>
      <!--  class="FieldRequired" -->
      <th><?php echo (isset($form['date']) ? $form['date']->renderLabel(__('form_date', array(), 'order')) : $form[$sf_user->getCulture()]['date']->renderLabel(__('form_date', array(), 'order'))) ?>:</th>
      <td id="<?php echo $form->getName().'_'.'date'.'_cell' ?>">
        <?php echo $form['date']->render(); ?>                    
        <?php if ($form['date']->hasError()): ?>            
          <div class="Error">&bull; <?php echo __($form['date']->getError()->getMessageFormat(), $form['date']->getError()->getArguments(), 'grid') ?></div>
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <th><?php echo (isset($form['time_from']) ? $form['time_from']->renderLabel(__('form_time_from', array(), 'order')) : $form[$sf_user->getCulture()]['time_from']->renderLabel(__('form_time_from', array(), 'order'))) ?>:</th>
      <td id="<?php echo $form->getName().'_'.'time_from'.'_cell' ?>">
        <?php echo $form['time_from']->render(array('class' => 'order_time')); ?>                    
        <?php if ($form['time_from']->hasError()): ?>            
          <div class="Error">&bull; <?php echo __($form['time_from']->getError()->getMessageFormat(), $form['time_from']->getError()->getArguments(), 'grid') ?></div>
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <th><?php echo (isset($form['time_to']) ? $form['time_to']->renderLabel(__('form_time_to', array(), 'order')) : $form[$sf_user->getCulture()]['time_to']->renderLabel(__('form_time_to', array(), 'order'))) ?>:</th>
      <td id="<?php echo $form->getName().'_'.'time_to'.'_cell' ?>">
        <?php echo $form['time_to']->render(array('class' => 'order_time')); ?>                    
        <?php if ($form['time_to']->hasError()): ?>            
          <div class="Error">&bull; <?php echo __($form['time_to']->getError()->getMessageFormat(), $form['time_to']->getError()->getArguments(), 'grid') ?></div>
        <?php endif; ?>
      </td>
    </tr>    
    <tr>
      <th><?php echo __('form_duration', null, 'order') ?>:</th>
      <td id="order_duration"><?php $duration = time_diff($order->getTimeFrom(), $order->getTimeTo()); ?><?php if ($duration): ?><?php echo sprintf('%02d:%02d', $duration['hours'], $duration['minutes']) ?><?php endif ?></td>
    </tr>
    <tr>
      <th><?php echo (isset($form['client_id']) ? $form['client_id']->renderLabel(__('form_client_id', array(), 'order')) : $form[$sf_user->getCulture()]['client_id']->renderLabel(__('form_client_id', array(), 'order'))) ?>:</th>
      <td id="<?php echo $form->getName().'_'.'client_id'.'_cell' ?>">
        <?php echo $form['client_id']->render(); ?>                    
        <?php if ($form['client_id']->hasError()): ?>            
          <div class="Error">&bull; <?php echo __($form['client_id']->getError()->getMessageFormat(), $form['client_id']->getError()->getArguments(), 'grid') ?></div>
        <?php endif; ?>    
        
        <ul class="GridFormActions" style="margin: 5px 0">
          <li class="GridActionAdd">        
            <span class="Link" onclick="show_client_form(1)"><?php echo __('add_client', null, 'order') ?></span>                 
          </li>
          <li class="GridActionEdit">        
            <span class="Link" onclick="show_client_form(0)"><?php echo __('Редактировать выбранного клиента', null, 'order') ?></span>
          </li>
        </ul>
      </td>
    </tr>
    <tr>
      <th><?php echo (isset($form['people_count']) ? $form['people_count']->renderLabel(__('form_people_count', array(), 'order')) : $form[$sf_user->getCulture()]['people_count']->renderLabel(__('form_people_count', array(), 'order'))) ?>:</th>
      <td id="<?php echo $form->getName().'_'.'people_count'.'_cell' ?>">
        <?php echo $form['people_count']->render(); ?>                    
        <?php if ($form['people_count']->hasError()): ?>            
          <div class="Error">&bull; <?php echo __($form['people_count']->getError()->getMessageFormat(), $form['people_count']->getError()->getArguments(), 'grid') ?></div>
        <?php endif; ?>
      </td>
    </tr> 
    <tr>
      <th><?php echo __('form_additional_information', null, 'order') ?>:</th>
      <td id="<?php echo $form->getName().'_'.'additional_information'.'_cell' ?>">        
        <?php echo $form['additional_information']->render(); ?>
        <?php if ($form['additional_information']->hasError()): ?>            
          <div class="Error">&bull; <?php echo __($form['additional_information']->getError()->getMessageFormat(), $form['additional_information']->getError()->getArguments(), 'grid') ?></div>
        <?php endif; ?>
      </td>
    </tr>


    <tr>
      <th><?php echo __('pier', null, 'order') ?>:</th>
      <td id="<?php echo $form->getName().'_'.'pier_id'.'_cell' ?>">
        <?php echo $form['pier_id']->render(array('class' => 'order_time')); ?>
        <?php if ($form['pier_id']->hasError()): ?>
          <div class="Error">&bull; <?php echo __($form['pier_id']->getError()->getMessageFormat(), $form['pier_id']->getError()->getArguments(), 'grid') ?></div>
        <?php endif; ?>
      </td>
    </tr>

    <tr>
      <th><?php echo (isset($form['spd_id']) ? $form['spd_id']->renderLabel(__('form_spd_id', array(), 'order')) : $form[$sf_user->getCulture()]['spd_id']->renderLabel(__('form_spd_id', array(), 'order'))) ?>:</th>
      <td id="<?php echo $form->getName().'_'.'spd_id'.'_cell' ?>">
        <?php echo $form['spd_id']->render(array('class' => 'order_time')); ?>                    
        <?php if ($form['spd_id']->hasError()): ?>            
          <div class="Error">&bull; <?php echo __($form['spd_id']->getError()->getMessageFormat(), $form['spd_id']->getError()->getArguments(), 'grid') ?></div>
        <?php endif; ?>
      </td>
    </tr>    
	
	<tr>
      <th><?php echo (isset($form['make_contact']) ? $form['make_contact']->renderLabel(__('form_make_contact', array(), 'order')) : $form[$sf_user->getCulture()]['make_contact']->renderLabel(__('form_make_contact', array(), 'order'))) ?>:</th>
      <td id="<?php echo $form->getName().'_'.'make_contact'.'_cell' ?>">
        <?php echo $form['make_contact']->render(); ?>                    
        <?php if ($form['make_contact']->hasError()): ?>            
          <div class="Error">&bull; <?php echo __($form['make_contact']->getError()->getMessageFormat(), $form['make_contact']->getError()->getArguments(), 'grid') ?></div>
        <?php endif; ?>
      </td>
    </tr> 
	<tr>
      <th><?php echo (isset($form['contact_date']) ? $form['contact_date']->renderLabel(__('form_contact_date', array(), 'order')) : $form[$sf_user->getCulture()]['contact_date']->renderLabel(__('form_contact_date', array(), 'order'))) ?>:</th>
      <td id="<?php echo $form->getName().'_'.'contact_date'.'_cell' ?>">
        <?php echo $form['contact_date']->render(); ?>                    
        <?php if ($form['contact_date']->hasError()): ?>            
          <div class="Error">&bull; <?php echo __($form['contact_date']->getError()->getMessageFormat(), $form['contact_date']->getError()->getArguments(), 'grid') ?></div>
        <?php endif; ?>
      </td>
    </tr> 
	<tr>

	<th><?php echo (isset($form['contact_time']) ? $form['contact_time']->renderLabel(__('form_contact_time', array(), 'order')) : $form[$sf_user->getCulture()]['contact_time']->renderLabel(__('form_contact_time', array(), 'order'))) ?>:</th>
      <td id="<?php echo $form->getName().'_'.'contact_time'.'_cell' ?>">
        <?php echo $form['contact_time']->render(); ?>                    
        <?php if ($form['contact_time']->hasError()): ?>            
          <div class="Error">&bull; <?php echo __($form['contact_time']->getError()->getMessageFormat(), $form['contact_time']->getError()->getArguments(), 'grid') ?></div>
        <?php endif; ?>
      </td>
    </tr> 
	
		<tr>
      <th><?php echo (isset($form['comment']) ? $form['comment']->renderLabel(__('form_comment', array(), 'order')) : $form[$sf_user->getCulture()]['comment']->renderLabel(__('form_comment', array(), 'order'))) ?>:</th>
      <td id="<?php echo $form->getName().'_'.'comment'.'_cell' ?>">
        <?php echo $form['comment']->render(); ?>                    
        <?php if ($form['comment']->hasError()): ?>            
          <div class="Error">&bull; <?php echo __($form['comment']->getError()->getMessageFormat(), $form['comment']->getError()->getArguments(), 'grid') ?></div>
        <?php endif; ?>
      </td>
    </tr>

      <tr>
          <th><?php echo __('form_client_information', null, 'order') ?>:</th>
          <td id="<?php echo $form->getName().'_'.'client_information'.'_cell' ?>">
              <?php echo $form['client_information']->render(); ?>
              <?php if ($form['client_information']->hasError()): ?>
                  <div class="Error">&bull; <?php echo __($form['client_information']->getError()->getMessageFormat(), $form['client_information']->getError()->getArguments(), 'grid') ?></div>
              <?php endif; ?>
          </td>
      </tr>
    
    <?php if (!$order->isNew()): ?>
      <tr>
        <th><?php echo __('form_created_by', array(), 'order') ?>:</th>
        <td><?php echo $order->getCreator()->getName() ?>, <?php echo format_date($order->getCreatedAt(), 'dd.MM.yyyy, H:mm') ?></td>
      </tr>
      <?php if ($order->getCreatedAt() != $order->getUpdatedAt()): ?>
      <tr>
        <th><?php echo __('form_updated_by', array(), 'order') ?>:</th>
        <td><?php echo $order->getUpdator()->getId() ? $order->getUpdator()->getName() : '?' ?>, <?php echo format_date($order->getUpdatedAt(), 'dd.MM.yyyy, H:mm') ?></td>
      </tr>
      <?php endif ?>
    <?php endif ?>
    <tr>
      <td style="text-align: center" colspan="2">
        <table cellspacing="0" width="100%">
          <tr>
            <td style="text-align: center" align="center">
              <ul class="GridFormActions">
                <li class="GridActionAdd">
                  <span class="Link" onclick="show_item_by_category_form('add')"><?php echo __('add_order_item', null, 'order') ?></span>        
                </li>
              </ul>
            </td>
            <td style="wdith: 24px; text-align: right">
              <img class="Link" src="/images/order/star_yellow.png" onclick="toggle_admin_info()" />  
            </td>
          </tr>
        </table>
      </td>
    </tr>   
  </table>
  
  <table cellspacing="0" class="GridForm" id="order_item_container">
    <thead>
      <tr>
        <th style="width: 1%">~</th>
        <th style="width: 21%; text-align: left;"><?php echo __('form_name', null, 'item') ?></th>
        <!--<th style="width: 1%"><?php echo __('form_unit_type_id', null, 'item') ?></th>-->
        <th style="width: 4%"><?php echo __('form_count', null, 'order') ?></th>
        <th style="width: 8%"><?php echo __('form_price_uah', null, 'order') ?></th>
        <th style="width: 9%"><?php echo __('form_amount_uah', null, 'order') ?></th>
        <th style="width: 8%" class="AmountPayedUah"><?php echo __('form_amount_payed_uah', null, 'order') ?></th>
        <th style="width: 8%" class="AmountPayedUah"><?php echo __('form_amount_payed_bank_uah', null, 'order') ?></th>
        <th class="admin_info" style="width: 8%"><?php echo __('form_amount_left_uah', null, 'order') ?></th>      
        <th class="admin_info" style="width: 8%"><?php echo __('form_amount_costs_uah', null, 'order') ?></th>
        <th class="admin_info CostsPayedUah" style="width: 8%"><?php echo __('form_amount_costs_payed_uah', null, 'order') ?></th>
        <th class="admin_info" style="width: 8%"><?php echo __('form_amount_costs_left_uah', null, 'order') ?></th>      
        <th class="admin_info" style="width: 8%"><?php echo __('form_profit_uah', null, 'order') ?></th>
        <th style="width: 1%"><img src="/magicLibsPlugin/images/delete2.png" title="Удалить" alt="Удалить"/></th>
      </tr>
    <thead>    
    
    <tbody>
    <!-- Вывод существующих полей, которые есть в БД -->  
    <?php if (!empty($form['order_item'])): ?>    
      <?php foreach ($form['order_item'] as $key => $order_item_form): ?>
        <?php include_partial('form_order_item_short', array('order_item' => $form->getEmbeddedForm('order_item')->getEmbeddedForm($order_item_form->getName())->getObject(), 'order_item_form' => $order_item_form, 'number' => $key)) ?>
      <?php endforeach ?>
    <?php endif ?>

    <!-- Вывод новых полей, которых нет в БД, или полей после неудачной валдидациии -->  
    <?php if (!empty($form['order_item_new'])): ?>    
      <?php foreach ($form['order_item_new'] as $key_new => $order_item_form): ?>    
        <?php include_partial('form_order_item_short', array('order_item' => $form->getEmbeddedForm('order_item_new')->getEmbeddedForm($order_item_form->getName())->getObject(), 'order_item_form' => $order_item_form, 'number' => $key_new)) ?>
      <?php endforeach ?>
    <?php endif ?>
    </tbody> 
    
    <tfoot>
      <tr class="Total">
        <?php $amount_info = $order->getAmountInfo() ?>
        <td colspan="4" style="text-align: right"><strong>Всего</strong>:</td>
        <td style="width: 9%"><nobr><span id="order_item_amount_full_uah"><?php echo format_float($amount_info['amount_uah']) ?></span></nobr></td>
        <td style="width: 8%" class="AmountPayedUah"><nobr><span id="order_item_amount_payed_full_uah"><?php echo format_float($amount_info['amount_payed_uah']) ?></span></nobr></td>
        <td style="width: 8%" class="AmountPayedUah"><nobr><span id="order_item_amount_payed_bank_full_uah"><?php echo format_float($amount_info['amount_payed_bank_uah']) ?></span></nobr></td>
        <td class="admin_info" style="width: 8%"><nobr><span id="order_item_amount_left_full_uah"><?php echo format_float($amount_info['amount_left_uah']) ?></span></nobr></td>      
        <td class="admin_info" style="width: 8%"><nobr><span id="order_item_amount_costs_full_uah"><?php echo format_float($amount_info['amount_costs_uah']) ?></span></nobr></td>
        <td class="admin_info CostsPayedUah" style="width: 8%"><nobr><span id="order_item_amount_costs_payed_full_uah"><?php echo format_float($amount_info['amount_costs_payed_uah']) ?></span></nobr></td>
        <td class="admin_info" style="width: 8%"><nobr><span id="order_item_amount_costs_left_full_uah"><?php echo format_float($amount_info['amount_costs_left_uah']) ?></span></nobr></td>      
        <td class="admin_info" style="width: 8%"><nobr><span id="order_item_profit_full_uah"><?php echo format_float($amount_info['profit_uah']) ?></span></nobr></td>
        <td style="width: 1%">&nbsp;</td>
      </tr>  
    </tfoot>
  </table>  
  
  <script type="text/javascript">
    var order_item_count = <?php echo isset($key_new) ? intval($key_new) + 1 : 0 ?>;
  </script>
  
  
  <div id="<?php echo $form->getName().'_'.'order_owner_id'.'_cell' ?>" style="text-align: center; margin-top: 10px">
    <ul class="GridFormActions">
      <li>
        Заказ: <?php echo $form['order_owner_id']->render(); ?> &nbsp;
        <?php if ($form['order_owner_id']->hasError()): ?>            
          <div class="Error">&bull; <?php echo __($form['order_owner_id']->getError()->getMessageFormat(), $form['order_owner_id']->getError()->getArguments(), 'grid') ?></div>
        <?php endif; ?>
      </li>
      <li><input type="submit" value="<?php echo __('form_apply', null, 'order') ?>" /></li>
      <li class="GridActionList"><a href="<?php echo url_for('order') ?>">Вернуться к списку заказов</a></li>
    </ul>
  </div>

  
</form>
  


