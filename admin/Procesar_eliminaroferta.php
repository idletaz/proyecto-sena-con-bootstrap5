<?php

if (isset($_POST["id"])) {
    
    
    include_once "db_proyecto.php";
    $id=$_POST['id'];
    $conn=mysqli_connect($host,$user,$password,$db);
    $sql = "SELECT id_producto from tprodu WHERE id_producto = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Verificar si se encontró el producto con el ID dado
        if (mysqli_num_rows($result) > 0) {
            // Consulta para eliminar la oferta
            $sql = "UPDATE tprodu SET oferta = 0, descuento = NULL WHERE id_producto = $id";
    
            // Ejecutar la consulta
            if (mysqli_query($conn, $sql)) {
                // Verificar si se realizaron cambios en la base de datos
                if (mysqli_affected_rows($conn) > 0) {
                    echo "La oferta ha sido eliminada correctamente.";
                } else {
                    echo "No se encontró ninguna oferta para eliminar.";
                }
            } else {
                echo "Error al eliminar la oferta: " . mysqli_error($conn);
            }
        } else {
            echo "No se encontró ningún producto con el ID proporcionado.";
        }
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    }




}



?>