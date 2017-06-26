<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.23
 * Time: 19:27
 */
namespace Admin\Model;

use Think\Model;

class AdminModel extends Model
{
    //登陆要求：
    //1.用户名不能为空
    //2.密码不能为空
    //3.验证码不能为空
    //实现动态验证
    public $_login_validate = array(
        array('admin_name' , 'require' , '用户名不能为空') ,
        array('password' , 'require' , '密码不能为空') ,
        array('captcha' , 'require' , '验证码不能为空') ,
        //验证验证码是否正确
        array('captcha' , 'check_verify' , '验证码不正确' , 1 , 'callback') //callback 方法验证，定义的验证规则是当前模型类的一个方法
    );

    public $_admin_validate = array(
        array('admin_name' , 'require' , '用户名不能为空！') ,
        array('admin_name' , '' , '该用户名已存在！' , 0 , 'unique' , 1) ,
        array('password' , 'require' , '密码不能为空！') ,
        array('password' , '/^\w{6.12}$/' , '必须是由数字或字母组成的6-12位密码！' , 0 , 'regex') ,
        array('repassword' , 'password' , '两次输入密码不一致！' , 0 , 'confirm')
    );

    /**
     * 验证验证码是否正确
     * @param  string $code 表单提交的验证码
     * @param string  $id
     * @return bool
     */
    protected function check_verify($code , $id = '')
    {
        $verify = new \Think\Verify();
        return $verify -> check($code , $id);
    }

    /**
     * 验证登陆用户信息是否合法
     * @return bool
     */
    public function checkeLogin()
    {
        //获取用户名和密码
        $admin_name = I('admin_name');
        $password = I('password');
        //验证用户名是否存在
        $is_admin = $this -> where(array('admin_name' => $admin_name)) -> find();
        if ($is_admin) {
            //存在,判断密码是否正确
            $password = md5(md5($password) . $is_admin['salt']);
            if ($password == $is_admin['password']) {
                if (!empty(I('remember'))) {
                    cookie('admin_name' , $admin_name , array('expire' => 3600 , 'prefix' => 'admin_'));
                    cookie('password' , I('password') , array('expire' => 3600 , 'prefix' => 'admin_'));
                }
                session('uid' , $is_admin['id']);
                /*session('admin_name',$is_admin['admin_name']);
                session('password',$is_admin['password']);*/
                //密码正确
                return true;
            } else {
                //密码不正确
                $this -> error = '密码不正确';
                return false;
            }
        } else {
            //不存在
            $this -> error = '用户名不正确或不存在';
            return false;
        }
    }
}