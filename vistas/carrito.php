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
  $user_id = $_SESSION['user_id'];
    $stmt = $conexion->prepare("SELECT id FROM tusuarios WHERE id= ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
    
        $row = $result->fetch_assoc();
        $id_usuario=$row['id'];
        $_SESSION['id_usuario'] = $id_usuario;
    }
    $stmt->close();
    $conexion->close();
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
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
                                        <?php 
                                        include "../modelo/conexion.php";
                                        //include "../controlador/procesar_venta.php";?>
                                        <tr class="small text-uppercase">
                                            <th scope="col">Productos</th>
                                            <th scope="col" width="200">Cantidad</th>
                                            <th scope="col" width="200">Precio</th>
                                            <th scope="col">Descuento</th>
                                            <th scope="col" class="text-right d-none d-md-block" width="130">
                                        </tr>
                                    </thead>
                                    <tbody id="tblListadoProductos"> </tbody>
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
                                    <dd class="text-right text-danger text-izq" id="descuentos">-$ 50.000</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Total con IVA</dt>
                                    <strong class="text-right text-green b text-izq">
                                    <span id="totalPrecioProductos" name="totalPrecioProductos">0</span>
                                    </strong>

                                </dl>
                                <hr> 
                                <a href="../index.php" class="btn btn-out btn-primary btn-square btn-main" data-abc="true"> Seguir comprando </a>
                                <button type="button" id="botonPagarPedido" class="btn btn-out btn-success btn-square btn-main mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal2">Finalizar la compra</button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel2">Tarjeta de credito o debito</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" id="formularioPago" action="../controlador/procesar_venta.php">
                                            <img src="./img/iconos/contactless.png" alt="" class="img-body">
                                            <div class="contenedor-metodos-de-pago">
                                                <div class="mb-3">
                                                    <input type="hidden" id="id" name="id" value="<?php echo $id_usuario; ?>">
                                                    <label for="formGroupExampleInput" class="form-label">Nombre del titular</label>
                                                    <input type="text" class="form-control"id="formGroupExampleInput2" placeholder="escriba su nombre">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="formGroupExampleInput2"class="form-label">Numero de tarjeta</label>
                                                    <input type="text" class="form-control"id="formGroupExampleInput2" placeholder="0000 0000 0000 0000">
                                                </div>
                                                <div class="datos-tc">
                                                    <div class="fecha-expedicion">
                                                        <label for="formGroupExampleInput2"class="form-label">Fecha de expedicion</label>
                                                        <input type="date" class="form-control"id="formGroupExampleInput2" placeholder="Another inputplaceholder">
                                                        </div>
                                                    <div class="cvv">
                                                        <label for="formGroupExampleInput2"class="form-label">CCV</label>
                                                        <input type="password" class="form-control"id="formGroupExampleInput2" placeholder="***">
                                                        <img src="./img/iconos/credit-card.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <!-- <button type="button" class="btn btn-primary"  onclick="pagarPedido()">Realizar pago</button> -->
                                            <a class="btn btn-primary" onclick="pagarPedido()" >Realizar Pago</a>
                                        </div>
                                    </div>
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
        <script>
            function abrirModal() {
                // Adjuntar el evento click al botón dentro del modal
                document.getElementById("botonPagarPedido").addEventListener("click", pagarPedido);
            }

            // Esta función se llama cuando se cierra el modal
            function cerrarModal() {
                // Remover el evento click del botón dentro del modal
                document.getElementById("botonPagarPedido").removeEventListener("click", pagarPedido);
            }
        </script>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>      
        <script src="js/carrito.js"></script>

    </body>
</html>