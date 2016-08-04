<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <title>Document</title>
  <link rel="stylesheet" href="<?php echo COMMON;?>/css/weui.css">
  <link rel="stylesheet" href="<?php echo COMMON;?>/css/notification.css">
</head>
<style>
  #shoplogo{
    position: absolute;
    height: 100%;
    width: 100%;
    left: 0;
    /* right: 15px; */
    top: 10px;
    text-indent: -99px;
     opacity: 0; 
    z-index: 1;
    /*background: red;*/
  }
  #info_edit_wrap{
    position: fixed;
    top: 0;
    left: 100%;
    height: 100%;
    width: 100%;
    background: #fff;
    z-index: 1;
    background-color: rgb(236, 236, 236);
  }
  .info_edit_wrap_title{
    display: -webkit-box;
    -webkit-box-align: center;
    -webkit-box-pack: center;
    background-color: #eee;
    background: #fff;
    /*border-bottom: 1px solid #ececec;*/
    box-shadow: 0px 1px 10px #A5A5A5;
  }
  .info_edit_wrap_title .info_edit_wrap_title_item{
    height: 40px;
    line-height: 40px;
  }
  .info_edit_wrap_title .info_edit_wrap_title_center{
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    -webkit-box-align: center;
    justify-content: center;
  }
  .info_edit_wrap_title .info_edit_wrap_title_left,.info_edit_wrap_title .info_edit_wrap_title_right{
    text-align: center;
    width: 3rem;
  }
  .info_edit_wrap_title_left:before{
  	content: " ";
  	display: inline-block;
  	-webkit-transform: rotate(45deg);
  	transform: rotate(45deg);
  	height: 6px;
  	width: 6px;
  	border-width: 0 0 2px 2px;
  	border-color: #000;
  	border-style: solid;
  	position: relative;
  	top: -2px;
  	top: -1px;
  	margin-left: .3em;
  }
  #img_upload_loading{
  	display: none;
  	position: absolute;
    width: 40px;
    height: 40px;
    right: 32px;
    top: 10px;
    padding: 5px 0 0 5px;
    box-sizing: border-box;
    background-color: rgba(0,0,0,0.5);
    border-radius: 50%;
  }
  #img_upload_loading img{
  	width: 30px;
  	height: 30px;
  }
</style>
<body id="scnhtm5" style="background-color: #ececec;">
	<div class="info_edit_wrap_title">
	    <div class="info_edit_wrap_title_item info_edit_wrap_title_left"></div>
	    <div class="info_edit_wrap_title_item info_edit_wrap_title_center">个人设置</div>
	    <div class="info_edit_wrap_title_item info_edit_wrap_title_right"></div>
    </div>
    <div class="bd">
      <div class="weui_cells weui_cells_access" style="margin-top: 5px;">
      	<a class="weui_cell" href="javascript:;">
      	  <div class="weui_cell_bd weui_cell_primary">
      	    <p class="editinfo_title">头像</p>
      	  </div>
      	  <div class="weui_cell_img">
         	 <img id="headimg" style="width: 40px; height: 40px; border-radius: 50%;" src="<?php echo COMMON;?>/img/touxiang1.jpg">
      	  </div>
      	  <input type="file" name="shoplogo" id="shoplogo">
      	  <div id="img_upload_loading">
      	  	<img src="<?php echo COMMON;?>/img/loading.gif" alt="">
      	  </div>

      	</a>
        <a class="weui_cell editinfo_btn" href="javascript:;">
          <div class="weui_cell_bd weui_cell_primary">
            <p class="editinfo_title">账号昵称</p>
          </div>
          <div class="weui_cell_ft editinfo_con" data-name="name">昵称</div>
        </a>
        <a class="weui_cell editinfo_btn" href="javascript:;">
          <div class="weui_cell_bd weui_cell_primary">
            <p class="editinfo_title">绑定手机号</p>
          </div>
          <div class="weui_cell_ft editinfo_con" data-name="tele">+1865245232888</div>
        </a>

      </div>
    
    </div>
    <!-- 修改页面 -->
    <div id="info_edit_wrap">
      <div class="info_edit_wrap_title">
        <div class="info_edit_wrap_title_item info_edit_wrap_title_left" id="close_info_edit">返回</div>
        <div class="info_edit_wrap_title_item info_edit_wrap_title_center" id="eidt_info_title">2</div>
        <div class="info_edit_wrap_title_item info_edit_wrap_title_right">3</div>
      </div>
      <div class="weui_cells_form" style="padding-top: 10px;">
        <div class="weui_cell">
          <div class="weui_cell_bd weui_cell_primary weui_cell_infoedit" style="box-shadow: 0 0 5px #D6D6D6;">
            <input id="info_edit_item" class="weui_input weui_input_infoedit" type="text" placeholder="输入文本信息" value="2222">
            <span class="weui_infoedit_delete">×</span>
          </div>
        </div>
      </div>

      <div class="weui_cells" style="padding: 0 10px; background-color: rgba(255,255,255,0);">
        <a href="javascript:;" class="weui_btn weui_btn_primary" id="save_info">保存</a>
      </div>
    </div>
    <!-- 修改页面 -->
    <!-- 加载页面 -->
    	<!-- <div id="loading">
    		<div class="weui_mask weui_mask_visible"></div>
    		<div class="weui_dialog weui_dialog_visible">
    			<img src="<?php echo COMMON;?>/img/loading.gif">
    		</div>
    	</div> -->
    <!-- 加载页面 -->
