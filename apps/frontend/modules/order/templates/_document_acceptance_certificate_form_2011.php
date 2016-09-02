<p style="text-align: center"><img src="/images/documents/invoice_head.jpg" /></p>

<table style="width: 100%">
  <tr>
    <td style="width: 50%"><strong>ВИКОНАВЕЦЬ</strong></td>
    <td style="width: 50%"><strong>ЗАМОВНИК</strong></td>
  </tr>
  <tr>
    <td><?php echo nl2br($order->getSpd()->getSpdName(ESC_RAW)) ?> <br /></td>
    <td><?php echo $order->getClient()->getOrgName() ? $order->getClient()->getOrgName() : '___________________________________' ?></td>
  </tr>  
  <tr>
    <td></td>
    <td></td>
  </tr>    
</table>

<p style="text-align: center"><strong>АКТ</strong></p>
<p style="text-align: center">здачі-прийомки виконаних робіт № <?php echo $order->getId() ?> від <?php echo date('d.m.Y', strtotime($order->getDate().' +1 day')) ?></p>
<p>
Ми, що нижче підписалися, від Виконавця <?php echo $order->getSpd()->getSpdNameGenitive() ?><br />
та Замовника <?php echo $order->getClient()->getOrgName() ? $order->getClient()->getOrgName() : '___________________________________' ?><br />
склали цей акт про те, що Виконавець виконав для Замовника наступні послуги <br />
згідно рахунку-фактурі № <?php echo $order->getId() ?> від <?php echo format_date($order->getCreatedAt(), 'dd.MM.yyyy') ?>
</p>

<p>
  <table class="Bordered">
    <tr>
      <th style="width: 3%">№</th>
      <th style="width: 49%">Товар</th>
      <th style="width: 12%">Один. вимір.</th>
      <th style="width: 12%">Кількість</th>
      <th style="width: 12%">Ціна без ПДВ, грн.</th>
      <th style="width: 12%">Сума без ПДВ, грн.</th>
    </tr>
    <?php $amount_info = $order->getAmountInfo(); ?>
    
    <?php $motor_ship = $order->getFirstMotorShip() ?>
    <tr>
      <td>1</td>
      <td style="text-align: left; padding-left: 3px;"><?php if (!$motor_ship): ?>Організація заходу<?php else: ?><?php echo $motor_ship->getDocName() ?><?php endif ?> <?php echo format_date($order->getDate(), 'dd.MM.yyyy') ?></td>
      <td>захід</td>
      <td>1</td>
      <td><?php echo format_price($amount_info['amount_uah']) ?></td>
      <td><?php echo format_price($amount_info['amount_uah']) ?></td>
    </tr>
    
    <tr>
      <td style="text-align: right" colspan="5">
        Всього без ПДВ (0%)
      </td>
      <td>
        <?php echo format_price($amount_info['amount_uah']) ?>
      </td>
    </tr>    
    
  </table>
</p>

<p>
Всього на суму: <?php echo format_price($amount_info['amount_uah']) ?> грн. (<?php echo utf8_strtolower(num_to_text($amount_info['amount_uah'], array('грн.', 'грн.', 'грн.'), array('коп.', 'коп.', 'коп.'), 'uk',  true)) ?>)
</p>

<p>Взаєморозрахунки узгоджено, сторони взаємних притензій не мають.</p>

<br />
<br />

<table style="width: 100%">
  <tr>
    <td style="width: 50%">Від Виконавця</td>
    <td style="width: 50%">Від Замовника</td>
  </tr>
  <tr>
    <td style="width: 50%"><strong><?php //echo $order->getSpd()->getName() ?></strong></td>
    <td style="width: 50%"></td>
  </tr>  
</table>
