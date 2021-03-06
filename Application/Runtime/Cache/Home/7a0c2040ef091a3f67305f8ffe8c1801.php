<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<title>Document</title>
</head>
<style>
	*{margin: 0;padding: 0;box-sizing: border-box;-webkit-tap-highlight-color: rgba(0, 0, 0, 0);box-sizing: border-box;}
	.upload_img_btn,.upload_img_show{
		width: 90px;
		height: 90px;
		margin: 10px 0 0 13px;
		position: relative;
		float: left;
		box-shadow: 0 0 23px #ddd;
		overflow: hidden;
	}
	.upload_img_show{
		
	}
	.upload_img_success{
		display: none;
	}
	.upload_img_show_item{
		background: rgba(0, 0, 0, 0.44);
		position: absolute;
	}
	.upload_img_show_close{
		width: 17px;
		height: 17px;
		top: 0;
		right: 0;
		border-radius: 3px;
	}
	.upload_img_show_close:before,.upload_img_show_close:after{
		content: "";
		width: 13px;
		height: 1px;
		background: #fff;
		position: absolute;
		top: 50%;
		left: 50%;
	}
	.upload_img_show_close:before{
		transform: translate(-50%, -50%) rotate(45deg);
	}
	.upload_img_show_close:after{
		transform: translate(-50%, -50%) rotate(135deg);
	}
	.upload_img_show_bottom{
		display: none;
		bottom: 0;
		height: 30px;
		width: 100%;
	}
	.upload_img_show_loading{
		top: 0;
		padding: 18px;
	}
	.upload_img_show img{
		width: 100%;
		height: 100%;
		display: block;
	}
	.upload_img_btn{
		border: 1px dashed #D9D9D9;
		padding: 47px 0 0 0;
	}
	.upload_img_btn:active{
		background-color: #ececec;
	}
	.upload_img_btn:before{
		content: " ";
		position: absolute;
		width: 2px;
		height: 35px;
		top: 10px;
		left: 50%;
		-webkit-transform: translate(-50%, 0);
		transform: translate(-50%, 0);
		background-color: #D9D9D9;
	}
	.upload_img_btn:after{
		content: " ";
		position: absolute;
		width: 36px;
		height: 2px;
		top: 26px;
		left: 50%;
		-webkit-transform: translate(-50%, 0);
		transform: translate(-50%, 0);
		background-color: #D9D9D9;
	}
	.upload_img_btn p{
		color: #D9D9D9;
		text-align: center;
		font-size: 12px;
		line-height: 12px;
		padding: 5px 0 0 0;
	}
	.upload_img_btn .upload_img_btn_input{
		position: absolute;
		height: 100%;
		width: 100%;
		left: 0;
		top: 0;
		text-indent: -99px;
		 opacity: 0; 
		z-index: 1;
		/*background: red;*/
	}
	.clear{
		clear: both;
	}
</style>
<body>
	<!-- 取框用不显示 -->
	<div id="upload_img_show" style="display: none;">
		<div class="upload_img_show">
			<div class="upload_img_success">
				<img src="<?php echo COMMON;?>/img/touxiang1.jpg" alt="">
				<i class="upload_img_show_close upload_img_show_item"></i>
				<div class="upload_img_show_bottom upload_img_show_item"></div>
			</div>
			<div class="upload_img_loading">
				<div class="upload_img_show_loading upload_img_show_item">
					<img src="<?php echo COMMON;?>/img/loading.gif" alt="">
				</div>
			</div>
		</div>
	</div>
	<!-- 取框用不显示 -->
	<div id="upload_img_wrap">
		<div class="upload_img_btn">
			<p>上传图片</p>
			<p>最多8张</p>
			<input type="file" name="shoplogo" id="shoplogo" class="upload_img_btn_input">
		</div>
		<div class="clear"></div>
	</div>
	<input type="hidden" name="img_str" id="img_str">
	<button id="img_save">提交</button>看CONSOLE
</body>
</html>
<script src="<?php echo COMMON;?>/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo (WORK_LOG); ?>/imgupload/js/ajaxfileupload.js" type="text/javascript"></script>
<script>
	(function($){
		var show_wrap = $('#upload_img_show').html();//加载图片用的HTML（取值用不显示）
		var upload_img_wrap = $('#upload_img_wrap');//图片总框
		var ajax_loading = 0;//判断加载是否进行中
		var loading,success,img;
		//上传加载图片
	    $(document).on('change',"#shoplogo",function(){
	    	if(ajax_loading == 1){
	    		return;
	    	}
	    	ajax_loading = 1;
	        upload_img_wrap.prepend(show_wrap);
	        loading = upload_img_wrap.find('.upload_img_show:eq(0)').find('.upload_img_loading');
	        success = upload_img_wrap.find('.upload_img_show:eq(0)').find('.upload_img_success');
	        img = upload_img_wrap.find('.upload_img_show:eq(0)').find('.upload_img_success img');

		    $.ajaxFileUpload ({
				url: "<?php echo U('Project/headpic');?>",
				type: 'post',
				secureuri:false,
				fileElementId:'shoplogo',
				dataType: 'json',
		        success: function (data){

			        loading.hide();
			        success.show();
			        $('#shoplogo').replaceWith('<input name="shoplogo" class="upload_img_btn_input" type="file" id="shoplogo"/>');
			        ajax_loading = 0;
			        if(data.status==1){
			            img.attr("src",data.data);
			        }else if(data.status==2){
			            floatNotify.simple("上传失败，只支持JPG图片");
			            return;
			        }else if(data.status==3){
			          floatNotify.simple("只能三天更新一次!");
			            return;
			        }
		       }
		    })
		    return false;
	    })
	    //关闭图片
	    $(document).on('click','.upload_img_show_close',function(){
	    	var obj = $(this).parents('.upload_img_show');
	    	obj.remove();
	    })
	    //保存
	    $(document).on('click','#img_save',function(){
	    	var img_str = '';
	    	$('#upload_img_wrap .upload_img_success').each(function(){
	    		img_str += $(this).find('img').attr('src') + ',';
	    	})
	    	$('#img_str').val(img_str);
	    	console.log(img_str);
	    })
	})($)
</script>