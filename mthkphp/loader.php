<?php
//类映射
$classmap=array(
    'test1'=>'../application/test1.php'
);
function __autoload($class){
    global $classmap;
    //先从类映射中读取
    if(isset($classmap[$class])){
        require $classmap[$class];
        return;
    }
    //映射中不存在，再按常规流程解析
    require $class.'.php';
}
