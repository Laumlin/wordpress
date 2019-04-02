<?php
if (!defined('Z_PLUGIN_URL'))
	define('Z_PLUGIN_URL', untrailingslashit(plugins_url('', __FILE__)));

define('Z_IMAGE_PLACEHOLDER', get_template_directory_uri()."/assets/images/ad.png");

add_action('admin_init', 'initTaxonomy');
function initTaxonomy() {
	$taxonomies = get_taxonomies();
	if (is_array($taxonomies)) {
	    foreach ($taxonomies as $taxonomy) {
	        add_action($taxonomy.'_add_form_fields', 'addTaxonomyField');
			add_action($taxonomy.'_edit_form_fields', 'editTaxonomyField');
			add_filter('manage_edit-' . $taxonomy . '_columns', 'addTaxonomyColumns');
			add_filter('manage_' . $taxonomy . '_custom_column', 'addTaxonomyColumn', 10, 3);
	    }
	}
}

function addTaxonomyColumns($columns) {
    $column = array();
    $column['thumbnail'] = "图像";
    return array_merge($column, $columns);
}

function addTaxonomyColumn($columns, $column, $id) {
    if ($column == 'thumbnail')
        $columns = '<span><img src="'.getTaxonomyImageUrl($id, NULL, TRUE) .'" class="wp-post-image" /></span>';

    return $columns;
}

