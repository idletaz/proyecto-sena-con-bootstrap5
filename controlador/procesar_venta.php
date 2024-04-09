<?php
session_start();
include "../modelo/conexion.php";
$data = json_decode(file_get_contents("php://input"), true);
if(isset($_SESSION['user_id'])) {    
    $user_id = $_SESSION['user_id'];
    
    $stmt = $conexion->prepare("SELECT id FROM tusuarios WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_cliente = $row['id'];         
        $fecha_venta = date('Y-m-d H:i:s'); 
        $total_venta = 0;

        $stmt = $conexion->prepare("INSERT INTO tventas (fecha_venta, total_venta, id_cliente) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $fecha_venta, $total_venta, $id_cliente);
        $stmt->execute();
        $id_venta = $stmt->insert_id;

        $stmt->close();

foreach ($data['detalleFactura'] as $detalle) {
    $id_producto = $detalle['id_producto'];
    $precio_unitario = $detalle['precio_producto'];
    $cantidad_producto = $detalle['cantidad'];

    $subtotal_producto = $precio_unitario * $cantidad_producto;    
    $total_venta += $subtotal_producto;

    
    $stmt = $conexion->prepare("INSERT INTO tdetalle_venta (id_venta, id_producto, precio_unitario, cantidad_producto) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iidi", $id_venta, $id_producto, $precio_unitario, $cantidad_producto);
    $stmt->execute();

    $stmt->close();
}
$stmt = $conexion->prepare("UPDATE tventas SET total_venta = ? WHERE id_venta = ?");
$stmt->bind_param("di", $total_venta, $id_venta);
$stmt->execute();

$stmt->close();
$conexion->close();


echo $id_venta;
http_response_code(200);
    }else {        
        header("Location: login.php");
        exit(); 
    }
}else {    
    header("Location: login.php");
    exit();
}





?>