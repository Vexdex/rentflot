<!DOCTYPE HTML>

<!-- (c) Rent-flot <http://www.rentflot.ua> -->

<html xmlns:og="http://ogp.me/ns#">

<head>
<?php 

/* Геолокация   */ 

 
include("ipgeobase/ipgeobase.php"); 
$gb = new IPGeoBase();

$data = $gb->getRecord('91.216.173.122');
 
$cityC = $data["city"];
$city = iconv("windows-1251","utf-8",$cityC);

$ip = $ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');
// || $ip == '93.74.5.121' || $ip == '91.216.173.122'
$actual_url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
/*
//92.60.178.227 ip Николая 
if ($city == 'Одесса' || $ip == '92.60.178.227' || $ip == '93.74.1.199' || $ip == '92.60.178.227' ){
//if ($ip == '93.72.85.24' || $ip == '91.216.173.122' || $ip == '92.60.178.227' || $ip == '93.74.1.199' || $ip == '92.60.178.227' ){
if ($actual_url !== 'www.rentflot.ua/odessa_yachts.html' && $actual_url == 'www.rentflot.ua/') {
session_start();
$_SESSION['rentflotodessa'] = 'true';
header('HTTP/1.1 200 OK');
header( 'Location: http://www.rentflot.ua/odessa_yachts.html', true, 301 );
exit();
}
}
*/
/* END Геолокация */
?>

 
  <link rel="image_src" type="image/jpeg" href="http://www.rentflot.ua/images/logos/flot.jpg" />
    <?php include_http_metas() ?>
    <?php include_metas() ?> 
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php  
    include_stylesheets(); ?>
    <?php include_javascripts() ?> 
<!--	
 <link href='//www.rentflot.ua/mobile/tablet.css' rel='stylesheet' type='text/css'>
 <link href='//www.rentflot.ua/mobile/phone.css' rel='stylesheet' type='text/css'>   
-->
 <link href='//rentflot.adaptic.com.ua/mobile/tablet.css' rel='stylesheet' type='text/css'>
 <link href='//rentflot.adaptic.com.ua/mobile/phone.css' rel='stylesheet' type='text/css'> 
  
    <?php include_rentflot_environment() ?>
    
    <?php if ($sf_user->isAuthenticated()): ?>
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
    <?php endif ?>
    <?php include_component('content', 'alternate') ?>
    <?php if(get_slot("og_image")): ?>
      <link rel="image_src" type="image/jpeg" href="<?php echo get_slot("og_image"); ?>">
      <meta property="og:image" content="<?php echo get_slot("og_image"); ?>">
    <?php endif ?>    
    <link href='http://fonts.googleapis.com/css?family=PT+Sans&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
	

                                                                                      
  </head>

