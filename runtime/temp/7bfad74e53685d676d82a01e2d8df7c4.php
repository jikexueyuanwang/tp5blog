<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:77:"/usr/local/var/www/tp5blog/public/../application/index/view/index/detail.html";i:1493650449;s:78:"/usr/local/var/www/tp5blog/public/../application/index/view/public/header.html";i:1493650059;s:75:"/usr/local/var/www/tp5blog/public/../application/index/view/public/nav.html";i:1493650089;s:77:"/usr/local/var/www/tp5blog/public/../application/index/view/public/right.html";i:1493208573;s:78:"/usr/local/var/www/tp5blog/public/../application/index/view/public/footer.html";i:1493207842;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title><?php echo $website['webname']; ?>-<?php echo (isset($title) && ($title !== '')?$title:$website['webname']); ?></title>

    <!-- Bootstrap -->
    <link href="__STATIC__/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body><nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo url('index'); ?>"><?php echo $website['webname']; ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li
                    <?php if(!$category_id): ?>
                    class="active"
                    <?php endif; ?>
                ><a href="<?php echo url("","",true,false);?>">全部文章</a></li>
                <?php if(is_array($menus) || $menus instanceof \think\Collection || $menus instanceof \think\Paginator): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li
                    <?php if($vo['id'] == $category_id): ?>
                    class="active"
                    <?php endif; ?>
                    ><a href="<?php echo url('index/index',array('category_id'=>$vo['id'])); ?>"><?php echo $vo['name']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form action="<?php echo url('index'); ?>" method="get" class="navbar-form navbar-left">
                        <div class="form-group">
                            <input name="keywords" type="text" class="form-control" placeholder="请输入你的关键字">
                        </div>
                        <button type="submit" class="btn btn-default">搜索</button>
                    </form>
                </li>
                <?php if(!USER_ID): ?>
                    <li class=""><a href="<?php echo url('User/login'); ?>">登录</a></li>
                    <li><a href="<?php echo url('User/reg'); ?>">注册</a></li>
                <?php else: ?>
                    <li class=""><a href="<?php echo url('Index/add'); ?>">发布文章</a></li>
                    <li><a href="<?php echo url('User/index'); ?>">
                        <?php echo session('user_info.username'); ?>
                    </a>
                    </li>
                    <li><a href="<?php echo url('User/logout'); ?>">退出登录</a></li>
                <?php endif; ?>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<div class="container">

    <div class="row">

        <div class="col-md-8">
            <div class="page-header">
                <h3><?php echo $info['title']; ?></h3>
            </div>
            <p>发布人：<?php echo getUserName($info['uid']); ?>&nbsp;&nbsp;
                发布时间：<?php echo date('Y-m-d H:i:s',$info['create_time']); ?>&nbsp;&nbsp;
                访问量：<?php echo $info['pv']; ?>
            </p>
            <div><?php echo $info['content']; ?></div>
            <hr>
            <div>
                <?php if($is_fav == 1): ?>
                <a class="btn btn-info fav_btn" uid="<?php echo USER_ID; ?>" document_id="<?php echo $info['id']; ?>">已收藏</a>

                <?php else: ?>
                <a class="btn btn-default fav_btn" uid="<?php echo USER_ID; ?>" document_id="<?php echo $info['id']; ?>">收藏</a>

                <?php endif; ?>
            </div>

            <hr>
            <?php if($website['is_comment'] == 1): ?>
            <h4>文章评论</h4>
            <?php if(!USER_ID): ?>
            <p>请<a href="<?php echo url('index/user/login'); ?>">登录</a>后再发布评论</p>
            <?php else: ?>
            <form class="comment_form" >
                <input type="hidden" name="uid" value="<?php echo USER_ID; ?>"/>
                <input type="hidden" name="document_id" value="<?php echo $info['id']; ?>"/>
                <textarea class="form-control" rows="3" name="content" placeholder="编写评论内容"></textarea>
                <input type="button" class="btn btn-default submit_comment" value="发表评论">
                <div class="err_tips"></div>
            </form>
            <?php endif; ?>

            <div style="margin-top: 10px;" class="show_comment_list">
                正在加载中...
            </div>
            <script>

                // 异步加载文章的评论列表
                function loadCommentList(doc_id , page)
                {
                    if(doc_id)
                    {
                        $.get("<?php echo url('getDocCommentList'); ?>",{
                            doc_id:doc_id,
                            page:page,
                            time:new Date().getTime()
                        },function(msg){
                            $('.show_comment_list').html(msg);
                        });
                    }
                }

                // 文章每次刷新（加载）都执行此方法
                loadCommentList("<?php echo $info['id']; ?>" , "<?php echo input('param.page' , 1); ?>");
            </script>

            <?php else: ?>
            评论功能未开放
            <?php endif; ?>

        </div>
        <div class="col-md-4">
    <div class="page-header">
        <h3>热门动态</h3>
    </div>
    <ul class="list-group">
        <?php if(is_array($doc_time_list) || $doc_time_list instanceof \think\Collection || $doc_time_list instanceof \think\Paginator): $i = 0; $__LIST__ = $doc_time_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li><a href="<?php echo url('index/index/index',array('publish_date'=>$vo['publish_date'])); ?>"><?php echo $vo['publish_date']; ?>&nbsp;(<?php echo $vo['doc_num']; ?>)</a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="__STATIC__/wangEditor/js/wangEditor.min.js"></script>
