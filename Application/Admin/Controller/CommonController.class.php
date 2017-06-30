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
    public function _initialize()
    {
        $this->attrModel=D('Attribute');
        $this->typeModel=D('Type');
        $this->cateModel=D('Category');
        $this->goodsModel=D('Goods');
        $this->brandModel=D('Brand');
        if(!session('uid')){
            $this->error('请先登陆……',U('Login/login'));
        }else{
            if(session('admin_name')=='admin'){
                //超级管理员不需要验证
                return true;
            }
            if(CONTROLLER_NAME=='Index'){
                //首页不做权限验证
                return true;
            }
            //获取当前地址url
            $currentUrl = strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME);
            //获取登陆用户拥有的权限
            /*$sql="SELECT c.module_name,c.controller_name,c.action_name from mall_admin_role a
                  LEFT JOIN mall_role_privilege b on a.role_id=b.role_id
                  LEFT JOIN mall_privilege c ON b.priv_id = c.id
                  where a.admin_id=2";*/
            $userUrls =M('AdminRole')->field("concat(c.module_name,'/',c.controller_name,'/',c.action_name) as url")->join("a LEFT JOIN mall_role_privilege b on a.role_id=b.role_id")->join("LEFT JOIN mall_privilege c ON b.priv_id = c.id")->where(array('a.admin_id'=>session('uid'),'c.pid'=>array('neq',0)))->select();
            foreach($userUrls as $key=>$val){
                $userUrlsArr[]=strtolower($val['url']);
            }
            if(!in_array($currentUrl,$userUrlsArr)){
                $this->error('用户没有权限访问，如需访问请联系管理员……');
            }
        }

    }
}
