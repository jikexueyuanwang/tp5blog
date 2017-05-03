<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"/usr/local/var/www/tp5blog/public/../application/index/view/index/getdoccommentlist.html";i:1493208237;}*/ ?>
<?php if(empty($comment_list) || (($comment_list instanceof \think\Collection || $comment_list instanceof \think\Paginator ) && $comment_list->isEmpty())): ?>
    暂无评论
<?php else: if(is_array($comment_list) || $comment_list instanceof \think\Collection || $comment_list instanceof \think\Paginator): $i = 0; $__LIST__ = $comment_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <div>ID:<?php echo $vo['id']; ?></div>
        <div>评论用户:<?php echo getUserName($vo['uid']); ?></div>
        <div>评论时间:<?php echo date('Y-m-d H:i' , $vo['create_time']); ?></div>
        <p><?php echo $vo['content']; ?></p>
        <hr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <?php echo $comment_list->render(); endif; ?>