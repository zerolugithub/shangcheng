<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.13
 * Time: 16:22
 */
namespace Admin\Model;

use Think\Model;

class CategoryModel extends Model
{


    protected $_validate = array(
        array('cate_name' , 'require' , '分类名称不能为空')
    );

    /**
     * 删除时改变记录状态
     */
    public function beforeUpdate($id)
    {
        $this -> where(array('id' => $id)) -> find();
        $this -> status = 0;
        $res = $this -> save();
        return $res;
    }


    //获取商品分类无限极递归查询结果
    public function cateLst()
    {
        $cateData = $this -> where(array('status' => 1)) -> select();
        //获取查询的树形结构
        $cateTree = $this -> getTree($cateData , $pid = 0 , $level = 0);
        return $cateTree;
    }

    /**
     * 无限极递归分类
     * @param  array $cateData 数据库查询的二维数组
     * @param int    $pid
     * @param int    $level
     * @return array  二维数组
     */
    public function getTree($cateData , $pid = 0 , $level = 0)
    {
        static $tree = array();
        foreach ($cateData as $val) {
            if ($val['pid'] == $pid) {
                $val['level'] = $level;
                $tree[] = $val;
                $this -> getTree($cateData , $val['id'] , $level + 1);
            }
        }
        return $tree;
    }
}