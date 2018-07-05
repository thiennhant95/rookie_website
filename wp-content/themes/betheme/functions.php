<?php
/**
 * Theme Functions
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */


define( 'THEME_DIR', get_template_directory() );
define( 'THEME_URI', get_template_directory_uri() );

define( 'THEME_NAME', 'betheme' );
define( 'THEME_VERSION', '17.6' );

define( 'LIBS_DIR', THEME_DIR. '/functions' );
define( 'LIBS_URI', THEME_URI. '/functions' );
define( 'LANG_DIR', THEME_DIR. '/languages' );

add_filter( 'widget_text', 'do_shortcode' );

add_filter( 'the_excerpt', 'shortcode_unautop' );
add_filter( 'the_excerpt', 'do_shortcode' );


/* ---------------------------------------------------------------------------
 * White Label
 * IMPORTANT: We recommend the use of Child Theme to change this
 * --------------------------------------------------------------------------- */
defined( 'WHITE_LABEL' ) or define( 'WHITE_LABEL', false );


/* ---------------------------------------------------------------------------
 * Loads Theme Textdomain
 * --------------------------------------------------------------------------- */
load_theme_textdomain( 'betheme',  LANG_DIR );
load_theme_textdomain( 'mfn-opts', LANG_DIR );


/* ---------------------------------------------------------------------------
 * Loads the Options Panel
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'mfn_admin_scripts' ) )
{
	function mfn_admin_scripts() {
		wp_enqueue_script( 'jquery-ui-sortable' );
	}
}   
add_action( 'wp_enqueue_scripts', 'mfn_admin_scripts' );
add_action( 'admin_enqueue_scripts', 'mfn_admin_scripts' );
	
require( THEME_DIR .'/muffin-options/theme-options.php' );

$theme_disable = mfn_opts_get( 'theme-disable' );


/* ---------------------------------------------------------------------------
 * Loads Theme Functions
 * --------------------------------------------------------------------------- */

// Functions ------------------------------------------------------------------
require_once( LIBS_DIR .'/theme-functions.php' );

// Header ---------------------------------------------------------------------
require_once( LIBS_DIR .'/theme-head.php' );

// Menu -----------------------------------------------------------------------
require_once( LIBS_DIR .'/theme-menu.php' );
if( ! isset( $theme_disable['mega-menu'] ) ){
	require_once( LIBS_DIR .'/theme-mega-menu.php' );
}

// Muffin Builder -------------------------------------------------------------
require_once( LIBS_DIR .'/builder/fields.php' );
require_once( LIBS_DIR .'/builder/back.php' );
require_once( LIBS_DIR .'/builder/front.php' );

// Custom post types ----------------------------------------------------------
$post_types_disable = mfn_opts_get( 'post-type-disable' );

if( ! isset( $post_types_disable['client'] ) ){
	require_once( LIBS_DIR .'/meta-client.php' );
}
if( ! isset( $post_types_disable['offer'] ) ){
	require_once( LIBS_DIR .'/meta-offer.php' );
}
if( ! isset( $post_types_disable['portfolio'] ) ){
	require_once( LIBS_DIR .'/meta-portfolio.php' );
}
if( ! isset( $post_types_disable['slide'] ) ){
	require_once( LIBS_DIR .'/meta-slide.php' );
}
if( ! isset( $post_types_disable['testimonial'] ) ){
	require_once( LIBS_DIR .'/meta-testimonial.php' );
}

if( ! isset( $post_types_disable['layout'] ) ){
	require_once( LIBS_DIR .'/meta-layout.php' );
}
if( ! isset( $post_types_disable['template'] ) ){
	require_once( LIBS_DIR .'/meta-template.php' );
}

require_once( LIBS_DIR .'/meta-page.php' );
require_once( LIBS_DIR .'/meta-post.php' );

// Content ----------------------------------------------------------------------
require_once( THEME_DIR .'/includes/content-post.php' );
require_once( THEME_DIR .'/includes/content-portfolio.php' );

// Shortcodes -------------------------------------------------------------------
require_once( LIBS_DIR .'/theme-shortcodes.php' );

// Hooks ------------------------------------------------------------------------
require_once( LIBS_DIR .'/theme-hooks.php' );

// Widgets ----------------------------------------------------------------------
require_once( LIBS_DIR .'/widget-functions.php' );

require_once( LIBS_DIR .'/widget-flickr.php' );
require_once( LIBS_DIR .'/widget-login.php' );
require_once( LIBS_DIR .'/widget-menu.php' );
require_once( LIBS_DIR .'/widget-recent-comments.php' );
require_once( LIBS_DIR .'/widget-recent-posts.php' );
require_once( LIBS_DIR .'/widget-tag-cloud.php' );

