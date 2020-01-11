<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div id="sidebar">
    <span class="change-card"><i class="fa fa-angle-right"></i></span>
    <!-- 一言 -->
    <div class="flag">
        <?php if (!empty($this->options->labs) && in_array('showYiyan', $this->options->labs)) : ?>
            <div>
                <h3 class="motto yiyan"><span>一言：</span></h3>
            </div>
        <?php else : ?>
            <div>
                <?php if ($this->options->motto != '') : ?>
                    <h3 class="motto"><?php $this->options->motto() ?></h3>
                <?php else : ?>
                    <h3 class="motto">你的座右铭将会出现在这里</h3>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="loop">
        <!-- 分类 -->
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowCategory', $this->options->sidebarBlock)) : ?>
            <section class="widget cate-list">
                <p class="widget-title"><i class="fa fa-leaf"></i><span><?php _e('CATEGORY'); ?></span></p>
                <?php $obj = $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list') ?>
            </section>
        <?php endif; ?>

        <!-- 最新文章 -->
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentPosts', $this->options->sidebarBlock)) : ?>
            <section class="widget">
                <p class="widget-title"><i class="fa fa-list-ol"></i><span><?php _e('RECENT'); ?></span></p>
                <ul class="widget-list">
                    <?php $obj = $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000') ?>
                    <?php if ($obj->have()) : ?>
                        <?php while ($obj->next()) : ?>
                            <?php if ($obj->password == NULL) : ?>
                                <li class="recent">
                                    <a class="content" href="<?php $obj->permalink(); ?>">
                                        <p class="article-name"><?php subText($obj->title, 10) ?></p>
                                        <p class="read-time"><i class="fa fa-fw fa-clock-o"></i>阅读<?php readTime($obj->cid); ?> <?php art_count($obj->cid); ?>字</p>
                                        <p class="article-text ellipse"> <?php echo subText($obj->text, 40) ?></p>
                                    </a>
                                    <span class="modified-time"><?php diffTime($obj->modified) ?></span>
                                </li>
                            <?php else : ?>
                                <li class="recent locked">
                                    <a class="content" href="<?php $obj->permalink(); ?>">
                                        <?php if ($obj->hidden) : ?>
                                            <p class="article-name"><i class="fa fa-fw fa-lock"></i><?php subText($obj->title, 10) ?></p>
                                        <?php else : ?>
                                            <p class="article-name"><i class="fa fa-fw fa-unlock"></i><?php subText($obj->title, 10) ?></p>
                                        <?php endif; ?>
                                    </a>
                                    <span class="modified-time"><?php diffTime($obj->modified) ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php else : ?>
                    <?php endif; ?>
                </ul>
            </section>
        <?php endif; ?>

        <!-- 评论 -->
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)) : ?>
            <section class="widget">
                <p class="widget-title"><i class="fa fa-commenting-o"></i><span><?php _e('COMMENTS'); ?></span></p>
                <ul class="widget-list">
                    <?php $obj = $this->widget('Widget_Comments_Recent', 'pageSize=10000')->to($comments);  ?>
                    <?php if ($obj->have()) : ?>
                        <? while ($obj->next()) : ?>
                            <li class="comment-info">
                                <a href="<?php $obj->permalink(); ?>" class="comment-view">
                                    <div>
                                        <span class="comment-author" data-ip="<?php echo $obj->ip ?>"><?php nameToImg($obj->author) ?></span>
                                        <span class="comment-time"><?php diffTime($obj->created) ?></span>
                                    </div>
                                    <p>回复:<?php subText($obj->text, 40) ?></p>
                                    <p><span>《<?php subText($obj->title, 20) ?>》</span></p>
                                </a>
                            </li>
                        <? endwhile; ?>
                    <? else : ?>
                    <?php endif; ?>
                </ul>
            </section>
        <?php endif; ?>

        <!-- 归档 -->
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowArchive', $this->options->sidebarBlock)) : ?>
            <section class="widget">
                <p class="widget-title"><i class="fa fa-archive"></i><span><?php _e('ARCHIVE'); ?></span></p>
                <ul class="widget-list archive-list clearfix">
                    <?php $obj = $this->widget('Widget_Contents_Post_Date', 'format=Y-m&type=month&limit=10')
                            ->parse('<li><a href="{permalink}"><p>{date}月</p><p><span>{count}篇</span></p></a></li>'); ?>
                </ul>
            </section>
        <?php endif; ?>

    </div>
</div><!-- end #sidebar -->
