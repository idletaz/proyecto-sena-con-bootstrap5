<?php
session_start(); 

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['pass'];
    

    // Realizar la consulta para obtener el usuario con el email proporcionado
    $stmt = $conexion->prepare("SELECT id, email, password FROM tusuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1) {
        // Usuario encontrado, verificar contraseña
        $usuario = $result->fetch_assoc();
        if(password_verify($password, $usuario['password'])) {
            // Contraseña válida, iniciar sesión
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['email'] = $usuario['email'];
            //$_SESSION['nombre'] = $usuario['nombre'];
            // Redirigir a la página de inicio o a donde desees
            header('Location:../vistas/home.php');
            exit();
        } else {
            // Contraseña incorrecta
            echo '<div class="alert alert-danger" role="alert">Contraseña incorrecta</div>';
        }
    } else {
        // Usuario no encontrado
        echo '<div class="alert alert-danger" role="alert">El email proporcionado no está registrado</div>';
    }
}
?>
