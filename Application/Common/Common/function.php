<?php
/**
 * 存放前后台调用的公共函数
 */

function p($val)
{
    echo "<pre>";
    return print_r($val);
}

/**
 * 定义一个单文件上传的函数，
 *函数的返回值，是上传文件后存储上传文件的路径。
 *需要一个参数，来指定，是否生成缩略图，指定生成几张缩略图，指定缩略图的大小
 *需要一个参数，指定上传的路径，保存的位置
 *需要一个参数，上传文件域的名称
 *参数1：上传文件域的名称
 *参数2：指定上传的位置
 *参数3：是否生成缩略图，使用数组的方式来传递
 *array(
 *array('230','230'),
 *array('100','100')
 *)
 * @return array
 */
function oneuploadThumb($filename , $dir , $arr = array())
{
    $config = C('FILE_CONFIG');
    $rootPath = $config['rootPath'];
    $upload = new \Think\Upload($config);
    $upload -> savePath = $dir . '/'; // 设置附件上传目录    // 上传文件
    $info = $upload -> upload();
    //如果有图片上传
    if ($info) {
        //上传成功
        //获取原图路径
        $oriUrl = $info[$filename]['savepath'] . $info[$filename]['savename'];
        //定义一个数组用于返回上传图片路径
        $img[] = $oriUrl;
        //判断是否生成缩略图
        if ($arr) {
            //存在就生成
            $thumb = new \Think\Image();
            //打开要生成缩略图的原图
            $image = $thumb -> open($rootPath . $oriUrl);
            foreach ($arr as $key => $val) {
                //获取缩略图路径
                $imgPath = $info[$filename]['savepath'] . $key . $info[$filename]['savename'];
                $image -> thumb($val[0] , $val[1]) -> save($rootPath . $imgPath);
                //将生成的缩略图保存到数组
                $img[] = $imgPath;
            }
        }
        //返回一个数组 包含状态值1 表示成功 $img表示返回的要保存的图片及缩略图的路径
        return array(
            'status' => 1 ,
            'info'   => $img
        );
    } else {
        //上传失败
        return array(
            'status' => 0 ,
            'info'   => $upload -> getError()
        );
    }
}

/**
 * 定义多个单文件上传的函数，
 *函数的返回值，是上传文件后存储上传文件的路径。
 *需要一个参数，来指定，是否生成缩略图，指定生成几张缩略图，指定缩略图的大小
 *需要一个参数，指定上传的路径，保存的位置
 *需要一个参数，上传文件域的名称
 *参数1：上传文件域的名称
 *参数2：指定上传的位置
 *参数3：是否生成缩略图，使用数组的方式来传递
 *array(
 *array('230','230'),
 *array('100','100')
 *)
 * @return array
 */
function moreUploadFiles($filename , $dir , $arr = array())
{
    $config = C('FILE_CONFIG');
    $rootPath = $config['rootPath'];
    $upload = new \Think\Upload($config);
    $upload -> savePath = $dir . '/'; // 设置附件上传目录    // 上传文件
    $info = $upload -> upload(array($filename=>$_FILES[$filename]));
//    p($info);die;
    //如果有图片上传
    if($info){
            $imgs=array();
            //循环上传文件
            foreach($info as $key=>$val){
                //获取原图路径
                $goods_oris=$val['savepath'].$val['savename'];
                $img=array();
                $img[]=$goods_oris;
                if($arr){
                    //存在就生成缩略图
                    $thumb = new \Think\Image();
                    //打开要生成缩略图的原图
                    $image = $thumb -> open($rootPath . $goods_oris);
                    foreach ($arr as $k => $v) {
                        //获取缩略图路径
                        $imgPath = $val['savepath'] . $k . $val['savename'];
                        $image -> thumb($v[0] , $v[1]) -> save($rootPath . $imgPath);
                        //将生成的缩略图保存到数组
                        $img[] = $imgPath;
                    }
                }
                $imgs[]=$img;
            }
        //返回一个数组 包含状态值1 表示成功 $img表示返回的要保存的图片及缩略图的路径
        return array(
            'status' => 1 ,
            'info'   => $imgs
        );
    } else {
        //上传失败
        return array(
            'status' => 0 ,
            'info'   => $upload -> getError()
        );
    }
}


/**
 * 防XSS攻击
 * @return string
 */
function removeXSS($val)
{
    //使用静态变量存储实例对象可以对第二次以后的访问提高访问速度
    static $obj = null;
    if ($obj == null) {
        vendor('HTMLPurifier.HTMLPurifier#includes');
        $obj = new HTMLPurifier();
    }
//    dump($obj -> purify());
    return $obj -> purify($val);
}

/**
 * 无限极分类
 * @param     $list
 * @param int $pid
 * @param int $level
 * @return array
 */
function getTree($list,$pid=0,$level=0){
    static $tree=array();
    foreach($list as $val){
        if($val['pid']==$pid){
            $val['level']=$level;
            $tree[]=$val;
            getTree($list,$val['id'],$level+1);
        }
    }
    return $tree;
}

/**
 * 把返回的数据集转换成Tree
 * @access public
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
{
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = &$list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] = &$list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent           = &$refer[$parentId];
                    $parent[$child][] = &$list[$key];
                }
            }
        }
    }
    return $tree;
}