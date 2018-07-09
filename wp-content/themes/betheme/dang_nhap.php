<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $table_team = $wpdb->prefix."team";
    $data_prepare = $wpdb->prepare("SELECT * FROM $table_team WHERE email_truong_nhom = %s AND mat_khau_nhom=%s",$_POST['email'],sha1($_POST['password']));
    $data_team = $wpdb->get_row($data_prepare);
    if ($data_team && $data_team->team_status==1)
    {
        $_SESSION['login'] =1;
        $_SESSION['branch_id']= $data_team->id;
        $_SESSION['branch_slug'] = $data_team->slug;
        $url = home_url('manage-group')."/".$data_team->slug;
        wp_redirect($url);
        exit();
    }
    if ($data_team && $data_team->team_status==0 || $data_team->team_status==3)
    {
        $_SESSION['login'] ='thatbai_1';
        $url = home_url('dang-nhap');
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