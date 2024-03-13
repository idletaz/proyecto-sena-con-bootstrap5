<?php
include_once("../modelo/conexion.php");
session_start();

// Verificar si el usuario no ha iniciado sesión
if (!isset($_SESSION['user_id'])) {   
    header('Location: login.php');
    exit(); 
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
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="css/perfil.css">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg fixed-top bg-body-tertiary">
                <div class="container-lg">
                  <div>
                    <a class="navbar-brand" href="home.php">INSIDE |<span class="navbar-brand__span">Store</span></a>
                  </div>
                  <div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav d-flex align-items-center">
                            <li class="nav-item">
                                <a class="nav-link nav-text ms-2" href="login.php">**Login**</a>
                            </li>                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle nav-text" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Productos
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="catalogo-camisas.html">Camisas</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="catalogo-bolsos.html">Bolsos</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="catalogo-zapatos.html">Zapatos</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link nav-text ms-2" href="contacto.php">Servicio al cliente</a>
                            </li>
                            <li class="nav-item">
                              <a href="#"><p class="ms-5 mb-0"><span class="img-perfil"></span> Perfil</p></a>
                            </li>
                            <li class="nav-item d-flex align-items-center">
                                <a class="nav-link nav-text ms-3" href="carrito.html"><span class="carrito-de-compra-nav"></span></a>
                                <span class="carrito-compra-circulo">0</span>
                            </li>                        
                        </ul>
                    </div>
                  </div>          
                </div>
            </nav>
        </header>
        <main>
            <section>
                <div class="container py-5">             
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img src="img/img_users/User.png" alt="avatar"
                                        class="rounded-circle img-fluid" style="width: 150px;">
                                    <h5 class="my-3"><?php echo $nombre_usuario?></h5>
                                    <p class="text-muted mb-4"><?php echo $ciudad_usuario?>, Colombia</p>
                                    <div class="d-flex justify-content-center mb-2">
                                        <button type="button" class="btn btn-primary">Editar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body">
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
                                            <p class="text-muted mb-0"><?php echo $email_usuario?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Celular</p>
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
        </main>
        <footer class="mt-5">
            <div class="container-lg pt-5">
                <div class="row">
                    <div class="col-3">
                        <p class="footer__p">Nuestro equipo de desarrollo</p>
                        <div>
                            <p><span></span> Equipo de desarrollo</p>
                            <p><span></span> Equipo de ventas</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <p class="footer__p">Contacto</p> 
                        <div>
                            <p>Correo: inside@inside.com.co</p>
                            <p>Telefono: xxx xxx xxxx</p>
                            <p>Escribenos</p>
                        </div>   
                    </div>
                    <div class="col-3">
                        <p class="footer__p">Terminos y condiciones</p>
                        <div>
                            <p>Politica de garantia</p>
                            <p>Politica de devoluciones</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <p class="d-flex justify-content-center footer__p">Redes sociales</p>
                        <div class="d-flex flex-row justify-content-center">
                            <span class="footer__img-redes facebook"></span>
                            <span class="footer__img-redes instagram"></span>
                            <span class="footer__img-redes tiktok"></span>
                        </div>                           
                    </div>
                </div>
                <div class="row mt-5">
                    <h1 class="display-1 text-center mb-5">INSIDE |<span class="display-3">Store</span></h1>    
                </div>
            </div>            
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>     
    </body>
</html>