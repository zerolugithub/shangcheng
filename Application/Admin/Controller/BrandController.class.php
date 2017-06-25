<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.21
 * Time: 11:16
 */
namespace Admin\Controller;

class BrandController extends CommonController
{
    public function edit()
    {
        if(IS_POST){
            //获取表单数据
            $editData = I();
            $imgName = array_keys($_FILES)[0];
            $img = uploadThumb($imgName);
            $editData['brand_logo']=$img['info']['ori'];
            $editData['update_time']=time();
            $res = $this->brandModel->where(array('id'=>$editData['id']))->save($editData);
            if($res!==false){
                $this->success('修改成功',U('lst'));exit;
            }else{
                $this->error('修改失败');
            }
        }
        $brand_id = I('id');
        //根据获取的品牌id获取品牌信息
        $brandData = $this->brandModel->where(array('id'=>$brand_id))->find();
        $this->assign('brandData',$brandData);
        $this->display();
    }

    public function lst()
    {
        $where = array('is_show' => 1);
        $bandData = $this -> brandModel -> where($where) -> select();
//        dump($bandData);die;
        $this -> assign('brandData' , $bandData);
        $this -> display();
    }

    public function add()
    {
        if (IS_POST) {
            $re = $this -> brandModel -> create();
            if ($re) {
                $res = $this -> brandModel -> add();
                if ($res !== false) {
                    $this -> success('添加成功' , U('lst'));
                    exit;
                } else {
                    $this -> error('添加失败');
                }
            } else {
                $this -> error($this -> brandModel -> getError());
            }
        }
        $this -> display();
    }

    public function del()
    {
        $brand_id = I('brand_id');
        $this -> brandModel -> is_show = 0;
        $res = $this -> brandModel -> where(array('id' => $brand_id)) -> save();
        if ($res) {
            $this -> success('删除成功');
        } else {
            $this -> error('删除失败');
        }
    }
}