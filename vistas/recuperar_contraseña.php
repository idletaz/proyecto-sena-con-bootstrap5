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
  $nombreUsuario = $_SESSION['user_nombre'];
  $botonRutaPerfil = "perfil.php";
  $botonRutaSesion = "../controlador/controlador_cerrarsesion.php";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/recuperar-contraseña.css">

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
                                  <span><?php echo $nombreUsuario; ?></span>
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
            </div>
        </nav>
      </header>
    <main>
      <section class="form-container">
      <form action="#" method="post" style="width: 60%;">
                      <div class="row title mb-3">
                        <div class="col-12">
                          <h1 class="display-6 mt-lg-3 mt-sm-2 text-center">Cambiar contraseña</h1>
                          <!-- Apertura php -->
                          <?php
                          require "../modelo/conexion.php";
                          require "../controlador/Controlador_reset_pass.php";                     
                          
                          ?>
                        </div>
                       </div>
                      <div class="row">
                         <div class="col-12">
                           <div class="form-floating mb-3">
                             <input type="password" class="form-control" placeholder="Correo electrónico" name="password" id="contraseña" required>
                             <label for="contraseña">Nueva contraseña</label>
                           </div>
                          <div class="form-floating mb-3">
                             <input type="password" class="form-control" placeholder="Contraseña" name="re-password" id="re-pass" required>
                            <label for="re-pass">Repetir contraseña</label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12 mt-3 d-flex justify-content-center">
                          <button name="reset_pass" id="reset_pass" type="submit" class="btn btn-primary btn-lg">Actualizar</button>
                        </div>
                      </div>
                    </form>
      </section>
          
    </main>
    <footer class="mt-5">
        <div class="container-lg pt-5">
            <div class="row">
                <div class="col-4">
                    <p class="footer__p">Contacto</p> 
                    <div>
                        <p>Correo: inside@inside.com.co</p>
                        <p>Telefono: xxx xxx xxxx</p>
                        <p>Escribenos</p>
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
            <div class="row mt-5">
                <h1 class="display-1 text-center mb-5">INSIDE |<span class="display-3">Store</span></h1>    
            </div>
        </div>            
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> 
</body>
</html>