<?php

namespace General;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email
{
    public $destino;
    public $subject;
    public $mensaje;

    public function __construct($initial = [])
    {
        $this->destino = $initial["id"] ?? "";
        $this->subject = $initial["subject"] ?? "";
        $this->mensaje = $initial["mensaje"] ?? "";
    }

    public function enviarEmail()
    {
        if($this->destino == "" || $this->mensaje == "" || $this->subject == "") return; 
        try {
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'f691e2219032ae';
            $mail->Password = '48b0b402d4e318';

            //Recipients
            $mail->setFrom('amaro7jj@gmail.com');
            $mail->addAddress($this->destino , 'anonimos');

            //Content
            $mail->isHTML(true);    
            $mail->CharSet = "UTF-8";                              //Set email format to HTML
            $mail->Subject = $this->subject;
            $mail->Body    = $this->mensaje;

            $mail->send();
        } catch (Exception $e) {
            MostrarInfo("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
