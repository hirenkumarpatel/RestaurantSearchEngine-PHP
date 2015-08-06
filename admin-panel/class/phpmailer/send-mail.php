<?php
//extension=php_openssl.dll enable this comment on line no : 1009
require_once('class.phpmailer.php');

$mail             = new PHPMailer(); // defaults to using php "mail()"

	
$mail->IsSMTP(); // telling the class to use SMTP
//$mail->Host       = "mail.yourdomain.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "projhgtech@gmhjhjhjhail.com";  // GMAIL username
$mail->Password   = "jhhjhgjhjhjh";            // GMAIL password

$mail->AddReplyTo("profgfgfghinfotech@gmail.com","Akash Infotech");

$mail->SetFrom('projfgffotech@gmail.com', 'Akash Infotech');

$mail->AddReplyTo("projgfgfgfgfotech@gmail.com","Akash Infotech");

$address = "akagfgfgfgfdshinfotech@gmail.com";
$mail->AddAddress($address, "Akasfgfdgtech");

$mail->Subject    = "hello this is test";
$body = "hello this is test";
$mail->MsgHTML($body);

if(!$mail->Send()) {
 // echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  //echo "Message sent!";
}

?>
