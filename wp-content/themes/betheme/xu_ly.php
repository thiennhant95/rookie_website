<?php
/**
 * Created by PhpStorm.
 * User: ABC
 * Date: 06/27/2018
 * Time: 3:29 PM
 */
function CovertVn($str)
{
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ặ|ẳ|ẵ|ắ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ặ|Ẳ|Ẵ|Ắ)/", 'a', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'e', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $str);
    $str = preg_replace("/(Đ)/", 'd', $str);
    $str = strtolower($str);
    $str = preg_replace("/( )/", '-', $str);
    return $str;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $table_team = $wpdb->prefix . "team";
        if ($_POST['ten_nhom'] == null || $_POST['password'] == null || $_POST['lead_username'] == null || $_POST['lead_school'] == null
            || $_POST['lead_phone'] == null || $_POST['lead_email'] == null || $_POST['lead_birthday'] == null ||
            $_POST['u1_username'] == null || $_POST['u1_school'] == null
            || $_POST['u1_phone'] == null || $_POST['u1_email'] == null || $_POST['u1_birthday'] == null ||
            $_POST['u2_username'] == null || $_POST['u2_school'] == null
            || $_POST['u2_phone'] == null || $_POST['u2_email'] == null || $_POST['u2_birthday'] == null)
        {
            $_SESSION['thongbaoloi'] ="1";
            $url = home_url('dang-ky-thanh-vien');
            wp_redirect($url);
            exit;
        }
        # khac null
        else {
            if ($_POST['lead_email']==$_POST['u1_email'] || $_POST['lead_email']==$_POST['u2_email']
                || $_POST['u1_email']==$_POST['u2_email'])
            {
                $_SESSION['thongbaoloi'] =5;
                $url = home_url('dang-ky-thanh-vien');
                wp_redirect($url);
                exit;
            }
            if ($_POST['lead_phone']==$_POST['u1_phone'] || $_POST['lead_phone']==$_POST['u2_phone']
                || $_POST['u1_phone']==$_POST['u2_phone'])
            {
                $_SESSION['thongbaoloi'] =6;
                $url = home_url('dang-ky-thanh-vien');
                wp_redirect($url);
                exit;
            }
            $replaced = preg_replace('/\s\s+/', ' ', $_POST['ten_nhom']);
            $data_prepare_name = $wpdb->prepare("SELECT * FROM $table_team WHERE ten_nhom = %s",$replaced);
            $data_team_name = $wpdb->get_row($data_prepare_name);
            if ($data_team_name)
            {
                $_SESSION['thongbaoloi'] =7;
                $url = home_url('dang-ky-thanh-vien');
                wp_redirect($url);
                exit;
            }

            $data_prepare = $wpdb->prepare("SELECT * FROM $table_team WHERE email_truong_nhom = %s",$_POST['lead_email']);
            $data_team = $wpdb->get_row($data_prepare);
            if ($data_team)
            {
                $_SESSION['thongbaoloi'] =2;
                $url = home_url('dang-ky-thanh-vien');
                wp_redirect($url);
                exit;
            }
            $data_prepare_u1 = $wpdb->prepare("SELECT * FROM $table_team WHERE email_member_1 = %s",$_POST['u1_email']);
            $data_team_u1 = $wpdb->get_row($data_prepare_u1);
            if ($data_team_u1)
            {
                $_SESSION['thongbaoloi'] =3;
                $url = home_url('dang-ky-thanh-vien');
                wp_redirect($url);
                exit;
            }

            $data_prepare_u2 = $wpdb->prepare("SELECT * FROM $table_team WHERE email_member_2 = %s",$_POST['u2_email']);
            $data_team_u2 = $wpdb->get_row($data_prepare_u2);
            if ($data_team_u2)
            {
                $_SESSION['thongbaoloi'] =4;
                $url = home_url('dang-ky-thanh-vien');
                wp_redirect($url);
                exit;
            }

            #slug
            $slug =CovertVn($_POST['ten_nhom']);
            $data_prepare1 = $wpdb->prepare("SELECT * FROM $table_team WHERE slug = %s",$slug);
            $data_team1 = $wpdb->get_row($data_prepare1);
            if ($data_team1)
            {
                $slug =CovertVn($_POST['ten_nhom'])."-1";
            }
            $url =home_url('xac-nhan-tai-khoan/?token='.generateRandomString(32));
            $insert = $wpdb->insert($table_team, array(
                    "ten_nhom" => htmlspecialchars($_POST['ten_nhom']),
                    "mat_khau_nhom" => htmlspecialchars(sha1($_POST['password'])),
                    "slug" => htmlspecialchars($slug),
                    "mo_ta" => '',
                    "slogan" => '',
                    "diem" => '',
                    "tinh_trang" => 1,
                    "logo" => '',
                    "background" => '',
                    "color" => '',
                    "san_pham_nhom" => '',
                    "ten_truong_nhom" => htmlspecialchars($_POST['lead_username']),
                    "truong_truong_nhom" => htmlspecialchars($_POST['lead_school']),
                    "sdt_truong_nhom" => htmlspecialchars($_POST['lead_phone']),
                    "email_truong_nhom" => htmlspecialchars($_POST['lead_email']),
                    "namsinh_truong_nhom" => $_POST['lead_birthday'],
                    "ten_member_1" => htmlspecialchars($_POST['u1_username']),
                    "namsinh_member_1" => $_POST['u1_birthday'],
                    "truong_member_1" => htmlspecialchars($_POST['u1_school']),
                    "email_member_1" => htmlspecialchars($_POST['u1_email']),
                    "sdt_member_1" => htmlspecialchars($_POST['u1_phone']),
                    "ten_member_2" => htmlspecialchars($_POST['u2_username']),
                    "namsinh_member_2" => $_POST['u2_birthday'],
                    "truong_member_2" => htmlspecialchars($_POST['u2_school']),
                    "email_member_2" => htmlspecialchars($_POST['u2_email']),
                    "sdt_member_2" => htmlspecialchars($_POST['u2_phone']),
                    "team_status"=>3,
                    "verify_email"=>$url,
                    "facebook_truong_nhom" =>htmlspecialchars($_POST['lead_facebook']),
                    "facebook_u1" =>htmlspecialchars($_POST['u1_facebook']),
                    "facebook_u2" =>htmlspecialchars($_POST['u2_facebook'])
                )
            );
            if ($insert) {
                require ("PHPMailer/src/mail_dangky.php");
                sendmail($_POST['lead_email'],$url);
                $_SESSION['xacnhan'] = 1;
                $url = home_url('dang-ky-thanh-vien');
                wp_redirect($url);
                exit;
            } else {
                $_SESSION['thongbaoloi'] ="1";
                $url = home_url('dang-ky-thanh-vien');
                wp_redirect($url);
                exit;
            }
        }
    }

    else
    {
        $_SESSION['thongbaoloi'] ="1";
        $url = home_url('dang-ky-thanh-vien');
        wp_redirect($url);
        exit;
    }
?>
