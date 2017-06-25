<?php
//检查PHP版本
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
//定义项目程序路径
define('APP_PATH','/Application/');
//开启调试模式，上线后关闭
define('APP_DEBUG',TRUE);
//定义后台入口文件直接路由到Admin下的Login控制器下的login方法
$_GET['m']='Admin';
$_GET['c']='Login';
$_GET['a']='login';
//设置访问
//引入入口文件
require 'ThinkPHP/ThinkPHP.php';