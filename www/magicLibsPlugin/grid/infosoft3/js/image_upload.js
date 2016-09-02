var photo_index = 0;

function remove_image(image_id)
{
    $('#' + image_id).remove();
}

function add_object_image(container_id)
{
  if ($('#' + container_id).length)
  {
      var add_image_str = $('#object_images_count').val() > 0 ? str_grid[CULTURE]['additional_image'] : str_grid[CULTURE]['image'];
      photo_index++;
      var new_image_html = '<tr id="new_image_' + photo_index + '">';
      new_image_html += '<td class="Light3" style="padding: 5px">' + add_image_str + ' #' + photo_index + '<br/>';
      
      new_image_html += '<div style="float:left;">';
      new_image_html += '<input name="object_images[' + photo_index + ']" id="object_images[' + photo_index + ']" type="file" />&nbsp;';
      new_image_html += '<img style="cursor: pointer" src="/magicLibsPlugin/images/delete.png" onclick="remove_image(\'new_image_' + photo_index + '\'); return false;" title="' + str_grid[CULTURE]['delete_image'] + '"/>';
      new_image_html += '</div>';
      new_image_html += '<br/>';
      new_image_html += '<br/>';
      new_image_html += '<div style="margin-top: 10px;">По-русски:</div>';
      new_image_html += '<span style="width:50px;">alt: </span>';
      new_image_html += '<input type="text" style="width: 250px;" name="image_alt_' + photo_index + '" />';
      new_image_html += '<span style="width:50px;"> title: </span>';
      new_image_html += '<input type="text" style="width: 250px;" name="image_title_' + photo_index + '"/>';
      new_image_html += '<div style="margin-top: 10px;">In English:</div>';
      new_image_html += '<span style="width:50px;"> alt: </span>';
      new_image_html += '<input type="text" style="width: 250px;" name="image_alt_en_' + photo_index + '" />';
      new_image_html += '<span style="width:50px;"> title: </span>';
      new_image_html += '<input type="text" style="width: 250px;" name="image_title_en_' + photo_index + '"/>';
      new_image_html += '</td>';
      
      new_image_html += '</tr>';
      
      $('#' + container_id).append(new_image_html);

$("#object_images_sortable tbody:first").find("input")
 .bind('mousedown.ui-disableSelection selectstart.ui-disableSelection', function(e) {
  e.stopImmediatePropagation();
});
  } 
  else
  {
      alert(str_grid['photo_error_add']);
  }
}

function getEscapeId(myid) 
{    
  return '#' + myid.replace(/(:|\.|\[|\])/g,'\\$1');
}

function change_class_attr(element, tr_id)
{
  $(document).ready(function() {
    //var jq_el_id = getEscapeId(element.id);
    var jq_tr_id = "#" + tr_id;
    if (element.value) {$(jq_tr_id).attr('class', 'object_images_remove');}
      else {
        {$(jq_tr_id).removeAttr('class', 'object_images_remove');}
      }
    
   });
}

function add_image_order_data()
{
  $('#image_order_data').empty();     
	$('#object_images_sortable tbody:first').children('tr').children('td').not('#add_object_image_control').children('.images_order_ids').each(function(idx, elm) {
	  $('<input type="hidden" name="object_images_order[]" value="' + $(this).val() + '" />').appendTo('#image_order_data');
  });  			
}

$(document).ready(function(){  
	add_image_order_data();					   
	
  var fixHelper = function(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
  };

  $("#object_images_sortable tbody:first").sortable({
    opacity: 0.6,
    cursor: 'move',
    cancel: '#add_object_image_control input .selinput',
    helper: 'clone',
    //helper: fixHelper,
    update: function() {
        //$("#contentRight").html(theResponse);
        //$('#photos_order').val($(this).sortable("serialize"));
      add_image_order_data();
    }								  
  });

$("#object_images_sortable tbody:first").find("input")
 .bind('mousedown.ui-disableSelection selectstart.ui-disableSelection', function(e) {
  e.stopImmediatePropagation();
});
  
});

