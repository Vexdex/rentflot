<?php use_helper('I18N', 'Date') ?>
<?php include_partial('contact/assets') ?>

<h1><?php echo __('page_edit_title', array(), 'contact') ?></h1>

<table cellspacing="0" id="infosoft_grid" style="width: 85%">
  <?php if ($sf_user->hasFlash('notice') || $sf_user->hasFlash('error') || $sf_user->hasFlash('error') || $sf_user->hasFlash('custom_error')): ?>
    <tr>
      <td>
        <?php include_partial('contact/flashes') ?>
      </td>
    </tr>
  <?php endif; ?>
  <tr>
    <td class="DataContainer">
      <?php include_partial('contact/form', array('client_contact' => $client_contact, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper, 'cultures_enabled' => $cultures_enabled, 'other_contacts'=>$otherContacts)) ?>
    </td>
  </tr>
</table>