<?php  
	namespace Home\Controller;
	use Think\Controller;
	class WorkLogController extends Controller {
	    public $logsDb;
		public $common;
		function __construct(){
			parent::__construct();
			$this->logsDb=D("Logs");
	        $this->common = new IndexCommonController();
		}
		function test(){
			$this->display();
		}
		function ajaxtest(){
			$this->ajaxReturn('','',1);
		}
		function index(){
	        $pc=M("ProjectClass")->where(array("delete"=>0))->select();
	        $this->assign("pc",$pc);
	    	$this->display();
		}
		//通过搜索获得日志列表
		// function getLogListBySearch(){
		// 	$key = $_GET['ket'];
		// 	$condition['content'] = array('like','%'.$key.'%');
		// 	$logs = $this->getLogList($condition);
		// 	$this->ajaxReturn($logs,'',1);
		// }
		//通过滚动获得日志列表
		function getLogListByScroll(){
			$logs = $this->getLogList();
			$this->ajaxReturn($logs,'',1);
		}
		//获取日志列表
		function getLogList($condition = array()){
			$condition['delete']=0;
			$logs=$this->logsDb->where($condition)->order("finished,create_time desc")->select();
			foreach ($logs as $k => $v) {
				if($v['finished'] == 0){
					$logs[$k]['showtime'] = date('Y-m-d',$v['create_time']);
				}else{
					$logs[$k]['showtime'] = date('Y-m-d',$v['finish_time']);
				}
			}
			return $logs;
		}
		//获取全部/完成/未完成
		function getHeadrightData(){
	    	$logs=$this->logsDb->where($condition)->order("finished,create_time desc")->select();
			$data=array(
			    'all'=>count($logs),
			    'finished'=>$this->logsDb->where(array("finished"=>1,"delete"=>0))->count(),
			    'unfinished'=>$this->logsDb->where(array("finished"=>0,"delete"=>0))->count(),
			);
			$this->ajaxReturn($data,'',1);
		}
		//添加/修改日志（AJAX）
		public function editlogs(){
			$con=$_GET['con'];
			$id=$_GET['id'];
			$db=$this->logsDb;
			if($id){
				$re = $db->where("id=".$id)->setField("content",$con);
				if($re){
					$this->ajaxReturn('','修改成功',1);
				}else{
					$this->ajaxReturn('','修改失败',1);
				}
			}else{
				$data=array(
					"content"=>$con,
				);
				$db->create();
				$re=$db->add($data);
				if($re){
					$this->ajaxReturn('','修改成功',1);
				}else{
					$this->ajaxReturn('','修改失败',1);
				}
			}
		}
		//删除日志
		public function deletelog(){
		    $id=$_GET['id'];
		    $log=$this->logsDb->where("id=".$id)->find();
		    // if($log['content']==""){
		    //     $res=$this->logsDb->where("id=".$id)->delete();
		    // }else{
		    //     $res=$this->logsDb->where("id=".$id)->setField("delete",1);
		    // }
		    // if($res&&$log['pid']){
		    //     M("ProjectClass")->where("id=".$log['pid'])->setDec("nums");
		    // }
		    $this->ajaxReturn($this->logsDb->getLastsql(),"",1);
		}
	}
?>