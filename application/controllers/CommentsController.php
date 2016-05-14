<?php

class CommentsController extends Zend_Controller_Action
{

    private $model = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_Comment();
        $authorization = Zend_Auth::getInstance();
		if(!$authorization->hasIdentity()) {
			$this->redirect('users/login');
		}
		else {
			$this->identity = $authorization->getIdentity();
            $this->view->identity = $authorization->getIdentity();
		}
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {

        // action body
        if($this->getRequest()->isPost()){
            if($this->getRequest()->getParam('content') && $this->getRequest()->getParam('material_id')){
                // $data=[];
                $data['content'] = $this->getRequest()->getParam('content');
                $data['material_id'] = $this->getRequest()->getParam('material_id');
                $data['user_id'] = $this->getRequest()->getParam('user_id');
                $data['time'] = new Zend_Date();
                
                 // $this->view->form = $data;              
                if ($this->model->addComment($data))
                    $this->redirect('materials/single/id/'.$data['material_id']);         
            }
        }
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        $material_id = $this->getRequest()->getParam('material_id');
        if($this->model->deleteComment($id))
            $this->redirect('materials/single/id/'.$material_id);
    }

    public function editAction()
    {
        // action body
        $id = $this->getRequest()->getParam('id');
        $this->view->id=$id;
        $comment = $this->model->getCommentById($id);
        $this->view->content = $comment['content'];
        //$values = $this->getRequest()->getParams();
        if($this->getRequest()->isPost()){
            $data=[];
            $data['content'] = $this->getRequest()->getParam('content');
            if($this->model->editComment($data,$id)){
                $this->redirect('materials/single/id/'.$comment['material_id']);         
            }
        }
        
    }

}



