<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.26
 * Time: 21:41
 */
namespace Admin\Controller;

use Think\Controller;

class AdminController extends Controller
{
    public function add()
    {
        if (IS_POST) {
            $adminModel = D('Admin');
            $re = $adminModel -> validate($adminModel -> _admin_validate) -> create();
            if ($re) {
                if ($adminModel -> add()) {
                    //添加成功
                    $this -> success('添加成功' , U('lst'));
                    exit;
                } else {
                    //添加失败
                    $this -> error('添加失败');
                }
            } else {
                $this -> error($adminModel -> getError());
            }
        }
        $roleModel = M('Role');
        $roleData = $roleModel -> select();
        $this -> assign('roleData' , $roleData);
        $this -> display();
    }

    //显示管理员信息
    public function lst()
    {
        $adminModel=D('Admin');
        $adminData=$adminModel->select();
        $this->assign('adminData',$adminData);
        $this->display();
    }
}