<?php
return array(
    //'配置项'=>'配置值'
    //配置前后台公共资源路径
    'TMPL_PARSE_STRING' => array(
        '__HOME__'    => __ROOT__ . '/Public/Home' ,
        '__ADMIN__'   => __ROOT__ . '/Public/Admin' ,
        '__UPLOADS__' => __ROOT__ . '/Public' ,
    ) ,
    //连接数据库配置项
    /* 数据库设置 */
    'DB_TYPE'           => 'mysql' ,     // 数据库类型
    'DB_HOST'           => 'localhost' , // 服务器地址
    'DB_NAME'           => 'mall' ,          // 数据库名
    'DB_USER'           => 'root' ,      // 用户名
    'DB_PWD'            => '' ,          // 密码
    'DB_PORT'           => '3306' ,        // 端口
    'DB_PREFIX'         => 'mall_' ,    // 数据库表前缀

    //
    'URL_MODEL'         => 1 ,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'URL_PATHINFO_DEPR' => '/' ,    // PATHINFO模式下，各参数之间的分割符号
    //调用HTMLPurifier来防xss攻击  调用应用级函数定义的removeXSS方法来过滤  可以保留html样式过滤js代码
    'DEFAULT_FILTER'    => 'removeXSS' , // 默认参数过滤方法 用于I函数...

    'FILE_CONFIG' => array(
        'maxSize'  => 3145728 ,//允许上传文件最大值
        'rootPath' => './Public/Uploads/' , //保存根路径
        'exts'     => array('jpg' , 'gif' , 'png' , 'jpeg') ,//允许上传文件格式
    )
);