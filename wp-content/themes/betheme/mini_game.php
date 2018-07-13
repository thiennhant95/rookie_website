<?php
$table_team = $wpdb->prefix . "team";
$insert = $wpdb->update($table_team, array(
    'diem'=>$_POST['diem'],
),array('id'=>$_POST['team_id'])
);
if ($insert)
{
    echo json_encode(['status'=>1]);
    exit();
}
else{
    echo json_encode(['status'=>0]);
    exit();
}
?>