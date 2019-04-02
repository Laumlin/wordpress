<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings           = array(
    'menu_title'      => ' 黑镜个性化',
    'menu_type'       => 'menu', // menu, submenu, options, theme, etc.
    'menu_slug'       => 'cs-framework',
    'ajax_save'       => true,
    'show_reset_all'  => false,
    'framework_title' => '黑镜个性化 <small>配置菜单</small>',
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();

// ----------------------------------------
// a option section for options overview  -
// ----------------------------------------
$options[]      = array(
	'name'        => 'overview',
	'title'       => '常规',
	'icon'        => 'czs-setting',
	'fields'      => array(
        array(
            'type'  => 'notice',
            'class' => 'info',
            'content'   => '头部设置',
        ),
		array(
			'id'      => 'i_logo_url',
			'type'    => 'upload',
			'title'   => '网站标志',
			'default' => get_template_directory_uri()."/assets/images/logo.png",
			'help'    => '上传网站标志',
			'desc'     => '比例：高度100px，长度354px(高清图片可等比倍数大图皆可)',
		),
		array(
			'id'      => 'i_mobile_logo_url',
			'type'    => 'upload',
			'title'   => '移动端网站标志',
			'default' => get_template_directory_uri()."/assets/images/logo_mobile.png",
			'help'    => '上传移动端网站标志',
			'desc'     => '上传移动端网站标志，建议大小为80 * 80',
		),
        array(
            'id'      => 'i_favicon_url',
            'type'    => 'upload',
            'title'   => 'Favicon网标',
            'default' => get_template_directory_uri()."/assets/images/favicon.ico",
            'help'    => '上传网站favicon',
        ),
		array(
			'id'      => 'i_site_title_switcher',
			'type'    => 'switcher',
			'title'   => '是否显示网站标志处标题',
			'default' => false,
		),
        array(
            'id'      => 'i_site_language_switcher',
            'type'    => 'switcher',
            'title'   => '切换为繁体',
            'default' => false,
        ),
        array(
            'id'      => 'i_admin_login_switcher',
            'type'    => 'switcher',
            'title'   => '显示后台登录按钮',
            'default' => false,
        ),
        // theme color
        array(
            'id'         => 'i_theme_color',
            'type'       => 'color_picker',
            'title'      => '主题配色',
            'default'    => '#38B7EA',
            'info'       => '选择你喜欢的主题颜色',
        ),
        // post setting
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '文章列表设置',
        ),
        array(
            'id'      => 'i_thumbnail_default',
            'type'    => 'upload',
            'title'   => '默认缩略图',
            'default' => get_template_directory_uri()."/assets/images/thumbnail_default.png",
        ),
        array(
            'id' => 'i_posts_per_page',
            'type' => 'number',
            'title' => '首页每页文章数',
            'default' => 12,
        ),
        array(
            'id' => 'i_posts_excerpt_length',
            'type' => 'number',
            'title' => '摘要数量',
            'default' => 100,
        ),
        array(
            'id'      => 'i_admin_login_switcher',
            'type'    => 'switcher',
            'title'   => '显示后台登录按钮',
            'default' => false,
        ),
        array(
            'id'      => 'i_recommend_posts_switcher',
            'type'    => 'switcher',
            'title'   => '开启/关闭首推文章',
            'default' => false,
        ),
        array(
            'id'           => 'i_recommend_posts',
            'type'         => 'text',
            'title'        => '首推文章(输入文章ID，以","隔开，如23,56)',
            'dependency' => array("i_recommend_posts_switcher", "==", "true"),

        ),
        array(
            'id'           => 'i_category_not_in',
            'class'        => 'horizontal',
            'type'         => 'checkbox',
            'title'        => '该分类下文章不显示在文章列表中',
            'options'      => getCategoryArray()
        ),
        array(
            'id'           => 'i_tags',
            'class'        => 'horizontal',
            'type'         => 'checkbox',
            'title'        => '选择首页显示的标签',
            'options'      => getTagArray()
        ),
        array(
            'id'           => 'i_feature_category',
            'class'        => 'horizontal',
            'type'         => 'checkbox',
            'title'        => '特色分类',
            'options'      => getCategoryArray()
        ),
  ),
);

