<h1>
  <?php echo $new->getName(); ?>
</h1>
<div>
  <?php echo $new->getDateTimeObject('created_at')->format('d.m.Y'); ?>
	<?php echo sfOutputEscaper::unescape($new->getText()); ?>
</div>