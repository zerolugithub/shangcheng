<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.11
 * Time: 0:51
 */
namespace Admin\Controller;

class AttributeController extends CommonController
{

    /**
     * 属性增加
     */
    public function add()
    {
        if (IS_POST) {
            //使用创建数据对象来添加数据 模型中调用基类方法在数据写入前对数据做修改
            $re = $this -> attrModel -> create();
            if ($re) {
                $res = $this -> attrModel -> add();
                if ($res) {
                    $this -> success('添加成功' , U('lst' , array('type_id' => $_POST['type_id'])));
                } else {
                    $this -> error('添加失败');
                }
            } else {
                $this -> error($this -> attrModel -> getError());
            }
        } else {
            $typeData = $this -> typeModel -> select();
            $this -> assign('typeData' , $typeData);
            $this -> display();
        }
    }

    /**
     * 属性列表显示
     */

    public function lst()
    {
        $type_id = (int)I('type_id');//1：查看对应类型type lst 属性列表传值 2：添加对应商品类型传到属性列表时的商品类型提交时传值
        $this -> assign('type_id' , $type_id);
        if ($type_id == 0) {
            $where = 1;
        } else {
            $where = "type_id=" . $type_id;
        }
//        $sql="select a.*,b.type_name from mall_attribute a LEFT JOIN mall_type b ON a.type_id=b.id";
        $attrData = $this -> attrModel -> field("a.*,b.type_name") -> join("a LEFT JOIN mall_type b ON a.type_id=b.id") -> where($where) -> select();
        $this -> assign('attrData' , $attrData);
        $typeData = $this -> typeModel -> select();
        $this -> assign('typeData' , $typeData);
//        echo $this->attrModel->_sql();die;
        $this -> display();
    }


    public function edit()
    {
        if(IS_POST){
            $attr_id=I('attr_id');
            $Data= I();
            $re = $this->attrModel->where('id='.$attr_id)->save($Data);
            if($re){
                $this->success('修改成功',U('lst',array('type_id'=>$Data['type_id'])));exit;
            }else{
                $this->error('修改失败');
            }

        }
        $id = I('id');
        $attrData = $this->attrModel->where(array('id'=>$id))->find();
        $typeData = $this->typeModel->select();
        $this->assign('typeData',$typeData);
        $this->assign('attrData',$attrData);
        $this->display();
    }

    public function del(){
        $id = I('id');
        $re=$this->attrModel->where(array('id'=>$id))->delete();
        if($re){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
}