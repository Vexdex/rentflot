<h1>
  <?php echo $kitchen->getName(); ?>
</h1>
<div>
	<?php echo sfOutputEscaper::unescape($kitchen->getText()); ?>
</div>