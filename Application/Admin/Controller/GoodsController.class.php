<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.15
 * Time: 19:31
 */
namespace Admin\Controller;

class GoodsController extends CommonController
{
    public function add()
    {
        //获取表单数据，并写入数据库
        if (IS_POST) {
            $re = $this -> goodsModel -> create();
            if ($re) {
                $res = $this -> goodsModel -> add();
                if ($res) {
                    $this -> success('添加成功' , U('lst'));
                    exit;
                }
                //先获取模型中的错误
                $error = $this -> goodsModel -> getError();
                if (empty($error)) {
                    //如果模型没有错误
                    $this -> error('添加失败');
                } else {
                    //输出模型错误
                    $this -> error($error);
                }
            } else {
                $this -> error($this -> goodsModel -> getError());
            }
        }
        //商品品牌信息
        $brandData = $this -> brandModel -> where('is_show=1') -> select();
        $this -> assign('brandData' , $brandData);
        //商品类型信息
        $typeData = $this -> typeModel -> select();
        $this -> assign('typeData' , $typeData);
        //显示商品分类
        $cateData = $this -> cateModel -> cateLst();
        //在页面显示商品分类
        $this -> assign('cateData' , $cateData);
        $this -> display();
    }

    /**
     * 显示商品列表
     */
    public function lst()
    {
        $where = array('is_delete' => 0);
        //搜索框展示分类信息
        $cateData = $this -> cateModel -> cateLst();
        $this -> assign('cateData' , $cateData);
        $goodsData = $this -> goodsModel -> where($where) -> select();
        $this -> assign('goodsData' , $goodsData);
        $this -> display();
    }

    public function photosAdd()
    {
        $id = I('id');
        $photoModel = D('GoodsPhotos');
        if (IS_POST) {
            $re = $photoModel -> create($_POST);
            if ($re) {
                $this -> success('添加成功');
                exit;
            }
            $error = $photoModel -> getError();
            if (empty($error)) {
                $this -> error('添加失败');
            } else {
                $this -> error($error);
            }
        }
        $this -> assign('id' , $id);
        $this -> display();
    }

    /**
     * 商品修改
     */
    public function edit()
    {
        if (IS_POST) {
            $goods_id = I('goods_id');
            $updateData = I();
            $res = $this -> goodsModel -> where(array('id' => $goods_id)) -> save($updateData);
            if ($res !== false) {
                $this -> success('修改成功' , U('lst'));
                exit;
            } else {
                $this -> error('修改失败');
            }
        }
        //获取要修改商品ID
        $id = I('id');
        //商品品牌信息
        $brandData = $this -> brandModel -> where('is_show=1') -> select();
        $this -> assign('brandData' , $brandData);
        //商品类型信息
        $typeData = $this -> typeModel -> select();
        $this -> assign('typeData' , $typeData);
        //获取商品信息
        $goodsData = $this -> goodsModel -> where(array('id' => $id)) -> find();
        $this -> assign('goodsData' , $goodsData);
        //展示商品分类
        $cateData = $this -> cateModel -> cateLst();
        //在页面显示商品分类
        $this -> assign('cateData' , $cateData);
        $this -> display();
    }

    public function trash()
    {
        if (IS_POST) {
            $id = I('goods_id');
            $this -> goodsModel -> id = $id;
            $this -> goodsModel -> is_delete = 1;
            $res = $this -> goodsModel -> save();
            if ($res !== false) {
                $this -> success('删除成功');
            } else {
                $this -> error('删除失败');
            }
        } else {
            //查询被放入回收站里的商品  is_delete=1
            $goodsData = $this -> goodsModel -> where(array('is_delete' => 1)) -> select();
            $this -> assign('goodsData' , $goodsData);
            $this -> display();
        }

    }

    //回收站还原商品
    public function reback()
    {
        $goods_id = I('id');
        $this -> goodsModel -> find($goods_id);
        $this -> goodsModel -> is_delete = 0;
        $re = $this -> goodsModel -> save();
//        if($re=)
    }

    /**
     * 获取商品类型属性 并返回到前台页面
     */
    public function showAttr()
    {
        //获取要展示属性的商品类型
        $id = I('id');
        $attrData = $this -> attrModel -> attrArr($id);
        $this -> assign('attrData' , $attrData);
        $this -> display();
//        $content = $this->display();
//        echo json_encode($content);
    }
}