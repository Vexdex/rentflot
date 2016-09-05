<table cellspacing="0" style="width: 100%">  
  <tr>    
    <td><?php include_partial('order/pagination', array('pager' => $pager)) ?></td>
    <td style="vertical-align: middle; text-align: right; padding-top: 5px">
      <ul class="BatchActions" style="margin: 0 2px; float: right">
        <?php include_partial('order/list_actions', array('helper' => $helper)) ?>
      </ul>
      <div class="clear"></div>
    </td>
  </tr>
</table>
  
<table cellspacing="0" class="GridList">
  <tr>
    <th id="sf_admin_list_batch_actions" class="BatchCheckbox">
      <input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" />
    </th>
    <?php include_partial('order/list_th_tabular', array('sort' => $sort, 'next_sort_type' => $next_sort_type)) ?>
    <th id="sf_admin_list_th_actions" class="Actions"></th>
  </tr>

  <?php foreach ($pager->getResults() as $i => $order): $odd = fmod(++$i, 2) ? 'Odd' : 'Even' ?>
    <?php /* @var Order $order */ ?>
    <tr class="GridListRow <?php echo $odd ?> OrderStatus<?php echo $order->getDebtStatus() ?>">
      <?php include_partial('order/list_td_batch_actions', array('order' => $order, 'helper' => $helper, 'batch_ids' => $batch_ids)) ?>
      <?php include_partial('order/list_td_tabular', array('order' => $order)) ?>
      <?php include_partial('order/list_td_actions', array('order' => $order, 'helper' => $helper)) ?>
    </tr>
  <?php endforeach; ?>
</table>

<?php include_partial('order/pagination', array('pager' => $pager)) ?>
      

<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>
