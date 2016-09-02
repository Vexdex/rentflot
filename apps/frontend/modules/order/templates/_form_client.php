<table id="client_form" name="client_form" class="GridForm">
  <?php foreach (array('org_name', 'name', 'address', 'phones', 'email', 'additional_information') as $field): ?>
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