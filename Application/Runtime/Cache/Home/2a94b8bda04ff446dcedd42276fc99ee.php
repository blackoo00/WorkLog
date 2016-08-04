<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<title>工作日志</title>
	<link rel="stylesheet" href="<?php echo (WORK_LOG); ?>/fonts/style.css">
	<link rel="stylesheet" href="<?php echo (WORK_LOG); ?>/css/index.css">
	<link rel="stylesheet" href="<?php echo (WORK_LOG); ?>/calendar/sign.css">
	<script type="text/javascript" src="<?php echo (WORK_LOG); ?>/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php echo (WORK_LOG); ?>/calendar/calendar.js"></script>
</head>
<body id="worklog-index">
	<div id="loading">
		<canvas id="c"></canvas>
	</div>	
	<!-- 吉祥物 -->
	<!-- <section id="mascot-wrapper">
		<div class="rabbit rabbit-move">
			
		</div>
	</section> -->
	<!-- 浮动窗口 -->
	<script src='<?php echo (WORK_LOG); ?>/js/floats/jquery.gridly.js'></script>
<script src='<?php echo (WORK_LOG); ?>/js/floats/ke.js'></script>
<section id="float-wrap">
	<div class='gridly'>
		<div>
			<span class="extend-box">
				+
			</span>
			<span class="statistical iconfont">
				
			</span>
			<span class="details iconfont">
				
			</span>
			<span class="bug iconfont">
				
			</span>
			<span class="function iconfont">
				
			</span>
		</div>
	</div>
</section>
<section id="details-wrap">
	<input type="hidden" id="project-details-pid">
	<textarea id="o-content" autoHeight="true"></textarea>
</section>
<script>
	$.fn.autoHeight = function(){
		
		function autoHeight(elem){
			elem.style.height = 'auto';
			elem.scrollTop = 0; //防抖动
			elem.style.height = elem.scrollHeight + 'px';
		}
		
		this.each(function(){
			autoHeight(this);
			$(this).on('keyup', function(){
				autoHeight(this);
			});
		});
	 
	}
	var ocontent=$("#o-content");
	ocontent.keydown(function(evt){
		var pid=$("#project-details-pid").val();
		evt = (evt) ? evt : window.event;
		if (evt.keyCode) {
		  if(evt.keyCode == 13){//回车
		  	$.ajax({
		  		url:controller+"/editProjectDescribe",
		  		data:{pid:pid,content:ocontent.val()},
		  		dataType:'json',
		  		success:function(data){
		  			console.log(data);
		  			if(data.status==1){
		  				console.log("1");
		  			}else{
		  				console.log("wrong")
		  			}
		  		}
		  	})
		  }
		}
	})
	// ocontent.on("click",function(){
	// 	$('textarea[autoHeight]').autoHeight();
	// })
</script>
<script>
	// $('textarea[autoHeight]').autoHeight();
</script>
	<div id="wrapper">
		<!-- 日历，新增，搜索，随摘，标题，全部/已完成/未完成 -->
		<header>
			<div id="title">Robin's JobLogs</div>
			<span class="calendar-icon">
				<img src="<?php echo (WORK_LOG); ?>/images/calendar_icon.png">
			</span>
			<span class="write-icon">
				<img src="<?php echo (WORK_LOG); ?>/images/write_icon.png">
			</span>
			<span class="search-icon">
				<img src="<?php echo (WORK_LOG); ?>/images/search_icon.png">
			</span>
			<span class="pick-icon">
				<img src="<?php echo (WORK_LOG); ?>/images/pick_icon.png">
			</span>
			<span class="nums-all nums">
				<?php echo ($data["all"]); ?>
			</span>
			<span class="nums-finished nums">
				<?php echo ($data["finished"]); ?>
			</span>
			<span class="nums-unfinished nums">
				<?php echo ($data["unfinished"]); ?>
			</span>
		</header>
		<!-- 搜索模块，日历列表，随摘模块，日历模块，蒙版，添加日志模块 -->
		<main>
			<div id="search">
				<form id="search-box" action="" method="post">
					<input type="text" id="search-con" placeholder="输入关键词...">
					<i id="search-btn" class="icon-search"></i>
				</form>
			</div>
			<div id="logs-list">	
				<ul id="logs">
					<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li data-id="<?php echo ($list["id"]); ?>" data-pid="<?php echo ($list["pid"]); ?>" data-finish="<?php echo ($list["finished"]); ?>">
							<div class="check-finished <?php if(($list["finished"]) == "0"): ?>unfinished<?php else: ?>finished<?php endif; ?>" data-id="<?php echo ($list["id"]); ?>"></div>
							<input type="text" class="edit-content" contenteditable="true" data-id="<?php echo ($list["id"]); ?>" value="<?php echo ($list["content"]); ?>"/>
							<div class="add-time <?php if(($list["finished"]) == "1"): ?>done<?php endif; ?>">
								<?php if(($list['finished']) == "0"): echo (date("Y-m-d",$list["create_time"])); ?>
									<?php else: ?>
									<?php echo (date("Y-m-d",$list["finish_time"])); endif; ?>
							</div>
							<div class="operation">
								<span class="delete">删除</span>
							</div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>	
			<div>
	随摘
