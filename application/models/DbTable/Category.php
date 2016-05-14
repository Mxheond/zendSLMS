<?php

class Application_Model_DbTable_Category extends Zend_Db_Table_Abstract
{

    protected $_name = 'category';

	function createCat($userInfo){		
		$row = $this->createRow();
		$row->name = $userInfo['name'];
		$date = Zend_Date::now();
		$row->time = $date;
		return $row->save();
	}

	function listAll(){
		return $this->fetchAll()->toArray();
	}

	function deleteCat($id){
		return $this->delete('id='.$id);
	}

	function getCatById($id){
		return $this->find($id)->toArray();
	}
}

