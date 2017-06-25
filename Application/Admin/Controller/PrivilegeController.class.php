<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.24
 * Time: 15:37
 */
namespace Admin\Controller;

use Think\Controller;

class PrivilegeController extends Controller
{
    //权限增加方法
    public function add()
    {
        $privModel = D('Privilege');
        if (IS_POST) {
            if ($privModel -> create()) {
                if ($privModel -> add()) {
                    //添加成功
                    $this -> success('添加成功' , U('lst'));
                    exit;
                } else {
                    $this -> error('添加失败');
                }
            } else {
                $this -> error($privModel -> getError());
            }
        }
        $privData = $privModel -> privTree();
        $this -> assign('privData' , $privData);
        $this -> display();
    }

    //显示权限
    public function lst()
    {
        $privModel = D('Privilege');
        $privData = $privModel -> privTree();
        $this -> assign('privData' , $privData);
        $this -> display();
    }
}