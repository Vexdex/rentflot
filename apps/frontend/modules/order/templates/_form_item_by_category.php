<table id="item_by_category_form" name="item_by_category_form" class="GridForm">
  <?php /*
  <tr>  
    <td>    
      <?php echo $item_by_category_form['category_id']->renderLabel(__('form_category_id', array(), 'order')) ?>:
    </td>
    <td>
      <?php echo $item_by_category_form['category_id'] ?>
      <?php if ($item_by_category_form['category_id']->hasError()): ?>            
        <div class="Error">&bull; <?php echo __($item_by_category_form['category_id']->getError()->getMessageFormat(), $item_by_category_form['category_id']->getError()->getArguments(), 'grid') ?></div>
      <?php endif ?>
    </td>
  </tr>
  <tr>  
    <td>    
      <?php echo $item_by_category_form['item_id']->renderLabel(__('form_item_id', array(), 'order')) ?>:
    </td>
    <td>
      <?php echo $item_by_category_form['item_id'] ?>
      <?php if ($item_by_category_form['item_id']->hasError()): ?>            
        <div class="Error">&bull; <?php echo __($item_by_category_form['item_id']->getError()->getMessageFormat(), $item_by_category_form['item_id']->getError()->getArguments(), 'grid') ?></div>
      <?php endif ?>
    </td>
  </tr>
</table> */ ?>

  <?php foreach (array('category_id', 'item_id') as $field): ?>
  <tr>  
    <th class="FieldRequired" style="width: 20%"><?php echo $item_by_category_form[$field]->renderLabel(__('form_'.$field, array(), 'order')) ?>:</th>
    <td style="width: 80%">
      <?php echo $item_by_category_form[$field] ?>
      <?php if ($item_by_category_form[$field]->hasError()): ?>            
        <div class="Error">&bull; <?php echo __($item_by_category_form[$field]->getError()->getMessageFormat(), $item_by_category_form[$field]->getError()->getArguments(), 'grid') ?></div>
      <?php endif ?>
    </td>
  </tr>
  <?php endforeach ?>
</table>