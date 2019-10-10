<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="c404">
    <div class="error-page">
        <p><i class="fa fa-street-view"></i></p>
        <h2><?php _e('你想查看的页面已被转移或删除了, 要不要搜索看看: '); ?></h2>
        <!-- 搜索域 -->
        <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
            <label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
            <input type="text" id="s" name="s" class="text" placeholder="<?php _e('搜索'); ?>" />
            <button type="submit" class="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<!-- end #content-->
<?php $this->need('footer.php'); ?>