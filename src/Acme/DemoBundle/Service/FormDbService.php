<?php
namespace Acme\DemoBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry ;

class FormDbService extends DatabaseService {
    protected $doctrine;
    protected $factory;
    public function __construct(Registry $doctrine, FactoryService $factoryService)
    {
        $this->doctrine = $doctrine;
        $this->factory = $factoryService;
    }
    public function getProduct($contribution){
        return $this->doctrine->getRepository('ViamediaPuntclubBundle:ChargifyProduct')->find($contribution);
    }
    public function getClubByName($clubName){
        return $this->doctrine->getRepository('ViamediaPuntclubBundle:Club')->findByName($clubName);
    }
    
    public function getSiteBySiteId($siteId){
    	return $this->doctrine->getRepository('ViamediaPuntclubBundle:Site')->find($siteId);
    }
}