/*
    ==================================================
    footer
    ==================================================
*/
$options[]      = array(
    'name'        => 'footer',
    'title'       => '底部设置',
    'icon'        => 'czs-medal',
    'fields'      => array(
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => 'footer设置',
        ),
        array(
            'id'      => 'i_footer_theme_switcher',
            'type'    => 'switcher',
            'title'   => '底部网站介绍开关',
            'default' => true,
        ),
        array(
            'id'      => 'i_footer_feature_switcher',
            'type'    => 'switcher',
            'title'   => '底部功能开关',
            'default' => true,
        ),
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '底部网站信息',
        ),
        array(
            'id' => 'i_site_date',
            'type' => 'text',
            'title' => '建站时间',
            'default' => 2017,
        ),
        array(
            'id' => 'i_site_version',
            'type' => 'text',
            'title' => '版本号',
            'default' => '2.0',
        ),
        array(
            'id' => 'i_site_description',
            'type' => 'text',
            'title' => '网站简洁介绍',
            'default' => "为极客、创意工作者而设计",
        ),
        array(
            'id'      => 'i_site_record',
            'type'    => 'text',
            'title'   => '网站备案号',
            'default' => "京ICP备1000000号-01",
        ),
        array(
            'id'      => 'i_site_record_href',
            'type'    => 'text',
            'title'   => '网站备案链接',
            'default' => "http://www.miitbeian.gov.cn",
        )
    ),
);

/*
    ==================================================
    图片轮播功能
    ==================================================
*/
$options[]   = array(
	'name'     => 'carousel',
	'title'    => '轮播设置',
	'icon'     => 'czs-image',
	'fields'   => array(
        // 主图轮播
		array(
			'type' => 'notice',
			'class' => 'success',
			'content' => '图片轮播'
		),
        array(
            'id' => 'i_carousel_switcher',
            'type' => 'switcher',
            'title' => '图片轮播功能开关',
            'default' => true,
        ),
        array(
            'id' => 'i_carousel_mousewheel_switcher',
            'type' => 'switcher',
            'title' => '鼠标控制轮播开关',
        ),
        array(
            'id'        => 'i_carousel_opacity',
            'type'      => 'number',
            'title'     => '轮播图遮挡层透明度',
            'default'   => 10,
            'after'     => '<p>轮播图遮挡层透明度，范围是0到100，折/翼\天/使\/资\源/社\区/提\供</p>'
        ),
        array(
            'id'            => 'i_carousel_animation',
            'type'          => 'radio',
            'class'        => 'horizontal',
            'title'         => '选择动画形式（仅限于单图式）',
            'options'       => array(
                'fade'      => '淡入淡出',
                'slide'     => '滑动',
            ),
            'default'      => 'slide',
//            'dependency' => array("i_carousel_type", "any", "one, image"),
        ),
        array(
            'id' => 'i_carousel_info_switcher',
            'type' => 'switcher',
            'title' => '关闭轮播图信息',
            'default'   => false,
        ),
        array(
            'id'        => 'i_carousel_default_numbers',
            'type'      => 'number',
            'title'     => '默认轮播图数量',
            'default'   => 3,
            'after'     => '<p>没有置顶文章和自定义轮播内容时默认显示轮播数量（按照时间顺序显示）</p>'
        ),
		array(
			'type' => 'notice',
			'class' => 'warning',
			'content' => '自定义(广告、标签、分类)'
		),
		// custom carousel
		array(
			'id'              => 'i_carousel_customize',
			'type'            => 'group',
			'title'           => '添加自定义链接',
			'button_title'    => '添加',
			'accordion_title' => '新添加自定义类型',
			'fields'          => array(
				array(
					'id'          => 'i_carousel_customize_title',
					'type'        => 'text',
					'title'       => '标题',
				),
				array(
					'id'          => 'i_carousel_customize_switcher',
					'type'        => 'switcher',
					'title'       => '显示开关',
					'default'     => true,
				),
				array(
					'id'          => 'i_carousel_customize_url',
					'type'        => 'text',
					'title'       => '链接地址',
                    'after'     => '<p><b>填写完整的url地址(http://....)</b></p>',
				),
				array(
					'id'      => 'i_carousel_customize_img',
					'type'    => 'upload',
					'title'   => '图片',
					'default' => get_template_directory_uri()."/assets/images/carousel_bg.png",
					'help'    => '上传背景',
				),
			)
		),
	)
);

