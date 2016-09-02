<table class="Report">
  <tr>
    <th class="Left" style="width: 35%" >Категория</th>
    <th style="width: 13%">Сумма, грн.</th>
    <th style="width: 13%">Затраты, грн.</th>
    <th style="width: 13%">Уже получили, грн.</th>
    <th style="width: 13%">Уже отдали, грн.</th>
    <th style="width: 13%">Рентабельность, %</th>
  </tr>
  <?php foreach ($data as $item): ?>
    <tr>
      <td class="Left"><?php echo format_price($item['category'], ',') ?></td>
      <td><?php echo format_price($item['amount_full_uah'], ',') ?></td>
      <td><?php echo format_price($item['amount_full_costs_uah'], ',') ?></td>
      <td><?php echo format_price($item['amount_full_payed_uah'], ',') ?></td>
      <td><?php echo format_price($item['amount_full_costs_payed_uah'], ',') ?></td>
      <td><?php echo format_price(round($item['profitability']), ',') ?></td>
    </tr>
  <?php endforeach ?>
    <tr class="Total">
      <td class="Right"><strong>Всего:</strong></td>
      <td><?php echo format_price($amount_info['amount_total_uah'], ',') ?></td>
      <td><?php echo format_price($amount_info['amount_total_costs_uah'], ',') ?></td>
      <td><?php echo format_price($amount_info['amount_total_payed_uah'], ',') ?></td>
      <td><?php echo format_price($amount_info['amount_total_costs_payed_uah'], ',') ?></td>
      <td>Ср. <?php echo format_price(round($amount_info['profitability_avg']), ',') ?></td>
    </tr>  
</table>