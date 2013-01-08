<?php
/**
* Converting PDODblibBundle into Zf2 Module
* https://github.com/trooney/PDODblibBundle
*/

namespace PDODblibModule;

class Module
{

    public function getAutoloaderConfig()
    {
        return array(
			'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
        );
    }
}
