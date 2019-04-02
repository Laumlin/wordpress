<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 11/15/2016
 * Time: 18:51
 */
//在加载管理员界面的时候调用createMetaBox函数
add_action('admin_menu', 'createMetaBox');
//在保存文章的时候调用saveMetaBoxes函数来保存自定义数据
add_action('save_post', 'saveMetaBoxes');

function createMetaBox(){
    if(function_exists('add_meta_box')){
        add_meta_box('thumbnailMetaBox','外链特色图','thumbnailMetaBox','post','side','high');
    }
}

/**
 * Thumbnail meta box callback function
 *
 * @param $post
 */
function thumbnailMetaBox($post){
    $metaBoxValue = get_post_meta($post->ID, "thumbnailUrl", true);
    wp_nonce_field('thumbnail_nonce', 'thumbnail_nonce');
    if ($metaBoxValue) {
        echo '<img style="display:block;width:100%;height:auto;" src="'.$metaBoxValue.'"/>';
    }
    echo '<input placeholder="请填写图片地址" style="width:100%;" value="'.$metaBoxValue.'" name="'."thumbnailUrl".'"/>';
}

/**
 * Saving the meta box value
 *
 * @param $postId
 * @return mixed
 */
function saveMetaBoxes($postId) {
    if (checkAuthority($postId)) {
        return saveMetaBox($postId, "thumbnailUrl", "thumbnail_nonce");
    } else {
        return $postId;
    }
}

/**
 * Saving the thumbnail meta box value
 *
 * @param $postId
 * @param $key
 * @param $nonceName
 * @return mixed
 */
function saveMetaBox($postId, $key, $nonceName) {
    // 检查nonce是否设置
    if (!isset($_POST[$nonceName]))
        return $postId;
    // 验证nonce是否正确
    if (!wp_verify_nonce($_POST[$nonceName], $nonceName))
        return $postId;

    // 如果是系统自动保存，则不操作
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $postId;
    }
    return update_post_meta($postId, $key, $_POST[$key]);
}

/**
 * Checking the authority
 *
 * @param $postId
 * @return mixed
 */
function checkAuthority($postId) {
    if (isset($_POST['post_type'])) {
        if('page' == $_POST['post_type']){
            if(!current_user_can('edit_page', $postId))
                return false;
        }else {
            if(!current_user_can('edit_post', $postId))
                return false;
        }
        return true;
    }
    return false;
}