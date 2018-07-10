<?php
/**
 * Plugin Name: Doanh Thu
 * Description: Quản Lý Công Ty
 * Version: 1.0
 * Author: Anh Duy
 */
define('REVENUE_FILTER_PLUGIN_URL', plugin_dir_url(__FILE__));
define('REVENUE_FILTER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('REVENUE_FILTER_INCLUDES_DIR', plugin_dir_path(__FILE__));
include(REVENUE_FILTER_INCLUDES_DIR."includes/revenue.php");

function cm_create_menu_revenue()
{
    add_menu_page('Doanh Thu', 'Doanh Thu', 'manage_options','revenue_view','show_revenue_view','', 4);
}
add_action('admin_menu', 'cm_create_menu_revenue');

?>
