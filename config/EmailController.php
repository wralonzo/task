<?php
// Incluir los archivos de PHPMailer manualmente
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';
require '../vendor/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailController
{
    public function enviarCorreo($destinatario, $asunto, $cuerpoHTML, $cuerpoTextoPlano)
    {
        $mail = new PHPMailer(true);
        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'invoicerenergy@gmail.com'; // Usuario SMTP
            $mail->Password = 'egba adpy aysl bakg'; // Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configuración del correo
            $mail->setFrom('invoicerenergy@gmail.com', 'Sistema de investigacion');
            $mail->addAddress($destinatario); // Añadir destinatario dinámico

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body = $cuerpoHTML; // Contenido en HTML
            $mail->AltBody = $cuerpoTextoPlano; // Contenido en texto plano

            // Enviar el correo
            $mail->send();
        } catch (Exception $e) {
        }
    }
}