/*
    ==================================================
    小功能
    ==================================================
*/
$options[]   = array(
    'name'     => 'function',
    'title'    => '小功能',
    'icon'     => 'czs-microchip',
    'fields'   => array(
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '去除head冗余代码',
        ),
        array(
            'id' => 'i_function_version_switcher',
            'type' => 'switcher',
            'title' => '移除wordpress版本号',
            'default' => true,
        ),
        array(
            'id' => 'i_function_emoji_switcher',
            'type' => 'switcher',
            'title' => '移除emoji',
            'default' => true,
        ),
        array(
            'id' => 'i_function_embed_switcher',
            'type' => 'switcher',
            'title' => '移除embed',
            'default' => true,
        ),
        array(
            'id' => 'i_function_element_switcher',
            'type' => 'switcher',
            'title' => '移除head头部多余元素',
            'default' => true,
        ),
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => 'HTTPS设置',
        ),
        array(
            'id' => 'i_function_https_switcher',
            'type' => 'switcher',
            'title' => '开启https',
            'default' => false,
        ),
        // avatar
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '头像设置',
        ),
        array(
            'id' => 'i_function_avatar_ssl_switcher',
            'type' => 'switcher',
            'title' => 'gravater被墙，调用ssl头像链接',
            'default' => true,
        ),
//        array(
//            'id'    =>  'i_function_avatar_location',
//            'type'    => 'upload',
//            'title'   => '上传本地头像',
//            'default' => get_template_directory_uri()."/assets/images/avatar.png",
//            'help'    => '上传本地头像',
//        ),
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '分页设置',
        ),
        array(
            'id'            => 'i_pagination_type',
            'type'          => 'radio',
            'class'        => 'horizontal',
            'title'         => '选择分页形式',
            'options'       => array(
                'next'      => '下一页/上一页',
                'number'    => '页码',
                'more'		=> 'ajax加载更多',
            ),
            'default'      => 'more'
        ),
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '个性功能',
        ),
        array(
            'id'    =>  'i_function_fancybox_switcher',
            'type'  =>  'switcher',
            'title' =>  'fancybox功能开关',
            'default'   =>  false,
        )
    )
);
/*
    ==================================================
    布局
    ==================================================
*/
$options[]   = array(
    'name'     => 'layout',
    'title'    => '布局',
    'icon'     => 'czs-layout-grids',
    'fields'   => array(
        array(
            'type'  => 'notice',
            'class' => 'info',
            'content'   => '首页、分类和标签布局',
        ),
        array(
            'id'           => 'i_layout_index_type',
            'type'         => 'radio',
            'class'        => 'horizontal',
            'title'        => '选择首页布局',
            'options'      => array(
                'three'     => '三栏',
                'four'      => '四栏',
            ),
            'default'      => 'three'
        ),
        array(
            'id'           => 'i_layout_archive_type',
            'class'        => 'horizontal',
            'type'         => 'radio',
            'title'        => '选择分类、标签和搜索结果布局',
            'options'      => array(
                'three'     => '三栏',
                'four'      => '四栏',
            ),
            'default'      => 'four'
        ),
    )
);
/*
    ==================================================
    文章页设置
    ==================================================
*/
$options[]   = array(
    'name'     => 'article',
    'title'    => '文章页',
    'icon'     => 'czs-doc-file',
    'fields'   => array(
        array(
            'id'    =>  'i_article_full_switcher',
            'type'  =>  'switcher',
            'title' =>  '文章内容全屏显示(去掉侧边栏)',
            'default'   =>  false,
        ),
        array(
            'type'  => 'notice',
            'class' => 'info',
            'content'   => '文章页样式设置',
        ),
        array(
            'id'    =>  'i_article_tabs_switcher',
            'type'  =>  'switcher',
            'title' =>  '去除标签信息',
            'default'   =>  false,
        ),
        array(
            'id'    =>  'i_article_indent_switcher',
            'type'  =>  'switcher',
            'title' =>  '段落首行缩进',
            'default'   =>  false,
        ),
        array(
            'id'    =>  'i_article_share_switcher',
            'type'  =>  'switcher',
            'title' =>  '显示分享功能',
            'default'   => true,
        ),
        array(
            'id'    =>  'i_article_copyright_switcher',
            'type'  =>  'switcher',
            'title' =>  '显示版权信息',
            'default'   => true,
        ),
        array(
            'id'    =>  'i_article_btn_group_switcher',
            'type'  =>  'switcher',
            'title' =>  '显示文章页侧边栏自定义按钮',
            'default'   => true,
        ),
        array(
            'id'              => 'i_article_btn_group',
            'type'            => 'group',
            'title'           => '添加文章页侧边栏自定义按钮',
            'button_title'    => '添加',
            'accordion_title' => '新添加文章页侧边栏自定义按钮',
            'dependency' => array("i_article_btn_group_switcher", "==", "true"),
            'fields'          => array(
                array(
                    'id'          => 'i_article_btn_switcher',
                    'type'        => 'switcher',
                    'title'       => '显示/隐藏',
                    'default'     => true,
                ),
                array(
                    'id'          => 'i_article_btn_icon',
                    'type'        => 'icon',
                    'title'       => '图标选择',
                ),
                array(
                    'id'        => 'i_article_btn_color',
                    'type'      => 'radio',
                    'class'        => 'horizontal',
                    'title'     => '颜色选择',
                    'options'   => array (
                        'primary'   => '<span style="color:#0275d8;">primary</span>',
                        'success'   => '<span style="color:#67C23A;">success</span>',
                        'warning'   => '<span style="color:#EB9E05;">warning</span>',
                        'danger'    => '<span style="color:#FA5555;">danger</span>',
                        'info'      => '<span style="color:#5bc0de;">info</span>'
                    ),
                    'default'   => 'primary'
                ),
                array(
                    'id'          => 'i_article_btn_url',
                    'type'        => 'text',
                    'title'       => '链接地址',
                ),
            )
        ),
    )
);
/*
    ==================================================
    关注我们
    ==================================================
*/
$options[]   = array(
  	'name'     => 'follow',
  	'title'    => '关注我们',
  	'icon'     => 'czs-people',
  	'fields'   => array(
	  	// follow us
	  	array(
			  'type' => 'notice',
			  'class' => 'warning',
			  'content' => '关注我们'
		),
		array(
		    'id' => 'i_follow_switcher',
		    'type' => 'switcher',
		    'title' => '开启底部关注我们功能',
            'default' => true,
		),
        array(
            'type' => 'notice',
            'class' => 'success',
            'content' => '微信公众号设置',
        ),
//        array(
//            'id' => 'i_sidebar_wechat_switcher',
//            'type' => 'switcher',
//            'title' => '开启侧边栏微信公众号',
//            'default' => true,
//        ),
		array(
		  'id'      => 'i_follow_wechat',
		  'type'    => 'upload',
		  'title'   => '微信公众号二维码',
		  'default' => get_template_directory_uri()."/assets/images/wechat_official_account.png",
		  'help'    => '上传微信公众号二维码',
		),
        array(
            'id' => 'i_follow_wechat_name',
            'type' => 'text',
            'title' => '微信公众号名',
            'default' => '&#25240;&#56;&#32764;&#57;&#22825;&#52;&#20351;&#53;&#36164;&#50;&#28304;&#49;&#31038;&#51;&#21306;',
        ),
        array(
            'id' => 'i_follow_wechat_id',
            'type' => 'text',
            'title' => '微信公众号ID',
            'default' => 'chuangzaoshi',
        ),
        array(
            'id' => 'i_follow_wechat_description',
            'type' => 'text',
            'title' => '微信公众号说明',
            'default' => '扫描关注我们',
        ),
        array(
            'type' => 'notice',
            'class' => 'warning',
            'content' => '其他设置',
        ),
		array(
		  'id'    => 'i_follow_weibo',
		  'type'  => 'text',
		  'title' => '微博地址',
		),
		array(
		    'id'    => 'i_follow_qq',
		    'type'  => 'text',
            'default' => '164903112',
		    'title' => 'qq号',
		),
		array(
		    'id'      => 'i_follow_rss',
		    'type'    => 'switcher',
            'default' => true,
		    'title'   => 'RSS订阅',
		)
	  )
);

