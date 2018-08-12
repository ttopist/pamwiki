<?php

/*
foreach (getallheaders() as $name => $value) {  
    echo "$name: $value <br>\n";  
}

foreach ($_SERVER as $name => $value) {  
    echo "$name: $value <br>\n";  
}

echo __FILE__ . '<br>';


$request_uri = parse_url($_SERVER['REQUEST_URI']);
$request_uri = explode("/", $request_uri['path']);
$script_name = explode("/", dirname($_SERVER['SCRIPT_NAME']));

$app_dir = array();
foreach ($request_uri as $key => $value) {
    if (isset($script_name[$key]) && $script_name[$key] == $value) {
        $app_dir[] = $script_name[$key];
    }
}


var_dump($request_uri);echo '<br>';
var_dump($script_name);echo '<br>';
var_dump($app_dir);echo '<br>';


//获取 baseUrl
echo dirname(__FILE__) . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'ModulesManager.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'ModulesManager.php';

$ss = new ModulesManager();
$ss->show();

*/

if (!defined('WIKIBOX_APP_NAME')) {
    define('WIKIBOX_APP_NAME', 'wikibox_zyh');
}

require("modules/ModuleCaller.class.php");
ModuleCaller::instance()->runModule('frame');

?>