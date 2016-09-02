$(document).ready(function () {

  // Блокировка повторной отправки формы
  $('#infosoft_grid').disableInputsOnSubmit();

  // Автосворачивание фильтров
  var filters = $('#infosoft_grid .Filters');
  filters.find('.FiltersHeader').bind('click', function () {
    filters.find('.FiltersBody').toggle();
  });

  var captcha_reloaded = new Date().getTime();
  if ($('#captcha').length && $('#captcha-reload').length)
  {
    $('#captcha-reload').removeAttr('onclick');
    $('#captcha-reload').bind('click', function () {
      
      var timestamp = new Date().getTime();
      if (timestamp - captcha_reloaded < 1550)
      {
        return false;
      }
      removeCaptchaLoading();
      //$('#captcha').attr('src', ''.url_for('@captcha?magic_id='.time()).'\');
      $(this).after('&nbsp;<img id="captcha-reloading" src="/images/captcha/loading.gif" />');
      $('#captcha').attr('src', '/captcha/?magic_id='+timestamp);
      setTimeout(removeCaptchaLoading, 1500);
    }, true);
  }
});


function removeCaptchaLoading()
{
  $('#captcha-reloading').remove()
}