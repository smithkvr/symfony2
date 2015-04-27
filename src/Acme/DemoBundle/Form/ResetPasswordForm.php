<?php

namespace Acme\DemoBundle\Form;

use Acme\DemoBundle\Utility\Form;
use Acme\DemoBundle\Utility\Form\Input;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;


/**
 * @package PuntClubBundle
 * @subpackage Form
 */
class ResetPasswordForm extends Form
{
    protected function setup()
    {
        $this->add(new Input("email"), array(new NotBlank(), new Email()));
    }
}