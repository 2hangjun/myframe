<?php
namespace app\ctrl;
use app\model\cmodel;
class indexCtrl extends \core\kernel
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index(){
		//调用模型类（对数据库的操作）
		$model = new cmodel('names');
		$data = array('name'=>'b');
		$where['field'] = array('*');
		$where['where'] = array('id'=>3);
		$where['join'] = array("[>]account" => array("author_id" => "user_id"));
		$res = $model->getList(array("[><]ages" => 'id',"[><]heig" => 'name'),'*');
		dd($model->lastSql());
		dd($res);
		die;
		//视图
		$this->assign('data',$data);
		$this->display('index.html');
	}
}