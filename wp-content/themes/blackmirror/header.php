<?php
/**
 * The template for displaying the header
 */
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="keywords" content="<?php getKeywords(); ?>">
	<meta name="description" content="<?php getDescription(); ?>">
	<title><?php getTitle(); ?></title>
	<link rel="shortcut icon" href="<?php echo cs_get_option('i_favicon_url'); ?>" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" href="<?php assets("images/logo_mobile.png") ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php assets("images/logo_mobile.png") ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php assets("images/logo_mobile.png") ?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php assets("images/logo_mobile.png") ?>">
    <link rel="apple-touch-icon-precomposed" sizes="180x180" href="<?php assets("images/logo_mobile.png") ?>">
	<?php wp_head(); ?>
	<style type="text/css">
		<?php echo cs_get_option('i_code_css'); ?>
		<?php echo getThemeColor(); ?>
	</style>
	<script>
		var carouselSwitcher = "<?php echo cs_get_option('i_carousel_switcher'); ?>";
		var carouselOpacity = "<?php echo cs_get_option('i_carousel_opacity'); ?>";
		var carouselAnimation = "<?php echo cs_get_option('i_carousel_animation'); ?>";
		var carouselMouseSwitcher = "<?php echo cs_get_option('i_carousel_mousewheel_switcher'); ?>";
		var siteUrl = "<?php echo site_url(); ?>";
		var imgUrl = "<?php echo get_stylesheet_directory_uri()."/assets/images"; ?>";
		var fancyboxSwitcher = "<?php echo cs_get_option('i_function_fancybox_switcher'); ?>";
		var isHomePage = "<?php echo is_home(); ?>";
		var pagType	= "<?php echo cs_get_option('i_pagination_type'); ?>";
        var layoutType = "<?php echo cs_get_option('i_layout_index_type'); ?>";
        var themeUrl = "<?php echo get_stylesheet_directory_uri(); ?>";
	</script>
<!--	<base target="_blank">-->
</head>
<body <?php body_class(); ?>>
<header class="header">
	<nav class="container">
        <div class="logo hidden-sm">
            <a href="<?php echo home_url(); ?>" class="d-block">
                <img src="<?php echo cs_get_option('i_logo_url')?>" alt="">
            </a>
        </div>
        <div class="mobile-logo show-sm">
            <a href="<?php echo home_url(); ?>" class="d-inline-block">
                <img src="<?php echo cs_get_option('i_mobile_logo_url')?>" alt="">
            </a>
        </div>
        <?php if (cs_get_option('i_site_title_switcher')): ?>
            <a href="<?php echo home_url(); ?>" class="pull-left site-title hidden-sm"> <?php bloginfo('name'); ?> </a>
        <?php endif; ?>
        <?php
            wp_nav_menu(array(
                'theme_location' => 'header',
                'container' => 'ul',
                'menu_class' => 'header-menu',
                'walker'	=> new CCWalker(),
            ));
        ?>
        <?php if (cs_get_option('i_admin_login_switcher')): ?>
            <div class="admin-login hidden-sm">
                <a href="<?php echo home_url(); ?>/wp-admin" target="_blank" class="btn-line btn-line-white">
                    <?php if (is_user_logged_in()): ?>
                        <?php echo "管理"; ?>
                    <?php else: ?>
                        <?php echo "登录"; ?>
                    <?php endif; ?>
                </a>
            </div>
        <?php endif; ?>
        <div class="search-button cursor-pointer">
            <i class="czs-search-l"></i>
            <span class="d-inline-block transition opacity-0"><i class="czs-close-l"></i></span>
        </div>
        <div class="menu-button">
            <div class="nav-bar">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
	</nav>
	<div class="menu-wrap show-xs">
		<div class="mobile-menu">
			<?php
                wp_nav_menu(array(
                    'theme_location' => 'header',
                    'container' => 'ul',
                    'menu_class' => 'mobile-menu-nav',
                    'walker'=> new CCWalker()
                ));
			?>
		</div>
		<?php if (cs_get_option('i_admin_login_switcher')): ?>
			<div class="mobile-admin-login text-center mt-3">
				<a href="<?php echo home_url(); ?>/wp-admin" target="_blank" class="btn-line btn-line-geek">
					<?php if (is_user_logged_in()): ?>
						<?php echo "管理"; ?>
					<?php else: ?>
						<?php echo "登录"; ?>
					<?php endif; ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</header>
<?php get_search_form(); ?>

</body>