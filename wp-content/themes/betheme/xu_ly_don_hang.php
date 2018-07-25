<?php
global $wpdb;
if (isset($_POST['order_id']) && isset($_POST['type']) && $_POST['type']==0)
{
    $table_order = $wpdb->prefix . "order";
    $insert = $wpdb->update($table_order, array(
        'order_status'=>3,
    ),array('id'=>$_POST['order_id']));
    $table_order_detail = $wpdb->prefix . "order_detail";
    $data_detail = "SELECT * FROM $table_order_detail";
    $list_detail = $wpdb->get_results($data_detail);
    foreach ($list_detail as $row)
    {
        if ($row->order_id==$_POST['order_id'])
        {
            $update = $wpdb->update($table_order_detail, array(
                'status'=>3,
            ),array('order_id'=>$_POST['order_id']));
        }
    }
    echo json_encode(array('status'=>1,'class'=>'btn-danger'));
    die();
}
?>