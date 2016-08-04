<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($metaTitle); ?></title>
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
      <a href="<?php echo U('Project/Address',array('token' => $token, 'wecha_id'=>$wecha_id));?>">
        <div class="head_left">< 收货地址</div>
      </a>
        <div class="head_con">添加地址</div>
        <div class="head_right" id="submit">完成</div>
    </div>
    <div class="clear"></div>
    
    <div class="content">
      <ul class="text">
          <form action="#" method="post" id="FromID">
          <?php if(!empty($info['id'])): ?><input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"><?php endif; ?>
          <input type="hidden" name="mid" value="<?php echo ($my["id"]); ?>">
          <li>收货人<input name="name" type="text" id="name" class="zi" value="<?php echo ($info["name"]); ?>" placeholder="请输入收货人姓名"/></li>
            <li>手机号<input name="tele" id="tele" type="tel" class="zi" value="<?php echo ($info["tele"]); ?>" placeholder="请输入手机号码"/></li>
            <li>配送至<input name="address" id="address" type="text" class="zi" value="<?php echo ($info["address"]); ?>" placeholder="请选择附近的建筑，学校等"/></li>
            <li>门牌号<input name="doorplate" id="<?php echo ($info["doorplate"]); ?>" type="text" class="zi" value="<?php echo ($info["doorplate"]); ?>" placeholder="请输入详细地址：如楼栋门牌号等"/></li>
            <!-- <li>
            	选择区域
            	<select name="aid" id="aid" style="    width: 150px;
    border: 1px solid #ddd;
    height: 26px;
    font-size: 13px;">
            		<?php if(is_array($area)): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><option value="<?php echo ($list["id"]); ?>" <?php if(($info["aid"]) == $list["id"]): ?>selected<?php endif; if(($list['id'] == 4) AND ($info == null)): ?>selected<?php endif; ?> ><?php echo ($list["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            	</select>
            </li> -->
            </form>
        </ul>

    </div><!--content-->
    
    <div class="clear"></div>
    <div style="margin-top:55px;"></div>
    
    
    
</div>
</body>
<script>
$(document).ready(function(){
	$("#submit").click(function(){
		var userName=$('#name').val();
		if($.trim(userName) == ""){
			return floatNotify.simple('请填写姓名');
			return false;
		}
		var userPhone = $("#tele").val()
		if ($.trim(userPhone) == "") {
			return floatNotify.simple('请填写您的手机号码');
			return false;
		}
		if (userPhone.length != 11) {
			return floatNotify.simple('请填写11位手机号码');
			return false;
		}
		var address = $("#address").val();
		if(address == ""){
			return floatNotify.simple('请输入详细地址');
			return false;
		}
		var doorplate = $("#doorplate").val();
		if(doorplate == ""){
			return floatNotify.simple('请输入门牌号');
			return false;
		}
		$("#FromID").submit();
		return false;
	});
});
</script>



</body>
</html>