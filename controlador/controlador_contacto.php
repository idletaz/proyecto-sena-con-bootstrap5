<?php
require "../modelo/mailer.php";
if (isset($_POST['contacto'])) {
    // Sanitizar los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $asunto = htmlspecialchars($_POST['asunto']);
    $mensaje = htmlspecialchars($_POST['mensaje']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="alert alert-danger" role="alert"> Porfavor Proporcionar un Email valido. </div>';
        exit;
    }else{
        echo'<div class="alert alert-success" role="alert"> Se ha enviado el asunto correctamente! </div>';
        contactoexitoso($nombre,$email,$asunto,$mensaje);
    }?>
    
    <script>history.replaceState(null,null,location.pathname)</script>
    
    <?php
       
    
}
?>
