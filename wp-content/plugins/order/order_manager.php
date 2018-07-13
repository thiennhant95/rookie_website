<?php
/**
 * Plugin Name: Order
 * Description: Quản Lý Công Ty
 * Version: 1.0
 * Author: Nhân Trần
 */
define('ORDER_FILTER_PLUGIN_URL', plugin_dir_url(__FILE__));
define('ORDER_FILTER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ORDER_FILTER_INCLUDES_DIR', plugin_dir_path(__FILE__));
include(ORDER_FILTER_INCLUDES_DIR."includes/order.php");

function cm_create_menu_order()
{
    add_menu_page('Đơn Hàng', 'Đơn Hàng', 'manage_options','order_view','show_order_view','', 7);
}
add_action('admin_menu', 'cm_create_menu_order');

?>
