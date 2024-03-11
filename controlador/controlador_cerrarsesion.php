<?php

session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Si se desea destruir la cookie, es necesario borrarla manualmente
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión
session_destroy();


header("location:../vistas/login.php");
exit;
?>
