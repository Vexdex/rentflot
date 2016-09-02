<h1>Отчет "Свободные средства"</h1>

<br /><br />

<?php if (!$print_type): ?>
  <div style="text-align: right">
    <a href="<?php echo url_for('report_balance', array('print' => 'excel')) ?>"><img src="/magicLibsPlugin/images/excel24.png" alt="" /></a> &nbsp;
    <a href="<?php echo url_for('report_balance', array('print' => 'print')) ?>"><img src="/magicLibsPlugin/images/printer24.png" alt="" /></a>
  </div>
<?php endif ?>
  
<?php include_partial('balance', array('orders_balance' => $orders_balance, 'bills_balance' => $bills_balance)) ?>