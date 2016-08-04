	function loadingBar(el, opts) {
		this.opts = $.extend({}, loadingBar.DEFAULTS, opts);
		this.$el = $(el);
		this._init();

		if(this.opts.mode == 'click'){
			this.$el.on('click', $.proxy(this._loading, this));//加下划线是该方法只供内部使用
		}
	}
	loadingBar.DEFAULTS = {
		mode: 'click',
		per1: 70,
		per2: 30,
		str:'<div id="progress"><span></span></div>',
		percent : 0,
		progress : '',
		ajax_running : 0,
		url:'',
		speed:3000,
	};

	loadingBar.prototype._init = function(){
		$('body').prepend(this.opts.str);
		this.opts.progress = $('#progress');
		this.opts.progress;
	};

	loadingBar.prototype._loading = function(){//方法都添加到构造方法的原形上
		var obj = this;
		var opts = obj.opts;
		var progress = opts.progress;
		var percent = opts.percent;
		var ajax_running = opts.ajax_running;
		var per1 = opts.per1;
		var per2 = opts.per2;
		var obj = this;
		if(!progress.is(":animated") && percent <= 100 && ajax_running == 0){
			opts.ajax_running = 1;
			this._loadingRunning(per1);
			$.ajax({
				url:opts.url,
				dataType:'json',
				success:function(data){
					obj._loadingRunning(per2,data)
				}
			});
		}
	};

	loadingBar.prototype._loadingRunning = function(length,data){
		var opts = this.opts;
		var progress = opts.progress;
		var ajax_running = opts.ajax_running;
		if(opts.percent <= 100 && ajax_running == 1){
			opts.percent+=length;
			var percent = opts.percent
			progress.animate({width:'+='+length+'%'},opts.speed,function(){
				if(percent >= 100 && !progress.is(":animated")){
					opts.percent = 0;
					opts.ajax_running = 0;
					progress.animate({opacity:0},300,function(){
						opts.progress.width(0).css("opacity",1);
					})
					//启动回调函数
					opts.callback(data);
				}
			});
		}
	};

	$.fn.extend({
		loadingbar: function(opts){
			return this.each(function(){
				new loadingBar(this, opts);
			});
		}
	});
