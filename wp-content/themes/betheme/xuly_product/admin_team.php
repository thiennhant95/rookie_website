<?php
if (isset($_GET['lock-team'])==1)
{
    $table_team = $wpdb->prefix . "team";

    $data_prepare = $wpdb->prepare("SELECT * FROM $table_team WHERE id = %d", $_GET['id']);
    $data_team = $wpdb->get_row($data_prepare);

    if ($data_team->team_status == 0) {
        $data_user = array(
            'team_status' =>'1'
        );
        $update = $wpdb->update($table_team, $data_user,
            array('id'=>$_GET['id']));

        $data['list_user'] ['status']= 'Khóa';
        echo json_encode($data['list_user']);
    }
    else if($data_team->team_status == 1)
    {
        $data_user = array(
            'team_status' => '0'
        );
        $update = $wpdb->update($table_team, $data_user,
            array('id'=>$_GET['id']));
        $data['list_user'] ['status']= 'Mở Khóa';
        echo json_encode($data['list_user']);
    }
}