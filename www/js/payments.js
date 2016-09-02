VALIDATION_ERROR_MESSAGE_REQUIRED = '';
VALIDATION_ERROR_MESSAGE_NUMBER = '';
VALIDATION_ERROR_MESSAGE_GREATER_THAN = '';

RENTFLOT_PAYMENTS_GENERATE_XML_AND_SIGN = '';
checkForSubmitCounter = 0;

$(document).ready(function() {

  bindPaymentFormValidation();

  $('#payment_form').submit(function (event) {
    event.preventDefault();

    if ($(this).valid())
    {
      processSubmitLiqPayForm();
    }
  });
});

function bindPaymentFormValidation()
{
  $("#payment_form").validate({
    rules: {
      payment_form_amount: {
        required: true,
        number: true,
        min: 0.1
      },
      payment_form_order_id: {
        required: true
      }
    },
    messages: {
      payment_form_amount: {
        required: VALIDATION_ERROR_MESSAGE_REQUIRED,
        min: VALIDATION_ERROR_MESSAGE_GREATER_THAN,
        number: VALIDATION_ERROR_MESSAGE_NUMBER
      },
      payment_form_order_id: {
        required: VALIDATION_ERROR_MESSAGE_REQUIRED
      }
    },

    errorElement: "div",
    errorClass: 'Error',
    errorPlacement: function(error, element) {
      error.appendTo(element.closest('td'));
    },

    highlight: function(element, errorClass) {
      $(element).removeClass(errorClass);
    }
  });
}

function processSubmitLiqPayForm()
{
  if (!RENTFLOT_PAYMENTS_GENERATE_XML_AND_SIGN)
  {
    showErrorAndReloadPage();
  }

  $('#payment_form_submit').attr('disabled', 'disabled');

  // Send request for generate xml and sign on server
  sendPaymentRequest(RENTFLOT_PAYMENTS_GENERATE_XML_AND_SIGN, 'post', $('#payment_form').serialize());

  // Wait for server response
  var timer = null;
  var checkForSubmit = function ()
  {
    if (isLiqPayFormReadyForSubmit())
    {
      // Submit liqpay form
      clearInterval(timer);
      $('#liqpay_form').submit();
      resetPaymentValues();
    }

    if (checkForSubmitCounter > 15)
    {
      // Show error after ~8 sec (14 * 500 / 1000)
      clearInterval(timer);
      showErrorAndReloadPage();
    }

    checkForSubmitCounter++;
  };

  timer = window.setInterval(checkForSubmit, 500);
}

function isLiqPayFormReadyForSubmit()
{
  return $('#operation_xml').val() && $("#signature").val();
}

function showErrorAndReloadPage(error)
{
  if (!error)
  {
    error = 'Возникла ошибка при оплате. Попробуйте еще раз или обратитесь за помощью по тел. +38 (044) 451-40-58';
  }
  
  alert(error);

  window.location.reload();
}

function resetPaymentValues()
{
  checkForSubmitCounter = 0;

  $("#payment_form_amount").val('');
  $("#payment_form_currency").val('UAH');
  $("#payment_form_order_id").val('');
  $('#payment_form_submit').removeAttr('disabled');

  $("#operation_xml").val('');
  $("#signature").val('');
}

function sendPaymentRequest(url, method, inputData, callbackOnSuccess)
{
  if (!callbackOnSuccess)
  {
    callbackOnSuccess = 'processPaymentResponse';
  }

  $.ajax({
    type: method,
    dataType: 'json',
    url: url,
    data: inputData,
    success:
      function(response, textStatus)
      {
        window[callbackOnSuccess](response);
      },
    async: true,
    error: function (e) {
      showErrorAndReloadPage();
    }
  });
}

function processPaymentResponse(response)
{
  $('#operation_xml').val(response['xml']);
  $('#signature').val(response['signature']);
}
