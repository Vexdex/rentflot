<h2><?php echo __('page_feedback_title', null, 'feedback') ?></h2>

<?php if ($sf_user->getFlash('msg_result')): ?>
  <h3><?php echo __('feedback_result_success', null, 'feedback') ?></h3>
  <?php else: ?>
    <h3><?php echo __('feedback_result_error', null, 'feedback') ?></h3>
<?php endif ?>

<p style="text-indent: 0px; text-align: center"><a href="<?php echo url_for('homepage') ?>" title="<?php echo __('feedback_homepage_link_text', null, 'feedback') ?>"><?php echo __('feedback_homepage_link_text', null, 'feedback') ?></a> &ndash; <a href="<?php echo url_for('contacts') ?>" title="<?php echo __('feedback_contacts_link_text', null, 'feedback') ?>"><?php echo __('feedback_contacts_link_text', null, 'feedback') ?></a> &ndash; <a href="<?php echo url_for('feedback') ?>" title="<?php echo __('feedback_feedback_link_text', null, 'feedback') ?>"><?php echo __('feedback_feedback_link_text', null, 'feedback') ?></a></p>