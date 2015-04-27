<?php

namespace Acme\DemoBundle\Utility\Form;

class Input
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $errors = array();


    /**
     * @param $name
     * @param null $defaultValue
     */
    public function __construct($name, $defaultValue = null)
    {
        $this->name  = (string)$name;
        $this->value = $defaultValue;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @return mixed|null
     */
    public function getValue()
    {
        return $this->value;
    }


    /**
     * @param $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


    /**
     * @param string $errorMsg
     */
    public function addError($errorMsg)
    {
        $this->errors[] = (string)$errorMsg;
    }


    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

}