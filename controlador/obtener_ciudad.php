<?php
include '../modelo/conexion.php';
// Consulta para obtener las ciudades
$query = "SELECT * FROM tciudades";
$result = $conexion->query($query);

if(!$result){
    die("Error de la consulta: ". $conexion->error);
}

// Array para almacenar las ciudades
$ciudades = array();

// Obtener las ciudades y agregarlas al array
while ($row = $result->fetch_assoc()) {
    $ciudades[] = array(
        'id' => $row['id_ciudad'],
        'nombre' => $row['nombre_ciudad']
    );
}

// Cerrar la conexión
$conexion->close();

// Devolver las ciudades en formato JSON
header('Content-Type: application/json');
echo json_encode($ciudades);




?>