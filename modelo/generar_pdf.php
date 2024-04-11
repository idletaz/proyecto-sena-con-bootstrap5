<?php

require_once('../pdf/tcpdf.php');


function obtenerDetalleFacturaVenta($id_venta) {
    require_once ("conexion.php");
    
    $sql = "SELECT detalle.*, producto.nombre_producto AS nombre_producto, usuario.nombre AS nombre_cliente, usuario.direccion AS direccion_cliente, usuario.nombre_barrio AS barrio_cliente, usuario.Telefono AS telefono_cliente, venta.fecha_venta as fecha_venta
        FROM tdetalle_venta AS detalle 
        INNER JOIN tprodu AS producto ON detalle.id_producto = producto.id_producto 
        INNER JOIN tventas AS venta ON detalle.id_venta = venta.id_venta 
        INNER JOIN tusuarios AS usuario ON venta.id_cliente = usuario.id
        WHERE detalle.id_venta = $id_venta";

    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $detalle_factura = array();
        
        

        
        while($fila = $resultado->fetch_assoc()) {
            $detalle_factura[] = $fila;
            
            
        }

        
        $conexion->close();

        
        return $detalle_factura;
    } else {
        
        return array();
    }
}


function generarDetalleFacturaPDF($detalle_factura) {
    // Crear una instancia de TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Establecer el título del documento
    $pdf->SetTitle('Detalle de la factura');

    // Agregar una página
    $pdf->AddPage();

    
    $logo = '../vistas/img/img_users/FacturaPDF.png';
    $pdf->Image($logo);
    $x = 461;
    $y = 567;
    $pdf->SetXY($x, $y);
    $pdf->writeHTML('<p>' . $detalle_factura[0]['fecha_venta'] . '</p>');
    
    $pdf->SetFont('helvetica', '', 10);

    
    

    
    // $pdf->SetY(70); 
    // $pdf->writeHTML('<p>Cliente: ' . $detalle_factura[0]['nombre_cliente'] . '</p>');
    // $pdf->SetY($pdf->GetY() + 5);
    // $pdf->writeHTML('<p>Dirección: ' . $detalle_factura[0]['direccion_cliente'] . '</p>');
    // $pdf->writeHTML('<p>Barrio: ' . $detalle_factura[0]['barrio_cliente'] . '</p>');
    // $pdf->writeHTML('<p>Teléfono: ' . $detalle_factura[0]['telefono_cliente'] . '</p>');
    // $pdf->writeHTML('<br>');

    
    

    
    $html = '<table border="1">';
    $html .= '<tr>';
    $html .= '<th>Producto</th>';
    $html .= '<th>Precio Unitario</th>';
    $html .= '<th>Cantidad</th>';
    $html .= '<th>Total por Producto</th>';
    $html .= '</tr>';
    
    $total_venta=0;
    foreach ($detalle_factura as $item) {
        $html .= '<tr>';
        $html .= '<td>' . $item['nombre_producto'] . '</td>';
        $html .= '<td>$' . $item['precio_unitario'] . '</td>';
        $html .= '<td>' . $item['cantidad_producto'] . '</td>';
        $html .= '<td>$' . $item['total_x_producto'] . '</td>';
        $html .= '</tr>';
        $total_venta+=$item['total_x_producto'];
    }

    $html .= '</table>';

    // Agregar el contenido HTML al PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Agregar total de la venta
    $pdf->writeHTML('<br>');
    $pdf->writeHTML('<p>Total de la venta: $' . $total_venta . '</p>');

    // Generar el PDF en memoria
    $pdfContent = $pdf->Output('', 'S');

    // Configurar las cabeceras para que el navegador entienda que es un archivo PDF que se está descargando
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="detalle_factura.pdf"');

    // Imprimir el contenido del PDF
    echo $pdfContent;
}




$id_venta = $_GET['id_venta'];
$detalle_factura = obtenerDetalleFacturaVenta($id_venta);
generarDetalleFacturaPDF($detalle_factura);
?>




?>
