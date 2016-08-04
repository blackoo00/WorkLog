<?php 
	namespace Home\Model;
	use Think\Model;
	class ProjectClassModel extends Model{
		protected $_auto = array(
			array('time','time',1,'function'),
			array('year','gety',1,'callback'),
			array('month','getm',1,'callback'),
			array('day','getd',1,'callback'),
		);
	    function gety(){
			return date('Y',time());
		}
	    function getm(){
			return date('m',time());
		}
	    function getd(){
			return date('d',time());
		}
	}
?>