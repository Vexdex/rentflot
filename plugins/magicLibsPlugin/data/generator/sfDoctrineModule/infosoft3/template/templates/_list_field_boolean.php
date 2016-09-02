[?php if ($value): ?]
  [?php echo image_tag('/magicLibsPlugin/grid/<?php echo $this->params['theme'] ?>/images/check.png', array('alt' => __('list_title_'.$field_name, array(), '<?php echo $this->getI18nCatalogue() ?>'), 'title' => __('list_title_'.$field_name, array(), '<?php echo $this->getI18nCatalogue() ?>'))) ?]
[?php else: ?]
  &nbsp;
[?php endif; ?]
