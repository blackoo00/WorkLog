require.config({
	paths : {
		jquery : 'jquery-1.11.1.min',
		jqueryUI : 'jquery-ui.min',
	},
	urlArgs:"bust=" + (new Date()).getTime(),
});
require(['jquery','window'],function($,w){
	var win = new w.Window();
	$('#a').click(function(){
		win.alert({
			title : '提示',
			content : "welcome!",
			width:300,
			height:150,
			y:50,
			hasCloseBtn : true,
			text4AlertBtn : 'OK',
			dragHandle : ".window_header",
			skinClassName : "window_skin_a",
			hasMask : true,
			handler4AlertBtn : function(){alert('you click the alert button');},
			handler4CloseBtn : function(){alert('you click the close button');},
		}).on("alert",function(){alert("thie second alert handler");
		}).on("close",function(){alert("thie second close handler");});
		
	})
	$('#c').click(function(){
		win.confirm({
			title : '提示',
			content : "welcome!",
			width:300,
			height:150,
			y:50,
			hasCloseBtn : true,
			text4AlertBtn : 'OK',
			dragHandle : ".window_header",
			skinClassName : "window_skin_a",
			hasMask : true,
		}).on("confirm",function(){alert('确定');
		}).on("cancel",function(){alert("取消")});
	})
	$('#p').click(function(){
		win.prompt({
			title : '请输入您的名字',
			content : "我们将会为您保密您输入的信息",
			width:300,
			height:150,
			y:50,
			hasCloseBtn : true,
			text4PromptBtn : '输入',
			text4CancelBtn : '取消',
			defaultValue4PromptInput : '张三',
			dragHandle : ".window_header",
			skinClassName : "window_skin_a",
			hasMask : true,
			handler4PromptBtn : function(inputValue){
				alert("您输入的内容是：" + inputValue);
			},
			handler4CancelBtn : function(){
				alert('取消');
			},
		});
	})
	$('#co').click(function(){
		win.common({
			content : "我是一个通用弹窗",
			width:300,
			height:150,
			y:50,
			hasCloseBtn : true,
		});
	})
});