<table cellspacing="0" cellpadding="0" border="0" width="100%">
  <tr>
    <td class="MainMenuBlock">
      <div style="position: relative;">
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
          <tr><td style="font-size: 5px" height="6">&nbsp;</td></tr>

          <?php if ($sf_user->hasGroup('admin') || $sf_user->hasGroup('manager')): ?>
            <?php echo main_menu_item('sf_guard_signin_redirect', array('sf_culture' => 'ru')) ?>
          <?php endif ?>

          <?php if ($sf_user->hasCredential('catalog_show_own_items_rent_details')): ?>
            <?php echo main_menu_item('catalog_own_items') ?>
          <?php endif ?>

          <tr><td style="font-size: 5px" height="8">&nbsp;</td></tr>
        </table>
        <img src="/images/block/lt.jpg" class="StdBlockMenuLT"><img src="/images/block/rt.jpg" class="StdBlockMenuRT"><img src="/images/block/rb.jpg" class="StdBlockMenuRB"><img src="/images/block/lb.jpg" class="StdBlockMenuLB">
      </div>
    </td>
  </tr>
</table>