<?php use_helper('I18N', 'Date') ?>
<?php include_partial('order/assets') ?>

<h1><?php echo __('page_edit_title', array(), 'order') ?></h1>

<table cellspacing="0" id="infosoft_grid" style="width: 100%">
  <?php if ($sf_user->hasFlash('notice') || $sf_user->hasFlash('error') || $sf_user->hasFlash('error') || $sf_user->hasFlash('custom_error')): ?>
    <tr>
      <td>
        <?php include_partial('order/flashes') ?>
      </td>
    </tr>
  <?php endif; ?>
  <tr>
    <td class="DataContainer">
      <?php include_partial('order/form', array('order' => $order, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper, 'cultures_enabled' => $cultures_enabled, 'item_by_category_form' => $item_by_category_form)) ?>
    </td>
  </tr>
</table>