<body itemscope itemtype="http://schema.org/WebPage" <?php if($actual_url != 'www.rentflot.ua/') { ?>class="inside_page" <?php }else{ ?> class="home_page" <?php } ?>>
<style>
  .contacts_block
    {
        width:265px;
            height:68px;
              }
                div.contacts_block>div>span>a
                  {
                      padding:4px;font-size:14px;font-family: 'PT Sans', sans-serif;color:#5b5b5b;border-style:none;
                        }
                          div.contacts_block>div
                            {
                                text-align:center;
                                  }
                                  div.contacts_block>div.address
                                  {
                                    margin-top:5px;
                                  }
                                    div.contacts_block>div.address>a
                                      {
                                          font-size:11px;text-align:center;font-family: Arial, Helvetica, sans-serif; color:#0064a0;font-weight:bold;border-bottom-style:none;
                                          text-transform: uppercase;
                                      }
                                              div.contacts_block>div.email
                                                {
                                                    font-size:8px;text-align:center;margin-top:5px;
                                                      }
                                                        div.contacts_block>div.email>a
                                                          {
                                                              font-family: 'PT Sans', sans-serif;color:#0064a0;
                                                                  text-decoration: none;border-bottom: 1px solid #0064a0;
                                                                  font-size: 14px;
                                                                    }
                                                                            </style>
  <a name="top"></a>

  <table cellspacing="0" cellpadding="0" border="0" width="100%" height="100%">
    <tr>
      <td align="center" class="MainTdBg">
        <table cellspacing="0" cellpadding="0" border="0" width="995" height="100%" align="center" class="MainTable">
          <tr>
            <td align="center" class="MainTableTd">
              <table cellspacing="0" cellpadding="0" border="0" width="100%" height="120">
                <tr>
                  <td valign="bottom" style="width: 275px">
                    <center>
                      <?php if (sfContext::getInstance()->getRouting()->getCurrentRouteName() != 'homepage'): ?>
                        <a class="nobor" title="На главную" href="<?php echo url_for('homepage') ?>">
                      <?php endif ?>
                        <img class="ohide" style="margin-bottom: 0px;" src="/images/logos/flot<?php echo $sf_user->getCulture() != 'ru' ? '_'  . $sf_user->getCulture() : '' ?>.jpg" alt="<?php echo __('home', array(), 'face') ?>" title="<?php echo __('home', array(), 'face') ?>">
						<img class="oshow" style="margin-bottom: 0px;" src="/images/logos/flot<?php echo $sf_user->getCulture() != 'ru' ? '_'  . $sf_user->getCulture() : '' ?>_odessa.jpg" alt="<?php echo __('home', array(), 'face') ?>" title="<?php echo __('home', array(), 'face') ?>">
                      <?php if (sfContext::getInstance()->getRouting()->getCurrentRouteName() != 'homepage'): ?>
                          </a>
                      <?php endif ?>

                      <div style="margin-bottom:15px;margin-top:8px;">
                        <a style="color:#0064a0;text-decoration: none;border-bottom: 1px solid #0064a0;" href="<?php echo url_for('call/index') ?>">
                          <strong><?php echo __('h1', null, 'call') ?></strong>
                        </a>
                      </div>
                    </center>
                  </td>
                  
				  <?php if (sfContext::getInstance()->getRouting()->getCurrentRouteName() != 'catalog_category' && 1==0): ?>
				  <?php include_component('interestingFact', 'random') ?>
				  <?php else: ?>
				  <td align="center">


                <strong>
                  <span class="OrderOnlineAdvert">
                    <?php include_component('Advertisements','ShowAd') ?>
                  </span>
                </strong>

				  </td>
				  <?php endif ?>

                  <td style="width: 285px;" valign="top">
                    <table cellspacing="0" cellpadding="0" border="0" height="100%" width="100%">
                      <tr>
                        <td valign="top" style="padding-left: 6px;"><?php include_partial('content/navi_icons') ?></td>
                        <td align="right" valign="top" style="padding: 4px 6px 0px 0px;">
                          <?php include_component('content', 'languageSelection', array('sf_cache_key' => $sf_user->getCulture())) ?>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center" valign="bottom">
                        
                  <div class="contacts_block">
                       <div>
                          <span class="kiev_city_number"><a href="<?php if($sf_user->getCulture() != 'ru'): ?>/en<?php endif ?>/contacts.html">/044/ 451-40-58</a></span>
                          <span><a href="<?php if($sf_user->getCulture() != 'ru'): ?>/en<?php endif ?>/contacts.html">/063/ 237-10-96</a></span>
                       </div>
                       <div>
                         <span><a href="/contacts.html">/050/ 312-32-64</a></span>
                         <span><a href="/contacts.html">/096/ 962-82-21</a></span>
                       </div>
                    <div class="address">
					  <?php if($sf_user->getCulture() == 'ru'): ?>
						<a href="/contacts.html">Киев, ул. Верхний Вал, 72, офис на причале</a>
					  <?php endif; ?>
					  <?php if($sf_user->getCulture() != 'ru'): ?>
						<a href="/en/contacts.html">Kiev, floating landing stage<br/> Verhniy Val str., 72</a>
					  <?php endif; ?>					  
                    </div>
                    
                  <div class="email">
                      <script>"rentflot".printAddr('ddd@flo.cm.ua', 'order', '.ua');</script>
                 </div>
                </div>
           <div class="header_padding_bottom"> </div>
						</td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <!-- Top chain -->
		  
          <tr><td height="23" style="background: url(/images/chain/top2.jpg) repeat-x left center; font-size: 10px;">&nbsp;</td></tr>	
          <tr>
            <td style="background-color: #e1feaa;" align="center" height="100%" valign="top">
              <table  cellspacing="0" cellpadding="0" border="0" width="100%">
			 
                <tr class="topmenu">
                  <td height=90 colspan="3" align="center" style="padding: 8px 0 16px 5px;">
				  
                    <?php include_component('menu', 'topMenu') ?>
					
                  </td>
                </tr>
				
                <tr>
                  <td class="left_topmenu" width="180" valign="top" height="100%" style="padding-left: 13px;">
                    <table cellspacing="0" cellpadding="0" border="0" width="177">
                      <?php if ($sf_user->hasGroup('admin') || $sf_user->hasGroup('manager') || $sf_user->hasCredential('catalog_show_own_items_rent_details')): ?>
                        <tr>
                          <td>
                            <!-- menu -->
                            <?php include_component('menu', 'mainAdminMenu') ?>
                          </td>
                        </tr>
                      <?php endif ?>

                      <?php if ($sf_user->isAuthenticated()): ?>
                        <tr>
                          <td>
                            <div class="MainMenuSecondaryLink">
                              <?php echo link_to(__('signout', array(), 'sfGuardAuth'), 'sf_guard_signout') ?><br/><?php echo __('app_version', array(), 'common') ?>: <?php echo sfConfig::get('app_version') ?>
                            </div>
                          </td>
                        </tr>
                      <?php endif ?>

                      <tr >
                        <td>
                          <!-- menu -->
                          <?php include_component('menu', 'mainMenu') ?>	  
                        </td>
                      </tr>

                      <?php if (!$sf_user->isAuthenticated()): ?>
                        <tr  class="login_link">
                          <td>
                            <div class="MainMenuSecondaryLink">
                              <?php echo link_to(__('signin', array(), 'sfGuardAuth'), 'sf_guard_signin') ?>
                            </div>
                          </td>
                        </tr>
                      <?php endif ?>
                    </table>
                  </td>
                  <td class="main_text" valign=top height="100%" style="vertical-align: top;">
                    <?php include_partial('content/breadcrumbs') ?>

                    <!-- content 10.02.2016  -->
                    <?php echo $sf_content ?>
                    <br>
                    <img src="/images/spacer.gif" width="580" height="1">
                  </td>
				  
                  <td class="right_side" align="left" valign=top width="177">
                    <table cellspacing="0" cellpadding="0" border="0" width="165">

