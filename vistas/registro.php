<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="css/registro.css">
    </head>       
    <body>
        <header>
            <nav class="navbar navbar-expand-lg fixed-top bg-body-tertiary">
                <div class="container-lg">
                  <div>
                    <a class="navbar-brand" href="../index.html">INSIDE |<span class="navbar-brand__span">Store</span></a>
                  </div>
                </div>              
            </nav>
        </header> 
        <main class="container">
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
                                    <a href="catalogo-camisas.html"><button type="button" class="btn btn-primary btn-lg ms-3">Pagina inicial</button></a>
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