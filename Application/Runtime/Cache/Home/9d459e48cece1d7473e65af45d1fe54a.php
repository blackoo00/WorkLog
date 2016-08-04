<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
	<title>项目目录</title>
</head>
<style>
	a{display: block;margin: 10px; 0 }
</style>
<body>
	<a href="<?php echo U('Project/lucky');?>">抽奖页面</a>
	<a href="<?php echo U('Project/sign');?>">签到页面</a>
	<a href="<?php echo U('Project/ajaxImgUpload');?>">上传图片</a>
	<a href="<?php echo U('Project/wxGetInfo');?>">抓取微信新闻</a>
	<a href="<?php echo U('Project/loadingBar');?>">顶部加载动作条一（分段）</a>
	<a href="<?php echo U('Project/nprogress');?>">顶部加载动作条二（连续）</a>
	<a href="<?php echo U('Project/Address',array('style'=>1));?>">地址列表一</a>
	<a href="<?php echo U('Project/Address',array('style'=>2));?>">地址列表二</a>
	<a href="<?php echo U('Project/artEditor');?>">移动端图文编辑器</a>
	<a href="<?php echo U('Project/editDataUse');?>">统一修改数据表前缀(没有页面,请直接修改函数)(1修改2添加)(谨慎使用)</a>
	<a href="<?php echo U('Project/wavesCss3');?>">CSS3波浪动态图</a>
	<a href="<?php echo U('Project/wavesCanvas');?>">CANVAS波浪动态图</a>
	<a href="<?php echo U('Project/qrcode');?>">PHP生成带超链接的二维码()</a>
	<img src="<?php echo U('Project/qrcode');?>" alt="百度链接">
	<a href="<?php echo U('Project/personInfoEdit');?>">个人修改页面</a>
	<a href="<?php echo U('Project/weui');?>">WEUI</a>
	<a href="<?php echo U('Project/uploadImgs');?>">上传多个图片</a>
</body>
</html>