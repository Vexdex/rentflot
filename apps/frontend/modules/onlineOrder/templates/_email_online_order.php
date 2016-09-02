<?php /* @var Order $order */ ?>

<strong>Ваш запрос успешно принят!</strong> <br /><br />

<strong>Номер заказа:</strong> <?php echo $order->getId() ?> <br/>
<strong>Заказ:</strong> <?php echo $item->getName() ?>  <?php /*echo "&mdash;"; echo $category->getName()*/ ?> <br/>
<strong>Телефон:</strong> <?php echo $order->getClient()->getPhones() ?><br/>
<strong>Дата аренды:</strong> <?php echo format_date($order->getDate(), 'd.MM.yyyy') ?><br/>

<?php if ($order->getPeopleCount(ESC_RAW)): ?>
  <strong>Количество гостей на борту:</strong> <?php echo $order->getPeopleCount() ?><br/>
<?php endif ?>

<?php if ($order->getAdditionalInformation(ESC_RAW)): ?>
  <strong>Комментарий:</strong> <?php echo nl2br($order->getAdditionalInformation()) ?><br/>
<?php endif ?>

<br />
<p>
  Наш менеджер с Вами свяжется в ближайшее время!<br/>
  Спасибо за доверие к нашей компании.
</p>
<br />

<p>
  <strong>Киевская судоходная компания «Рентфлот»</strong> <br />
  <?php echo link_to('www.rentflot..ua', 'http://www.rentflot.ua/') ?><br />
  <table>
    <tr>
      <td valign="top"><strong>Тел.:</strong></td>
      <td>
        +38 (044) 451-40-58 многоканальный городской Киевский <br />
        +38 (063) 237-10-96 Life <br />
        +38 (050) 312-32-64 MTS <br />
        +38 (096) 962-82-21 Kyivstar <br />
      </td>
    </tr>
  </table>
  <strong>E-mail:</strong> order@rentflot.ua <br />
  <strong>Адрес:</strong> г. Киев, 03150, ул. Большая Васильковская, 94, офис 121 <br />
  <strong>Skype:</strong> rentflot.ua <br />
  <strong>ICQ:</strong> 392-068-639 <br />
</p>


