<?php

if (!defined('WIKIBOX_APP_NAME')) {
    define('WIKIBOX_APP_NAME', 'wikibox_zyh');
}

require("modules/ModuleCaller.class.php");
ModuleCaller::instance()->runModule('frame');

?>