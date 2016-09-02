<table cellspacing="0" style="width: 100%">
  <tr>    
    <td>[?php include_partial('<?php echo $this->getModuleName() ?>/pagination', array('pager' => $pager)) ?]</td>
    <td style="vertical-align: middle; text-align: right; padding-top: 5px">
      <ul class="BatchActions" style="margin: 0 2px; float: right">
        [?php include_partial('<?php echo $this->getModuleName() ?>/list_actions', array('helper' => $helper)) ?]
      </ul>
      <div class="clear"></div>
    </td>
  </tr>
</table>
  
<table cellspacing="0" class="GridList">
  <tr>
    <?php if ($this->configuration->getValue('list.batch_actions')): ?>
      <th id="sf_admin_list_batch_actions" class="BatchCheckbox">
        <input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" />
      </th>
    <?php endif; ?>
      [?php include_partial('<?php echo $this->getModuleName() ?>/list_th_<?php echo $this->configuration->getValue('list.layout') ?>', array('sort' => $sort, 'next_sort_type' => $next_sort_type)) ?]
    <?php if ($this->configuration->getValue('list.object_actions')): ?>
      <th id="sf_admin_list_th_actions" class="Actions">
        <?php //[?php echo __('actions', array(), 'grid'); ?] ?>
      </th>
    <?php endif; ?>
  </tr>

  [?php foreach ($pager->getResults() as $i => $<?php echo $this->getSingularName() ?>): $odd = fmod(++$i, 2) ? 'Odd' : 'Even' ?]
   <tr id="[?php echo '<?php echo $this->getSingularName() ?>_row_'.$<?php echo $this->getSingularName() ?>->getId() ?]" class="GridListRow [?php echo $odd ?]">
     <?php if ($this->configuration->getValue('list.batch_actions')): ?>
       [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_batch_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper, 'batch_ids' => $batch_ids)) ?]
     <?php endif; ?>
     [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_<?php echo $this->configuration->getValue('list.layout') ?>', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
     <?php if ($this->configuration->getValue('list.object_actions')): ?>
       [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)) ?]
     <?php endif; ?>
  </tr>
  [?php endforeach; ?]

  <!--<tr>
    <td colspan="<?php echo count($this->configuration->getValue('list.display')) + ($this->configuration->getValue('list.object_actions') ? 1 : 0) + ($this->configuration->getValue('list.batch_actions') ? 1 : 0) ?>">
      
    </td>
  </tr>-->
  
</table>

[?php include_partial('<?php echo $this->getModuleName() ?>/pagination', array('pager' => $pager)) ?]
      

<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>
