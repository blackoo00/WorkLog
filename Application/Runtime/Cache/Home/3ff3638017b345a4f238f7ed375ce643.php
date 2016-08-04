<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<script type="text/javascript" src="<?php echo (WORK_LOG); ?>/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo (WORK_LOG); ?>/imgupload/js/ajaxfileupload.js" type="text/javascript"></script>
	<title>商城设置</title>
</head>
<style>
	#shop-form{
		padding: 2%;
	}
	.clear{
		clear: both;
	}
	.log-wrap{
		float: left;
		width: 50%;
		margin: 0 0 10px 40px;
		position: relative;
	}
	#shoplogo{
		position: absolute;
		z-index: 3;
		width: 102px;
		height: 102px;
		left: 0;
		text-indent: -99px;
		opacity: 0;
	}
	.icon{
		position: absolute;
		height: 35px;
		left: 0;
		top: 0;
		width: 100px;
		background-color: rgba(0,0,0,0.4);
		top: 67px;
		text-align: center;
		line-height: 35px;
		font-weight: 700;
		color: #fff;
		z-index: 2;
	}
	.loading{
		position: absolute;
		width: 60px;
		left: 0;
		top: 0;
		background-color: rgba(0,0,0,0.4);
		padding: 19px;
		display: none;
	}
</style>
<body>
		<div style="padding-top: 15px;">
			<div class="log-wrap">
				<img id="head-img" style="width: 100px; height: 100px;" src="uploads/member/56efb97883677.jpg">
				<div class="icon">修改LOGO</div>
				<input type="file" name="shoplogo" id="shoplogo">
				<input type="hidden" id="headimgurl" name="headimgurl" value="">
				<img class="loading" src="<?php echo (WORK_LOG); ?>/imgupload/images/loading.gif" alt="">
			</div>
			<div class="clear"></div>
		</div>
</body>
<script>
	(function(){
		$(document).on('change',"#shoplogo",function(){
			var loading=$(".loading");
			var img=$("#head-img");
			loading.show();
			$.ajaxFileUpload ({
				 url: "<?php echo U('Project/headpic');?>",
				 type: 'post',
				 secureuri:false,
				 fileElementId:'shoplogo',
				 dataType: 'json',
				 success: function (data){
				 	loading.hide();
				 	console.log(data);
				 	img.attr("src",data.data);
				 }
			})
			return false;
		})
	})(jQuery)
</script>
</html>