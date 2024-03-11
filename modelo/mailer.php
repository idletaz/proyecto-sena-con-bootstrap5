<?php
// funciones.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function enviarCorreoRegistroExitoso($email,$password,$nombre) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp-mail.outlook.com';  // Cambiar por la dirección del servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'TiendaInside@hotmail.com'; // Cambiar por tu nombre de usuario SMTP
        $mail->Password = 'insidest@re'; // Cambiar por tu contraseña SMTP
        $mail->SMTPSecure = 'STARTTLS'; // O 'ssl' si es necesario
        $mail->Port = 587; // Puerto SMTP - 587 para TLS/STARTTLS, 465 para SSL

        // Configuración del correo electrónico
        $mail->setFrom('TiendaInside@hotmail.com', 'Inside Store');
        $mail->addAddress($email); // Utiliza el correo electrónico del usuario registrado
        $mail->Subject = 'Registro exitoso INSIDE|Store';


        $body = '<p>¡Hola ' . $nombre . ', gracias por registrarte! Tu registro ha sido exitoso.</p>';
        $body .= '<br>';
        $body .= '<h4>Bienvenid@</h4><br>';
        $body .= '<strong>Tus detalles de inicio de sesión:</strong>';
        $body .= '<ul>';
        $body .= '<li>Nombre: ' . $nombre . '</li>';
        $body .= '<li>Correo electrónico: ' . $email . '</li>';
        $body .= '<li>Contraseña: ' . $password . '</li>';
        $body .= '</ul>';

        $mail->isHTML(true);
        $mail->Body = $body;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>