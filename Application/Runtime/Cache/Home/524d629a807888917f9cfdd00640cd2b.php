<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" /><meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<title>地址列表1</title>
	<script type="text/javascript" src="<?php echo (WORK_LOG); ?>/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo COMMON;?>/js/notification.js" type="text/javascript"></script>
	<link rel="stylesheet" href="<?php echo (PROJECT); ?>/address/css/iconfont.css">
	<link rel="stylesheet" href="<?php echo (PROJECT); ?>/address/css/address.css">
	<link rel="stylesheet" href="<?php echo (COMMON); ?>/css/notification.css">
</head>
<body id="scnhtm5">
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="address">
		     <div class="address_all">
		         <div class="address_name"><?php echo ($list["name"]); ?></div>
		         <div class="address_phone"><?php echo ($list["tele"]); ?></div>
		         <div class="clear"></div>
		         <div class="address_dizhi"><?php echo ($list["province"]); echo ($list["city"]); echo ($list["county"]); echo ($list["address"]); ?></div>
		     </div>
		     <div class="line"></div>
		     <div class="xuanzhong iconfont unchoose <?php if(($list['choose']) == "1"): ?>choose<?php endif; ?>" data-id="<?php echo ($list["id"]); ?>"></div>
		     <div class="wrap">
			        <div class="box-163css iconfont">
			        	  <span class="update iconfont" data-id="<?php echo ($list["id"]); ?>" onclick="delete_add(this)">&#xe601;</span>
		 	              <!-- <input type="button" value="<?php echo ($list["id"]); ?>" onclick="del(this)"> -->
		            </div>
		    </div>
		    <a href="<?php echo U('Project/editAddress',array('id'=>$list['id']));?>">
		     	<div class="update iconfont">&#xe600;</div>
		    </a>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	<?php if(!empty($shopping)): ?><a id="submit" style="display: block;background-color: #56B72B;" href="<?php echo ($shopping); ?>">继续支付</a><?php endif; ?>
	<a href="<?php echo U('Project/addAddress');?>">
		<div id="submit">新增新地址</div>
	</a>
<script>
	var del_id;
	function delete_add(obj){
	    confirm =floatNotify.confirm("确定删除该地址？", "",
	        function(t, n) {
	            if(n==true){
	                $.ajax({
	                	url:"<?php echo U('Project/delAddress');?>",
	                	data:{id:del_id},
	                	dataType:'json',
	                	async:false,
	                	success:function(data){
	                		floatNotify.simple(data.info);
	                		if(data.status == 1){
	                			$(obj).parents('.address').remove();
	                		}
	                	}
	                });
	            }
	    	this.hide();
	      }),
	    confirm.show();
	}
	(function($){
		var address=$(".address");
		address.on('click',".xuanzhong,.address_all",function(){
			var obj=$(this).parents(".address").find(".xuanzhong");
			var id=obj.data("id");
			$.ajax({
				url:"<?php echo U('Project/chooseAdd');?>",
				data:{id:id},
				dataType:"json",
				success:function(data){
					console.log(data);
					address.each(function(){
						$(this).find(".xuanzhong").removeClass("choose");
					})
					obj.addClass("choose");
				}
			});
		})
		// $(".xuanzhong").on("click",function(){
		// 	var obj=$(this);
		// 	var id=obj.data("id");
		// 	$.ajax({
		// 		url:"<?php echo U('Project/chooseAdd',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>",
		// 		data:{id:id},
		// 		dataType:"json",
		// 		success:function(data){
		// 			console.log(data);
		// 			address.each(function(){
		// 				$(this).find(".xuanzhong").removeClass("choose");
		// 			})
		// 			obj.addClass("choose");
		// 		}
		// 	});
		// })
	})(jQuery);
</script>
</body>
</html>