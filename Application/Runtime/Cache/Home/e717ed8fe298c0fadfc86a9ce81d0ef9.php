<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>artEditor</title>
	<meta http-equiv="Access-Control-Allow-Origin" content="*">
	<!-- 强制让文档的宽度与设备的宽度保持1:1，并且文档最大的宽度比例是1.0，且不允许用户点击屏幕放大浏览 -->
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width, minimal-ui">
	<!-- iphone设备中的safari私有meta标签，它表示：允许全屏模式浏览 -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="stylesheet" href="<?php echo (PROJECT); ?>/artEditor/css/style.css">
</head>
<body>
	<div style="width:320px;margin: 0 auto;">
		<div class="publish-article-title">
			<div class="title-tips">标题</div>
			<input type="text" id="title" class="w100" placeholder="文章标题">
		</div>
		<div class="publish-article-content">
			<div class="title-tips">正文</div>
			<input type="hidden" id="target">
			<div class="article-content" id="content">
			</div>
			<div class="footer-btn g-image-upload-box">
				<div class="upload-button">
					<span class="upload"><i class="upload-img"></i>插入图片</span>
					<input class="input-file" id="imageUpload" type="file" name="fileInput" capture="camera" accept="image/*" style="position:absolute;left:0;opacity:0;width:100%;">
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo (WORK_LOG); ?>/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo (PROJECT); ?>/artEditor/js/artEditor.min.js"></script>
	<script src="<?php echo (PROJECT); ?>/artEditor/js/index.js"></script>
	<button id="test">提交</button>
	<script>
		(function(){
			$('#test').on('click',function(){
				var val = $('#content').getValue();  
				console.log(val); 
			})
		})(jQuery)
	</script>
</body>
</html>