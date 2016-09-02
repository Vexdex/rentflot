<table>    
<?php $cultures = sfConfig::get('app_cultures_enabled'); foreach($cultures as $culture => $text): ?>
  <tr>
    <td>
      <div><?php echo __('lang_'.$culture, array(), 'grid') ?>:</div>
      <?php echo $form[$culture][$fields[0]] ?> <?php echo $form[$culture][$fields[1]] ?>
      
      <?php if ($form[$culture][$fields[0]]->hasError() || $form[$culture][$fields[1]]->hasError()): ?>            
        <ul class="ErrorContainer">
          <?php if ($form[$culture][$fields[0]]->hasError()): ?>
            <li>&laquo;<?php echo __('form_'.$proxy_field, null, 'propertyAdmin') ?>&raquo;: <?php echo __($form[$culture][$fields[0]]->getError()->getMessageFormat(), $form[$culture][$fields[0]]->getError()->getArguments(), 'grid') ?></li>
          <?php endif ?>        
          <?php if ($form[$culture][$fields[1]]->hasError()): ?>            
            <li>&laquo;<?php echo __('form_'.$proxy_field, null, 'propertyAdmin') ?>&raquo;: <?php echo __($form[$culture][$fields[1]]->getError()->getMessageFormat(), $form[$culture][$fields[1]]->getError()->getArguments(), 'grid') ?></li>
          <?php endif ?>                  
        </ul>      
      <?php endif; ?>      

    </td>
  </tr>
<?php endforeach ?>
</table>
   