<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.24
 * Time: 18:10
 */
namespace Admin\Controller;

use Think\Controller;

class RoleController extends Controller
{
    //角色增加
    public function add()
    {
        if(IS_POST){
            $roleModel=D('Role');
            if($roleModel->create()){
                if($roleModel->add()){
                    //添加成功
                    $this->success('添加成功',U('lst'));exit;
                }else{
                    $this->error('添加失败');
                }
            }else{
                $this->error($roleModel->getError());
            }
        }
        //获取权限信息
        $privModel = D('Privilege');
        $privData = $privModel->privNavTree();
        $this->assign('privData',$privData);
        $this->display();
    }
}