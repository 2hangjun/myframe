���ݿ��������
$whereĬ��Ϊ��
'getList'	����ѯ����			��$this->getList($field,$where);//�ֶ�,����
'getOne'	����ѯ����			��$this->getList($field,$where);//�ֶ�,����
'_update'	����������			��$this->getList($data,$where);	//��������,����
'_insert'	����������			��$this->_insert($data);		//��������
'_delete'	��ɾ������			��$this->_insert($where);		//ɾ������
'_has'		���ж������Ƿ����	��$this->_insert($where);		//����
'_count'	��ͳ������			��$this->_insert($where);		//����
'_replace'	����ʱδ����