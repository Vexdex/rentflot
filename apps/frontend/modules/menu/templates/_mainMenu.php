<table cellspacing="0" cellpadding="0" border="0" width="100%">
<!--  --><?php //echo main_menu_item_button('motor_ships') ?>
  <tr><td>
    <div style="position: relative;">
      <a id="menu_motor_ships" title="Теплоходы" class="left_ships_menu left_ships_menu_motor_ships <?php if (check_route('motor_ships')): ?>left_ships_menu_active left_ships_menu_motor_ships_active<?php endif ?>" href="<?php echo url_for('motor_ships') ?>"><div><span><?php echo sfContext::getInstance()->getI18n()->__('motor_ships_button', array(), 'menu') ?></span></div></a>
      <div id="sub_menu_ships" class="sm_ships">
        <?php echo dropdown_menu_item(array('route' => 'catalog_category', 'name' => 'motor_ships_25'), array('category_slug' => 'motor_ships_25')) ?><br/>
        <?php echo dropdown_menu_item(array('route' => 'catalog_category', 'name' => 'motor_ships_50'), array('category_slug' => 'motor_ships_50')) ?><br/>
        <?php echo dropdown_menu_item(array('route' => 'catalog_category', 'name' => 'motor_ships_100'), array('category_slug' => 'motor_ships_100')) ?><br/>
        <?php echo dropdown_menu_item(array('route' => 'catalog_category', 'name' => 'motor_ships_150'), array('category_slug' => 'motor_ships_150')) ?><br/>
        <?php echo dropdown_menu_item(array('route' => 'catalog_category', 'name' => 'motor_ships_151'), array('category_slug' => 'motor_ships_151')) ?><br/>
        <img src="/images/block/lt.jpg" class="StdBlockMenuLT2"><img src="/images/block/rt.jpg" style="top: -2px; top: expression('-2px'); right: -2px;"><img src="/images/block/rb.jpg" style="bottom: -2px; bottom: expression('-2px'); right: -2px;"><img src="/images/block/lb.jpg" class="StdBlockMenuLB2">
      </div>
    </div>
  </td></tr>
  <tr>
    <td>
      <a title="Кухня на борту"
        class="left_ships_menu left_ships_menu_banquet <?php if (check_route('banquet')): ?>left_ships_menu_active left_ships_menu_banquet_active<?php endif ?>"
        href="<?php echo url_for('banquet') ?>">
        <div>
          <span>
            <?php echo sfContext::getInstance()->getI18n()->__('banquet_button', array(), 'menu') ?>
          </span>
        </div>
      </a>
    </td>
  </tr>
  <tr><td><a title="Яхты парусные" class="left_ships_menu left_ships_menu_sailing_yachts <?php if (params_match(array('category_slug' => 'sailing_yachts'))): ?>left_ships_menu_active left_ships_menu_sailing_yachts_active<?php endif ?>" href="<?php echo url_for('catalog_category', array('category_slug' => 'sailing_yachts')) ?>"><div><span><?php echo sfContext::getInstance()->getI18n()->__('sailing_yachts_button', array(), 'menu') ?></span></div></a></td></tr>
  <tr><td><a title="Моторные яхты" class="left_ships_menu left_ships_menu_motor_yachts <?php if (params_match(array('category_slug' => 'motor_yachts'))): ?>left_ships_menu_active left_ships_menu_motor_yachts_active<?php endif ?>" href="<?php echo url_for('catalog_category', array('category_slug' => 'motor_yachts')) ?>"><div><span><?php echo sfContext::getInstance()->getI18n()->__('motor_yachts_button', array(), 'menu') ?></span></div></a></td></tr>
  <tr><td><a title="Катера" class="left_ships_menu left_ships_menu_speed_boats <?php if (params_match(array('category_slug' => 'speed_boats'))): ?>left_ships_menu_active left_ships_menu_speed_boats_active<?php endif ?>" href="<?php echo url_for('catalog_category', array('category_slug' => 'speed_boats')) ?>"><div><span><?php echo sfContext::getInstance()->getI18n()->__('speed_boats_button', array(), 'menu') ?></span></div></a></td></tr>
  <tr><td><a title="V.I.P. класс" class="left_ships_menu left_ships_menu_for_vip <?php if (params_match(array('category_slug' => 'for_vip'))): ?>left_ships_menu_active left_ships_menu_for_vip_active<?php endif ?>" href="<?php echo url_for('catalog_category', array('category_slug' => 'for_vip')) ?>"><div><span><?php echo sfContext::getInstance()->getI18n()->__('for_vip_button', array(), 'menu') ?></span></div></a></td></tr>

  <tr>
    <td>
      <a title="Перечень развлечений"
        class="left_ships_menu left_ships_menu_entertainment <?php if (check_route('catalog_category',array('category_slug' => 'attractions'))): ?>left_ships_menu_active left_ships_menu_entertainment_active<?php endif ?>"
        href="<?php echo url_for('catalog_category',array('category_slug' => 'attractions')) ?>"
        >
        <div>
          <span>
            <?php echo sfContext::getInstance()->getI18n()->__('attractions', array(), 'menu') ?>
          </span>
        </div>
      </a>
    </td>
  </tr>

  <tr class="left_menu_river">
    <td>
      <a title="Речные прогулки в Киеве"
        class="left_ships_menu left_ships_menu_motor_ships <?php if (check_route('rest_walk')): ?>left_ships_menu_active left_ships_menu_motor_ships_active<?php endif ?>"
        href="<?php echo url_for('rest_walk') ?>">
        <div style="padding-top:11px;">
          <span>
            <?php echo str_replace(' ','<br/>',sfContext::getInstance()->getI18n()->__('rest_walk', array(), 'menu')); ?>          
          </span>
        </div>
      </a>
    </td>
  </tr>

  <?php /*
  <tr>
    <td class="MainMenuBlock">

        <div id="sub_menu_yachts" class="sm_yachts">
          <?php echo dropdown_menu_item(array('route' => 'catalog_category', 'name' => 'sailing_yachts'), array('category_slug' => 'sailing_yachts')) ?><br/>
          <?php echo dropdown_menu_item(array('route' => 'catalog_category', 'name' => 'motor_yachts'), array('category_slug' => 'motor_yachts')) ?><br/>
          <img src="/images/block/rt.jpg" style="top: -2px; top: expression('-2px'); right: -2px; right: expression('-2px');"><img src="/images/block/rb.jpg" style="bottom: -2px; bottom: expression('-2px'); right: -2px; right: expression('-2px');">
        </div>

        <table cellspacing="0" cellpadding="0" border="0" width="100%">
          <tr><td style="font-size: 7px" height="8">&nbsp;</td></tr>
          <?php echo main_menu_item('motor_ships') ?>
          <?php echo main_menu_item('yachts') ?>
          <?php echo main_menu_item(array('route' => 'catalog_item', 'name' => 'scooters'), array('category_slug' => 'attractions', 'item_slug' => 'scooters')) ?>
          <?php echo main_menu_item(array('route' => 'catalog_category', 'name' => 'for_vip'), array('category_slug' => 'for_vip')) ?>
          <tr><td>&nbsp;</td></tr>
          <?php echo main_menu_item('banquet') ?>
          <tr><td style="font-size: 5px" height="8">&nbsp;</td></tr>
        </table>
        <img src="/images/block/lt.jpg" class="StdBlockMenuLT2"><img src="/images/block/rt.jpg" class="StdBlockMenuRT2"><img src="/images/block/rb.jpg" class="StdBlockMenuRB2"><img src="/images/block/lb.jpg" class="StdBlockMenuLB2">
      </div>
    </td>
 </tr>
 */ ?>

  <tr><td height="30">&nbsp;</td></tr>
  <tr>
    <td class="MainMenuBlock">
      <div style="position: relative;">
        <!-- slide menu -->
        <div id="sub_menu_odessa_yachts" class="sm_odessa_yachts">
          <?php echo dropdown_menu_item(array('route' => 'catalog_category', 'name' => 'odessa_sailing_yachts'), array('category_slug' => 'odessa_sailing_yachts')) ?><br/>
          <?php echo dropdown_menu_item(array('route' => 'catalog_category', 'name' => 'odessa_motor_yachts'), array('category_slug' => 'odessa_motor_yachts')) ?><br/>
          <?php echo dropdown_menu_item(array('route' => 'catalog_category', 'name' => 'odessa_motor_ships'), array('category_slug' => 'odessa_motor_ships')) ?><br/>
          <img src="/images/block/rt.jpg" style="top: -2px; top: expression('-2px'); right: -2px; right: expression('-2px');"><img src="/images/block/rb.jpg" style="bottom: -2px; bottom: expression('-2px'); right: -2px; right: expression('-2px');">
        </div>
        
        <div id="sub_menu_croatia_yachts" class="sm_croatia_yachts">
          <?php echo dropdown_menu_item(array('route' => 'catalog_category', 'name' => 'croatia_sailing_yachts'), array('category_slug' => 'croatia_sailing_yachts')) ?><br/>
          <?php echo dropdown_menu_item(array('route' => 'catalog_category', 'name' => 'croatia_motor_yachts'), array('category_slug' => 'croatia_motor_yachts')) ?><br/>
          <img src="/images/block/rt.jpg" style="top: -2px; top: expression('-2px'); right: -2px; right: expression('-2px');"><img src="/images/block/rb.jpg" style="bottom: -2px; bottom: expression('-2px'); right: -2px; right: expression('-2px');">
        </div>
        
        <div id="sub_menu_greece_yachts" class="sm_greece_yachts">
          <?php echo dropdown_menu_item(array('route' => 'catalog_category', 'name' => 'greece_sailing_yachts'), array('category_slug' => 'greece_sailing_yachts')) ?><br/>
          <?php echo dropdown_menu_item(array('route' => 'catalog_category', 'name' => 'greece_motor_yachts'), array('category_slug' => 'greece_motor_yachts')) ?><br/>
          <img src="/images/block/rt.jpg" style="top: -2px; top: expression('-2px'); right: -2px; right: expression('-2px');"><img src="/images/block/rb.jpg" style="bottom: -2px; bottom: expression('-2px'); right: -2px; right: expression('-2px');">
        </div>

        <table cellspacing="0" cellpadding="0" border="0" width="100%">
          <tr><td style="font-size: 5px" height="6">&nbsp;</td></tr>
          <?php echo main_menu_item_title('yachts',array(),"Яхты") ?>
          <?php //echo main_menu_item_title('odessa_yachts',array(),"Аренда яхт в Одессе") ?>	
		  
		  <tr><td class="menu_cell menu_odessa_yachts" id="menu_odessa_yachts"><a title="Аренда яхт в Одессе" class="inactive" href="/odessa_yachts.html">Аренда яхт в Одессе</a></td></tr>
		  <tr><td class="menu_cell menu_odessa_yachts_mobile" id="menu_odessa_yachts"><a title="Аренда в Одессе" class="inactive">Аренда в Одессе</a></td></tr>
		  
          <?php echo main_menu_item_title('croatia_yachts',array(),"Аренда яхт в Хорватии") ?>
          <?php echo main_menu_item_title('greece_yachts',array(),"Аренда яхт в Греции") ?>
          <?php echo main_menu_item_title('iyt',array(),"Обучение яхтингу") ?>
          <tr><td style="font-size: 7px" height="10">&nbsp;</td></tr>
        </table>
        <img src="/images/block/lt.jpg" class="StdBlockMenuLT"><img src="/images/block/rt.jpg" class="StdBlockMenuRT"><img src="/images/block/rb.jpg" class="StdBlockMenuRB"><img src="/images/block/lb.jpg" class="StdBlockMenuLB">
      </div>
    </td>
  </tr>

</table>