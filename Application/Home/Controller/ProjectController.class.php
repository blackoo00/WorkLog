<?php 
	namespace Home\Controller;
	use Think\Controller;
	use Org\Util\UploadFile;
	use Think\Storage\Driver\File;
	class ProjectController extends Controller{
		public $my;
		public function __construct(){
			parent::__construct();
			$this->my = array(
				'id' => 1,
			);
			$this->assign('my',$this->my);
		}
		//目录页面
		public function index(){
			$this->display();
		}
		//抽奖页面
		public function lucky(){
			$luckylist=session("luckylist");
			$luckysort=session("luckysort");
			$myIntegral=10000;
			if(IS_POST){
				//判断余额
				if($myIntegral<100){
					$this->ajaxReturn($myIntegral,"",2);
				}
				//设置抽奖
				$p=M("integral_products")->where(array("nums"=>array("gt",0)))->order("prob")->select();
				foreach ($p as $k => $v) {
					if($v['prob']>=1){
						$l=mt_rand(1,100);
						if($l<=$v['prob']){
							foreach ($luckylist as $k2 => $v2) {
								if($v2['id']==$p[$k]['id']){
									$luck=$v2['sort'];
								}
							}
							// $luck=$p[$k]['sort'];
							$info=$p[$k]['name'];
							$id=$p[$k]['id'];
							break;
						}else{
							$luck=$luckysort[array_rand($luckysort)];
							$info="谢谢惠顾";
							$id=0;
						}
					}else{
						$l=mt_rand(1,1/$v['prob']*100);
						if($l==1){
							foreach ($luckylist as $k2 => $v2) {
								if($v2['id']==$p[$k]['id']){
									$luck=$v2['sort'];
								}
							}
							//$luck=$p[$k]['sort'];
							$info=$p[$k]['name'];
							$id=$p[$k]['id'];
							break;
						}else{
							$luck=$luckysort[array_rand($luckysort)];
							$info="谢谢惠顾";
							$id=0;
						}
					}
				}

				
				$product=M("integral_products")->where("id=".$id)->find();
				if($product){
					//中奖操作
				}
				$this->ajaxReturn($luck,$info,1);
			}else{
				$luckylist=M("integral_products")->where(array("nums"=>array("gt",0)))->select();//抽奖商品
				for ($i=0; $i < 12; $i++) { 
					if(!$luckylist[$i]){
						$luckylist[$i]['logo']=WORK_LOG."/lucky/images/jp8.png";
					}
				}
				shuffle($luckylist);

				foreach ($luckylist as $k => $v) {
					$luckylist[$k]['sort']=$k+1;
				}
				$luckysort=array();
				foreach ($luckylist as $k => $v) {
					if($v['logo']==WORK_LOG."/lucky/images/jp8.png"){
						array_push($luckysort, $v['sort']);
					}
				}
				session("luckysort",$luckysort);

				session("luckylist",$luckylist);
				$this->assign("list",$luckylist);
				$this->display();
			}
		}
		//签到每日一分 连续7天两分
		//签到页面
		public function sign(){
			$signlist=M("integral_sign")->where("mid=1")->select();
			$str="[";
			foreach ($signlist as $k => $v) {
				$str.="{signYear:".$v['year'].","."signMonth:".$v['month'].","."signDay:".$v['day']."},";
			}
			$str.="]";
			//总积分
			$signIn=M("integral_sign")->where("mid=1")->sum("integral");
			//连续签到天数
			$this->assign("daysnums",$this->getSignDays(strtotime("today")));
			$this->assign("sign",$str);
			$this->assign("signIn",$signIn);
			$this->assign("all",count($signlist));
			$this->display();
		}
		//获得连续签到天数
		public function getSignDays($time,$days){
			$t1=$time-86400;
			$t2=$time;
			$condition=array(
				'mid'=>1,
				'addtime'=>array(array('gt',$t1),array('lt',$t2)),
			);
			$sign=M("integral_sign")->where($condition)->find();
			if($sign){
				$days++;
				$nums=$this->getSignDays($time-86400,$days);
			}else{
				//判断今天有没签
				$t1=strtotime("today");
				$t2=strtotime("today")+86400;
				$map=array(
					'mid'=>1,
					'addtime'=>array(array('gt',$t1),array('lt',$t2)),
				);
				$sign=M("integral_sign")->where($map)->find();
				if($sign){
					$days++;
				}
				return $days;
			}
			return $nums;
		}

		//签到功能(AJAX)
		public function memberSign(){
			$t1=strtotime("today");
			$t2=strtotime("today")+86400;
			$condition=array(
				'mid'=>1,
				'addtime'=>array(array('gt',$t1),array('lt',$t2)),
			);
			if(IS_POST){//签到功能
				$st1=strtotime("today")-86400*6;
				$st2=strtotime("today");
				$where=array(
					'mid'=>1,
					'addtime'=>array(array('gt',$st1),array('lt',$st2)),
				);
				if(!M("integral_sign")->where($condition)->find()){
					//判断是否连续签到7天
					if(M("integral_sign")->where($where)->count()==6){//连续签到7天
						$integral=2;
					}else{
						$integral=1;
					}
					$data=array(
						'mid'=>1,
						'integral'=>$integral,
						'addtime'=>time(),
						'year'=>date("Y",time()),
						'month'=>date("m",time()),
						'day'=>date("d",time()),
					);
					M("integral_sign")->add($data);
					//总签到获得积分
					$signIn=M("integral_sign")->where("mid=1")->sum("integral");
					//连续签到天数
					$daysnums=$this->getSignDays(strtotime("today"));
					//积分记录表
					$this->ajaxReturn($daysnums,$signIn,1);//签到成功
				}else{//今天已经签到过
					$this->ajaxReturn("","",2);
				}
			}else{//判断今天有没签到(设定签到按钮是否能按)
				if(M("integral_sign")->where($condition)->find()){
					$this->ajaxReturn("","",1);
				}else{
					$this->ajaxReturn("","",2);
				}
			}
		}

		//AJAX上传图片(页面)
		public function ajaxImgUpload(){
			$this->display();
		}
		//AJAX上传图片(功能)
		public function headpic(){
			$config = array(
					'savePath'      =>  'uploads/member/', //保存路径
					'thumb'             =>  true,
					'thumbMaxWidth'     =>  '400',// 缩略图最大宽度
					'thumbMaxHeight'    =>  '400',// 缩略图最大高度
					'thumbPath'         =>  'uploads/member/',// 缩略图保存路径
					'thumbRemoveOrigin' =>  true,// 是否移除原图
			);
			//上传图片
			$upload=new UploadFile($config);
			$z=$upload->uploadOne($_FILES['shoplogo']);
			if($z){
				//$pic=$z['0']['savepath'].$time.".jpg";
				$pic="http://127.0.0.1/work_log/".$z['0']['savepath']."thumb_".$z['0']['savename'];
				// $data['pic']=$pic;
				// $db=D('Doctor');
				// $id=$db->where('id='.$_POST['id'])->save($data);
				// if($id){
				// 	echo json_encode($pic);
				// }
				//echo json_encode($pic);
				$this->ajaxReturn($pic,"",1);
			}else{
				$this->ajaxReturn("","",2);
			}
		}
	
		//抓取微信新闻
		public function wxGetInfo(){
				if(IS_POST){
					$dir = "ucrldata/".time();
					$url = $_POST['url'];
			    	//$url = 'http://mp.weixin.qq.com/s?src=3&timestamp=1465700056&ver=1&signature=tR-YYCIgmqNR6HoIPFfWOFhtqBcK*hAoQpFsB3NtQx7SqxTUC3bE3iczoLtWyG6YJL1uJUuEEqEh51mchyVs4gnc5QPkcxIciYou*C2eAoMTQZIExj39zAftjTYJ4bLaJiUOoR-POTPSLKhT0u3CRtktpbtdB0iaHqu8FLnPRNA=';

				    $contents = file_get_contents($url);
				    $contents = '<link rel="stylesheet" type="text/css" href="http://res.wx.qq.com/mmbizwap/zh_CN/htmledition/style/page/appmsg/page_mp_article_improve2d1390.css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">'.$contents;
				    $contents .="<script type='text/javascript' src='".WORK_LOG."/js/jquery-1.11.1.min.js'></script>";
				    $contents .="<script type='text/javascript' src='".WORK_PUBLIC."/wxGetInfo/iframe.js'></script>";
				    $contents .="<style>iframe body{margin:0;}</style>";
				    $contents .="<script type='text/javascript'>
				    	$('.video_iframe').each(function(){
				    		$(this).attr('src',$(this).data('src'));
				    	})
				    	$('#sg_readNum3').text(888);
				    	$('#sg_likeNum3').text(888);
				    	$('.media_tool_meta i').css('top','10px');
				    	$('.rich_media_area_extra').hide();
				    	$('img').each(function(){
				    	if($(this).data('src')){
				    		$(this).wrap('<label></label>')
				    		$(this).parents('label').html(showImg($(this).data('src'),$(this).attr('style'),$(this).data('w')));
				    	}})</script>";
				    //echo $contents;
			    	// header('Content-type: image/jpg');
			    	$filename = $dir.'/text.html';
			    	File::put($filename,$contents);
			    	$filename = 'http://127.0.0.1/work_log/'.$dir.'/text.html';
			    	$this->ajaxReturn($filename,'',1);
			    	// $img ="<img src=".$content."/>";
			    	//echo $content;
				}else{
					$this->display();
				}
		}
		//顶部异步加载动作条
		public function loadingBar(){
			$this->display();
		}
		public function loadingBarAjax(){
			$test=1;
			$this->ajaxReturn('','',1);
		}
		//顶部加载动作条2
		public function nprogress(){
			$this->display();
		}
		//地址模板1
		public function Address(){
			$style = $_GET['style']?$_GET['style']:S('addressStyle');
			$db=M("address_list");
			$condition = array(
				'mid' => $this->my['id'],
			);
			$list=$db->where($condition)->select();
			if($list){
				$this->assign("list",$list);
				$this->assign("shopping",session("quick_buy_address_url"));//订单页面，方便返回付款
				S('addressStyle',$style);
				switch ($style) {
					case '1':
						$this->display('Address1');
						break;
					
					case '2':
						$this->display('Address2');
						break;
				}
			}else{
				$this->addAddress();
			}
		}
		//添加地址
		public function addAddress(){
			//城市区域
			$location=M("class_city")->where(array('depth'=>array("lt",3)))->select();
			$this->assign("location",$location);
			$db = M("address_list");
			if(IS_POST){
				if ($db->create() === false) {
				    $this->error($db->getError());
				} else {
				    $id = $db->add();
				    if ($id == true) {
				    	if($_POST['choose']==1){
				    		$map['mid']=$this->my['id'];
				    		$map['id']=array("neq",$id);
				    		$map['choose']=1;
				    		$db->where($map)->setField("choose",0);
				    	}
				        $this->success('操作成功', U("Project/Address",array('style'=>1)));
				    } else {
				        $this->error('操作失败', U("Project/Address",array('style'=>1)));
				    }
				}
			}else{
				$this->assign("metaTitle","我的地址");
				switch (S('addressStyle')) {
					case '1':
						$this->display("addDetails1");
						break;
					case '2':
						$this->display("addDetails2");
						break;
				}
			}
		}
		public function test(){
			$this->display();
		}
		public function test2(){
			$this->display();
		}
		//编辑地址
		public function editAddress(){
			$db = M("address_list");
			$location=M("class_city")->where(array('depth'=>array("lt",3)))->select();
			$this->assign("location",$location);
			if(IS_POST){
				if ($db->create() === false) {
				    $this->error($db->getError());
				} else {
				    $id = $db->save();
				    if ($id == true) {
				    	if($_POST['choose']==1){
				    		$map['mid']=$this->my['id'];
				    		$map['id']=array("neq",$_POST['id']);
				    		$map['choose']=1;
				    		$db->where($map)->setField("choose",0);
				    	}
				        $this->success('操作成功', U("Project/Address",array('style'=>1)));
				    } else {
				        $this->error('操作失败', U("Project/Address",array('style'=>1)));
				    }
				}
			}else{
				$id=$_GET["id"];
				$info=$db->where("id=".$id)->find();
				$this->assign("info",$info);
				$this->display("addDetails1");
			}
		}
		//删除地址
		public function delAddress(){
			$id = $_GET["id"];
			$db = M("address_list");
			$result = $db->where(array("mid"=>$this->my['id'],'id'=>$id))->delete();
			if($result){
				$this->ajaxReturn('','操作成功',1);
			}else{
				$this->ajaxReturn('','操作失败',0);
			}
		}
		//选择默认地址(AJAX)
		public function chooseAdd(){
			$id=$_GET["id"];
			$db = M("address_list");
			$db->where(array("mid"=>$this->my['id'],'choose'=>1))->setField("choose",0);
			$result=$db->where(array("mid=".$this->my['id'],'id'=>$id))->setField("choose",1);
			if($result){
				$this->ajaxReturn("","",1);
			}
		}
		//获取城市数据
		public function getCityInfo(){
			$db=M("class_city");
			$pid=$_GET["pid"];
			$cid=$_GET["cid"];
			if($pid){
				$city=$db->where("pid=".$pid)->select();
				$str="<option value='0'>--选择市--</option>";
				foreach ($city as $k => $v) {
					$str.="<option value='".$v['id']."'>".$v['name']."</option>";
				}
				$this->ajaxReturn($str,"",1);
			}
			if($cid){
				$county=$db->where("pid=".$cid)->select();
				$str="<option value='0'>--选择县/区--</option>";
				foreach ($county as $k => $v) {
					$str.="<option value='".$v['id']."'>".$v['name']."</option>";
				}
				$this->ajaxReturn($str,"",1);
			}
		}
		//图文编辑器
		public function artEditor(){
			$this->display();
		}
		//统一修改数据表前缀
		public function editDataUse(){
			//$this->editData('common_data','root','root','wghd_','pigcms_',1);
		}
		public function editData($dbname,$user,$pwd,$new,$old,$type){
			$database = $dbname;         //数据库名称
	        $user = $user;                       //数据库用户名
	        $pwd = $pwd;                         //数据库密码
	        $replace = $new;                     //替换后的前缀
	        $seach = $old;                     //要替换的前缀
	        $db=mysql_connect("localhost","$user","$pwd") or die("连接数据库失败：".mysql_error());         //连接数据库
	        $tables = mysql_list_tables("$database");        
	        while($name = mysql_fetch_array($tables)) {
	        	switch ($type) {
	        		case '1'://更改前缀
	        			$table = str_replace($seach,$replace,$name['0']);
	        			break;
	        		
	        		case '2'://添加前缀
	        			$table = $replace.$name['0'];
	        			break;
	        	}
                $table = str_replace($seach,$replace,$name['0']);
                mysql_query("rename table $name[0] to $table");
	        }
		}
		//CSS3实现波浪效果
		public function wavesCss3(){
			$this->display();
		}
		//canvas绘制波浪线
		public function wavesCanvas(){
			$this->display();
		}
		//带超链接的二维码
		public function qrcode(){
			$url = 'http://www.baidu.com';
			if(file_exists('./Extend/Vendor/phpqrcode/phpqrcode.class.php'))
	        {
	            require_once './Extend/Vendor/phpqrcode/phpqrcode.class.php';
	        }    
	        else{
	        	echo 'a';
	        }
			$errorCorrectionLevel = "L";
			$matrixPointSize = "4";
			QRcode::png($url, false, $errorCorrectionLevel, $matrixPointSize);
		}
		//个人修改页面
		public function personInfoEdit(){
			$this->display();
		}
		//weui
		public function weui(){
			$this->display();
		}	
		//上传多个图片
		public function uploadImgs(){
			$this->display();
		}
	}
 ?>