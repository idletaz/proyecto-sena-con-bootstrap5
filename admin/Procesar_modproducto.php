<?php
// Verificar si el formulario ha sido enviado
if (isset($_POST["Guardar"])) {
    // Conectar a la base de datos (debes incluir tu propia lógica de conexión)
    include_once "db_proyecto.php";
    $conn=mysqli_connect($host,$user,$password,$db);

    $id_producto= $_POST['id_producto'];
    $nombre_producto = $_POST['nombre'];
    $precio_producto = $_POST['precio'];
    $cantidad = intval($_POST['cantidad']);
    $descripcion = $_POST['detalle'];
    $talla = $_POST['talla'];
    $categoria = $_POST['categoria'];
    $color = $_POST['color'];
    $estado = $_POST['estado'];
    $ruta_img = ''; 
    $Fecha=date('Y-m-d H:i:s');
    

    if ($_FILES['imagen']['error'] === 0) {
        // Obtener la extensión del archivo
        $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        
        // Lista de extensiones permitidas
        $extensiones_permitidas = array('jpg', 'jpeg', 'png', 'webp');
    
        // Verificar si la extensión está en la lista de extensiones permitidas
        if (in_array(strtolower($extension), $extensiones_permitidas)) {
            // Generar un nombre único para el archivo
            $nombre_archivo = 'imagen_' . time() . '_' . mt_rand(1000, 9999) . '.' . $extension;
    
            // Construir la ruta de la imagen
            $ruta_imagen = 'uploads/' . $nombre_archivo;
    
            // Mover el archivo a la carpeta de destino
            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);


            $sql = "UPDATE tprodu SET nombre_producto = '$nombre_producto', Precio_producto = '$precio_producto',        Cantidad = '$cantidad',        Descripcion = '$descripcion',        Talla = '$talla',        Categoria = '$categoria',        Color = '$color',        Estado = '$estado',        Ruta_img = '$ruta_imagen', fecha_mod= '$Fecha'   WHERE         id_producto = '$id_producto'";
                if ($conn->query($sql) === TRUE) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                    echo 'Producto Modificado correctamente.';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                    echo '</div>';
                    echo '<script>';
                    echo 'setTimeout(function() { window.location.href = "CrudProductos.php"; }, 2500);'; // Redirecciona después de 3 segundos
                    echo '</script>';
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
           El formato de archivo no está permitido. Por favor, sube una imagen con formato JPG, JPEG, PNG O WEBP.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }
    // Insertar datos en la base de datos
     //Con el Scritp se recarga la pagina y no se vuelve a poner el producto?>
    
    <script>history.replaceState(null,null,location.pathname)</script>
    
<?php $conn->close();}
?>
