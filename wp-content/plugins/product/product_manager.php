<?php
/**
 * Plugin Name: Product
 * Description: Quản Lý Công Ty
 * Version: 1.0
 * Author: Anh Duy
 */
define('COMPANY_FILTER_PLUGIN_URL', plugin_dir_url(__FILE__));
define('COMPANY_FILTER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('COMPANY_FILTER_INCLUDES_DIR', plugin_dir_path(__FILE__));
include(COMPANY_FILTER_INCLUDES_DIR."includes/product.php");
//include(COMPANY_FILTER_INCLUDES_DIR."includes/company_job.php");

function cm_create_menu()
{
    add_menu_page('Sản Phẩm', 'Sản Phẩm', 'manage_options','product_view','show_company_view','', 2);
}
add_action('admin_menu', 'cm_create_menu');

?>
