<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:75:"/usr/local/var/www/tp5blog/public/../application/admin/view/user/login.html";i:1493294947;s:78:"/usr/local/var/www/tp5blog/public/../application/admin/view/public/header.html";i:1493294348;s:75:"/usr/local/var/www/tp5blog/public/../application/admin/view/public/nav.html";i:1493294348;s:78:"/usr/local/var/www/tp5blog/public/../application/admin/view/public/footer.html";i:1493294313;}*/ ?>
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

<div class="container">

    <div class="row">

        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="page-header">
                <h3>管理员登录</h3>
            </div>
            <FORM method="post" class="login_form" class="form" style="width: 100%;">

                <div class="form-group">
                    <label for="doc_title">手机号</label>
                    <input type="text" name="mobile" class="form-control" id="doc_title" placeholder="输入您的手机号">
                </div>

                <div class="form-group">
                    <label for="doc_password">密  码</label>
                    <input type="password" name="password" class="form-control" id="doc_password" placeholder="密码">
                </div>
                <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />
                <INPUT type="button" class="btn btn-default login_btn" value="登录">
                <div class="err_tips"></div>
            </FORM>

        </div>
        <div class="col-md-4">

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
