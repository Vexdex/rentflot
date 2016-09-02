EN_FIELDS_COUNT = 13;

var item_data = {};
var en_translations_hided = false;
var en_hide;
var order_add_href = '';

$(document).ready(function() {

  // Отображение опции обналичивания при создании записи в бухгалтерии
  $('#bill_type_id').bind('change', function () {
    if ($('#bill_type_id').val() == 3)
    {
      $('#form_bill_create_cash_income_row').show();
    }
    else
    {
      $('#form_bill_create_cash_income_row').hide();
    }
  });
    
  // Если на форме в заказе нету позиций, то скрываем блок
  hide_empty_order_items_form();


  bind_recalculation();

  // Обновление продолжительности при изменении time_to & time_from в заказе
  $('.order_time').bind('change', function () {
    var time_from = parseInt($('#order_time_from_hour').val(), 10) * 60 + parseInt($('#order_time_from_minute').val(), 10);
    var time_to = (parseInt($('#order_time_to_hour').val(), 10) || !parseInt($('#order_time_from_hour').val(), 10) ? parseInt($('#order_time_to_hour').val(), 10) : 24) * 60 + parseInt($('#order_time_to_minute').val(), 10);
    var diff = (time_to - time_from > 0) ? time_to - time_from : 24 * 60 - (time_from - time_to);
    var diff_hours = Math.floor(diff / 60);
    var diff_minutes = diff - diff_hours * 60;
    $('#order_duration').text(sprintf('%02d:%02d', diff_hours, diff_minutes));
  });

  // Обновление списка
  if ($('#dialog_category_id').length)
  {
    var category = $('#dialog_category_id');
    var item = $('#dialog_item_id');
    category.bind('change', function () {
      item.itemListByCategory(category, str_grid[CULTURE]['combo_none_el'], null);
    });
    //update_order_item_number();
  }
  
  //$('.TipsyTooltip').tipsy({gravity: 's', html: 'true', offset: 0});

  // Изменения статуса позиций в заказе
  $('.OrderItemStatusText').each(function () {
    $(this).updateOrderItemStatusText();
    $(this).bindOrderItemStatusUpdate();
  });


  // Скрытие переводов на англ.
  en_hide = setTimeout('hide_en_translations()', 100);

  // Автозаполнение "Даты до" в фильтре заказов
  /*$('#order_filters_date_from').bind('change,blur,keyup', function () {
    //alert($('#order_filters_date_from').val());
    var date = $('#order_filters_date_from').val();
    alert(date);
    if (date)
    {
      date = date.split('.');
      var date_obj = new Date(parseInt(date[2], 10), parseInt(date[1], 10) - 1, parseInt(date[0], 10));
      date = date_obj.format('d.mm.yyyy');
      $('#order_filters_date_to').val(date);
    }
  });*/

  if ($('#order_filters_date_from').length)
  {
    order_add_href = $('.GridActionAdd a').attr('href');
    /*$('.GridActionAdd a').bind('click', function (event) {
      event.preventDefault();
      goto_url(order_add_href+'?date='+order_filters_date_from_jquery_control.val());
    });*/
  }


  $('#order_item_container input:text').live('change keydown', function(e) {
    /*
    if (e.keyCode == 188)
    {
      e.preventDefault();
      //$(this).focus().trigger({ type : 'keypress', keyCode : 190 });
      //$(this).trigger(jQuery.Event('keypress', {keyCode : 190}));
      //$(this).val($(this).val().replace(',', '.'));
    }
    */
    if ($(this).val().indexOf(',') != -1)
    {
      $(this).val($(this).val().replace(',', '.'));
      $(this).selectRange($(this).val().indexOf('.') + 1, $(this).val().indexOf('.') + 1);
    }
  });

  $('#order_filters_category_id').bind('change', function () {
    $('#order_filters_item_id').itemListByCategory($('#order_filters_category_id'), str_grid[CULTURE]['combo_none_el'], $('#order_filters_item_id_val').val(), true);
  }).change();
});