<tr class="oshow odessa_left_ships_menu">
<td>
<div style="position: relative;">
						  
					  	 <table cellspacing="0" cellpadding="0" border="0" width="165">
						<tr  >
                        <td class="MainMenuBlock">
                          <div style="position: relative;">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                              <tbody><tr><td style="font-size: 7px" height="8">&nbsp;</td></tr>
                              <tr><td  class="menu_cell"><a href="http://www.rentflot.ua/odessa_sailing_yachts.html" title="">Аренда парусных яхт</a></td></tr> 
							  <tr><td  class="menu_cell"><a href="http://www.rentflot.ua/odessa_motor_yachts.html" title="">Аренда моторных яхт</a></td></tr> 
							  <tr><td  class="menu_cell"><a href="http://www.rentflot.ua/odessa_motor_ships.html" title="">Аренда теплоходов</a></td></tr> 
                              <tr  class="oshow"><td height="10px">&nbsp;</td> </tr>	
                            </tbody></table>
                            <img src="/images/block/lt.jpg" class="StdBlockMenuLT2"><img src="/images/block/rt.jpg" class="StdBlockMenuRT2"><img src="/images/block/rb.jpg" class="StdBlockMenuRB2"><img src="/images/block/lb.jpg" class="StdBlockMenuLB2">
                          </div>
                        </td>
                      </tr>						
					 <tr  class="oshow"><td height="15px">&nbsp;</td> </tr>	
					 </table>
					 
 
    </div>
                        </td>
                      </tr>
					  
                      <tr>
                        <td>
                          <div style="position: relative;">
						  				 
                            <table cellspacing="0" cellpadding="0" border="0" width="165">
							               
							
                              <tr>
                                <td style="background: #f8e08d; padding: 5px 0 15px 0; border: 2px solid #eb8a55" valign="top">
                                  <h3 class="block"><?php echo __('payment_for_services', array(), 'payments') ?></h3>
                                  <table cellspacing="0" cellpadding="0" border="0" align="center">
                                    <tr>
                                      <td><div style="text-align: center; padding: 3px 0 3px 0;"><?php echo link_to(__('payment_card_type', array(), 'payments'), 'payments_pay_for_services', array(), array('style' => 'vertical-align: middle')) ?> <a style="border: none" href="<?php echo url_for('payments_pay_for_services') ?>"><img style="vertical-align: middle; border: none" src="/images/payments/visa.jpg" /></a></div></td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                            <img src="/images/block/lt.jpg" class="StdBlockLT"><img src="/images/block/rt.jpg" class="StdBlockRT"><img src="/images/block/rb.jpg" class="StdBlockRB"><img src="/images/block/lb.jpg" class="StdBlockLB">
                          </div>
                        </td>
                      </tr>
					  
			
	
					  
                      <tr>
                        <td height="15px">&nbsp;</td>
                      </tr>
					  
					<tr class="short_reviews">
                        <td>
                          <div style="position: relative;">                  	
                            <table cellspacing="0" cellpadding="0" border="0" width="165">
                              <tr>
                                <td style="background: #f8e08d; padding: 5px 0 15px 0; border: 2px solid #eb8a55" valign="top">
                                  <h3 class="block"><a href="/clients.html"><?php echo __('clients', array(), 'menu') ?></a></h3>
                                
                                </td>
                              </tr>
                            </table>
                            <img src="/images/block/lt.jpg" class="StdBlockLT"><img src="/images/block/rt.jpg" class="StdBlockRT"><img src="/images/block/rb.jpg" class="StdBlockRB"><img src="/images/block/lb.jpg" class="StdBlockLB">
                          </div>
                        </td>
                      </tr>	
					  
                      <tr class="reviews">
                        <td>
                          <div style="position: relative;">                  	
                            <table cellspacing="0" cellpadding="0" border="0" width="165">
                              <tr>
                                <td style="background: #f8e08d; padding: 5px 0 15px 0; border: 2px solid #eb8a55" valign="top">
                                  <h3 class="block"><?php echo __('clients', array(), 'menu') ?></h3>
                                  <?php include_component('menu', 'clients') ?>
                                </td>
                              </tr>
                            </table>
                            <img src="/images/block/lt.jpg" class="StdBlockLT"><img src="/images/block/rt.jpg" class="StdBlockRT"><img src="/images/block/rb.jpg" class="StdBlockRB"><img src="/images/block/lb.jpg" class="StdBlockLB">
                          </div>
                        </td>
                      </tr>	
                      <tr>
                        <td class="reviews_pb" height="15px">&nbsp;</td>
                      </tr>
                      <tr class="mobile_right_long_menu1">
                        <td class="MainMenuBlock">
                          <div style="position: relative;">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                              <tr><td style="font-size: 7px" height="8">&nbsp;</td></tr>
                              <?php echo main_menu_item('gift_certs') ?> 
                           
							  <?php echo main_menu_item('entertainments') ?>
							  
							  <?php echo main_menu_item('map') ?> 
							 
							  <?php echo main_menu_item('contacts') ?>
							 
                              <?php echo main_menu_item('about') ?>
							 
                            </table>
                            <img src="/images/block/lt.jpg" class="StdBlockMenuLT2"><img src="/images/block/rt.jpg" class="StdBlockMenuRT2"><img src="/images/block/rb.jpg" class="StdBlockMenuRB2"><img src="/images/block/lb.jpg" class="StdBlockMenuLB2">
                          </div>
                        </td>
                      </tr>
					  
					  <tr class="right_short_menu1">
                        <td class="MainMenuBlock">
                          <div style="position: relative;">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                              <tr><td style="font-size: 7px" height="8">&nbsp;</td></tr>
                              <?php echo main_menu_item('gift_certs') ?> 
                              <tr><td>&nbsp;</td></tr>					  
                            </table>
                            <img src="/images/block/lt.jpg" class="StdBlockMenuLT2"><img src="/images/block/rt.jpg" class="StdBlockMenuRT2"><img src="/images/block/rb.jpg" class="StdBlockMenuRB2"><img src="/images/block/lb.jpg" class="StdBlockMenuLB2">
                          </div>
                        </td>
                      </tr>
					  
                      <tr>
                        <td height="15px">&nbsp;</td>
                      </tr>
					  
                      <tr class="right_short_menu2">
                        <td class="MainMenuBlock">
                          <div style="position: relative;">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                              <tr>
							  
							  <td style="font-size: 7px" height="8">&nbsp;</td>
                              <?php  echo main_menu_item('entertainments') ?>
                              <?php  echo main_menu_item('map') ?> 
                              <tr><td>&nbsp;</td></tr>
							 
							  </tr>
                            </table>
                            <img src="/images/block/lt.jpg" class="StdBlockMenuLT2"><img src="/images/block/rt.jpg" class="StdBlockMenuRT2"><img src="/images/block/rb.jpg" class="StdBlockMenuRB2"><img src="/images/block/lb.jpg" class="StdBlockMenuLB2">
                          </div>
                        </td>
                      </tr>
					  
                      <tr>
                        <td height="15px">&nbsp;</td>
                      </tr>
					  
                     
                      <tr class="news_block">
                        <td>
                          <div style="position: relative;">
                            <table  cellspacing="0" cellpadding="0" border="0" width="165">
							
                              <tr>
							
                                <td style="background: #f8e08d; padding: 5px 0 15px 0; border: 2px solid #eb8a55" valign="top">
                                  <h3 class="block">
								  <?php echo __('news', array(), 'menu') ?></h3>
                                  <?php include_component('menu', 'news') ?>
                                </td>
							
                              </tr>
                            </table>
                            <img src="/images/block/lt.jpg" class="StdBlockLT"><img src="/images/block/rt.jpg" class="StdBlockRT"><img src="/images/block/rb.jpg" class="StdBlockRB"><img src="/images/block/lb.jpg" class="StdBlockLB">
                          </div>
                        </td>
                      </tr>
					
                      <tr>
                        <td height="15px">&nbsp;</td>
                      </tr>
					  
					  
                      <tr class="right_short_menu3">
                        <td class="MainMenuBlock">
                          <div style="position: relative;">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                              <tr>
							  
				<td style="font-size: 7px" height="8">&nbsp;</td>
        <?php // echo main_menu_item('rules'); ?>
        <?php // echo main_menu_item('contract'); ?>
        <?php // echo main_menu_item('for_agents'); ?>
        <?php // echo main_menu_item('dictionary'); ?>
        <?php echo main_menu_item('contacts'); ?>
        <?php echo main_menu_item('about'); ?>
                              <tr><td style="font-size: 5px" height="8">&nbsp;</td></tr>
							   
							 </tr>  
                            </table>
                            <img src="/images/block/lt.jpg" class="StdBlockMenuLT2"><img src="/images/block/rt.jpg" class="StdBlockMenuRT2"><img src="/images/block/rb.jpg" class="StdBlockMenuRB2"><img src="/images/block/lb.jpg" class="StdBlockMenuLB2">
                          </div>
                        </td>
                      </tr>
                    
					 
                      <tr>
                        <td valign="top" align="center" style="padding: 30px 0 30px 8px;">
                          <?php
                          /*
                          <?php if (sfContext::getInstance()->getConfiguration()->getEnvironment() == 'prod'): ?>
                            <?php include_partial('content/bigmir_counter') ?>   
                          <?php endif ?>
                          */
                          ?>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="background-color: #e1feaa; padding: 0 195px 10px 0;" align="right">
              <table cellspacing="0" cellpadding="0" align="right">
                <tr>
                  <td style="padding: 2px 3px 0 0"><img src="/images/elements/marker-top.jpg"></td>
                  <td>
                    <a href="#top"><?php echo __('back_to_top', array(), 'face') ?></a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>	

		 
		  <tr class="top_menu_bottom">
	
            <td style="background-color: #e1feaa; padding: 0 20px 10px 0;" align="right">
			

			
			</td>
		
          </tr>
		  
		  <tr class="left_topmenu_bottom">
	
            <td class="left_topmenu_bottom_c" style="background-color: #e1feaa; padding: 0 20px 10px 0;" align="right">
	
			</td>
		
          </tr>
		
          <tr>
            <td height="23" style="background: url(/images/chain/bottom2.jpg) repeat-x left center; font-size: 10px;">&nbsp;</td>
          </tr>	
		  <tr>
			<td style="background: #fffea3; vertical-align: bottom;" align="center">
        <script type="text/javascript" src="//yandex.st/share/share.js"
        charset="utf-8"></script>
        <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,gplus"></div>
			</td>
		  </tr>
          <tr>
            <td style="background: #fffea3; vertical-align: bottom;" align="center" height="120">
              <table cellspacing="0" cellpadding="0" width="100%">
                <tr>
                  <td height="120" width="300" style="background: url(/images/schemes/scheme3.jpg) no-repeat top right; padding-top: 10px;" valign="top"></td>
                  <td style="text-align: center; vertical-align: top; line-height: 14px; padding-top: 7px;">
                    <?php echo __('bottom_text_seo', array(), 'face') ?> <br />
                    <?php echo __('bottom_text_year', array('%year%' => date('Y')), 'face') ?> <a href="<?php echo url_for('homepage') ?>"><?php echo __('rentflot_link_text', array(), 'face') ?></a>, <?php echo __('rentflot_kiev', array(), 'face') ?> - <span id="istat_2"><?php echo __('bottom_text_phone', array(), 'face') ?></span> - <a href="<?php echo url_for('contacts') ?>"><?php echo __('contacts_link_text', array(), 'face') ?></a>
                    <br/><br/>
                    <?php echo __('bottom_text_copyright', array(), 'face') ?> <br />
                    <?php /*
                    <?php echo __('bottom_text_dev', array(), 'face') ?> <a href="http://infosoft.ua"><?php echo __('infosoft_link_text', array(), 'face') ?>
                    */ ?>

                  </td>
                  <td width="300" style="background: url(/images/schemes/scheme5.jpg) no-repeat top left; padding-top: 10px;" valign="top"></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
