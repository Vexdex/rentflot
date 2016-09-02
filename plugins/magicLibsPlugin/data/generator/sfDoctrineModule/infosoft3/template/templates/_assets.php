<?php if (isset($this->params['css']) && ($this->params['css'] !== false)): ?> 
  [?php use_stylesheet('<?php echo $this->params['css'] ?>', 'first') ?] 
<?php elseif(!isset($this->params['css'])): ?> 
  [?php use_stylesheet('/magicLibsPlugin/jquery/jquery-ui/<?php echo $this->params['theme'] ?>/jquery-ui-1.8.7.custom.css') ?]
  [?php use_stylesheet('/magicLibsPlugin/grid/<?php echo $this->params['theme'] ?>/css/grid.css') ?]                   
<?php endif; ?>

[?php use_javascript('/magicLibsPlugin/jquery/jquery-1.7.2.min.js') ?]
[?php use_javascript('/magicLibsPlugin/jquery/jquery-ui/jquery-ui-1.8.7.magic.js') ?]
[?php use_javascript('/magicLibsPlugin/jquery/jquery-ui/jquery-ui-i18n.js') ?]
[?php use_javascript('/magicLibsPlugin/js/tools.js') ?]
[?php use_javascript('/magicLibsPlugin/grid/<?php echo $this->params['theme'] ?>/js/grid-i18n.js') ?]
[?php use_javascript('/magicLibsPlugin/grid/<?php echo $this->params['theme'] ?>/js/grid.js') ?]
