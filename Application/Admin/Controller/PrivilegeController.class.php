<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.24
 * Time: 15:37
 */
namespace Admin\Controller;

class PrivilegeController extends CommonController
{
    //权限增加方法
    public function add()
    {
        $privModel = D('Privilege');
        if (IS_POST) {
            if ($privModel -> create()) {
                if ($privModel -> add()) {
                    //添加成功
                    $this -> success('添加成功' , U('lst'));
                    exit;
                } else {
                    $this -> error('添加失败');
                }
            } else {
                $this -> error($privModel -> getError());
            }
        }
        $privData = $privModel -> privTree();
        $this -> assign('privData' , $privData);
        $this -> display();
    }

    //显示权限
    public function lst()
    {
        $privModel = D('Privilege');
        $privData = $privModel -> privTree();
        $this -> assign('privData' , $privData);
        $this -> display();
    }

    //修改权限信息
    public function edit()
    {
        //获取修改权限信息ID
        $priv_id=I('id');
        //获取对应权限信息
        $privModel = D('Privilege');
        if(IS_POST){
            $privId = I('priv_id');
            $priv = I();
            $res = $privModel->where(array('id'=>$privId))->save($priv);
            if($res!==false){
                $this->success('修改成功！',U('lst'));exit;
            }else{
                $this->error('修改失败');
            }
        }
        $privData = $privModel->find($priv_id);
        $this->assign('privData',$privData);
        //获取权限等级信息并在视图中显示
        $privTree = $privModel -> privTree();
        $this -> assign('privTree' , $privTree);
        $this->display();
    }
}