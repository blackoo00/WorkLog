require.config({
	paths : {
		jquery : 'jquery-1.11.1.min'
	},
	urlArgs:"bust=" + (new Date()).getTime(),
});
require(['jquery','window'],function($,w){
	$('#a').click(function(){
		new w.Window().alert({
			content : "welcome!",
			handler : function(){alert('you click the button');},
			width:300,
			height:150,
			y:50
		});
	})
});