<?php

if (isset($_POST["id"])) {
    
    
    include_once "db_proyecto.php";
    $id=$_POST['id'];
    $conn=mysqli_connect($host,$user,$password,$db);
    $sql = "DELETE FROM tusuarios WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        
        echo "El Usuario ha sido eliminado correctamente.";
    } else {
        
        echo "Error al eliminar el usuario: " . $conn->error;
    }




}



?>