<?php  
	namespace Home\Controller;
	use Think\Controller;
	class IndexCommonController extends Controller {
		public $classdb;
		public function __construct(){
			parent::__construct();
			$this->classdb=D("ProjectClass");
		}
		public function saveClassName($pid,$keyword=''){
			if($pid){
				$name = $this->classdb->where('id='.$pid)->getField('name');
			}
			if($keyword){
				$name = $keyword;
			}
			S('NOW_CLASS_NAME',$name);
		}
	}
?>