/*
    ==================================================
    广告设置
    ==================================================
*/
$options[]   = array(
	'name'     => 'advertisement',
	'title'    => '广告设置',
	'icon'     => 'czs-money',
	'fields'   => array(
		// advertisement
		array(
			'id' => 'i_advertisement_switcher',
			'type' => 'switcher',
			'title' => '一键开关闭广告功能',
			'default' => true,
		),
		array(
			'type' => 'notice',
			'class' => 'success',
			'content' => '文章底部广告设置'
		),
		array(
			'id'   => 'i_advertisement_article_tail',
			'type' => 'textarea',
			'title' => '文章尾部广告代码'
		),
        array(
            'id' => 'i_advertisement_article_tail_switcher',
            'type' => 'switcher',
            'title' => '文章尾部广告代码是否为script代码',
            'default' => true,
        ),
		array(
			'id'   => 'i_advertisement_sidebar',
			'type' => 'textarea',
			'title' => '侧边栏广告代码'
		),
        array(
            'id' => 'i_advertisement_sidebar_switcher',
            'type' => 'switcher',
            'title' => '侧边栏广告代码是否为script代码',
            'default' => true,
        ),
	)
);

/*
    ==================================================
    SEO设置
    ==================================================
*/
$options[]   = array(
    'name'     => 'seo',
    'title'    => 'SEO设置',
    'icon'     => 'czs-bug',
    'fields'   => array(
        array(
            'id' => 'i_seo_category_switcher',
            'type' => 'switcher',
            'title' => '去除url中的category',
        ),
        array(
            'id' => 'i_seo_link_rule',
            'type' => 'switcher',
            'title' => '外链跳转',
            'after'  => '需要创建一个go新页面，链接形式是"/go"',
        ),
        array(
            'id'   => 'i_seo_keywords',
            'type' => 'text',
            'title' => '网站关键字keywords',
            'default' => '黑镜主题',
        ),
        array(
            'id'   => 'i_seo_description',
            'type' => 'textarea',
            'title' => '网站描述description',
            'default' => '黑镜(BlackCandy)主题，一款漂亮而优雅的主题，为自媒体、极客而设计！',
        ),
        array(
            'id'   => 'i_seo_statistics',
            'type' => 'textarea',
            'title' => '统计代码',
            'desc' => '支持百度统计',
        ),

    )
);

