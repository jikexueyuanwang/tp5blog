<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:76:"/usr/local/var/www/tp5blog/public/../application/admin/view/index/index.html";i:1493296981;s:78:"/usr/local/var/www/tp5blog/public/../application/admin/view/public/header.html";i:1493294348;s:75:"/usr/local/var/www/tp5blog/public/../application/admin/view/public/nav.html";i:1493294348;s:76:"/usr/local/var/www/tp5blog/public/../application/admin/view/public/left.html";i:1493648892;s:78:"/usr/local/var/www/tp5blog/public/../application/admin/view/public/footer.html";i:1493294313;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title><?php echo (isset($title) && ($title !== '')?$title:'myblog'); ?></title>

    <!-- Bootstrap -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="__ROOT__/static/bootstrap/css/bootstrap.min.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo url('admin/index/index'); ?>"><?php echo config('BLOG_NAME'); ?>内容管理</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php if(!USER_ID): ?>
                <li>
                    <a href="<?php echo url('admin/user/login'); ?>">登录</a>
                </li>
                <?php else: ?>
                <li>
                    <a href="<?php echo url('admin/user/index'); ?>"><?php echo session('user_info.username'); ?></a>
                </li>
                <li>
                    <a href="<?php echo url('admin/user/logout'); ?>">退出登录</a>
                </li>
                <?php endif; ?>


            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked">
    <li class="nav-header">用户管理</li>
    <li role=""
        <?php if($show_type == 'user_list'): ?>class="active"<?php endif; ?>>
        <a href="<?php echo url('index/index'); ?>">用户列表</a>
    </li>
    <!--<li role="" <?php if($show_type == 'fav_list'): ?>class="active"<?php endif; ?>><a href="<?php echo url('index/fav_list'); ?>">收藏管理</a></li>-->
</ul>
<ul class="nav nav-pills nav-stacked">
    <li class="nav-header">文章管理</li>
    <li role="" <?php if($show_type == 'category_list'): ?>class="active"<?php endif; ?>><a href="<?php echo url('index/category_list'); ?>">分类管理</a></li>
    <li role="" <?php if($show_type == 'document_list'): ?>class="active"<?php endif; ?>>
        <a href="<?php echo url('index/document_list'); ?>">文章管理</a>
    </li>
</ul>
<ul class="nav nav-pills nav-stacked">
    <li class="nav-header">系统管理</li>
    <li role="" <?php if($show_type == 'website'): ?>class="active"<?php endif; ?>>
    <a href="<?php echo url('Website/index'); ?>">网站管理</a>
    </li>
</ul>
        </div>
        <div class="col-md-10">

            <ol class="breadcrumb">
                <li><a href="#">用户管理</a></li>
                <li><a href="#">用户列表</a></li>
            </ol>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>UID</th>
                    <th>用户名</th>
                    <th>邮箱</th>
                    <th>手机号</th>
                    <th>IP地址</th>
                    <th>登录时间</th>
                    <th>注册时间</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($_list) || $_list instanceof \think\Collection || $_list instanceof \think\Paginator): $i = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <th scope="row"><?php echo $vo['id']; ?></th>
                    <td><?php echo $vo['username']; ?></td>
                    <td><?php echo (isset($vo['email']) && ($vo['email'] !== '')?$vo['email']:'--'); ?></td>
                    <td><?php echo $vo['mobile']; ?></td>
                    <td><?php echo $vo['ipaddress']; ?></td>
                    <td><?php echo date('Y-m-d H:i' , $vo['update_time']); ?></td>
                    <td><?php echo date('Y-m-d H:i' , $vo['create_time']); ?></td>
                    <td><?php echo getStatusTitle($vo['status']); ?></td>
                    <td>
                        <?php if(config('ADMIN_ID') != $vo['id']): if($vo["status"] == 1): ?>
                                <a href="<?php echo url('index/setUserStatus' , array('id'=>$vo['id'] , 'status' => 0)); ?>">禁用</a>
                            <?php else: ?>
                                <a href="<?php echo url('index/setUserStatus' , array('id'=>$vo['id'] , 'status' => 1)); ?>">启用</a>
                            <?php endif; if($vo["is_admin"] == 1): ?>
                                <a href="<?php echo url('index/setUserAdmin' , array('id'=>$vo['id'] , 'is_admin' => 0)); ?>">取消授权</a>
                            <?php else: ?>
                                <a href="<?php echo url('index/setUserAdmin' , array('id'=>$vo['id'] , 'is_admin' => 1)); ?>">开启授权</a>
                            <?php endif; ?>
                                <a href="<?php echo url('index/setUserStatus' , array('id'=>$vo['id'] , 'status' => -1)); ?>" >删除</a>
                        <?php else: ?>
                            --
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <!--分页-->
            <?php echo $_list->render(); ?>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- <script src="js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="__ROOT__/static/bootstrap/js/bootstrap.min.js"></script>
</body>

<script>
    $(function(){
        // 用户登录
        $('.login_btn').click(function(){

            $.ajax({
                type: 'post',
                url: "<?php echo url('admin/user/doLogin'); ?>",
                data: $(".login_form").serialize(),
                success: function(data) {
                    if(data.status)
                    {
                        $('.err_tips').html(data.msg);
                        setTimeout(function(){
                            // 跳转到后台首页
                            window.location.href = "<?php echo url('admin/index/index'); ?>";
                        },1000);
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
</html>
