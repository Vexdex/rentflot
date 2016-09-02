<h1><?php echo $article->getName() ?></h1>
<?php echo $article->getContent(ESC_RAW) ?>
<p><b>Автор:</b> Рентфлот</p>
<br>
<a href="<?php echo url_for('article_frontend_list') ?>">&laquo; Вернуться к списку статей</a>
