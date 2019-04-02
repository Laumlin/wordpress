<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 10/31/2016
 * Time: 10:30
 */
add_action('widgets_init', 'widgetProfileInit');

function widgetProfileInit() {
    register_widget('WidgetProfile');
}

class widgetProfile extends WP_Widget {

    /**
     * widgetProfile setup
     */
    function widgetProfile() {
        $widget_ops = array('classname' => 'widget-profile', 'description' => '作者信息简介');
        // init widgetProfile
        parent::__construct('widget-profile', "作者信息", $widget_ops);
    }

    /**
     * How to display the widgetProfile on the screen.
     */
    function widget( $args, $instance ) {
        extract( $args );
        /* Our variables from the widget settings. */
        $type = $instance['type'];
        echo $this->showWidget($type);
    }

    /**
     * Update the widget settings.
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        /* Strip tags for title and name to remove HTML (important for text inputs). */
        return $instance;
    }

    /**
     * Displays the widget settings controls on the widget panel.
     * Make use of the get_field_id() and get_field_name() function
     * when creating your form elements. This handles the confusing stuff.
     */
    function form( $instance ) {
        /* Set up some default widget settings. */
    }

    function showWidget($type) {
?>
    <?php
        global $post;
        $authorID = $post->post_author;
    ?>

    <div class="widget widget-profile-elegant">
        <div class="widget-profile-avatar">
            <?php echo get_avatar($authorID, 60);?>
        </div>
        <div class="widget-profile-user text-center f-bold">
            <a href="<?php echo get_the_author_meta('url', $authorID); ?>" target="_blank">
                <?php echo get_the_author_meta('nickname',  $authorID); ?>
            </a>
        </div>
        <div class="widget-profile-description text-center mb-4">
            <?php echo get_the_author_meta('description', $authorID); ?>
        </div>
        <?php
            echo "<div class='widget-profile-role mb-6'><span>".getRole($authorID)."</span></div>";
        ?>
        <div class="widget-profile-footer text-center">
            <a class="col-6 py-3 d-block" href="<?php echo get_author_posts_url($authorID) ?>" style="border-right: 1px solid #eee;">
                <i class="czs-doc-file-l"></i>作品
            </a>
            <a class="col-6 py-3 d-block" target="_blank" href="<?php echo get_the_author_meta("url", $authorID) ?>">
                <i class="czs-network-l"></i>网站
            </a>
        </div>
    </div>
<?php }
}?>