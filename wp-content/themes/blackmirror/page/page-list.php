<?php
/**
 * Template Name: 归档
 */
get_header(); ?>

<main class="container pt-6">
	<div class="row">
		<?php
			$args = array(
			    'ignore_sticky_posts' => 1, // 不考虑置顶
                'post_type' => 'post',
                'posts_per_page' => -1,
            );
			$archives = new WP_Query($args);
		?>
		<?php if ($archives->have_posts()) : ?>
			<?php while ($archives->have_posts()) : $archives->the_post(); ?>
                <div class="col-md-3 col-sm-6">
                    <?php get_template_part('template-parts/post/content', 'card'); ?>
                </div>
			<?php endwhile;  ?>
		<?php endif; wp_reset_postdata(); ?>
	</div>
</main>

<?php get_footer(); ?>

