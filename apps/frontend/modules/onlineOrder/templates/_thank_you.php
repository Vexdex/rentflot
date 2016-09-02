<?php /* @var Order $order */ ?>
<h3>Ваш запрос успешно принят!</h3>
<div style="font-size: 11px; text-align: left; margin-top: 15px">
  <strong>Заказ:</strong> <?php echo $item->getName() ?></strong> &mdash; <?php echo $category->getName() ?> <br/>
  <strong>Имя:</strong> <?php echo $order->getClient()->getName() ?><br/>
  <strong>Телефон:</strong> <?php echo $order->getClient()->getPhones() ?><br/>
  <strong>Дата и время аренды:</strong> <?php echo format_date($order->getDate(), 'd.MM.yyyy') ?>, <?php echo $order->getTime() ?><br/>

  <?php if ($order->getPeopleCount(ESC_RAW)): ?>
    <strong>Количество гостей на борту:</strong> <?php echo $order->getPeopleCount() ?><br/>
  <?php endif ?>

  <?php if ($order->getAdditionalInformation(ESC_RAW)): ?>
    <strong>Комментарий:</strong> <?php echo nl2br($order->getAdditionalInformation()) ?><br/>
  <?php endif ?>

  <p>
    Наш менеджер с Вами свяжется в ближайшее время!<br/>
    Спасибо за доверие к нашей компании.
  </p>
</div>