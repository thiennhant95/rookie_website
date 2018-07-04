<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $table_team = $wpdb->prefix . "products";
    #slug
    $slug =CovertVn($_POST['product_name']);
    $data_prepare1 = $wpdb->prepare("SELECT * FROM $table_team WHERE product_slug = %s",$slug);
    $data_team1 = $wpdb->get_row($data_prepare1);

    $data_prepare = $wpdb->prepare("SELECT * FROM $table_team WHERE id = %d", $_GET['id']);
    $data_team = $wpdb->get_row($data_prepare);

    if ($data_team1)
    {
        if ($data_team->product_slug==CovertVn($_POST['product_name']))
        $slug =CovertVn($_POST['product_name'])."-1";
    }
    $insert = $wpdb->update($table_team, array(
            'product_name'=>$_POST['product_name'],
            'product_slug'=>$slug,
            'product_description'=>$_POST['content'],
            'expired_date'=>$_POST['expired_date'],
            'manufactore_date'=>$_POST['manufactore_date'],
            'warehouse_amount'=>$_POST['warehouse_amount'],
            'product_price'=>$_POST['product_price'],
            'is_delete'=>0,
            'status'=>$_POST['status_product'],
            'category_product_id'=>$_POST['category_product_id']
        ),array('id'=>$_GET['id'])
    );
    if($insert){
        $_SESSION['themsp'] =1;
        wp_redirect('../wp-admin/admin.php?page=product_view');
        exit;
    }
    else
    {
        $_SESSION['themsp'] =0;
        wp_redirect('../wp-admin/admin.php?page=product_view');
        exit;
    }
}

function CovertVn($str)
{
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|� �|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|� �|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|� �|Ặ|Ẳ|Ẵ)/", 'a', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'e', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|� �|Ợ|Ở|Ỡ)/", 'o', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $str);
    $str = preg_replace("/(Đ)/", 'd', $str);
    $str = strtolower($str);
    $str = preg_replace("/( )/", '-', $str);
    return $str;
}
?>