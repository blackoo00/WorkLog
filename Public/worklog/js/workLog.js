define(['jquery','iscroll'],function($,iscroll){

	var log_finished_d=$.Deferred();
	var logs_li=$("#logs li");
	var logs_delete=$(".delete");
	var logs_finish=$(".check-finished");

	function WorkLog(){
		this._inite();
	};
	WorkLog.prototype._inite=function(){
		this._logsIscroll();//日历滑动加载
		this._logsLiTouch();//日志左右滑动
		this._logsDelete();//删除日志
		this._logsEdit();//编辑/更新日志
		this._logsFinish();//点击打钩图标
	};

	/*中间内容JS*/
	//日历滑动加载
	WorkLog.prototype._logsIscroll=function(){
		myIscroll = new iScroll("logs-list",{checkDOMChanges:true,hScrollbar:false, vScrollbar:true,bounce:false,
           onRefresh:function(){
                
           },
           onScrollMove:function(){
                
           },
           onScrollEnd:function(){
                if((this.y-400)<this.maxScrollY){
                    
                }
           },
       });
		myIscroll.refresh();
		document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
	}
	//日志左右滑动
	WorkLog.prototype._logsLiTouch=function(){
		body.on("touchstart","#logs li", function(e) {
		    startX = e.originalEvent.changedTouches[0].pageX,
		    startY = e.originalEvent.changedTouches[0].pageY;
		});
		body.on("touchmove","#logs li", function(e) {
		    moveEndX = e.originalEvent.changedTouches[0].pageX,
		    moveEndY = e.originalEvent.changedTouches[0].pageY,
		    X = moveEndX - startX,
		    Y = moveEndY - startY;
		    //往右滑
		    if ( Math.abs(X) > Math.abs(Y) && X > 0 ) {
		        $(this).stop(true).animate({"margin-left":"0"},200);
		    }
		    //往左滑
		    else if ( Math.abs(X) > Math.abs(Y) && X < 0 ) {
		    	$(this).stop(true).siblings().animate({"margin-left":"0"},200).end().animate({"margin-left":"-9%"},200);
		    }
		});
	};
	//删除日志
	WorkLog.prototype._logsDelete=function(){
		body.on("click",".delete",function(){
			var li=$(this).parents("li");
			li.slideUp().promise().done(function(){
				var id=li.data("id");
				$.ajax({
					url:controller+"/deletelog",
					data:{id:id},
					dataType:"json",
					success:function(data){
						
					}
				});
			});
		})
	};
	//编辑/更新日志
	WorkLog.prototype._logsEdit=function(){
		body.on("blur",".edit-content",function(){
			var con=$(this).val();
			var id=$(this).attr("data-id");
			$.ajax({
				url:controller+"/editlogs",
				data:{con:con,id:id},
				dataType:'json',
				success:function(data){
					console.log(data);
				}
			});
		})
	};
	//点击完成按钮
	WorkLog.prototype._logsFinish=function(){
		body.on("click",".check-finished",function(){
			var obj=$(this);
			var id=obj.attr("data-id");
			var data_obj=$(this).siblings(".add-time");
			if($(this).hasClass("unfinished")&&ajax_running.val()==0){
				ajax_running.val(1);
				loading.show();
				loading_run=setInterval(loop, 16);
				$.ajax({
					url:controller+"/finishLog",
					data:{id:id},
					dataType:'json',
					success:function(data){
						ajax_running.val(0);
						loading.hide();
						clearInterval(loading_run);
						if(data.data==1){
							//操作图标
							obj.removeClass("unfinished").addClass("finished");
							//操作日期
							data_obj.text(data.info).addClass("done");
							//操作顶部完成数量显示
							nums.eq(1).text(parseInt(nums.eq(1).text())+1);

						}else{
							console.log(data);
						}
					}
				});
			}
		})
	};
	/*中间内容JS-END*/

	return{
		WorkLog: WorkLog
	};
})