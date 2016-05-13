<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->model = new Application_Model_DbTable_User();
        $this->auth = Zend_Auth::getInstance();
        if($this->auth->hasIdentity()) {
            $this->identity = $this->auth->getIdentity();
            $this->view->identity = $this->identity;
        }else{
        	$this->redirect('/users/login');
        }
    }

    public function indexAction()
    {
        
    }


}

