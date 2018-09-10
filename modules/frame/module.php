<?php

if( URL_REWRITE ){
    $action = 'view';
}else{
    $action = isset($_REQUEST['a'])?$_REQUEST['a']:'view';
}
WB::info(" action is {$action}");

// check user's right
$userModule = WB::load('frame-user');
$userModule->login();

// action table: action -> function name
$actionTable = array(
    "view"=>"actionView",
    "file"=>"actionFile",
    "api"=>"actionApi",
);

// action functions
function actionView(){
    require 'view.php';
}

function actionFile(){
    require 'view.php';
}

function actionApi(){
    $moduleName = isset($_REQUEST['m'])?$_REQUEST['m']:'';
    if(strlen($moduleName)>0){
        $apiModule = WB::load($moduleName);
        $apiModule->api();
    }
}

function actionNone(){
    die('404');
}

// run action
if(array_key_exists($action, $actionTable)){
    $actionTable[$action]();
}else{
    actionNone();
}

?>