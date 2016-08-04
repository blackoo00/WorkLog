<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" /><meta charset="utf-8" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<meta content="black" name="apple-mobile-web-app-status-bar-style" />
	<meta name="format-detection" content="telephone=no"/>
	<title>地址编辑1</title>
	<script src="<?php echo COMMON;?>/js/jquery-1.11.1.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="<?php echo (PROJECT); ?>/address/css/iconfont.css">
	<link rel="stylesheet" href="<?php echo (PROJECT); ?>/address/css/address.css">
	<link rel="stylesheet" href="<?php echo (COMMON); ?>/css/notification.css">
	<script src="<?php echo COMMON;?>/js/notification.js" type="text/javascript"></script>
</head>
<body id="scnhtm5">

<div id="add_top">提示填写真实准确的地址哦</div>
<form method="post" action="#" id="FromID">
<?php if(!empty($info['id'])): ?><input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"><?php endif; ?>
<input type="hidden" name="mid" value="<?php echo ($my["id"]); ?>">
<div class="add_all">
     <div class="add_name">收货人姓名</div>
     <div class="add_name1"><input name="name" id="name" value="<?php echo ($info["name"]); ?>" type="text"></div>
</div>
<div class="clear"></div>
<div class="add_all">
     <div class="add_name">联系电话</div>
     <div class="add_name1"><input name="tele" id="tele" value="<?php echo ($info["tele"]); ?>" type="tel"></div>
</div>
<div class="clear"></div>

