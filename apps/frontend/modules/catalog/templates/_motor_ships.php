<?php /* @var Category $category */ ?>

<?php include_partial('online_order_form_dialog') ?>

<h1><?php echo $category->getName(ESC_RAW) ?></h1>


<!--------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------->

<!-- 2016 09 10 vexdex [ -->
<p><span><strong>Связаться по тел.:</strong> <a href="/contacts.html" style="border-bottom: none; color: #09f">/050/ 312-32-64 (Viber)</a></span></p>
<!-- 2016 09 10 vexdex ] -->

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
<table class="soc_links" style="margin:auto;"><tr>
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
<!--------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------->

<p><?php echo $category->getSeoShortText(ESC_RAW) ?> <?php if($category->getSeoShortText(ESC_RAW)!=""): ?><p style='text-align: right;'><a href="#fulltext">Читать далее -></a></p><?php endif ?></p>
<?php if ($items->count()): ?>

<?php $count_on_row = 2; $count = 0;?>

<table class="shop_table" width="100%" cellpadding="2" cellspacing="0" border="0">

<?php foreach ($items as $item): ?>
  <?php /* @var Item $item */ ?>

<?php if ($count % $count_on_row == 0 && $count != 0): ?></tr><?php endif ?><?php if ($count % $count_on_row == 0): ?><tr><?php endif ?>
  <td align="center" valign="top" style="padding-bottom: 30px; width: 50%">
    <a class="view_all_ships" title="<?php echo str_replace('&quot;','',$item->getName())." - аренда"; ?>" href="<?php echo url_for('catalog_item', array('category_slug' => $category->getSlug(), 'item_slug' => $item->getSlug())) ?>">
	<strong>
	    <?php echo $item->getName(ESC_RAW) ?>
	</strong>
    </a>
  
  		    <?php $onlineOrderLink = '<strong><span class="OrderOnline" title="Вы можете без предоплаты зарезервировать это судно. Просто укажите нам время и дату его аренды" onclick="$(\'#online_order_dialog_form_item_slug\').val(\''.$item->getSlug().'\'); showOnlineOrderForm();">' . __('motor_ship_place_order_online', array(), 'catalog') . '</span></strong>' ?>
        <?php if (($category->getItemContacts(ESC_RAW) || ($category->relatedExists('ParentCategory') && $category->getParentCategory()->getItemContacts(ESC_RAW)))&&1==0): ?>
          <?php if ($category->getItemContacts(ESC_RAW)): ?>
            <?php echo strtr($category->getItemContacts(ESC_RAW), array('%online_order_link%' => $onlineOrderLink)) ?>
          <?php else: ?>
            <?php echo strtr($category->getParentCategory()->getItemContacts(ESC_RAW), array('%online_order_link%' => $onlineOrderLink)) ?>
          <?php endif ?>
        <?php else: ?>
          <div style="padding:6 0 0 0;">
            <?php echo $onlineOrderLink ?><br/>
          </div>
        <?php endif ?>
  
  <div class="item_params_table">
       
        <div class="item_params_left item_params_side">
		 

            <table cellspacing="1" cellpadding="0" border="0" width="100%">
              <tr>
                <td class="view_all_ships_num"><nobr><?php if ($item->getInfoValue1(ESC_RAW)): ?><?php echo $item->getInfoValue1(ESC_RAW) ?><?php else: ?>&ndash;<?php endif ?></nobr></td>
                <td class="view_all_ships_numd"><?php if ($item->getInfoText1(ESC_RAW)): ?><?php echo $item->getInfoText1(ESC_RAW) ?><?php else: ?>&nbsp;<?php endif ?></td>
              </tr>
              <tr>
                <td class="view_all_ships_num"><nobr><?php if ($item->getInfoValue2(ESC_RAW)): ?><?php echo $item->getInfoValue2(ESC_RAW) ?><?php else: ?>&ndash;<?php endif ?></nobr></td>
                <td class="view_all_ships_numd"><?php if ($item->getInfoText2(ESC_RAW)): ?><?php echo $item->getInfoText2(ESC_RAW) ?><?php else: ?>&nbsp;<?php endif ?></td>
              </tr>
              <tr>
                <td class="view_all_ships_num"><nobr><?php if ($item->getInfoValue3(ESC_RAW)): ?><?php echo $item->getInfoValue3(ESC_RAW) ?><?php else: ?>&ndash;<?php endif ?></nobr></td>
                <td class="view_all_ships_numd"><?php if ($item->getInfoText3(ESC_RAW)): ?><?php echo $item->getInfoText3(ESC_RAW) ?><?php else: ?>&nbsp;<?php endif ?></td>
              </tr>
            </table>
          </div>
		  
        <div class="item_params_right item_params_side">
            <table cellspacing="1" cellpadding="0" border="0" width="100%">
              <tr>
                <td class="view_all_ships_num2"><nobr><?php if ($item->getPriceValue1(ESC_RAW)): ?><?php echo $item->getPriceValue1(ESC_RAW) ?><?php else: ?>&ndash;<?php endif ?></nobr></td>
                <td class="view_all_ships_numd1"><?php if ($item->getPriceText1(ESC_RAW)): ?><?php echo $item->getPriceText1(ESC_RAW) ?><?php else: ?>&nbsp;<?php endif ?></td>
              </tr>
              <tr>
                <td class="view_all_ships_num2"><nobr><?php if ($item->getPriceValue2(ESC_RAW)): ?><?php echo $item->getPriceValue2(ESC_RAW) ?><?php else: ?>&ndash;<?php endif ?></nobr></td>
                <td class="view_all_ships_numd1"><?php if ($item->getPriceText2(ESC_RAW)): ?><?php echo $item->getPriceText2(ESC_RAW) ?><?php else: ?>&nbsp;<?php endif ?></td>
              </tr>
              <tr>
                <td class="view_all_ships_num2"><nobr><?php if ($item->getPriceValue3(ESC_RAW)): ?><?php echo $item->getPriceValue3(ESC_RAW) ?><?php else: ?>&ndash;<?php endif ?></nobr></td>
                <td class="view_all_ships_numd1"><?php if ($item->getPriceText3(ESC_RAW)): ?><?php echo $item->getPriceText3(ESC_RAW) ?><?php else: ?>&nbsp;<?php endif ?></td>
              </tr>
            </table>
          </div>
       
	</div>

