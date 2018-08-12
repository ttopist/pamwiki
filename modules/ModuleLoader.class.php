<?php

class ModuleLoader
{

    static public function load($moduleName)
    {
        debugPrint( $moduleName . '<br>');
        return require_once($moduleName . '/module.php');
    }

}

?>