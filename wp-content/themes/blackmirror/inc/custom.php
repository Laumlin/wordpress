<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 10/30/2016
 * Time: 19:45
 */

/*
    ==================================================
    首页每页文章数设置
    ==================================================
*/

/**
 * judge the element within an array
 * @param $array
 * @param $element
 * @return bool
 */
function hasElement($array, $element) {
    if (empty($array)) {
        return false;
    }
    foreach ($array as $value) {
        if ($value == $element) {
            return true;
        }
    }
    return false;
}
function getFooterFriends($location) {
    $args = array(
        'limit'			   => cs_get_option('i_friends_nums'),
        'title_li'         => '',
        'show_images'	   => 0,
        'show_name'		   => 1,
        'categorize'       => 0,
        'link_before'	   => '<span>',
        'link_after'	   => '</span>',
    );
    if ( (is_home() || is_front_page()) && hasElement($location, "index")) {
        echo "<strong class='pull-left'>友情链接<span class=\"hidden-xs\">：</span></strong>";
        return wp_list_bookmarks($args);
    } else if (is_page() && hasElement($location, "page")) {
        echo "<strong class='pull-left'>友情链接<span class=\"hidden-xs\">：</span></strong>";
        return wp_list_bookmarks($args);
    } else if (is_single() && hasElement($location, "article")){
        echo "<strong class='pull-left'>友情链接<span class=\"hidden-xs\">：</span></strong>";
        return wp_list_bookmarks($args);
    } else if (is_archive() && hasElement($location, "archive")) {
        echo "<strong class='pull-left'>友情链接<span class=\"hidden-xs\">：</span></strong>";
        return wp_list_bookmarks($args);
    }
    return;
}
/*
    ==================================================
    首页每页文章数设置
    ==================================================
*/
function customPostsPerPage($query) {
    if ($query->is_home() && $query->is_main_query()) {
        $query->set("posts_per_page", cs_get_option('i_posts_per_page'));
    }
}
add_action("pre_get_posts", "customPostsPerPage");

/*
    ==================================================
    获取WordPress所有分类的信息
    ==================================================
*/
function getCategories() {
    $args = array(
        'type' => 'post',
        'child_of' => 0,
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => 1,
        'hierarchical' => 1,
        'taxonomy' => 'category',
        'pad_counts' => false
    );
    return get_categories($args);
}
/*
    ==================================================
    获取WordPress所有分类名字和ID
    ==================================================
*/
function getCategoryArray() {
    $args = array(
        'type' => 'post',
        'child_of' => 0,
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => 1,
        'hierarchical' => 1,
        'taxonomy' => 'category',
        'pad_counts' => false
    );
    $categories = get_categories($args);
    $res = array();
    foreach ($categories as $category) {
        $res[$category->term_id] = $category->name;
    }
    return $res;
}
/*
    ==================================================
    获取WordPress所有标签名字和ID
    ==================================================
*/
function getTagArray() {
    $args = array(
        'orderby' => 'name',
        'order' => 'ASC'
    );
    $tags = get_tags($args);
    $res = array();
    foreach ($tags as $tag) {
        $res[$tag->term_id] = $tag->name;
    }
    return $res;
}

function cc_getTags() {
    $args = array(
        'orderby' => 'name',
        'order' => 'ASC'
    );
    return get_tags($args);
}
/*
    ==================================================
    修改时间格式
    ==================================================
*/
function timeago($ptime) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if ($etime < 1) return '刚刚';
    $interval = array (
        12 * 30 * 24 * 60 * 60  =>  date('Y.m.d', $ptime),
        30 * 24 * 60 * 60       =>  date('m.d', $ptime),
        7 * 24 * 60 * 60        =>  date('m.d', $ptime),
        24 * 60 * 60            =>  '天前',
        60 * 60                 =>  '小时前',
        60                      =>  '分钟前',
        1                       =>  '秒前'
    );
    foreach ($interval as $secs => $str) {
        if ($etime < 7 * 24 * 60 * 60){
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . $str;
            }
        } else {
            return $str;
        }
    };
}

