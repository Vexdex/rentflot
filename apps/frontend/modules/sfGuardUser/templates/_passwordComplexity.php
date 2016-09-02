<p style="margin-bottom: 0"><?php echo sfContext::getInstance()->getI18n()->__('password_complexity_requirements', null, 'auth') ?>:</p>
<ul>
  <?php if (!empty($password_complexity['require_numbers'])): ?>
    <li><?php echo sfContext::getInstance()->getI18n()->__('password_must_contain', null, 'auth') ?> <?php echo sfContext::getInstance()->getI18n()->__('require_numbers_text', null, 'auth') ?></li>
  <?php endif ?>
  <?php if (!empty($password_complexity['require_lowercase'])): ?>
    <li><?php echo sfContext::getInstance()->getI18n()->__('password_must_contain', null, 'auth') ?> <?php echo sfContext::getInstance()->getI18n()->__('require_lowercase_text', null, 'auth') ?></li>
  <?php endif ?>
  <?php if (!empty($password_complexity['require_uppercase'])): ?>
    <li><?php echo sfContext::getInstance()->getI18n()->__('password_must_contain', null, 'auth') ?> <?php echo sfContext::getInstance()->getI18n()->__('require_uppercase_text', null, 'auth') ?></li>
  <?php endif ?>
  <?php if (!empty($password_complexity['require_spec_chars'])): ?>
    <li><?php echo sfContext::getInstance()->getI18n()->__('password_must_contain', null, 'auth') ?> <?php echo sfContext::getInstance()->getI18n()->__('require_spec_chars_text', null, 'auth') ?></li>
  <?php endif ?>
  <?php if (!empty($password_complexity['pwd_min_length'])): ?>
    <li><?php echo sfContext::getInstance()->getI18n()->__('pwd_min_length_text', array('%%min_len%%' => $password_complexity['pwd_min_length']), 'auth').' '.plural_form($password_complexity['pwd_min_length'], array(__('characters_plural_1', null, 'grid'), __('characters_plural_2', null, 'grid'), __('characters_plural_3', null, 'grid'))) ?></li>
  <?php endif ?>
  <?php if (!empty($password_complexity['history_length'])): ?>
    <li><?php echo plural_form($password_complexity['history_length'], array(__('history_length_plural_1', array('%%history_length%%' => $password_complexity['history_length']), 'auth'), __('history_length_plural_2', array('%%history_length%%' => $password_complexity['history_length']), 'auth'), __('history_length_plural_3', array('%%history_length%%' => $password_complexity['history_length']), 'auth'))) ?></li>
  <?php endif ?>
</ul>






