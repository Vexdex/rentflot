
<table cellspacing="0" id="infosoft_grid">
  <tr>
    <td style="padding: 0">
      <?php if ($change_user_password_form['password']->hasError() || $change_user_password_form['password_again']->hasError() || $change_user_password_form->hasGlobalErrors()): ?>
      <ul id="change_password_container">
        <?php if ($change_user_password_form['password']->hasError() || $change_user_password_form['password_again']->hasError()): ?>
          <li><?php echo __($change_user_password_form['password']->getError()->getMessageFormat(), $change_user_password_form['password']->getError()->getArguments(), 'auth') ?></li>
        <?php endif ?>        
        <?php if ($change_user_password_form->hasGlobalErrors()): ?>
          <?php $global_errors = $change_user_password_form->getGlobalErrors(); foreach ($global_errors as $error): ?>
            <li><?php echo __($error, array(), 'auth') ?></li>
          <?php endforeach ?>          
        <?php endif ?>
      </ul> 
      <?php endif; ?>
      <form action="<?php echo url_for('sf_guard_change_password') ?>" method="post" id="signin-form">
        <table cellspacing="0" class="Filters">
          <tr>
            <th><?php echo __('form_password', array(), 'auth') ?>:</th>
            <td><?php echo $change_user_password_form['password'] ?></td>
          </tr>
          <tr>
            <th><?php echo __('form_password_again', array(), 'auth') ?>:</th>
            <td><?php echo $change_user_password_form['password_again'] ?></td>
          </tr>
          <tr>
            <td colspan="2" id="submit-cell" style="padding-top: 10px">
              <?php echo $change_user_password_form->renderHiddenFields(false) ?>
              <input type="submit" value="<?php echo __('change_password', null, 'auth') ?>" style="width: 140px" />
            </td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