// TinyMCE ----------------------------------------------------------------------
require_once( LIBS_DIR .'/tinymce/tinymce.php' );

// Plugins ---------------------------------------------------------------------- 
if( ! isset( $theme_disable['demo-data'] ) ){
	require_once( LIBS_DIR .'/importer/import.php' );
}

require_once( LIBS_DIR .'/system-status.php' );

require_once( LIBS_DIR .'/class-love.php' );
require_once( LIBS_DIR .'/class-tgm-plugin-activation.php' );

require_once( LIBS_DIR .'/plugins/visual-composer.php' );

// WooCommerce specified functions
if( function_exists( 'is_woocommerce' ) ){
	require_once( LIBS_DIR .'/theme-woocommerce.php' );
}

// Disable responsive images in WP 4.4+ if Retina.js enabled
if( mfn_opts_get( 'retina-js' ) ){
	add_filter( 'wp_calculate_image_srcset', '__return_false' );
}

// Hide activation and update specific parts ------------------------------------

// Slider Revolution
if( ! mfn_opts_get( 'plugin-rev' ) ){
	if( function_exists( 'set_revslider_as_theme' ) ){
		set_revslider_as_theme();
	}
}

// LayerSlider
if( ! mfn_opts_get( 'plugin-layer' ) ){
	add_action('layerslider_ready', 'mfn_layerslider_overrides');
	function mfn_layerslider_overrides() {
		// Disable auto-updates
		$GLOBALS['lsAutoUpdateBox'] = false;
	}
}

// Visual Composer 
if( ! mfn_opts_get( 'plugin-visual' ) ){
	add_action( 'vc_before_init', 'mfn_vcSetAsTheme' );
	function mfn_vcSetAsTheme() {
		vc_set_as_theme();
	}
}

/* Khởi tạo session */
function myStartSession() {
  session_start();
}
add_action('init', 'myStartSession', 1);

/* convert tên hình */
function sanitize_file_name_chars($filename) {

    $sanitized_filename = remove_accents($filename); // Convert to ASCII

    // Standard replacements
    $invalid = array(
        ' ' . '=&gt;' . '-',
        '%20' . '=&gt;' . '-',
        '_' . '=&gt;' . '-'
    );
    $sanitized_filename = str_replace(array_keys($invalid), array_values($invalid), $sanitized_filename);

    $sanitized_filename = preg_replace('/[^A-Za-z0-9-\. ]/', '', $sanitized_filename); // Remove all non-alphanumeric except .
    $sanitized_filename = preg_replace('/\.(?=.*\.)/', '', $sanitized_filename); // Remove all but last .
    $sanitized_filename = preg_replace('/-+/', '-', $sanitized_filename); // Replace any more than one - in a row
    $sanitized_filename = str_replace('-.', '.', $sanitized_filename); // Remove last - if at the end
    $sanitized_filename = strtolower($sanitized_filename); // Lowercase
    $sanitized_filename = time() . $sanitized_filename;
    return $sanitized_filename;
}

add_filter('sanitize_file_name', 'sanitize_file_name_chars', 10);

/// đường dẫn trang chi tiết bài viết nhóm /
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    if (count($path) >=3) {
        $templatename = 'bai-viet';
        if ($path[2] == $templatename) {
            $load = locate_template('group-team/detail-post-team.php', true);
            if ($load) {
                exit();
            }
        }
    }
});

/* đường dẫn thông tin sản phẩm chi tiết trang cá nhân */
add_action('init', function() {
  $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
  $path = explode("/",$url_path);
    if (count($path) >=3) {
        $templatename = 'san-pham';
        if ($path[2] == $templatename) {
            $load = locate_template('group-team/detail-product-team.php', true);
            if ($load) {
                exit();
            }
        }
    }
});

/* đường dẫn thông tin trang cá nhân */
add_action('init', function() {
  $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
  $path = explode("/",$url_path);
  $templatename = 'group-team';
  if($path[0] == $templatename){
     $load = locate_template('group-team/information-team.php', true);
     if ($load) {
        exit();
     }
  }
});

/* đường dẫn thông tin quản lý trang team */
add_action('init', function() {
  $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
  $path = explode("/",$url_path);
  $templatename = "manage-group"; 
  if($path[0] == $templatename){
     $load = locate_template('group-team/manage-page-team.php', true);
     if ($load) {
        exit();
     }
  }
});

