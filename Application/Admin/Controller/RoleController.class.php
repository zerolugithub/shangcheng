<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.24
 * Time: 18:10
 */
namespace Admin\Controller;

class RoleController extends CommonController
{
    //角色增加
    public function add()
    {
        if (IS_POST) {
            $roleModel = D('Role');
            if ($roleModel -> create()) {
                if ($roleModel -> add()) {
                    //添加成功
                    $this -> success('添加成功' , U('lst'));
                    exit;
                } else {
                    $this -> error('添加失败');
                }
            } else {
                $this -> error($roleModel -> getError());
            }
        }
        //获取权限信息
        $privModel = D('Privilege');
        $privData = $privModel -> privNavTree();
        $this -> assign('privData' , $privData);
        $this -> display();
    }

    //显示管理员列表
    public function lst()
    {
        //查询角色信息
        $roleModel = D('Role');
        /*$sql = "SELECT a.*,GROUP_CONCAT(c.priv_name) as priv_name from mall_role a
                left JOIN mall_role_privilege as b on a.id = b.role_id
                LEFT JOIN mall_privilege as c on b.priv_id=c.id
                GROUP BY a.id";*/
        $roleLst = $roleModel -> field('a.*,GROUP_CONCAT(c.priv_name) as priv_name') -> join('a left join mall_role_privilege as b on a.id = b.role_id ') -> join('mall_privilege as c on b.priv_id=c.id') -> group('a.id') -> select();
        $this -> assign('roleLst' , $roleLst);
        $this -> display();
    }

    //修改角色信息
    public function edit()
    {
        if (IS_POST) {
            $id = I('post.id');//获取角色ID
            $roleinfo = I('post.role');//获取角色信息
            $roleModel = D('Role');
            //对角色信息进行修改
            $re = $roleModel -> where(array('id' => $id)) -> save($roleinfo);
            if ($re !== false) {
                //修改成功
                $this -> success('修改成功！' , U('lst'));
                exit;
            } else {
                //修改失败
                $this -> error('修改失败');
            }
        }
        //获取表单传值id 查询要修改的角色记录
        $id = I('id');
        //获取角色信息
        $roleData = D('Role') -> where(array('id' => $id)) -> find();
        $this -> assign('roleData' , $roleData);
        //获取权限信息
        $privModel = D('Privilege');
        $privData = $privModel -> privNavTree($id);
        //在视图中显示数据
        $this -> assign('privData' , $privData);
        //获取角色对应权限的ID
        $privSel = M('RolePrivilege') -> where('role_id=' . $id) -> select();
        //将获取的信息中把角色对应想权限ID转换成一维数组
        foreach ($privSel as $val) {
            $sel[] = $val['priv_id'];
        }
        $this -> assign('sel' , $sel);
        $this -> display();
    }

    //删除数据
    //删除角色：1、判断该角色下是有有管理员信息 有则不可以删
    //          2、若没有管理员，则删除角色信息  同时删除中间表中该角色对应的权限信息
    public function del()
    {
        $role_id = I('id');
        //判断该角色下是有有管理员存在
        $admin_role= M('AdminRole')->where(array('role_id'=>$role_id))->select();
        if(!empty($admin_role)){
            $this->error('此角色有管理员存在，暂时不能删除！');
        }else{
            //不存在管理员，则需要删除角色以及该角色拥有的权限
            $re = D('Role')->where(array('id'=>$role_id))->delete();
            if($re!==false){
                $this->success('删除成功');
            }
            $error = D('Role')->getError();
            if(empty($error)){
                $this->error('删除失败');
            }else{
                $this->error($error);
            }
        }
    }
}