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

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inside - Bolsos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="css/registro.css">
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
            <div class="container contenedor-formulario">
                <form class="row" action="#" method="POST">
                    <div class="col-lg-4 p-0 d-lg-block d-none formulario">
                        <span class="formulario__img"></span>
                    </div>
                    <div class="col-lg-8">
                        <div class="row title mt-4">
                            <h1 class="display-6 mt-lg-3 mt-sm-2">Registrese</h1>
                            <!-- Apertura php -->
                            <?php
                                include("../modelo/conexion.php");
                                include("../controlador/controlador_registrar.php");                                
                             ?>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Nombre" name="nombre" id="nombre" required>
                                        <label for="floatingInput">Nombre</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Apellido" name="apellido" id="apellido" required>
                                        <label for="floatingInput">Apellido</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Cedula" name="cedula" id="cedula" required>
                                        <label for="floatingInput">Cedula</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Telefono" name="telefono" id="telefono" required>
                                        <label for="floatingInput">Telefono</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" id="email" required>
                                        <label for="floatingInput">Correo electronico</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Direccion" name="direccion" id="direccion" required>
                                    <label for="floatingInput">Direccion</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Barrio" name="barrio" id="barrio" required>
                                    <label for="floatingInput">Barrio</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="ciudad" id="ciudad" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                      <option selected>Seleccionar</option>                                      
                                    </select>
                                    <label for="floatingSelect">Ciudad</label>
                                  </div>
                                  <div class="form-floating mb-3">
                                    <select name="genero" id="genero" class="form-select" id="floatingSelect" aria-label="Floating label select example" >
                                        <option selected>Seleccionar genero</option>                 
                                      </select>
                                      <label for="floatingSelect">Genero</label>
                                  </div>    
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass" id="pass" required>
                                    <label for="floatingPassword">Contraseña</label>
                                  </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="confirm_pass" id="confirm_pass" required>
                                    <label for="floatingPassword">Repita la contraseña</label>
                                  </div>
                            </div>
                        </div>
                        <div class="row">                         
                            <div class="col-12 mt-3">
                                <div class="mt-2 py-sm-3">
                                    <button name="registrar" id="registrar" type="submit" class="btn btn-primary btn-lg">Hecho</button>
                                    <a href="../index.php"><button type="button" class="btn btn-primary btn-lg ms-3">Pagina inicial</button></a>
                                </div>                            
                            </div>                        
                        </div>
                    </div>
                </form>
            </div>
            
        </main>
        <!--Scripts-->
        <!-- Script Obtener Ciudad -->
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                var ciudadSelect = document.getElementById("ciudad");
            
                // Función para cargar las ciudades desde el servidor
                function cargarCiudades() {
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", "../controlador/obtener_ciudad.php", true);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            var ciudades = JSON.parse(xhr.responseText);
            
                            // Limpiar el menú desplegable de ciudades
                            ciudadSelect.innerHTML = '<option value="">Selecciona una ciudad</option>';
            
                            // Agregar las ciudades al menú desplegable
                            ciudades.forEach(function(ciudad) {
                                var option = document.createElement("option");
                                option.value = ciudad.id;
                                option.textContent = ciudad.nombre;
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

                        // Hacer una solicitud al servidor para obtener las ciudades desde la base de datos
                        fetch('../controlador/obtener_genero.php')
                            .then(response => response.json())
                            .then(data => {
                                data.forEach(genero => {
                                    var option = document.createElement('option');
                                    option.value = genero.id;
                                    option.textContent = genero.nombre;
                                    generoDropdown.appendChild(option);
                                });
                            });
                    });
            </script>
        <!-- /Genero -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>        
    </body>
</html>