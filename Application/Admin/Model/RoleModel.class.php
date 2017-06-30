<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.24
 * Time: 20:17
 */
namespace Admin\Model;

use Think\Model;

class RoleModel extends Model
{
    protected $_validate = array(
        array('role_name' , 'require' , '角色名称不能为空') ,
    );

    protected function _after_insert($data , $options)
    {
        $roleId = $data['id'];
        //获取权限管理信息
        $privIds = I('post.priv_id');
        foreach ($privIds as $v) {
            //将角色和对应权限存入role_privilege表中
            M('RolePrivilege') -> add(array(
                'role_id' => $roleId ,
                'priv_id' => $v
            ));
        }
    }

    //修改角色信息后同时把修改该角色对应的权限信息更新
    protected function _after_update($data , $options)
    {
        $privIds = I('post.priv_id');
        $role_id = $options['where']['id'];
        //修改角色信息 角色对应的权限先删除 然后再从表单获取添加至中间表role_privilegeh中
        M('RolePrivilege') -> where(array('role_id' => $role_id)) -> delete();
        foreach ($privIds as $val) {
            $role_priv['role_id'] = $role_id;
            $role_priv['priv_id'] = $val;
            M('RolePrivilege') -> add($role_priv);
        }
    }

    //删除角色信息后删除角色对应的权限信息
    protected function _after_delete($data , $options)
    {
        $role_id = $options['where']['id'];
        $re = M('RolePrivilege')->where(array('role_id'=>$role_id))->delete();
        if($re!==false){
            return true;
        }else{
            $this->error= M('RolePrivilege')->getError();
            return false;
        }
    }
}