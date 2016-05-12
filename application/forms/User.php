<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {

    
    $full_name = new Zend_Form_Element_Text('full_name');
    $full_name->addFilter('StringTrim');
    $full_name->setAttrib('class', 'input-block-level');
    $full_name->setLabel('Full Name');

	$email = new Zend_Form_Element_Text('email');
	$email->setRequired();
	$email->setLabel('Email');
	$email->addValidator(new Zend_Validate_EmailAddress)
	->addValidator(new Zend_Validate_Db_NoRecordExists(
    	array(
        	'table' => 'user',
        	'field' => 'email'
    	)
	));
	$email->setAttrib('class', 'input-block-level');

 	$id = new Zend_Form_Element_Hidden('id');

	$password = new Zend_Form_Element_Password('password');
	$password->setLabel('Password');
	$password->addValidator(new Zend_Validate_StringLength(array('min'=>5, 'max'=>8)));
	$password->setAttrib('class', 'input-block-level');

	$gender = new Zend_Form_Element_Radio('gender');
	$gender->setLabel('Gender');
	$gender->addMultiOptions(array(
            'Male' => 'Male',
            'Female' => 'Female',
    ));

	$country = new Zend_Form_Element_Text('country');
	$country->setLabel('Country');
	$country->setRequired();
	$country->setAttrib('class', 'input-block-level');

	$signature = new Zend_Form_Element_Textarea('signature');
	$signature->setLabel('Signature');
	$signature->setAttrib('class','span7');
	// $signature->addValidator(new Zend_Validate_)

	$photo = new Zend_Form_Element_File('photo');
	$photo->setLabel('Upload an image:');
	$photo->setDestination('/var/www/html/zendSLMS/public/images/userprofile');
	// ensure only 1 file
	$photo->addValidator('Count', false, 1);
	// limit to 100K
	// $image->addValidator('Size', false, 102400);
	// only JPEG, PNG, and GIFs
	$photo->addValidator('Extension', false, 'jpg,png,gif');



	$submit = new Zend_Form_Element_Submit('submit');
	$submit->setAttrib('class', 'btn btn-primary');

	$this->addElements(array($id,$email, $password, $full_name, $gender, $country, $signature, $photo,  $submit ));

    }
	
}