<script src="__STATIC__/bootstrap/js/bootstrap.min.js"></script>

<script>
    $(function(){

        // 初始化富文本编辑
        var _public_content = $('#public_content');
        if(_public_content.attr('id') != undefined)
        {
            // 发布文章初始化富文本插件
            var editor = new wangEditor('public_content');
            editor.create();
        }


        // 用户注册提交
        $('.reg_btn').click(function(){

            $.ajax({
                type: 'post',
                url: "<?php echo url('index/user/add'); ?>",
                data: $(".reg_form").serialize(),
                success: function(data) {
                    if(data.status)
                    {
                        $('.err_tips').html(data.msg);
                        setTimeout(function(){
                            window.location.href = "<?php echo url('index/user/login'); ?>";
                        },1000);
                    }
                    else
                    {
                        $('.err_tips').html(data.msg);
                    }
                }
            });
        });

        // 用户登录
        $('.login_btn').click(function(){

            $.ajax({
                type: 'post',
                url: "<?php echo url('index/user/doLogin'); ?>",
                data: $(".login_form").serialize(),
                success: function(data) {
                    console.log(data);
                    if(data.status)
                    {
                        $('.err_tips').html(data.msg);
                        setTimeout(function(){
                            window.location.href = "<?php echo url('index/user/index'); ?>";
                        },1000);
                    }
                    else
                    {
                        $('.err_tips').html(data.msg);
                    }
                }
            });
        })

        // 用户文章收藏
        $('.fav_btn').click(function(){

            var _uid = $(this).attr('uid');
            var _document_id = $(this).attr('document_id');

            var _self = $(this);

            // 用户登录的情况下进行收藏/取消收藏的操作
            if(_uid && _document_id)
            {
                $.post(
                    "<?php echo url('index/index/fav'); ?>",
                    {
                        uid:_uid,
                        document_id:_document_id,
                        time:new Date().getTime()
                    },
                    function(msg){
                        if(msg.status)
                        {
                            if(msg.type == 1)
                            {
                                _self.text('已收藏');
                                _self.attr('class' , 'btn btn-info fav_btn');
                            }
                            else
                            {
                                _self.text('收藏');
                                _self.attr('class' , 'btn btn-default fav_btn');
                            }


                        }
                        else
                        {
                            alert(msg.msg);
                        }

                    });
            }
        })

        // 发表评论
        $('.submit_comment').click(function(){
            var doc_id = $(".comment_form").find('input[name="document_id"]').val();
            $.ajax({
                type: 'post',
                url: "<?php echo url('index/index/add_comment'); ?>",
                data: $(".comment_form").serialize(),
                success: function(data) {
                    if(data.status == 1)
                    {
                        $('.err_tips').html(data.msg);
                        // 更新评论的列表
                        loadCommentList(doc_id);
                    }
                    else
                    {
                        $('.err_tips').html(data.msg);
                    }
                }
            });
        })
    })
</script>
</body>
</html>
