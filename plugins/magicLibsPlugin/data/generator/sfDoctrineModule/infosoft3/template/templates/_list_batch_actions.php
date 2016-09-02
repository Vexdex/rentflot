<?php if ($listActions = $this->configuration->getValue('list.batch_actions')): ?>
<li>
  <span>[?php echo __('batch_with_selected', array(), 'grid') ?]</span>
  <select name="batch_action" id="[?php echo $batch_action_id ?]" onchange="setBatchActionName('[?php echo $batch_inactive_id ?]', '[?php echo $batch_action_id ?]')">
    <option value="">[?php echo __('batch_select_action', array(), 'grid') ?] &rarr;</option>

<?php foreach ((array) $listActions as $action => $params): ?>
    <?php //echo $this->addCredentialCondition('<option value="'.$action.'">[?php echo __(\''.$params['label'].'\', array(), \'grid\') ?]</option>', $params) ?>
    <?php echo $this->addCredentialCondition('<option value="'.$action.'">[?php echo __(\'batch_'.$params['label'].'\', array(), \''.(isset($params['is_default_action']) ? 'grid' : $this->getI18nCatalogue()).'\') ?]</option>', $params) ?>
   
<?php endforeach; ?>
  </select>
  [?php $form = new BaseForm(); if ($form->isCSRFProtected()): ?]
    <input type="hidden" name="[?php echo $form->getCSRFFieldName() ?]" value="[?php echo $form->getCSRFToken() ?]" />
  [?php endif; ?]
  <input type="submit" value="[?php echo __('batch_apply', array(), 'grid') ?]" />
</li>
<?php endif; ?>