/*
    ==================================================
    控制摘要字数
    ==================================================
*/
function getPostExcerpt($post='', $excerpt = ''){
    if ($excerpt) {
        $excerpt_length = $excerpt;
    } else {
        $excerpt_length = is_null(cs_get_option('i_posts_excerpt_length')) ? 100 : cs_get_option('i_posts_excerpt_length');
    }
    if(!$post) $post = get_post();
    $post_excerpt = $post->post_excerpt;
    if($post_excerpt == ''){
        $post_content = $post->post_content;
        $post_content = do_shortcode($post_content);
        $post_content = wp_strip_all_tags( $post_content );

        $post_excerpt = mb_strimwidth($post_content,0,$excerpt_length,'…','utf-8');
    }

    $post_excerpt = wp_strip_all_tags( $post_excerpt );
    $post_excerpt = trim( preg_replace( "/[\n\r\t ]+/", ' ', $post_excerpt ), ' ' );

    return $post_excerpt;
}

/*
    ==================================================
    统计浏览数目
    ==================================================
*/
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return ($count+1).'';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if (is_singular()) {
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
}
/*
    ==================================================
    获取文章的第一张图片地址
    ==================================================
*/
function catchFirstImg() {
    global $post, $posts;
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

    if(empty($matches[1])) {
        $firstImg = cs_get_option('i_thumbnail_default');
    } else {
        $firstImg = $matches [1][0];
    }
    return $firstImg;
}
/*
    ==================================================
    点赞
    ==================================================
*/
add_action('wp_ajax_nopriv_addLike', 'addLike');
add_action('wp_ajax_addLike', 'addLike');
function addLike(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
        $bigfa_raters = get_post_meta($id,'bigfa_ding',true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
        setcookie('bigfa_ding_'.$id,$id,$expire,'/',$domain,false);
        if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
            update_post_meta($id, 'bigfa_ding', 1);
        }
        else {
            update_post_meta($id, 'bigfa_ding', ($bigfa_raters + 1));
        }

        echo get_post_meta($id,'bigfa_ding',true);
    }
    die;
}
add_action('wp_ajax_nopriv_subLike', 'subLike');
add_action('wp_ajax_subLike', 'subLike');
function subLike(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
        $bigfa_raters = get_post_meta($id,'bigfa_ding',true);
        $expire = time() - 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
        setcookie('bigfa_ding_'.$id,$id,$expire,'/',$domain,false);

        if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
            update_post_meta($id, 'bigfa_ding', 1);
        }
        else {
            update_post_meta($id, 'bigfa_ding', ($bigfa_raters - 1));
        }

        echo get_post_meta($id, 'bigfa_ding', true);

    }
    die;
}
/*
    ==================================================
    index sidebar function
    ==================================================
*/
function widgetSetup(){
    $args = array(
        'name'          => '首页固定侧边栏',
        'id'            => 'sidebar-index-affix',
        'description'   => '显示在首页固定侧边栏小工具',
        'class'         => 'custom',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>'
    );
    register_sidebar($args);
    $args = array(
        'name'          => '首页侧边栏',
        'id'            => 'sidebar-index',
        'description'   => '显示在首页侧边栏小工具',
        'class'         => 'custom',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>'
    );
    register_sidebar($args);
    $args = array(
        'name'          => '文章页固定侧边栏',
        'id'            => 'sidebar-article-affix',
        'description'   => '显示在文章页固定侧边栏小工具',
        'class'         => 'custom',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>'
    );
    register_sidebar($args);
    $args = array(
        'name'          => '文章页侧边栏',
        'id'            => 'sidebar-article',
        'description'   => '显示在文章页侧边栏小工具',
        'class'         => 'custom',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>'
    );
    register_sidebar($args);
}
add_action('widgets_init', 'widgetSetup');

