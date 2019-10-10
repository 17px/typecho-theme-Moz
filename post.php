<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<!-- 文章页 -->
<div id="post">
    <article class="post-card">
        <h1 class="post-title" itemprop="name headline"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
        <p class="post-time">
            <i class="fa fa-fw fa-clock-o"></i>
            <time datetime="<?php $this->date('c'); ?>"><?php $this->date('Y年m月d日 H:i'); ?></time>
            <span><i class="fa fa-fw fa-eye"></i><?php get_post_view($this) ?></span>
            <span>分类: <?php $this->category(','); ?></span>
        </p>
        <div id="post-toc" class="post-content markdown-body"><?php $this->content(); ?></div>
        <p class="tags"><span>#</span><?php $this->tags(', ', true, 'none'); ?></p>
        <ul class="post-meta clearfix">
            <li><span>更新于: <?php echo date('Y年m月d日 H:i', $this->modified) ?></span></li>
        </ul>
        <?php if (!empty($this->options->labs) && in_array('showCopyright', $this->options->labs)) : ?>
            <!-- 版权声明 -->
            <section class="post-copyright">
                <p class="author">作者: <?php $this->author(); ?></p>
                <p class="link">链接: <a href="<?php $this->permalink(); ?>"><?php $this->permalink(); ?></a></p>
                <p class="protocal">版权: 除特别声明,均采用<a href="https://creativecommons.org/licenses/by-nc-sa/4.0/">BY-NC-SA 4.0</a>许可协议,转载请表明出处</p>
            </section>
        <?php endif; ?>
    </article>
    <ul class="post-near clearfix">
        <li><i class="fa fa-fw fa-angle-left"></i><?php $this->thePrev('%s', '无'); ?></li>
        <li><?php $this->theNext('%s', '无'); ?><i class="fa fa-fw fa-angle-right"></i></li>
    </ul>


    <div id="contentTree" class="contentTree-a">
        <span class="asideOpe"><i class="fa fa-angle-double-left"></i></span>
        <p>目录<span>Content</span></p>
        <div id="toc"></div>
    </div>
    <!-- 蒙版 -->
    <div class="aside-mask"></div>

    <?php $this->need('comments.php'); ?>

</div><!-- end #app-->

<?php $this->need('footer.php'); ?>


<script type="text/javascript">
    // toc
    new Toc('post-toc', {
        'level': 2,
        'top': 200,
        'class': 'toc',
        'targetId': 'toc'
    }, function() {
        $(".asideOpe").click(function() {
            if (!$("#contentTree").hasClass("contentTree-a")) {
                $(".aside-mask").removeClass("aside-mask-show");
                $("#contentTree").addClass("contentTree-a");
                $('i', this).attr('class', 'fa fa-angle-double-left')
            } else {
                $(".aside-mask").addClass("aside-mask-show");
                $("#contentTree").removeClass("contentTree-a");
                $('i', this).attr('class', 'fa fa-angle-double-right')
            }
        })
        $(".aside-mask").click(function() {
            if ($(this).hasClass("aside-mask-show")) {
                $(this).removeClass("aside-mask-show")
                $("#contentTree").addClass("contentTree-a");
                $('.asideOpe i').attr('class', 'fa fa-angle-double-left')
            }
        })
        // 文章图片
        $("#post img").each(function() {
            if ($(this).attr("title") !== "" && $(this).attr("title") !== "请输入图片描述")
                $(this).after("<p style='text-align:center;margin:5px 0 0 0;'>" + $(this).attr("title") + "</p>")
        })
    });
</script>