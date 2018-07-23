<?php
/**
 * Plugin Name: Logo Partner
 * Description: Quản Lý Đối Tác
 * Version: 1.0
 * Author: Anh Duy
 */
define('PARTNER_FILTER_PLUGIN_URL', plugin_dir_url(__FILE__));
define('PARTNER_FILTER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('PARTNER_FILTER_INCLUDES_DIR', plugin_dir_path(__FILE__));
include(PARTNER_FILTER_INCLUDES_DIR."includes/function-partner.php");

/* Menu quản lý đối tác */
function lp_manage_menu() 
{
    add_menu_page('Logo Partner', 'Logo Partner', 'manage_options','list-partner','list_logo_partner','', 9);
}
add_action('admin_menu', 'lp_manage_menu');

/* Submenu tạo đối tác */ 
function lp_create_partner()
{
	add_submenu_page( 'list-partner', 'Create Partner', 'Create Partner', 'manage_options', 'partner-create','create_logo_partner');
}
add_action('admin_menu', 'lp_create_partner');

function lp_detail_partner()
{
	add_submenu_page( '', 'Cập Nhật', 'Cập Nhật', 'manage_options', 'partner-detail','detail_logo_partner');
}
add_action('admin_menu', 'lp_detail_partner');

function lp_delete_partner()
{
	add_submenu_page( '', 'Xoá Đối Tác', 'Xoá Đối Tác', 'manage_options', 'partner-delete','delete_logo_partner');
}
add_action('admin_menu', 'lp_delete_partner');