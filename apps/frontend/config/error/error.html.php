<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<?php include_http_metas() ?>
  <?php include_metas() ?>
  <title><?php echo __('Ошибка 500 &mdash; сервер не может обработать ваш запрос &mdash; корабельный портал www.rentflot.ua', null, 'content') ?></title>
	<link rel="shortcut icon" href="/images/favicon.ico" />
	<style type="text/css">
		body {padding: 30px; font-family: Tahoma;}
		h1 {font-size: 20pt; margin: 20px 0 40px 0}
		h2 {font-size: 16pt; margin: 40px 0 40px 0; font-weight: normal;}
		a {color: #147ce7}
		img {border: 0px;}
	</style>
</head>

<body>
  <h1>Ошибка 500 &mdash; сервер не может обработать ваш запрос</h1>
    <a href="<?php echo url_for('homepage') ?>"><img src="/images/logos/rentflot-logo1.gif" alt="Рентфлот"/></a>
  <h2>Такая ошибка &mdash; большая редкость. Пожалуйста, <a href="<?php echo url_for('feedback') ?>">сообщите</a> нам о ней, что мы могли оперативно все исправить.<br/>Приносим извинения за временные неудобства.</h2>
  <a href="<?php echo url_for('homepage') ?>">На главную</a> &mdash; <a href="<?php echo url_for('motor_ships') ?>">Аренда теплохода</a> &mdash; <a href="<?php echo url_for('sitemap') ?>">Карта сайта</a>
</body>
</html>