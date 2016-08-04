define(['jquery'],function($){
	var footer_move_box=$(".footer-move-box");
	var dfd = $.Deferred();
	function Foot(){
		this._inite();
	};
	Foot.prototype._inite=function(){
		this._footerIn();//底部项目滑入
		this._footerOut();//底部项目滑出
		this._bindProjectClick();//绑定项目点击事件
	}
	//底部项目滑入
	Foot.prototype._footerIn=function(){
		body.on("touchstart","footer .footer-move-box", function(e) {
		    startX = e.originalEvent.changedTouches[0].pageX,
		    startY = e.originalEvent.changedTouches[0].pageY;
		});
		body.on("touchmove","footer .footer-move-box", function(e) {
		    moveEndX = e.originalEvent.changedTouches[0].pageX,
		    moveEndY = e.originalEvent.changedTouches[0].pageY,
		    X = moveEndX - startX,
		    Y = moveEndY - startY;
		    //往上滑
		    if ( Math.abs(Y) > Math.abs(X) && Y < 0 ) {
		        project_box.stop(true).animate({"height":"10rem"},300,function(){
		        	footer_move_box.hide();
		        });
		    }
		});
	};
	//底部项目滑出
	Foot.prototype._footerOut=function(){
		body.on("touchstart","footer #project-box", function(e) {
		    startX = e.originalEvent.changedTouches[0].pageX,
		    startY = e.originalEvent.changedTouches[0].pageY;
		});
		body.on("touchmove","footer #project-box", function(e) {
		    moveEndX = e.originalEvent.changedTouches[0].pageX,
		    moveEndY = e.originalEvent.changedTouches[0].pageY,
		    X = moveEndX - startX,
		    Y = moveEndY - startY;
		    //往下滑
		    if ( Math.abs(Y) > Math.abs(X) && Y > 0 ) {
		        project_box.stop(true).animate({"height":"0"},300);
		        footer_move_box.show();
		    }
		});
	};
	//绑定项目点击事件
	Foot.prototype._bindProjectClick=function(){
		$(document).on("click",".project-class",function(){
			var pid=$(this).data("id");
			loading.show();
			loading_run=setInterval(loop, 16);
			$.ajax({
				url:controller+"/screeningLog",
				data:{pid:pid,type:3},
				dataType:'json',
				success:function(data){
					ulwrap.html(data.data);
					ulwrap.promise().done(function(){
						loading.hide();
						clearInterval(loading_run);
					});

				}
			})
		})
	}
	return{
		Foot:Foot
	};
})