function hide_en_translations()
{
  if (en_translations_hided)
  {
    clearTimeout(en_hide);
  }
  else
  {
    // Ждем пока все поля TinyMCE не будут загружены
    if ($('#item_form span[id*="_en_"]').length == EN_FIELDS_COUNT)
    {
      $('#item_form span[id*="_en_"][id*="_parent"]').each(function () {
        $('<span class="Link" onclick="$(\'#' + $(this).attr('id') + '\').show(); $(this).remove()">Показать форму перевода</span>').insertBefore($(this));
        $(this).hide();
      });
      en_translations_hided = true;
    }
    else
    {
      en_hide = setTimeout('hide_en_translations()', 100);
    }
  }
}

/**
 * Обновление статуса позиции в заказе
 */
$.fn.bindOrderItemStatusUpdate = function() {
  $(this).bind('click', function () {
    var status_id = $(this).next('input[type="hidden"]:first');
    var current_val = status_id.val();

    if (current_val) {
      var next = false;
      $.each(order_item_statuses, function (index, value) {
        if (next) {
          status_id.val(index);
          return false;
        }
        if (index == current_val) {
          next = true;
        }
      });
    }

    if (!current_val || current_val == status_id.val()) {
      status_id.val(get_first_key(order_item_statuses));
    }
    $(this).updateOrderItemStatusText();
  });
};

/**
 * Обновление текста статуса позиции в заказе
 */
$.fn.updateOrderItemStatusText = function()
{
  var status_id_field = $(this).next('input[type="hidden"]:first');
  var status_id = status_id_field.val();
  if (status_id_field.length)
  {
    if (!status_id)
    {
      status_id_field.val(get_first_key(order_item_statuses));
      status_id = status_id_field.val();
    }
    $(this).text(order_item_statuses[status_id]);

    var class_names = '';
    $.each(order_item_statuses, function (index) {
      class_names += 'OrderItemStatus' + index + ' ';
    });
    $(this).removeClass(class_names);
    $(this).addClass('OrderItemStatus' + status_id);
  }
};


function update_amount_costs_uah(my_tr)
{  
  var commission_percent = parseFloat(my_tr.find('.order_item_commision_percent').val(), 10);      
  if (commission_percent > 0)  
  {  
    my_tr.find('.order_item_amount_costs_uah').val(format_price_auto((my_tr.find('.order_item_amount_uah').val() * (1 - commission_percent / 100)).toFixed(2)));           
    my_tr.find('.order_item_commision_percent_link').addClass('CostsActual').removeClass('CostsOutdated');
  }
}

function check_is_actual_amount_costs_uah(my_tr)
{
  var commission_percent = parseFloat(my_tr.find('.order_item_commision_percent').val(), 10);
  var actual_amount_costs_uah = format_price_auto((my_tr.find('.order_item_amount_uah').val() * (1 - commission_percent / 100)).toFixed(2));   
  if (commission_percent > 0)
  {
    if (actual_amount_costs_uah == amount_costs_uah(my_tr))
    {
      my_tr.find('.order_item_commision_percent_link').addClass('CostsActual').removeClass('CostsOutdated');
      return true;
    }
    else
    {
      my_tr.find('.order_item_commision_percent_link').addClass('CostsOutdated').removeClass('CostsActual');
      return false;
    }
  }
  return null;
}

