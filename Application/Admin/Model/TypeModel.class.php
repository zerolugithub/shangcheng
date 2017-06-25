<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.10
 * Time: 22:47
 */
namespace Admin\Model;

use Think\Model;

class TypeModel extends Model
{
    protected $_validate  = array(
        array('type_name','require','商品类型不能为空')
    );
}