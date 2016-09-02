<table cellspacing="0" style="width: 100%">
  <tr>    
    <td><?php include_partial('contact/pagination', array('pager' => $pager)) ?></td>
    <td style="vertical-align: middle; text-align: right; padding-top: 5px">
      <ul class="BatchActions" style="margin: 0 2px; float: right">
        <?php include_partial('contact/list_actions', array('helper' => $helper)) ?>
      </ul>
      <div class="clear"></div>
    </td>
  </tr>
</table>
  
<table cellspacing="0" class="GridList">
  <tr>

          <?php include_partial('contact/list_th_tabular', array('sort' => $sort, 'next_sort_type' => $next_sort_type)) ?>
          <th id="sf_admin_list_th_actions" class="Actions">
              </th>
      </tr>

  <?php foreach ($pager->getResults() as $i => $client_contact): $odd = fmod(++$i, 2) ? 'Odd' : 'Even' ?>
   <tr id="<?php echo 'client_contact_row_'.$client_contact->getId() ?>" class="GridListRow <?php echo $odd ?>" style="color:<?php if($client_contact->getContactStatusId()==2 || $client_contact->getContactDate()==date('Y-m-d 00:00:00',time())) echo "green";elseif($client_contact->getContactDate()<date('Y-m-d 00:00:00',time())) echo "red"; ?>">
            
          <?php include_partial('contact/list_td_tabular', array('client_contact' => $client_contact)) ?>
            <?php include_partial('contact/list_td_actions', array('client_contact' => $client_contact, 'helper' => $helper)) ?>
       </tr>
  <?php endforeach; ?>

  <!--<tr>
    <td colspan="8">
      
    </td>
  </tr>-->
  
</table>

<?php include_partial('contact/pagination', array('pager' => $pager)) ?>
      

<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>
