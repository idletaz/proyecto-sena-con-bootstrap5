<?php

if (isset($_POST["id"])) {
    
    
    include_once "db_proyecto.php";
    $id=$_POST['id'];
    $conn=mysqli_connect($host,$user,$password,$db);
    $sql = "DELETE FROM tpqrs WHERE id_pqrs = $id";

    if ($conn->query($sql) === TRUE) {
        
        echo "La PQRS ha sido eliminado correctamente.";
    } else {
        
        echo "Error al eliminar PQRS: " . $conn->error;
    }




}



?>