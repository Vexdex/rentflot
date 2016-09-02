<?php /* @var Item $item */ ?>

<h2>Мои теплоходы</h2>

<?php if ($items->count()): ?>
<table width="100%" cellpadding="2" cellspacing="0" border="0" class="OwnItems">
  <?php $i = 1; foreach ($items as $item): ?>
  <tr>
    <td><?php echo $i ?>. <a href="<?php echo url_for('catalog_item', array('category_slug' => $item->getCategories()->getFirst()->getSlug(), 'item_slug' => $item->getSlug())) ?>"><strong><?php echo $item->getName(ESC_RAW) ?></strong></a></td>
  </tr>
  <tr>
    <td style="padding-left: 20px">
      <p class="RentHeader">Занятость (<span class="ScheduleOrder2">50%</span>, <span class="ScheduleOrder3">100%</span>):</p>
      <?php include_component('catalog', 'nextItemRent', array('item_id' => $item->getId())) ?>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <?php $i++ ?>
  <?php endforeach ?>
</table>
<?php else: ?>
<div style="height: 100px; text-align: center">У Вас еще нет плавсредств.</div>
<?php endif ?>