/* đường dẫn thông tin trang cá nhân */
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'xu-ly';
    if($path[0] == $templatename){
        $load = locate_template('xu_ly.php', true);
        if ($load) {
            exit();
        }
    }
});

add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'xu-ly-dang-nhap';
    if($path[0] == $templatename){
        $load = locate_template('dang_nhap.php', true);
        if ($load) {
            exit();
        }
    }
});
/**
 * Load jQuery datepicker.
 *
 * By using the correct hook you don't need to check `is_admin()` first.
 * If jQuery hasn't already been loaded it will be when we request the
 * datepicker script.
 */
function wpse_enqueue_datepicker() {
    // Load the datepicker script (pre-registered in WordPress).
    wp_enqueue_script( 'jquery-ui-datepicker' );

    // You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
    wp_register_style( 'jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
    wp_enqueue_style( 'jquery-ui' );
}
add_action( 'wp_enqueue_scripts', 'wpse_enqueue_datepicker');

function wptuts_scripts_basic()
{
    // Register the script like this for a theme:
    wp_register_script( 'custom-script', get_template_directory_uri() . '/js/jquery.validate-1.14.0.min.js' );

    wp_register_script( 'custom-script', get_template_directory_uri() . '/js/jquery-validate.bootstrap-tooltip.js' );

    wp_enqueue_style ('theme-style', get_template_directory_uri().'/css/darktooltip.min.css');

    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'wptuts_scripts_basic');

function create_fbgraph_shortcode1($args, $content) {
    global $wpdb;
    $table_products = $wpdb->prefix."products";
    $data = "SELECT * FROM $table_products LIMIT 4 OFFSET 0";
    $product_list =$wpdb->get_results($data);

    ob_start();?>
    <div class="fb-info">
        <h5>Thông tin của</h5>
        <div class="avatar"><img alt="" src="" /></div>
        <div class="info"><strong>ID của bạn: </strong>
            <strong>Username: </strong>
            <strong>Giới tính: </strong></div>
    </div>
    <?php
    $result = ob_get_contents();
    ob_end_clean();

    return $result;

}

function create_shortcode_randompost() {

    global $wpdb;
    $table_products = $wpdb->prefix."products";
    $data = "SELECT * FROM $table_products WHERE status=1 LIMIT 4 OFFSET 0";
    $product_list =$wpdb->get_results($data);

    ob_start();
    ?>
    <div class="shop-items">
    <div class="container-fluid">
    <div class="row">
    <?php
    $i=1;
    $images_url = home_url()."/wp-content/uploads/image-product/";
    foreach ($product_list as $row):
        $arr_image_products =json_decode($row->product_images)
        ?>
        <form id="product-<?php echo $i?>" method="post" action="<?php echo home_url('shopping')?>">
        <div class="col-md-3 col-sm-6">
            <!-- Restaurant Item -->
            <div class="item">
                <!-- Item's image -->
                <img class="img-responsive" src="<?php echo $images_url.$arr_image_products[0] ?>" alt="">
                <!-- Item details -->
                <div class="item-dtls">
                    <!-- product title -->
                    <h4><a href="<?php echo home_url()."/chi-tiet-san-pham/".$row->product_slug ?>"><?php echo $row->product_name ?></a></h4>
                    <!-- price -->
                    <span class="price lblue"><?php echo number_format($row->product_price)."đ" ?></span>
                </div>
                <!-- add to cart btn -->
                <div class="ecom bg-lblue">

                    <input type="hidden" name="product_id" value="<?php echo $row->id?>" />
                    <?php
                    $current_url = base64_encode($_SERVER['REQUEST_URI']);
                    ?>
                    <input type="hidden" name="return_url" value="<?php echo $current_url ?>" />
                    <input type="hidden" name="type" value="add">
                    <a href="javascript:void()" onclick="document.getElementById('product-<?php echo $i?>').submit()" class="btn" href="/shoping-car/"><i class="fa fa-shopping-cart"></i> Giỏ Hàng</a>

                </div>
            </div>
        </div>
        </form>
        <?php
        $i++;
    endforeach;
    ?>
    </div>
    </div>
    </div>
        <?php
    $list_post = ob_get_contents(); //Lấy toàn bộ nội dung phía trên bỏ vào biến $list_post để return

    ob_end_clean();

    return $list_post;
}
add_shortcode('random_post', 'create_shortcode_randompost');

add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'shopping';
    if($path[0] == $templatename){
        $load = locate_template('xu_ly_shoping.php', true);
        if ($load) {
            exit();
        }
    }
});
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'thanhtoan';
    if($path[0] == $templatename){
        $load = locate_template('xu_ly_thanh_toan.php', true);
        if ($load) {
            exit();
        }
    }
});

