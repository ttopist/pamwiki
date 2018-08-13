<?php

debugPrint('this is frame module.php');

// 获取action和path
if (isset($_REQUEST['a'])) {
    $action = $_REQUEST['a'];
} else {
    $action = 'layout';
}
$param = $_REQUEST['p'];

// 检验用户是否有权限做这几个操作
$userModule = ModuleLoader::load('frame-user');
$userModule->login();

debugPrint(" action is {$action}");

// 路由
switch ($action) {
    case 'layout':
        $tree = '';
        $renderModule = ModuleLoader::load('frame-render');
        $content = $renderModule->render('xxx');
        require 'layout.page.php';
        break;
    case 'render':
        break;
    case 'file':
        break;
    default:
        echo 'unknow action.';
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