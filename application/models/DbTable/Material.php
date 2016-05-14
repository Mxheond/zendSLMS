<?php

class Application_Model_DbTable_Material extends Zend_Db_Table_Abstract
{

    protected $_name = 'material';
    protected $single_material;


    // protected $_dependentTables = array('comment');
 
    // protected $_referenceMap    = array(
    // 	 'Course' => array(
    //         'columns'           => array('course_id'),
    //         'refTableClass'     => 'course',
    //         'refColumns'        => array('id'),
    //         'onDelete'          => self::CASCADE,
    //         'onUpdate'          => self::CASCADE
    //     )
    // );



    function listMaterials(){
		return $this->fetchAll()->toArray();
	}

	function getMaterialById($id){
		$material = $this->fetchRow('id ='.$id, 1);
		return $material->toArray();
	}

	function addMaterial($materialInfo){
		// create row takes data as assoc array
		// return $this->insert($materialInfo);

		$row = $this->createRow($materialInfo);
		return $row->save();

	///	lastInsertId();
	}

	function editMaterial($update_data,$id)
	{
		return $this->update($update_data,"id=".$id);
	}

	function getCourseMaterials($id){
		$select = $this->select("*")->where('course_id='.$id);
		return $this->fetchAll($select)->toArray();
	}

	function downloaded($id)
	{
		# code...
		$material = $this->fetchRow('id ='.$id, 1);
		$material->num_downloads += 1;
		return $material->save();
	}

	function deleteMaterial($id){
		return $this->delete('id='.$id);
	}

	function updateColumn($id, $column, $new_value){
		$material = $this->fetchRow('id ='.$id, 1);
		$material->$column = $new_value;
		return $material->save();
	}
	function hideMaterial($id){
		return $this->updateColumn($id, "is_hidden", 1);
	}

	function showMaterial($id){
		return $this->updateColumn($id, "is_hidden", 0);
	}

	function lockMaterial($id){
		return $this->updateColumn($id, "is_locked", 1);
	}

	function unlockMaterial($id){
		return $this->updateColumn($id, "is_locked", 0);
	}




}

