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
        $mail->CharSet="UTF-8";
        $mail->isHTML(true);
        $mail->Body = $body;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}


function contactoexitoso($nombre,$email,$asunto,$mensaje){
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp-mail.outlook.com';  // Cambiar por la dirección del servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'TiendaInside@hotmail.com'; // Cambiar por tu nombre de usuario SMTP
        $mail->Password = 'insidest@re'; // Cambiar por tu contraseña SMTP
        $mail->SMTPSecure = 'STARTTLS'; // O 'ssl' si es necesario
        $mail->Port = 587;

        // Configuración del remitente y destinatario
        $mail->setFrom($email, $nombre);
        $mail->addAddress('TiendaInside@hotmail.com', 'Inside Store');

        $mail->CharSet="UTF-8";
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body    = "<p>Nombre: $nombre</p><p>Email: $email</p><p>Mensaje: $mensaje</p>";

      
        $mail->send();

    } catch (Exception $e) {
        // Manejo de errores
        echo 'Error al enviar el mensaje: ', $mail->ErrorInfo;
    }

}
function reset_pass($email, $token) {
    // Configurar instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp-mail.outlook.com';  // Cambiar por la dirección del servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'TiendaInside@hotmail.com'; // Cambiar por tu nombre de usuario SMTP
        $mail->Password = 'insidest@re'; // Cambiar por tu contraseña SMTP
        $mail->SMTPSecure = 'STARTTLS'; // O 'ssl' si es necesario
        $mail->Port = 587;

        // Configuración del remitente y destinatario
        $mail->setFrom('TiendaInside@hotmail.com', 'Inside Store');
        $mail->addAddress($email);

        // Contenido del correo electrónico
        $mail->isHTML(true);
        $mail->Subject = 'Resetear Contraseña';
        $mail->Body .= "<p>Para restablecer tu contraseña, haz clic en el siguiente enlace:</p>";
        $mail->Body .= "<p><a href='http://localhost/Proyecto-Sena-Con-Bootstrap5/vistas/recuperar_contraseña.php?token=$token&email=$email'>Restablecer contraseña</a></p>";

        

        $mail->CharSet="UTF-8";
        // Enviar el correo electrónico
        $mail->send();
        echo "<div class='alert alert-success' role='alert'>";
        echo "<strong>¡Éxito!</strong> Se ha enviado un correo electrónico con instrucciones para restablecer tu contraseña.";
        echo "</div>";
        echo "<script>";
        echo "setTimeout(function() { window.location.href = 'login.php'; }, 5000);";
        echo "</script>";

    } catch (Exception $e) {
        echo "Error al enviar el correo electrónico: {$mail->ErrorInfo}";
    }
}
?>