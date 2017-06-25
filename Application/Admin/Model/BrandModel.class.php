<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.21
 * Time: 11:24
 */
namespace Admin\Model;

use Think\Model;

class BrandModel extends Model
{
    //增加品牌时自动验证
    protected $_validate = array(
        array('brand_name' , 'require' , '品牌名称不能为空')
    );

    //在数据插入之前更新数据 调用_before_insert()方法
    protected function _before_insert(&$data , $option)
    {
        $data['add_time']=time();
        $imgName=array_keys($_FILES)[0];
        $img = uploadThumb($imgName);
        $data['brand_logo']=$img['info']['ori'];
    }
}