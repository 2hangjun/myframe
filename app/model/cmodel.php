<?php
/**
 * 其他操作数据库方法查看收藏
 * http://medoo.lvtao.net/doc.get.php
 */
namespace app\model;
use \core\lib\model;
class cmodel extends model
{
	public $tabelName='';
	public $mysqlFun = array(
		'getList'	=>'select',
		'getOne'	=>'get',
		'_insert'	=>'insert',
		'_delete'	=>'delete',
		'_update'	=>'update',
		'_has'		=>'has',
		'_count'	=>'count',
		'_replace'	=>'replace'
		// 'max',
		// 'min',
		// 'sum',
		// 'avg'
		);
	public function __construct($tabelName=''){
		parent::__construct();
		if(!$tabelName){
			dd('请指定要操作的数据表名');die;
		}

		$this->tabelName = $tabelName;
	}

	//数据库的操作	//todo
	public function __call($name,$arguments=''){
		// echo count($arguments);die;
		if(empty($name) || !isset($name) || !array_key_exists($name,$this->mysqlFun))
		{
			dd('不存在数据库操作方法');die;
		}
		$funName = $this->mysqlFun[$name];
		// if(empty($arguments) || count($arguments)<=0 || !is_array($arguments)){
		// 	dd('参数不正确');die;
		// }
		$argNum = count($arguments);
		switch ($funName) {
			case 'update':	//$field($data):更新数据
			case 'select':	//$field:返回字段
			case 'get':		//$field:返回字段
				//join:	"[>]account" => ["author_id" => "user_id"],具体使用查询手册，默认为空
				//todo,如果要使用join必须传递3个参加（数组）
				$join	='';
				$field	='*';
				$where	='';
				switch ($argNum) {
					case '1':
						$where = $arguments[0];
						break;
					case '2':
						$field = $arguments[0];
						$where = $arguments[1];
						break;
					case '3':
						$field = $arguments[0];
						$where = $arguments[1];
						$join = $arguments[2];
						break;
				}
				if($argNum<3){
					$res = $this->$funName($this->tabelName,$field,$where);
				}else{
					$res = $this->$funName($this->tabelName,$join,$field,$where);
				}
				return $res;
				break;
			case 'insert':	//$data
			case 'delete':	//$where
			case 'has':		//$where
			case 'count':	//$where
				$where = isset($arguments[0])?$arguments[0]:'';
				$res = $this->$funName($this->tabelName,$where);
				return $res;
				break;
			// case 'replace':
			// 	$res = $this->$funName($this->tabelName, $column, $search, $replace, $where);
			// 	return $res;
			// 	break;
			default:
				# code...
				break;
		}
	}

}