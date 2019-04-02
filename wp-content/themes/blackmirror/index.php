<?php get_header(); ?>

<?php if (cs_get_option('i_carousel_switcher')): ?>
    <div class="carousel-wrap">
        <div class="container no-gutter-xs">
            <?php get_template_part('template-parts/carousel'); ?>
        </div>
    </div>
<?php endif; ?>
<div class="shot mb-6">
    <div class="container">
        <div class="row shot-wrap">
            <ul class="shot-type">
               <li class="<?php echoActive(getShotType(), "hot"); ?>" data-type="hot">热门</li>
               <li class="<?php echoActive(getShotType(), "latest"); ?>" data-type="latest">最新</li>
               <li class="<?php echoActive(getShotType(), "hot-comment"); ?>" data-type="hot-comment">热评</li>
            </ul>
        </div>
    </div>
</div>

<?php if (cs_get_option('i_recommend_posts_switcher')): ?>
    <div class="recommend">
        <div class="container">
            <div class="row">
                <?php
                    $recommendPosts = cs_get_option("i_recommend_posts");
                    $recommendArray = explode(",", $recommendPosts);
                    $arg = array(
                        "post__in"              =>  $recommendArray,
                        'ignore_sticky_posts'	=>  1
                    );
                    $recommend = new WP_Query($arg);
                ?>
                <?php if ($recommend->have_posts()) :?>
                    <?php while ($recommend->have_posts()) : $recommend->the_post(); ?>
                        <div class="col-md-6">
                            <?php get_template_part('template-parts/post/content', 'feature'); ?>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="category-wrap mb-6">
    <div class="container ps-r">
        <?php if (cs_get_option("i_tags")): ?>
            <ul class="category-nav pr-6">
                <li>
                    <a class="<?php echoActive(getTag(), "all") ?>" href="" data-type="all"> 全部 </a>
                </li>
                <?php foreach (cc_getTags() as $key => $value): ?>
                    <?php if (in_array((string)$value->term_id, cs_get_option("i_tags"))): ?>
                        <li>
                            <a class="<?php echoActive(getTag(), $value->slug) ?>" href="<?php echo home_url() ?>" data-type="<?php echo $value->slug; ?>">
                                <?php echo $value->name; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <h3>请到黑镜后台个性化菜单-常规-首推文章设置一下ID</h3>
        <?php endif; ?>
        <div class="layout-type-wrap ps-a hidden-xs">
            <a class="btn-layout-type p-4">
                <i class="czs-layout-grid"></i>
            </a>
            <div class="layout-type ps-a px-1">
                <ul>
                    <li data-type="three" class="p-2 <?php if (getLayoutType() == "three") echo "active"; ?>">3</li>
                    <li data-type="four" class="p-2 <?php if (getLayoutType() == "four") echo "active"; ?>">4</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
    $categoriesNot = cs_get_option('i_category_not_in');
    $categoryNot = array();
    if ($categoriesNot) {
        foreach($categoriesNot as $value) {
            array_push($categoryNot, (int)$value);
        }
    }
?>
<main class="container" id="main">
	<div class="row">
        <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $tagType = getTag();
            if (getShotType() == 'hot') {
                $args = array(
                    "post__not_in"      => get_option("sticky_posts"),     // 置顶文章不显示在文章列表中
                    'posts_per_page'    => cs_get_option('i_posts_per_page'),
                    'paged'             => $paged,
                    'category__not_in'  => $categoryNot,
                    'meta_key'          => 'post_views_count',
                    'orderby'           => array('meta_value_num' => 'DESC', 'date' => 'DESC'),
                    'tag'               => $tagType
                );
            } else if (getShotType() == 'latest') {
                $args = array(
                    "post__not_in"      => get_option("sticky_posts"),     // 置顶文章不显示在文章列表中
                    'posts_per_page'    => cs_get_option('i_posts_per_page'),
                    'paged'             => $paged,
                    'category__not_in'  => $categoryNot,
                    'orderby'           => 'date',
                    'tag'               => $tagType
                );
            } else if (getShotType() == 'hot-comment'){
                $args = array(
                    "post__not_in"      => get_option("sticky_posts"),     // 置顶文章不显示在文章列表中
                    'posts_per_page'    => cs_get_option('i_posts_per_page'),
                    'paged'             => $paged,
                    'category__not_in'  => $categoryNot,
                    'orderby'           => 'comment_count',
                    'tag'               => $tagType
                );
            }
            if ($tagType == "all")
                unset($args["tag"]);
            query_posts($args);
        ?>
        <?php if (have_posts()) :?>
            <div class="post-wrap">
                <?php while (have_posts()) : the_post(); ?>
                    <?php if (getLayoutType() == "three"): ?>
                        <div class="col-md-6 col-sm-6 col-lg-4">
                            <?php get_template_part('template-parts/post/content', 'card'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (getLayoutType() == "four"): ?>
                        <div class="col-md-6 col-sm-6 col-lg-4 col-xl-3">
                            <?php get_template_part('template-parts/post/content', 'card'); ?>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
            <?php get_template_part('template-parts/pagination'); ?>
        <?php endif; wp_reset_query();?>
	</div>
    <div class="friend-link p-3 mt-6">
        <?php
            $args = array(
                'title_li'         => '',
                'show_images'	   => 0,
                'show_name'		   => 1,
                'categorize'       => 0,
                'link_before'	   => '<span>',
                'link_after'	   => '</span>',
            );
            echo "<strong class='pull-left mr-3'>友情链接<span class=\"hidden-xs\">：</span></strong>";
            wp_list_bookmarks($args)
        ?>
    </div>
</main>

<?php get_footer(); ?>

