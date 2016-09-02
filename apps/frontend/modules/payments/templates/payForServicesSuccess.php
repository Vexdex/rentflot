<script type="text/javascript">
  VALIDATION_ERROR_MESSAGE_REQUIRED = '<?php echo __('payment_form_error_required', array(), 'payments') ?>';
  VALIDATION_ERROR_MESSAGE_NUMBER = '<?php echo __('payment_form_error_number', array(), 'payments') ?>';
  VALIDATION_ERROR_MESSAGE_GREATER_THAN = '<?php echo __('payment_form_error_greater_than', array('%value%' => 0.1), 'payments') ?>';
</script>

<h1 class="content payment"><?php echo __('pay_for_services_title', array(), 'payments') ?></h1>

<p><?php echo __('pay_for_services_info', array(), 'payments') ?>:</p>

<ul>
  <li class="kiev_phone">(044) 451-40-58 (<?php echo __('multi_channel', array(), 'payments') ?>)</li>
  <li class="kiev_phone">(044) 237-10-96</li>
  <li>(063) 237-10-96 (Life)</li>
  <li>(050) 312-32-64 (MTS, Viber)</li>
  <li>(096) 194-61-62 (Kyivstar)</li>
</ul>

<h3><?php echo __('payment_form', array(), 'payments') ?></h3>
<center>
  <form id="payment_form" method="post" accept-charset="utf-8" class="FrontendForm" style="margin-top: 10px" action="">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
        <tr>
          <td class="Title"><?php echo __('payment_form_amount', array(), 'payments') ?><span class="Required">*</span></td>
          <td class="Input">
            <input type="text" id="payment_form_amount" name="payment_form_amount" class="Input" style="width: 195px;" />
            <select id="payment_form_currency" name="payment_form_currency" class="Input" style="width: 50px;">
              <option value="UAH"><?php echo __('payment_form_uah', array(), 'payments') ?></option>
              <option value="USD"><?php echo __('payment_form_usd', array(), 'payments') ?></option>
              <option value="RUR"><?php echo __('payment_form_rur', array(), 'payments') ?></option>
              <option value="EUR"><?php echo __('payment_form_eur', array(), 'payments') ?></option>
            </select>
          </td>
        </tr>
        <tr>
          <td class="Title"><?php echo __('payment_form_order', array(), 'payments') ?><span class="Required">*</span></td>         
        </tr>
        <tr>
		<td>
            <input type="text" id="payment_form_order_id" name="payment_form_order_id" class="Input" />
          </td>
          <td colspan="2" align="center">
            <input id="payment_form_submit" name="payment_form_submit" class="button" style="width: 110px; height: 25px" value="<?php echo __('payment_form_submit', array(), 'payments') ?>" type="submit" />
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</center>
<h2 class="text1 jksldjfklsdjf129083">Здесь Вы можете перечислить средства за предоставленные услуги компании Рентфлот:</h2>
  <ul>
    <li>аренда теплохода, катера, яхты, гидроцикла</li>
      <li><a href="http://www.rentflot.ua/banquet.html" title="Банкет, фуршет от Рентфлота">банкет, фуршет на борту корабля, пикник на берегу</a></li>
        <li>услуги ведущего, диджея</li>
          <li>аренда спортивных и развлекательных аттракционов</li>
            </ul>

<div style="display: none">
  <form id="liqpay_form" action="https://www.liqpay.com/?do=clickNbuy" method="post" target="_blank">
    <input type="hidden" name="operation_xml" id="operation_xml" value="" />
    <input type="hidden" name="signature" id="signature" value="" />
  </form>
</div>