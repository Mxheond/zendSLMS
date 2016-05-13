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
		$date = Zend_Date::now();
		$row->time = $date;
		$row->cat_id = $courseInfo['cat_id'];
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

	function getCourseCat(){

		$select = $this->select()->setintegritycheck(false)
		->from('course')
     	->join('category','')
     	->where('category.id = course.cat_id');
        return $this->fetchAll($select)->toArray();
	}
	function getCat(){
		$cat = new Application_Model_DbTable_Category();
		$select = $cat->select("*")
						->from('category');
		return $this->fetchAll($select)->toArray();
	}

}

