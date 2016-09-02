[?php if ($field->isPartial()): ?]
  [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php elseif ($field->isComponent()): ?]
  [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php else: ?]
  [?php $is_required_field = ((isset($form[$name]) && $form->getValidator($name)->getOption('required')) || ($form->isI18n() && isset($form[$sf_user->getCulture()][$name]) && $form->getValidatorSchema()->offsetGet($sf_user->getCulture())->offsetGet($name)->getOption('required'))); ?]
  <tr class="[?php echo $row_class ?]" id="form_<?php echo $this->getSingularName() ?>_[?php echo $name ?]_row">
    <th [?php if ($is_required_field): ?] class="FieldRequired" [?php endif; ?]>      
      [?php echo (isset($form[$name]) ? $form[$name]->renderLabel(__('form_'.$label, array(), '<?php echo $this->getI18nCatalogue() ?>')) : $form[$sf_user->getCulture()][$name]->renderLabel(__('form_'.$label, array(), '<?php echo $this->getI18nCatalogue() ?>'))) ?]: 
    </th>
    <td id="[?php echo $form->getName().'_'.$name.'_cell' ?]">
      [?php if (!isset($form[$name]) && $form->isI18n()): ?]
        [?php foreach ($cultures_enabled as $culture): ?]
          <div>[?php echo __('lang_'.$culture, array(), 'grid') ?]:</div>
          [?php echo $form[$culture][$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes); ?]
          [?php if ($form[$culture][$name]->hasError()): ?]            
            <div class="Error">&bull; [?php echo __($form[$culture][$name]->getError()->getMessageFormat(), $form[$culture][$name]->getError()->getArguments(), '<?php echo $this->getI18nErrorCatalogue() ?>') ?]</div>
          [?php endif; ?]
        [?php endforeach; ?]          
          [?php if ($help === true): ?]
            <div class="Help">[?php echo __('help_form_'.$name, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</div>
          [?php endif; ?]
      [?php else: ?]
          [?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes); ?]                    
          [?php if ($form[$name]->hasError()): ?]            
            <div class="Error">&bull; [?php echo __($form[$name]->getError()->getMessageFormat(), $form[$name]->getError()->getArguments(), '<?php echo $this->getI18nErrorCatalogue() ?>') ?]</div>
          [?php endif; ?]
          [?php if ($help === true ): ?]
            <div class="Help">[?php echo __('help_form_'.$name, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</div>
          [?php endif; ?]      
      [?php endif; ?]        
    </td>
  </tr>
[?php endif; ?]
