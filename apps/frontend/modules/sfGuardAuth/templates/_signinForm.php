<script type="text/javascript"> 
  $(document).ready(function() {
    // validate signup form on keyup and submit
    var container = $('#signin_error_container');    
    $("#signin-form").validate({
      rules: {
        signin_username: {
          required: true
        },
        signin_password: {
          required: true
        }
      },
      messages: {
        signin_username: {
          required: "<?php echo __('error_username_required', array(), 'auth') ?>"
        },
        signin_password: {
          required: "<?php echo __('error_password_required', array(), 'auth') ?>"
        }
      },
      errorElement: "li",
      errorClass: "error",
      errorLabelContainer: container
    });
    if (container.children().length)
    {
      container.show();
    }
  });
</script>  

<table cellspacing="0" width="100%">
  <tr>
    <td style="text-align: center" align="center">
      <div style="text-align: left; padding-left: 156px">
        <ul id="signin_error_container" style="margin: 0 2px">
          <?php if ($signin_form['username']->hasError() || $signin_form['password']->hasError()): ?>
            <li><?php echo __('error_login_or_password_invalid', array(), 'auth') ?></li>
          <?php endif ?>        
          <?php if ($signin_form->hasGlobalErrors()): ?>
            <?php $global_errors = $signin_form->getGlobalErrors(); foreach ($global_errors as $error): ?>
              <li><?php echo __($error, array(), 'auth') ?></li>
            <?php endforeach ?>          
          <?php endif; ?>                         
        </ul> 
      </div>
      
      <form method="post" id="signin-form" style="margin-top: 10px">
        <table cellspacing="0" align="center">
          <tr>
            <th align="left"><?php echo __('username', array(), 'auth') ?>:</th>
            <td><?php echo $signin_form['username'] ?></td>
          </tr>
          <tr>
            <th align="left"><?php echo __('password', array(), 'auth') ?>:</th>
            <td><?php echo $signin_form['password']->render(array('autocomplete' => 'off')) ?></td>
          </tr>
          <tr>
            <td colspan="2" id="submit-cell" style="padding-top: 10px; text-align: center">
              <?php echo $signin_form->renderHiddenFields(false) ?>
              <input type="submit" value="<?php echo __('signin', array(), 'auth') ?>" style="width: 55px" />
            </td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
