<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<!-- 点击分类显示 -->
<div id="archive">
    <h3 class="archive-title"><?php $this->archiveTitle(array(
                                    'category'  =>  _t('分类 %s 下的文章'),
                                    'search'    =>  _t('包含关键字 %s 的文章'),
                                    'tag'       =>  _t('标签 %s 下的文章'),
                                    'author'    =>  _t('%s 发布的文章')
                                ), '', ''); ?></h3>
    <?php if ($this->have()) : ?>
        <ul class="archive-list article-strip">
            <li class="strip-title">
                <span class="time ellipse">Date</span>
                <span class="title">Title</span>
                <span class="words ellipse">Views</span>
                <span class="category ellipse">Comments</span>
            </li>
            <?php while ($this->next()) : ?>
                <li>
                    <span class="time ellipse"><time datetime="<?php $this->date('Y年m月d日 H:i'); ?>"><?php $this->date('Y/m/d'); ?></time></span>
                    <span class="title ellipse">
                        <i class="fa fa-file"></i>
                        <a href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                    </span>
                    <span class="words ellipse"><?php get_post_view($this) ?></span>
                    <span class="category ellipse"><?php $this->commentsNum('0', '1', '%d'); ?></span>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <article class="no-content">
            <p><i class="fa fa-fw fa-exclamation-triangle"></i></p>
            <h2><?php _e('Oops!内容被小怪兽吃掉了～'); ?></h2>
        </article>
    <?php endif; ?>

    <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
</div><!-- end #main -->

<?php $this->need('footer.php'); ?>