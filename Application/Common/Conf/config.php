<?php
return array(
	'DB_TYPE'               =>  'mysql',     // 数据库类型
	'DB_HOST'               =>  'localhost', // 服务器地址
	'DB_NAME'               =>  'work',          // 数据库名
	'DB_USER'               =>  'root',      // 用户名
	'DB_PWD'                =>  'root',          // 密码
	'DB_PORT'               =>  '',        // 端口
	'DB_PREFIX'             =>  'w_',    // 数据库表前缀
	'DB_PARAMS'          	=>  array(), // 数据库连接参数
	'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志

	'TMPL_L_DELIM'   		=>'{work=',			//模板引擎普通标签开始标记
	'TMPL_R_DELIM'			=>'}',				//模板引擎普通标签结束标记
	'URL_HTML_SUFFIX'       =>  'html',  // URL伪静态后缀设置
	'URL_MODEL'             =>  0,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
);