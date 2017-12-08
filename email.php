<?php

//echo $my_path;
$my_name = "Backup System";
$my_mail = "backup@nucleuspos.com";
$my_replyto = "contact@neutrix.systems";
$my_subject = "Nucleus POS System Full DB Backup Until " . date('m/d/Y');
$file_to_attach = "http://www.nucleuspos.com/nucleusv3/db/backup/" . $fileName;
$my_message = "Hallo Sir,<br>Your Nucleus POS Backup Syetem,  Has been taken Backup - date : " . date('m/d/Y') . " and time : " . date('H:i:s') . "<br>Please Download using this link.<a href='" . $file_to_attach . "'>Download Backup</a><br><br><b>Thank You.</b>";

require 'phpmail/class.phpmailer.php';
$mail = new PHPMailer;
$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->CharSet = "iso-8859-1";
$mail->Host = 'mail.xzsadsadsa.com';                      // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'sdddsfdsf@ddd.com';                    // SMTP username
$mail->Password = 'sdfdsfdsfdsfd';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to
$mail->From = 'backup@nucleuspos.com';
$mail->FromName = 'NucleusPOS';
$mail->addAddress('justindabish@gmail.com');     // Add a recipient
$mail->addReplyTo('fahad@nucleuspos.com');
$mail->addBCC('f.bhuyian@gmail.com');
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $my_subject;
$mail->Body = $my_message;
$mail->AltBody = 'POS Database Backup ' . date('Y-m-d');
//$mail->AddAttachment($file_to_attach, $fileName);
if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
    