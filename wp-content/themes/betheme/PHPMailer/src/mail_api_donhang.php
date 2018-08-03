<?php
header("Content-type: text/html; charset=UTF-8");
require("PHPMailer.php");
require("SMTP.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function send_mail_donhang_api($mail_to,$content)
{
    $mail = new PHPMailer();
    $mail->IsSMTP(); // enable SMTP

//    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
//$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->SMTPSecure = 'tls';
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Host = "smtp.gmail.com";
    $mail->CharSet = 'UTF-8';
    $mail->Port = 587;   // or 587
    $mail->IsHTML(true);
    $mail->Username = "rookiemarketing2018@gmail.com";
    $mail->Password = "rookie2018";
    $mail->SetFrom("rookiemarketing2018@gmail.com",'Rookie Marketing 2018');
    $mail->Subject = "Xác nhận giao hàng";
    $mail->Body = "Đơn hàng của đã chuẩn bị thành công và đang được giao. Mã đơn hàng của bạn là: $content. Bạn có thể theo dõi đơn hàng tại <a href='https://ecommerceportal.dhl.com/track/' target='_blank'>https://ecommerceportal.dhl.com/track/ </a>
<br>
<br/>
<b>Rookie Marketing 2018</b><br/>
<b>028 2218 9739 </b>
";
    $mail->AddAddress($mail_to);
    $mail->AddCC('rookiemarketing2018@gmail.com');

    if(!$mail->Send()) {
        return false;
//        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        return true;
//        echo "Message has been sent";
    }
}
?>