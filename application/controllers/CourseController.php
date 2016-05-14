<?php

class CourseController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->model = new Application_Model_DbTable_Course();
        $this->auth =Zend_Auth::getInstance();
         if(!$this->auth->hasIdentity()) {
             $this->redirect('users/login');
         }else{
            $this->identity = $this->auth->getIdentity();
            $this->view->identity = $this->identity;   
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
        if($this->identity->role == '1'){
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
                 $admin_id = $this->identity->id;
                if ($this->model->addCourse($data,$admin_id))
                $this->redirect('course/index');
                
            }   
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

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
		$course = $this->model->getCourseById($id);
		$form = new Application_Form_Course();
        $form->getElement('name')->removeValidator('Db_NoRecordExists');   
		$form->populate($course[0]);
        $cats = $this->model->getCat();
        $cat_form= $form->getElement('cat_id');
        foreach ($cats as $cat) {
            $cat_form->addMultiOptions(array($cat['id'] => $cat['name']));
        }
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

    public function listAction()
    {
        $cid = $this->getRequest()->getParam('cid');
        if (isset($cid)) {
            $this->view->course = $this->model->getCourseByCat($cid);
        }else{
            $this->view->course = $this->model->listCourses();
        }
        $this->view->cats = $this->model->getDistCat();

    }

    public function singleAction()
    {
        // action body
    }


}





