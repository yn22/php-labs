<?php
define('MAILGUN_URL', getenv('MAILGUN_URL'));
define('MAILGUN_API_KEY', getenv('MAILGUN_API_KEY'));
define('MAILGUN_DOMAIN', getenv('MAILGUN_DOMAIN'));

$sender_name = $_POST['sender_name'];
$sender_email = $_POST['sender_email'];
$message = $_POST['message'];

echo $text;

$array_data = [
    'from' => 'Mailgun <mailgun@' . MAILGUN_DOMAIN . '>',
    'to' => $sender_email,
    'subject' => 'A message from ' . $sender_name,
    'text' => $message,
    'o:tracking' => 'yes',
    'o:tracking-clicks' => 'yes',
    'o:tracking-opens' => 'yes'
    //'o:tag'=>$tag,
    // 'h:Reply-To' => 'YOUR@EMAIL.COM'
];

$session = curl_init(MAILGUN_URL);
curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($session, CURLOPT_USERPWD, 'api:' . MAILGUN_API_KEY);
curl_setopt($session, CURLOPT_POST, true);
curl_setopt($session, CURLOPT_POSTFIELDS, $array_data);
curl_setopt($session, CURLOPT_HEADER, false);
curl_setopt($session, CURLOPT_ENCODING, 'UTF-8');
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($session);
curl_close($session);
