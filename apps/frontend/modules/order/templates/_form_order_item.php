<script language="JavaScript">
$(document).ready(function() {
    
    var category          = $('#order_item_form #category_id');
    var item              = $('#order_item_form #item_id');
    
    category.bind('change', function () {
      item_list_by_category(category, item, 'all', null); 
    });
  
  });
</script>

<table id="order_item_form" name="order_item_form" class="GridForm">
  <?php foreach (array('category_id', 'item_id') as $field): ?>
  <tr>  
    <th<?php if ($client_form->getValidator($field)->getOption('required')): ?> class="FieldRequired"<?php endif?>><?php echo $client_form[$field]->renderLabel(__('form_'.$field, array(), 'client')) ?>:</th>
    <td>
      <?php echo $client_form[$field] ?>
      <?php if ($client_form[$field]->hasError()): ?>            
        <div class="Error">&bull; <?php echo __($client_form[$field]->getError()->getMessageFormat(), $client_form[$field]->getError()->getArguments(), 'grid') ?></div>
      <?php endif ?>
    </td>
  </tr>
  <?php endforeach ?>
</table>




<?php /*
  <tr>  
    <td>    
      <?php echo $order_item_form['category_id']->renderLabel(__('form_category_id', array(), 'client')) ?>:
    </td>
    <td>
      <?php echo $order_item_form['category_id'] ?>
      <?php if ($order_item_form['category_id']->hasError()): ?>            
        <div class="Error">&bull; <?php echo __($order_item_form['category_id']->getError()->getMessageFormat(), $order_item_form['category_id']->getError()->getArguments(), 'grid') ?></div>
      <?php endif ?>
    </td>
  </tr>
  <tr>  
    <td>    
      <?php echo $order_item_form['item_id']->renderLabel(__('form_item_id', array(), 'client')) ?>:
    </td>
    <td>
      <?php echo $order_item_form['item_id'] ?>
      <?php if ($order_item_form['item_id']->hasError()): ?>            
        <div class="Error">&bull; <?php echo __($order_item_form['item_id']->getError()->getMessageFormat(), $order_item_form['item_id']->getError()->getArguments(), 'grid') ?></div>
      <?php endif ?>
    </td>
  </tr>
</table>

*/ ?>