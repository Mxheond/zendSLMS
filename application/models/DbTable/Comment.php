<?php

class Application_Model_DbTable_Comment extends Zend_Db_Table_Abstract
{

    protected $_name = 'comment';

    // protected $_referenceMap    = array(
    // 	 'Material' => array(
    //         'columns'           => array('material_id'),
    //         'refTableClass'     => 'material',
    //         'refColumns'        => array('id'),
    //         'onDelete'          => self::CASCADE,
    //         'onUpdate'          => self::CASCADE
    //     ),
    // 	 'User' => array(
    //         'columns'           => array('user_id'),
    //         'refTableClass'     => 'user',
    //         'refColumns'        => array('id'),
    //         'onDelete'          => self::CASCADE,
    //         'onUpdate'          => self::CASCADE
    //     )

    // );

    function listComments(){
		return $this->fetchAll()->toArray();
	}

	function getCommentById($id){
		$comment = $this->fetchRow('id ='.$id, 1);
		return $comment->toArray();
	}

	function addComment($commentInfo){

		$row = $this->createRow($commentInfo);
		return $row->save();

	}

	function deleteComment($id){
		return $this->delete('id='.$id);
	}

	function getCommentsByMaterialId($id){
		return $this->fetchAll('material_id='.$id);
	}

	function editComment($data, $id)
	{
		return $this->update($data,"id=".$id);
	}



}

