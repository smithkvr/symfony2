<?php

namespace Acme\DemoBundle\Utility;


use \Acme\DemoBundle\Utility\Form\Input;
use \Symfony\Component\Validator\ValidatorInterface;
use \Acme\DemoBundle\Service\FactoryService;
use \Acme\DemoBundle\Service\FormDbService;
use \Acme\DemoBundle\Service\AccountService;

/**
 * A SIMPLE way to manage the communication of data and errors between the view and the domain
 */
class Form implements \ArrayAccess
{
    /**
     * @var array
     */
    protected $inputs = array();

    /**
     * @var \Symfony\Component\Validator\ValidatorInterface
     */
    protected $validator;

    protected $factory;

    protected $formDbService;
    
    protected $formAccountService;
    
    protected $formClubService;


    /**
     * @param \Symfony\Component\Validator\ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator = null,  FactoryService $factory = null, FormDbService $formDbService = null, AccountService $formAccountService = null, ClubService $formClubService = null)
    {
        $this->factory = $factory;
        $this->validator = $validator;
        $this->setup();
    }


    /**
     *
     */
    protected function setup()
    {

    }


    /**
     * @param Form\Input $input
     */
    public function add(Input $input, $constraints = array())
    {
        $name = $input->getName();

        $this->inputs[$name]      = $input;
        $this->constraints[$name] = $constraints;
    }


    /**
     * @param $name
     * @return Input
     * @throws \InvalidArgumentException
     */
    public function get($name)
    {
        if (array_key_exists($name, $this->inputs)){
            return $this->inputs[$name];
        }

        throw new \InvalidArgumentException("No form input found for key \"$name\"");
    }


    /**
     * Return array of all the inputs
     * @return array
     */
    public function getInputs()
    {
        return $this->inputs;
    }


    /**
     * @param $name
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getValue($name)
    {
        if (array_key_exists($name, $this->inputs)){
            return $this->inputs[$name]->getValue();
        }

        throw new \InvalidArgumentException("No form input found for key \"$name\"");
    }


    /**
     * @return bool
     */
    public function hasErrors()
    {
        foreach($this->inputs as $input){
            if($input->getErrors()){
                return true;
            }
        }

        return false;
    }


    /**
     * Populate input values from an array
     * @param $array
     */
    public function setValuesFromArray($array)
    {
        foreach((array)$array as $key => $value){
            if($this->offsetExists($key)){
                $this->get($key)->setValue($value);
            }else{

            }
        }
    }


    /**
     *
     */
    public function validate()
    {
        $validator = $this->validator;
        if(!$validator){
            throw new \LogicException("This form was not passed a Validator at construction, so cannot perform validation");
        }

        /**
         * Loop over the inputs
         * @var $input Input
         */
        foreach($this->inputs as $input){
            $constraints = $this->constraints[$input->getName()];
            // loop over the constraints for this input
            foreach($constraints as $constraint){
                // evaluate each constraint, adding its error message to the input
                $violations = $validator->validateValue($input->getValue(), $constraint);
                foreach($violations as $violation){
                    $input->addError($violation->getMessage());
                }
            }
        }

        // any extra validation goes here
        $this->doCustomValidation();
    }


    /**
     * Can be overriden to provide custom validation
     */
    protected function doCustomValidation()
    {

    }


    /**
     * @param $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->inputs[$offset]);
    }


    /**
     * @param $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }


    /**
     * @param $offset
     * @param $value
     * @throws \LogicException
     */
    public function offsetSet($offset, $value)
    {
        throw new \LogicException("Setting form inputs via the ArrayAccess interface is not allowed on this object");
    }


    /**
     * @param $offset
     * @throws \LogicException
     */
    public function offsetUnset($offset)
    {
        throw new \LogicException("Unsetting form inputs via the ArrayAccess interface is not allowed on this object");
    }



}