function bind_recalculation()
{
  var i = 0;  
  $('#order_item_container tbody:first tr').each(function(){
    var my_tr = $(this);
    //alert(my_tr.attr('id'));
    
    /*
    var count = my_tr.find('.order_item_count').val();
    var price_uah = my_tr.find('.order_item_price_uah').val();
    var amount_payed_uah = my_tr.find('.order_item_amount_payed_uah').val();
    var amount_payed_bank_uah = my_tr.find('.order_item_amount_payed_bank_uah').val();
    var amount_costs_uah = my_tr.find('.order_item_amount_costs_uah').val();
    var amount_costs_payed_uah = my_tr.find('.order_item_amount_costs_payed_uah').val();
    
    var amount_uah = (count(my_tr) * price_uah).toFixed(2);            
    var amount_left_uah = (amount_uah - amount_payed_uah - amount_payed_bank_uah).toFixed(2);    
    var amount_costs_left_uah = (amount_costs_uah - amount_costs_payed_uah).toFixed(2);
    var profit_uah = (amount_uah - amount_costs_uah).toFixed(2);
    */

    my_tr.find('.order_item_amount_uah').val(amount_uah(my_tr));          
    my_tr.find('.order_item_amount_left_uah').text(amount_left_uah(my_tr));          
    my_tr.find('.order_item_amount_costs_left_uah').text(amount_costs_left_uah(my_tr));          
    my_tr.find('.order_item_profit_uah').text(profit_uah(my_tr));  
    
    recalc_total();
    
    check_is_actual_amount_costs_uah(my_tr);
    
    my_tr.find('input[type=text]').each(function() {      
      $(this).bind('focus', function() {
        if (!parseFloat($(this).val()))
        {
          $(this).val('');
        }
      })
    });
    
    my_tr.find('input[type=text]').each(function() {      
      $(this).bind('blur', function() {
        if (!parseFloat($(this).val()))
        {
          $(this).val(0);
        }
      })
    });
          
    my_tr.find('.order_item_count, .order_item_price_uah').each(function() {    
      $(this).focus(function () {
        // Store the current value on focus, before it changes
        //prev_amount_uah = my_tr.find('.order_item_amount_uah').val();        
      }).bind('change keyup', function() {            
        check_is_actual_amount_costs_uah(my_tr);
        my_tr.find('.order_item_amount_uah').val(amount_uah(my_tr));
        my_tr.find('.order_item_profit_uah').text(profit_uah(my_tr));          
        $(this).blur();
        $(this).focus();        
        recalc_total();
      });         
    });
    
    
    my_tr.find('.order_item_amount_uah').each(function() {      
      //var prev_amount_uah = null;
      $(this).focus(function () {
        // Store the current value on focus, before it changes
        //prev_amount_uah = this.value;        
      }).bind('change keyup', function() {            
        check_is_actual_amount_costs_uah(my_tr);
        my_tr.find('.order_item_price_uah').val(price_uah(my_tr, true));          
        my_tr.find('.order_item_profit_uah').text(profit_uah(my_tr));          
        //$('#order_item_amount_full_uah').text(amount_full_uah()); 
        //update_amount_costs_uah(prev_amount_uah, my_tr);        
        my_tr.find('.order_item_amount_uah').blur();
        my_tr.find('.order_item_amount_uah').focus();
        //$('#commision_percent').addClass('CostsOutdated').removeClass('CostsActual');
        recalc_total();
      });
    });

    my_tr.find('.order_item_count, .order_item_price_uah, .order_item_amount_uah, .order_item_amount_payed_uah, .order_item_amount_payed_bank_uah').each(function() {      
      $(this).bind('change keyup', function() {            
        //amount_left_uah = my_tr.find('.order_item_count').val() * my_tr.find('.order_item_price_uah').val() - my_tr.find('.order_item_amount_payed_uah').val() - my_tr.find('.order_item_amount_payed_bank_uah').val();
        my_tr.find('.order_item_amount_left_uah').text(amount_left_uah(my_tr));         
        //$('#order_item_amount_payed_full_uah').text(amount_payed_full_uah());
        //$('#order_item_amount_payed_bank_full_uah').text(amount_payed_bank_full_uah());
        //$('#order_item_amount_left_full_uah').text(amount_left_full_uah());
        recalc_total();
      });
    });
    
    my_tr.find('.order_item_amount_costs_uah, .order_item_amount_costs_payed_uah').each(function() {      
      $(this).bind('change keyup', function() {            
        //amount_costs_left_uah = my_tr.find('.order_item_amount_costs_uah').val() - my_tr.find('.order_item_amount_costs_payed_uah').val();
        check_is_actual_amount_costs_uah(my_tr);
        my_tr.find('.order_item_amount_costs_left_uah').text(amount_costs_left_uah(my_tr));                  
        //$('#order_item_amount_costs_full_uah').text(amount_costs_full_uah());
        //$('#order_item_amount_costs_payed_full_uah').text(amount_costs_payed_full_uah());
        //$('#order_item_amount_costs_left_full_uah').text(amount_costs_left_full_uah());        
        recalc_total();
      });
    });
    
    my_tr.find('.order_item_amount_uah, .order_item_amount_costs_uah').each(function() {      
      $(this).bind('change keyup', function() {            
        //profit_uah = my_tr.find('.order_item_amount_uah').val() - my_tr.find('.order_item_amount_costs_uah').val();
        my_tr.find('.order_item_profit_uah').text(profit_uah(my_tr));          
        //$('#order_item_profit_full_uah').text(profit_full_uah());        
        recalc_total();
      });
    });
    
    my_tr.find('.order_item_commision_percent_link').each(function() {    
      $(this).click(function () {
        update_amount_costs_uah(my_tr);      
        my_tr.find('.order_item_amount_costs_left_uah').text(amount_costs_left_uah(my_tr));    
        my_tr.find('.order_item_profit_uah').text(profit_uah(my_tr));
        recalc_total(); 
      });
      
    });
    
  });  
}


