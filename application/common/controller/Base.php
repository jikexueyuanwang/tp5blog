<?php

namespace app\common\controller;

use think\Controller;
use think\Request;
use think\Db;

class Base extends Controller
{

    // 初始化操作
    protected function _initialize()
    {
        parent::_initialize();

        // 定义常量user_id
        define('USER_ID' , session('user_id'));

        // 分类列表的变量置换
        $this->assign('menus' ,$this->showMenu());

        // 当前用户选择的cid。变量置换到模板中去
        $this->assign('category_id' , input('param.category_id',''));
    }

    // 用户是否已经登录的检测
    public function checkUserLogin()
    {
        if(!USER_ID)
        {
            $this->error('用户未登录！禁止访问！', url('index/user/login'));
        }
    }

    // 当用户已经登录，无需重复登录
    public function checkLoginStatus()
    {
        if(USER_ID)
        {
            $this->error('用户已经登录，请勿重复登录！', url('index/user/index'));
        }
    }

    // 查询文章分类列表方法
    public function showMenu()
    {
        $map = ['status'=>1];
        return  Db::name('document_category')
            ->where($map)
            ->order('sort' , 'asc')
            ->select();
    }

}
