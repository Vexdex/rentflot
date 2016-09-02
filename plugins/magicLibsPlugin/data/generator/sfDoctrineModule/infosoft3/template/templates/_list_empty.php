<?php /* <table cellspacing="0" id="infosoft_grid">
  <tr>
    <td style="padding-left: 3px">
      [?php echo __('list_empty', null, 'grid') ?]
    </td>
  </tr>
  <tr>
    <td>
      <ul class="BatchActions">
        <?php 
          if ($actions = $this->configuration->getValue('list.actions')) {
            if (isset($actions['_new'])) {
              echo $this->addCredentialCondition('[?php echo $helper->linkToNew('.$this->asPhp($actions['_new']).') ?]', $actions['_new'])."\n";
            }
          }
        ?>
      </ul>
    </td>
  </tr>
</table>

*/ ?>

<table cellspacing="0" id="infosoft_grid">
  [?php if ($sf_user->hasFlash('notice') || $sf_user->hasFlash('error')): ?]
    <tr>
      <td colspan="2">
        [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]
      </td>
    </tr>
  [?php endif; ?]
  <tr>
    <td style="padding: 2px 5px">
      [?php echo __('list_empty', null, 'grid') ?]
    </td>
    <td valign="bottom" style="vertical-align: bottom; text-align: right">
      <ul class="BatchActions" style="margin: 0 2px; float: right">
        [?php include_partial('<?php echo $this->getModuleName() ?>/list_actions', array('helper' => $helper)) ?]
      </ul>
      <div class="clear"></div>
    </td>
  </tr>
</table>