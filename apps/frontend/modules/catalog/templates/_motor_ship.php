<?php /* @var Item $item */ ?>

<script type="text/javascript">
    $(document).ready(function(){
      $(".lightbox-gal-1").lightBox({
        fixedNavigation:		true,
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
<div style="text-align: center;margin-bottom: 5px;">
  <h1 style="display: inline;">
    <?php echo $item->getName(ESC_RAW) ?>
  </h1>
  <?php if ($sf_user->hasCredential('catalog')): ?>
    <a href="<?php echo url_for('item_edit', array('id' => $item->getId())) ?>" class="edit_link">
      <?php echo __('edit', array(), 'grid') ?>
    </a>
  <?php endif ?>
  <?php $images = $item->getImages(); if ($images->count() > 0): ?>
    <a style="margin-left: 10px;" class="PhotosAnchor" href="#item_photos"><img style="vertical-align: middle; margin-right: 5px;" src="/images/more/24x24_more_photos.png" /> <span><?php echo $images->count() ?> <?php echo __('photos', array(), 'catalog') ?></span><img style="vertical-align: middle; margin-left: 5px;"  src="../images/arrows/load_arrow3.png"></img></img></a>
  <?php endif ?>
</div>

<!-- 2016 09 10 vexdex [ -->
<p><span><strong>Связаться по тел.:</strong> <a href="/contacts.html" style="border-bottom: none; color: #09f">/050/ 312-32-64 (Viber)</a></span></p>
<!-- 2016 09 10 vexdex ] -->

<div style="text-align: center;margin-bottom: 20px;font-size: 20px;">
  <?php $onlineOrderLink = '<strong title="Вы можете без предоплаты зарезервировать это судно. Просто укажите нам время и дату его аренды."><span class="OrderOnline" onclick="showOnlineOrderForm()">' . __('motor_ship_place_order_online', array(), 'catalog') . ' '.__('no_prepayment', array(), 'catalog').'</span></strong>' ?>
  <?php if (($category->getItemContacts(ESC_RAW) || ($category->relatedExists('ParentCategory') && $category->getParentCategory()->getItemContacts(ESC_RAW)))&&1==0): ?>
    <?php if ($category->getItemContacts(ESC_RAW)): ?>
      <?php echo strtr($category->getItemContacts(ESC_RAW), array('%online_order_link%' => $onlineOrderLink)) ?>
    <?php else: ?>
      <?php echo strtr($category->getParentCategory()->getItemContacts(ESC_RAW), array('%online_order_link%' => $onlineOrderLink)) ?>
    <?php endif ?>
  <?php else: ?>
    <div>
      <?php echo $onlineOrderLink ?><br/>
    </div>
  <?php endif ?>
</div>



<?php if ($item->getMainImageId()): ?>
  <div style="width:550px;margin: auto;height: 250px;overflow: hidden;">
    <img  alt="<?php echo $item->getMainImageAlt(); ?>" title="<?php echo $item->getMainImageTitle(); ?>" class="prod_img" style="transform: translate(0%, -25%);" src="<?php echo sfConfig::get('app_Item_images_path').'550x1000_'.$item->getMainImage()->getFilename() ?>"/>
  </div>
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





<table width="100%" cellpadding="0" cellspacing="0" border="0" style="z-index: 0; margin-top: 5px;">
 
 <!-- PRODUCT PHOTO AND COMMON INFO BLOCK -->
 <tr>
 <td align="center" colspan="2" style="padding: 0; text-align: center;">
	
	<center><div class="view_info">
	<table cellpadding="0" cellspacing="0" border="0" style="line-height: 18px;" width="100%" class="view_info" align=center>
    <tr>
      <td width="50%" class="descr_block">
        <?php if ($item->getTargetUse(ESC_RAW)): ?>
          <h3 class="descr_block"><img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="" hspace="1">&nbsp;<?php echo __('motor_ship_purpose', array(), 'catalog') ?>:</h3>
          <?php echo $item->getTargetUse(ESC_RAW) ?>
        <?php endif ?>
        
        <?php if ($item->getPassengerCapacity(ESC_RAW)): ?>
          <h3 class="descr_block"><img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="">&nbsp;<?php echo __('motor_ship_passenger_capacity', array(), 'catalog') ?>:</h3>
          <?php echo $item->getPassengerCapacity(ESC_RAW) ?>
        <?php endif ?>
        
        <?php if ($item->getInSight(ESC_RAW)): ?>
          <h3 class="descr_block"><img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="">&nbsp;<?php echo __('motor_ship_available', array(), 'catalog') ?>:</h3>
          <?php echo $item->getInSight(ESC_RAW) ?>
        <?php endif ?>

        <?php if ($item->getCatering(ESC_RAW)): ?>
          <h3 class="descr_block"><img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="">&nbsp;<?php echo __('motor_ship_river_catering', array(), 'catalog') ?>:</h3>
          <?php echo $item->getCatering(ESC_RAW) ?>
        <?php endif ?>

        <?php if ($item->getPrice(ESC_RAW)): ?>
          <h3 class="descr_block"><img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="">&nbsp;<?php echo __('motor_ship_rental_charge', array(), 'catalog') ?>:</h3>
          <?php echo $item->getPrice(ESC_RAW) ?>
        <?php endif ?>  
        
        <?php $onlineOrderLink = '<strong title="Вы можете без предоплаты зарезервировать это судно. Просто укажите нам время и дату его аренды.">
            <span class="OrderOnline" onclick="showOnlineOrderForm()">' . __('motor_ship_place_order_online', array(), 'catalog') . '</span></strong>' ?>
                              
        <h3 class="descr_block" style="cursor: pointer;">
           <img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="" onclick="showOnlineOrderForm()">&nbsp;
           <span onclick="showOnlineOrderForm()"><?php echo __('motor_ship_place_order', array(), 'catalog') ?>:</span>
           </h3>

        <?php /*$onlineOrderLink = '<strong title="Вы можете без предоплаты зарезервировать это судно. Просто укажите нам время и дату его аренды.">
        <span class="OrderOnline" onclick="showOnlineOrderForm()">' . __('motor_ship_place_order_online', array(), 'catalog') . '</span></strong>'*/ ?>
        
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

        <?php if ($sf_user->hasCredential('calendar') || ($sf_user->hasCredential('catalog_show_own_items_rent_details') && $item->isCurrentUserIsOwner())): ?>
          <h3 class="descr_block" style="color: #aa0000"><img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="">&nbsp;<?php echo __('motor_ship_schedule', array(), 'catalog') ?> (<span class="ScheduleOrder2">50%</span>, <span class="ScheduleOrder3">100%</span>):</h3>
          <?php include_component('catalog', 'nextItemRent', array('item_id' => $item->getId())) ?>
        <?php endif ?>
      </td>
      
      <td class="descr_block" style="padding-left: 15px; border-left: 1px solid #eb8a55">
        <?php if ($item->getEquipment(ESC_RAW)): ?>
          <h3 class="descr_block"><img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="">&nbsp;<?php echo __('motor_ship_equipment', array(), 'catalog') ?>:</h3>
          <?php echo $item->getEquipment(ESC_RAW) ?>
        <?php endif ?>
        
        <?php if ($item->getBasicInfo(ESC_RAW)): ?>
          <h3 class="descr_block"><img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="">&nbsp;<?php echo __('motor_ship_specifications', array(), 'catalog') ?>:</h3>
          <?php echo $item->getBasicInfo(ESC_RAW) ?>
        <?php endif ?>
        
        <?php if ($item->getCrew(ESC_RAW)): ?>
          <h3 class="descr_block"><img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="">&nbsp;<?php echo __('motor_ship_crew', array(), 'catalog') ?>:</h3>
          <?php echo $item->getCrew(ESC_RAW) ?>
        <?php endif ?>

        <?php if ($item->getPassengerInsurance(ESC_RAW)): ?>
          <h3 class="descr_block"><img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="">&nbsp;<?php echo __('motor_passenger_insurance', array(), 'catalog') ?>:</h3>
          <?php echo $item->getPassengerInsurance(ESC_RAW) ?>
        <?php endif ?>

        <?php if ($item->getAdditionalInfo(ESC_RAW)): ?>
          <h3 class="descr_block"><img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="">&nbsp;<?php echo __('motor_ship_please_note', array(), 'catalog') ?>:</h3>
          <?php echo $item->getAdditionalInfo(ESC_RAW) ?>
        <?php endif ?>
      </td>
    </tr>
	</table>
	<!--img src="/images/spacer.gif" style="position: absolute; top: 0px; left: 265px; width: 1px; height: 100%; background-color: #eb8a55; z-index: 3;"-->
	<img class="angle" src="/images/block/2lt.jpg" style="position: absolute; top: -1; left: -1; z-index: 3;"><img class="angle" src="/images/block/2rt.jpg" style="position: absolute; top: -1px; right: -1px; z-index: 3;">
	<img class="angle" src="/images/block/2rb.jpg" style="position: absolute; bottom: -1px; right: -1; z-index: 3;"><img class="angle" src="/images/block/2lb.jpg" style="position: absolute; bottom: -1px; left: -1px; z-index: 3;">
	</div></center>
     <a name="item_photos"></a>
      <?php $images = $item->getImages(); if ($images->count() > 0): ?>
        <h3 class="descr_block" style="text-align: center;"><img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="">&nbsp;<?php echo utf8_ucfirst(__('photos', array(), 'catalog')) ?>:</h3>
        <div style="text-align: left; padding-left: 25px;">
        <?php foreach ($images as $i => $image): ?>
          <a rel="gallery1" title="<?php $image->getDescriptionByLang($sf_user->getCulture(),$i); ?>" class="lightbox-gal-1 nobor" href="<?php echo sfConfig::get('app_Item_images_path').'900x600_'.$image->getFilename() ?>">
            <img class="descr_img" <?php if($image->getWidth()!=0){echo "width='".$image->getWidth()."' height='".$image->getHeight()."'";} ?> src="<?php echo sfConfig::get('app_Item_images_path').'550x1000_'.$image->getFilename() ?>"
            alt='<?php  $image->getAltByLang($sf_user->getCulture(),$i);?>'
            title='<?php $image->getTitleByLang($sf_user->getCulture(),$i); ?>'
            style="margin-bottom: 0px; margin-top: 20px;">
          </a><br/>
          <span>
          <?php $image->getDescriptionByLang($sf_user->getCulture(),$i); ?>
          </span>
        <?php endforeach ?>      
      <?php endif ?>
        </div>
  </td>
 </tr>
  <tr>
  <td style="padding-left: 20px; line-height: 17px;"><h3 class="descr_block" style="text-align: center;"><img class="marker1" align="top" src="/images/bullets/1.jpg" alt="" title="">&nbsp;<?php __('other_craft_categories', array(), 'catalog') ?><a href="<?php echo url_for('catalog_category', array('category_slug' => $category->getSlug())) ?>">&laquo;<?php echo $category->getName(ESC_RAW) ?>&raquo;</a>:</h3>
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
</table>