<?php
include_once("../modelo/conexion.php");
session_start();

// Verificar si el usuario no ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Redirigir al usuario al formulario de inicio de sesión
    $botonSesion = "Iniciar sesión";
    $nombreUsuario = "Invitado";
    $botonRutaSesion = "login.php";
    $botonRutaPerfil = "login.php";
}else{
  $botonSesion = "Cerrar sesión";
  $nombreUsuario = $_SESSION['nombre'];
  $botonRutaPerfil = "perfil.php";
  $botonRutaSesion = "../controlador/controlador_cerrarsesion.php";
}

//obtenemos el id del usuario logeado
$user_id = $_SESSION['user_id'];
$stmt = $conexion->prepare("SELECT tusuarios.*, tciudades.nombre_ciudad, tgeneros.nombre_genero
                           FROM tusuarios
                           INNER JOIN tciudades ON tusuarios.id_ciudad = tciudades.id_ciudad
                           INNER JOIN tgeneros ON tusuarios.id_gen = tgeneros.id_genero
                           WHERE tusuarios.id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  
    $row = $result->fetch_assoc();
    $id_usuario=$row['id'];
    $nombre_usuario = $row['nombre'];
    $apellido_usuario=$row['apellido'];
    $email_usuario=$row['email'];
    $telefono_usuario=$row['Telefono'];
    $ciudad_usuario=$row['nombre_ciudad'];
    $barrio_usuario=$row['nombre_barrio'];
    $direccion_usuario=$row['direccion'];
    $genero_usuario=$row['nombre_genero'];
    $cedula_usuario=$row['cedula'];

}
$stmt->close();
$conexion->close();