/**
 * Пересчет строки "Всего"
 */
function recalc_total()
{
  $('#order_item_amount_full_uah').text(amount_full_uah());
  $('#order_item_profit_full_uah').text(profit_full_uah());  
  $('#order_item_amount_payed_full_uah').text(amount_payed_full_uah());
  $('#order_item_amount_payed_bank_full_uah').text(amount_payed_bank_full_uah());
  $('#order_item_amount_left_full_uah').text(amount_left_full_uah());  
  $('#order_item_amount_costs_full_uah').text(amount_costs_full_uah());
  $('#order_item_amount_costs_payed_full_uah').text(amount_costs_payed_full_uah());
  $('#order_item_amount_costs_left_full_uah').text(amount_costs_left_full_uah());        
}

function count(my_tr)
{
  var count = parseFloat(my_tr.find('.order_item_count').val(), 10).toFixed(2);
  return !isNaN(count) ? format_price_auto(count) : 0;
}

function price_uah(my_tr, calculate)
{
  if (calculate)
  {    
    var price_uah = count(my_tr) != 0 ? (parseFloat(my_tr.find('.order_item_amount_uah').val(), 10) / count(my_tr)).toFixed(2) : 0;
  }
  else
  {
    var price_uah = parseFloat(my_tr.find('.order_item_price_uah').val(), 10).toFixed(2);
  }
  
  return !isNaN(price_uah) ? format_price_auto(price_uah) : 0;
}

function amount_payed_uah(my_tr)
{
  var amount_payed_uah = parseFloat(my_tr.find('.order_item_amount_payed_uah').val(), 10).toFixed(2);
  return !isNaN(amount_payed_uah) ? format_price_auto(amount_payed_uah) : 0;
}

function amount_payed_bank_uah(my_tr)
{
  var amount_payed_bank_uah = parseFloat(my_tr.find('.order_item_amount_payed_bank_uah').val(), 10).toFixed(2);
  return !isNaN(amount_payed_bank_uah) ? format_price_auto(amount_payed_bank_uah) : 0;
}
    
function amount_costs_uah(my_tr)
{
  var amount_costs_uah = parseFloat(my_tr.find('.order_item_amount_costs_uah').val(), 10).toFixed(2);
  return !isNaN(amount_costs_uah) ? format_price_auto(amount_costs_uah) : 0;
}

function amount_costs_payed_uah(my_tr)
{
  var amount_costs_payed_uah = parseFloat(my_tr.find('.order_item_amount_costs_payed_uah').val(), 10).toFixed(2);
  return !isNaN(amount_costs_payed_uah) ? format_price_auto(amount_costs_payed_uah) : 0;
}

