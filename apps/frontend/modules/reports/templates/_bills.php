<table class="Report">
  <tr>
    <th style="width: 40%" class="Left" rowspan="2">Индекс</th>
    <th style="width: 30%" colspan="2">Касса</th>
    <th style="width: 30%" colspan="2">Счет</th>
  </tr>
  <tr>
    <th style="width: 15%">Приход, грн.</th>
    <th style="width: 15%">Расход, грн.</th>
    <th style="width: 15%">Приход, грн.</th>
    <th style="width: 15%">Расход, грн.</th>
  </tr>
  <?php foreach ($data as $item): ?>
    <tr>
      <td class="Left"><?php echo $item['name'] ?></td>
      <td class="green"><?php echo format_price($item['Type'][2], ',') ?></td>
      <td class="red"><?php echo format_price($item['Type'][1], ',') ?></td>
      <td class="green"><?php echo format_price($item['Type'][4], ',') ?></td>
      <td class="red"><?php echo format_price($item['Type'][3], ',') ?></td>
    </tr>
  <?php endforeach ?>
  <tr class="Total">
    <td class="Right"><strong>Всего:</strong></td>
    <td class="green"><?php $income_uah = isset($amount_info[2]) ? $amount_info[2] : 0; echo format_price($income_uah, ',') ?></td>
    <td class="red"><?php $outcome_uah = isset($amount_info[1]) ? $amount_info[1] : 0; echo format_price($outcome_uah, ',') ?></td>
    <td class="green"><?php $income_bank_uah = isset($amount_info[4]) ? $amount_info[4] : 0; echo format_price($income_bank_uah, ',') ?></td>
    <td class="red"><?php $outcome_bank_uah = isset($amount_info[3]) ? $amount_info[3] : 0; echo format_price($outcome_bank_uah, ',') ?></td>
  </tr>  
  <tr>
    <td class="Right"><strong>Общая сумма:</strong></td>
    <td colspan="4"><strong><?php echo format_price($income_uah + $income_bank_uah - $outcome_uah - $outcome_bank_uah, ',') ?></strong></td>
  </tr>  
</table>