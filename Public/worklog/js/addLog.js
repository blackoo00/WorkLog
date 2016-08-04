define(['jquery','animation'],function($,animation){
	var addbox=$("#add-log");
	var difficulty=$(".difficulty-nums");
	var logType=$(".add-log-type");
	var button=$(".add-log-button");
	var ulwrap=$("#logs");
	var contentbox=$(".add-log-content");
	var an=new animation.Animation({});
	var calendar_mask=$("#calendar-mask");
	var show=$.Deferred();
	function AddLog(){
		this._inite();
		//an.from_small_to_big(addbox);
	}

	AddLog.prototype._inite=function(){
		this._show();/*显示*/
		this._chooseDif();/*选择难度*/
		this._chooseType();/*选择类型*/
		this._button();/*绑定按钮*/
		//添加完成之后回调函数
		// $.when(show).done(function(){
		// 	this._chooseDif();/*选择难度*/
		// 	this._button();/*绑定按钮*/
		// }).fail(function(){
		// 	console.log("完成出错");
		// })
	};

	AddLog.prototype._show=function(){
		addbox.show();
		calendar_mask.show();
		an.from_small_to_big(addbox);
		show.resolve();
	}
	/*选择难度*/
	AddLog.prototype._chooseDif=function(){
		difficulty.find("span").bind("click",function(){
			$(this).addClass("on").siblings().removeClass("on");
		})
	}
	/*选择类型*/
	AddLog.prototype._chooseType = function(){
		logType.find("span").on("click",function(){
			$(this).addClass("on").siblings().removeClass("on");
		})
	}
	/*添加日志*/
	AddLog.prototype._button=function(){
		contentbox.find("textarea").on("input",function(){
			var content=contentbox.find("textarea").val();
			if(content!=""){
				button.find("button:eq(0)").show();
			}else{
				button.find("button:eq(0)").hide();
			}
		})
		button.find("button:eq(0)").one("click",function(){
			var content=contentbox.find("textarea").val();
			var dnums=difficulty.find("span[class*='on']").data("nums");
			var type=logType.find("span[class*='on']").data("nums");
			if(window.confirm("确定添加日志？")&&ajax_running.val()==0&&content!=""){
				ajax_running.val(1);
				$.ajax({
					url:controller+"/addlogs",
					data:{content:content,difficulty:dnums,type:type},
					dataType:'json',
					success:function(data){
						ajax_running.val(0);
						console.log(data);
						if(data.status==1){
							contentbox.find("textarea").val("");
							ulwrap.prepend(data.data);
							project_box.append(data.info);
							ulwrap.promise().done(function(){
								an.from_big_to_small(addbox);
								calendar_mask.hide();
							})
						}else{
							console.log("添加日志出错");
							//log_add_d.reject();
						}
					}
				});
				return false;
			}else{
				an.from_big_to_small(addbox);
				calendar_mask.hide();
			}
		})
		button.find("button:eq(1)").bind("click",function(){
			an.from_big_to_small(addbox);
			calendar_mask.hide();
		})
	}

	return{
		AddLog: AddLog
	};
})