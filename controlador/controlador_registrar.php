<?php
  require "../modelo/mailer.php";
if(isset($_POST['registrar'])){
  
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['confirm_pass'];
    $telefono = $_POST['telefono'];
    $ciudad = $_POST['ciudad'];
    $genero = $_POST['genero'];
    $barrio = $_POST['barrio'];
    $direccion = $_POST['direccion'];
    $id_rol=1;
    $Fecha=date('Y-m-d H:i:s');

    if (empty($nombre) || empty($apellido) || empty($email) || empty($password) || empty($confirm_password) || empty($telefono) || empty($ciudad) || empty($genero) || empty($barrio) || empty($direccion)) {
        echo '<div class="alert alert-danger" role="alert">Ingrese todos los campos</div>';
        exit();
    } else if ($password !== $confirm_password) {
        echo '<div class="alert alert-danger" role="alert">Las contraseñas no coinciden</div>';
    } else {
        // Verificar si el email ya está en uso
        $stmt_verificar_email = $conexion->prepare("SELECT COUNT(*) as count FROM tusuarios WHERE email = ?");
        $stmt_verificar_email->bind_param("s", $email);
        $stmt_verificar_email->execute();
        $result_verificar_email = $stmt_verificar_email->get_result();
        $row_verificar_email = $result_verificar_email->fetch_assoc();

        if ($row_verificar_email['count'] > 0) {
            echo '<div class="alert alert-danger" role="alert">El Email ya está en uso</div>';
        } else {
            // Verificar si la cedula ya está en uso
            $cedula = $_POST['cedula'];
            $stmt_verificar_cedula = $conexion->prepare("SELECT COUNT(*) as count FROM tusuarios WHERE cedula = ?");
            $stmt_verificar_cedula->bind_param("s", $cedula);
            $stmt_verificar_cedula->execute();
            $result_verificar_cedula = $stmt_verificar_cedula->get_result();
            $row_verificar_cedula = $result_verificar_cedula->fetch_assoc();

            if ($row_verificar_cedula['count'] > 0) {
                echo '<div class="alert alert-danger" role="alert">La cédula ya está en uso</div>';
            } else {
                // Ambas verificaciones pasaron, procede con el registro
                $id_ciudad = intval($ciudad);
                $id_genero = intval($genero);

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $stmt_insertar_usuario = $conexion->prepare("INSERT INTO `tusuarios` (`email`, `password`, `nombre`, `apellido`, `cedula`, `direccion`, `nombre_barrio`, `id_ciudad`, `id_rol`, `Fecha_registro`, `id_gen`, `Telefono`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt_insertar_usuario->bind_param("sssssssiisss", $email, $hashed_password, $nombre, $apellido, $cedula, $direccion, $barrio, $id_ciudad, $id_rol, $Fecha, $id_genero, $telefono);
        
                // Ejecutar la consulta
                if ($stmt_insertar_usuario->execute()) {
                    enviarCorreoRegistroExitoso($email,$password,$nombre);
                    echo '<div class="alert alert-success" role="alert"> Se ha enviado un correo electronico a su correo </div>';
                    
                    
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error al registrar usuario: ' . $conexion->error . '</div>';
                }
            }
        }
    }?>   
    <!-- Script Para no reenviar el formulario con los mismos datos! -->
    <script>history.replaceState(null,null,location.pathname)</script>

<?php $conexion->close(); }
?>
