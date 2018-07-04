<?php
/**
 * Plugin Name: Team
 * Description: Quản Lý Công Ty
 * Version: 1.0
 * Author: Nhan
 */
define('TEAM_FILTER_PLUGIN_URL', plugin_dir_url(__FILE__));
define('TEAM_FILTER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('TEAM_FILTER_INCLUDES_DIR', plugin_dir_path(__FILE__));
include(TEAM_FILTER_INCLUDES_DIR."includes/team.php");
//include(COMPANY_FILTER_INCLUDES_DIR."includes/company_job.php");

function cm_create_menu_team()
{
    add_menu_page('Nhóm', 'Nhóm', 'manage_options','team_view','team_view_function','', 3);
}
add_action('admin_menu', 'cm_create_menu_team');

?>
