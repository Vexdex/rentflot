<?php  if (sfContext::getInstance()->has('breadcrumbs') && sfContext::getInstance()->getRouting()->getCurrentRouteName() != 'homepage'): ?>    
  <p class="site_path" itemprop="breadcrumb">
  <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
    <a href="<?php echo url_for('homepage') ?>" itemprop="url">
      <span itemprop="title">
        <?php echo __('homepage', null, 'menu') ?>
      </span>
    </a>
  </span>
  &raquo;
  <?php $breadcrumbs = sfContext::getInstance()->get('breadcrumbs'); $count = count($breadcrumbs); for ($i = 0; $i < $count; $i++): ?>
    <span style="white-space: nowrap;" <?php if ($i != $count - 1): ?>itemscope itemtype="http://data-vocabulary.org/Breadcrumb"<?php endif ?>><nobr>
    <?php if ($i != $count - 1): ?> 
      <a href="<?php echo $breadcrumbs[$i]['url'] ?>" itemprop="url"><span itemprop="title"><?php echo $breadcrumbs[$i]['text'] ?></span></a> &raquo;
    <?php else: ?>
      <?php echo $breadcrumbs[$i]['text'] ?> 
    <?php endif ?>
    </nobr></span>
  <?php endfor ?>  
  </p>
<?php endif ?>