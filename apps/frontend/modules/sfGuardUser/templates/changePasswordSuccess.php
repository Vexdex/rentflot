<h1><?php echo __('page_change_password_title', null, 'auth') ?></h1>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="MessageWarning"><?php echo __($sf_user->getFlash('error'), array(), 'auth') ?></div>
<?php endif; ?>


<p><?php echo __('change_password_text', null, 'auth') ?></p>
<?php include_component('sfGuardUser', 'passwordComplexity') ?>    

<?php include_partial('sfGuardUser/changePasswordForm', array('change_user_password_form' => $change_user_password_form)) ?>
