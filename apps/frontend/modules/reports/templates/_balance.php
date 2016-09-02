<table cellspacing="0" class="Report">
  <tr>
    <th style="width: 40%"></th>
    <th style="width: 15%">Еще получить, грн.</th>
    <th style="width: 15%">Еще отдать, грн.</th>
    <th style="width: 15%">В кассе, грн.</th>
    <th style="width: 15%">На счету, грн.</th>
  </tr>
  <tr>
    <td class="Left">Корабли</td>
    <td><?php echo format_price($orders_balance['amount_full_left_uah'], ',') ?></td>
    <td><?php echo format_price($orders_balance['amount_full_costs_left_uah'], ',') ?></td>
    <td style="text-align: center"><?php echo format_price($orders_balance['amount_full_cash_uah'], ',') ?></td>
    <td style="text-align: center"><?php echo format_price($orders_balance['amount_full_bank_uah'], ',') ?></td>
  </tr>
  <tr>
    <td class="Left">Затраты и другое</td>
    <td></td>
    <td></td>
    <td style="text-align: center"><?php echo format_price($bills_balance['amount_full_cash_uah'], ',') ?></td>
    <td style="text-align: center"><?php echo format_price($bills_balance['amount_full_bank_uah'], ',') ?></td>
  </tr>
  <tr class="Total">
    <td class="Right"><strong>Всего:</strong></td>
    <td><?php echo format_price($orders_balance['amount_full_left_uah'], ',') ?></td>
    <td><?php echo format_price($orders_balance['amount_full_costs_left_uah'], ',') ?></td>
    <td style="text-align: center"><?php echo format_price($orders_balance['amount_full_cash_uah'] + $bills_balance['amount_full_cash_uah'], ',') ?></td>
    <td style="text-align: center"><?php echo format_price($orders_balance['amount_full_bank_uah'] + $bills_balance['amount_full_bank_uah'], ',') ?></td>
  </tr>
  <tr class="Total">
    <td class="Right"><strong>Свободные средства:</strong></td>
    <td colspan="4" style="text-align: center"><strong><?php echo format_price($orders_balance['amount_full_left_uah'] - $orders_balance['amount_full_costs_left_uah'] + $orders_balance['amount_full_cash_uah'] + $bills_balance['amount_full_cash_uah'] + $orders_balance['amount_full_bank_uah'] + $bills_balance['amount_full_bank_uah'], ',') ?></strong></td>
  </tr>
</table>
