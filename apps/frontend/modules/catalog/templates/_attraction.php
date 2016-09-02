<script type="text/javascript">
    $(document).ready(function(){
      base_url = '<?php echo url_for('homepage', array(), true) ?>';
      $(".lightbox-gal-1").lightBox({
        fitToScreen: false,
        loopImages: true,
        imageClickClose: false,
        imageLoading:			'/magicLibsPlugin/jquery/plugins/lightbox-0.5/images/loading.gif',	
        imageBtnPrev:			'/magicLibsPlugin/jquery/plugins/lightbox-0.5/images/prev.gif',		
        imageBtnNext:			'/magicLibsPlugin/jquery/plugins/lightbox-0.5/images/next.gif',		
        imageBtnClose:		'/magicLibsPlugin/jquery/plugins/lightbox-0.5/images/close.gif',		
        imageBlank:				'/magicLibsPlugin/jquery/plugins/lightbox-0.5/images/blank.gif',
        txtImage:         '<?php echo __('photo_full', array(), 'catalog') ?>',
        txtOf:            '<?php echo __('photo_from', array(), 'catalog') ?>'
      });   
    });
</script>

<?php include_partial('online_order_form_dialog') ?>

<h1>
  <?php echo $item->getName(ESC_RAW) ?>
</h1>
<div style="text-align: center; margin-top: -20px; margin-bottom: 20px;">
  <?php if ($sf_user->hasCredential('catalog')): ?> <a href="<?php echo url_for('item_edit', array('id' => $item->getId())) ?>"><?php echo __('edit', array(), 'grid') ?></a><?php endif ?>
  <?php $images = $item->getImages(); if ($images->count() > 0): ?>
    <a class="PhotosAnchor" href="#item_photos"><br/><span><?php echo $images->count() ?> <?php echo __('photos', array(), 'catalog') ?></span><img style="vertical-align: middle; margin-left: 5px;"  src="../images/arrows/load_arrow3.png"></img></a>
  <?php endif ?>
</div>

<?php if ($item->getMainImageId()): ?>
    <img width=412px alt="<?php echo $item->getMainImageAlt(); ?>" title="<?php echo $item->getMainImageTitle(); ?>" style="margin: auto;display: block;" src="<?php echo sfConfig::get('app_Item_images_path').'550x1000_'.$item->getMainImage()->getFilename() ?>"/>
  <br/>
<?php endif; ?>





<table class="soc_links" style="margin:auto;">
  <tr>
      <td>
            <!-- Put this script tag to the <head> of your page -->
                  <script type="text/javascript" src="//vk.com/js/api/openapi.js?116"></script>
                        <script type="text/javascript">
                                VK.init({apiId: 4878346, onlyWidgets: true});
                                      </script>
                                            <!-- Put this div tag to the place, where the Like block will be -->
                                                  <div id="vk_like" style="width:60px;"></div>
                                                        <script type="text/javascript">
                                                                VK.Widgets.Like("vk_like", {type: "button"});
                                                                      </script>
                                                                          </td>
                                                                          
                                                                              <td>
                                                                                    <!-- Put this script tag to the <head> of your page -->
                                                                                          <script type="text/javascript" src="http://vk.com/js/api/share.js?91" charset="windows-1251"></script>
                                                                                                <!-- Put this script tag to the place, where the Share button will be -->
                                                                                                      <script type="text/javascript"><!--
                                                                                                              document.write(VK.Share.button(false,{type: "round", text: "Сохранить"}));
                                                                                                                      --></script>
                                                                                                                          </td>
                                                                                                                          
                                                                                                                              <td>
                                                                                                                                    <div id="fb-root"></div>
                                                                                                                                          <div class="fb-like" id="fbdiv" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                                                                                                                                                <script>
                                                                                                                                                        var fbdiv=document.getElementById("fbdiv");
                                                                                                                                                                fbdiv.setAttribute("data-href",window.location.href);
                                                                                                                                                                        (function(d, s, id) {
                                                                                                                                                                                  var js, fjs = d.getElementsByTagName(s)[0];
                                                                                                                                                                                            if (d.getElementById(id)) return;
                                                                                                                                                                                                      js = d.createElement(s); js.id = id;
                                                                                                                                                                                                                js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.3";
                                                                                                                                                                                                                          fjs.parentNode.insertBefore(js, fjs);
                                                                                                                                                                                                                                  }(document, 'script', 'facebook-jssdk'));</script>
                                                                                                                                                                                                                                      </td>
                                                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                                                        </table>
                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                        <table class="soc_links" style="margin:auto;">
                                                                                                                                                                                                                                          <tr>
                                                                                                                                                                                                                                              <td>
                                                                                                                                                                                                                                                    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
                                                                                                                                                                                                                                                          <g:plusone></g:plusone>
                                                                                                                                                                                                                                                              </td>
                                                                                                                                                                                                                                                                  <td>
                                                                                                                                                                                                                                                                        <!-- Вставьте этот тег в заголовке страницы или непосредственно перед закрывающим тегом основной части. -->
                                                                                                                                                                                                                                                                              <script src="https://apis.google.com/js/platform.js" async defer>
                                                                                                                                                                                                                                                                                      {lang: 'ru'}
                                                                                                                                                                                                                                                                                            </script>
                                                                                                                                                                                                                                                                                                  <!-- Поместите этот тег туда, где должна отображаться кнопка "Поделиться". -->
                                                                                                                                                                                                                                                                                                        <div class="g-plus" data-action="share" data-annotation="bubble"></div>
                                                                                                                                                                                                                                                                                                            </td>
                                                                                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                                                                                                <td>
                                                                                                                                                                                                                                                                                                                      <a class="twitter-share-button"
                                                                                                                                                                                                                                                                                                                               href="https://twitter.com/share">
                                                                                                                                                                                                                                                                                                                                       Tweet
                                                                                                                                                                                                                                                                                                                                             </a>
                                                                                                                                                                                                                                                                                                                                                   <script>
                                                                                                                                                                                                                                                                                                                                                           window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return t;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
                                                                                                                                                                                                                                                                                                                                                                 </script>
                                                                                                                                                                                                                                                                                                                                                                     </td>
