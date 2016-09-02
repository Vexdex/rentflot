<tr>
  <?php $is_required_field = $form->getValidator('password')->getOption('required')  ?>
  <th <?php if ($is_required_field): ?> class="FieldRequired" <?php endif; ?>> 
    <label for="password"><?php echo __('password', array(), 'auth') ?></label>:    
  </th> 
  <td> 
    <?php echo $form['password'] ?>
    <?php $user_options = sfContext::getInstance()->getUser()->getOptions(); if (!empty($user_options['advanced_policy']['active'])): ?>
      <div class="Help"><?php include_component('sfGuardUser', 'passwordComplexity') ?></div>
      <?php if ($form['password']->hasError()): ?>            
        <div class="Error">&bull; <?php echo __($form['password']->getError()->getMessageFormat(), $form['password']->getError()->getArguments(), 'auth') ?></div>
      <?php endif; ?>                
    <?php endif ?>
  </td> 
</tr> 
