<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <?php include_rentflot_environment() ?>
    <?php include_rentflot_backend_environment() ?>
    
    <script type="text/javascript">
      $(document).ready(function() {
        // Выход из системы по нажатию Ctrl + Q
        $(document).keydown(function(event){        
          if (event.which == 81 && event.ctrlKey) 
          {                
            $('body').append('<div style="background: #FFF; z-index: 999999; position: absolute; top: 0; left: 0; width: 100%; height: 300%;"></div>');
            document.location.href = RENTFLOT_LOGOUT;
          }
        });  
      });
    </script>    
    
  </head>

<body>
  <table cellspacing="0" width="100%">
    <tr>
      <td align="center">
        <table id="container" border="1" cellpadding="0" cellspacing="5" align="center">
          <tbody>
            <tr>
              <td id="header">
                <table cellspacing="0" width="100%">
                  <tr>
                    <td style="width: 300px"><?php echo image_tag('logos/flot-admin.jpg') ?></td>
                    <td style="vertical-align: middle"><?php include_component('menu', 'adminMenu') ?></td>
                    <td style="vertical-align: middle; text-align: right">
                      <?php if ($sf_user->isAuthenticated()): ?>
                        <?php echo $sf_user->getName() ?> &nbsp; <a href="<?php echo url_for('sf_guard_signout') ?>" title="Ctrl+Q"><span><?php echo __('signout', null, 'auth') ?> &rarr;</span></a>
                      <?php endif ?>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td id="content"><?php echo $sf_content ?></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </table>
  <!-- Код тега ремаркетинга Google -->
<!--------------------------------------------------
С помощью тега ремаркетинга запрещается собирать информацию, по которой можно идентифицировать личность пользователя. Также запрещается размещать тег на страницах с контентом деликатного характера. Подробнее об этих требованиях и о настройке тега читайте на странице http://google.com/ads/remarketingsetup.
--------------------------------------------------->
<script type="text/javascript">
/ <![CDATA[ /
var google_conversion_id = 924299190;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/ ]]> /
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/924299190/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


</body>
</html>

