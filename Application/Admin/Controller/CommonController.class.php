<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.11
 * Time: 20:30
 */
namespace Admin\Controller;

use Think\Controller;

class CommonController extends Controller
{
    protected $attrModel;
    protected $typeModel;
    protected $cateModel;
    protected $goodsModel;
    protected $brandModel;
    public function __construct()
    {
        parent::__construct();
        $this->attrModel=D('Attribute');
        $this->typeModel=D('Type');
        $this->cateModel=D('Category');
        $this->goodsModel=D('Goods');
        $this->brandModel=D('Brand');
        if(!session('uid')){
            $this->error('请先登陆……',U('Login/login'));
        }
    }
}