function amount_uah(my_tr)
{
  var amount_uah = (count(my_tr) * price_uah(my_tr, false)).toFixed(2);            
  return !isNaN(amount_uah) ? format_price_auto(amount_uah) : 0;  
}    
    
function amount_left_uah(my_tr)
{
  var amount_left_uah = (amount_uah(my_tr) - amount_payed_uah(my_tr) - amount_payed_bank_uah(my_tr)).toFixed(2);    
  return format_price_auto(amount_left_uah);
}
    
function amount_costs_left_uah(my_tr)
{
  var amount_costs_left_uah = (amount_costs_uah(my_tr) - amount_costs_payed_uah(my_tr)).toFixed(2);
  return format_price_auto(amount_costs_left_uah);
}
    
function profit_uah(my_tr)
{
  var profit_uah = (amount_uah(my_tr) - amount_costs_uah(my_tr)).toFixed(2);
  return format_price_auto(profit_uah);
}

function amount_full_uah()
{
  var amount_uah = 0;
  $('#order_item_container .order_item_amount_uah').each(function(){
    amount_uah += !isNaN(parseFloat($(this).val(), 10)) ? parseFloat($(this).val(), 10) : 0;    
  }); 
  return format_price_auto(amount_uah.toFixed(2));
}

function amount_payed_full_uah()
{
  var amount_payed_uah = 0;  
  $('#order_item_container .order_item_amount_payed_uah').each(function(){
    amount_payed_uah += !isNaN(parseFloat($(this).val(), 10)) ? parseFloat($(this).val(), 10) : 0;    
  });
  return format_price_auto(amount_payed_uah.toFixed(2));
}

function amount_payed_bank_full_uah()
{
  var amount_payed_bank_uah = 0;  
  $('#order_item_container .order_item_amount_payed_bank_uah').each(function(){
    amount_payed_bank_uah += !isNaN(parseFloat($(this).val(), 10)) ? parseFloat($(this).val(), 10) : 0;    
  }); 
  return format_price_auto(amount_payed_bank_uah.toFixed(2));  
}

function amount_left_full_uah()
{
  var amount_left_full_uah = amount_full_uah() - amount_payed_full_uah() - amount_payed_bank_full_uah();
  return format_price_auto(amount_left_full_uah.toFixed(2));
}

function amount_costs_full_uah()
{
  var amount_costs_uah = 0;  
  $('#order_item_container .order_item_amount_costs_uah').each(function(){
    amount_costs_uah += !isNaN(parseFloat($(this).val(), 10)) ? parseFloat($(this).val(), 10) : 0;    
  }); 
  return format_price_auto(amount_costs_uah.toFixed(2));  
}

function amount_costs_payed_full_uah()
{
  var amount_costs_payed_uah = 0;  
  $('#order_item_container .order_item_amount_costs_payed_uah').each(function(){
    amount_costs_payed_uah += !isNaN(parseFloat($(this).val(), 10)) ? parseFloat($(this).val(), 10) : 0;    
  }); 
  return format_price_auto(amount_costs_payed_uah.toFixed(2));  
}

function amount_costs_left_full_uah()
{
  var amount_costs_left_full_uah = amount_costs_full_uah() - amount_costs_payed_full_uah();
  return format_price_auto(amount_costs_left_full_uah.toFixed(2));
}

function profit_full_uah()
{
  var profit_full_uah = amount_full_uah() - amount_costs_full_uah();
  return format_price_auto(profit_full_uah.toFixed(2));
}

function hide_empty_order_items_form()
{  
  if (!$('#order_item_container .OrderItemStatus').length)
  {
    $('#order_item_container').hide();
  }
  else
  {
    $('#order_item_container').show();
  }  
}

function report_print(url)
{
  $("#reports_form_filter").attr("action", url);
  $("#reports_form_filter").submit();
}


function toggle_admin_info()
{
  $('#order_item_container .admin_info').toggle();
}

function update_item_by_category_form(item_id)
{
  if (item_id)
  {
    var category_id = category_by_item(item_id);
    $('#dialog_category_id option[value="' + category_id + '"]').attr('selected', 'selected');
  }
}

