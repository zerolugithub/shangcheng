<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.24
 * Time: 15:54
 */
namespace Admin\Model;

use Think\Model;

class PrivilegeModel extends Model
{
    //自动验证：1、权限名称不能为空；2、上级权限数据类型必须是数字
    protected $_validate = array(
        array('priv_name' , 'require' , '权限名称不能为空') ,
        array('parent_id' , 'number' , '上级权限必须是数字')
    );

    //获取权限数据
    public function privTree()
    {
        $privData = $this->select();
        //无限极分类显示
        return getTree($privData);
    }

    public function privNavTree()
    {
        $privData = $this->select();
        //无限极分类显示
        return list_to_tree($privData);
    }

}