<table class="Report">
  <tr>
    <th style="width: 8%">Номер заказа</th>
    <th style="width: 8%">Дата выхода в рейс</th>
    <th style="width: 40%">Позиция, время, продолжительность, количество чел.</th>
    <th style="width: 9%">Счет, грн.</th>
    <th style="width: 9%">Уже получили, грн.</th>
    <th style="width: 9%">Уже получили (безнал.), грн.</th>
    <th style="width: 8%">Еще получим, грн.</th>
    <th style="width: 9%">Затраты, грн.</th>
    <th style="width: 9%">Уже отдали, грн.</th>
    <th style="width: 8%">Еще отдать, грн.</th>
  </tr>
  <?php foreach ($data as $item): ?>
    <tr>
      <td>
        <?php if ($print_type != 'excel'): ?>
          <a href="<?php echo url_for('order_edit', array('id' => $item['Order']['id']), true) ?>"
             target="_blank"
             title="Редактирование заказа (в новом окне)"
            <?php if ($print_type): ?>style="color: #333; text-decoration: none"<?php endif?>><?php echo $item['Order']['id'] ?></a>
        <?php else: ?>
          <?php echo $item['Order']['id'] ?>
        <?php endif ?>
      </td>
      <td>
        <?php echo format_date($item['Order']['date'], 'dd.MM.yyyy') ?>
      </td>
      <td class="Left" style="padding-left: 5px">
        <?php echo $item['Item']['internal_name'] ?>, <?php echo format_date($item['Order']['time_from'], 'HH:mm') ?>-<?php echo format_date($item['Order']['time_to'], 'HH:mm') ?>, <?php $duration = time_diff($item['Order']['time_from'], $item['Order']['time_to'])?><?php echo sprintf('%01d:%02d', $duration['hours'], $duration['minutes']) ?> час.<?php if ($item['Order']['people_count']): ?>, <?php echo $item['Order']['people_count'] ?> чел. <?php endif ?>
      </td>
      <td><?php echo format_price($item['amount_uah'], ',') ?></td>
      <td><?php echo format_price($item['amount_payed_uah'], ',') ?></td>
      <td><?php echo format_price($item['amount_payed_bank_uah'], ',') ?></td>
      <td><?php echo format_price($item['amount_left_uah'], ',') ?></td>
      <td><?php echo format_price($item['amount_costs_uah'], ',') ?></td>
      <td><?php echo format_price($item['amount_costs_payed_uah'], ',') ?></td>
      <td><?php echo format_price($item['amount_costs_left_uah'], ',') ?></td>
    </tr>    
  <?php endforeach ?>
  <tr class="Total">
    <td colspan="3"></td>
    <td colspan="4" class="Right"><nobr><strong>Получить:</strong> <?php echo format_price($amount_info['amount_left_uah'], ',') ?> грн.</nobr></td>
    <td colspan="3" class="Right"><nobr><strong>Отдать:</strong> <?php echo format_price($amount_info['amount_costs_left_uah'], ',') ?> грн.</nobr></td>
  </tr>
  <tr class="Total">
    <td colspan="3"></td>
    <td colspan="4" class="Right"><strong>Всего выдано:</strong></td>
    <td colspan="3"><?php echo format_price($amount_info['amount_costs_left_uah'] - $amount_info['amount_left_uah'], ',') ?> грн.</td>
  </tr>
</table>