function category_by_item(item_id)
{
  return $.ajax({
    type: 'POST',
    url:  RENTFLOT_CATEGORY_BY_ITEM,
    data: {
      'item_id': item_id
    },
    async: false
  }).responseText;
}

/*
function update_order_item_number()
{
  var i = 0;
  $('#order_item_container .order_item_number').each(function(){
    i++;
    $(this).text(i);
  });  
}
*/

function delete_new_form(container_id) 
{
  $('#'+container_id).remove();
  recalc_total();
  hide_empty_order_items_form();
}

function get_order_item_forms_html(order_item_count, item_id, duration)
{  
  return $.ajax({
    type: 'POST',
    url:  RENTFLOT_ORDER_ITEM_ADD,
    data: {
      'order_item_count': order_item_count,
      'item_id': item_id,
      'duration': duration
    },
    async: false
  }).responseText;
}

function add_order_item(container_id)
{    
  var action = $('#item_by_category_dialog').dialog('option', 'action');
  var item_row_id = $('#item_by_category_dialog').dialog('option', 'item_row_id');

  var ids_exists = [];
  $('#order_form').find('.order_item_id').each(function () {    
    ids_exists.push($(this).val());
  });  
   
  if ($('#dialog_item_id').val() && jQuery.inArray($('#dialog_item_id').val(), ids_exists) === -1)
  {
    if (action == 'add')
    {
      $('#' + container_id + ' .admin_info').show();
      $('#' + container_id + ' tbody:first').append(get_order_item_forms_html(order_item_count, $('#dialog_item_id').val(), $('#order_duration').text()));
      //update_order_item_number();
      bind_recalculation();
      recalc_total();

      $('#order_item_form_new_' + order_item_count + ' .OrderItemStatusText').each(function () {
        $(this).updateOrderItemStatusText();
        $(this).bindOrderItemStatusUpdate();
      });

      order_item_count++;      
    }
    
    if (action == 'update')
    {      
      $('#' + item_row_id + ' .order_item_id').val($('#dialog_item_id option:selected').val());
      $('#' + item_row_id + ' .order_item_name').text($('#dialog_item_id option:selected').text());          
      $('#' + item_row_id + ' .order_item_unit_type').text(item_data[$('#dialog_item_id option:selected').val()][2]);      
      $('#' + item_row_id + ' .order_item_price_uah').val(item_data[$('#dialog_item_id option:selected').val()][3]);
      bind_recalculation();      
    }
            
    $('#item_by_category_dialog').dialog('close');
  }
  else
  {
    if (action == 'update' && $('#dialog_item_id').val() == $('#' + item_row_id + ' .order_item_id').val() || !$('#dialog_item_id').val())
    {
      $('#item_by_category_dialog').dialog('close');
    }
    else
    {
      alert('Невозможно добавить две одинаковые позиции в заказ!');
    }
  }
  
  hide_empty_order_items_form();
}  



//function add_order_item()
//{
  //$('#order_item_container').append('<tr><td><input type="hidden" name="item_id" id="item_id" value="' + $('#item_id').val() + '" />' + $('#item_id option:selected').text()  + '</td></tr>');
  /*
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url:  RENTFLOT_CLIENT_SAVE_FORM,
    data: {
      'data':      data
    },
    success: 
      function(data, textStatus)
      { 
        if (data['client_id'])
        {
          $('#order_client_id option').removeAttr('selected');
          $('#order_client_id').prepend('<option selected="selected" value="'+data['client_id']+'">'+data['client_name']+'</option>');
          //$("#order_client_id option:first").attr('selected','selected');
          $("#client_dialog" ).dialog('close');
        }
        else
        {
          $('#client_dialog_form').empty();
          $('#client_dialog_form').append(data['client_form_partial']);                
        }
      },
    async: true,
    //error: function (e) {alert(e.status);}
  }).responseText;  
  */

//}

