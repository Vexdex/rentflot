<div id="navi">
  <<?php if (sfContext::getInstance()->getRouting()->getCurrentRouteName() != 'homepage'): ?>a<?php else: ?>b<?php endif ?> href="<?php echo url_for('homepage') ?>" style="background-position: <?php if (sfContext::getInstance()->getRouting()->getCurrentRouteName() != 'homepage'): ?>-1px<?php else: ?>-105px<?php endif ?> 0" title="<?php echo __('home', null, 'face') ?>"><noindex> </noindex></<?php if (sfContext::getInstance()->getRouting()->getCurrentRouteName() != 'homepage'): ?>a<?php else: ?>b<?php endif ?>>
  <<?php if (sfContext::getInstance()->getRouting()->getCurrentRouteName() != 'sitemap'): ?>a<?php else: ?>b<?php endif ?> class="ohide" href="<?php echo url_for('sitemap') ?>" style="background-position: <?php if (sfContext::getInstance()->getRouting()->getCurrentRouteName() != 'sitemap'): ?>-52px<?php else: ?>-156px<?php endif ?> 0" title="<?php echo __('sitemap', null, 'face') ?>"><noindex> </noindex></<?php if (sfContext::getInstance()->getRouting()->getCurrentRouteName() != 'sitemap'): ?>a<?php else: ?>b<?php endif ?>>
  <<?php if (sfContext::getInstance()->getRouting()->getCurrentRouteName() != 'feedback'): ?>a<?php else: ?>b<?php endif ?> href="<?php echo url_for('feedback') ?>" style="background-position: <?php if (sfContext::getInstance()->getRouting()->getCurrentRouteName() != 'feedback'): ?>-78px<?php else: ?>-182px<?php endif ?> 0" title="<?php echo __('feedback', null, 'face') ?>"><noindex> </noindex></<?php if (sfContext::getInstance()->getRouting()->getCurrentRouteName() != 'feedback'): ?>a<?php else: ?>b<?php endif ?>>
</div>