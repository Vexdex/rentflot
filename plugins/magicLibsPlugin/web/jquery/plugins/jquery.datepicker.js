function wfd_read_linked(element_id)
{
  var date_value = jQuery("#"+element_id).val();
  var d = date_value.split('.');
  jQuery("#"+element_id).val(parseInt(d[2], 10) + '-' + parseInt(d[1], 10) + '-' + parseInt(d[0], 10));
  return {};
}

  function wfd_update_linked(element_id)
  {   
		var day = parseInt(date.substring(8),10);
		var month = parseInt(date.substring(5, 7),10);
		var year = parseInt(date.substring(0, 4),10);
		if (month <= 9) month = '0' + month;
		jQuery("#"+element_id).val(day + '.' + month + '.' + year);
  }