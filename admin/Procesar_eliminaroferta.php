<?php

if (isset($_POST["id"])) {
    
    
    include_once "db_proyecto.php";
    $id=$_POST['id'];
    $conn=mysqli_connect($host,$user,$password,$db);
    $sql = "DELETE FROM tofertas WHERE id_oferta = $id";

    if ($conn->query($sql) === TRUE) {
        
        echo "La oferta ha sido eliminado correctamente.";
    } else {
        
        echo "Error al eliminar la oferta: " . $conn->error;
    }




}



?>