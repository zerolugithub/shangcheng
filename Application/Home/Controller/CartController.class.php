<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.30
 * Time: 13:40
 */
namespace Home\Controller;

use Think\Controller;

class CartController extends Controller
{
    public function lst()
    {
        layout('layBuyCart');
        $this->display();
    }
}