<?php
$dt = new DateTime();
$dt->setTimeZone(new DateTimeZone('Asia/Ho_Chi_Minh'));

$time_fomat = $dt->format('Y-m-d\TH:i:s+07:00');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    global $wpdb;
    if (isset($_POST['order_id']) && isset($_POST['type']) && $_POST['type']==0){
        $order_id_post = $_POST['order_id'];
        $table_order = $wpdb->prefix . "order";
        $data_prepare_name = $wpdb->prepare("SELECT * FROM $table_order WHERE id = %d",$_POST['order_id']);
        $data_order = $wpdb->get_row($data_prepare_name);

        $table_order_detail = $wpdb->prefix . "order_detail";
        $query_order_detail = "SELECT * FROM $table_order_detail WHERE order_id=$order_id_post";
        $data_order_detail = $wpdb->get_results($query_order_detail);

        $table_token ="token_api";
        $query_token = "SELECT * FROM $table_token";
        $token = ($wpdb->get_results($query_token))[0]->token;
        $data_token =$wpdb->get_results($query_token);
        $shipment_id ="VNVNCC".$data_token[0]->last_shipment_id;

        $update_last_shipment_id = $wpdb->update($table_token, array(
            'last_shipment_id'=>($data_token[0]->last_shipment_id)+1,
        ),array('id'=>$data_token[0]->id)
        );

        $update_order_code= $wpdb->update($table_order, array(
            'order_code'=>$shipment_id,
        ),array('id'=>$order_id_post)
        );
        $totalweight= $_POST['totalweight'];

        if ($data_order){
            $order = <<<HTTP_BODY
           {  
   "manifestRequest":{  
      "hdr":{  
         "messageType":"SHIPMENT",
         "messageDateTime":"$time_fomat",
         "accessToken":"$token",
         "messageVersion":"1.4",
         "messageLanguage":"vi_VN"
      },
      "bd":{  
         "pickupAccountId":"5000000002",
         "soldToAccountId":"5000000002",
         "pickupDateTime":"$time_fomat",
         "handoverMethod":2,
         "shipperAddress":{  
            "companyName":"VinaCacao Company",
            "name":"Vinacacao",
            "address1":" 6 Thăng Long, Phường 4",
            "address2":null,
            "address3":null,
            "city":"Quận Tân Bình",
            "state":"Hồ Chí Minh",
            "district":null,
            "country":"VN",
            "postCode":null,
            "phone":"0839103425",
            "email":"cskh@vinacacao.com.vn"
         },
         "shipmentItems":[  
            {  
               "consigneeAddress":{  
                  "name":"$data_order->order_name",
                  "address1":"$data_order->order_address",
                  "address2":"$data_order->order_content",
                  "address3":null,
                  "district":"$data_order->order_district",
                  "state":"$data_order->order_city",
                  "country":"VN",
                  "postCode":null,
                  "phone":"$data_order->order_phone",
                  "email":"$data_order->order_email"
               },
               "shipmentID":"$shipment_id",
               "returnMode":"01",
               "returnProductCode":null,
               "packageDesc":"Candy",
               "totalWeight":$totalweight,
               "totalWeightUOM":"g",
               "incoterm":null,
               "codValue":$data_order->total_no_ship,
               "insuranceValue":null,
               "freightCharge":null,
               "totalValue":null,
               "currency":"VND",
               "remarks":null,
               "valueAddedServices":{  
                  "valueAddedService":[  
                     {  
                        "vasCode":"OBOX"
                     }
                  ]
               },
               "isMult":"False",
               "deliveryOption":"c",
               "productCode":"PDO"
            }
         ]
      }
   }
}
HTTP_BODY;
//            print_r($order);
//            die();
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox.dhlecommerce.asia/rest/v3/Shipment",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $order,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

             $response_data =json_decode($response,true);
//         $response= json_decode('{
//  "manifestResponse" : {
//    "hdr" : {
//      "messageType" : "SHIPMENT",
//      "messageDateTime" : "2018-07-19T14:58:03+08:00",
//      "messageVersion" : "1.0",
//      "messageLanguage" : "vi_VN"
//    },
//    "bd" : {
//      "shipmentItems" : [ {
//        "shipmentID" : "VNVNCC1000023",
//        "deliveryConfirmationNo" : "5118075148332798",
//        "responseStatus" : {
//          "code" : "200",
//          "message" : "THÀNH CÔNG",
//          "messageDetails" : [ {
//            "messageDetail" : "Lô hàng được xử lý thành công; Tùy chọn bàn giao được cập nhật cho Drop-Off, nếu Pick-Up được yêu cầu vui lòng liên hệ với DHL eCommerce; Những đơn hàng giao không thành công sẽ được hoàn về địa chỉ đã được đăng ký theo tài khoản lấy hàng - vui lòng liên hệ tới DHL eCommerce nếu bạn cần sự trợ giúp; Dịch vụ vận chuyển cho Hàng hoàn trả đã được cập nhật sang PDO"
//          } ]
//        }
//      } ],
//      "responseStatus" : {
//        "code" : "200",
//        "message" : "THÀNH CÔNG",
//        "messageDetails" : [ {
//          "messageDetail" : "Tất cả các lô hàng đã được xử lý thành công"
//        } ]
//      }
//    }
//  }
//}',true);
         if ($response_data['manifestResponse']['bd']['responseStatus']['code']==200)
         {
             $update_status_order = $wpdb->update($table_order, array(
                 'order_status'=>0.1,
             ),array('id'=>$_POST['order_id'])
             );
             if ($update_status_order){
                 foreach ($data_order_detail as $row_detail)
                 {
                     $update_status_order_detail = $wpdb->update($table_order_detail, array(
                         'status'=>0.1,
                     ),array('order_id'=>$_POST['order_id'])
                     );
                 }
                 require ("PHPMailer/src/mail_api_donhang.php");
                 send_mail_donhang_api($data_order->order_email,$shipment_id);
                 echo json_encode(['status'=>1]);
                 die();
             }
         }
        }
        else{
            echo json_encode(['status'=>0]);
            die();
        }
    }
}
?>