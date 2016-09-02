[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

[?php if ($form->hasGlobalErrors()): ?]
  [?php echo $form->renderGlobalErrors() ?]
[?php endif; ?]

<form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter')) ?]" id="<?php echo sfInflector::underscore($this->getModelClass()) ?>_filter" method="post">
  <table cellspacing="0" class="Filters">
    <thead>
      <tr>
        <th colspan="2" class="FiltersHeader"><span>[?php echo __('filter', array(), 'grid'); ?]</span></th>
      </tr>
    </thead>
    <tbody class="FiltersBody"[?php $filters_data = $sf_user->getAttribute('<?php echo $this->getModuleName() ?>.filters', null, 'admin_module'); $filters_data = ($filters_data instanceof sfOutputEscaperArrayDecorator ? $filters_data->getRawValue() : $filters_data); if (empty($filters_data) && !$form->hasErrors()): ?] style="display: none"[?php endif ?]>
      [?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?]
        [?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?]
          [?php include_partial('<?php echo $this->getModuleName() ?>/filters_field', array(
            'name'       => $name,
            'attributes' => $field->getConfig('attributes', array()),
            'label'      => $field->getConfig('label') ? $field->getConfig('label') : $name,
            'help'       => $field->getConfig('help'),
            'form'       => $form,
            'field'      => $field,
            'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_filter_field_'.$name,
          )) ?]
      [?php endforeach; ?]          
      <tr>
        <td colspan="2" style="text-align: center">
          <input type="submit" value="[?php echo __('filter_apply', array(), 'grid') ?]" /> &nbsp;&nbsp;&nbsp; [?php echo link_to(__('filter_reset', array(), 'grid'), '<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?]
          [?php echo $form->renderHiddenFields() ?]
        </td>
      </tr>
    </tbody>
  </table>    
</form>    