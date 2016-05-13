<?php

class Application_Form_Material extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
		$this->setMethod('post');

		$name = new Zend_Form_Element_Text('name');
		$name->setRequired();
		$name->setLabel('Name :');

		$path = new Zend_Form_Element_File('path');
		$path->setLabel('Upload a file :')->setDestination('/var/www/html/zendSLMS/public/materials');
		$path->addValidator('Count', false, 1);
		$path->addFilter('StringtoLower');
		$path->addValidator('Extension', false, 'pdf,flv,mp4,doc,docx,ppt,pptx');
		$path->addValidator('NotExists', false, '/var/www/html/zendSLMS/public/materials');

		$submit = new Zend_Form_Element_Submit('submit');

		$this->addElements(array($name,$path, $submit));

		
    }


}

