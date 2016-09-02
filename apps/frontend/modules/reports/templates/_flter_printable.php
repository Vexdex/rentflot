<br/>
<table class="Report" style="width: 550px;">
<?php
  /* @var ReportsFormFilter $reports_form_filter */
  /* @var sfFormField $field */
?>
  <?php foreach ($reports_form_filter as $name => $field): ?>  
    <?php if ($field->getValue()): ?>
      <tr>
        <th class="Left"><nobr><?php echo __('filter_'.$name, null, 'reports') ?></nobr></th>
        <td class="Left">
          <?php if ($name != 'date'): ?>
            <?php if ($field->getWidget() instanceof sfWidgetFormDoctrineChoice || $field->getWidget() instanceof sfWidgetFormChoice): ?>
              <?php $choices = $field->getWidget()->getChoices() ?>
              <?php if (is_array($field->getValue())): ?>
                <?php foreach ($field->getValue() as $field_value): ?>
                  <nobr><?php echo $choices[$field_value] ?></nobr><br/>
                <?php endforeach ?>
              <?php else: ?>
                <?php echo $choices[$field->getValue()] ?>
              <?php endif ?>
            <?php else: ?>
              <?php if ($field->getWidget() instanceof sfWidgetFormInputCheckbox): ?>
                <span style="font-size: 15pt; color: green">&#10003;</span>
              <?php else: ?>
                <?php $field->getValue() ?>
              <?php endif ?>
            <?php endif ?>
          <?php else: ?>            
            <?php $values = $field->getValue(); if (!empty($values['from'])): ?> от <?php echo format_date($values['from'], 'dd.MM.yyyy')  ?><?php endif ?><?php if (!empty($values['to'])): ?> до <?php echo format_date($values['to'], 'dd.MM.yyyy') ?><?php endif ?>          
          <?php endif ?>
        </td>
      </tr>
    <?php endif ?>
  <?php endforeach ?>
</table>
