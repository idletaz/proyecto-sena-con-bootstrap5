
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="css/login.css">

    </head>      
    <body class="d-flex align-items-center justify-content-center">
      <header>
        <nav class="navbar navbar-expand-lg fixed-top bg-body-tertiary">
            <div class="container-lg">
              <div>
                <a class="navbar-brand" href="home.php">INSIDE |<span class="navbar-brand__span">Store</span></a>
              </div>
            </div>              
        </nav>
      </header>
      <main class="container">
          <div class="row">
              <div class="col-lg-4 p-0 d-lg-block d-none contenedor-formulario">
                  <img src="../vistas/img/ropas/banners/cuadrados-alargados/BANNER-HOME-FIT-FINDER-SM-2.webp" class="contenedor-formulario__img" alt="">
              </div>
              <div class="col-lg-8 d-flex flex-column align-items-center justify-content-center">
                  <form action="#" method="post" style="width: 60%;">
                      <div class="row title mb-3">
                        <div class="col-12">
                          <h1 class="display-6 mt-lg-3 mt-sm-2">Inicie sesión</h1>
                          <!-- Apertura php -->
                          <?php
                          include("../modelo/conexion.php");
                          include("../controlador/controlador_login.php");
                          
                          ?>
                        </div>
                       </div>
                      <div class="row">
                         <div class="col-12">
                           <div class="form-floating mb-3">
                             <input type="email" class="form-control" id="floatingEmail" placeholder="Correo electrónico" name="email" id="email" required>
                             <label for="floatingEmail">Correo electrónico</label>
                           </div>
                          <div class="form-floating mb-3">
                             <input type="password" class="form-control" id="floatingPassword" placeholder="Contraseña" name="pass" id="pass" required>
                            <label for="floatingPassword">Contraseña</label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12 d-flex flex-column">
                           <p>¿Olvidó su contraseña? <a href="#" class="ancla">Recuperar</a></p>
                           <p>Cree una cuenta <a href="registro.php" class="ancla">aquí</a></p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12 mt-3">
                          <button name="login" id="login" type="submit" class="btn btn-primary btn-lg">Ingresar</button>
                        </div>
                      </div>
                    </form>
              </div>
          </div>
      </main>
        
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>        
    </body>
</html>