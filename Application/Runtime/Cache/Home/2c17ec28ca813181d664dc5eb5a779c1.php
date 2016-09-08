<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>React版工作日志</title>
	<link rel="stylesheet" href="<?php echo (WORK_LOG); ?>/fonts/style.css">
	<link rel="stylesheet" href="<?php echo (WORK_LOG); ?>/css/reactindex.css"></head>
<body id="worklog-index">
	<style>
	.example{
		position: fixed;
	    background-color: rgba(0, 0, 0, 0.5);
	    top: 0;
	    width: 100%;
	    height: 100%;
	    z-index: 2;
	}
	.example-enter {
		top: -100%;
	    transition: top .5s;
	}

	.example-enter.example-enter-active {
		top: 0;
	}
	.example-leave {
		top: 0;
	    transition: top .5s;
	}

	.example-enter.example-leave-active {
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