<table cellspacing="0" id="infosoft_grid">
  <tr>
    <td style="padding: 0 2px 3px 2px; vertical-align: top;">
      <form name="reports_form_filter" id="reports_form_filter" method="get">
        <table cellspacing="0" class="Filters">
          <tr>
            <th colspan="2"><span>Фильтр</span></th>
          </tr>  
          <tr>
            <td class="FilterName"><?php echo __('filter_date', null, 'reports') ?>:</td>      
            <td class="FilterValue">   
              <?php echo $reports_form_filter['date'] ?>              
              <?php if ($reports_form_filter['date']->hasError()): ?>
                <ul class="ValidatorError"><li><?php echo __($reports_form_filter['date']->getError()->getMessageFormat(), $reports_form_filter['date']->getError()->getArguments(), 'grid') ?></li></ul>  
              <?php endif ?>                                  
            </td>
          </tr>          
          <tr>
            <td colspan="2" style="text-align: center">
              <input type="submit" value="OK" />              
              <?php echo link_to(__('filter_reset', array(), 'grid'), 'report_bills') ?>
              <?php //echo $reports_form_filter->renderHiddenFields() ?>
            </td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
