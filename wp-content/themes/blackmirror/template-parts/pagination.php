<?php
/**
 * Created by PhpStorm.
 * Date: 12/11/2016 | 21:03
 *
 * @Author: xcc <ybzbxcc@gmail.com>
 */
if (cs_get_option('i_pagination_type') == 'more' || cs_get_option('i_pagination_type') == 'infinite'): ?>
    <div class="pagination px-3">
        <span class="more d-inline-block"><?php next_posts_link("加载更多"); ?></span>
    </div>
<?php elseif (cs_get_option('i_pagination_type') == 'number'): ?>
    <div class="pagination px-3 pagination-number">
        <?php paginationNav(5); ?>
    </div>
<?php else: ?>
    <div class="pagination px-3">
        <div class="previous pull-left"><?php previous_posts_link("上一页"); ?></div>
        <div class="next pull-right"><?php next_posts_link("下一页"); ?></div>
    </div>
<?php endif; ?>
