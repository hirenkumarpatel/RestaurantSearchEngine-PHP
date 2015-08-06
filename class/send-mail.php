<?php
require_once('class.phpmailer.php');

function sendMail($user,$from,$password,$to,$subject,$msg) {
  
  $mail = new PHPMailer(); // defaults to using php "mail()"
  $mail->IsSMTP(); // telling the class to use SMTP
//$mail->Host       = "mail.yourdomain.com"; // SMTP server
  $mail->SMTPDebug = 2;                     // enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
  $mail->SMTPAuth = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
  $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port = 465;                   // set the SMTP port for the GMAIL server
  $mail->Username = $from;  // GMAIL username
  $mail->Password = $password;            // GMAIL password

  $mail->SetFrom($from, $user);
  

  $address = "{$to}";

  $mail->AddAddress($address, $user);

  $mail->Subject = "$subject";
  $body = "$msg";
  $mail->MsgHTML($body);

  if (!$mail->Send()) {
    //header("location:restaurant-display.php?qry=fail");
    echo "Mailer Error: " . $mail->ErrorInfo;
  } else {

  }
}
?>
