<?php

class CourseController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->model = new Application_Model_DbTable_Course();
    	  $authorization =Zend_Auth::getInstance();
         if(!$authorization->hasIdentity()) {
       
             $this->redirect('users/login');
         }
    }

    public function indexAction()
    {
    	$this->view->course = $this->model->listCourses();
        $data = Zend_Auth::getInstance()->getStorage()->read();
        $admin_id = $data->id;
    }

    public function addAction()
    {

        $form = new Application_Form_Course();
        $values = $this->getRequest()->getParams();
			if($this->getRequest()->isPost()){
				if($form->isValid($this->getRequest()->getParams())){
				$data = $form->getValues();
                                $date = Zend_Date::now();
//                                var_dump($date);
//                                die();
				 $session= Zend_Auth::getInstance()->getStorage()->read();
		   		 $admin_id = $session->id;
				if ($this->model->addCourse($data,$summary,$date,$image,$cat_id,$admin_id))
				$this->redirect('course/index');
				
			}

	}
	$this->view->form = $form;
	
    }
    
    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
		if($this->model->deleteCourse($id))
			$this->redirect('course/index');
    }
    
    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
		$course = $this->model->getCourseById($id);
		$form = new Application_Form_Course();
		$form->populate($course[0]);
        $values = $this->getRequest()->getParams();
		if($this->getRequest()->isPost()){
			if($form->isValid($this->getRequest()->getParams())){
				$data = $form->getValues();
				$this->model->editCourse($id,$data);
				$this->redirect('course/index');
    		}

   		}
   		$this->view->form = $form;
	
    }
    
}

