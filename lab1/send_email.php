<?php
define('MAILGUN_URL', 'https://app.mailgun.com/app/sending/domains/sandboxa55e27481a864759aad1db43ea0d99ee.mailgun.org');
define('MAILGUN_KEY', 'ddf6643d1174d7d47b310e18f36aaffd-680bcd74-a525d2c1');

$sender_name = $_POST['sender_name'];
$sender_email = $_POST['sender_email'];
$message = $_POST['message'];

$text = "Sender name: $sender_name
Sender email: $sender_email
Message: $message";

echo $text;

$array_data = [
    'from' => 'Mailgun <mailgun@sandboxa55e27481a864759aad1db43ea0d99ee>',
    'to' => 'yaroslav.naz14@gmail.com',
    'subject' => 'SUBJECT',
    'text' => $text,
    'o:tracking' => 'yes',
    'o:tracking-clicks' => 'yes',
    'o:tracking-opens' => 'yes'
    //'o:tag'=>$tag,
    // 'h:Reply-To' => 'YOUR@EMAIL.COM'
];

$session = curl_init('https://api.mailgun.net/v3/sandboxa55e27481a864759aad1db43ea0d99ee.mailgun.org/messages');
curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($session, CURLOPT_USERPWD, 'api:ddf6643d1174d7d47b310e18f36aaffd-680bcd74-a525d2c1');
curl_setopt($session, CURLOPT_POST, true);
curl_setopt($session, CURLOPT_POSTFIELDS, $array_data);
curl_setopt($session, CURLOPT_HEADER, false);
curl_setopt($session, CURLOPT_ENCODING, 'UTF-8');
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($session);
curl_close($session);
