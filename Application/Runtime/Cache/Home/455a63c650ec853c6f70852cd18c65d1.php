<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="<?php echo (WORK_LOG); ?>/js/jquery-1.11.1.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div id="test"></div>
</body>
</html>
<script>
    (function($){
        $('#test').load("<?php echo U('Project/test2');?> #content",function(){
            $(document).on('click','#content',function(){
                console.log('aa');
            })
        });
    })($)
</script>