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
}