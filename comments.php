<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div id="comments">
    <?php fixPjaxComment($this) ?>
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()) : ?>
        <h3><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>

        <?php $comments->listComments(); ?>

        <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>

    <?php endif; ?>

    <?php if ($this->allow('comment')) : ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div class="cancel-comment-reply">
                <?php $comments->cancelReply(); ?>
            </div>

            <h3 id="response"><?php _e('评论'); ?></h3>
            <form method="post" action="<?php $this->commentUrl() ?>"> <?php if ($this->user->hasLogin()) : ?>
                    <p class="has-login"><?php _e('登录身份: '); ?>
                        <a href="<?php $this->options->profileUrl(); ?>">
                            <?php $this->user->screenName(); ?></a> |
                        <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;
                        </a>
                    </p>
                <?php else : ?>
                    <div class="no-login clearfix">
                        <p>
                            <label for="author" class="required"><?php _e('好汉留名'); ?></label>
                            <input autocomplete="off" placeholder="必填" type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required placeholder="必填" />
                        </p>
                    </div>
                <?php endif; ?>
                <p class="relpy-content">
                    <textarea placeholder="说点什么吗？" name="text" id="textarea" class="textarea" required><?php $this->remember('text'); ?></textarea>
                </p>
                <p>
                    <button type="submit" class="submit"><?php _e('提交评论'); ?></button>
                </p>
            </form>
        </div>
    <?php else : ?>
        <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
</div>