<?php
require_once "Mail.php";

$from = "Sandra Sender <inc@musinetwork.com>";
$to = "Mr Dionisio <hibam_iru@hotmail.com>";
$subject = "Hi!";
$body = "Hi,\n\nHow are you?";

$host = "ssl://email-smtp.us-east-1.amazonaws.com";
$port = "465";
$username = "AKIAIXA2XV6TZOOCK5KQ";
$password = "Amhgery5dXtVT2T1j+DrcewX8MUiWOkIWme8Mchskv5N";

$headers = array ('From' => $from,
'To' => $to,
'Subject' => $subject);
$smtp = Mail::factory('smtp',
array ('host' => $host,
 'port' => $port,
 'auth' => true,
 'username' => $username,
 'password' => $password));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
echo("<p>" . $mail->getMessage() . "</p>");
} else {
echo("<p>Message successfully sent!</p>");
}
?>