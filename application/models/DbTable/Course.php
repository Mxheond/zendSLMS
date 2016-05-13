<?php

class Application_Model_DbTable_Course extends Zend_Db_Table_Abstract
{

    protected $_name = 'course';

    function listCourses(){
		return $this->fetchAll()->toArray();
	}

    function addCourse($courseInfo,$cat_id,$admin_id){
	
	$row = $this->createRow();
	$row->name = $courseInfo['name'];
	$row->date = $courseInfo['date'];
	$row->cat_id = 1;
	$row->admin_id = 1;

	return $row->save();
	}

	function deleteCourse($id){
		return $this->delete('id='.$id);
	}

	function editCourse($id,$data){
		return $this->update($data,"id=$id");
	}

	function getCourseById($id){
		return $this->find($id)->toArray();
	}

}