$.fn.itemListByCategory = function (category, disabled_text, default_value, add_empty)
{  
  var item = $(this);
  // LOADING
  item.addLoading(str_grid[CULTURE]['loading']);
 
  $.ajax({
    type: 'POST',
    dataType: 'json',
    data: {
      'category_id': category.val()
    },
    timeout: 5000,
    success:
      function(data, textStatus)
      {
        if (!data['error'])
        {
          item_data = data;
          item.removeLoading(disabled_text);
          item.empty();

          if (add_empty)
          {
            item.append('<option value=""></option>');
          }

          $.each(data, function(i, val)
          {
            item.append('<option value="' + (val[0] ? val[0] : '') + '"' + (default_value && default_value == val[0] ? ' selected="selected"' : '') + '>' + val[1] + '</option>');
          });
          item.removeAttr('disabled');
        }
        else
        {
          item.removeLoading(disabled_text);
        }
      },
    error:
      function (e) {
        item.removeLoading(disabled_text);
      },
    url: RENTFLOT_ITEM_LIST_BY_CATEGORY
  });  
};

function show_item_by_category_form(action, item_row_id)
{  
  $('#order_item_form_apply').val(action == 'add' ? 'Добавить в заказ' : 'Обновить');

  $('#item_by_category_dialog').dialog({
    action: action,
    item_row_id: item_row_id,
    minWidth: 600,
    modal: true
  });  
  
  if (action == 'update')
  {    
    update_item_by_category_form($('#'+item_row_id+' .order_item_id').val());
  }

  $('#dialog_item_id').itemListByCategory($('#dialog_category_id'), str_grid[CULTURE]['combo_none_el'], $('#'+item_row_id+' .order_item_id').val());
}

function save_client_form()
{
  var data = {};
  $('#client_form').find('input:text,select,textarea').each(function () {
    data[$(this).attr('name')] = $(this).val();
  });  

  $.ajax({
    type: 'POST',
    dataType: 'json',
    url:  RENTFLOT_CLIENT_SAVE_FORM,
    data: {
      'data':      data,
      'is_new':    $('#client_form_is_new').val(),
      'client_id':  $('#order_client_id').val()
    },
    success: 
      function(data, textStatus)
      { 
        if (data['client_id'])
        {
          //alert($('#client_form_is_new').val());
          
            var client_name = [];
            
            if (data['org_name']) 
            {
              client_name.push(data['org_name']);
            }
            
            client_name.push(data['name']);
            
            if (data['phones'])
            {
              client_name.push(data['phones']);
            }
          
          if ($('#client_form_is_new').val() == 1)
          {                     
            $('#order_client_id option').removeAttr('selected');
            //$('#order_client_id').prepend('<option selected="selected" value="'+data['client_id']+'">'+client_name.join(', ')+'</option>');
            $('#order_client_id').append('<option selected="selected" value="'+data['client_id']+'">'+client_name.join(', ')+'</option>');
          }
          else
          {
            $('#order_client_id option[value="' +  $('#order_client_id').val() + '"]').val(data['client_id']);
            $('#order_client_id option[value="' +  $('#order_client_id').val() + '"]').text(client_name.join(', '));
          }
          
          $("#client_dialog" ).dialog('close');
        }
        else
        {
          $('#client_dialog_form').empty();
          $('#client_dialog_form').append(data['client_form_partial']);                
        }
      },
    async: true
    //error: function (e) {alert(e.status);}
  });
}

function show_client_form(is_new)
{  
  $('#client_form_is_new').val(is_new);
  $('#client_dialog_form').empty();
  
  $.ajax({
    type: 'POST',
    //dataType: 'json',
    url:  RENTFLOT_CLIENT_SHOW_FORM,
    data: {
      'client_id':  $('#order_client_id').val(),
      'is_new': is_new
    },
    success: 
      function(data, textStatus)
      {                 
        $('#client_dialog_form').append(data);        
      },
    async: true,
    error: function (e) {alert(e.status);}
  });

  $( "#client_dialog" ).dialog({
    minWidth: 500,
    minHeight: 450,
    modal: true,
    title: is_new ? 'Добавление нового клиента' : 'Редактирование клиента'
  });  
}
