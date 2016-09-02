<table cellspacing="3" id="object_images_sortable" class="ClassicForm">
  <?php if ($image_data->count()): ?>
    <?php foreach ($image_data as $image_index => $image): ?>
    <tr>
      <td style="width:800px;"><?php echo __('image', null, 'grid') ?> #<?php echo $image_index+1 ?><br/>
        <div>
        <a target="_blank" href="<?php echo sfConfig::get('app_'.$model.'_images_path').'900x600_'.$image['filename'] ?>">
          <?php echo image_tag(sfConfig::get('app_'.$model.'_images_path').'75x51_'.$image['filename'], 'style="vertical-align: middle"') ?>
        </a>
        </div>
        <div>
          <div>
            <div style="margin-top: 10px;">По-русски:</div>
          <span style="width:50px;">alt:</span>
          <input type="text" class="selinput" style="width: 250px;" value='<?php echo $image['alt']?>' name='image_alt_<?php echo $image['id'] ?>'/>
          <span style="width:50px;">title:</span>
          <input type="text" class="selinput" style="width: 250px;" value='<?php echo $image['title']?>' name='image_title_<?php echo $image['id'] ?>'/>
          </div>
          <div>
            <div style="margin-top: 10px;">In English:</div>
          <span style="width:50px;">alt:</span>
          <input type="text" class="selinput" style="width: 250px;" value='<?php echo $image['alt_en']?>' name='image_alt_en_<?php echo $image['id'] ?>'/>
          <span style="width:50px;">title:</span>
          <input type="text" class="selinput" style="width: 250px;" value='<?php echo $image['title_en']?>' name='image_title_en_<?php echo $image['id'] ?>'/>
          </div>
        </div>
        <span style="vertical-align: middle">
          <input type="checkbox" name="object_images_remove[<?php echo $image['id'] ?>]" id="object_images_remove[<?php echo $image['id'] ?>]"/>
          <label for="object_images_remove[<?php echo $image['id'] ?>]"><?php echo __('delete_image', null, 'grid') ?></label>
        </span>
        <input type="hidden" class="images_order_ids" id="image_order_<?php echo $image['id'] ?>" value="<?php echo $image['id'] ?>" />
      </td>
    </tr>
    <?php endforeach; ?>
  <?php else: ?>
  <!--
  <tr>
    <td colspan="2" class="warning"><?php echo __('image_not_uploaded', array(), 'grid') ?></td>
  </tr>
  -->
  <?php endif; ?>     
</table>

<table cellspacing="3" id="infosoft_grid" class="ClassicForm" style="width: 100%">
  <?php /*
  <?php if (sfConfig::get('app_object_images_max_count', 6) == $image_data->count()): ?>
    <center><?php echo __('image_error_max_upload_count', array(), 'grid').' ('.sfConfig::get('app_object_images_max_count', 6) ?>)</center>
  <?php endif ?>
  */ ?>
  <tr>
    <th class="Light3" style="text-align: center; padding: 3px 0 5px 0">
      <ul class="GridFormActions">  
        <li class="GridActionAdd">
          <span class="Link" onclick="add_object_image('object_images_sortable');"><?php echo __('add_image', null, 'grid') ?></span>
          <input type="hidden" value="<?php echo $image_data->count() ?>" id="object_images_count" />
        </li>
      </ul>
    </th>
  </tr>
</table>

<input type="hidden" name="idh" value="<?php echo $object_id ?>" />
<div id="image_order_data"></div>
<script type="text/javascript">

</script>