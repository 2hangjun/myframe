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

	public function __construct($tabelName=''){
		parent::__construct();
		if(!$tabelName){
			dd('请指定要操作的数据表名');die;
		}

		$this->tabelName = $tabelName;
	}

	public function getList($join='*', $columns = null, $where = null)
	{
		$res = $this->select($this->tabelName,$join,$columns,$where);
		return $res;
	}

	public function getOne($join='*', $columns = null, $where = null)
	{
		$res = $this->select($this->tabelName,$join,$columns,$where);
		return $res;
	}

	public function _update($data = null, $where = null)
	{
		if(empty($data)){
			dd("请输入需要update的值");
		}
		$res = $this->update($this->tabelName,$data,$where);
		return $res;
	}

	public function _insert($data = null)
	{
		if(empty($data)){
			dd("请输入需要insert的值");
		}
		$res = $this->insert($this->tabelName,$data);
		return $res;
	}

	public function _del($where = null)
	{
		if(empty($where)){
			dd("请输入where条件，防止误删除。整表删除请使用_delete()方法");
		}
		$res = $this->delete($this->tabelName,$where);
		return $res;
	}

	public function _delete($where = null)
	{
		if(!empty($where)){
			dd("该方法为整表删除，请勿误操作。使用_del(\$where)筛选删除");
		}
		$res = $this->delete($this->tabelName);
		return $res;
	}

	public function _has($join = null , $where = null)
	{
		$res = $this->has($this->tabelName,$join,$columns,$where);
		return $res;
	}

	public function _count($join = null , $columns = null, $where = null)
	{
		$res = $this->count($this->tabelName,$join,$columns,$where);
		return $res;
	}

	public function lastSql(){
		return $this->last_query();
	}

}