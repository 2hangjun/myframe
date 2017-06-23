数据库操作方法
$where默认为空
'getList'	：查询多条			：$this->getList($field,$where);//字段,条件
'getOne'	：查询单条			：$this->getList($field,$where);//字段,条件
'_update'	：更新数据			：$this->getList($data,$where);	//更新数据,条件
'_insert'	：插入数据			：$this->_insert($data);		//插入数据
'_delete'	：删除数据			：$this->_insert($where);		//删除条件
'_has'		：判断数据是否存在	：$this->_insert($where);		//条件
'_count'	：统计条数			：$this->_insert($where);		//条件
'_replace'	：暂时未启用