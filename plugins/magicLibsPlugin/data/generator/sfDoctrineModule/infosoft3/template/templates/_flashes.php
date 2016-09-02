[?php if ($sf_user->hasFlash('notice')): ?]
  <div class="MessageSuccess">[?php echo __($sf_user->getFlash('notice'), array(), 'grid') ?]</div>
[?php endif; ?]

[?php if ($sf_user->hasFlash('error')): ?]
  <div class="MessageWarning">[?php echo __($sf_user->getFlash('error'), array(), 'grid') ?]</div>
[?php endif; ?]

[?php if ($sf_user->hasFlash('custom_notice')): ?]
  <div class="MessageSuccess">[?php echo __($sf_user->getFlash('custom_notice'), array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</div>
[?php endif; ?]

[?php if ($sf_user->hasFlash('custom_error')): ?]
  <div class="MessageWarning">[?php echo __($sf_user->getFlash('custom_error'), array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</div>
[?php endif; ?]