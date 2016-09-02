<h1>
  <?php echo __('newsf_list_h1', array(), 'meta') ?>
</h1>
<div>
  <ul>
  <?php foreach($news as $new): ?>
    <li style="background-image: none; margin-bottom: 25px;">
    <h2 style="text-align: left;">
      <?php echo $new->getTitle() ?>
    </h2>
    <div>
      <?php echo $new->getDateTimeObject('created_at')->format('d.m.Y'); ?> :
      <?php echo $new->getDescription() ?>
      <a href="<?php echo url_for("newsf/show?slug=".$new->getSlug()) ?>">
      <br/>
      <?php echo $new->getName() ?></a>
    </div>
    </li>
  <?php endforeach ?>
  </ul>
</div>