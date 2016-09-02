<?php if ($sf_user->hasFlash('custom_notice')): ?>
  <div class="MessageSuccess"><?php echo __($sf_user->getFlash('custom_notice'), array('%order_id%' => $sf_request->getParameter('order_id')), 'order') ?></div>
  <p>В ближайшее время с Вами свяжется наш менеджер для уточнения деталей.</p>
<?php endif; ?>

<p><?php echo link_to('На главную', 'homepage') ?> &mdash; <?php echo link_to($item->getName(), 'catalog_item', array('category_slug' => $category->getSlug(), 'item_slug' => $item->getSlug())) ?></p>

<?php if ($sf_user->hasFlash('custom_error')): ?>
  <div class="MessageWarning"><?php echo __($sf_user->getFlash('custom_error'), array(), 'order') ?></div>
<?php endif; ?>