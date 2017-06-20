<?php
namespace app\ctrl;

class indexCtrl extends \core\kernel
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index(){
		// echo 44444444;
		//调用模型类（对数据库的操作）
		$model = new \core\lib\model();
		
		//加载获取配置信息
		//CTRL:key值，route：配置文件名
		$temp = \core\lib\conf::get('CTRL','route'); 
		print_r($temp);
		$data = 'hello world';
		//视图
		$this->assign('data',$data);
		$this->display('index.html');
	}
}