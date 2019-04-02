<?php get_header(); ?>

<?php
    $fullArticle = cs_get_option("i_article_full_switcher");
?>

<main class="container pt-xs-6" id="pjax-content">
    <div class="row">
        <div class="<?php if ($fullArticle) {echo "col-md-12";} else {echo "col-md-9";} ?> no-gutter-xs">
            <?php get_template_part("template-parts/article-btn-group") ?>
            <div id="main">
                <?php if (have_posts()) :
                    the_post(); update_post_caches($posts); ?>
                        <article class="article <?php if (cs_get_option('i_article_indent_switcher')){echo "article-indent";}?>" id="post-<?php the_ID(); ?>">
                            <div class="article-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </div>
                            <div class="article-meta">
                                <span class="article-meta-time">
                                    <?php echo ''.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?>
                                </span>
                                <i class="czs-bookmark"></i>
                                <?php the_category(' '); ?>&nbsp;
                                <i class="czs-heart"></i>
                                <span class="count">
                                    <?php if(get_post_meta($post->ID,'bigfa_ding',true)): ?>
                                        <?php echo get_post_meta($post->ID,'bigfa_ding',true); ?>
                                    <?php else: ?>
                                        <?php echo '0'; ?>
                                    <?php endif; ?>
                                </span>&nbsp;
                                <i class="czs-comment"></i>
                                <?php comments_popup_link('0', '1 ', '% ', 'article-meta-comment', '评论已关闭'); ?>
                                <i class="czs-eye"></i> <?php echo getPostViews(get_the_ID()); ?>&nbsp;
                                <!-- user edit -->
                                <?php if (is_user_logged_in()): ?>
                                    <i class="czs-pen-write"></i>
                                    <?php edit_post_link(); ?>
                                <?php endif; ?>
                                <?php if (!cs_get_option("i_article_tabs_switcher")): ?>
                                    <div class="article-meta-tags">
                                        <?php the_tags(' ', ' '); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
    <!--                        <hr class="mb-6" style="border: 0;height: 1px;background: #ddd;">-->
                            <div class="article-body">
                                <?php the_content(); ?>
                            </div>
                            <!-- advertisement -->
                            <?php if (cs_get_option('i_advertisement_switcher')): ?>
                                <?php if (cs_get_option('i_advertisement_article_tail_switcher')): ?>
                                    <script>
                                        <?php echo cs_get_option('i_advertisement_article_tail'); ?>
                                    </script>
                                <?php else: ?>
                                    <div class="article-advertisement">
                                        <?php echo cs_get_option('i_advertisement_article_tail'); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <!-- copyright -->
                            <?php if (cs_get_option('i_article_copyright_switcher')): ?>
                                <p class="article-copyright">
                                    转载原创文章请注明，转载自:
                                    <a href="<?php echo home_url(); ?>">
                                        <?php echo bloginfo('name'); ?>
                                    </a> -
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                    (<?php the_permalink(); ?>)
                                </p>
                            <?php endif; ?>
                            <!-- like -->
                                <div class="article-like">
                                    <a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite <?php if(isset($_COOKIE['bigfa_ding_'.$post->ID])) echo ' done';?>">
                                        <span class="d-block">
                                            <?php if(isset($_COOKIE['bigfa_ding_'.$post->ID])): ?>
                                                <i class="czs-thumbs-up"></i>
                                            <?php else: ?>
                                                <i class="czs-thumbs-up-l"></i>
                                            <?php endif; ?>
                                        </span>
                                        <span class="count d-block">
                                            <?php if(get_post_meta($post->ID,'bigfa_ding',true)): ?>
                                                <?php echo get_post_meta($post->ID,'bigfa_ding',true); ?>
                                            <?php else: ?>
                                                <?php echo '0'; ?>
                                            <?php endif; ?>
                                        </span>
                                    </a>
                                </div>
                            <!-- support -->
                            <?php if (cs_get_option("i_article_support_switcher") && false): ?>
                                <div class="article-support">
                                    <div class="article-support-img">
                                        <div class="article-support-zhifubao">
                                            <img src="<?php echo cs_get_option('i_article_support_zhifubao')?>">
                                            <div class="article-support-img-title">
                                                支付宝支付
                                            </div>
                                        </div>
                                        <div class="article-support-wechat">
                                            <img src="<?php echo cs_get_option('i_article_support_wechat')?>">
                                            <div class="article-support-img-title">
                                                微信支付
                                            </div>
                                        </div>
                                    </div>
                                    <div class="article-support-button">
                                        <a class="btn">赞赏</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- share -->
                            <?php get_template_part("template-parts/share"); ?>
                        </article>
                        <?php setPostViews(get_the_ID());?>
                <?php endif; ?>
                <section id="post-link">
                    <div class="md-6 post-link-previous">
                        <?php echo (get_previous_post() ? previous_post_link('上一篇: %link') : "已经是最旧一篇" ); ?>
                    </div>
                    <div class="md-6 post-link-next">
                        <?php echo (get_next_post() ? next_post_link('下一篇: %link') : "已经是最后一篇"); ?>
                    </div>
                </section>
                <div class="related-post row-sm-up clear">
                    <?php
                        $tags = get_the_tags();
                        $tagIds = array();
                        if ($tags) {
                            foreach ($tags as $tag) {
                                $tagIds[] .= $tag->term_id;
                            }
                        }
                        $arg = array(
                            'tag__in'              =>  $tagIds,
                            'ignore_sticky_posts'	=>  1,
                            'posts_per_page'        =>  3,
                            'post__not_in' => array($post->ID),
                        );
                        $recommend = new WP_Query($arg);
                    ?>
                    <?php if ($recommend->have_posts()) :?>
                        <?php while ($recommend->have_posts()) : $recommend->the_post(); ?>
                            <div class="col-md-4">
                                <?php get_template_part('template-parts/post/content', 'card'); ?>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
                <?php
                    if(comments_open()){
                        comments_template();
                    }else{
                        echo "<h5>评论已经关闭</h5>";
                    }
                ?>
            </div>
        </div>
        <div class="col-md-3 <?php if ($fullArticle) echo "hidden" ?>">
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>


