-- Adminer 4.3.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `db_document`;
CREATE TABLE `db_document` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `img_path` varchar(200) NOT NULL,
  `is_hot` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `is_top` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `document_category_id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `pv` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `db_document` (`id`, `img_path`, `is_hot`, `is_top`, `document_category_id`, `uid`, `title`, `content`, `pv`, `status`, `create_time`, `update_time`) VALUES
(14,	'20170419/d92c175d4ddae0526c4b676fb4589ed0.png',	0,	0,	2,	15,	'测试发布文章内容',	'<p><b>测试是否可以发布</b></p><p><img src=\"http://img.t.sinajs.cn/t35/style/images/common/face/ext/normal/0b/tootha_thumb.gif\"><b><br></b></p><p><br></p>',	2,	1,	1492606397,	1492606397),
(16,	'20170423/d8f1ec8e6afcb43ab3a8871b5385944d.png',	0,	0,	1,	19,	'测试文章发布标题',	'111',	0,	1,	1492921530,	1492921530),
(17,	'20170423/a938f4d02f1e0516a20da07d8098be3d.png',	0,	0,	1,	19,	'121212',	'<p><b><u>121212</u></b></p><p><br></p>',	0,	1,	1492921960,	1492921960),
(18,	'20170423/b9c32a0339d1eb6df132f9c700422c51.png',	0,	0,	1,	19,	'数码的新文章',	'<p>1111</p>',	62,	1,	1492929068,	1492929068),
(19,	'20170426/b709abdfcbb44e695808e8fb1d4a8faf.png',	0,	0,	1,	19,	'今天是26号',	'<p>121212</p>',	4,	1,	1493208648,	1493208648),
(10,	'20170418/fca191bc82ef22d87a2de1f93c0f8f7d.png',	0,	0,	2,	16,	'php加密扩展 zoeeyguard window编译指南',	'<p>-------1.</p><p>下载 对应php版本的 二进制 和 源码文件.</p><p>下载 zoeeyguard 加密模块源码</p><p><br></p><p>-------2.安装cygwin</p><p>生成php扩展模块骨架代码是ext_skel脚本</p><p>ext_skel是创建扩展的shell，在windows上无法运行，所以就必须要有Cygwin。</p><p><br><br></p><p>如果你的cygwin没有安装在c:\\cygwin，进入php源码包\\ext目录下,修改ext_skel_win32.php :&nbsp;</p><p>&nbsp; $cygwin_path = \'c:\\cygwin\\bin\';&nbsp;</p><p>修改为你的cygwin目录&nbsp;</p><p>&nbsp; $cygwin_path = \'d:\\cygwin\\bin\';&nbsp;</p><p><br><br></p><p>----------3.下载2个工具</p><p><br></p><p>a）PHP 站点中的 win32 编译工具 » http://www.php.net/extra/win32build.zip</p><p><br></p><p>b）PHP 使用的 DNS 解析器的源代码：» http://www.php.net/extra/bindlib_w32.zip（将这个进行编译，然后替换win32build.zip中的resolv.lib）</p><p><br></p><p>3.1</p><p><br></p><p>将php和上述两个工具全部解压至1的目录中，最后的层次应该是这样的，如下图：</p><p><br></p><p>project</p><p>&nbsp;&nbsp;</p><p>--app</p><p>&nbsp;&nbsp;&nbsp;&nbsp;</p><p>--bindlib_w32</p><p>&nbsp;&nbsp;&nbsp;&nbsp;</p><p>--win32build</p><p>&nbsp;&nbsp;&nbsp;&nbsp;</p><p>--php源代码xxxx</p><p>&nbsp;&nbsp;&nbsp;&nbsp;</p><p>--php二进制代码xxx</p><p>【编译resovle.lib】</p><p><br></p><p>3.2</p><p>打开VC++，打开 bindlib_w32/app/bindlib.dsw, 然后直接build（F7），然后在他的DEBUG目录下面找到resolv.lib，</p><p>复制，粘贴到 project/app/win32build/lib，替换。</p><p><br><br><br><br></p><p>-----------4--------------</p><p><br></p><p>创建 config.w32.h 文件</p><p>project/app/php源代码xxxx/buildconf.bat</p><p><br></p><p>//vc6设置环境 把vc 里面的 cl.exe 的所在目录加入到 path 系统变量中</p><p>set path=%path%;D:\\Program Files\\Microsoft Visual Studio\\VC98\\Bin</p><p><br><br></p><p>//vc9(2008)设置环境</p><p>set path=%path%;D:\\Program Files\\Microsoft Visual Studio\\Common\\MSDev98\\Bin;D:\\Program Files\\Microsoft Visual Studio 9.0\\VC\\bin</p><p>set path=%path%;D:\\Program Files\\Microsoft Visual Studio 9.0\\Common7\\IDE</p><p><br><br></p><p>project/app/php源代码xxxx/cscript /nologo configure.js --with-php-build=\"../win32build\" --without-libxml &nbsp;--disable-odbc</p><p><br><br></p><p>-----------5------------</p><p><br></p><p>生成 php扩展模块 zoeeyguard 骨架代码</p><p>进入命令行模式 cmd</p><p>cd xxx/project/app/php源代码xxxx/ext</p><p>project/app/php二进制代码xxx/php.exe ext_skel_win32.php --extname=zoeeyguard</p><p><br></p><p>(如果运行失败可能是cygwin安装不完整</p><p>说明你的 cygwin 安装不完整。要是没报错你的myhello扩展就创建成功了。这就是一个简单的扩展框架，用纯c语言编写。)&nbsp;</p><p><br><br><br></p><p>----------- 6 -----------</p><p><br></p><p>拷贝zoeeyguard 源码 src 目录下的文件 到&nbsp;</p><p>cd xxx/project/app/php源代码xxxx/ext/zoeeyguard</p><p>打开骨架代码生成的c++工程文件 zoeeyguard.dsp&nbsp;</p><p><br></p><p>文件视图</p><p><br></p><p>选中 Source Files &nbsp;-&gt; 添加文件到目录 -&gt;选中缺失的.c文件</p><p>选中 Header Files &nbsp;-&gt; 添加文件到目录 -&gt;选中缺失的.h文件</p><p><br><br></p><p>顶部 -&gt; 工具 -&gt;选项 -&gt;目录 -&gt; 点中目录(Library files) -&gt; 找到php5ts.lib的目录(一般在二进制包中的dev目录)</p><p><br><br></p><p>缺少php5ts_debug.lib,所以要移除 debug 配置</p><p>顶部 -&gt; 组建 -&gt;设置 -&gt; 选中 DeBUG -&gt;移除</p><p><br></p><p>F7 开始组建</p><p><br><br></p><p>-------------7---------------</p><p><br></p><p>其他错误帮助</p><p><br></p><p>1.扩展加载错误，</p><p><br></p><p>vc版本不一样</p><p><br></p><p>可以修改 php源码包的 php_stream_transport.h 里面加一行,定义PHP_COMPILER_ID=\"vc9\"就把apache忽弄过去了。</p><p><br></p><p>#define PHP_COMPILER_ID \"VC9\"</p><p><br><br></p><p>2.VC6无法包含文件</p><p><br></p><p>可以手工修改&nbsp;xsguard.dsp 文件</p><p><br></p><p>SOURCE=.\\xx1.h</p><p><br></p><p>SOURCE=.\\xx2.h</p><p><br></p><p>SOURCE=.\\xx3.h</p><p><br></p><p>--------------------</p><p><br></p><p>SOURCE=.\\xx1.c</p><p><br></p><p>SOURCE=.\\xx2.c</p><p><br></p><p>SOURCE=.\\xx3.c</p><p><br></p>',	16,	1,	1490145113,	1490145113),
(11,	'20170418/fca191bc82ef22d87a2de1f93c0f8f7d.png',	0,	0,	2,	16,	'ThinkPHP5如何更新数据',	'<h2>更新数据表中的数据</h2><pre><code>Db::table(\'think_user\')\r\n    -&gt;where(\'id\', 1)\r\n    -&gt;update([\'name\' =&gt; \'thinkphp\']);</code></pre><p>如果数据中包含主键，可以直接使用：</p><pre><code>Db::table(\'think_user\')\r\n    -&gt;update([\'name\' =&gt; \'thinkphp\',\'id\'=&gt;1]);</code></pre><blockquote>update 方法返回影响数据的条数，没修改任何数据返回 0</blockquote><p>如果要更新的数据需要使用SQL函数或者其它字段，可以使用下面的方式：</p><p></p><pre><code><span><span>Db</span>:<span>:<span>table</span>(<span>\'think_user\'</span>)\r\n    -&gt;<span>where</span>(<span>\'id\'</span>, <span>1</span>)\r\n    -&gt;<span>update</span>([\r\n        <span>\'login_time\'</span>  =&gt; [<span>\'exp\'</span>,<span>\'now()\'</span>],\r\n        <span>\'login_times\'</span> =&gt; [<span>\'exp\'</span>,<span>\'login_times+1\'</span>],\r\n    ])</span></span>;</code></pre><p><br></p>',	42,	1,	1490146291,	1490146291),
(13,	'20170419/8ac487ca4f383c07c1d8471868b5b924.png',	0,	0,	1,	15,	'测试如何发布文章',	'<p>1111</p>',	5,	1,	1492605789,	1492605789);

DROP TABLE IF EXISTS `db_document_category`;
CREATE TABLE `db_document_category` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sort` int(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `db_document_category` (`id`, `uid`, `name`, `sort`, `status`, `create_time`, `update_time`) VALUES
(1,	21,	'数码1',	1,	1,	0,	1493300557),
(2,	1,	'PHP',	2,	1,	0,	0),
(3,	19,	'1',	2,	0,	1493124355,	1493124355),
(4,	19,	'222摄影1',	3,	-1,	1493124381,	1493124636),
(5,	21,	'新的分类',	111,	1,	1493300692,	1493300692),
(6,	21,	'testtest',	2,	-1,	1493301263,	1493301281);

DROP TABLE IF EXISTS `db_document_comments`;
CREATE TABLE `db_document_comments` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `document_id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `content` text NOT NULL,
  `reply_id` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `db_document_comments` (`id`, `document_id`, `uid`, `content`, `reply_id`, `status`, `create_time`, `update_time`) VALUES
(1,	11,	19,	'12121212121212',	0,	1,	1490233261,	1490233261),
(2,	16,	19,	'111111111',	0,	1,	1490233876,	1490233876),
(3,	11,	19,	'22222',	0,	1,	1490233905,	1490233905),
(4,	18,	19,	'11122222',	0,	1,	1493205229,	1493205229),
(5,	18,	19,	'1212121',	0,	1,	1493206359,	1493206359),
(6,	18,	19,	'这是刚发布的数据',	0,	1,	1493206388,	1493206388),
(7,	18,	19,	'发布一个最新的评论',	0,	1,	1493206668,	1493206668),
(8,	18,	19,	'还拿等哈哈大我还得',	0,	1,	1493206683,	1493206683),
(9,	18,	19,	'这里是一个文章评论！',	0,	1,	1493206912,	1493206912),
(10,	18,	19,	'这个文章什么都没有！',	0,	1,	1493207270,	1493207270),
(11,	18,	19,	'new comment',	0,	1,	1493207790,	1493207790),
(12,	18,	19,	'new message!!',	0,	1,	1493207851,	1493207851),
(13,	18,	19,	'new message!!',	0,	1,	1493207884,	1493207884),
(14,	18,	19,	'new message!!',	0,	1,	1493207885,	1493207885),
(15,	18,	19,	'new message!!',	0,	1,	1493207885,	1493207885),
(16,	18,	19,	'new message!!',	0,	1,	1493207885,	1493207885),
(17,	18,	19,	'new message!!',	0,	1,	1493207885,	1493207885),
(18,	18,	19,	'new message!!',	0,	1,	1493207885,	1493207885),
(19,	18,	19,	'123',	0,	-1,	1493208022,	1493208022),
(20,	18,	19,	'123',	0,	-1,	1493208101,	1493208101),
(21,	18,	19,	'jikexueyuan',	0,	-1,	1493208113,	1493208113),
(22,	18,	19,	'1212121212',	0,	-1,	1493208413,	1493208413),
(23,	19,	19,	'可以发布评论！',	0,	1,	1493650470,	1493650470);

DROP TABLE IF EXISTS `db_document_fav`;
CREATE TABLE `db_document_fav` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `document_id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `db_document_fav` (`id`, `document_id`, `uid`) VALUES
(21,	18,	19);

DROP TABLE IF EXISTS `db_document_support`;
CREATE TABLE `db_document_support` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `document_id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `db_user`;
CREATE TABLE `db_user` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `is_admin` int(4) unsigned NOT NULL DEFAULT '0',
  `ipaddress` varchar(100) NOT NULL DEFAULT '0',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `db_user` (`id`, `is_admin`, `ipaddress`, `username`, `password`, `mobile`, `email`, `status`, `create_time`, `update_time`) VALUES
(21,	1,	'0',	'wjl11111',	'9db06bcff9248837f86d1a6bcf41c9e7',	'13522222222',	'admin@admin.com',	1,	1493297113,	1493297113),
(20,	1,	'0',	'wangjialin',	'9db06bcff9248837f86d1a6bcf41c9e7',	'13511111111',	'admin@admin.com',	-1,	1493295104,	1493295104),
(19,	1,	'0',	'admin',	'9db06bcff9248837f86d1a6bcf41c9e7',	'11111111111',	'123@123.com',	1,	1492782635,	1492782635);

DROP TABLE IF EXISTS `db_website`;
CREATE TABLE `db_website` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `webname` varchar(100) NOT NULL,
  `webkeywords` text NOT NULL,
  `is_open` tinyint(4) NOT NULL DEFAULT '1',
  `is_comment` tinyint(4) NOT NULL DEFAULT '1',
  `is_reg` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `db_website` (`id`, `webname`, `webkeywords`, `is_open`, `is_comment`, `is_reg`, `status`, `create_time`, `update_time`) VALUES
(1,	'我的网站',	'1212121212',	1,	1,	0,	0,	0,	1493650462);

-- 2017-05-01 15:01:07
