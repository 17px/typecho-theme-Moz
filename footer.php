<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<footer id="footer">
    &copy; <?php echo date('Y'); ?> <?php $this->options->icpNum(); ?> |
    <?php _e('<a href="http://typecho.org">Powered by Typecho</a> | <a class="author" href="https://www.npmrundev.com">Theme Moz</a>'); ?>
</footer><!-- end #footer -->

<?php $this->footer(); ?>

</div><!-- end #core -->
</div><!-- end #content -->
</div><!-- end #app -->

</body>
<!-- 百度统计 -->
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?<?php $this->options->baiduAnlysis() ?>";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>

<!-- lib -->
<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/highlight.js/9.15.10/highlight.min.js"></script>
<script src="<?php $this->options->themeUrl('./js/lib/md-toc.min.js'); ?>"></script>
<script>
    // 代码高亮
    hljs.initHighlightingOnLoad();
</script>
<!-- main -->
<script src="<?php $this->options->themeUrl('./js/core.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('./js/theme.min.js'); ?>"></script>
<!-- /main -->
<script src="https://cdn.bootcss.com/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
<script>
    $(document).pjax(
        'a[href^="<?php Helper::options()->siteUrl() ?>"]:not(a[target="_blank"], a[no-pjax])', {
            container: "#app",
            fragment: "#app",
            timeout: 8000
        }
    ).on('pjax:send',
        function() {
            NProgress.start();
        }).on('pjax:complete',
        function() {
            NProgress.done()
            // 重加载一言
            useYiyan($(".yiyan span"));
            // highligh.js
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightBlock(block);
            });
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

        });
</script>
<script src="https://cdn.bootcss.com/nprogress/0.2.0/nprogress.min.js"></script>
<!-- /lib -->

</html>