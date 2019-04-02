<div class="post post-style-feature">
    <a class="post-img img-response" href=" <?php echo the_permalink(); ?>" style="background-image: url(<?php echo getThumbnailUrl(get_the_ID()) ?>)">
        <ul class="post-meta p-2 post-meta-bottom transition">
            <li class="post-time">
                <i class="czs-time-l"></i>
                <?php echo ''.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?>
            </li>
            <li class="post-meta-view pull-right">
                <i class="czs-eye-l"></i> <?php echo getPostViews(get_the_ID()); ?>
            </li>
            <li class="post-meta-comments pull-right">
                <i class="czs-comment-l"></i> <?php echo $post->comment_count ?>
            </li>
            <li class="post-meta-like pull-right">
                <i class="czs-heart-l"></i>
                <span class="count">
                    <?php if(get_post_meta($post->ID,'bigfa_ding',true)): ?>
                        <?php echo get_post_meta($post->ID,'bigfa_ding',true); ?>
                    <?php else: ?>
                        <?php echo '0'; ?>
                    <?php endif; ?>
                </span>
            </li>
        </ul>
    </a>
    <div class="post-title mt-2">
        <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
    </div>
    <?php if (!is_home() && !is_front_page()): ?>
        <div class="post-excerpt">
            <a href="<?php the_permalink(); ?>"><?php echo getPostExcerpt(); ?></a>
        </div>
    <?php endif; ?>

</div>