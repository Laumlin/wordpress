<?php
/**
 * Article button group
 */
?>
<?php if (cs_get_option("i_article_btn_group_switcher") && cs_get_option("i_article_btn_group")): ?>
<div class="article-btn-group">
    <ul>
        <?php foreach (cs_get_option("i_article_btn_group") as $key => $value): ?>
            <?php if ($value['i_article_btn_switcher']): ?>
                <li>
                    <a target="_blank" href="<?php echo $value["i_article_btn_url"]; ?>" class="<?php echo "article-btn-".$value["i_article_btn_color"] ?>">
                        <i class="<?php echo $value["i_article_btn_icon"]; ?>"></i>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
        <li>
            <a href="#comment">
                <i class="czs-talk"></i>
            </a>
        </li>
    </ul>
</div>
<?php endif; ?>
