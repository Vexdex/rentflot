<h1>Мастер-отчет по всем категориям</h1>


<?php if (!$print_type): ?>
    <?php include_partial('categories_flter', array('reports_form_filter' => $reports_form_filter)) ?>
  <?php else: ?>
    <?php include_partial('flter_printable', array('reports_form_filter' => $reports_form_filter)) ?>  
<?php endif ?>

<br /><br />

<?php if (!is_null($data)): ?>
  <?php if (count($data)): ?>
    <?php if (!$print_type): ?>
      <div style="text-align: right">
        <a href="<?php echo url_for('report_categories', array_merge($filter_print_values->getRawValue(), array('print' => 'excel'))) ?>"><img src="/magicLibsPlugin/images/excel24.png" alt="" /></a> &nbsp;
        <a href="<?php echo url_for('report_categories', array_merge($filter_print_values->getRawValue(), array('print' => 'print'))) ?>"><img src="/magicLibsPlugin/images/printer24.png" alt="" /></a>
      </div>
    <?php endif ?>  
    <?php include_partial('categories', array('data' => $data, 'amount_info' => $amount_info)) ?>
  <?php else: ?>
    Не найдено
  <?php endif ?>
<?php endif ?>