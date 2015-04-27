<?php
namespace Acme\DemoBundle\Service;
/**
 * Provide convenient validaters and conventions for database interactions
 */
abstract class DatabaseService {
    protected $doctrine;
    protected function _validPrimaryKey($entity){
        $id = $entity->getId();
        if(!is_numeric($id)){
            throw new \InvalidArgumentException("Not a valid numeric primary key in " . \get_class($entity));
        }
        return $id;
    }
    protected function _dqlQuery($queryString, $params = array(), $methodType, $limit = null, $offset = null){
        $query = $this->doctrine->getManager()->createQuery($queryString);
        if(!is_null($limit) and is_numeric($limit)){
            $query->setMaxResults($limit);
        }
    	if(!is_null($limit) and is_numeric($limit) and !is_null($offset) and is_numeric($offset)){
    		$offset = ($offset - 1) * $limit;
            $query->setFirstResult($offset);
        }
        foreach($params as $paramKey => $paramValue){
            $query->setParameter($paramKey, $paramValue);
        }
        if(!is_callable($methodType, true)){
            throw new \InvalidArgumentException('$methodType should be a callable string');
        }
        return $query->$methodType();
    }
    protected function _orCondition($paramName, $values, &$returnParamsArray){
        $queryString = '( ';
        foreach($values as $key => $value){
            $paramCond = "xyz$key";
            $queryString .= "$paramName = :$paramCond";
            $returnParamsArray[$paramCond] = $value;
            if(count($values) !== $key + 1){
                $queryString .= ' OR ';
            }
        }
        $queryString .= ' )';
        return $queryString;
    }
    protected function _sqlQueryUpdate($sql){
        $conn = $this->doctrine->getManager()->getConnection();
        $query = $conn->executeUpdate($sql);
        return $query;
    }
}