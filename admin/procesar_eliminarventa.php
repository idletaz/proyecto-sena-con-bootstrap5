<?php

if (isset($_POST["id_producto"])) {
    
    
    include_once "db_proyecto.php";
    $id_producto=$_POST['id_venta'];
    $conn=mysqli_connect($host,$user,$password,$db);
    $sql = "DELETE FROM tventas WHERE id_venta = $id_producto";

    if ($conn->query($sql) === TRUE) {
        
        echo "La ventaha sido eliminado correctamente.";
    } else {
        
        echo "Error al eliminar la venta: " . $conn->error;
    }




}



?>