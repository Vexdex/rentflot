<table cellspacing="0" cellpadding="0" border="0" width="100%">
  <tbody>
	<?php foreach($clients as $client): ?>
	  <tr>
		<td style="padding: 10px 5px 10px 10px;">
			<a href="<?php echo url_for("clients") ?>#<?php echo $client["href"] ?>"><?php echo $client["name"] ?></a> : "<?php echo $client["text"] ?>"
		</td>
	  </tr>  
	  <?php endforeach; ?>
  </tbody>
</table>