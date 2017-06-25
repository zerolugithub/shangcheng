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
        $roleId=$data['id'];
        //获取权限管理信息
        $privIds=I('post.priv_id');
        foreach($privIds as $v){
            //将角色和对应权限存入role_privilege表中
            M('RolePrivilege')->add(array(
                'role_id'=>$roleId,
                'priv_id'=>$v
            ));
        }
    }
}