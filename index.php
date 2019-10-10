<?php

/**
 * Moz更加强调阅读效率
 * 
 * @package Moz
 * @author Mozzie
 * @version 1.0
 * @link https://www.npmrundev.com
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<div id="content" class="container">

	<div class="header">
		<!-- 操作栏 -->
		<?php if (!empty($this->options->sidebarBlock) && in_array('ShowOther', $this->options->sidebarBlock)) : ?>
			<ul class="admin clearfix">
				<li><a class="elli"><i class="fa fa-fw fa-ellipsis-v"></i></a></li>
				<?php if ($this->user->hasLogin()) : ?>
					<li class="login-admin"><a target="_blank" href="<?php $this->options->adminUrl(); ?>"><i class="fa fa-fw fa-gears"></i></a></li>
					<li class="exit-admin"><a href="<?php $this->options->logoutUrl(); ?>"><i class="fa fa-fw fa-power-off"></i></a></li>
				<?php else : ?>
					<li><a target="_blank" href="<?php $this->options->adminUrl('login.php'); ?>"><i class="fa fa-user fa-fw"></i></a></li>
				<?php endif; ?>
				<li><a target="_blank" href="<?php $this->options->feedUrl(); ?>"><i class="fa fa-fw fa-rss"></i></a></li>
			</ul>
		<?php endif; ?>
	</div>

	<!-- 核心 -->
	<div id="core" class="clearfix">
		<!-- 文章区 -->
		<div class="article-list">
			<!-- top4 -->
			<div class="top4 clearfix">
				<?php $obj = $this->widget('Widget_Contents_Post_Recent'); ?>
				<?php $count = 1; ?>
				<?php while ($obj->next()) : ?>
					<?php if ($count < 5) : ?>
						<?php if ($count == 1 || $count == 4) : ?>
							<a class="article post-thumb-big" href="<?php $obj->permalink() ?>">
								<img src="<?php showThumb($obj, true, 800, 300); ?>">
								<div class="mask"></div>
								<h2 class="ellipse"><?php subText($obj->title, 20) ?>
								</h2>
								<ul class="clearfix">
									<li class="modify-time"><?php diffTime($obj->created) ?></li>
								</ul>
								<div class="post-content ellipse">
									<?php $obj->excerpt(40); ?>
								</div>
							</a>
						<?php else : ?>
							<a class="article post-thumb-small" href="<?php $obj->permalink() ?>">
								<img src="<?php showThumb($obj, true, 300, 300); ?>">
								<div class="mask"></div>
								<h2 class="ellipse"><?php subText($obj->title, 10) ?>
								</h2>
								<ul class="clearfix">
									<li class="modify-time"><?php diffTime($obj->created) ?></li>
								</ul>
								<div class="post-content">
									<?php $obj->excerpt(10); ?>
								</div>
							</a>
						<?php endif; ?>
					<?php endif; ?>
					<?php $count++ ?>
				<?php endwhile; ?>

			</div>
			<!-- 普通文章 -->
			<div class="common">
				<ul class="article-strip">
					<li class="strip-title">
						<span class="title">Title</span>
						<span class="time ellipse">Date</span>
						<span class="words ellipse">Spend</span>
						<span class="category ellipse">Category</span>
					</li>
					<?php $countIndex = 1; ?>
					<?php while ($this->next()) : ?>
						<?php if ($countIndex > 4) : ?>
							<li>
								<span class="title ellipse">
									<i class="fa fa-file"></i>
									<a href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
								</span>
								<span class="time ellipse"><time datetime="<?php $this->date('c'); ?>"><?php diffTime($this->created) ?></time></span>
								<span class="words ellipse">预计 <?php readTime($this->cid); ?></span>
								<span class="category ellipse"><?php $this->category(); ?></span>
							</li>
						<?php endif; ?>
						<?php $countIndex++; ?>
					<?php endwhile; ?>
				</ul>
				<?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
			</div>
		</div>


		<?php $this->need('footer.php'); ?>