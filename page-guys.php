<?php

/**
 * guys
 * 友人
 * @package custom
 *
 */
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit; ?>

<?php $this->need('header.php'); ?>

<div id="custom">
    <div class="content">
        <?php $obj = formateGuys($this->options->guy_link)  ?>
        <?php if (count($obj) > 0) : ?>
            <?php foreach ($obj as $item) : ?>
                <a href="<?php echo $item['c'] ?>" class="card">
                    <img src="<?php echo $item['a'] ?>">
                    <div>
                        <h4><?php echo $item['b'] ?></h4>
                        <p class="ellipse"><?php echo $item['d'] ?></p>
                    </div>
                </a>
            <? endforeach; ?>
        <? else : ?>
            <p class="no-guys">Oops!是个莫得感情的杀手</p>
        <?php endif; ?>
    </div>
    <div class="intro">
        <h2>说明</h2>
        <p>请留言申请友情链接，格式如下：</p>
        <ul>
            <li>图：<span>40×40以上，走你的服务器，我带宽小，233</span></li>
            <li>名字：<span>例如：周郎</span></li>
            <li>网址：<span>例如：https://www.google.com</span></li>
            <li>骚话：<span>例如：无与伦比的追求冰冷的敲打着我的灵魂</span></li>
        </ul>
    </div>
    <?php $this->need('comments.php'); ?>
</div><!-- end #main-->

<?php $this->need('footer.php'); ?>