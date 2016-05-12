<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
       	$email = new Zend_Form_Element_Text('email');
		$email->setRequired();
		$email->setLabel('Email');
		$email->addValidator(new Zend_Validate_EmailAddress);
		$email->setAttrib('class','input-block-level');
		$email->addFilter('StringTrim');
		$this->addElement($email);
		
		// $this->addElement('text', 'email', array('label' => 'Email:',
		// 'required' => true,
		// 'filters' => array('StringTrim'),
		// 'class' => 'input-block-level'
		// ));


		$this->addElement('password', 'password',array('label' => 'Password:',
		'required' => true,
		'class' => 'input-block-level'
		));

		$this->addElement('submit', 'submit', array('ignore' => true,'label'=> 'Login',
			'class'=> 'btn-style'
		));

    }


}

