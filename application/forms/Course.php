<?php

class Application_Form_Course extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */

		$name = new Zend_Form_Element_Text('name');
		$name->setRequired();
		$name->setLabel('Course Name');
		$name->addValidator(new Zend_Validate_Db_NoRecordExists(
	    array(
	        'table' => 'course',
	        'field' => 'name'
	   		 )
		));
		$date = new Zend_Form_Element_Date('date');
//                Zend_Form_El
//		$date->setRequired();
		$date->setLabel('Date');
//		$date->addValidator(new Zend_Validate_Db_NoRecordExists(
//	    array(
//	        'table' => 'course',
//	        'field' => 'date'
//	   		 )
//		));

		$name->setAttrib('class', 'form-control');
		
//	 	$id = new Zend_Form_Element_Hidden('id');
		// $content = new Zend_Form_Element_Textarea('content');
		// $content->setLabel('Content');
		// $content->addValidator(new Zend_Validate_StringLength(array('min'=>10, 'max'=>250)));
		// $content->setAttrib('class', 'form-control');
		$submit = new Zend_Form_Element_Submit('Submit');
		$submit->setAttrib('class', 'btn btn-primary');

		$this->addElements(array($name, $date, $submit));

    }


}

