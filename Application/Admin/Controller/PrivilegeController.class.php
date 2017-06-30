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
        $priv_id = I('id');
        //获取对应权限信息
        $privModel = D('Privilege');
        if (IS_POST) {
            $id = I('priv_id');//获取id
            $pid = I('pid');//获取提交的pid
            //查询当前id权限下是否还有子级
            $privDatas = $privModel->select();
            //无限极分类查询子级
            $sonData = getTree($privDatas,$id);
            $priv = I();
            if($id==$pid){
                echo json_encode(array('status' => 0 , 'info' => '所选择的上级分类不能是当前分类或者当前分类的下级分类!' , 'url' => ''));
                exit;
            }
            foreach($sonData as $son){
                if($pid =$son['id']){
                    echo json_encode(array('status' => 0 , 'info' => '所选择的上级分类不能是当前分类或者当前分类的下级分类!' , 'url' => ''));
                    exit;
                }
            }
            $res = $privModel -> where(array('id' => $id)) -> save($priv);
            if ($res !== false) {
                echo json_encode(array('status' => 1 , 'info' => '修改成功!' , 'url' => U('lst')));
                exit;
            } else {
                echo json_encode(array('status' => 0 , 'info' => '所选择的上级分类不能是当前分类或者当前分类的下级分类!' , 'url' => ''));
            }
        }
        $privData = $privModel -> find($priv_id);
        $this -> assign('privData' , $privData);
        //获取权限等级信息并在视图中显示
        $privTree = $privModel -> privTree();
        $this -> assign('privTree' , $privTree);
        $this -> display();
    }

    //删除权限（栏目）
    public function del()
    {

    }
}