<table cellspacing="0" cellpadding="0" border="0" width="100%">
  <tbody>
	<?php foreach($news as $new): ?>
	  <tr>
		<td style="padding: 10px 5px 10px 10px;">
      <?php echo $new->getDateTimeObject('created_at')->format('d.m.Y'); ?><br/>
			<a href="<?php echo url_for("newsf/show?slug=".$new->getSlug()) ?>"><?php echo $new->getName() ?></a>
			<?php echo $new->getDescription() ?>
		</td>
	  </tr>  
	  <?php endforeach; ?>
  </tbody>
</table>