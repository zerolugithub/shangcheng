<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.26
 * Time: 21:41
 */
namespace Admin\Controller;

class AdminController extends CommonController
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
        $adminModel = D('Admin');
        $adminData = $adminModel -> where(array('is_admin' => 0)) -> select();
        $this -> assign('adminData' , $adminData);
        $this -> display();
    }

    public function del()
    {

    }

    //管理员编辑
    public function edit()
    {
        //获取管理员id
        $admin_id = I('id');
        //管理员信息
        $adminModel = D('Admin');
        if(IS_POST){
//            if(D(''))
        }
        $adminInfo = $adminModel->join("a left join mall_admin_role b on a.id=b.admin_id")->field("a.*,b.role_id")->where(array('a.id'=>$admin_id))->find();
//        p($adminInfo);die;
        $this->assign('adminInfo',$adminInfo);
        //获取角色表信息
        $roleData = D('Role')->select();
        $this->assign('roleData',$roleData);
        $this->display();
    }

    //权限分配
    /* public function priv()
     {
         if(IS_POST){


         }
         //获取用户id
         $uid = I('id');
         //用户权限信息id
         $privInfo = M('AdminRole')->field('b.priv_id')->join("a left join mall_role_privilege b on a.role_id=b.role_id")->where('a.admin_id='.$uid)->select();
         foreach ($privInfo as $val){
             $privLst[]=$val['priv_id'];
         }
         //将权限ID传到前台模型 与权限做对比，如果权限ID相同就默认勾选
         $this->assign('privLst',$privLst);
         //获取权限信息
         $privModel = D('Privilege');
         $privData = $privModel -> privNavTree();
         $this -> assign('privData' , $privData);
         $this->display();
     }*/
}