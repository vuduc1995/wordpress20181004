<?php
/**
 * Metro Magazine functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Metro_Magazine
 */

//define theme version
if ( !defined( 'METRO_MAGAZINE_THEME_VERSION' ) ) {
	$theme_data = wp_get_theme();
	
	define ( 'METRO_MAGAZINE_THEME_VERSION', $theme_data->get( 'Version' ) );
}

/**
 * Implement the Custom functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Implement the WordPress Hooks.
 */
require get_template_directory() . '/inc/wp-hooks.php';

/**
 * Custom template function for this theme.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom template hooks for this theme.
 */
require get_template_directory() . '/inc/template-hooks.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load plugin for right and no sidebar
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Load widgets.
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Dynamic Styles
 */
require get_template_directory() . '/css/style.php';

/**
* Recommended Plugins
*/
require_once get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

//Tạo nút con trong phần post

function tao_custom_post_type()
{
 
    /*
     * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin
     */
    $label = array(
        'name' => 'Các bài viết', //Tên post type dạng số nhiều
        'singular_name' => 'Bài viết' //Tên post type dạng số ít
    );
 
    /*
     * Biến $args là những tham số quan trọng trong Post Type
     */
    $args = array(
        'labels' => $label, //Gọi các label trong biến $label ở trên
        'description' => 'Post type đăng sản phẩm', //Mô tả của post type
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'author',
            'thumbnail',
            'comments',
            'trackbacks',
            'revisions',
            'custom-fields'
        ), //Các tính năng được hỗ trợ trong post type
        'taxonomies' => array( 'category', 'post_tag' ), //Các taxonomy được phép sử dụng để phân loại nội dung
        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
        'public' => true, //Kích hoạt post type
        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => '', //Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post' //
    );
 
    register_post_type('baiviet', $args); //Tạo post type với slug tên là baiviet và các tham số trong biến $args ở trên
 
}
/* Kích hoạt hàm tạo custom post type */
add_action('init', 'tao_custom_post_type');

/* Hiển thị bài trong custom post type ra trang chủ */
add_filter('pre_get_posts','lay_custom_post_type');
function lay_custom_post_type($query) {
  if (is_home() && $query->is_main_query ())
    $query->set ('post_type', array ('post','baiviet'));
    return $query;
}