/*
    ==================================================
    获取第一个标签
    ==================================================
*/
function getOneTag($tags) {
    if (empty($tags)) {
        return "";
    } else {
        $url = get_tag_link($tags[0]->term_id);
        return "<a href='".$url."'>".$tags[0]->name."</a>";
    }

}
/*
    ==================================================
    主题配色
    ==================================================
*/
function getThemeColor() {
    $color = cs_get_option('i_theme_color');
    $categoryColor = cs_get_option("i_category_color");
    $categoryOpacity = cs_get_option("i_category_opacity");
    $style = "";
    $style .= ".friend-link li a:hover, .custom-carousel, .custom-carousel .owl-prev, .custom-carousel .owl-next, .site-record:hover, .post .post-title a:hover, #footer .footer-friends li a span:hover, #footer .footer-feature .footer-menu li a:hover, .widget-hotpost a:hover, .article-body a, .comments .comments-list .comment .comment-body .comment-user a, .comments .comments-list .comment .children .comment-user a, #comment-nav-below .nav-inside .current, .widget-hotpost-brief i, .archive-header .archive-header-title{ color: $color;}";
    $style .= ".article-like .favorite, .carousel-info-meta .carousel-info-category, .tagcloud a:hover, .calendar_wrap table td a, .article-meta .article-meta-tags a, .article-support .article-support-button a, .comments #respond .form-submit input{background-color: $color;}";
    $style .= ".article-body h2, .article-body h3 {border-left: 5px solid $color;}.article-like .done{border: 1px solid $color ;}";
    $style .= ".page-category-img:after{background: $categoryColor;opacity: $categoryOpacity;}";
    $style .= ".admin-login a:hover{background-color: $color;}";
    $style .= ".article-like .favorite{box-shadow: 0 1px 10px $color;}";
    return $style;
}
function get_page_by_name( $page_name, $output = OBJECT, $post_type = 'page' ) {
    global $wpdb;

    if ( is_array( $post_type ) ) {
        $post_type = esc_sql( $post_type );
        $post_type_in_string = "'" . implode( "','", $post_type ) . "'";
        $sql = $wpdb->prepare( "
			SELECT ID
			FROM $wpdb->posts
			WHERE post_name = %s
			AND post_type IN ($post_type_in_string)
		", $page_name );
    } else {
        $sql = $wpdb->prepare( "
			SELECT ID
			FROM $wpdb->posts
			WHERE post_name = %s
			AND post_type = %s
		", $page_name, $post_type );
    }

    $page = $wpdb->get_var( $sql );

    if ( $page ) {
        return get_post( $page, $output );
    }
}

function getThumbnailUrl($id) {
    if (get_post_meta($id, "thumbnailUrl", true)) {
        $thumbnailUrl = get_post_meta($id, "thumbnailUrl", true);
    } elseif (has_post_thumbnail()) {
        $thumbnailUrl = get_the_post_thumbnail_url();
    } else {
        $thumbnailUrl = catchFirstImg();
    }

    return $thumbnailUrl;
}

function getThumbnailStyle($id) {
    $thumbnailUrl = getThumbnailUrl($id);
    echo "background-image: url($thumbnailUrl)";
}

function getSiteDate() {
    if (cs_get_option('i_site_date') == date("Y")) {
        return date("Y");
    } else {
        return cs_get_option('i_site_date')."-".date("Y");
    }
}

function getCategoryImg($catId) {
    if (getTaxonomyImageUrl($catId)) {
        return getTaxonomyImageUrl($catId);
    } else {
//        return get_template_directory_uri()."/assets/images/thumbnail_default.png";
        return "";
    }
}

function getLayoutType() {
    if (isset($_COOKIE["layout"]) && $_COOKIE["layout"] == "three") {
        return "three";
    }
    if (isset($_COOKIE["layout"]) && $_COOKIE["layout"] == "four") {
        return "four";
    }
    if (cs_get_option('i_layout_index_type') == "three") {
        return "three";
    } else {
        return "four";
    }
}

function getShotType() {
    return isset($_COOKIE["shot"]) ? $_COOKIE["shot"] : "latest";
}

function getTag() {
    return isset($_COOKIE["tag"]) ? $_COOKIE["tag"] : "all";
}

function echoActive($current, $src) {
    if ($current == $src)
        echo "active";
}

function getCategoryRootId($id) {
    $category = get_category($id); // 取得当前分类
    // 若当前分类有上级分类时，循环
    while($category->category_parent)  {
        $category = get_category($category->category_parent); // 将当前分类设为上级分类（往上爬）
    }
    return $category->term_id; // 返回根分类的id号
}
function modifyCategoryTemplate($path) {
    $catID = get_query_var("cat");
    $categories = cs_get_option("i_feature_category");

    if (!is_null($categories)) {
        foreach ($categories as $ID) {
            if ($ID == $catID) {
                $arr = explode(".", $path);
                return $arr[0]."-feature.".$arr[1];
            }
        }
    }
    return $path;
}
add_filter('category_template', 'modifyCategoryTemplate');
