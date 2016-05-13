<?php

class MaterialsController extends Zend_Controller_Action
{

    private $model = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_Material();
  //       $authorization = Zend_Auth::getInstance();
		// if(!$authorization->hasIdentity()) {
		// 	$this->redirect('users/login');
		// }
    }

    public function indexAction()
    {
        // list all
        $this->view->materials = $this->model->listMaterials();

    }

    public function addAction()
    {
        // action body
        $form = new Application_Form_Material();
		if($this->getRequest()->isPost()){
			if($form->isValid($this->getRequest()->getParams())){
				// $filter = new Zend_Filter_BaseName();
				echo "<pre>";$pathparts = pathinfo($form->path->getFileName());echo "</pre>";
				// $filename = $filter->filter($path);
				$filename =$pathparts['basename'];
				$arr = explode(".", $filename);
				$ext = end($arr);
				$vid_arr = array("flv", "mp4");
				$word_arr = array("doc", "docx");
				if( end($arr) == "pdf"){
					$type = "pdf";
				}
				elseif (in_array($ext, $vid_arr) ) {
					$type = "video";
				}
				elseif (in_array($ext, $word_arr) ) {
					$type = "word";
				}
				else{
					$type = "ppt";
				}
				$form_data = $form->getValues();
				$other_data = array("type" => $type, "user_id" => 1, "course_id" => 1);
				$data = array_merge($form_data, $other_data);
				if ($this->model->addMaterial($data))
					$this->redirect('materials/index');			
				
			}

		}
		$this->view->form = $form;
    }

    public function singleAction()
    {
        // action body
    }


}





