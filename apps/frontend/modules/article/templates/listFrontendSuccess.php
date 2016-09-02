<h1>
  <?php echo __('frontend_list_title', array(), 'article') ?>
</h1>
<p>
  <?php echo __('frontend_list_description', array(), 'article') ?>
</p>

<ul>
  <?php foreach ($articles as $article): ?>
    <li style="padding-bottom: 8px">
      <a href="<?php echo url_for('article_frontend_show', array('slug' => $article->getSlug())) ?>"><?php echo $article->getName() ?></a><br />    
      <span class="ArticleDate">Добавлено: <?php echo format_date($article->getCreatedAt(), 'dd.MM.yyyy') ?></span>
    </li>
  <?php endforeach ?>
</ul>
