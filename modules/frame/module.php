<?php

debugPrint('this is frame module.php');

$userModel = ModuleLoader::load('frame-user');
$userModel->login();

if(isset( $_REQUEST['a'])){
    $action = $_REQUEST['a'];
}else{
    $action = 'layout';
}

debugPrint(" action is {$action}");

switch($action){
case 'layout':



break;
default:
echo 'unknow action';
}
// check logined, set username guest or other

 
// is there a action, if no , default action is 'layout'
// switch action

// case layout
// run page.php
//    read tree with right
//    show index.md? login.md?
//

// case render
// get url, 
// has read right? no -> render login
// read file
// create content
// output content

// call api
// loadmodule
// echo output



?>