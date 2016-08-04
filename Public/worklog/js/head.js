define(['jquery','addLog'],function($,addlog){
	var calendar_icon=$(".calendar-icon");/*日历图标*/
	var logs_add=$(".write-icon");/*添加图标*/
	var calendar=$("#calendar");/*日历*/
	var search=$("#search-btn");/*搜索按钮*/
	var searchicon=$(".search-icon");/*搜索按钮*/
	var searchcon=$("#search-con");/*搜索内容*/
	var search_box=$("#search");/*搜索DIV*/
	var pickicon=$(".pick-icon");/*随摘按钮*/
	var pickcon=$("#pick-list");/*随摘内容*/
	function Head(){
		this._inite();
	}
	Head.prototype._inite=function(){
		this._calendarShow();//顶部日历显示/隐藏
		this._logsAdd();//添加日志
		this._changeLog();//三种状态切换
		this._search();//搜索
		this._pick();/*随摘*/
	}
	//顶部日历显示/隐藏
	Head.prototype._calendarShow=function(){
		body.on("touchstart","#calendar", function(e) {
		    // e.preventDefault();
		    startX = e.originalEvent.changedTouches[0].pageX,
		    startY = e.originalEvent.changedTouches[0].pageY;
		});
		body.on("touchmove","#calendar", function(e) {
		    // e.preventDefault();
		    moveEndX = e.originalEvent.changedTouches[0].pageX,
		    moveEndY = e.originalEvent.changedTouches[0].pageY,
		    X = moveEndX - startX,
		    Y = moveEndY - startY;
		    //往下滑
		    // if ( Math.abs(Y) > Math.abs(X) && Y > 0) {
		    // 	calendar_mask.show();
		    //     calendar.stop(true).animate({"top":0},300);
		    // }
		    //往上滑
		    if ( Math.abs(Y) > Math.abs(X) && Y < 0 ) {
		        calendar.stop(true).animate({"top":"-628px"},300,function(){
		        	calendar_mask.hide();
		        });
		    }
		    // else{
		    //     alert("just touch");
		    // }
		});
		calendar_icon.bind("click",function(){
			calendar_mask.show();
			calendar.stop(true).animate({"top":0},300);
		})
		calendar_mask.bind("click",function(){
			calendar.stop(true).animate({"top":"-628px"},300,function(){
				calendar_mask.hide();
			});
		})
	};
	//添加日志
	Head.prototype._logsAdd=function(){
		logs_add.bind("click",function(){
			new addlog.AddLog({});
		})
	};
	//绑定搜索
	Head.prototype._search=function(){
		searchicon.bind("click",function(){
			var h=search_box.height();
			if(h==0){
				search_box.stop(true).animate({"height":"60px"},300);
			}else{
				search_box.stop(true).animate({"height":"0"},300);
			}
		})
		search.bind("click",function(){
			var con=searchcon.val();
			loading.show();
			loading_run=setInterval(loop, 16);
			$.ajax({
				url:controller+"/screeningLog",
				data:{con:con,type:2},
				dataType:'json',
				success:function(data){
					ulwrap.html(data.data);
					ulwrap.promise().done(function(){
						loading.hide();
						clearInterval(loading_run);
						nums.each(function(){
							$(this).removeClass("on");
						})
					});
				}
			});
		})
	}
	//随摘
	Head.prototype._pick=function(){
		pickicon.bind("click",function(){
			if(logsList.is(":visible")){
				logsList.hide();
				pickcon.show();
			}else{
				logsList.show();
				pickcon.hide();
			}
		})
	}
	//三种状态切换
	Head.prototype._changeLog=function(){
		var change_log_d=$.Deferred();
		nums.bind("click",function(){
			loading.show();
			loading_run=setInterval(loop, 16);
			var index=$(".nums").index(this);
			$.ajax({
				url:controller+"/screeningLog",
				data:{index:index,type:1},
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
		Head:Head
	};
})