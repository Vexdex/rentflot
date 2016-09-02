$(document).ready(function() {
  
  if (CULTURE == 'en')
  {
    // Fixing position of Greece yachts dropdown menu
    $('.sm_greece_yachts').first().css('top', function (index, value) { return parseFloat(value) + 23; });
//    $('.sm_ships').first().css('top', function (index, value) { return parseFloat(value) + 50; });
//    $('.sm_yachts').first().css('top', function (index, value) { return parseFloat(value) + 50; });
  }

  $('.TipsyTooltip').tipsy({gravity: 's', html: 'true', offset: 0});
  
  // Dropdown menus
  
  $('td.menu_cell').bind('mouseover', function () {
    $(this).children('a').attr('class', 'active');
  });
  $('td.menu_cell').bind('mouseout', function () {
    $(this).children('a').attr('class', 'inactive');
  });
  
  /* sub menu odessa */
 $('body').on('mouseover','.menu_odessa_yachts,.menu_odessa_yachts_mobile',function () {
    $('#sub_menu_odessa_yachts').stop(true, true).fadeIn(); 
  });
   $('body').on('mouseout','.menu_odessa_yachts,.menu_odessa_yachts_mobile',function () {
    $('#sub_menu_odessa_yachts').stop(true, true).delay(200).fadeOut();
  });
  
   $('body').on('click','.left_topmenu_bottom_c .menu_odessa_yachts_mobile',function () {
	$('.left_topmenu_bottom_c #sub_menu_odessa_yachts').toggle(); 
	
  });

  
  
  $('#sub_menu_odessa_yachts').hover(function () {
    $('#sub_menu_odessa_yachts').stop(true, true).fadeIn();
  }, function () {
    $('#sub_menu_odessa_yachts').stop(true, true).delay(200).fadeOut();
  });
  
  /* sub menu croatia */
  $('#menu_croatia_yachts').hover(function () {
    $('#sub_menu_croatia_yachts').stop(true, true).fadeIn();
  }, function () {
    $('#sub_menu_croatia_yachts').stop(true, true).delay(200).fadeOut();
  });
  $('#sub_menu_croatia_yachts').hover(function () {
    $('#sub_menu_croatia_yachts').stop(true, true).fadeIn();
  }, function () {
    $('#sub_menu_croatia_yachts').stop(true, true).delay(200).fadeOut();
  });
  
  /* sub menu greece */
  $('#menu_greece_yachts').hover(function () {
    $('#sub_menu_greece_yachts').stop(true, true).fadeIn();
  }, function () {
    $('#sub_menu_greece_yachts').stop(true, true).delay(200).fadeOut();
  });
  $('#sub_menu_greece_yachts').hover(function () {
    $('#sub_menu_greece_yachts').stop(true, true).fadeIn();
  }, function () {
    $('#sub_menu_greece_yachts').stop(true, true).delay(200).fadeOut();
  });

  /* sub menu ships */
  $('#menu_motor_ships').hover(function () {
    $('#sub_menu_yachts').hide();
    $('#sub_menu_ships').stop(true, true).fadeIn();
  }, function () {
    $('#sub_menu_ships').stop(true, true).delay(200).fadeOut();
  });
  $('#sub_menu_ships').hover(function () {
    $('#sub_menu_yachts').hide();
    $('#sub_menu_ships').stop(true, true).fadeIn();
  }, function () {
    $('#sub_menu_ships').stop(true, true).delay(200).fadeOut();
  });  
  
  /* sub menu yachts */
  $('#menu_yachts').hover(function () {
    $('#sub_menu_yachts').stop(true, true).fadeIn();
  }, function () {
    $('#sub_menu_yachts').stop(true, true).delay(200).fadeOut();
  });
  $('#sub_menu_yachts').hover(function () {
    $('#sub_menu_yachts').stop(true, true).fadeIn();
  }, function () {
    $('#sub_menu_yachts').stop(true, true).delay(200).fadeOut();
  });
  
  $('#item_ru_name').bind('keyup change', function (event) {
    if (!$('#item_id').val())
    {
      $('#item_slug').val(slug($(this).val()));
    }
  });
  
  

  // По клику на span с количеством фоток - переход сразу к фотографиям (ссылкой не удалось реализовать)
  $('.prod_img_count,.attraction_img_count').bind('mouseover', function () {
    if (!$(this).parents('a').attr('old_href'))
    {
      $(this).parents('a').attr('old_href', $(this).parents('a').attr('href'));
    }
    $(this).parents('a').attr('href', $(this).parents('a').attr('href') + '#item_photos');
  });

  $('.prod_img_count,.attraction_img_count').bind('mouseout', function () {
    $(this).parents('a').attr('href', $(this).parents('a').attr('old_href'));
  });


  // Left ships menu button effect
//  onmousedown="this.style.margin = '';" onmouseup="this.style.margin = '2px 8px 2px 8px';" onmouseout="this.style.margin = '2px 8px 2px 8px';"
  $('.left_ships_menu').mousedown(function () {
    $(this).addClass('left_ships_menu_mouse_down');
  }).bind('mouseup mouseout', function () {
    $(this).removeClass('left_ships_menu_mouse_down');
  });

  // Top ships menu button effect
  $('.top_ships_menu_ru,.top_ships_menu_en').mousedown(function () {
    $(this).addClass('top_ships_menu_mouse_down');
  }).bind('mouseup mouseout', function () {
    $(this).removeClass('top_ships_menu_mouse_down');
  });
});


/** END OF document.ready **/


/**
 * Plugins for clearing comboboxes and adding a <loading> effect
 */
$.fn.resetOptions = function(disable, empty_text) {
  return this.each(function() {
    if ($(this).is('select'))
    {
      $(this).empty();
      if (disable)
      {
        $(this).attr('disabled', 'disabled');
      }
      else
      {
        $(this).removeAttr('disabled');
      }
      if (empty_text)
      {
        $(this).append('<option value="">' + empty_text + '</option>');
      }
    }
  });
};
$.fn.addLoading = function(text) {
  return this.each(function() {
    if ($(this).is('select'))
    {
      $(this).resetOptions(true, text);
      $(this).after('&nbsp;<img src="/images/loading/89.gif" alt="" title="'+str_grid[CULTURE]['loading']+'" id="' + $(this).attr('id') + '_loading" />');
    }
  });
};
$.fn.removeLoading = function(text) {
  return this.each(function() {
    if ($(this).is('select'))
    {
      $('#'+$(this).attr('id')+'_loading').remove();
      $(this).resetOptions(true, text);
    }
  });
};


