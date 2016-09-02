[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

<h1>[?php echo <?php echo $this->getI18NString('new.title') ?> ?]</h1>

<table cellspacing="0" id="infosoft_grid" style="width: 85%">
  [?php if ($sf_user->hasFlash('notice') || $sf_user->hasFlash('error') || $sf_user->hasFlash('error') || $sf_user->hasFlash('custom_error')): ?]
    <tr>
      <td>
        [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]
      </td>
    </tr>
  [?php endif; ?]
  <tr>
    <td class="DataContainer">
      [?php include_partial('<?php echo $this->getModuleName() ?>/form', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper, 'cultures_enabled' => $cultures_enabled)) ?]
    </td>
  </tr>
</table>
