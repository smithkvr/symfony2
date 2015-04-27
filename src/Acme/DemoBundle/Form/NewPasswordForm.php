<?php

namespace Acme\DemoBundle\Form;

use Acme\DemoBundle\Utility\Form;
use Acme\DemoBundle\Utility\Form\Input;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\MaxLength;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;


/**
 * @package PuntClubBundle
 * @subpackage Form
 */
class NewPasswordForm extends Form
{
    protected function setup()
    {
        $this->add(new Input("password"), array(new NotBlank(), new Length(array('min'=>6)), new Regex("/^[a-zA-Z\d]+$/")));
        $this->add(new Input("password2"));
    }
    
    protected function doCustomValidation()
    {
        $password = $this->getValue("password");
        $password2 = $this->getValue("password2");
        if($password != $password2){
            $this->get("password")->addError("The passwords don't match. Is one of them wrong?");
        }
    }   
}