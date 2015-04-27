<?php
namespace Acme\DemoBundle\Utility;

use Symfony\Component\HttpFoundation\Response;
/**
 * @package PuntClubBundle
 * @subpackage Utility
 */
class Util {
    protected $container;
    public function getRandomString($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    }
    public function setContainer($container){
        $this->container = $container;
    }
    public function getUniqueToken($repo, $stringLength, $tokenColName = null){
        $count = 0;
        do {
            if($count > 100) throw new \RuntimeException("Could not generate a unique random string. ");
            $token = $this->getRandomString($stringLength);
            if ($tokenColName) {
                $existingToken = $repo->findOneBy(array($tokenColName =>$token));
            } else {
                $existingToken = $repo->findOneByToken($token);
            }
            $count++;
        } while(!empty($token) and $existingToken);
        return $token;
    }
    
    public function jsonResponse($data){
        return new Response(json_encode($data));
    }
    public function jsonDecode($json){
        return \json_decode($json);
    }

}
class TransactionDateException extends \Exception {}