/*
    ==================================================
    自定义代码
    ==================================================
*/
$options[]   = array(
    'name'     => 'code',
    'title'    => '自定义',
    'icon'     => 'czs-chemistry',
    'fields'   => array(
        array(
            'class' => 'info',
            'type'  => 'notice',
            'content' => '自定义样式',
        ),
        array(
            'id'            => 'i_category_color_switcher',
            'type'          => 'switcher',
            'title'         => '显示分类信息',
            'default'       => true
        ),
        array(
            'id'         => 'i_category_color',
            'type'       => 'color_picker',
            'title'      => '分类配色',
            'default'    => '#666',
            'info'       => '选择你喜欢的分类颜色',
            'dependency' => array( 'i_category_color_switcher', '==', 'true' ),
        ),
        array(
            'id'         => 'i_category_opacity',
            'type'       => 'number',
            'title'      => '分类配色透明度',
            'default'    => '1',
            'info'       => '选择你喜欢的分类颜色透明度，主题由&#25240;&#56;&#32764;&#57;&#22825;&#52;&#20351;&#53;&#36164;&#50;&#28304;&#49;&#31038;&#51;&#21306;提供',
            'dependency' => array( 'i_category_color_switcher', '==', 'true' ),
        ),
        array(
            'class' => 'info',
            'type'  => 'notice',
            'content' => '自定义代码',
        ),
        array(
            'id'   => 'i_code_footer',
            'type' => 'textarea',
            'title' => 'footer自定义代码',
            'desc'  => '显示在网站版权之前'
        ),
        array(
            'id'   => 'i_code_css',
            'type' => 'textarea',
            'title' => '自定义样式css代码',
            'desc' => '不要添加style标签',
        ),
    )
);
/*
    ==================================================
    Backup
    ==================================================
*/
$options[]   = array(
	'name'     => 'backup_section',
	'title'    => '配置备份',
	'icon'     => 'czs-list-clipboard',
	'fields'   => array(

		array(
			'type'    => 'notice',
			'class'   => 'warning',
			'content' => 'You can save your current options. Download a Backup and Import.',
		),

		array(
			'type'    => 'backup',
		),

	)
);

// ------------------------------
// license                      -
// ------------------------------
$options[]   = array(
  'name'     => 'license_section',
  'title'    => '&#25240;&#56;&#32764;&#57;&#22825;&#52;&#20351;&#53;&#36164;&#50;&#28304;&#49;&#31038;&#51;&#21306;',
  'icon'     => 'czs-chuangzaoshi',
  'fields'   => array(

    array(
      'type'    => 'heading',
      'content' => '黑镜主题-&#25240;&#56;&#32764;&#57;&#22825;&#52;&#20351;&#53;&#36164;&#50;&#28304;&#49;&#31038;&#51;&#21306;'
    ),
    array(
      'type'    => 'content',
      'content' => '漂亮的卡片多图流创意类网站主题模板，详情请访问<a href="http://&#119;&#119;&#119;&#46;&#122;&#104;&#101;&#121;&#105;&#116;&#105;&#97;&#110;&#115;&#104;&#105;&#46;&#99;&#111;&#109;/" target="_blank">黑镜主题</a>',
    ),
    array(
      'type'    => 'content',
      'content' => '黑镜主题图标，配置：<a href="http://www.chuangzaoshi.com/icon" target="_blank">草莓图标库</a>',
    ),

  )
);

CSFramework::instance( $settings, $options );
