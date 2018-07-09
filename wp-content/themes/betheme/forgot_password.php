<?php
if (isset($_POST['email']))
{
    $table_team = $wpdb->prefix."team";
    $data_prepare = $wpdb->prepare("SELECT * FROM $table_team WHERE email_truong_nhom = %s ",$_POST['email']);
    if ($data_prepare)
    {
        $new_password =generateRandomString(6);
        $update = $wpdb->update($table_team, array(
            'mat_khau_nhom'=>sha1($new_password),
        ),array('email_truong_nhom'=>$_POST['email'])
        );
        if ($update)
        {
            require ("PHPMailer/src/mail_forgot.php");
            sendmail($_POST['email'],$new_password);
            echo json_encode(array('status'=>1));
            die();
        }
        else
        {
            echo json_encode(array('status'=>0));
            die();
        }
    }
    else
    {
        echo json_encode(array('status'=>0));
        die();
    }


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
?>