</div>
		</main>
		<!-- 日志模块 BEGIN-->
		<div id="calendar"></div>
		<!-- 日志模块 END-->
		<div id="calendar-mask"></div>
		<div id="add-log">
			<div class="add-log-box">
				<p class="difficulty-nums">
					<span data-nums="1" class="on">狼</span>
					<span data-nums="2">虎</span>
					<span data-nums="3">鬼</span>
					<span data-nums="4">龙</span>
					<span  data-nums="5">神</span>
				</p>
				<p class="add-log-type">
					<span class="on" data-nums="1">功能</span>
					<span data-nums="2">BUG</span>
				</p>
				<p class="add-log-content">
					<textarea><?php echo S('NOW_CLASS_NAME'); ?></textarea>
				</p>
				<p class="add-log-button">
					<button>确认</button>
					<button>取消</button>
				</p>
			</div>
		</div>
		<!-- 项目分类模块 -->
		<footer>
			<div class="footer-move-box"></div>
			<div id="project-box">
				<?php if(is_array($pc)): $i = 0; $__LIST__ = $pc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><span class="project-class" data-id="<?php echo ($list["id"]); ?>"><?php echo ($list["name"]); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</footer>
	</div>
	<!-- 判断有没AJAX在执行 -->
	<input type="hidden" id="ajax-running">
	<script>
		var controller="/work_log/index.php/Home/Index";
		var d = new Date();
		var signList=[{"signYear":d.getFullYear(),"signMonth":d.getMonth()+1,"signDay":d.getDate()}];
		   calUtil.init(signList);
	</script>
	<!-- 根据屏幕宽度变化而变化 -->
	 <script type="text/javascript">
	//     //rem设置
	//     (function(doc, win) {
	//         var docEl = doc.documentElement,
	//             resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
	//             recalc = function() {
	//                 var clientWidth = docEl.clientWidth;
	//                 if (!clientWidth) return;
	//                 docEl.style.fontSize = 20 * (clientWidth / 320) + 'px';
	//                 //宽与高度
	//                 document.body.style.height = clientWidth * (900 / 1440) + "px"
	//             };
	//         win.addEventListener(resizeEvt, recalc, false);
	//         doc.addEventListener('DOMContentLoaded', recalc, false);
	//     })(document, window);
	</script>
	<script src="<?php echo (WORK_LOG); ?>/loading/js/index.js"></script>
	<script src="<?php echo (WORK_LOG); ?>/loading/js/prefixfree.min.js"></script>
	<script type="text/javascript" src="<?php echo (WORK_LOG); ?>/js/require.js" data-main="<?php echo (WORK_LOG); ?>/js/main"></script>
	<script>
		var test_time
		$("#title").click(function(){
			if($(this).hasClass("active")){
				$(this).removeClass("active")
				loading.hide();
				clearInterval(test_time);
			}else{
				$(this).addClass("active")
				loading.show();
				test_time=setInterval(loop, 16);
			}
		})
		// $(document).loading("start");
		// $(document).loading("stop");
	</script>
</body>
</html>