<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
	<title><?php echo __($slug, null, 'imageView') ?></title>
	<meta name="keywords" content="<?php echo __($slug, null, 'imageView') ?>">
	<meta name="description" content="<?php echo __($slug, null, 'imageView') ?>">
	<meta name="robots" content="index, follow" >
	<link rel="icon" href="/images/favicon.ico" type="image/x-icon" >
	<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
	<style type="text/css">
		h1 {font-size: 20pt; font-family: Tahoma, Arial; color: #333333; line-height: 26pt; text-align: center;}
		a {font-size: 8pt; font-family: Tahoma, Arial; color: #0083fe;}
	</style>
</head>
<body>
	<br>
	<h1><?php echo __($slug, null, 'imageView') ?></h1>
	<center>
		<img src="<?php echo  $image_src ?>" alt="<?php echo __($slug, null, 'imageView') ?>" title="<?php echo __($slug, null, 'imageView') ?>" style="border: 1px solid #cccccc;">
		<br><br>
		<a href="#" onclick="window.close(); return false;"><?php echo __('close', null, 'imageView') ?></a>
	</center>
	<br>
</body>
</html>

