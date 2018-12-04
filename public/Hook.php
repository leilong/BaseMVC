<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/4 0004
 * Time: 14:48
 */
//钩子类，一个简易的钩子类
class Hook
{
    //保存标签的静态变量
    static $tags = [];

    //添加标签到$tags中
    public static function add($tag,$behavior){
        //在$tags中没有相应的标签，没有的话则初始化为空数组
        isset(self::$tags[$tag]) || self::$tags[$tag] = [];
        //[]代表插入到数组的尾部，将行为插入到标签的尾部
        self::$tags[$tag][] = $behavior;
    }

    //批量导入标签
    public static function import($tags){
        // $tags类似下面的结构
//        [
//            'controller_init' => ['myLog']
//        ];
        foreach ($tags as $tag=>$behaviors){
            foreach ($behaviors as $key=>$behavior){
                self::add($tag,$behavior);
            }
        }
    }

    //触发某个标签
    public static function listen($tag){
        if(!isset(self::$tags[$tag])){
            return;
        }
        //由于标签对应的行为是个数组，因此需要循环执行
        foreach(self::$tags[$tag] as $key=>$name){
            self::exec($name);
        }
    }

    //执行某个函数
    public static function exec($method){
        call_user_func($method);
    }
}