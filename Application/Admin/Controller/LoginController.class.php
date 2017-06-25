<?php
/**
 * Created by PhpStorm.
 * User: zhf
 * Date: 2017.06.23
 * Time: 15:54
 */
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
    public function login()
    {
        if (IS_POST) {
            $adminModel = D('Admin');
            $re = $adminModel -> validate($adminModel -> _login_validate) -> create();
            if ($re) {
                //判断用户名和密码是否正确
                $res = $adminModel -> checkeLogin();
                if ($res) {
                    $this -> success('登陆成功' , U('index/index'));
                    exit;
                } else {
                    $this -> error($adminModel -> getError());
                }
            } else {
                //验证失败
                $this -> error($adminModel -> getError());
            }
        }
        $this -> display();
    }

    //生成验证码
    public function captcha()
    {
        $config = array(
            'fontSize' => 14 ,    // 验证码字体大小
            'length'   => 4 ,     // 验证码位数
            'useNoise' => false , // 关闭验证码杂点
            'useCurve' => false ,            // 是否画混淆曲线
            'imageH'   => 25 ,
            'imageW'   => 146 ,
            'fontttf'  => '' ,              // 验证码字体，不设置随机获取
        );
        $Verify = new \Think\Verify($config);
        return $Verify -> entry();
    }

    public function logout()
    {
        session(null);
        if (!session('uid')) {
            $this -> success('安全退出' , U('login'));
        }
    }
}

