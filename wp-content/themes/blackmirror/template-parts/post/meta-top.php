<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 16/04/2017
 * Time: 9:40 PM
 */?>
<div class="post-meta-top">
    <a class="post-meta-categories" href="<?php echo get_category_link(get_the_category()[0]->cat_ID) ?>">
        <i class="czs-bookmark-l"></i>
        <?php echo get_the_category()[0]->cat_name; ?>
    </a>
    <span class="post-meta-time">
         • <?php echo ''.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?>
    </span>
</div>
