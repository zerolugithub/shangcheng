<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.10
 * Time: 22:05
 */
namespace Admin\Controller;

class CategoryController extends CommonController
{
    /**
     * 增加商品类型，
     */
    public function add()
    {
        if (IS_POST) {
            $re = $this -> cateModel -> create();
            if ($re) {
                $res = $this -> cateModel -> add();
                if ($res) {
                    $this -> success('添加成功' , U('lst'));
                    die;
                } else {
                    $this -> error('添加失败');
                }
            } else {
                $this -> error($this -> cateModel -> getError());
            }
        }
        $cateTree = $this -> cateModel -> cateLst();
//        dump($cateTree);die;
        $this -> assign('cateTree' , $cateTree);
        $this -> display();
    }

    public function lst()
    {
        $cateData = $this -> cateModel -> cateLst();
        $this -> assign('cateData' , $cateData);
        $this -> display();
    }

    public function edit()
    {
        if (IS_POST) {
            $id = I('id');
            $pid = I('pid');
            $cateDatas = I();
            //获取所有分类数据  通过无限极分类获取该分类的子分类
            $data = $this -> cateModel -> select();
            //获取该分类下级分类
            $dataList = $this -> cateModel -> getTree($data , $id);
            //判段父类pid是否等于自己的id 如果是则
            if ($id == $pid) {
                echo json_encode(array('status' => 0 , 'info' => '所选择的上级分类不能是当前分类或者当前分类的下级分类!' , 'url' => ''));
                exit;
            }
            //父类pid不能是自己的子级id
            foreach ($dataList as $son) {
                if ($son['id'] == $pid) {
                    echo json_encode(array('status' => 0 , 'info' => '所选择的上级分类不能是当前分类或者当前分类的下级分类!' , 'url' => ''));
                    exit;
                }
            }
            $re = $this -> cateModel -> where(array('id' => $id)) -> save($cateDatas);
            if ($re !== false) {
                echo json_encode(array('status' => 1 , 'info' => '修改成功!' , 'url' => U('lst')));
            } else {
                echo json_encode(array('status' => 0 , 'info' => '所选择的上级分类不能是当前分类或者当前分类的下级分类!' , 'url' => ''));
            }
        } else {
            $id = I('id');
            $cateData = $this -> cateModel -> where(array('id' => $id)) -> find();
            $cateTree = $this -> cateModel -> cateLst();
            $this -> assign('cateData' , $cateData);
            $this -> assign('cateTree' , $cateTree);
            $this -> display();
        }
    }

    public function del()
    {
        $id = I('id');
        //检验该分类下是否还有子分类
        $sonData = $this -> cateModel -> where('pid=' . $id) -> select();
        if (!empty($sonData)) {
            $this -> error('该分类不是末级分类或者分类下还存在商品，您不能删除！');
        } else {
            $res = $this -> cateModel -> beforeUpdate($id);
            if ($res) {
                $this -> success('删除成功！');
            } else {
                $this -> error('删除失败！');
            }

        }
    }

}
