<?php

require "../modelo/mailer.php";
// Verificar si se ha enviado el formulario de reseteo de contraseña
if (isset($_POST["reset"])) {
    require "../modelo/conexion.php";
    // Obtener los datos del formulario
    $email = $_POST['email'];


    // Verificar si el usuario existe en la base de datos
    $sql = "SELECT * FROM tusuarios WHERE email = '$email'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        // Generar y guardar token único en la base de datos
        $token = bin2hex(random_bytes(32)); // Genera un token aleatorio de 64 caracteres hexadecimales
        $sql_update = "UPDATE tusuarios SET reset_token = '$token' WHERE email = '$email'";
        $conexion->query($sql_update);
        if ($conexion->query($sql_update) === TRUE) {
            // Llamar a la función para enviar el correo electrónico
            reset_pass($email, $token);
        } else {
            echo "Error al actualizar la base de datos: " . $conexion->error;
        }
        



    
}else {
    echo "El usuario no existe o el correo electrónico no coincide.";
}?>
<script>history.replaceState(null,null,location.pathname)</script>
<?php
$conexion->close();
}
?>
