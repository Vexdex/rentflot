<?php if ($actions = $this->configuration->getValue('list.actions')): ?>
<?php foreach ($actions as $name => $params): ?>
  <?php if ('_new' == $name): ?>
    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToNew(' . $this->asPhp($params) . ') ?]', $params) . "\n" ?>
    <?php else: ?>
      <?php echo $this->addCredentialCondition('<li class="GridAction' . ucfirst($params['class_suffix']) . '">' . $this->getLinkToAction($name, $params, false) . '</li>', $params) ?>
    <?php endif; ?>
  <?php endforeach; ?>
<?php endif; ?>
