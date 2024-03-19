<?php
require "../modelo/conexion.php";
if (isset($_POST["reset_pass"])) {
    $email= $_GET["email"];
    if (isset($_POST["password"]) && isset($_POST["re-password"])) {
        $pass = $_POST["password"];
        $Vpass = $_POST["re-password"];

        if ($pass !== $Vpass) {
            echo "<div class='alert alert-danger' role='alert'>Las contraseñas no coinciden.</div>";
            exit;
        } else {
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
            $sql_update = "UPDATE tusuarios SET password = '$hashed_password' WHERE email = '$email'";

            if ($conexion->query($sql_update) === TRUE) {
                echo "<div class='alert alert-success' role='alert'>Contraseña actualizada exitosamente.</div>";
                echo "<script>";
                echo "setTimeout(function() { window.location.href = 'login.php'; }, 5000);";
                echo "</script>";
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