<?php
include_once("../modelo/conexion.php");
session_start();

$user_id = $_SESSION['user_id'];
$stmt = $conexion->prepare("SELECT nombre FROM tusuarios WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre_usuario = $row['nombre'];
    
} else {
    $nombre_usuario = "Registrarse";
   
}
$stmt->close();
$conexion->close();


?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contacto</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="css/contacto.css">    
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg fixed-top bg-body-tertiary">
                <div class="container-lg">
                  <div>
                    <a class="navbar-brand" href="../index.html">INSIDE |<span class="navbar-brand__span">Store</span></a>
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
                              <a class="nav-link nav-text ms-2" href="contacto.php">**Servicio al cliente**</a>
                            </li>
                            <li class="nav-item">
                            <a href="<?php echo isset($_SESSION['user_id']) ? '../controlador/controlador_cerrarsesion.php' : 'login.php';?>">
                            <button class="btn <?php echo isset($_SESSION['user_id']) ? 'btn-danger' : 'btn-primary'; ?>">
                                <i class="fa <?php echo isset($_SESSION['user_id']) ? 'fa-power-off' : 'fa-sign-in'; ?>"></i>
                                <?php echo isset($_SESSION['user_id']) ? 'Cerrar sesión' : 'Iniciar sesión'; ?>
                            </button>
                            </a>
                            </li> 
                            <li class="nav-item">
                                <!-- Apertura php -->
                                
                                <a href="<?php echo isset($_SESSION['user_id']) ? 'perfil.html' : 'registro.php';?>"><p class="ms-5 mb-0"><span class="img-perfil"></span><?php echo $nombre_usuario?></p></a>
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
            <div class="container-contact100">        
                <div class="wrap-contact100">                    
                    <form class="contact100-form validate-form" method="post">
                        <!-- Apertura php -->
                        <?php
                        require "../modelo/conexion.php";
                        require "../controlador/controlador_contacto.php";
                        
                        ?>
                        <span class="display-6 contact100-form-title">
                            Contactenos
                        </span>            
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingEmail" placeholder="Nombre" name="nombre" id="nombre" required>
                            <label for="floatingEmail">Nombre</label>
                          </div>    
                          <br>        
                          <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingEmail" placeholder="Correo electrónico" name="email" id="email" required>
                            <label for="floatingEmail">Correo electrónico</label>
                          </div>
                          <br>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingEmail" placeholder="Asunto" name="asunto" id="asunto" required>
                            <label for="floatingEmail">Asunto</label>
                          </div>            
                        <div class="wrap-input100 validate-input" data-validate="Please enter your message">
                            <textarea class="input100" name="mensaje" placeholder="Comentario..." required></textarea>
                            <span class="focus-input100"></span>
                        </div>            
                        <div class="container-contact100-form-btn">
                            <button name="contacto" id="contacto" type="submit" class="btn btn-primary btn-lg">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>                                   
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
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>      

    </body>
</html>