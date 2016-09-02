<div id="online_order_dialog" style="display: none" title="<?php echo __('accept_dialog', array(), 'order'); ?>">
  <div id="online_order_dialog_form"></div>
  <div style="text-align: center;">
    <input type="hidden" id="online_order_dialog_form_item_slug" value="<?php echo $sf_request->getParameter('item_slug') ?>"/>
    <input type="hidden" id="online_order_dialog_form_category_slug" value="<?php echo $sf_request->getParameter('category_slug') ?>"/>
   <input type="hidden" id="online_order_dialog_form_redirect_page" value="<?php echo "/thank_you.html" ?>"/>

    <button id="online_order_dialog_form_apply">
      <?php echo __('accept_dialog', array(), 'order'); ?>
    </button>
    <button id="online_order_dialog_form_close">
      <?php echo __('close_dialog', array(), 'order'); ?>
    </button>
  </div>
</div>
