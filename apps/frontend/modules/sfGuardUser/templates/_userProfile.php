<tr>
  <?php $is_required_field = $form->getValidatorSchema()->offsetGet('Profile')->offsetGet('email')->getOption('required') ?>
  <th <?php if ($is_required_field): ?> class="FieldRequired" <?php endif; ?>> 
    <label for=""><?php echo __('form_email', array(), 'auth') ?></label>:
  </th> 
  <td> 
    <?php echo $form['Profile']['email'] ?>
    <?php if ($form['Profile']['email']->hasError()): ?>            
      <div class="Error">&bull; <?php echo __($form['Profile']['email']->getError()->getMessageFormat(), $form['Profile']['email']->getError()->getArguments(), 'auth') ?></div>
    <?php endif; ?>    
  </td> 
</tr> 

<tr>
  <?php $is_required_field = $form->getValidatorSchema()->offsetGet('Profile')->offsetGet('last_name')->getOption('required') ?>
  <th <?php if ($is_required_field): ?> class="FieldRequired" <?php endif; ?>> 
    <label for=""><?php echo __('form_last_name', array(), 'auth') ?></label>:
  </th> 
  <td> 
    <?php echo $form['Profile']['last_name'] ?>
    <?php if ($form['Profile']['last_name']->hasError()): ?>            
      <div class="Error">&bull; <?php echo __($form['Profile']['last_name']->getError()->getMessageFormat(), $form['Profile']['last_name']->getError()->getArguments(), 'auth') ?></div>
    <?php endif; ?>        
  </td> 
</tr> 

<tr>
  <?php $is_required_field = $form->getValidatorSchema()->offsetGet('Profile')->offsetGet('first_name')->getOption('required') ?>
  <th <?php if ($is_required_field): ?> class="FieldRequired" <?php endif; ?>> 
    <label for=""><?php echo __('form_first_name', array(), 'auth') ?></label>:
  </th> 
  <td> 
    <?php echo $form['Profile']['first_name'] ?>
    <?php if ($form['Profile']['first_name']->hasError()): ?>            
      <div class="Error">&bull; <?php echo __($form['Profile']['first_name']->getError()->getMessageFormat(), $form['Profile']['first_name']->getError()->getArguments(), 'auth') ?></div>
    <?php endif; ?>        
  </td> 
</tr> 
  
<tr>
  <?php $is_required_field = $form->getValidatorSchema()->offsetGet('Profile')->offsetGet('patronymic')->getOption('required') ?>
  <th <?php if ($is_required_field): ?> class="FieldRequired" <?php endif; ?>> 
    <label for=""><?php echo __('form_patronymic', array(), 'auth') ?></label>:
  </th> 
  <td> 
    <?php echo $form['Profile']['patronymic'] ?>
    <?php if ($form['Profile']['patronymic']->hasError()): ?>            
      <div class="Error">&bull; <?php echo __($form['Profile']['patronymic']->getError()->getMessageFormat(), $form['Profile']['patronymic']->getError()->getArguments(), 'auth') ?></div>
    <?php endif; ?>            
  </td> 
</tr> 
  
<tr>
  <?php $is_required_field = $form->getValidator('groups_list')->getOption('required')  ?>
  <th <?php if ($is_required_field): ?> class="FieldRequired" <?php endif; ?>> 
    <label for=""><?php echo __('form_group', array(), 'auth') ?></label>:
  </th> 
  <td> 
    <?php echo $form['groups_list'] ?>
    <?php if ($form['groups_list']->hasError()): ?>            
      <div class="Error">&bull; <?php echo __($form['groups_list']->getError()->getMessageFormat(), $form['groups_list']->getError()->getArguments(), 'auth') ?></div>
    <?php endif; ?>                
  </td> 
</tr> 

<tr>
  <?php $is_required_field = $form->getValidator('permissions_list')->getOption('required')  ?>
  <th <?php if ($is_required_field): ?> class="FieldRequired" <?php endif; ?>> 
    <label for=""><?php echo __('form_permissions', array(), 'auth') ?></label>:
  </th> 
  <td> 
    <?php echo $form['permissions_list'] ?>
    <?php if ($form['permissions_list']->hasError()): ?>            
      <div class="Error">&bull; <?php echo __($form['permissions_list']->getError()->getMessageFormat(), $form['permissions_list']->getError()->getArguments(), 'auth') ?></div>
    <?php endif; ?>                    
  </td> 
</tr> 