<div class="add_all">
     <div class="add_name">所在地区</div>
     <div class="add_name1">
     <input type="hidden" name="province" id="province" value="<?php echo ($info["province"]); ?>">
     <select id="provinceno" name="provinceno" style="width: 140px;">
     	<option value="0">--选择地区--</option>
     	<?php if(is_array($location)): $i = 0; $__LIST__ = $location;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i; if(($list['depth']) == "0"): ?><option value="<?php echo ($list["id"]); ?>" <?php if(($info['provinceno']) == $list["id"]): ?>selected<?php endif; ?> ><?php echo ($list["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
  	</select>
  	</div>
</div>
<div class="clear"></div>

<div class="add_all">
     <div class="add_name">所在市</div>
     <div class="add_name1">
     <input type="hidden" name="city" id="city" value="<?php echo ($info["city"]); ?>">
     <select id="cityno" name="cityno" style="width: 140px;">
     	<option value="0">--选择市--</option>
     	<?php if(!empty($info['cityno'])): if(is_array($location)): $i = 0; $__LIST__ = $location;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i; if(($list['pid']) == $info["provinceno"]): ?><option value="<?php echo ($list["id"]); ?>" <?php if(($info['cityno']) == $list["id"]): ?>selected<?php endif; ?>><?php echo ($list["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
  	 </select>
  	 </div>
</div>
<div class="clear"></div>

<div class="add_all">
     <div class="add_name">所在县/区</div>
     <div class="add_name1">
     <input type="hidden" name="county" id="county" value="<?php echo ($info["county"]); ?>">
     <select id="countyno" name="countyno" style="width: 140px;">
     	<option value="0">--选择县/区--</option>
     	<?php if(!empty($info['countyno'])): if(is_array($location)): $i = 0; $__LIST__ = $location;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i; if(($list['pid']) == $info["cityno"]): ?><option value="<?php echo ($list["id"]); ?>" <?php if(($info['countyno']) == $list["id"]): ?>selected<?php endif; ?>><?php echo ($list["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
  	 </select>
  	 </div>
</div>
<script>
	(function($){
		var provinceno=$("#provinceno");
		var cityno=$("#cityno");
		var countyno=$("#countyno");

		var province=$("#province");
		var city=$("#city");
		var county=$("#county");
		provinceno.on("change",function(){
			var pid=$(this).val();
			var name=$(this).find("option:selected").text();
			province.val(name);
			$.ajax({
				url:"<?php echo U('Project/getCityInfo');?>",
				data:{pid:pid},
				dataType:"json",
				success:function(data){
					cityno.html(data.data);
				}
			});
		})
		cityno.on("change",function(){
			var cid=$(this).val();
			var name=$(this).find("option:selected").text();
			city.val(name);
			$.ajax({
				url:"<?php echo U('Project/getCityInfo');?>",
				data:{cid:cid},
				dataType:"json",
				success:function(data){
					countyno.html(data.data);
				}
			});
		})
		countyno.on("change",function(){
			var name=$(this).find("option:selected").text();
			county.val(name);
		})
	})(jQuery)
</script>
<div class="clear"></div>

<div class="add_all">
     <div class="add_name">详细地址</div>
     <div class="add_name1"><input name="address" id="address" value="<?php echo ($info["address"]); ?>" type="text"></div>
</div>
<div class="clear"></div>

<div class="add_all">
     <div class="add_name">邮政编码</div>
     <div class="add_name1"><input name="code" id="code" value="<?php echo ($info["code"]); ?>" type="tel"></div>
</div>
<div class="clear"></div>

<div class="add_all" id="default_add">
	 <input type="hidden" id="choose" name="choose" value="1">
	 <div class="xuanzhong iconfont unchoose <?php if(empty($info)): ?>choose<?php else: if(($info['choose']) == "1"): ?>choose<?php endif; endif; ?>"></div>
     <div class="moren">设为默认地址</div>
</div>
</form>
<div class="clear"></div>

<script>
	(function($){
		var address=$("#default_add");
		var icon=address.find(".xuanzhong")
		var choose=$("#choose");
		address.on("click",function(){
			var condition=icon.hasClass("choose");
			if(condition){
				icon.removeClass("choose");
				choose.val(0);
			}else{
				address.each(function(){
					icon.removeClass("choose");
				})
				icon.addClass("choose");
				choose.val(1);
			}
		})
	})(jQuery);
</script>

<div id="submit" style="margin-bottom: 10px;">保存</div>

<script>
var scale = "<?php echo ($setting['score']); ?>";
// var totalscore = "<?php echo ($info['total_score']); ?>";
$(document).ready(function(){
	var total = parseInt($("#totalmoney").html());
	$("#score").keyup(function(){
		var num = parseInt($(this).val());
		if (isNaN(num)) {
			num = 0;
		}
		// if (num > totalscore) {
		// 	$(this).val(totalscore);
		// 	return floatNotify.simple('您填写的积分超过了您的可用积分');
		// 	return false;
		// }
		var t = total - num/scale;
		if (t <= 0) {
			$(this).val(total * scale);
			t = 0;
		}
		$("#totalmoney").html(t);
	});
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
		/*var patrn = /^(1(([35][0-9])|(47)|(85)|[8][01256789]))\d{8}$/;
		if (!patrn.exec($.trim(userPhone))) {
			return floatNotify.simple('手机号格式错误');
			return false;
		}*/
		/*var classid = $('#classid').val();
		var flag = 0;
		$('#typeSpan select').each(function(){
			if($(this).val()==-1){
				flag = 1;
			}
		});
		if(flag==1){
			return floatNotify.simple('请选择所属地区');
			return false;
		}*/
		var provinceno = $("#provinceno").val();
		if(provinceno == 0){
			return floatNotify.simple('请选择地区');
			return false;
		}
		var cityno = $("#cityno").val();
		if(cityno == 0){
			return floatNotify.simple('请选择市');
			return false;
		}
		var countyno = $("#countyno").val();
		if(countyno == 0){
			return floatNotify.simple('请选择县/区');
			return false;
		}
		console.log(countyno);
		var address = $("#address").val();
		if(address == ""){
			return floatNotify.simple('请输入详细地址');
			return false;
		}
		$("#FromID").submit();
		return false;
	});
});
</script>



</body>
</html>