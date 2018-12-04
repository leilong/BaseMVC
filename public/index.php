<?php
//编码设置
header('Content-type:text/html;charset=utf8');

//自动加载先行
require '../mthkphp/loader.php';

//导入函数库
require 'functions.php';

//获取path_info信息
$path=$_SERVER['PATH_INFO'];
if(!isset($path)){
    echo '非法访问';
    die;
}
//解析path_info
$url=explode('/', $path);
//获取controller
if(!isset($url[2]) || empty($url[2])){
    //如果没有controller的话，默认为test1
    $controller='test1';
}else{
    $controller=$url[2];
}
//获取action
if(!isset($url[3]) || empty($url[3])){
    $action='index';
}else{
    $action=$url[3];
}

//导入标签 行为
$tags = include 'tags.php';
Hook::import($tags);

//触发某个标签----------------------注意这里
Hook::listen('controller_init');

//将类包含进来--------------------------不再需要，由__autoload加载
//require $controller.'.php';
//实例化并调用
$con=new $controller();
$con->$action();
