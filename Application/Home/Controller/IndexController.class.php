<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public $logsDb;
	public $common;
	public function __construct(){
		parent::__construct();
		$this->logsDb=D("Logs");
        $this->common = new IndexCommonController();
	}
    public function index(){
        $condition['delete']=0;
    	$logs=$this->logsDb->where($condition)->order("finished,create_time desc")->select();
        $data=array(
            'all'=>count($logs),
            'finished'=>$this->logsDb->where(array("finished"=>1,"delete"=>0))->count(),
            'unfinished'=>$this->logsDb->where(array("finished"=>0,"delete"=>0))->count(),
        );
        $pc=M("ProjectClass")->where(array("delete"=>0))->select();
        $this->assign("pc",$pc);
        $this->assign("data",$data);
    	$this->assign("list",$logs);
    	$this->display();
        //$this->display("test");
    }
    public function test(){
        //$this->logsDb->where("finished=1")->select();
        $this->display();
        // $str = '中文中文中文';
        // $str = iconv("utf-8","gb2312",$str);
        // echo mb_substr($str, 0, 6, 'utf-8');
         // $condition['content']=array("like","%创惠%");
         // $logs=$this->logsDb->where($condition)->select();
         // echo $this->logsDb->getLastsql();
         // dump($logs);
    }
    //下拉加载更多
    public function loadmoreLog(){
        
    }
    //添加/修改日志（AJAX）
    public function editlogs(){
    	$con=$_GET['con'];
    	$id=$_GET['id'];
    	$db=$this->logsDb;
    	$log=$db->where("id=".$id)->find();
    	if($log){
    		$db->where("id=".$id)->setField("content",$con);
    	}else{
    		$data=array(
    			"content"=>$con,
    		);
    		$db->create();
    		$s=$db->add($data);
    		if($s){
    			$this->ajaxReturn("1","JSON");
    		}else{
    			$this->ajaxReturn("0","JSON");
    		}
    	}
    }
    //确认完成日志（AJAX）
    public function finishLog(){
    	$id=$_GET['id'];
    	$db=$this->logsDb;
    	$log=$db->where("id=".$id)->find();
    	if($log){
            $time = time();
            $data=array(
                "finished"=>1,
                "finish_time"=>$time,
            );
            $finish_time = date('Y-m-d',$time);
    		$s=$db->where("id=".$id)->save($data);
            $s = 1;
    		if($s){
    			$this->ajaxReturn("1",$finish_time,"JSON");
    		}else{
    			$this->ajaxReturn("0","JSON");
    		}
    	}
    }

    //添加日志列表（AJAX）
    public function addlogs(){
    	$db=$this->logsDb;
        $newp=$this->smartAddClass($_GET['content']);
    	$data=array(
    		'content'=>$_GET['content'],
            'difficulty'=>$_GET['difficulty'],
            'type'=>$_GET['type'],
    	);
    	if ($db->create($data,1) === false) {
    	    dump($db->getError());
    	}
    	$id=$db->add();
        //智能分类
        $this->smartBelongTo($id);
    	if($id){
            $logs=$this->logsDb->where("id=".$id)->select();
            //拼接日志列表
    		$str=$this->joinHtml($logs);
    		$this->ajaxReturn($str,$newp,1);
    	}else{
    		$this->ajaxReturn("添加日志失败","JSON");
    	}
    }
    //智能分类
    public function smartBelongTo($id){
        $log=$this->logsDb->where("id=".$id)->find();
        for ($i=2; $i < 6; $i++) { 
            $keyword=mb_substr($log['content'], 0, $i, 'utf-8');
            $db=D("ProjectClass");
            $condition['name']=array("like","%".$keyword."%");
            $condition['delete']=0;
            $pc=$db->where($condition)->find();
            //dump($condition);
            if($pc){
                $this->common->saveClassName($pc['id']);//缓存项目名
                $res=$this->logsDb->where("id=".$id)->setField("pid",$pc['id']);
                if($res){
                    $db->where("id=".$pc['id'])->setInc("nums");
                }
                break;
            }else{
                break;
            }
        }
    }
    //智能添加项目
    public function smartAddClass($str){
        //$str = iconv("utf-8","gb2312",$str);
        for ($i=2; $i < 6; $i++) { 
            $keyword=mb_substr($str, 0, $i, 'utf-8');
            $condition['content']=array("like",$keyword."%");
            $condition['delete']=0;
            $result=$this->logsDb->where($condition)->find();
            if($result){
                $this->common->saveClassName(0,$keyword);//缓存项目名
                $db=D("ProjectClass");
                $condition['name']=array("like","%".$keyword."%");
                $pc=$db->where($condition)->find();
                //dump($condition);
                //如果没有该项目 添加项目
                if(!$pc){
                    $data=array(
                        'name'=>$keyword,
                    );
                    $db->create($data,1);
                    $id=$db->add();
                    if($id){
                        $condition['pid']=0;
                        $this->logsDb->where($condition)->setField("pid",$id);
                        $htmlstr="<span class='project-class' data-id='".$id."'>".$keyword."</span>";
                        return $htmlstr;
                    }
                    break;
                }else{
                    break;
                }
            }
        }
    }
    //拼接HTML
    public function joinHtml($data){
    	foreach ($data as $k => $v) {
            $str.="<li data-id=".$v['id']." data-pid=".$v['pid']." data-finish=".$v['finished'].">";
            $str.=  "<div class='check-finished ";
            if($v['finished']==1){
                $str.="finished";
            }else{
                $str.="unfinished";
            }
            $str.="' data-id=".$v['id']."></div>";
            $str.=  "<input type='text' class='edit-content' contenteditable='true' data-id='".$v['id']."' value='".$v['content']."'/>";
            $str.=  "<div class='add-time";
            if($v['finished']==1){
                $str.=" done";
            }
            $str.="'>".date("Y-m-d",$v['finished']?$v['finish_time']:$v['create_time'])."</div>";
            $str.=  "<div class='operation'><span class='delete'>删除</span></div>";
            $str.="</li>";
        }
		return $str;
    }
    //删除日志
    public function deletelog(){
        $id=$_GET['id'];
        $log=$this->logsDb->where("id=".$id)->find();
        if($log['content']==""){
            $res=$this->logsDb->where("id=".$id)->delete();
        }else{
            $res=$this->logsDb->where("id=".$id)->setField("delete",1);
        }
        if($res&&$log['pid']){
            M("ProjectClass")->where("id=".$log['pid'])->setDec("nums");
        }
        $this->ajaxReturn($this->logsDb->getLastsql(),"",1);
    }
    //删选日志
    public function screeningLog(){
        $type=$_GET['type'];
        if($type==1){//三种状态切换
            $index=$_GET['index'];
            switch ($index) {
                case '1':
                    $condition['finished']=1;
                    break;
                case '2':
                    $condition['finished']=0;
                    break;
                default:
                    $condition="";
                    break;
            }
        }
        if($type==2){//搜索
            $con=$_GET['con'];
            $condition['content']=array("like",'%'.$con.'%');
        }
        if($type==3){//根据项目切换
            $pid=$_GET['pid'];
            //保存项目名
            $this->common->saveClassName($pid);
            $condition['pid']=$pid;
        }
        $condition['delete']=0;
        $logs=$this->logsDb->where($condition)->order("finished,create_time desc")->select();
        $str=$this->joinHtml($logs);
        $this->ajaxReturn($str,$this->logsDb->getLastsql(),1);
    }
    //选择日期切换
    public function chooseDay(){
        $data= $_GET['data'];
        $condition=array(
            'year'=>$data['year'],
            'month'=>$data['month'],
            'day'=>$data['day'],
            'delete'=>0,
        );
        $logs=$this->logsDb->where($condition)->order("finished,create_time desc")->select();
        $str=$this->joinHtml($logs);
        $this->ajaxReturn($str,"",1);
    }
    //统计
    public function statistical(){
        $pc=M("ProjectClass")->order("nums desc")->select();
        $color=array(array("#d35400","#e67e22"),array("#2980b9","#3498db"),array("#46465e","#5a68a5"),array("#333333","#525252"),array("#27ae60","#2ecc71"),array("#124e8c","#4288d0"));
        $max_nums=$pc['0']['nums'];
        foreach ($pc as $k => $v) {
            $pc[$k]['proportion']=(string)($v['nums']/$max_nums*100)."%";
            $color2=$color[array_rand($color)];
            $pc[$k]['color1']=$color2['0'];
            $pc[$k]['color2']=$color2['1'];
        }
        $this->assign("list",$pc);
        $this->display();
    }
    //编辑项目描述（AJAX）
    public function editProjectDescribe(){
        $pid=$_GET['pid'];
        $content=trim($_GET['content']);
        $pd=M("project_describe")->where(array("pid"=>$pid))->find();
        if($pd){
            $result=M("project_describe")->where(array("pid"=>$pid))->setField("content",$content);
        }else{
            $data=array(
                'pid'=>$pid,
                'content'=>$content,
            );
            $result=M("project_describe")->where(array("pid"=>$pid))->add($data);
        }
        $pd=M("project_describe")->where(array("pid"=>$pid))->find();
        if($result){
            $this->ajaxReturn($pd['content'],"",1);
        }else{
            $this->ajaxReturn("","",2);
        }
    }
    //获取项目描述（AJAX）
    public function getProjectDescribe(){
        $pid=$_GET['pid'];
        $pd=M("project_describe")->where(array("pid"=>$pid))->find();
        $this->ajaxReturn($pd['content'],"",1);
    }
    //筛选BUG
    public function getLogsType(){
        $pid=$_GET['pid'];
        $type=$_GET['type'];
        $logs = M('Logs')->where(array("pid"=>$pid,'type'=>$type))->select();
        $logs_str = $this->joinHtml($logs);
        $this->ajaxReturn($logs_str,"",1);
    }
    //数据图表（jquery.jqplot插件）
    public function dataCard(){
        $this->display();
    }
    public function dataCard2(){
        $this->display();
    }
    public function dataCard3(){
        $this->display();
    }

}