<?php
namespace app\index\controller;

use app\common\controller\Base;
use app\common\model\User as UserModel;

class User extends Base
{
    /**
     * 用户注册展示界面
     */
    public function reg()
    {
        $this->assign('title' , '用户注册');
        return $this->fetch();
    }

    /**
     * ajax处理用户注册
     */
    public function add()
    {
        if(request()->isAjax())
        {
            $user = new UserModel();
            if($user->allowField(true)->validate(true)->save(input('post.')))
            {
                return ['status' => 1 , 'msg'=>'新用户注册成功！'];
            }
            else
            {
                return ['status' => 0 , 'msg'=>$user->getError()];
            }
        }
        return ['status' => 0 , 'msg'=>'未知错误'];
    }

    /**
     * 用户登录界面
     * @return mixed
     */
    public function login()
    {
        $this->checkLoginStatus();
        return $this->fetch();
    }

    /**
     * 用户登录方法
     */
    public function doLogin()
    {
        if(request()->isAjax())
        {
            $user = new UserModel();
            return $user->checkUserLogin(input('param.'));
        }
        return ['status' => 0];
    }

    /**
     * 用户中心
     * @return mixed
     */
    public function index()
    {
        $this->checkUserLogin();
        return $this->fetch();
    }

    /**
     * 用户注销登录
     */
    public function logout()
    {
        session('user_id' ,null);
        session('user_info' , null);
        $this->success('注销成功！' , url('index/user/login'));
    }
}