</body>
</html>
<script src="<?php echo COMMON;?>/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo COMMON;?>/js/notification.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo (WORK_LOG); ?>/imgupload/js/ajaxfileupload.js" type="text/javascript"></script>
<!-- input控件操作 -->
<script>
  (function($){
    var edit_input = $('.weui_input_infoedit');
    var delete_btn = $('.weui_infoedit_delete');
    var input_info = edit_input.val();
    //起始判断
    if(input_info){
      delete_btn.css('opacity',1);
    }
    //输入
    edit_input.on('keyup',function(){
      input_info = edit_input.val();
      if(input_info){
        delete_btn.css('opacity',1);
      }else{
        delete_btn.css('opacity',0);
      }
    })
    //删除
    delete_btn.on('click',function(){
      edit_input.val('');
      delete_btn.css('opacity',0);
    })
  })($)
</script>
<!-- input控件操作 -->

<script>
  (function(){
    //修改信息
    var info_edit_item = $("#info_edit_item");//修改信息内容
    var save = $("#save_info");//保存按钮
    var info_edit_wrap = $("#info_edit_wrap");//修改框
    var close_info_edit = $('#close_info_edit');//关闭修改弹出框
    var edit_btn = $(".editinfo_btn");//需要修改的按钮
    var name,data,info_item,title;
    var title_item = $('#eidt_info_title');
    //弹出编辑框
    edit_btn.on("click",function(){
      info_item = $(this).find('.editinfo_con');
      name = info_item.data('name');
      data = info_item.text();
      title = $(this).find('.editinfo_title').text();
      title_item.text(title);
      info_edit_item.val(data);
      info_edit_wrap.animate({'left':0},300);
    })
    //关闭编辑框
    close_info_edit.bind('click',function(){
      info_edit_wrap.animate({'left':'100%'},300);
      $('.weui_infoedit_delete').css('opacity',1);
    })
    //保存信息按钮
    save.on("click",function(){
      var new_info = info_edit_item.val();
      if(new_info){
        info_item.text(new_info);
        close_info_edit.click();
        // $.ajax({
        //   data:{name:name,info:new_info},
        //   type:'post',
        //   dataType:'json',
        //   success:function(data){
        //     console.log(data);
        //     info_item.text(new_info);
        //     close_info_edit.click();
        //   }
        // })
      	floatNotify.simple('修改成功');
      }else{
      	floatNotify.simple('内容不能为空');
        return false;
      }
    })
    //修改店铺头像
    $(document).on('change',"#shoplogo",function(){
      var loading=$("#img_upload_loading");
      loading.show();
      $.ajaxFileUpload ({
		 url: "<?php echo U('Project/headpic');?>",
		 type: 'post',
		 secureuri:false,
		 fileElementId:'shoplogo',
		 dataType: 'json',
         success: function (data){
         	console.log(data);
          loading.hide();
          if(data.status==1){
            $("#headimg").attr("src",data.data);
          }else if(data.status==2){
            floatNotify.simple("上传失败，只支持JPG图片");
            return;
          }else if(data.status==3){
            floatNotify.simple("只能三天更新一次!");
            return;
          }
         }
      })
      return false;
    })
  })($)
</script>