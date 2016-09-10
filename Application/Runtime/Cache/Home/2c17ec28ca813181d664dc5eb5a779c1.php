<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>React版工作日志</title>
	<link rel="stylesheet" href="<?php echo (WORK_LOG); ?>/fonts/style.css">
	<link rel="stylesheet" href="<?php echo (WORK_LOG); ?>/css/reactindex.css">
	<link rel="stylesheet" href="<?php echo (WORK_LOG); ?>/calendar/sign.css">
	<script type="text/javascript" src="<?php echo (WORK_LOG); ?>/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php echo (WORK_LOG); ?>/calendar/calendar.js"></script>
</head>
<body id="worklog-index">
		<div id="calendar"></div>
		<div id="calendar-mask"></div>
		<script>
			var controller="/work_log/index.php/Home/WorkLog";
			var d = new Date();
			var signList=[{"signYear":d.getFullYear(),"signMonth":d.getMonth()+1,"signDay":d.getDate()}];
			   calUtil.init(signList);
		</script>
	<style>
	.log_add_wrap{
		position: fixed;
	    top: 0;
	    width: 100%;
	    height: 100%;
	    z-index: 2;
	}
	.log_add_wrap-enter {
		top: -100%;
	    transition: top .5s;
	}

	.log_add_wrap-enter.log_add_wrap-enter-active {
		top: 0;
	}
	.log_add_wrap-leave {
		top: 0;
	    transition: top .5s;
	}

	.log_add_wrap-enter.log_add_wrap-leave-active {
		top: -100%;
	}
	.student {
	    float: left;
	    margin: 20px;
	  }
	  .student-enter {
	    opacity: .2;
	    transition: opacity 1s;
	  }
	  .student-enter-active {
	    opacity: 1;
	  }
	  .student-leave {
	    transform: scale(1);
	    opacity: 1;
	    transition: all .5s ease-in;
	  }
	  .student-leave-active {
	    transform: scale(5);
	    opacity: 0;
	  }
	</style>
	<div id="wrapper"></div>
</body>
</html>
<script src="<?php echo (REACT_URL); ?>"></script>