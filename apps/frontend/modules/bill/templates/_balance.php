  <div style="width: 80%; margin: 0 auto">
    <table cellspacing="0" class="GridList">
      <tr>
        <th></th>
        <th>В кассе<br/>грн.</th>
        <th>На счету<br/>грн.</th>
      </tr>
      <tr class="Odd">
        <td>Корабли</td>
        <td style="text-align: center"><?php echo format_price($orders_balance['amount_full_cash_uah']) ?></td>
        <td style="text-align: center"><?php echo format_price($orders_balance['amount_full_bank_uah']) ?></td>
      </tr>
      <tr class="Even">
        <td>Затраты и другое</td>
        <td style="text-align: center"><?php echo format_price($bills_balance['amount_full_cash_uah']) ?></td>
        <td style="text-align: center"><?php echo format_price($bills_balance['amount_full_bank_uah']) ?></td>
      </tr>
      <tr class="Odd">
        <td><strong>Всего</strong></td>
        <td style="text-align: center"><?php echo format_price($orders_balance['amount_full_cash_uah'] + $bills_balance['amount_full_cash_uah']) ?></td>
        <td style="text-align: center"><?php echo format_price($orders_balance['amount_full_bank_uah'] + $bills_balance['amount_full_bank_uah']) ?></td>
      </tr>
      <tr class="Even">
        <td><strong>Общая сумма</strong></td>
        <td colspan="2" style="text-align: center"><?php echo format_price($orders_balance['amount_full_cash_uah'] + $bills_balance['amount_full_cash_uah'] + $orders_balance['amount_full_bank_uah'] + $bills_balance['amount_full_bank_uah']) ?></td>
      </tr>
    </table>
  </div>