<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'user';

    function listUsers(){
		return $this->fetchAll()->toArray();
	}

	function getBanned($banned){
		$banned = (int)$banned-1;
		return $this->fetchAll('is_banned ='.$banned)->toArray();
	}

	function getUserByRole($role){
		$role = (int)$role-1;
		return $this->fetchAll('role = '.$role)->toArray();
	}
	function lastAdmin(){
  		$admins = $this->getUserByRole(2);
  		return $admins;
  	}
  
  	function isAdmin($id){
  		$user = $this->find($id)->toArray();
  		if ($user[0]['role']=='1') {
  		$last = $this->lastAdmin();
  			return $last;
  		}else{
  			return $user;
  		}
  	}
  
	function getUserById($id){
		return $this->find($id)->toArray();
	}
	
	function deleteUser($id){
		return $this->delete('id='.$id);
	}
	function addUser($userInfo){		
		$row = $this->createRow();
		$row->email = $userInfo['email'];
		$row->password = md5($userInfo['password']);
		$row->full_name = $userInfo['full_name'];
		$row->gender = $userInfo['gender'];
		$row->country = $userInfo['country'];
		$row->signature = $userInfo['signature'];
		$row->photo = $userInfo['photo'];
		$row->role = 0;
		$row->is_banned = 0;

		return $row->save();
	}

	function changeState($id,$col){
		$row = $this->fetchRow('id='.$id);
		if($row->$col == '0'){
			$row->$col = '1';
		}else{
			$row->$col = '0';
		}
		return $row->save();
	}

	function sendRequest($id , $content){
		$req = new Application_Model_DbTable_CoursesRequest();
		$row = $req->createRow();
		$row->user_id = $id;
		$row->content = $content;
		$date = Zend_Date::now();
		$row->time = $date;
		return $row->save();

	}

	function getAllRequests(){
		$req = new Application_Model_DbTable_CoursesRequest();
		$select = $req->select("*")
					->from('courses_requests');
		return $this->fetchAll($select)->toArray();
	}
}

