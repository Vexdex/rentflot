<div style="font-weight: normal; text-align: center; text-indent: 0px; color: #8e4702; padding: 3px 0 3px 0; "><?php echo __($calendar_data[0]['month'], null, 'calendar') ?> <?php echo  $calendar_data[0]['year'] ?></div>
<table cellspacing="4" cellpadding="0" border="0" align=center>
	<tr>
    <?php foreach ($days_data as $day_data): ?>
      <td class="ddayh">
        <?php echo __($day_data, null, 'calendar') ?>
      </td>
    <?php endforeach ?>  
  </tr>
  
<?php $count_on_row = 7;  $count = 0; ?>
 
<?php foreach ($calendar_data[0]['days'] as $day): ?>
  <?php if ($count % $count_on_row == 0 && $count != 0): ?></tr><?php endif ?>
  <?php if ($count % $count_on_row == 0): ?><tr><?php endif ?>  
  <td class="<?php echo $day['class'] ?>"><?php echo $day['day'] ?></td>
  <?php $count++ ?>
<?php endforeach ?>
</table>

<?php $i = 0; foreach ($calendar_data as $calendar): ?>
  <?php if ($i > 0): ?>
    <div style="font-weight: normal; text-align: center; text-indent: 0px; color: #8e4702; padding: 10px 0 3px 0; font-size: 10px"><?php  echo __($calendar['month'], null, 'calendar') ?> <?php echo $calendar['year'] ?></div>
    <table cellspacing="4" cellpadding="0" border="0" align=center class="monthn">
      <tr>
        <?php foreach ($days_data as $day_data): ?>
          <td class="ddayh">
            <?php echo __($day_data, null, 'calendar') ?>
          </td>
        <?php endforeach ?>
      </tr>
    <?php $count_on_row = 7 ?>
    <?php $count = 0 ?>
     
    <?php foreach ($calendar['days'] as $day): ?>
    <?php if ($count % $count_on_row == 0 && $count != 0): ?></tr><?php endif ?>
    <?php if ($count % $count_on_row == 0): ?><tr><?php endif ?>
      <td class="<?php echo $day['class'] ?>">
        <?php echo $day['day'] ?>
      </td>
    <?php $count++ ?>
    <?php endforeach ?>
    </table>
  <?php endif ?>
  <?php $i++ ?>
<?php endforeach ?>