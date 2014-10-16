<?php

class App_Form_Login extends Zend_Form
{

    public function init()
    {
        $this->addElements(array(
            $email = new Zend_Form_Element_Text('email'),
            $password = new Zend_Form_Element_Password('password'),
            $submit = new Zend_Form_Element_Submit('submit')
        ));
        
        $email->setLabel('Email')
        	->setRequired(true);
        $password->setLabel('Password')
			->setRequired(true);    

		$submit->setLabel("Přihlásit")
			->setAttrib("class", "submit");
        
    }


}

