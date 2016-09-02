<?php $items = $owner->getItems(); foreach ($items as $item): ?>
  <?php echo link_to($item->getName(), 'item_edit', array('id' => $item->getId())) ?> <br />
<?php endforeach ?>