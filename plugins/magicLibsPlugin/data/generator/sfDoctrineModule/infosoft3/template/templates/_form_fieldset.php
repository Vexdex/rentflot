  [?php $i = 0 ?]
  [?php foreach ($fields as $name => $field): ?]
    [?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && ($field->isReal() || ($form->isI18n() && !isset($form[$sf_user->getCulture()][$name]))))) continue ?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/form_field', array(
      'name'       => $name,
      'attributes' => $field->getConfig('attributes', array()),
      'label'      => $field->getConfig('label') ? $field->getConfig('label') : $name,
      'help'       => $field->getConfig('help'),
      'form'       => $form,
      'field'      => $field,
      'row_class'  => fmod(++$i, 2) ? 'Odd' : 'Even',
      'class'      => strtolower($field->getType()),
      'cultures_enabled' => $cultures_enabled
    )) ?]
  [?php endforeach; ?]
