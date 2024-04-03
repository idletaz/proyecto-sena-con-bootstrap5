<?php
require "../modelo/conexion.php";

if (isset($_POST["guardar-nueva-contra"])) {
    if (isset($_POST["password"]) && isset($_POST["password-repeat"])) {
        $pass = $_POST["password"];
        $Vpass = $_POST["password-repeat"];
        $email = $_POST['email'];

        if ($pass !== $Vpass) {
            echo "<div class='alert alert-danger' role='alert'>Las contraseñas no coinciden.</div>";
            exit;
        } else {
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
            $sql_update = "UPDATE tusuarios SET password = '$hashed_password' WHERE email = '$email'";

            if ($conexion->query($sql_update) === TRUE) {
                echo "<div class='alert alert-success' role='alert'>Contraseña actualizada exitosamente.</div>";
                
            } else {
                echo "<div class='alert alert-danger' role='alert'>Error al actualizar la contraseña: " . $conexion->error . "</div>";
            }
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>No se proporcionaron todas las contraseñas necesarias.</div>";
    }

    $conexion->close();

}



?>