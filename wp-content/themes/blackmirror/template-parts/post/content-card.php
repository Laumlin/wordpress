<div class="post post-style-card transition">
    <a class="post-img img-response" href=" <?php echo the_permalink(); ?>" style="background-image: url(<?php echo getThumbnailUrl(get_the_ID()) ?>)">
    </a>
	<div class="post-top">
		<div class="post-title mb-1">
			<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
		</div>
        <div class="post-top-meta mb-3">
            <?php if (is_category()): ?>
                <span class="post-tag">
                    <?php echo getOneTag(get_the_tags()); ?>
                </span>
            <?php else: ?>
                <?php $category = get_the_category(); ?>
                <a class="post-category" href="<?php echo get_category_link($category[0]->cat_ID) ?>">
                    <?php echo $category[0]->cat_name; ?>
                </a>
            <?php endif; ?>
            <span class="post-time">
                <?php echo ''.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?>
            </span>
        </div>
	</div>
    <div class="p-3">
        <?php get_template_part('template-parts/post/meta-bottom'); ?>
    </div>
</div>