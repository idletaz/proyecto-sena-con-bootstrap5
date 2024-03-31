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
        <link rel="stylesheet" href="css/carrito.css">
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
                                            <a href="<?php echo $botonRutaSesion; ?>" class="btn btn-sesion"><?php echo $botonSesion; ?></a>                     
                                        </li>
                                    </ul>
                                </li>                                            
                            </ul>                
                        </div>          
                    </div>
                </nav>
        </header>       
        <main>
            <div class="container-lg container-principal">
                <div class="row">
                    <aside class="col-lg-9 container-productos">
                        <div class="card p-5">
                            <div class="table-responsive">
                                <table class="table table-borderless table-shopping-cart">
                                    <thead class="text-muted">
                                        <tr class="small text-uppercase">
                                            <th scope="col">Productos</th>
                                            <th scope="col" width="200">Cantidad</th>
                                            <th scope="col" width="200">Precio</th>
                                            <th scope="col" class="text-right d-none d-md-block" width="130">
                                        </tr>
                                    </thead>
                                    <tbody id="tblListadoProductos">
																		</tbody>
                                </table>
                            </div>
                        </div>
                    </aside>
                    <aside class="col-lg-3">
                        <div class="card mb-3">
                            <div class="card-body">
                                <form>
                                    <div class="form-group"> <label>Agregue un cupon</label>
                                        <div class="input-group"> <input type="text" class="form-control coupon" name="" placeholder="Cupon de descuento"> <span class="input-group-append"> <button class="btn btn-primary btn-apply coupon">Aplicar</button> </span> </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <dl class="dlist-align">
                                    <dt>Subtotal</dt>
                                    <dd class="text-right text-izq" id="subTotalProductos">$ 700.000</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Descuento</dt>
                                    <dd class="text-right text-danger text-izq">-$ 50.000</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Total con IVA</dt>
                                    <strong class="text-right text-green b text-izq">
                                    <span id="totalPrecioProductos">0</span>
                                    </strong>

                                </dl>
                                <hr> <a href="../index.php" class="btn btn-out btn-primary btn-square btn-main" data-abc="true"> Seguir comprando </a>
                                 <a href="#" class="btn btn-out btn-success btn-square btn-main mt-2" id="finalizarCompraBtn" data-abc="true">Finzalizar la compra</a>
                                 <!-- Formulario de pago -->
                                 <div id="formularioPago" style="display: none;">
                                 <form id="formularioPago">
                                    <label for="nombreTarjeta">Nombre en la tarjeta:</label>
                                    <input type="text" id="nombreTarjeta" name="nombreTarjeta" required><br><br>
                                    <label for="numeroTarjeta">Número de tarjeta:</label>
                                    <input type="text" id="numeroTarjeta" name="numeroTarjeta" required><br><br>
                                    
                                    <button type="submit">Pagar</button>
                                </form>

                                
                                
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>                        
        </main>
        <footer class="mt-5">
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
        <!-- Script -->
        <!-- Script formulario de compra -->
                                <script>                           
                            const finalizarCompraBtn = document.getElementById('finalizarCompraBtn');                          
                            const formularioPago = document.getElementById('formularioPago');                          
                            finalizarCompraBtn.addEventListener('click', function(event) {                                
                                event.preventDefault();                                
                                formularioPago.style.display = 'block';
                            });
                                </script>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>      
        <script src="js/carrito.js"></script>

    </body>
</html>