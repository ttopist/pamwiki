<?php

class ModuleCaller
{

    public function runModule($moduleName)
    {
        echo $moduleName . '<br>';
        require_once($moduleName . '/module.php');
    }

    /**
     * Singleton
     * @return ModuleCaller
     */
    static public function instance()
    {
        static $instance;
        if (!($instance instanceof self)) {
            $instance = new self();
        }
        return $instance;
    }

}

?>