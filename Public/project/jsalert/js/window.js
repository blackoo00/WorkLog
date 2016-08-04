define(['jquery','jqueryUI'],function($,$UI){
	function Window(){
		this.cfg = {
			width : 500,
			height : 300,
			title : '系统消息',
			content : "",
			hasCloseBtn : false,//是否有关闭按钮
			hasMask : true,//添加遮罩默认值
			isDraggable : true,//是否可拖动
			dragHandle : null,//拖动把手
			skinClassName : null,//定制皮肤
			text4AlerBtn : "确定",//按钮文案
			handler4AlertBtn : null,//确定回调函数
			handler4CloseBtn : null,//关闭回调函数
		}
	}

	Window.prototype = {
		alert : function(cfg){
			var CFG = $.extend(this.cfg,cfg);

			var boundingBox = $('<div class="window_boundingBox">'+
				'<div class="window_header">'+CFG.title+'</div>'+
				'<div class="window_body">' +CFG.content+'</div>'+
				'<div class="window_footer"><input class="window_alertBtn" type="button" value="'+CFG.text4AlerBtn+'"></div>'
				+'</div>');
			boundingBox.appendTo('body');
			//遮罩层
			mask = null;
			if(CFG.hasMask){
				mask = $('<div class="window_mask"></div>');
				mask.appendTo('body');
			}
			//确定按钮
			var btn = boundingBox.find('.window_alertBtn');
			btn.click(function(){
				CFG.handler4AlertBtn && CFG.handler4AlertBtn();
				boundingBox.remove();
				mask && mask.remove();
			});
			//样式
			boundingBox.css({
				width : this.cfg.width + "px",
				height : this.cfg.height + "px",
				left : (this.cfg.x || (window.innerWidth - this.cfg.width) / 2) + "px",
				top : (this.cfg.x || (window.innerHeight - this.cfg.height) / 2) + "px",
			});
			//关闭按钮
			if(CFG.hasCloseBtn){
				var closeBtn = $('<span class="window_closeBtn">×</span>');
				closeBtn.appendTo(boundingBox);
				closeBtn.click(function() {
					CFG.handler4CloseBtn && CFG.handler4CloseBtn();
					boundingBox.remove();
					mask && mask.remove();
				});
			}
			//定制皮肤
			if(CFG.skinClassName){
				boundingBox.addClass(CFG.skinClassName);
			}
			//拖动
			if(CFG.isDraggable){
				if(CFG.dragHandle){
					boundingBox.draggable({handle:CFG.dragHandle});
				}else{
					boundingBox.draggable();
				}
			}
		},
		confirm : function(){

		},
		prompt : function(){

		}
	}

	return {
		Window : Window
	}
});