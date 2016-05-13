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
        $this->view->cat = $this->model->getCourseCat();
        $data = Zend_Auth::getInstance()->getStorage()->read();
//        $admin_id = $data->id;
    }

    public function addAction()
    {
        // action body

        $form = new Application_Form_Course();
        $cats = $this->model->getCat();
        $cat_form= $form->getElement('cat_id');
        foreach ($cats as $cat) {
            $cat_form->addMultiOptions(array($cat['id'] => $cat['name']));
        }
        $values = $this->getRequest()->getParams();
			if($this->getRequest()->isPost()){
				if($form->isValid($this->getRequest()->getParams())){
				$data = $form->getValues();
				 $session= Zend_Auth::getInstance()->getStorage()->read();
		   		 $admin_id = $session->id;
				if ($this->model->addCourse($data,$cat_id,$admin_id))
				$this->redirect('course/index');		
			}

	}
	$this->view->form = $form;
    $this->view->cats = $cat;
	
    }
    
    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
		if($this->model->deletecourse($id))
			$this->redirect('course/index');
    }


}

