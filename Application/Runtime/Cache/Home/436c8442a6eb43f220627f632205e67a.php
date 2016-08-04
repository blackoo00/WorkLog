<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<script type="text/javascript" src="<?php echo (WORK_LOG); ?>/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php echo (WORK_PUBLIC); ?>/loadingBar/js/loadingBar.js"></script>
	<link rel="stylesheet" href="<?php echo (WORK_PUBLIC); ?>/loadingBar/css/loadingBar.css">
	<title>顶部加载滚动条</title>
</head>
<body>
	<input type="button" value="加载" id="load">
</body>
<script>
	$('#load').loadingbar({
		url:"/work_log/index.php/Home/Project/loadingBarAjax",
		per1:80,
		per2:20,
		callback:test,
		speed:1000,
	});
	function test(data){
		console.log(data);
	}
</script>
</html>