<?php

namespace Src\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email
{
    public static function send($to, $subject, $body): bool
    {
        $mail = new PHPMailer(true);

        try {
          
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'lojamagicatecnologia@gmail.com';
            $mail->Password = 'zdku dlhh dddx xbel'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('lojamagicatecnologia@gmail.com', 'Loja Mágica');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            return true;
        } catch (Exception $e) { 
            error_log('Erro ao enviar email: ' . $mail->ErrorInfo);
            return false;
        }
    }
}
