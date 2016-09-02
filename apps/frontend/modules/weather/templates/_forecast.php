<table cellspacing="0" cellpadding="0" border="0" align=center>
	<?php for ($i = 0; $i < 7; $i++): ?>
    <tr <?php if ($i == 0): ?>style="color: #d9821b;"<?php endif ?>>
      <td class="weather_day"><?php echo __($weather_data[$i]['day_of_weak'], null, 'calendar') ?></td>
      <td align="center">&nbsp;<div style="text-align: center; display: inline; padding: 1px 2px 2px 3px; <?php if ($i == 0): ?>background-color: #e8923d; color: #ffdbb8;<?php endif ?>"><?php echo $weather_data[$i]['day'] ?></div></td>
      <td><?php echo image_tag('weather/'.$weather_data[$i]['icon'].'.jpg', 'hspace="5"') ?></td>
      <td><?php echo ($weather_data[$i]['t_from'] !== '-200' && $weather_data[$i]['t_from'] != $weather_data[$i]['t_to']) ? $weather_data[$i]['t_from'].'..' : '' ?><?php echo $weather_data[$i]['t_to'] ?></td>
    </tr>    
  <?php endfor ?>
</table>