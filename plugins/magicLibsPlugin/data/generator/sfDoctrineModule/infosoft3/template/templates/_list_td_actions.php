<td class="Actions">
  <?php if ($this->configuration->getValue('list.object_actions')): ?> 
  <ul class="GridActions">
  <?php foreach ($this->configuration->getValue('list.object_actions') as $name => $params): ?>
    <?php if (isset($params['condition'])): ?>
      [?php if (<?php echo (isset($params['condition']['invert']) && $params['condition']['invert'] ? '!' : '') . '$' . $this->getSingularName() . '->' . $params['condition']['function'] ?>(<?php echo (isset($params['condition']['params']) ? $params['condition']['params'] : '') ?>)): ?]
    <?php endif; ?>
  
    <?php if ('_delete' == $name): ?>
      <?php echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
    <?php elseif ('_edit' == $name): ?>
      <?php echo $this->addCredentialCondition('[?php echo $helper->linkToEdit($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
    <?php else: ?>
      <li class="GridAction<?php echo ucfirst($params['class_suffix']) ?>">
        <?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, true), $params) ?>
      </li>
    <?php endif; ?>
    
    <?php if (isset($params['condition'])): ?>
      [?php endif; ?]
    <?php endif; ?>
  <?php endforeach; ?>
  </ul>
  <?php endif; ?>
</td>
 