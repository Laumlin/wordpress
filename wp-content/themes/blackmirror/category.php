<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 13/04/2017
 * Time: 11:55 PM
 */
get_header();
?>
<?php if ($categories = get_term_children(getCategoryRootId(get_query_var('cat')), "category")): ?>
    <div class="category-child py-3 hidden-md">
        <div class="container">
            <ul>
                <li class="d-inline-block"><a class="d-block <?php if(get_query_var('cat') == getCategoryRootId(get_query_var('cat'))) echo "active" ?>" href="<?php echo get_category_link(getCategoryRootId(get_query_var('cat'))); ?>">全部</a></li>
                <?php $categories4show = array_slice($categories, 0, 8); ?>
                <?php foreach ($categories4show as $key => $value): ?>
                    <li class="d-inline-block">
                        <a class="d-block <?php if(get_query_var('cat') == $value) echo "active" ?>" href="<?php echo get_category_link($value); ?>">
                            <i class="<?php echo get_term_meta($value, "taxonomyIcon", true); ?>"></i>
                            <?php echo get_cat_name($value); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
                <?php if (count($categories) >= 8): ?>
                    <div class="pull-right mt-1 btn-category-child">
                        全部分类
                        <div class="d-inline-block transition ml-1">
                            <i class="czs-angle-down-l"></i>
                        </div>
                    </div>
                <?php endif; ?>
            </ul>
            <ul class="pt-6 mt-4 category-child-all hidden">
                <?php $categories = array_slice($categories, 8, null); ?>
                <?php foreach ($categories as $key => $value): ?>
                    <li class="d-inline-block">
                        <a class="d-block <?php if(get_query_var('cat') == $value) echo "active" ?>" href="<?php echo get_category_link($value); ?>">
                            <?php echo get_cat_name($value); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>


<div class="page-category mt-6">
    <main class="container">
        <div class="row">
            <?php if (have_posts()) : ?>
                <div class="post-wrap">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php if (cs_get_option('i_layout_archive_type') == "three"): ?>
                            <div class="col-md-4 col-sm-6">
                                <?php get_template_part('template-parts/post/content-card'); ?>
                            </div>
                        <?php else: ?>
                            <div class="col-md-3 col-sm-6">
                                <?php get_template_part('template-parts/post/content-card'); ?>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
                <?php get_template_part('template-parts/pagination'); ?>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </main>
</div>
<?php get_footer(); ?>