<td>
<a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png" /></a>
<!-- Please call pinit.js only once per page -->
<script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>
</td>                                                                                                                                                                                                                                                                                                                                                                     
                                                                                                                                                                                                                                                                                                                                                                       </tr>
                                                                                                                                                                                                                                                                                                                                                                       </table>






<table width="100%" cellpadding="0" cellspacing="0" border="0">
 
 <!-- PRODUCT PHOTO AND COMMON INFO BLOCK -->
 <tr>
  <td align="center" colspan="2" style="padding: 0; text-align: center; text-indent: 0px;">

    <center>
      <div class="view_info">
        <table cellpadding="0" cellspacing="0" border="0" style="line-height: 18px;" width="100%" class="view_info" align=center>
          <tr>
            <td class="descr_block">

              <table cellpadding="0" cellspacing="0" border="0" style="line-height: 18px; margin-top: 10px" width="100%" class="view_info" align=center>
                <tr><td align=center><h3 class="descr_block" style="text-align: left; margin-top: 5px;"><img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="">&nbsp;<?php echo __('attraction_description', array(), 'catalog') ?>:</h3></td></tr>
                <tr><td style="padding-top: 8px"><?php echo $item->getDescription(ESC_RAW) ?></td></tr>
              </table>

              <br/>

              <table cellpadding="0" cellspacing="0" border="0" style="line-height: 18px;" width="100%" class="view_info" align=center>
               <tr><td align=center><h3 class="descr_block" style="text-align: left; margin-top: 5px;"><img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="">&nbsp;<?php echo __('motor_ship_place_order', array(), 'catalog') ?>:</h3></td></tr>
               <tr><td style="padding-top: 0">
                 <table cellspacing="0">
                 <tr>
                   <td style="line-height: 16px;">
                    <?php $onlineOrderLink = '<strong><span class="OrderOnline" onclick="showOnlineOrderForm()">' . __('motor_ship_place_order_online', array(), 'catalog') . '</span></strong>' ?>
                    <?php if ($category->getItemContacts(ESC_RAW) || ($category->relatedExists('ParentCategory') && $category->getParentCategory()->getItemContacts(ESC_RAW))): ?>
                      <?php if ($category->getItemContacts(ESC_RAW)): ?>
                        <?php echo strtr($category->getItemContacts(ESC_RAW), array('%online_order_link%' => $onlineOrderLink)) ?>
                      <?php else: ?>
                        <?php echo strtr($category->getParentCategory()->getItemContacts(ESC_RAW), array('%online_order_link%' => $onlineOrderLink)) ?>
                      <?php endif ?>
                    <?php else: ?>
                      <p>
                    - <?php echo link_to('<span id="istat_3">/044/ 451-40-58<span>', 'contacts') ?>&nbsp;&nbsp;<?php echo link_to('<span id="istat_3">/063/ 237-10-96<span>', 'contacts') ?><br/>
                    - <?php echo link_to('<span id="istat_3">/050/ 312-32-64<span>', 'contacts') ?>&nbsp;&nbsp;<?php echo link_to('<span id="istat_3">/096/ 962-82-21<span>', 'contacts') ?><br/>
                    - E-mail: <a href="mailto:order@rentflot.ua">order@rentflot.ua</a><br/>
                    - <?php echo __('motor_ship_place_order_skype', array(), 'catalog') ?>: <a href="callto:rentflot.ua">rentflot.ua</a><br />
                    - <?php echo $onlineOrderLink ?> <span style='color:#A00;'><?php echo __('no_prepayment', array(), 'catalog') ?></span><br/>
                      </p>
                    <?php endif ?>
                   </td>
                 </tr>
                 </table>
               </td></tr>
              </table>

              <img src="/images/block/2lt.jpg" style="position: absolute; top: -1; left: -1; z-index: 3;"><img src="/images/block/2rt.jpg" style="position: absolute; top: -1px; right: -1px; z-index: 3;"><img src="/images/block/2rb.jpg" style="position: absolute; bottom: -1px; right: -1; z-index: 3;"><img src="/images/block/2lb.jpg" style="position: absolute; bottom: -1px; left: -1px; z-index: 3;">
            </td>
          </tr>
        </table>
      </div>
    </center>

    <a name="item_photos"></a>

	<?php if ($images->count() > 0): ?>
    
    <?php $count_on_row = 2; $count = 0 ?>

    <table class="shop_table" width="100%" cellpadding="2" cellspacing="0" border="0" style="margin-top:20px;">
      <caption>
        <img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="">&nbsp;
        <strong><?php echo utf8_ucfirst(__('photo', array(), 'catalog')) ?>:<strong>
      </caption>
    <?php $photo_num = 0; ?>
    <?php foreach ($images as $i => $image): ?>
      <?php $photo_num++ ?>
      <?php if ($count % $count_on_row == 0 && $count != 0): ?></tr><?php endif ?><?php if ($count % $count_on_row == 0): ?><tr><?php endif ?>
        <td width="50%">
          <a rel="gallery1" title="<?php echo $item->getCleanedName(ESC_RAW) ?>" class="lightbox-gal-1 nobor" href="<?php echo sfConfig::get('app_Item_images_path').'900x600_'.$image->getFilename() ?>">
          <img class="descr_img" src="<?php echo sfConfig::get('app_Item_images_path').'286x198_'.$image->getFilename() ?>"
               alt='<?php  $image->getAltByLang($sf_user->getCulture(),$i);?>'
               title='<?php $image->getTitleByLang($sf_user->getCulture(),$i); ?>'
               style="margin-bottom: 0px; margin-top: 20px;">
          </a>
          <?php $image->getDescriptionByLang($sf_user->getCulture(),$i); ?>
        </td>
      <?php $count++ ?>
    <?php endforeach ?>
    
    </table>
  <?php endif ?>
  </td>
 </tr>
  <?php if (!$item->getHideAttractions()): ?>
 <tr>
  <td style="padding-left: 20px; line-height: 17px;"><h3 class="descr_block" style="text-align: center;"><img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="">&nbsp;<?php echo __('attraction_others', array(), 'catalog') ?> <a href="<?php echo url_for('catalog_category', array('category_slug' => $category->getSlug())) ?>"><?php echo __('attractions', array(), 'catalog') ?></a>:</h3>
  <br>
	<?php foreach ($items  as $other_item): ?>
    <div style="text-indent: 0px; padding-left: 20px; <?php if ($item->getId() == $other_item->getId()): ?>background-image: url(/images/elements/marker4.jpg); background-repeat: no-repeat; background-position: 2px 2px;<?php endif ?>">
		<?php if ($item->getId() !=  $other_item->getId()): ?>
			<a href="<?php echo url_for('catalog_item', array('category_slug' => $category->getSlug(), 'item_slug' => $other_item->getSlug())) ?>"><?php echo $other_item->getName(ESC_RAW) ?></a><br>
		<?php else: ?>
			<strong><?php echo $other_item->getName(ESC_RAW) ?></strong>
		<?php endif ?>
		</div>
	<?php endforeach ?>  
  </td>
 </tr>
 <?php endif; ?>
</table>

