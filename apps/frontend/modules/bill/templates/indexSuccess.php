<?php use_helper('I18N', 'Date') ?>
<?php include_partial('bill/assets') ?>

<h1><?php echo __('page_list_title', array(), 'bill') ?></h1>

<?php $module_filters = $sf_user->getAttribute('bill.filters', null, 'admin_module') ?>
<?php if ($pager->count() || (!empty($module_filters) && $module_filters->count())): ?> 

  <script type="text/javascript"> 
    function setBatchActionName(batch_inactive_id, batch_action_id)
    {
      $(document).ready(function() {
        $('#'+batch_inactive_id).attr('name', 'hello_world');
      });
    }
  </script>
  
  <?php include_partial('bill/list_header', array('helper' => $helper)) ?>  
  <table cellspacing="0" id="infosoft_grid">
  <?php if ($sf_user->hasFlash('notice') || $sf_user->hasFlash('custom_notice') || $sf_user->hasFlash('error') || $sf_user->hasFlash('custom_error')): ?>
    <tr>
      <td <?php if (!empty($filters) && $pager->count()): ?>colspan="2"<?php endif ?>>
        <?php include_partial('bill/flashes') ?>
      </td>
    </tr>
  <?php endif; ?>
    <tr>
      <?php if (!empty($filters)): ?>
        <td style="padding: 0 2px 3px 2px; vertical-align: top;">
          <?php include_partial('bill/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
        </td>
        <td>
         <?php include_component('bill', 'balance') ?>
        </td>
      <?php endif ?>
      <?php if (!$pager->count()): ?>  
      <td valign="bottom" style="vertical-align: bottom; text-align: right">
        <ul class="BatchActions" style="margin: 0 2px; float: right">
          <?php include_partial('bill/list_actions', array('helper' => $helper)) ?>
        </ul>
        <div class="clear"></div>
      </td>
      <?php endif ?>
    </tr>
    <tr>
      <td class="DataContainer" <?php if (!empty($filters)): ?>colspan="2"<?php endif ?>>
                  <form action="<?php echo url_for('bill_collection', array('action' => 'batch')) ?>" method="post" style="width: 100%">
                <?php if ($pager->count()): ?>  
          <?php include_partial('bill/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'next_sort_type' => $next_sort_type, 'batch_ids' => !empty($batch_ids) ? $batch_ids : array())) ?>
        <?php else: ?>
          <div style="margin: 10px 0">
            <?php echo __('no_result', null, 'grid'); ?>
          </div>
        <?php endif ?>          
        <?php $form = new BaseForm(); if ($form->isCSRFProtected()): ?>
          <input type="hidden" name="<?php echo $form->getCSRFFieldName() ?>" value="<?php echo $form->getCSRFToken() ?>" />
        <?php endif; ?>               
        
        <ul class="BatchActions">
          <?php if ($pager->count()): ?>
            <?php include_partial('bill/list_batch_actions', array('helper' => $helper, 'batch_action_id' => 'select_batch_action_2', 'batch_inactive_id' => 'select_batch_action_1')) ?>
          <?php endif ?>
        </ul>
        
                  </form>
              </td>
    </tr>
  </table>
  <?php include_partial('bill/list_footer', array('helper' => $helper)) ?>

<?php else: ?>
  <?php include_partial('bill/list_empty', array('helper' => $helper)) ?>
<?php endif ?>

