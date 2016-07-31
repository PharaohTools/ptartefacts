<?php

namespace Model;

class RegistryStore {

    // Compatibility
    public $os = array("any") ;
    public $linuxType = array("any") ;
    public $distros = array("any") ;
    public $versions = array("any") ;
    public $architectures = array("any") ;

    // Model Group
    public $modelGroup = array("RegistryStore") ;

    public static $store ;

    public static function setValue($variable, $value) {
        self::$store[$variable] = $value;
    }

    public static function getValue($variable) {
        return isset(self::$store[$variable]) ? self::$store[$variable] : null ;
    }

}