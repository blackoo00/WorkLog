<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>抓取页面</title>
	<script type="text/javascript" src="<?php echo (WORK_LOG); ?>/js/jquery-1.11.1.min.js"></script>
</head>
<body>
	<textarea id="url"></textarea>
	<button id="get_info">抓取</button>
	<script>
		(function(){
			$('#get_info').on('click',function(){
				var url = $('#url').val();
				$.ajax({
					url:'/work_log/index.php/Home/Project/wxGetInfo',
					data:{url:url},
					type:'post',
					dataType:'json',
					success:function(data){
						console.log(data);
						if(data.status == 1){
							location.href = data.data;
						}
					}
				});
			})
		})(jQuery)
	</script>
</body>
</html>