$(document).ready(function() {
  $('#online_order_dialog_form_apply').click(function () {
    saveOnlineOrderForm();
	
    disableOnlineOrderFormSubmits($(this));
  });

  $('#online_order_dialog_form_close').click(function () {
    $('#online_order_dialog').dialog('close');
  });
});

function showOnlineOrderForm()
{
  $('#online_order_dialog_form_close').hide();
  $('#online_order_dialog_form_apply').show();

  var inputData = getOnlineOrderAdditionalData();
  sendOnlineOrderData(inputData, 'renderOnlineOrderForm');
}

function saveOnlineOrderForm()
{
  var inputData = jQuery.extend(getOnlineOrderFormData(), getOnlineOrderAdditionalData());
  inputData['method'] = 'POST';
  sendOnlineOrderData(inputData, 'renderOnlineOrderForm');
}

function showOnlineOrderFormThankYouMessage(data)
{
  if (!data['has_errors'])
  {
    $('#online_order_dialog_form_apply').hide();
    $('#online_order_dialog_form_close').show();
    $('#online_order_dialog').dialog('option', 'minHeight', 100);
    $('#online_order_dialog').dialog('option', 'height', 'auto');
    $('#online_order_dialog_form').html(data['callback']['params']['message']);
  }
}

function sendOnlineOrderData(inputData, callbackFunctionOnSuccess)
{
  $.ajax({
    type: inputData['method'] ? inputData['method'] : 'GET',
    dataType: 'json',
    url:  RENTFLOT_ONLINE_ORDER,
    data: inputData,
    success:
      function(outputData, textStatus)
      {                       
        window[callbackFunctionOnSuccess](outputData);
      },
    async: true,
    error: function (e) {alert(e.status);}
  });
}

function getOnlineOrderFormData()
{
  var data = {};
  $('#online_order_dialog_form').find('input:text,select,textarea').each(function () {
    data[$(this).attr('name')] = $(this).val();
  });

  return data;
}

function getOnlineOrderAdditionalData()
{
  var data = {};
  data['item_slug'] = $('#online_order_dialog_form_item_slug').val();
  data['category_slug'] = $('#online_order_dialog_form_category_slug').val();

  return data;
}

function renderOnlineOrderForm(data)
{
  $('#online_order_dialog_form').html(data['form']);

  enableOnlineOrderFormSubmits();
  showOnlineOrderDialog();

  if (data['callback']['function'])
  {
    //window[data['callback']['function']](data);
	//only if form data submitted
	//redirecting to special
	//alert(1);
	location.href=$('#online_order_dialog_form_redirect_page').val();
  }
}

function showOnlineOrderDialog()
{
  $('#online_order_dialog').dialog({
    minWidth: 660,
    minHeight: 360,
    modal: true
  });

  $('#online_order_dialog_form_apply').show();
}


function disableOnlineOrderFormSubmits(clickedSubmit)
{
  clickedSubmit.blur();
  clickedSubmit.addClass('ClickedInput');
  $('#online_order_dialog').find(':button').each(function () {
    $(this).attr('disabled', 'disabled');
  });
}

function enableOnlineOrderFormSubmits()
{
  $('#online_order_dialog').find(':button').each(function () {
    $(this).removeClass('ClickedInput');
    $(this).removeAttr('disabled');
  });
}

