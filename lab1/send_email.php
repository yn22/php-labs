<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../vendor/autoload.php";

define('EMAIL', getenv('EMAIL'));
define('EMAIL_PASSWORD', getenv('EMAIL_PASSWORD'));

$sender_name = $_POST['sender_name'];
$sender_email = $_POST['sender_email'];
$message = $_POST['message'];

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->SMTPDebug  = 1;
$mail->SMTPAuth   = true;
$mail->SMTPSecure = "tls";
$mail->Port       = 465;
$mail->Host       = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Username   = EMAIL;
$mail->Password   = EMAIL_PASSWORD;

$mail->IsHTML(true);
$mail->AddAddress($sender_email, $sender_name);
$mail->SetFrom("yaroslav.nazarenko.phplabs@gmail.com", "Yaroslav");
// $mail->AddReplyTo("yaroslav.nazarenko.phplabs@gmail.com", "Yaroslav");
$mail->Subject = "A message from " . $sender_name;
$content = $message;

$mail->MsgHTML($content);
if (!$mail->Send()) {
    echo "Error while sending Email.";
    http_response_code(500);
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    http_response_code(200);
    echo "Email sent successfully";
}
