<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
	<title>Document</title>
	<link rel="stylesheet" href="<?php echo (PROJECT); ?>/jsalert/css/window.css">
	<script type="text/javascript" src="<?php echo (WORK_LOG); ?>/js/require.js" data-main="<?php echo (PROJECT); ?>/jsalert/js/main.js?time=<?php echo time();?>" defer></script>
</head>
<body>
	<input type="button" value="alert弹窗" id="a">
</body>
</html>