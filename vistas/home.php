<?php
include_once("../modelo/conexion.php");
session_start();

// Verificar si el usuario no ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Redirigir al usuario al formulario de inicio de sesión
    header('Location: login.php');
    exit(); 
}
//obtenemos el id del usuario logeado
$user_id = $_SESSION['user_id'];
$stmt = $conexion->prepare("SELECT nombre FROM tusuarios WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {  
    $row = $result->fetch_assoc();
    $nombre_usuario = $row['nombre'];
} else {
    $nombre_usuario = "Nombre de Usuario Desconocido";
}
$stmt->close();
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body>
      <header>
        <nav class="navbar navbar-expand-lg fixed-top bg-body-tertiary">
            <div class="container-lg">
              <div>
                <a class="navbar-brand" href="#">INSIDE |<span class="navbar-brand__span">Store</span></a>
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
                          <a class="nav-link nav-text ms-2" href="contacto.php">Servicio al cliente</a>
                        </li>
                        <li class="nav-item">
                          <a href="perfil.php"><p class="ms-5 mb-0"><span class="img-perfil"></span><?php echo $nombre_usuario?></p></a>
                        </li>
                        
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link nav-text ms-3" href="carrito.html"><span class="carrito-de-compra-nav"></span></a>
                            <span class="carrito-compra-circulo">0</span>
                        </li>   
                        <li class="nav-item">
                        <a href="../controlador/controlador_cerrarsesion.php" class="btn btn-danger">
                            <i class="fa fa-power-off"></i>
                            Cerrar sesión
                         </a>                     
                         </li>                     
                    </ul>
                </div>
              </div>          
            </div>
        </nav>
      </header>
      <main>
        <section class="container-expand-lg">     
          <article class="container-expand-lg d-flex m-0 p-0" style="height: 95vh;">
            <div class="contenedor-mensaje-principal" style="height: 100%;">
              <div class="contenedor-mensaje-principal__texto">
                <h2>Un lugar fantastico para ponerte a la moda, ¡mujer!</h2>
                <p>"Descubre las últimas tendencias y encuentra tu estilo único. Sumérgete en nuestra colección y déjate inspirar."</p>
              </div>              
            </div>
          </article>
          <article>
            <div class="contenedor-texto">
              <p class="texto-animado">
                <span>Bienvenida a nuestra tienda de moda femenina</span>
                <span>Ropa con hasta el 50% de descuento</span>
                <span>Promociones unicas todo el año</span>
                <span>Catalogo en constante actualizacion</span>
                <span></span>
              </p>
            </div>            
          </article>
          <!-- Apertura php para productos -->
          <?php
          include "../modelo/conexion.php";                      
          ?>          
          <article class="main-secciones-articulos primero container-expand-lg">
            <h2 class="display-5 mb-4 mt-4 text-center">Nueva coleccion</h2>
            <div id="carouselNuevaColeccion" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="carousel-contenedor-tarjetas d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center contenedor-tarjetas">
                      <?php
                      $query = $query = "SELECT nombre_producto, precio_producto, color, talla, descripcion, ruta_img FROM tprodu ORDER BY Ingreso_producto DESC LIMIT 5";
                      $result=$conexion->query($query);
                      while($row = $result->fetch_assoc()){
                        echo '
                        <div class="card">
                          <img src="../admin/' . $row["ruta_img"] . '" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title">' . $row["nombre_producto"] . '</h5>
                            <ul>
                              <li>Precio: <span>' . $row["precio_producto"] . '</span></li>
                              <li>Colores: <span>' . $row["color"] . '</span></li>
                              <li>Tallas: <span>' . $row["talla"] . '</span></li>
                            </ul>
                            <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                          </div>
                        </div>
                        ';
                      }                      
                      ?>
                    </div>                    
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="carousel-contenedor-tarjetas d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center contenedor-tarjetas">
                      <?php
                      $query = "SELECT nombre_producto, precio_producto, color, talla, descripcion, ruta_img FROM tprodu ORDER BY Ingreso_producto DESC LIMIT 5, 5";
                      $result=$conexion->query($query);
                      while($row = $result->fetch_assoc()){
                        echo '
                          <div class="card">
                            <img src="../admin/' . $row["ruta_img"] . '" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">' . $row["nombre_producto"] . '</h5>
                              <ul>
                                <li>Precio: <span>' . $row["precio_producto"] . '</span></li>
                                <li>Colores: <span>' . $row["color"] . '</span></li>
                                <li>Tallas: <span>' . $row["talla"] . '</span></li>
                              </ul>
                              <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                            </div>
                          </div>
                          ';                     }                      
                      ?>
                    </div>
                  </div>               
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselNuevaColeccion" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" style="background-color: rgb(117, 115, 115); border-radius: 50%;" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselNuevaColeccion" data-bs-slide="next">
                <span class="carousel-control-next-icon" style="background-color: rgb(139, 136, 136); border-radius: 50%;" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </article>
          <article class="main-secciones-articulos container-expand-lg">
            <h2 class="display-5 mb-4 text-center">Ofertas</h2>
            <div id="carouselOfertas" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="carousel-contenedor-tarjetas d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center contenedor-tarjetas">
                      <div class="card">
                        <img src="vistas/img/ropas/bolsos/222787-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/bolsos/252389-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/bolsos/257935-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/bolsos/258568-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/bolsos/258568-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/bolsos/258568-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>                    
                <div class="carousel-item">
                  <div class="carousel-contenedor-tarjetas d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center contenedor-tarjetas">
                      <div class="card">
                        <img src="vistas/img/ropas/camisas/1330260-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/camisas/1330260-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/camisas/1330260-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/camisas/1330256-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/camisas/1330256-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/camisas/1330256-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                    </div>
                  </div>               
                </div>
                <div class="carousel-item">
                  <div class="carousel-contenedor-tarjetas d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center contenedor-tarjetas">
                      <div class="card">
                        <img src="vistas/img/ropas/zapatos/236450-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/zapatos/236450-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/zapatos/236450-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/zapatos/236450-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/zapatos/236450-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/zapatos/236450-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                    </div>                    
                  </div>
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselOfertas" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" style="background-color: rgb(117, 115, 115); border-radius: 50%;" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselOfertas" data-bs-slide="next">
                <span class="carousel-control-next-icon" style="background-color: rgb(139, 136, 136); border-radius: 50%;" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </article><article class="main-secciones-articulos container-expand-lg">
            <h2 class="display-5 mb-4 text-center">Mas vendidos</h2>
            <div id="carouselMasVendidos" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="carousel-contenedor-tarjetas d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center contenedor-tarjetas">
                      <div class="card">
                        <img src="vistas/img/ropas/bolsos/222787-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/bolsos/252389-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/bolsos/257935-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/bolsos/258568-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/bolsos/258568-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/bolsos/258568-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>                    
                <div class="carousel-item">
                  <div class="carousel-contenedor-tarjetas d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center contenedor-tarjetas">
                      <div class="card">
                        <img src="vistas/img/ropas/camisas/1330260-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/camisas/1330260-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/camisas/1330260-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/camisas/1330256-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/camisas/1330256-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/camisas/1330256-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                    </div>
                  </div>               
                </div>
                <div class="carousel-item">
                  <div class="carousel-contenedor-tarjetas d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center contenedor-tarjetas">
                      <div class="card">
                        <img src="vistas/img/ropas/zapatos/236450-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/zapatos/236450-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/zapatos/236450-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/zapatos/236450-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/zapatos/236450-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <img src="vistas/img/ropas/zapatos/236450-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                    </div>                    
                  </div>
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselMasVendidos" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" style="background-color: rgb(117, 115, 115); border-radius: 50%;" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselMasVendidos" data-bs-slide="next">
                <span class="carousel-control-next-icon" style="background-color: rgb(139, 136, 136); border-radius: 50%;" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </article>
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

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> 
        
    </body>
</html>