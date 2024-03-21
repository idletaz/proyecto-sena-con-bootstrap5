<?php
// Verificar si se recibieron los datos del formulario
if (isset($_POST['mod_perfil'])) {
    // Incluir la conexión a la base de datos
    include '../modelo/conexion.php';

    // Recibir los datos del formulario
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $barrio= $_POST['barrio'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $genero = $_POST['genero'];
    $id_ciudad=intval($ciudad);
    $id_genero=intval($genero);

    // Actualizar los datos del usuario en la base de datos
    $sql = "UPDATE tusuarios 
            SET nombre = ?, apellido = ?, email = ?, Telefono = ?, nombre_barrio= ?, direccion = ?, id_ciudad = ?, id_gen = ?
            WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssiii", $nombre, $apellido, $email, $telefono,$barrio, $direccion, $id_ciudad, $id_genero, $id_usuario);

    if ($stmt->execute()) {
        echo '<script>
                setTimeout(function() {
                    window.location.href = "perfil.php";
                }, 2000);
              </script>';      
        
              echo '<div class="alert alert-success" role="alert">
                    ¡Perfil actualizado exitosamente!
                    </div>';
        } else {
        // Mensaje de error
        echo '<div class="alert alert-danger" role="alert">
                Error al actualizar el perfil. Por favor, inténtalo de nuevo más tarde.
            </div>';
        }

    // Cerrar la conexión
    $stmt->close();
    $conexion->close();
}
?>
