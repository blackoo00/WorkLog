requirejs.config({
	paths:{
		"jquery":'jquery-1.11.1.min',
		"velocity": "velocity.min",
        "velocity-ui": "velocity.ui.min",
        "carousel":'picks/carousel',
	},
	shim: {
        "velocity": {
            deps: [ "jquery" ]
        },
        "velocity-ui": {
            deps: [ "velocity" ]
        }
    },
	urlArgs:"bust=" + (new Date()).getTime(),
});
var body=$("body");
var calendar_mask=$("#calendar-mask");/*灰色背景*/
var loading=$("#loading");/*加载*/
var loading_run;
var ulwrap=$("#logs");/*日志列表*/
var ajax_running=$("#ajax-running");/*判断当前AJAX是否正在运行*/
var nums=$(".nums");/*三种状态切换*/
var project_box=$("#project-box");/*底部项目*/
var animationEnd = "animationend webkitAnimationEnd";/*判断动画结束*/
var logsList=$("#logs-list");
requirejs(['jquery','workLog','head','foot','carousel'],function($,workLog,head,foot){
    
	this.head = new head.Head({
		
	});
	this.worklog = new workLog.WorkLog({
		
	});
	this.foot = new foot.Foot({
		
	});

	//3d旋转节点
    var $carousel = $("#carousel");

    //旋转木马对象
    var carousel = new Carousel($carousel, {
        imgUrls: [
            "http://img.mukewang.com/5662e29a0001905a14410901.png",
            "http://img.mukewang.com/5662e2960001f16314410901.png",
            "http://img.mukewang.com/5662e26f00010dea14410901.png"
        ],
        videoUrls: [
            "http://www.imooc.com/upload/media/qx-one.mp4",
            "http://www.imooc.com/upload/media/qx-two.mp4",
            "http://www.imooc.com/upload/media/qx-three.mp4"
        ]
    });

    var i = 0;
	$("#carousel-show").on("click", function() {
	    carousel.run(i++, function() {
	        //播放视频
	        carousel.palyVideo()
	    })
	})
});