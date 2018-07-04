<?php
if (isset($_GET['type']) && $_GET['type']='delete' ) {
    global $wpdb;
    $table_team = "wp_products";
    $data_prepare = $wpdb->prepare("SELECT * FROM $table_team WHERE id = %d", $_GET['id']);
    $data_team = $wpdb->get_row($data_prepare);
    if ($data_team) {
        $update = $wpdb->update($table_team, array(
            'is_delete' => 0
        ), array('id' => $_GET['id']));
        if ($update) {
            wp_redirect('../wp-admin/admin.php?page=product_view');
            exit;
        } else {
            wp_redirect('../wp-admin/admin.php?page=product_view');
            exit;
        }
    }
}
?>