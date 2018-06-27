<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $table_team = $wpdb->prefix."team";
    $data_prepare = $wpdb->prepare("SELECT * FROM $table_team WHERE email_truong_nhom = %s AND mat_khau_nhom=%s",$_POST['email'],sha1($_POST['password']));
    $data_team = $wpdb->get_row($data_prepare);
    if ($data_team)
    {
        $_SESSION['login'] =1;
        $_SESSION['branch_id']= $data_team->id;
        $url = home_url('dang-ky-thanh-vien');
        wp_redirect($url);
        exit;
    }
    else
    {
        $_SESSION['login'] ='thatbai';
        $url = home_url('dang-nhap');
        wp_redirect($url);
        exit;
    }
}
?>