function ranking_team() {
    ob_start();
    ?>
                <table class="table table-reponsive table-condensed table-hover table-striped table-bordered ranking-table" style="color:#595959; margin-top: 30px">
                    <thead>
                    <tr>
                        <td id="title-ranking" colspan="3">BẢNG XẾP HẠNG</td>
                    </tr>
                    <tr>
                        <th width="15%"><strong>Hạng</strong></th>
                        <th><strong>Nhóm</strong></th>
                        <th width="20%"><strong>Điểm</strong></th>
                    </tr>
                    </thead>
                    <tbody>
<!--                    <tr>-->
<!--                        <td style="vertical-align: middle" height="360px" colspan="3"><strong>Đang cập nhật</strong></td>-->
<!--                    </tr>-->

                    <tr>
                        <td class="text-danger" style="vertical-align: middle; text-align: center">1</td>
                        <td class="text-danger" style="vertical-align: middle; text-align: center"><img class="images-logo pull-left" src="<?php echo home_url('wp-content/uploads/2016/09/logo1.png')?>">&nbsp;Nhanh Nhẹn</td>
                        <td style="vertical-align: middle; text-align: center">180</td>
                    </tr>
                    <tr>
                        <td class="text-success" style="vertical-align: middle; text-align: center">2</td>
                        <td class="text-success" style="vertical-align: middle; text-align: center"><img class="images-logo pull-left" src="<?php echo home_url('wp-content/uploads/2016/09/logo1.png')?>">&nbsp;Supper Ship</td>
                        <td style="vertical-align: middle; text-align: center">170</td>
                    </tr>
                    <tr>
                        <td class="text-primary" style="vertical-align: middle; text-align: center">3</td>
                        <td class="text-primary" style="vertical-align: middle; text-align: center"><img class="images-logo pull-left" src="<?php echo home_url('wp-content/uploads/2016/09/logo1.png')?>">&nbsp;Fly</td>
                        <td style="vertical-align: middle; text-align: center">160</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle; text-align: center">4</td>
                        <td style="vertical-align: middle; text-align: center"><img class="images-logo pull-left" src="<?php echo home_url('wp-content/uploads/2016/09/logo1.png')?>">&nbsp;Fish</td>
                        <td style="vertical-align: middle; text-align: center">150</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle; text-align: center">5</td>
                        <td style="vertical-align: middle; text-align: center"><img class="images-logo pull-left" src="<?php echo home_url('wp-content/uploads/2016/09/logo1.png')?>">&nbsp;Shark</td>
                        <td style="vertical-align: middle; text-align: center">140</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle; text-align: center">6</td>
                        <td style="vertical-align: middle; text-align: center"><img class="images-logo pull-left" src="<?php echo home_url('wp-content/uploads/2016/09/logo1.png')?>">&nbsp;Angel</td>
                        <td style="vertical-align: middle; text-align: center">130</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle; text-align: center">7</td>
                        <td style="vertical-align: middle; text-align: center"><img class="images-logo pull-left" src="<?php echo home_url('wp-content/uploads/2016/09/logo1.png')?>">&nbsp;Nhanh Nhẹn</td>
                        <td style="vertical-align: middle; text-align: center">120</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle; text-align: center">8</td>
                        <td style="vertical-align: middle; text-align: center"><img class="images-logo pull-left" src="<?php echo home_url('wp-content/uploads/2016/09/logo1.png')?>">&nbsp;Nhanh Nhẹn</td>
                        <td style="vertical-align: middle; text-align: center">110</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle; text-align: center">9</td>
                        <td style="vertical-align: middle; text-align: center"><img class="images-logo pull-left" src="<?php echo home_url('wp-content/uploads/2016/09/logo1.png')?>">&nbsp;Nhanh Nhẹn</td>
                        <td style="vertical-align: middle; text-align: center">100</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle; text-align: center">10</td>
                        <td style="vertical-align: middle; text-align: center"><img class="images-logo pull-left" src="<?php echo home_url('wp-content/uploads/2016/09/logo1.png')?>">&nbsp;Nhanh Nhẹn</td>
                        <td style="vertical-align: middle; text-align: center">90</td>
                    </tr>
                    </tbody>
                </table>
    <?php
    $list_post = ob_get_contents(); //Lấy toàn bộ nội dung phía trên bỏ vào biến $list_post để return

    ob_end_clean();

    return $list_post;
}
add_shortcode('ranking', 'ranking_team');

