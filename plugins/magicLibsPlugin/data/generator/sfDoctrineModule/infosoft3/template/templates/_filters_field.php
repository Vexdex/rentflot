[?php if ($field->isPartial()): ?]
  [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php elseif ($field->isComponent()): ?]
  [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php else: ?]
  <tr>
    <td class="FilterName"><nobr>[?php echo $form[$name]->renderLabel(__('filter_'.$label, array(), '<?php echo $this->getI18nCatalogue() ?>')) ?]:</nobr></td>
    <td class="FilterValue">

      [?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?]
      
      [?php if ($form[$name]->hasError()): ?]            
        <div class="Error">&bull; [?php echo __($form[$name]->getError()->getMessageFormat(), $form[$name]->getError()->getArguments(), '<?php echo $this->getI18nErrorCatalogue() ?>') ?]</div>
      [?php endif; ?]

      [?php if ($help === true ): ?]
        <div class="Help">[?php echo __('help_filter_'.$name, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</div>
      [?php endif; ?]      
      
    </td>
  </tr>
[?php endif; ?]
