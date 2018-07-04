<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $table_team = $wpdb->prefix . "team";
    $table_order = $wpdb->prefix . "order";
    $table_order_detail = $wpdb->prefix . "order_detail";
    if ($_POST['order_name']==null || $_POST['order_phone']==null || $_POST['order_name']==null || $_POST['order_mail']==null ||
    $_POST['order_address']==null|| $_POST['order_city']==null || $_POST['order_district']==null | $_POST['order_ward']==null)
    {

    }
    else
    {
        if (isset($_SESSION['products']))
        {
            $sum = 0;
            foreach ($_SESSION['products']  as $item) {
                $sum += $item['price']*$item['qty'];
            }
            $insert = $wpdb->insert($table_order, array(
                "order_name" => htmlspecialchars($_POST['order_name']),
                "order_phone" => htmlspecialchars(($_POST['order_phone'])),
                "order_email" => htmlspecialchars($_POST['order_mail']),
                "order_address" => htmlspecialchars($_POST['order_address']),
                "order_city" => htmlspecialchars($_POST['order_city']),
                "order_district" => htmlspecialchars($_POST['order_district']),
                "order_ward" => htmlspecialchars($_POST['order_ward']),
                "order_content" => htmlspecialchars($_POST['order_content']),
                "total_price" => htmlspecialchars($sum),
                "order_status" => 1,
                "order_date" => date('Y-m-d H:i:s'),
                "is_delete" => 0,
            )
        );
            $last_insert_id = $wpdb->insert_id;
        }
        else
        {

        }
    }
}
?>