function addTaxonomyStyle() {
	echo '<style type="text/css" media="screen">
		th.column-thumb {width:60px;}
		.form-field img.taxonomy-image {display:block;max-width:100%;border:1px solid #eee;max-height:300px;}
		.column-thumb span {width:48px;height:48px;border:1px solid #eee;display:inline-block;}
		.inline-edit-row fieldset .thumb img,.column-thumbnail img {display: block; width:100%;height:80px;}
	</style>';
}

// add image field in add form
function addTaxonomyField() {
	if (get_bloginfo('version') >= 3.5)
		wp_enqueue_media();
	else {
		wp_enqueue_style('thickbox');
		wp_enqueue_script('thickbox');
	}
	echo '<div class="form-field">
		<label for="taxonomy_image">' . __('图像', 'zci') . '</label>
		<input type="text" name="taxonomy_image" id="taxonomy_image" value="" />
		<br/>
		<button class="z_upload_image_button button">' . __('上传/添加图像', 'zci') . '</button>
	</div>'.z_script();
}

/**
 * @param $taxonomy
 *
 */
function editTaxonomyField($taxonomy) {
	if (get_bloginfo('version') >= 3.5)
		wp_enqueue_media();
	else {
		wp_enqueue_style('thickbox');
		wp_enqueue_script('thickbox');
	}

	if (getTaxonomyImageUrl($taxonomy->term_id, NULL, TRUE ) == Z_IMAGE_PLACEHOLDER)
		$image_text = "";
	else
		$image_text = getTaxonomyImageUrl( $taxonomy->term_id, NULL, TRUE );

	$icon = get_term_meta($taxonomy->term_id, "taxonomyIcon", true);
	echo '<tr class="form-field">
		<th scope="row" valign="top"><label for="taxonomy_image">' . __('图像', 'zci') . '</label></th>
		<td><img class="taxonomy-image" src="' . getTaxonomyImageUrl( $taxonomy->term_id, NULL, TRUE ) . '"/><br/><input type="text" name="taxonomy_image" id="taxonomy_image" value="'.$image_text.'" /><br />
		<button class="z_upload_image_button button">' . __('上传/添加图像', 'zci') . '</button>
		<button class="z_remove_image_button button">' . __('删除图像', 'zci') . '</button>
		</td>
	</tr>'.z_script();
}
// upload using wordpress upload
function z_script() {
	return '<script type="text/javascript">
	    jQuery(document).ready(function($) {
			var wordpress_ver = "'.get_bloginfo("version").'", upload_button;
			$(".z_upload_image_button").click(function(event) {
				upload_button = $(this);
				var frame;
				if (wordpress_ver >= "3.5") {
					event.preventDefault();
					if (frame) {
						frame.open();
						return;
					}
					frame = wp.media();
					frame.on( "select", function() {
						// Grab the selected attachment.
						var attachment = frame.state().get("selection").first();
						frame.close();
						if (upload_button.parent().prev().children().hasClass("tax_list")) {
							upload_button.parent().prev().children().val(attachment.attributes.url);
							upload_button.parent().prev().prev().children().attr("src", attachment.attributes.url);
						}
						else
							$("#taxonomy_image").val(attachment.attributes.url);
					});
					frame.open();
				}
				else {
					tb_show("", "media-upload.php?type=image&amp;TB_iframe=true");
					return false;
				}
			});

			$(".z_remove_image_button").click(function() {
				$("#taxonomy_image").val("");
				$(this).parent().siblings(".title").children("img").attr("src","' . Z_IMAGE_PLACEHOLDER . '");
				$(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
				return false;
			});

			if (wordpress_ver < "3.5") {
				window.send_to_editor = function(html) {
					imgurl = $("img",html).attr("src");
					if (upload_button.parent().prev().children().hasClass("tax_list")) {
						upload_button.parent().prev().children().val(imgurl);
						upload_button.parent().prev().prev().children().attr("src", imgurl);
					}
					else
						$("#taxonomy_image").val(imgurl);
					tb_remove();
				}
			}

			$(".editinline").live("click", function(){
			    var tax_id = $(this).parents("tr").attr("id").substr(4);
			    var thumb = $("#tag-"+tax_id+" .thumb img").attr("src");
				if (thumb != "' . Z_IMAGE_PLACEHOLDER . '") {
					$(".inline-edit-col :input[name=\'taxonomy_image\']").val(thumb);
				} else {
					$(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
				}
				$(".inline-edit-col .title img").attr("src",thumb);
			    return false;
			});
	    });
	</script>';
}
// save our taxonomy image while edit or save term
add_action('edit_term','setTaxonomyImageUrl');
add_action('create_term','setTaxonomyImageUrl');

function setTaxonomyImageUrl($term_id) {
    if(isset($_POST['taxonomy_image']))
        update_term_meta($term_id, "taxonomyImage", $_POST['taxonomy_image']);
    if(isset($_POST['taxonomy-icon']))
        update_term_meta($term_id, "taxonomyIcon", $_POST['taxonomy-icon']);
}

// get attachment ID by image url
// getAttachmentIdByUrl
function getAttachmentIdByUrl($image_src) {
    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid = '$image_src'";
    $id = $wpdb->get_var($query);
    return (!empty($id)) ? $id : NULL;
}

// get taxonomy image url for the given term_id (Place holder image by default)
function getTaxonomyImageUrl($term_id = NULL, $size = NULL, $return_placeholder = FALSE) {
	if (!$term_id) {
		if (is_category())
			$term_id = get_query_var('cat');
		elseif (is_tax()) {
			$current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
			$term_id = $current_term->term_id;
		}
	}
	$taxonomy_image_url = get_term_meta($term_id, "taxonomyImage", true);
    if(!empty($taxonomy_image_url)) {
	    $attachment_id = getAttachmentIdByUrl($taxonomy_image_url);
	    if(!empty($attachment_id)) {
	    	if (empty($size))
	    		$size = 'full';
	    	$taxonomy_image_url = wp_get_attachment_image_src($attachment_id, $size);
		    $taxonomy_image_url = $taxonomy_image_url[0];
	    }
	}

    if ($return_placeholder)
		return ($taxonomy_image_url != '') ? $taxonomy_image_url : Z_IMAGE_PLACEHOLDER;
	else
		return $taxonomy_image_url;
}

function quickEditInTaxonomy($column, $screen, $name) {

	if ($column == 'thumbnail')
		echo '<fieldset>
		<div class="thumb inline-edit-col">
			<label>
				<span class="title">图像</span>
				<span class="input-text-wrap"><input type="text" name="taxonomy_image" class="tax_list" /></span>
				<span class="input-text-wrap">
					<button class="z_upload_image_button button">' . __('上传/添加图像', 'zci') . '</button>
					<button class="z_remove_image_button button">' . __('删除图像', 'zci') . '</button>
				</span>
			</label>
		</div>
	</fieldset>';
}

add_action('admin_head', 'addTaxonomyStyle');

// style the image in category list
if (strpos( $_SERVER['SCRIPT_NAME'], 'edit-tags.php') > 0 ) {
	add_action('quick_edit_custom_box', 'quickEditInTaxonomy', 10, 3);
}
