<?php
/**
 * Plugin Name: Video Management
 * Description: Quản Lý Video
 * Version: 1.0
 * Author: Anh Duy
 */
define('VIDEO_FILTER_PLUGIN_URL', plugin_dir_url(__FILE__));
define('VIDEO_FILTER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('VIDEO_FILTER_INCLUDES_DIR', plugin_dir_path(__FILE__));
include(VIDEO_FILTER_INCLUDES_DIR."includes/function-video.php");
function mv_manage_menu() 
{
    add_menu_page('Manage Video', 'Manage Video', 'manage_options','list-video','list_manage_video','', 8);
}
add_action('admin_menu', 'mv_manage_menu'); 