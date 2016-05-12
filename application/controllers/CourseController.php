<?php

class CourseController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->model = new Application_Model_DbTable_Course();
    	 // $authorization =Zend_Auth::getInstance();
      //   if(!$authorization->hasIdentity()) {
       
      //       $this->redirect('auth/login');
        // }
    }

    public function indexAction()
    {
    	$this->view->course = $this->model->listCourses();
        $data = Zend_Auth::getInstance()->getStorage()->read();
        $admin_id = $data->id;
    }

    public function addAction()
    {
        // action body

        $form = new Application_Form_Course();
        //$values = $this->getRequest()->getParams();
//			if($this->getRequest()->isPost()){
//				if($form->isValid($this->getRequest()->getParams())){
//				$data = $form->getValues();
//				// $session= Zend_Auth::getInstance()->getStorage()->read();
//		   		// $id = $session->id;
//				
//				if ($this->model->addCourse($data))
//				$this->redirect('course/index');
				
				
//			}

//	}
	$this->view->form = $form;
	
    }


}

