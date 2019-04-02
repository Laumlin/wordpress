<?php
get_header(); ?>
<section class="archive-header py-4">
    <div class="container">
        <div class="archive-header-title">
            <?php the_archive_title() ?>
        </div>
    </div>
</section>
<main class="container pt-6" id="main">
	<div class="row">
        <?php if (have_posts()) : ?>
            <div class="archive-body">
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
            </div>
            <div class="container">
                <div class="row">
                    <?php get_template_part('template-parts/pagination'); ?>
                </div>
            </div>
        <?php endif; wp_reset_postdata(); ?>
	</div>
</main>

<?php get_footer(); ?>