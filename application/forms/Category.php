<?php

class Application_Form_Category extends Zend_Form
{

    public function init()
    {
       	$name = new Zend_Form_Element_Text('name');
       	$name->setRequired();
		$name->setLabel('Name');
		$name->addFilter('StringTrim');
		$name->addFilter('StringToLower');
		$name->addValidator(new Zend_Validate_Db_NoRecordExists(
	    	array(
	        	'table' => 'category',
	        	'field' => 'name'
	    	)
		));
		$submit = new Zend_Form_Element_Submit('Submit');
		$submit->setAttrib('class', 'btn btn-primary');

		$this->addElements(array($name, $submit));

    }


}

