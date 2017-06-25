<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.10
 * Time: 22:29
 */
namespace Admin\Controller;

class TypeController extends CommonController
{
    /**
     * 增加商品类型，
     */
    public function add()
    {
        //获取表单提交数据
        if (IS_POST) {
            $this -> typeModel = D('type');
            $re = $this -> typeModel -> create();
            if ($re) {
                $res = $this -> typeModel -> add();
                if ($res) {
                    $this -> success('添加成功' , U('lst'));
                    die;
                } else {
                    $this -> error('添加失败');
                }
            } else {
                $this -> error($this -> typeModel -> getError());
            }
        }
        $this -> display();
    }

    /**
     * 商品类型展示
     */
    public function lst()
    {
        $count = $this -> typeModel -> count();
        $page = new \Think\Page($count , 10);
        $page -> setConfig('next' , '下一页');
        $page -> setConfig('prev' , '上一页');
//        $page->setConfig('theme','第一页 上一页 %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = $page -> show();

        $typeData = $this -> typeModel -> limit($page -> firstRow , $page -> listRows) -> select();
        $this -> assign('show' , $show);
        $this -> assign('typeData' , $typeData);
        $this -> display();

    }

    /**
     * 商品类型修改
     */

    public function edit()
    {
        if (IS_POST) {
            $data = I();
            $res = $this -> typeModel -> where('id=' . $data['id']) -> save($data);
//            echo $this->typeModel->_sql();die;
            if ($res !== false) {
                $this -> success('修改成功' , U('lst'));
            } else {
                $this -> error('修改失败');
            }
        } else {
            $id = I('id');
            $typeData = $this -> typeModel -> find($id);
            $this -> assign('typeData' , $typeData);
            $this -> display();
        }
    }

    public function del()
    {
        $id = I('id');
        $attrData = $this -> attrModel -> join('a left join mall_type as b on a.type_id=' . $id) -> select();
        if (!empty($attrData)) {
            $res = $this -> typeModel -> where('id=' . $id) -> delete();
            if ($res) {
                $this -> success('删除成功');
            } else {
                $this -> error('删除失败');
            }
        }

    }


}