/// Cập nhật mật khẩu nhóm /
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'change-password';
    if($path[0] == $templatename){
        $load = locate_template('group-team/includes/change-password.php', true);
        if ($load) {
            exit();
        }
    }
});

/// Cập nhật thông tin nhóm /
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'change-information-group';
    if($path[0] == $templatename){
        $load = locate_template('group-team/includes/change-information.php', true);
        if ($load) {
            exit();
        }
    }
});

/// Cập nhật thông tin nhóm /
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'change-description-group';
    if($path[0] == $templatename){
        $load = locate_template('group-team/includes/change-description.php', true);
        if ($load) {
            exit();
        }
    }
});

/// Xử lý upload hình nhóm ajax /
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'upload-avatar-group';
    if($path[0] == $templatename){
        $load = locate_template('group-team/includes/upload-image.php', true);
        if ($load) {
            exit();
        }
    }
});

/// Đăng xuất /
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'dang-xuat';
    if($path[0] == $templatename){
        $load = locate_template('log-out.php', true);
        if ($load) {
            exit();
        }
    }
});

/* Bootstrap css , jquery admin page */
function admin_styles(){
    wp_register_style( 'am_admin_bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css');
    wp_register_style( 'am_admin_darktooltip', get_template_directory_uri() . '/css/darktooltip.min.css' );
    wp_register_style( 'am_admin_custom_style_admin', get_template_directory_uri() . '/css/admin-custom-style.css' );
    wp_register_style( 'am_admin_bootstrap_datatables', '//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.min.css');
    wp_enqueue_script( 'am_admin_jquery', get_template_directory_uri() . '/js/jquery-3.1.1.min.js' );
    wp_enqueue_script( 'am_admin_bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js' );
    wp_enqueue_script( 'am_admin_validate_tooltips', get_template_directory_uri() . '/js/jquery-validate.bootstrap-tooltip.js' );
    wp_enqueue_script( 'am_admin_jquery_validate', get_template_directory_uri() . '/js/jquery.validate-1.14.0.min.js' );
    wp_enqueue_script( 'am_admin_jquery_datatables', '//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js');
    wp_enqueue_script( 'am_admin_bootstrap_datatables', '//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js');  
    wp_enqueue_style( 'am_admin_bootstrap');
    wp_enqueue_style( 'am_admin_darktooltip');
    wp_enqueue_style('am_admin_custom_style_admin');
    wp_enqueue_style('am_admin_bootstrap_datatables');
}
add_action( 'admin_enqueue_scripts', 'admin_styles' );
//xoa sp
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'xoa-product';
    if($path[0] == $templatename){
        $load = locate_template('xuly_product/delete.php', true);
        if ($load) {
            exit();
        }
    }
});
//them-sp
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'them-product';
    if($path[0] == $templatename){
        $load = locate_template('xuly_product/add.php', true);
        if ($load) {
            exit();
        }
    }
});
//cập nhật
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'update-product';
    if($path[0] == $templatename){
        $load = locate_template('xuly_product/edit.php', true);
        if ($load) {
            exit();
        }
    }
});

//cập nhật
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'admin-team';
    if($path[0] == $templatename){
        $load = locate_template('xuly_product/admin_team.php', true);
        if ($load) {
            exit();
        }
    }
});

#add nhom admin
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'xu-ly-admin';
    if($path[0] == $templatename){
        $load = locate_template('xu-ly-admin.php', true);
        if ($load) {
            exit();
        }
    }
});
/// Đăng bài viết /
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'post-group-team';
    if($path[0] == $templatename){
        $load = locate_template('group-team/includes/post-group.php', true);
        if ($load) {
            exit();
        }
    }
});

/* Xử lý đăng ký sản phẩm nhóm */
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'xu-ly-dang-ky-san-pham';
    if($path[0] == $templatename){
        $load = locate_template('group-team/products/function-product.php', true);
        if ($load) {
            exit();
        }
    }
});

//page đặt hàng thành công
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'dat-hang-thanh-cong';
    if($path[0] == $templatename){
        $load = locate_template('success_order.php', true);
        if ($load) {
            exit();
        }
    }
});

//page đặt hàng thành công
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'xac-nhan-tai-khoan';
    if($path[0] == $templatename){
        $load = locate_template('xac_nhan_tai_khoan.php', true);
        if ($load) {
            exit();
        }
    }
});

/* Chi tiết sản phẩm */
add_action('init', function() {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $path = explode("/",$url_path);
    $templatename = 'chi-tiet-san-pham';
    if($path[0] == $templatename){
        $load = locate_template('product-detail.php', true);
        if ($load) {
            exit();
        }
    }
});