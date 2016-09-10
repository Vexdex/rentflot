<h1><?php echo $category->getName(ESC_RAW) ?></h1>

<!-- 2016 09 10 vexdex [ -->
<p><span><strong>Связаться по тел:</strong> <a href="/contacts.html" style="border-bottom: none; color: #09f">/050/ 312-32-64 (Viber)</a></span></p>
<!-- 2016 09 10 vexdex ] -->


<?php include_partial('attractions_header.' . $sf_user->getCulture(), array('category' => $category)) ?>

<br><br>



<?php if ($items->count()): ?>

<?php $count_on_row = 1; $count = 0 ?>
 
<table class="shop_table attractions" width="100%" cellpadding="2" cellspacing="0" border="0">

<?php foreach ($items as  $item): ?>
<?php if ($count % $count_on_row == 0 && $count != 0): ?></tr><?php endif ?><?php if ($count % $count_on_row == 0): ?><tr><?php endif ?>

  <td align="center" valign="top" style="padding-bottom: 20px; width: <?php echo 100/$count_on_row ?>%">
  
	<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
        <tr>
           <td width="150" style="text-indent: 0px;">
             <?php $imageCount = $item->getImagesCount() ?>
            <a href="<?php echo url_for('catalog_item', array('category_slug' => $category->getSlug(), 'item_slug' => $item->getSlug())) ?>" style="display: block; position: relative; width: 143px; height: 131px;">
              <?php if ($item->getMainImageId()): ?>
                <img  class="prod_img" style="margin: 0 8px 0 8px" src="<?php echo sfConfig::get('app_Item_images_path').'130x130_'.$item->getMainImage()->getFilename() ?>"
                  alt="<?php
                    if($item->getMainImage()->getAlt()!="" && $sf_user->getCulture()=="ru")
                    {
                      echo $sf_user->getCulture()=="ru"?$item->getMainImage()->getAlt():$image->getAltEn();
                    }
                    else
                    {
                      echo $item->getName(ESC_RAW);
                    }
                    ?>"
                  title="<?php
                    if($item->getMainImage()->getAlt()!="" && $sf_user->getCulture()=="ru")
                    {
                      echo $sf_user->getCulture()=="ru"?$item->getMainImage()->getTitle():$item->getMainImage()->getTitleEn();
                    }
                    else
                    {
                      echo $item->getName(ESC_RAW);
                    }
                  ?>"
                width="130" height="130">
                <span class="attraction_img_count"><?php echo $imageCount ?> <?php echo __('photo' . ($imageCount > 1 ? 's' : '') , array(), 'catalog') ?></span>
              <?php else: ?>
                <img width="130" height="130" class="prod_img" style="margin: 0 8px 0 8px" src="<?php echo url_for('/images/no-photo/130x130_'.$sf_user->getCulture().'.jpg') ?>" />
              <?php endif ?>                
            </a>
           </td>
		   <td valign="top" class="attr_href" style="text-indent: 0px;"><p style="font-weight: bold; font-size: 12px; text-align: left;"><a class="cat_href" href="<?php echo url_for('catalog_item', array('category_slug' => $category->getSlug(), 'item_slug' => $item->getSlug())) ?>"><?php echo $item->getName(ESC_RAW) ?></a></p><?php echo $item->getShortDescription(ESC_RAW) ?></td>
        </tr>
	</table>
<?php $count++ ?>
<?php endforeach ?>

<?php if ($count % $count_on_row != 0): ?>
  <td align="center" valign="top" style="padding-bottom: 30px; width: <?php echo 100/$count_on_row ?>%">&nbsp;</td>
<?php endif ?>

 </tr>
</table>
<?php else: ?>
<div style="height: 100px;">&nbsp;</div>
<?php endif ?>
