[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

[?php if ($form->hasGlobalErrors()): ?]
  <div class="Error">
    [?php echo $form->renderGlobalErrors() ?]
  </div>
[?php endif; ?]

[?php echo form_tag_for($form, '@<?php echo $this->params['route_prefix'] ?>', array('enctype'=> "multipart/form-data", 'id' => '<?php echo sfInflector::underscore($this->getModelClass()) ?>_form')) ?]
  <table cellspacing="0" class="GridForm">
    [?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?]
      [?php include_partial('<?php echo $this->getModuleName() ?>/form_fieldset', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset, 'cultures_enabled' => $cultures_enabled)) ?]
    [?php endforeach; ?]
    <tr>
      <td colspan="2" align="center" style="text-align: center">
        [?php include_partial('<?php echo $this->getModuleName() ?>/form_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]  
      </td>
    </tr>
  </table>
  [?php echo $form->renderHiddenFields(false) ?]
</form>


