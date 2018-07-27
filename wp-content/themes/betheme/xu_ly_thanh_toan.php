<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $table_team = $wpdb->prefix . "team";
    $table_order = $wpdb->prefix . "order";
    $table_order_detail = $wpdb->prefix . "order_detail";
    if ($_POST['order_name']==null || $_POST['order_phone']==null || $_POST['order_name']==null || $_POST['order_mail']==null ||
    $_POST['order_address']==null|| $_POST['order_city']==null || $_POST['order_district']==null || $_POST['order_district_id'] == null || $_POST['sum_weight'] == null || $_POST['sum_ship'] == null)
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
            $wpdb->query('START TRANSACTION');
            foreach ($_SESSION['team_list'] as $row_list)
            {
                foreach ($_SESSION['price_list'] as $key_price =>$row_price) {
                    if ($key_price == $row_list) {
                        $insert = $wpdb->insert($table_order, array(
                                "order_name" => htmlspecialchars($_POST['order_name']),
                                "order_phone" => htmlspecialchars(($_POST['order_phone'])),
                                "order_email" => htmlspecialchars($_POST['order_mail']),
                                "order_address" => htmlspecialchars($_POST['order_address']),
                                "order_city" => htmlspecialchars($_POST['order_city']),
                                "order_district" => htmlspecialchars($_POST['order_district']),
//                                "order_ward" => htmlspecialchars($_POST['order_ward']),
                                "order_content" => htmlspecialchars($_POST['order_content']),
                                "total_no_ship" => htmlspecialchars($row_price),
                                "total_price"=>htmlspecialchars($row_price + $_POST['sum_ship']),
                                "order_status" => 0,
                                "order_date" => date('Y-m-d H:i:s'),
                                "is_delete" => 0,
                                'team_id' => $row_list,
                                'ship_fee' => htmlspecialchars($_POST['sum_ship'])
                            )
                        );
                        if ($insert) {

                            $last_insert_id = $wpdb->insert_id;
                            foreach ($_SESSION['products'] as $row) {
                                if ($row_list == $row['id_team']):
                                    $insert_detail = $wpdb->insert($table_order_detail, array(
                                            "product_id" => $row['id'],
                                            "order_id" => htmlspecialchars($last_insert_id),
                                            "amount" => $row['qty'],
                                            "price" => $row['price'],
                                            "detail_total_price" => $row['qty'] * $row['price'],
                                            "status" => 1,
                                            "is_delete" => 0,
                                            "team_id" => $row_list,
                                        )
                                    );
                                endif;
                                if (!$insert_detail) {
                                    $_SESSION['loidathang'] = 3;
                                    wp_redirect(home_url('thanh-toan'));
                                    exit;
                                }
                            }
                        } else {
                            $_SESSION['loidathang'] = 1;
                            wp_redirect(home_url('thanh-toan'));
                            exit;
                        }
                    }
                }
            }
            $wpdb->query('COMMIT');
            $_SESSION['dathangthangcong'] =1;
            require ("PHPMailer/src/mail_dathang.php");
            $noidung ="
                    <h4 style='color:#d53239'><b>Cảm ơn quý khách ".$_POST['order_name']." đã đặt hàng tại Rookie!</b></h4>
                    <p>Rookie rất vui thông báo đơn hàng của quý khách đã được tiếp nhận và đang trong quá trình xử lý. Rookie sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</p>          
                    ";
            $owner_noidung = "
                    <h4 style='color:#d53239'><b>Bạn có đơn đặt hàng mới từ ".$_POST['order_name']."</b></h4>
                    <p>Bạn vui lòng kiểm tra và xác nhận giao hàng. Cám ơn!.</p>          
                    ";
            $owner_noidung1 = "
                    <h4 style='color:#d53239'><b>Đã có đơn hàng mới từ website Rookie!</b></h4>
                    <p>Cám ơn!.</p>          
                    ";

            $query_team = "SELECT * FROM $table_team ORDER BY id DESC";
            $data_team = $wpdb->get_results($query_team);
            foreach ($_SESSION['team_list'] as $row_send)
            {
                foreach ($data_team as $row_team)
                {
                    if ($row_team->id==$row_send)
                    {
                        sendmail1($row_team->email_truong_nhom,$owner_noidung);
                    }
                }
                if ($row_send==0)
                {
                    sendmail1("thiennhant95@yahoo.com",$owner_noidung);
                    break;
                }
            }
            sendmail2("thiennhant95@yahoo.com",$owner_noidung1);

            sendmail($_POST['order_mail'],$noidung);
            unset($_SESSION['products']);
            unset($_SESSION['team_list']);
            wp_redirect(home_url('dat-hang-thanh-cong'));
            exit;
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