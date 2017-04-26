<?php
namespace app\index\controller;

use app\common\controller\Base;
use app\common\model\Document;
use think\Db;

class Index extends Base
{
    // 首页
    public function index()
    {
        // 定义全局的查询变量
        $map = ['status'=>1];
        $page_header = '全部文章';

        // 接收用户搜索的关键字
        $keywords = input('param.keywords' , '' , 'trim');
        if($keywords != '')
        {
            $map['title'] = ['like' , '%'.$keywords.'%'];
            $page_header = '关键字：'.$keywords;
        }

        // 分类检索
        $category_id = input('param.category_id' , '');
        if($category_id != '')
        {
            $map['document_category_id'] = $category_id;
            $page_header = '分类名称：'. getCategoryName($category_id);
        }


        // 基本的文章列表查询

        $lists = Db::name('document')
            ->where($map)
            ->order('create_time' , 'desc')
            ->paginate(config('PAGE_NUM_SET'));

        $this->assign('_list' , $lists);
        $this->assign('title' , '博客文章首页列表');
        $this->assign('page_header' , $page_header);
        return $this->fetch();
    }

    // 文章详情页
    public function detail()
    {
        // 获取id并检测参数是否正确
        $id = input('param.id');
        if(!$id)
        {
            $this->error('参数错误！');
        }

        // 数据查询验证
        $map = [
            'id' => $id,
            'status' => 1,
        ];
        $info = Db::name('document')->where($map)->find();
        if($info === null)
        {
            $this->error('文章已经被删除或者参数错误！');
        }

        $is_fav = 0;
        // 判断用户是否已经收藏当前的文章
        if(USER_ID)
        {
            $fav_map = [
                'uid' => USER_ID,
                'document_id' => $info['id']
            ];

            $fav_id = Db::name('document_fav')->where($fav_map)->value('id');
            if($fav_id)
            {
                $is_fav = 1;
            }
        }
        $this->assign('is_fav' , $is_fav);

        // 每次pv+1
        Db::name('document')->where($map)->setInc('pv');

        $this->assign('info' ,$info);
        $this->assign('title' , '详情页-'.$info['title']);
        return $this->fetch();
    }

    // ajax执行收藏/取消收藏的方法
    public function fav()
    {
        // 请求判断
        if(!request()->isAjax())
        {
            return ['status' => 0 , 'msg'=>'参数错误！'];
        }

        // 参数验证
        $document_id = input('param.document_id');
        $uid = input('param.uid');
        if(!$document_id || !$uid)
        {
            return ['status' => 0 , 'msg'=>'参数错误或者用户未登录！'];
        }

        // 执行收藏和取消收藏的操作
        $map = [
            'document_id' => $document_id,
            'uid' => $uid
        ];
        $type = 0;
        $fav_id  = Db::name('document_fav')->where($map)->value('id');
        if($fav_id)
        {
            // 已经收藏过了，执行取消收藏操作
            Db::name('document_fav')->delete($fav_id);
            $type = 0;
        }
        else
        {
            // 未收藏过，进行收藏操作
            Db::name('document_fav')->insert(['document_id'=>$document_id,'uid'=>$uid]);
            $type = 1;
        }

        return ['status' => 1 , 'msg'=>'操作成功！' , 'type' => $type];
    }

    // 发布文章页面
    public function add()
    {
        // 用户未登录不能发布文章
        $this->checkUserLogin();

        // 查询所有的文章分类列表
        $map = ['status'=>1];
        $catesLists = Db::name('document_category')->where($map)->select();

        // 变量置换，内容输出
        $this->assign('catesLists' , $catesLists);
        $this->assign('title' , '文章发布');

        return $this->fetch();
    }

    // 保存文章
    public function save()
    {
        // 实现文章的的发布（带图片上传）
        if(request()->isPost())
        {
            // 1数据获取和数据验证
            $data = input('post.');

            // 2文件信息的获取验证和上传保存
            $file = request()->file('img_path');

            // 条件：文件上传格式的限定大小
            $map = [
                'size' => 1234567,
                'ext' => 'jpg,jpeg,png,gif'
            ];

            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->validate($map)->move(ROOT_PATH . 'public' . DS . 'uploads');

            if($info){
                // 上传成功保存在提交数据中去
                $data['img_path'] = $info->getSaveName();
            }else{
                // 上传失败获取错误信息
                $this->error($file->getError());
            }

            // 3用户发布的文章进行数据库保存操作
            $docModel = new Document();
            if(!$docModel->allowField(true)->validate(true)->save($data))
            {
                $this->error($docModel->getError());
            }

            // 4给用户提示和页面的重定向（首页文章列表）
            $this->success('保存成功',url('index/index/index'));
        }
        $this->error('参数错误！');
    }
}
