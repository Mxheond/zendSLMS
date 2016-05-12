<?php

class UsersController extends Zend_Controller_Action
{

    public function init()
    {
		$this->model = new Application_Model_DbTable_User();
        $this->auth = Zend_Auth::getInstance();
        if($this->auth->hasIdentity()) {
            $this->identity = $this->auth->getIdentity();
            $this->view->identity = $this->identity;
        }
    }

    public function indexAction()
    {
        
    }

    public function loginAction()
    {
        if((!isset($this->identity))){
            $form = new Application_Form_Login();
            if($this->getRequest()->isPost()){  
                if($form->isValid($this->getRequest()->getParams())){
                    $data = $form->getValues();
                    $email= $data['email'];
                    $password= $data['password'];
                    // get the default db adapter
                    $db = Zend_Db_Table::getDefaultAdapter();
                    //create the auth adapter
                    $authAdapter = new Zend_Auth_Adapter_DbTable($db,'user','email', 'password');
                    //set the email and password
                    $authAdapter->setIdentity($email);
                    $authAdapter->setCredential(md5($password));
                    //authenticate
                    $result = $authAdapter->authenticate();     
                    if($result->isValid()){
                        $auth = Zend_Auth::getInstance();
                        $storage = $auth->getStorage();
                        $storage->write($authAdapter->getResultRowObject(
                        array('id','email','full_name')));
                        $this->redirect('index/index');
                    }
                    else{
                        $this->view->form = $form;
                        $this->view->error = "Invalid Email or Password";
                        $this->render('login');
                    }
                }
            }
            $this->view->form = $form;
        }else{
            $this->redirect('index/index');
        }
    }

    public function registerAction()
    {
        if(!isset($this->identity)){
            $form = new Application_Form_User();
            if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getParams())){
            $data = $form->getValues();
            if ($this->model->addUser($data))
            $this->redirect('users/index');     
                }
            }
            $this->view->form = $form;
        }else{
            $this->redirect('index/index');
        }
        
    }

    public function listAction()
    {
        if(isset($this->identity)){
            if($this->identity->role == '1'){
            $request = $this->getRequest()->getParams();
            if (!empty($request['role'])) {
                $users = $this->model->getUserByRole($request['role']);
            }elseif(!empty($request['banned'])){
                $users = $this->model->getBanned($request['banned']);
            }elseif(!empty($request['active'])){
                $users = $this->model->getInactiveUsers($request['active']);
            }else{
                 $users = $this->model->listUsers();
            }
            $this->view->rq = $this->getRequest()->getParams();
            $this->view->users = $users;
           
            }else{
                    $this->redirect('index/index');
            }
        }
    }	


    public function profileAction()
    {
        if(isset($this->identity)){
            $id = $this->getRequest()->getParam('id');
            $user = $this->model->getUserById($id);
            if(!empty($user)){
                $this->view->user = $user;
            }else{
                $this->redirect('/users/list/');
            }
        }else{
            $this->redirect('index/index');
        }
    }

    public function updateAction()
    {
        if(isset($this->identity)){
            $id = $this->getRequest()->getParam('id');
            if($this->identity->id == $id){
                $user = $this->model->getUserById($id);
                $form = new Application_Form_User();
                $form->getElement('email')->removeValidator('Db_NoRecordExists');
                $form->populate($user[0]);
                $this->view->form = $form;
                if($this->getRequest()->isPost()){
                    if($form->isValid($this->getRequest()->getParams())){
                        $data = $form->getValues();
                        $data['password'] = md5($data['password']);
                        $where[] = "id =".$user[0]['id'];
                        $this->model->update($data, $where);  
                        $this->redirect('/users/profile/id/'.$id);
                    }
                }
                $this->view->form = $form;
                $this->view->user = $user;
            }else{
                $this->redirect('/users/profile/id'.$id);
            }
        }else{
            $this->redirect('index/index');
        }
        
    }

    public function signoutAction()
    {
        if(isset($this->identity)){
            $this->auth = Zend_Auth::getInstance();
            if($this->auth->hasIdentity()) {
                $this->identity = $this->auth->clearIdentity();
            }
            $this->redirect('index/index');
        }else{
            $this->redirect('index/index');
        }
    }

    public function deleteAction()
    {
        if(isset($this->identity)){
            if($this->identity->role == '1'){
            $id = $this->getRequest()->getParam('id');
            $is_admin = $this->model->isAdmin($id);
            $admin = $is_admin;
            $count = count($admin);
            if ($admin[0]['role']=='1') {
                if($count == 1){
                     $this->view->error = "Couldn't delete the last remainig admin";              
                }else{
                    if($this->model->deleteUser($id)){
                     $this->redirect('users/list');
                    }
                }         
            }else{
                if($this->model->deleteUser($id)){
                 $this->redirect('users/list');
                }
            }
        }else{
            $this->redirect('users/login');
        }
    }
    }

    public function banAction()
    {
        if(isset($this->identity)){
            if($this->identity->role == '1'){
            $id = $this->getRequest()->getParam('id');
            $user = $this->model->getUserById($id);
            if($user[0]['role'] == '0'){
                if($this->model->changeState($id,'is_banned')){
                    $this->redirect('users/list');
                 }else{
                    $this->view->error = "Operation failed";
                 }
            }else{
                $this->view->error = "Can't ban Administrator";
            }  
        }
    }
    }

    public function changeRoleAction()
    {
       if(isset($this->identity)){
        if($this->identity->role == '1'){
            $id = $this->getRequest()->getParam('id');
            $user = $this->model->getUserById($id);
            if($this->model->changeState($id,'role')){
                    $this->redirect('users/list');
            }else{
                    $this->view->error = "Operation failed";
            }
        }
    }
    }


}



