?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inside - Bolsos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="css/perfil.css">
    </head>

    <body>

        <header>
            <nav class="navbar navbar-expand-lg fixed-top bg-body-tertiary">
                <div class="container-lg">
                    <div class="container-logo">
                        <a href="../index.php"><p>INSIDE |</p></a>
                        <section class="animation-logo">
                            <div class="first"><div>Store</div></div>
                            <div class="second"><div>Ropa</div></div>
                            <div class="third"><div>Accesorios</div></div>
                        </section>              
                    </div>
                <div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav d-flex align-items-center">                                                 
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle nav-text" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Productos
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="catalogo-camisas.php">Camisas</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="catalogo-bolsos.php">Bolsos</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="catalogo-zapatos.php">Zapatos</a>
                                </li>
                                </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-text ms-2" href="contacto.php">Contacto</a>
                        </li>                        
                        <li class="nav-item cajon-inicio-de-sesion">
                            <ul class="d-flex align-items-cente cajon-inicio-de-sesion_ul">
                                <li class="nav-item d-flex align-items-center">
                                    <a href=<?php echo $botonRutaPerfil; ?>>
                                        <p class="d-flex mb-0">
                                            <span class="img-perfil"></span>
                                            <span class="d-flex flex-column">
                                                <span class="nombre-usuario"><?php echo $nombreUsuario; ?></span>
                                            </span>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item d-flex align-items-center">
                                    <a class="nav-link nav-text ms-3" href="carrito.php"><span class="carrito-de-compra-nav"></span></a>
                                    <span class="carrito-compra-circulo" id="numeroArticulos">0</span>
                                </li>   
                                <li class="nav-item me-1 d-flex align-items-center">
                                    <a href="<?php echo $botonRutaSesion; ?>" class="btn btn-light btn-sesion"><?php echo $botonSesion; ?></a>                     
                                </li>
                            </ul>
                        </li>                                            
                    </ul>                
                </div>           
            </nav>
        </header>
        
        <main>
            <section class="perfil-container">
                <div class="container py-5 w-100"> 
                    <!-- Apertura php -->
                        <?php
                        include "../modelo/conexion.php";
                        include "../controlador/controlador_mod_perfil.php";
                        include "../controlador/cambio_de_contrasena.php"
                        
                        ?>            
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4 w-100">
                                <div class="card-body text-center p-5">
                                    <img src="img/img_users/User.png" alt="avatar"
                                        class="rounded-circle img-fluid" style="width: 150px;">
                                    <h5 class="my-3"><?php echo $nombre_usuario?></h5>
                                    <p class="text-muted mb-4"><?php echo $ciudad_usuario?>, Colombia</p>
                                    <div class="d-flex justify-content-center mb-2 gap-2">
                                        <button class="btn btn-primary btn-perfil" data-toggle="modal" data-target="#modalEditar">Editar información</button>
                                        <button type="button" class="btn btn-primary btn-perfil" data-bs-toggle="modal" data-bs-target="#cambioContraseña">Cambiar contraseña</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card w-100 mb-4">
                                <div class="card-body p-5">
                                <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Cedula</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $cedula_usuario;?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Nombre y apellido</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $nombre_usuario; echo " ", $apellido_usuario?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0" name="email"><?php echo $email_usuario?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Telefono</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $telefono_usuario?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Barrio</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $barrio_usuario?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Direccion</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $direccion_usuario?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Genero</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $genero_usuario?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
            </section>            
            <!-- Modal de Edición -->
            <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditarLabel">Editar Usuario</h5>                        
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                 <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre_usuario ?>">
                                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id_usuario?>">
                                </div>
                                <div class="form-group">
                                    <label for="apellido">Apellido:</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $apellido_usuario ?> ">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email_usuario ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono_usuario ?>">
                                </div>
                                <div class="form-group">
                                    <label for="barrio">Barrio:</label>
                                    <input type="text" class="form-control" id="barrio" name="barrio" value="<?php echo $barrio_usuario ?>">
                                </div>
                                <div class="form-group">
                                    <label for="direccion">direccion:</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion_usuario ?>">
                                </div>
                                <div class="form-group">
                                    <label for="genero">Género:</label>
                                    <select class="form-control" id="genero" name="genero">                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ciudad">Ciudad:</label>
                                    <select class="form-control" id="ciudad" name="ciudad">                                   
                                    </select>
                                </div>
                                <br>
                                <!-- Agrega los demás campos aquí -->
                                <button name="mod_perfil" id="mod_perfil" type="submit" class="btn btn-primary">Guardar Cambios</button>
                                <!-- Modal de Edición -->
                                <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditarLabel">Editar Usuario</h5>                        
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="POST">
                                                    <div class="form-group">
                                                        <label for="nombre">Nombre:</label>
                                                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre_usuario ?>">
                                                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id_usuario?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="apellido">Apellido:</label>
                                                        <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $apellido_usuario ?> ">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email:</label>
                                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email_usuario ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="telefono">Teléfono:</label>
                                                        <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono_usuario ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="barrio">Barrio:</label>
                                                        <input type="text" class="form-control" id="barrio" name="barrio" value="<?php echo $barrio_usuario ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="direccion">direccion:</label>
                                                        <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion_usuario ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="genero">Género:</label>
                                                        <select class="form-control" id="genero" name="genero">                                                           
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ciudad">Ciudad:</label>
                                                        <select class="form-control" id="ciudad" name="ciudad">                                                       
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <!-- Agrega los demás campos aquí -->
                                                    <button name="mod_perfil" id="mod_perfil" type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="modal fade" id="cambioContraseña" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="cambioContraseña">Cambio de contraseña</h1>
                        <?php include "../controlador/cambio_de_contraseña.php" ?>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                        <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $email_usuario ?>" readonly>
                            <div class="form-group">
                                <label for="password">Nueva contraseña:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="password-repeat">Repetir contraseña:</label>
                                <input type="password" class="form-control" id="password-repeat" name="password-repeat" required>
                            </div>
                            <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="guardar-nueva-contra" id="guardar-nueva-contra" class="btn btn-primary mt-3">Guardar</button>
                        </form>                    
                    </div>
                </div>
            </div>

        </main>
        
        <footer>
            <div class="container-lg pt-5">
                <div class="row">
                    <div class="col-4">
                        <p class="footer__p">Contacto</p> 
                        <div>
                            <p>Correo: inside@inside.com.co</p>
                            <p>Telefono: xxx xxx xxxx</p>
                            <p><a href="contacto.php" class="footer-link">Escribenos</a></p>
                            <p><a href="equipo-de-desarrollo.php" class="footer-link">Conoce nuestro equipo de desarrollo</a></p>                       
                        </div>   
                    </div>
                    <div class="col-4">
                        <p class="footer__p">Terminos y condiciones</p>
                        <div>
                            <p>Politica de garantia</p>
                            <p>Politica de devoluciones</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <p class="d-flex justify-content-center footer__p">Redes sociales</p>
                        <div class="d-flex flex-row justify-content-center">
                            <span class="footer__img-redes facebook"></span>
                            <span class="footer__img-redes instagram"></span>
                            <span class="footer__img-redes tiktok"></span>
                        </div>                           
                    </div>
                </div>
                <div class="row mt-2">
                    <h1 class="display-1 text-center mb-5">INSIDE |<span class="display-3">Store</span></h1>    
                </div>
            </div>            
        </footer>

        <!-- Script Obtener Ciudad -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
            var ciudadSelect = document.getElementById("ciudad");

            // Variable para almacenar la ciudad actual
            var ciudadActual = <?php echo json_encode($ciudad_usuario); ?>;
            console.log(ciudadActual);

            // Función para cargar las ciudades desde el servidor
            function cargarCiudades() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../controlador/obtener_ciudad.php", true);
            xhr.onload = function() {
            if (xhr.status === 200) {
                var ciudades = JSON.parse(xhr.responseText);
                    // Limpiar el menú desplegable de ciudades
                    ciudadSelect.innerHTML = '';
                    // Agregar las ciudades al menú desplegable
                    ciudades.forEach(function(ciudad) {
                        var option = document.createElement("option");
                            option.value = ciudad.id;
                            option.textContent = ciudad.nombre;
                            if (ciudad.nombre == ciudadActual) {
                                option.selected = true; // Establecer la ciudad actual como seleccionada
                            }
                            ciudadSelect.appendChild(option);
                        });
                    }
                };
                xhr.send();
            }
                // Llamar a la función para cargar las ciudades cuando la página se carga
            cargarCiudades();
            });
        </script>
        <!-- /Ciudad -->

        <!-- Script obtener genero -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
            var generoDropdown = document.getElementById('genero');

            // Variable para almacenar el género actual
            var generoActual = <?php echo json_encode($genero_usuario); ?>;

            // Hacer una solicitud al servidor para obtener los géneros desde la base de datos
            fetch('../controlador/obtener_genero.php')
                .then(response => response.json())
                .then(data => {
                data.forEach(genero => {
                    var option = document.createElement('option');
                    option.value = genero.id;
                    option.textContent = genero.nombre;
                    if (genero.nombre == generoActual) {
                        option.selected = true; // Establecer la ciudad actual como seleccionada
                    }
                        generoDropdown.appendChild(option);
                    });                        
                });
            });
        </script>
        <!-- /Genero -->

            <!-- jQuery -->
        <script src="../admin/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="../admin/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="../admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="../admin/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="../admin/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="../admin/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="../admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="../admin/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="../admin/plugins/moment/moment.min.js"></script>
        <script src="../admin/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="../admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="../admin/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="../admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../admin/dist/js/adminlte.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../admin/dist/js/demo.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="../admin/dist/js/pages/dashboard.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>     
        <script src="js/carrito.js"></script> 

    </body>
</html>