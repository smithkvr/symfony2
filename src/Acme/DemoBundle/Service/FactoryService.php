<?php
namespace Acme\DemoBundle\Service;
class FactoryService {
    public function getClass($className, $params = array()){
        $className = 'Acme\DemoBundle\\'. $className;
        $rc = new \ReflectionClass($className);
        $foo = null;
        if(count($params)) {
          $foo = $rc->newInstanceArgs($params);
        }
        else {
          $foo = $rc->newInstance();
        }
        unset($rc);
        return $foo;
    }

  

}