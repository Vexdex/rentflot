<h1>Отчет "Затраты по индексам"</h1>

<?php if (!$print_type): ?>
    <?php include_partial('bills_flter', array('reports_form_filter' => $reports_form_filter)) ?>
  <?php else: ?>
    <?php include_partial('flter_printable', array('reports_form_filter' => $reports_form_filter)) ?>  
<?php endif ?>

<br />

<?php if (!is_null($data)): ?>
  <?php if (count($data)): ?>
    <?php if (!$print_type): ?>
      <?php //echo link_to('Печать', 'report_motor_ship_bills', array('print' => 'print')) ?>
      <div style="text-align: right">
        <a href="<?php echo url_for('report_bills', array_merge($filter_print_values->getRawValue(), array('print' => 'excel'))) ?>"><img src="/magicLibsPlugin/images/excel24.png" alt="" /></a> &nbsp;
        <a href="<?php echo url_for('report_bills', array_merge($filter_print_values->getRawValue(), array('print' => 'print'))) ?>"><img src="/magicLibsPlugin/images/printer24.png" alt="" /></a>
      </div>
    <?php endif ?>  
    <?php include_partial('bills', array('data' => $data, 'amount_info' => $amount_info)) ?>
  <?php else: ?>
    Ничего не найдено 
  <?php endif ?>
<?php endif ?>