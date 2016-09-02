<a href="<?php echo url_for('item_edit', array('id' => $item->getId())) ?>">
<?php if ($item->relatedExists('MainImage')): ?>
  <?php echo image_tag(sfConfig::get('app_Item_images_path').'75x51_'.$item->getMainImage()->getFilename()) ?>
<?php else: ?>
  <?php echo image_tag('no-photo/75x51_'.$sf_user->getCulture().'.jpg') ?>
<?php endif ?>
</a>