<?php
/**
 * The template for displaying the footer
 */
?>

<footer id="footer">
	<div class="container" style="position: relative; margin-top: 22px;" data-position="d14fd9898cd52d82">
		<?php if (cs_get_option('i_footer_theme_switcher')): ?>
			<div class="footer-theme hidden-xs">
				<strong class="d-inline-block"><?php echo get_bloginfo('name')."<span class=\"hidden-xs\">：</span>"; ?></strong>
				<span><?php echo bloginfo('description'); ?></span>
			</div>
		<?php endif; ?>
		<?php if (cs_get_option('i_footer_feature_switcher')): ?>
			<div class="footer-feature">
				<strong class="pull-left d-inline-block">功能菜单<span class="hidden-xs">：</span></strong>
				<?php wp_nav_menu(array('theme_location' => 'footer', 'container' => 'ul', 'menu_class' => 'footer-menu')); ?>
			</div>
		<?php endif; ?>
		<?php if (cs_get_option('i_follow_switcher')): ?>
			<ul class="footer-follow">
				<li class="follow-wechat">
					<a>
						<i class="czs-weixin"></i>
					</a>
					<div class="follow-wechat-popup">
						<img src="<?php echo cs_get_option( 'i_follow_wechat' ); ?> " alt="wechat">
					</div>
				</li>
				<li class="follow-weibo">
					<a target="blank" href="<?php echo cs_get_option('i_follow_weibo') ?>">
						<i class="czs-weibo"></i>
					</a>
				</li>
				<li class="follow-qq">
					<a href="tencent://AddContact/?fromId=50&fromSubId=1&subcmd=all&uin=<?php echo cs_get_option('i_follow_qq') ?>" target="_blank">
						<i class="czs-qq"></i>
					</a>
				</li>
				<li class="follow-rss">
					<a href="<?php echo site_url(); ?>/feed/atom" target="_blank">
						<i class="czs-rss"></i>
					</a>
				</li>
			</ul>
		<?php endif ?>
	</div>
	<div class="container">
        <?php echo cs_get_option('i_code_footer'); ?>
    </div>
	<div class="copyright">
		<div class="container">
			<p>
				Copyright © <?php echo getSiteDate(); ?>
				<?php echo bloginfo('name') ?> - <?php echo cs_get_option('i_site_description'); ?> / 版本 V <?php echo cs_get_option('i_site_version'); ?>
				<span style="margin-right: 12px;" class="hidden-xs">
                    <a class="site-record" target="_blank" href="<?php echo cs_get_option("i_site_record_href"); ?>" style="color: #818181;">
                        <?php echo cs_get_option('i_site_record'); ?>
                    </a>
				</span>
				<script>
					<?php echo cs_get_option('i_seo_statistics'); ?>
				</script>
			</p>
		</div>
	</div>
</footer>
<div class="scrollTop transition">
    <i class="czs-arrow-up-l"></i>
</div>

<li class="change-language hidden">
    <a id="StranLink" class="wencode">繁</a>
</li>
<?php wp_footer(); ?>

<div class="overlay"></div>

</script>
<div class="backdrop transition"></div>
</body>
</html>