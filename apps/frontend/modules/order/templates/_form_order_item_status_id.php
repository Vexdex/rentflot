<?php /* @var sfFormField $status_id */ ?>
<?php /* TODO in 1 place */ ?>
<script type="text/javascript">
  var order_item_statuses = {};
  <?php foreach ($status_id->getWidget()->getChoices() as $val => $text): ?>
    order_item_statuses['<?php echo $val ?>'] = '<?php echo $text ?>';
  <?php endforeach ?>
</script>
<div style="line-height: 10pt;">
  <?php echo image_tag('/magicLibsPlugin/images/spacer.gif', array('width' => '30px', 'height' => '1px', 'style' => 'float: left')) ?>
  <span class="OrderItemStatusText" id="<?php echo $status_id->renderId() ?>_text"> </span>
  <input type="hidden" name="<?php echo $status_id->renderName() ?>" id="<?php echo $status_id->renderId() ?>" value="<?php echo $status_id->getValue() ?>" />
</div>
