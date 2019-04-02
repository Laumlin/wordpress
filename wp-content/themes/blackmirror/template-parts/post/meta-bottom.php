<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 16/04/2017
 * Time: 9:40 PM
 */?>
<ul class="post-meta-bottom">
    <li class="post-meta-author">
        <a class="d-block" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank">
            <?php echo get_avatar( get_the_author_meta('email'), '' ); ?>
            <span class="d-inline-block"><?php echo get_the_author() ?></span>
        </a>
    </li>
    <li class="post-meta-view pull-right">
        <i class="czs-eye"></i> <?php echo getPostViews(get_the_ID()); ?>
    </li>
    <li class="post-meta-comments pull-right">
        <i class="czs-comment"></i> <?php echo $post->comment_count ?>
    </li>
    <li class="post-meta-like pull-right">
        <i class="czs-heart"></i>
        <span class="count">
            <?php if(get_post_meta($post->ID,'bigfa_ding',true)): ?>
                <?php echo get_post_meta($post->ID,'bigfa_ding',true); ?>
            <?php else: ?>
                <?php echo '0'; ?>
            <?php endif; ?>
        </span>
    </li>
</ul>
