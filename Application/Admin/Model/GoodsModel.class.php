<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.15
 * Time: 20:01
 */
namespace Admin\Model;

use Think\Model;

class GoodsModel extends Model
{
    protected $_validate = array(
        array('goods_name' , 'require' , '商品名称不能为空') ,
        array('cate_id' , '0' , '商品类型必须要选择' , 1 , 'notequal') ,
        array('shop_price' , 'require' , '本店售价不能为空')
    );

    //数据写入数据库之前插入数据
    protected function _before_insert(&$data , $options)
    {
        $goods_sn = I('goods_sn ');
        if ($goods_sn == '') {
            $data['goods_sn'] = 'SN' . time() . rand(1000 , 9999);
        }
        $data['add_time'] = time();
        //获取表单域file的name值
        $fileName = array_keys($_FILES)[0]; //goods_img
        //获取要上传的文件保存的路径 保存到对应控制器同名文件夹下
        $dir = CONTROLLER_NAME;  //Goods
        //获取两张张缩略图  建议大图写在前，并给出区别的下标
        $arr = array(
            'img_'   => array(400 , 400) ,
            'thumb_' => array(60 , 60) ,
        );
        //判断是否有文件上传
        if ($_FILES[$fileName]['error'] == 0) {
            //表示有文件上传
            $img = oneuploadThumb($fileName , $dir , $arr);
            if ($img['status'] == 1) {
                $data['goods_ori'] = $img['info'][0];
                $data['goods_img'] = $img['info'][1];
                $data['goods_thumb'] = $img['info'][2];
            } else {
                $this->error=$img['info'];
                return false;
            }
        }

    }

    /**
     * @param  $data add页面表单提交后的商品信息包含添加商品的ID 故选择使用 _after_insert来插入商品属性值
     * @param  $options
     */
    protected function _after_insert($data , $options)
    {
        $goods_id = $data['id'];
        /*获取商品增加的属性值   页面因将同一个表单数据提交到两个表中，故在属性信息所有那么前增加attr 所有属性值
        均为attr数组中的值  数组的下标为attr_id  值为attr_value*/
        $attrData = I('post.attr');
        foreach ($attrData as $key => $val) {
            if (is_array($val)) {
                foreach ($val as $v) {
                    $goods_attr = array(
                        "goods_id"   => $goods_id ,
                        "attr_id"    => $key ,
                        "attr_value" => $v
                    );
                    M('GoodsAttr') -> add($goods_attr);
                }
            } else {
                $goods_attr = array(
                    "goods_id"   => $goods_id ,
                    "attr_id"    => $key ,
                    "attr_value" => $val
                );
                M('GoodsAttr') -> add($goods_attr);
            }
        }
    }

    /**
     * @param $data
     * @param $options
     */
    protected function _after_update($data , $options)
    {
        $goods_id = $data['id'];
        /*获取商品增加的属性值   页面因将同一个表单数据提交到两个表中，故在属性信息所有那么前增加attr 所有属性值
        均为attr数组中的值  数组的下标为attr_id  值为attr_value*/
        $attrData = I('post.attr');
//        p($attrData);die;
        M('GoodsAttr') -> where('goods_id=' . $goods_id) -> delete();
        foreach ($attrData as $key => $val) {
            if (is_array($val)) {
                foreach ($val as $v) {
                    $goods_attr = array(
                        "goods_id"   => $goods_id ,
                        "attr_id"    => $key ,
                        "attr_value" => $v
                    );

                    M('GoodsAttr') -> add($goods_attr);
                }
            } else {
                $goods_attr = array(
                    "goods_id"   => $goods_id ,
                    "attr_id"    => $key ,
                    "attr_value" => $val
                );
//                M('GoodsAttr')->where('goods_id='.$goods_id)->delete();
                M('GoodsAttr') -> add($goods_attr);
            }
        }
    }
}