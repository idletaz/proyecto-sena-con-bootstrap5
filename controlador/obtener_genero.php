<?php
// Incluir el archivo de conexión
include '../modelo/conexion.php';

// Consulta para obtener los géneros
$query = "SELECT * FROM tgeneros";

// Realizar la consulta a la base de datos
$result = $conexion->query($query);

// Verificar si la consulta fue exitosa
if (!$result) {
    // Si hay un error en la consulta, mostrar un mensaje de error
    die("Error en la consulta: " . $conexion->error);
}

// Array para almacenar los géneros
$generos = array();

// Obtener los resultados de la consulta y almacenarlos en el array de géneros
while ($row = $result->fetch_assoc()) {
    $generos[] = array(
        'id' => $row['id_genero'],
        'nombre' => $row['Nombre_genero']
    );
}

// Cerrar la conexión
$conexion->close();

// Devolver los géneros en formato JSON
header('Content-Type: application/json');
echo json_encode($generos);
?>