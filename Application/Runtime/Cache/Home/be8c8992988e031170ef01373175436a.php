<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>地址列表</title>
<script type="text/javascript" src="<?php echo (WORK_LOG); ?>/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo COMMON;?>/js/notification.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo (COMMON); ?>/css/notification.css">

<link rel="stylesheet" href="<?php echo (PROJECT); ?>/address2/css/iconfont.css">
<link rel="stylesheet" href="<?php echo (PROJECT); ?>/address2/css/address2.css">

</head>

<body id="scnhtm5">
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<div class="container">
    <div class="head">
    	<input type="hidden" id="shopping" value="<?php echo ($shopping); ?>" />
    	<?php if(!empty($shopping)): ?><a id="submit" href="<?php echo ($shopping); ?>">
    			<div class="head_left">< 支付</div>
    		</a>
    		<?php else: ?>
    		<a href="<?php echo U('Project/index',array('token' => $token, 'wecha_id'=>$wecha_id));?>">
    			<div class="head_left">< 我的</div>
    		</a><?php endif; ?>
        <div class="head_con">收货地址</div>
        <a href="<?php echo U('Project/addAddress',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>">
        	<div class="head_right">添加地址</div>
        </a>
    </div>
    <div class="clear"></div>
    
    <div class="content">
    	<ul class="list">
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li>
	        		<div class="choose_address" data-id="<?php echo ($list["id"]); ?>">
		            	<div class="sh">收货人：<?php echo ($list["name"]); ?><span class="sh1"><?php echo ($list["tele"]); ?></span></div>
		                <div class="dz"><?php echo ($list["address"]); echo ($list["doorplate"]); ?></div>
					</div>
					<div class="bj"><i class="icon2 iconfont icon-yijianfankui" style="font-size:23px; line-height:50px;"></i><a href="<?php echo U('Project/editAddress',array('id'=>$list['id']));?>">编辑</a><i class="icon2 iconfont icon-shanchu"></i><span data-id="<?php echo ($list["id"]); ?>" onclick="delete_add(this)">删除</span></div>
	            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div><!--content-->
    
    <div class="clear"></div>
    <div style="margin-top:55px;"></div>
    
    
    
    
    <div class="clear"></div>
    
    
     
    
    


</div>
</body>
<script>
	var del_id;
	function delete_add(obj){
	    confirm =floatNotify.confirm("确定删除该地址？", "",
	        function(t, n) {
	            if(n==true){
	            	del_id = $(obj).data('id');
	            	console.log(del_id);
	                $.ajax({
	                	url:"<?php echo U('Project/delAddress');?>",
	                	data:{id:del_id},
	                	dataType:'json',
	                	async:false,
	                	success:function(data){
	                		floatNotify.simple(data.info);
	                		if(data.status == 1){
	                			$(obj).parents('.li').remove();
	                		}
	                	}
	                });
	            }
	    	this.hide();
	      }),
	    confirm.show();
	}
	(function($){
		var address=$(".choose_address");
		var shopping = $("#shopping").val();//判断是否在支付
		address.on('click',function(){
			var obj=$(this);
			var id=obj.data("id");
			$.ajax({
				url:"<?php echo U('Project/chooseAdd');?>",
				data:{id:id},
				dataType:"json",
				success:function(data){
                    console.log(data);
					if(shopping){
						//location.href=shopping;
					}else{
						console.log(data);
					}
				}
			});
		})
	})(jQuery);
</script>
</html>