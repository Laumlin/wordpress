<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 13/06/2017
 * Time: 11:55 PM
 */
get_header();
?>
<div class="container-fluid mb-6">
    <?php if (cs_get_option("i_category_color_switcher")): ?>
        <div class="row">
            <div class="page-category-img img-response mask" style="background-image: url(<?php echo getCategoryImg($cat); ?>)">
                <div class="page-category-info">
                    <div class="page-category-description mb-2">
                        <?php echo get_category($cat)->category_description; ?>
                    </div>
                    <div class="page-category-number">
                        <?php echo get_cat_name($cat) ?>: 共有 <?php echo get_category($cat)->count; ?> 篇文章
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<div class="page-category mt-6">
    <main class="container">
        <div class="row">
            <?php if (have_posts()) : ?>
                <div class="archive-body">
                    <div class="post-wrap">
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="col-md-6 col-sm-6">
                                <?php get_template_part('template-parts/post/content-feature'); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <?php get_template_part('template-parts/pagination'); ?>
                    </div>
                </div>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </main>
</div>
<?php get_footer(); ?>