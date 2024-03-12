<?php

if (isset($_POST["id_producto"])) {
    
    
    include_once "db_proyecto.php";
    $id_producto=$_POST['id_producto'];
    $conn=mysqli_connect($host,$user,$password,$db);
    $sql = "DELETE FROM tprodu WHERE id_producto = $id_producto";

    if ($conn->query($sql) === TRUE) {
        
        echo "El producto ha sido eliminado correctamente.";
    } else {
        
        echo "Error al eliminar el producto: " . $conn->error;
    }




}



?>