<?php
namespace Viamedia\PuntclubBundle\Utility;

/**
 * @package PuntClubBundle
 * @subpackage Utility
 */
class SimpleXml {
    public function loadXml($xml){
        return simplexml_load_string($xml);
    }
}