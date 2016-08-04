require.config({
	paths : {
		jquery : 'jquery-1.11.1.min',
		jqueryUI : 'http://code.jquery.com/ui/1.12.0/jquery-ui.min',
	},
	// urlArgs:"bust=" + (new Date()).getTime(),
});
require(['jquery','window'],function($,w){
	$('#a').click(function(){
		new w.Window().alert({
			title : '提示',
			content : "welcome!",
			handler4AlertBtn : function(){alert('you click the alert button');},
			width:300,
			height:150,
			y:50,
			hasCloseBtn : true,
			text4AlertBtn : 'OK',
			dragHandle : ".window_header",
			handler4CloseBtn : function(){alert('you click the close button');},
			skinClassName : "window_skin_a",
			hasMask : true,
		});
	})
});