<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">

<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <!-- 网站图标 -->
    <link rel="shortcut icon" href="<?php $this->options->themeUrl('./img/favicon.ico'); ?>" type="image/x-icon" />
    <!-- 样式文件 -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('./css/style.css'); ?>" />
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(
                'category'  =>  _t('分类 %s 下的文章'),
                'search'    =>  _t('包含关键字 %s 的文章'),
                'tag'       =>  _t('标签 %s 下的文章'),
                'author'    =>  _t('%s 发布的文章')
            ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <!-- 使用url函数转换相关路径 -->

    <!--[if lt IE 9]>
    <script src="//cdnjscn.b0.upaiyun.com/libs/html5shiv/r29/html5.min.js"></script>
    <script src="//cdnjscn.b0.upaiyun.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
</head>

<body>
    <!--[if lt IE 8]>
    <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
<![endif]-->

    <!-- 小屏折叠 -->
    <span class="minilize-fold"><i class="fa fa-fw fa-bars"></i></span>

    <!-- 左侧导航 -->
    <div class="left-nav">

        <!-- 主人信息 -->
        <div class="blogger">
            <div><img src="<?php $this->options->logoUrl() ?>"></div>
            <p class="ellipse"><?php $this->options->yourname() ?></p>
        </div>


        <!-- 搜索域 -->
        <div class="search">
            <form method="post" id="search" action="<?php $this->options->siteUrl(); ?>">
                <label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
                <input type="text" id="s" name="s" class="text" placeholder="<?php _e('搜索'); ?>" autocomplete="off" />
                <button type="submit" class="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <!-- 导航 -->
        <nav>
            <ul class="nav">
                <div class="ninja"></div>
                <li>
                    <a <?php if ($this->is('index')) : ?> class="active" <?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><i class="fa fa-fw fa-home"></i><span><?php _e('首页'); ?></span></a>
                </li>
                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                <?php while ($pages->next()) : ?>
                    <li>
                        <a <?php if ($this->is('page', $pages->slug)) : ?> class="active" <?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><i class="fa-fw <?php $pages->fields->fontawesome(); ?>"></i><span><?php $pages->title(); ?></span></a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </nav>

    </div>
    <!-- 中间sidebar -->
    <?php $this->need('sidebar.php'); ?>
    <!-- 右侧app -->
    <div id="app">