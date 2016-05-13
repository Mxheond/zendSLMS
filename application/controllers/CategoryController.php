<?php

class CategoryController extends Zend_Controller_Action
{

    public function init()
    {
        $this->model = new Application_Model_DbTable_Category();
        $this->auth =Zend_Auth::getInstance();
         if(!$this->auth->hasIdentity()) {
             $this->redirect('users/login');
         }else{
            $this->identity = $this->auth->getIdentity();
            $this->view->identity = $this->identity; 
            $this->view->Allcats = $this->model->listAll();           
         }
    }

    public function indexAction()
    {

        $this->view->cats = $this->model->listAll();         
    }

    public function addAction()
    {
        $form = new Application_Form_Category();
        $values = $this->getRequest()->getParams();
            if($this->getRequest()->isPost()){
                if($form->isValid($values)){
                    $data = $form->getValues();
                if ($this->model->createCat($data))
                $this->redirect('category/index');
                }
            }
        $this->view->form = $form;
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        if($this->model->deleteCat($id))
            $this->redirect('category/index');
    }


    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $cat = $this->model->getCatById($id);
        $form = new Application_Form_Category();
        $form->populate($cat[0]);
        $this->view->form = $form;
        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getParams())){
                $data = $form->getValues();
                $where[] = "id =".$cat[0]['id'];
                $this->model->update($data, $where);  
                $this->redirect('category/index');
            }
        }
        $this->view->form = $form;
        $this->view->cat = $cat;
    }
}