<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.22
 * Time: 21:37
 */
namespace Admin\Model;

use Think\Model;

class GoodsPhotosModel extends Model
{

    public function hasPhoto($files , $filename)
    {
        if (in_array(0 , $files[$filename]['error'])) {
            return true;
        }
    }


    public function _before_insert(&$data,$options)
    {
        p($data);echo __LINE__;die;
        $filename = array_keys($_FILES)[0];
        $flag = $this -> hasPhoto($_FILES , $filename);
        if ($flag) {
            $imgs = moreUploadFiles($filename , 'Goods' , array('img_' => array(400 , 400) , 'thumb_' => array(100 , 100)));
            if ($imgs['status'] == 1) {
                foreach ($imgs['info'] as $v) {
                    $data['goods_ori'] = $v[0];
                    $data['goods_thumb'] = $v[1];
                    $this -> add();
                }
            } else {
                $this -> error=$imgs['info'];
                return false;
            }
        }else{
            return false;
        }
    }
}