<center style="text-indent: 0px; padding: 0 <?php if ($count % $count_on_row == 0): ?>5px 0 0<?php else: ?>0 0 5px<?php endif ?>">
<?php $imageCount = $item->getImagesCount() ?>
<a class="nobor" href="<?php echo url_for('catalog_item', array('category_slug' => $category->getSlug(), 'item_slug' => $item->getSlug())) ?>" style="display: block; position: relative; width: 287px; height: 150px;">
  <?php if ($item->getMainImageId()): ?>
    <img class="prod_img" src="<?php echo sfConfig::get('app_Item_images_path').'286x149_'.$item->getMainImage()->getFilename() ?>"
    alt="<?php
        if($item->getMainImage()->getAlt()!="" && $sf_user->getCulture()=="ru")
        {
          echo $sf_user->getCulture()=="ru"?$item->getMainImage()->getAlt():$image->getAltEn();
        }
        else
        {
          echo htmlspecialchars($item->getCleanedName(ESC_RAW));
        }
      ?>"
    title="<?php
        if($item->getMainImage()->getAlt()!="" && $sf_user->getCulture()=="ru")
        {
          echo $sf_user->getCulture()=="ru"?$item->getMainImage()->getTitle():$item->getMainImage()->getTitleEn();
        }
        else
        {
          echo htmlspecialchars($item->getCleanedName(ESC_RAW));
        }
      ?>"
    width="286" height="149">
    <span class="prod_img_count"><?php echo $imageCount ?> <?php echo __('photo' . ($imageCount > 1 ? 's' : '') , array(), 'catalog') ?></span>
  <?php else: ?>
    <img width="286" height="149" class="prod_img" src="<?php echo url_for('/images/no-photo/286x149_'.$sf_user->getCulture().'.jpg') ?>" />
  <?php endif ?>

</a>
</center>
<p><?php if($item->getListingText()){echo $item->getListingText();} ?></p>
<?php $count++ ?>
<?php endforeach ?>

<?php if ($count % $count_on_row != 0): ?>
  <td align="center" valign="top" style="padding-bottom: 30px; width: 50%">&nbsp;</td>
<?php endif ?>


 </tr>
</table>
<a name="fulltext"></a>
<p><?php echo $category->getSeoFullText(ESC_RAW) ?></p>
<?php else: ?>
<div style="height: 100px; text-align: center">Плавсредств в данной категории еще не добавлено.</div>
<p><?php echo $category->getSeoFullText(ESC_RAW) ?></p>
<?php endif ?>
