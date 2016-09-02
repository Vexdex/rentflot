<?php use_stylesheets_for_form($feedback_form) ?>
<?php use_javascripts_for_form($feedback_form) ?>

<h2><?php echo __('page_feedback_title', null, 'feedback') ?></h2>
<p><?php echo __('feedback_info', null, 'feedback') ?></p>

<?php if ($feedback_form->hasGlobalErrors()): ?>
  <?php echo $feedback_form->renderGlobalErrors() ?>
<?php endif; ?>

<center>
<form  method="post" id="feedback_form" name="feedback_form" class="FrontendForm" style="margin-top: 15px">
	<table cellpadding="0" cellspacing="0" border="0">
	  <tr>
	    <td class="Title"><?php echo __('email', array(), 'feedback') ?><span class="Required">*</span></td>
      <td class="Input">
        <?php echo $feedback_form['email']->render(array('class' => 'Input')) ?>
        <?php  if ($feedback_form['email']->hasError()): ?>
          <div class="Error"><?php echo __($feedback_form['email']->getError()->getMessageFormat(), $feedback_form['email']->getError()->getArguments(), 'grid') ?></div>            
        <?php endif ?>        
      </td>
	  </tr>	  
    <tr>
	    <td class="Title"><?php echo __('subject', array(), 'feedback') ?><span class="Required">*</span></td>
	    <td>
        <?php echo $feedback_form['subject_id']->render(array('class' => 'Input')) ?>
        <?php  if ($feedback_form['subject_id']->hasError()): ?>
          <div class="Error"><?php echo __($feedback_form['subject_id']->getError()->getMessageFormat(), $feedback_form['subject_id']->getError()->getArguments(), 'grid') ?></div>            
        <?php endif ?>        
      </td>
	  </tr>
	  <tr>	    
	    <td class="Title"><?php echo __('message', array(), 'feedback') ?><span class="Required">*</span></td>
      <td>
        <?php echo $feedback_form['message']->render(array('class' => 'Textarea')) ?>
        <?php  if ($feedback_form['message']->hasError()): ?>
          <div class="Error"><?php echo __($feedback_form['message']->getError()->getMessageFormat(), $feedback_form['message']->getError()->getArguments(), 'grid') ?></div>            
        <?php endif ?>                
      </td>
	  </tr>
	  <tr>
	    <td class="Title"><?php echo __('captcha', array(), 'feedback') ?><span class="Required">*</span></td>
      <td>
        <?php echo $feedback_form['captcha']->render(array('class' => 'Input', 'style' => 'width: 70px')) ?>
        <?php  if ($feedback_form['captcha']->hasError()): ?>
          <div class="Error"><?php echo __($feedback_form['captcha']->getError()->getMessageFormat(), $feedback_form['captcha']->getError()->getArguments(), 'grid') ?></div>            
        <?php endif ?>                        
      </td>
	  </tr>
	  <tr>
	    <td colspan="2" align="center" >
        <?php echo $feedback_form->renderHiddenFields(false) ?>
        <input type="submit" class="Submit" value="<?php echo __('apply', array(), 'feedback') ?>" />
      </td>
	  </tr>   
	</table>
</form>
</center>