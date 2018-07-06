_<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $table_team = $wpdb->prefix . "team";
    $table_order = $wpdb->prefix . "order";
    $table_order_detail = $wpdb->prefix . "order_detail";
    if ($_POST['order_name']==null || $_POST['order_phone']==null || $_POST['order_name']==null || $_POST['order_mail']==null ||
    $_POST['order_address']==null|| $_POST['order_city']==null || $_POST['order_district']==null | $_POST['order_ward']==null)
    {
        $_SESSION['loidathang'] =2;
        wp_redirect(home_url('thanh-toan'));
    }
    else
    {
        if (isset($_SESSION['products'])) {
            $sum = 0;
            foreach ($_SESSION['products'] as $item) {
                $sum += $item['price'] * $item['qty'];
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
            if ($insert) {

                $last_insert_id = $wpdb->insert_id;
                foreach ($_SESSION['products'] as $row) {
                    $insert_detail = $wpdb->insert($table_order_detail, array(
                            "product_id" => $row['id'],
                            "order_id" => htmlspecialchars($last_insert_id),
                            "amount" => $row['qty'],
                            "price" => $row['price'],
                            "detail_total_price" => $row['qty'] * $row['price'],
                            "status" => 1,
                            "is_delete" => 0,
                            "team_id" => $row['id_team'],
                        )
                    );
                    if (!$insert_detail)
                    {
                        $_SESSION['loidathang'] =3;
                        wp_redirect(home_url('thanh-toan'));
                        exit;
                    }
                    }
                    $_SESSION['order_id']=$last_insert_id;
                    $_SESSION['dathangthangcong'] =1;
                    require ("PHPMailer/src/mail_dathang.php");
                    $noidung ="
                    <h4 style='color:#d53239'><b>Cảm ơn quý khách ".$_POST['order_name']." đã đặt hàng tại Rookie!</b></h4>
                    <p>Rookie rất vui thông báo đơn hàng #479916884 của quý khách đã được tiếp nhận và đang trong quá trình xử lý. Rookie sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</p>          
                    ";
                    $data_prepare11 = $wpdb->prepare("SELECT * FROM $table_team WHERE id = %d",$row['id_team']);
                    $data_team12 = $wpdb->get_row($data_prepare11);
                    if ($data_team12)
                    {
                        $owner_mail=$data_team12->email_truong_nhom;
                    }
                    else
                    {
                        $owner_mail='anhduy.bui1995@gmail.com';
                    }

                    sendmail($_POST['order_mail'],$owner_mail,$noidung);
                    unset($_SESSION['products']);
                    wp_redirect(home_url('dat-hang-thanh-cong'));
                    exit;
                }
            else
            {
                $_SESSION['loidathang'] =1;
                wp_redirect(home_url('thanh-toan'));
                exit;
            }
        }
        else
        {
            $_SESSION['loidathang'] =4;
            wp_redirect(home_url('thanh-toan'));
            exit;
        }
    }
}
?>