<?php if (sfContext::getInstance()->getConfiguration()->getEnvironment() == 'prod'): ?>
  <?php include_partial('content/analytics_counter') ?>
  <!-- Yandex.Metrika counter -->
  <script type="text/javascript">
    (function (d, w, c) {
      (w[c] = w[c] || []).push(function() {
        try {
          w.yaCounter20273941 = new Ya.Metrika({id:20273941,
            webvisor:true,
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true});
        } catch(e) { }
      });

      var n = d.getElementsByTagName("script")[0],
          s = d.createElement("script"),
          f = function () { n.parentNode.insertBefore(s, n); };
      s.type = "text/javascript";
      s.async = true;
      s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

      if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
      } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
  </script>
  <noscript><div><img src="//mc.yandex.ru/watch/20273941" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
  <!-- /Yandex.Metrika counter -->
<?php endif ?>
<!-- Код тега ремаркетинга Google -->
<!--------------------------------------------------
С помощью тега ремаркетинга запрещается собирать информацию, по которой можно идентифицировать личность пользователя. Также запрещается размещать тег на страницах с контентом деликатного характера. Подробнее об этих требованиях и о настройке тега читайте на странице http://google.com/ads/remarketingsetup.
--------------------------------------------------->

<script type="text/javascript">
/* <![CDATA[ /
var google_conversion_id = 924299190;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/ ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/924299190/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>




<?php
/*
<!-- этот код вставляется перед закрывающим тегом </BODY> -->
<script type="text/javascript" charset="windows-1251" src="http://istat24.com/js/replace.js"></script>
<script type="text/javascript">doReplaceIstat(394);</script>
<!-- конец кода который вставляется перед закрывающим тегом </BODY> -->
*/
?>


 
<!--  Adaptic -->
<meta name="google-site-verification" content="ajL1DZfFFNiG96xoWeMs1GlNefSpHwSaynLYlLprlzA" /> 
 
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0"> 

<!--	
<script type="text/javascript">var userip;</script>        
<script type="text/javascript" src="https://l2.io/ip.js?var=userip"></script>    
-->
<script>
/*
    var head  = document.getElementsByTagName('head')[0];
    var tablet_css  = document.createElement('link');
    tablet_css.rel  = 'stylesheet';
    tablet_css.type = 'text/css';
    tablet_css.href = 'http://rentflot.adaptic.com.ua/css/tablet.css';
    tablet_css.media = 'all';
    head.appendChild(tablet_css);
                                
    var mobile_css  = document.createElement('link');
    mobile_css.rel  = 'stylesheet';
    mobile_css.type = 'text/css';
    mobile_css.href = 'http://rentflot.adaptic.com.ua/css/phone.css';
    mobile_css.media = 'all';
    head.appendChild(mobile_css);     
                                                            
    var mobile_js  = document.createElement('script');
    mobile_js.type = 'text/javascript';
    mobile_js.src = 'http://rentflot.adaptic.com.ua/js/mobile.js';
    mobile_js.media = 'all';
    head.appendChild(mobile_js);    
*/
 </script>

 <script type="text/javascript" src="//rentflot.adaptic.com.ua/mobile/mobile.js"></script>
<!--  END Adaptic --> 



</body>



</html>