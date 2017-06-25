<?php
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
//定义项目程序路径
define('APP_PATH','./Application/');
//开启调试模式，上线后关闭
define('APP_DEBUG',TRUE);
//引入入口文件
require 'ThinkPHP/ThinkPHP.php';