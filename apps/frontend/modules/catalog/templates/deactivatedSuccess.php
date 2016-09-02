<?php /*<h2><?php echo $item->getName(ESC_RAW) ?></h2> */ ?>

<h2>Наша компания этот теплоход в аренду не сдает</h2>

<br>

Смотрите другие плавсредства с категории <a href="<?php echo url_for('catalog_category', array('category_slug' => $category->getSlug())) ?>">&laquo;<?php echo $category->getName(ESC_RAW) ?>&raquo;</a>:

<br>
<br>

<?php foreach ($items  as $other_item): ?>
<div style="text-indent: 0px; padding-left: 20px; <?php if ($item->getId() == $other_item->getId()): ?>background-image: url(/images/elements/marker4.jpg); background-repeat: no-repeat; background-position: 2px 2px;<?php endif ?>">
  <?php if ($item->getId() !=  $other_item->getId()): ?>
  <a href="<?php echo url_for('catalog_item', array('category_slug' => $category->getSlug(), 'item_slug' => $other_item->getSlug())) ?>"><?php echo $other_item->getName(ESC_RAW) ?></a><br>
  <?php else: ?>
  <strong><?php echo $other_item->getName(ESC_RAW) ?></strong>
  <?php endif ?>
</div>
<?php endforeach ?>
