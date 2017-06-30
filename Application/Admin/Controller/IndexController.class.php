<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.10
 * Time: 1:27
 */
namespace Admin\Controller;

class IndexController extends CommonController
{
    public function index()
    {
        $this -> display();
    }

    public function main()
    {
        $this -> display();
    }

    public function top()
    {
        $this -> display();
    }

    public function menu()
    {
        $adminModel = D('Admin');
        $menuData = $adminModel->menuLst();
        $menuData = list_to_tree($menuData);
        $this->assign('menuData',$menuData);
        $this -> display();
    }
}