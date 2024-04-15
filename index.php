<?php
include_once("modelo/conexion.php");
session_start();

// Verificar si el usuario no ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Redirigir al usuario al formulario de inicio de sesión
    $botonSesion = "Iniciar sesión";
    $nombreUsuario = "Invitado";
    $botonRutaSesion = "vistas/login.php";
    $botonRutaPerfil = "vistas/login.php";
}else{
  $botonSesion = "Cerrar sesión";
  $nombreUsuario = $_SESSION['nombre'];
  $botonRutaPerfil = "vistas/perfil.php";
  $botonRutaSesion = "controlador/controlador_cerrarsesion.php";
}

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="vistas/css/index.css">
    </head>
    <body>
      <header>
        <nav class="navbar navbar-expand-lg fixed-top bg-body-tertiary">
          <div class="container-lg">
            <div class="container-logo">
              <a href="#"><p>INSIDE |</p></a>              
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
                                  <a class="dropdown-item" href="vistas/catalogo-camisas.php">Camisas</a>
                              </li>
                              <li>
                                  <a class="dropdown-item" href="vistas/catalogo-bolsos.php">Bolsos</a>
                              </li>
                              <li>
                                  <a class="dropdown-item" href="vistas/catalogo-zapatos.php">Zapatos</a>
                              </li>
                            </ul>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link nav-text ms-2" href="vistas/contacto.php">Contacto</a>
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
                              <a class="nav-link nav-text ms-3" href="vistas/carrito.php"><span class="carrito-de-compra-nav"></span></a>
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
            </div>
          </div>
        </nav>
      </header>
      <main>
        <section class="container-expand-lg">     
          <article class="container-expand-lg d-flex m-0 p-0 articulo-principal">
            <div class="contenedor-mensaje-principal">
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
          <article class="main-secciones-articulos primero container-expand-lg">
            <h2 class="display-5 mb-4 mt-4 text-center texto-categoria">Nueva coleccion</h2>
            <div id="carouselNuevaColeccion" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="carousel-contenedor-tarjetas d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center contenedor-tarjetas">
                      <?php
                      $query = "SELECT id_producto, nombre_producto, precio_producto,
                        color, talla, descripcion, ruta_img
                        FROM tprodu WHERE oferta=0 ORDER BY Ingreso_producto DESC LIMIT 5";
                      $result=$conexion->query($query);
                      while($row = $result->fetch_assoc()){
                        echo "
                        <div class='card'>
                          <div class='card-icon-container'>
                          <img src='./vistas/img/iconos/new.png' class='card-icon-top' alt='...'>
                          </div>
                          <img src='./admin/{$row["ruta_img"]}' class='card-img-top'>
                          <div class='card-body'>
                            <h5 class='card-title'>{$row["nombre_producto"]}</h5>
                            <ul>
                              <li>Precio: $<span> {$row["precio_producto"]}</span></li>
                              <li>Colores: <span>{$row["color"]}</span></li>
                              <li>Tallas: <span>{$row["talla"]}</span></li>
                            </ul>
                            <a class='btn btn-primary btn-carrito' onclick='addCarrito(". json_encode($row) .")'>
                              <p class='m-0 p-0'> Comprar <span class='carrito-de-compra'></span></p>
                            </a>
                          </div>
                        </div>
                        ";
                      }
                      ?>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="carousel-contenedor-tarjetas d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center contenedor-tarjetas">
                      <?php
                      $query = "SELECT id_producto,nombre_producto, precio_producto, color, talla, descripcion, ruta_img FROM tprodu WHERE oferta=0 ORDER BY Ingreso_producto DESC LIMIT 5, 5";
                      $result=$conexion->query($query);
                      while($row = $result->fetch_assoc()){
                        echo "
                        <div class='card'>
                          <div class='card-icon-container'>
                          <img src='./vistas/img/iconos/new.png' class='card-icon-top' alt='...'>
                          </div>
                          <img src='./admin/{$row["ruta_img"]}' class='card-img-top'>
                          <div class='card-body'>
                            <h5 class='card-title'>{$row["nombre_producto"]}</h5>
                            <ul>
                              <li>Precio: $<span> {$row["precio_producto"]}</span></li>
                              <li>Colores: <span>{$row["color"]}</span></li>
                              <li>Tallas: <span>{$row["talla"]}</span></li>
                            </ul>
                            <a class='btn btn-primary btn-carrito' onclick='addCarrito(". json_encode($row) .")'>
                              <p class='m-0 p-0'> Comprar <span class='carrito-de-compra'></span></p>
                            </a>
                          </div>
                        </div>
                        ";
                      }
                      ?>
                    </div>
                  </div>               
                </div>
              </div>
              <button class="carousel-control-prev carousel-prev-icon" type="button" data-bs-target="#carouselNuevaColeccion" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next carousel-next-icon" type="button" data-bs-target="#carouselNuevaColeccion" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </article>
          <article class="main-secciones-articulos container-expand-lg">
            <h2 class="display-5 mb-4 text-center texto-categoria">Ofertas</h2>
            <div id="carouselOfertas" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="carousel-contenedor-tarjetas d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center contenedor-tarjetas">
                      <!-- Apertura php -->
                      <?php 
                       $query = "SELECT id_producto,nombre_producto, precio_producto, color, talla, descripcion, ruta_img,descuento FROM tprodu WHERE oferta=1 LIMIT 5";
                       $result=$conexion->query($query);
                       while($row = $result->fetch_assoc()){   
                        $preciocondescuento=$row["precio_producto"]-($row["precio_producto"]*$row["descuento"]);                                         
                      ?>
                      <div class="card">
                        <div class="icon-card-oferta-container">
                          <p class="icon-card-oferta-container__descuento"><?php echo $row['descuento']*100; echo "%" ?></p> 
                          <img src="./vistas/img/iconos/oferta-fuego.png" class="icon-card-oferta-container__icon-descuento" alt="">                                    
                        </div>                          
                        <img src="admin/<?php echo $row['ruta_img'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $row['nombre_producto'] ?></h5>
                          <ul>
                            <li>Precio anterior: $<del><span style="color:red"><?php echo number_format($row['precio_producto'] ,2, '.' , ',') ?></span></del></li>
                            <li>Precio con descuento: $<span style="color:green"><?php echo number_format($preciocondescuento ,2, '.' , ',') ?></span></li>
                            <li>Color: <span><?php echo $row['color'] ?></span></li>
                            <li>Talla: <span><?php echo $row['talla'] ?></span></li>
                          </ul>
                          <a class='btn btn-primary btn-carrito' onclick='addCarrito(<?php echo htmlspecialchars(json_encode($row)); ?>)'>
                          <p class='m-0 p-0'>Comprar <span class='carrito-de-compra'></span></p>
                         </a>

                        </div>
                      </div>
                      <?php }
                      ?>                      
                    </div>
                  </div>
                </div>                    
                <div class="carousel-item">
                  <div class="carousel-contenedor-tarjetas d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center contenedor-tarjetas">
                        <!-- Apertura php -->
                      <?php 
                       $query = "SELECT id_producto,nombre_producto, precio_producto, color, talla, descripcion, ruta_img,descuento FROM tprodu WHERE oferta=1 LIMIT 5, 5";
                       $result=$conexion->query($query);
                       while($row = $result->fetch_assoc()){   
                        $preciocondescuento=$row["precio_producto"]-($row["precio_producto"]*$row["descuento"]);                                         
                      ?>
                      <div class="card">
                        <div class="icon-card-oferta-container">
                          <p class="icon-card-oferta-container__descuento"><?php echo $row['descuento']*100; echo "%" ?></p> 
                          <img src="./vistas/img/iconos/oferta-fuego.png" class="icon-card-oferta-container__icon-descuento" alt="">                                    
                        </div>                          
                        <img src="admin/<?php echo $row['ruta_img'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $row['nombre_producto'] ?></h5>
                          <ul>
                            <li>Precio anterior: $<del><span style="color:red"><?php echo number_format($row['precio_producto'] ,2, '.' , ',') ?></span></del></li>
                            <li>Precio con descuento: $<span style="color:green"><?php echo number_format($preciocondescuento ,2, '.' , ',') ?></span></li>
                            <li>Color: <span><?php echo $row['color'] ?></span></li>
                            <li>Talla: <span><?php echo $row['talla'] ?></span></li>
                          </ul>
                          <a class='btn btn-primary btn-carrito' onclick='addCarrito(<?php echo htmlspecialchars(json_encode($row)); ?>)'>
                          <p class='m-0 p-0'>Comprar <span class='carrito-de-compra'></span></p>
                         </a>

                        </div>
                      </div>
                      <?php }
                      ?>                     
                  </div>
                  </div>               
                </div>
              </div>
              <button class="carousel-control-prev carousel-prev-icon" type="button" data-bs-target="#carouselOfertas" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next carousel-next-icon" type="button" data-bs-target="#carouselOfertas" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </article>
          <article class="main-secciones-articulos container-expand-lg">
            <h2 class="display-5 mb-4 text-center texto-categoria">Mas vendidos</h2>
            <div id="carouselMasVendidos" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="carousel-contenedor-tarjetas d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center contenedor-tarjetas">
                      <div class="card">
                        <div class="icon-card-best-seller-container">
                          <img src="./vistas/img/iconos/best-sellers.png" alt="">                                            
                        </div>                          
                        <img src="vistas/img/ropas/camisas/883044495_2.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa manga larga de algodon basement</h5>
                          <ul>
                            <li>Precio: $<span>99.000</span></li>
                            <li>Colores: <span>Blanca</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary btn-carrito"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <div class="icon-card-best-seller-container">
                          <img src="./vistas/img/iconos/best-sellers.png" alt="">                                            
                        </div>                          
                        <img src="vistas/img/ropas/zapatos/royal-county-of-berkshire-polo-club-2307-1870532-1-catalog-new.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Tenis Royal County</h5>
                          <ul>
                            <li>Precio: $<span>90.000</span></li>
                            <li>Colores: <span>Blancos con negro</span></li>
                            <li>Tallas: <span>32, 34 y 38</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary btn-carrito"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <div class="icon-card-best-seller-container">
                          <img src="./vistas/img/iconos/best-sellers.png" alt="">                                            
                        </div>                          
                        <img src="vistas/img/ropas/camisas/mp-7260-3957242-1-catalog-new.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Blusa mujer estampado rayas</h5>
                          <ul>
                            <li>Precio: $<span>37.800</span></li>
                            <li>Colores: <span>Blanca rayas azules</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary btn-carrito"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <div class="icon-card-best-seller-container">
                          <img src="./vistas/img/iconos/best-sellers.png" alt="">                                            
                        </div>                          
                        <img src="vistas/img/ropas/bolsos/81+5lu7KG3L._AC_UL320_.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Bolso Wide Puser Strap</h5>
                          <ul>
                            <li>Precio: $<span>120.000</span></li>
                            <li>Colores: <span>Papayawhite</span></li>
                            <li>Tallas: <span>N/A</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary btn-carrito"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <div class="icon-card-best-seller-container">
                          <img src="./vistas/img/iconos/best-sellers.png" alt="">                                            
                        </div>                          
                        <img src="vistas/img/ropas/camisas/1330256-500-auto.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa formal para mujer</h5>
                          <ul>
                            <li>Precio: $<span>100.000</span></li>
                            <li>Colores: <span>Rosado</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary btn-carrito"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>                    
                <div class="carousel-item">
                  <div class="carousel-contenedor-tarjetas d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center contenedor-tarjetas">
                    <div class="card">
                        <div class="icon-card-best-seller-container">
                          <img src="./vistas/img/iconos/best-sellers.png" alt="">                                            
                        </div>                          
                        <img src="vistas/img/ropas/bolsos/81QLXos6FfS._AC_UL320_.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Bolso Italian Core</h5>
                          <ul>
                            <li>Precio: $<span>250.000</span></li>
                            <li>Colores: <span>Negro</span></li>
                            <li>Tallas: <span>N/A</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary btn-carrito"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div> 
                      <div class="card">
                        <div class="icon-card-best-seller-container">
                          <img src="./vistas/img/iconos/best-sellers.png" alt="">                                            
                        </div>                          
                        <img src="vistas/img/ropas/camisas/D_NQ_NP_757216-CBT71992570467_092023-O.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Blusa Teen Caribe</h5>
                          <ul>
                            <li>Precio: $<span>42.000</span></li>
                            <li>Colores: <span>Verde</span></li>
                            <li>Tallas: <span>L, M</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary btn-carrito"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div> 
                      <div class="card">
                        <div class="icon-card-best-seller-container">
                          <img src="./vistas/img/iconos/best-sellers.png" alt="">                                            
                        </div>                          
                        <img src="vistas/img/ropas/camisas/D_NQ_NP_812050-CBT75416128585_032024-O.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa Flores de Otoño</h5>
                          <ul>
                            <li>Precio: $<span>67.000</span></li>
                            <li>Colores: <span>Multicolor</span></li>
                            <li>Tallas: <span>L, M, X</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary btn-carrito"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <div class="icon-card-best-seller-container">
                          <img src="./vistas/img/iconos/best-sellers.png" alt="">                                            
                        </div>                          
                        <img src="vistas/img/ropas/zapatos/51x9XOsQoWL._AC_UL320_.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Tacone Madrid Elegance</h5>
                          <ul>
                            <li>Precio: $<span>250.000</span></li>
                            <li>Colores: <span>Blanco</span></li>
                            <li>Tallas: <span>32, 34 y 38</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary btn-carrito"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <div class="icon-card-best-seller-container">
                          <img src="./vistas/img/iconos/best-sellers.png" alt="">                                            
                        </div>                          
                        <img src="vistas/img/ropas/bolsos/81zBeDVUilL._AC_UL320_.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Bolso Raelra Beer</h5>
                          <ul>
                            <li>Precio: $<span>150.000</span></li>
                            <li>Colores: <span>Rosado con rojo</span></li>
                            <li>Tallas: <span>N/A</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary btn-carrito"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                    </div>
                  </div>               
                </div>
                <div class="carousel-item">
                  <div class="carousel-contenedor-tarjetas d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center contenedor-tarjetas">
                    <div class="card">
                        <div class="icon-card-best-seller-container">
                          <img src="./vistas/img/iconos/best-sellers.png" alt="">                                            
                        </div>                          
                        <img src="vistas/img/ropas/camisas/D_NQ_NP_836300-MCO31046763863_062019-O.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Camisa Jean Alast</h5>
                          <ul>
                            <li>Precio: $<span>59.000</span></li>
                            <li>Colores: <span>Azul</span></li>
                            <li>Tallas: <span>L, M, XL</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary btn-carrito"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <div class="icon-card-best-seller-container">
                          <img src="./vistas/img/iconos/best-sellers.png" alt="">                                            
                        </div>                          
                        <img src="vistas/img/ropas/zapatos/613hdqI4VzL._AC_SX575_.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Tacones Pasión Suiza</h5>
                          <ul>
                            <li>Precio: $<span>180.000</span></li>
                            <li>Colores: <span>Rojo</span></li>
                            <li>Tallas: <span>34, 36 y 38</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary btn-carrito"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <div class="icon-card-best-seller-container">
                          <img src="./vistas/img/iconos/best-sellers.png" alt="">                                            
                        </div>                          
                        <img src="vistas/img/ropas/bolsos/91ArNQ2pEiL._AC_UL320_.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Bolso Prestige Veer</h5>
                          <ul>
                            <li>Precio: $<span>200.000</span></li>
                            <li>Colores: <span>Morado con negro</span></li>
                            <li>Tallas: <span>N/A</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary btn-carrito"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <div class="icon-card-best-seller-container">
                          <img src="./vistas/img/iconos/best-sellers.png" alt="">                                            
                        </div>                          
                        <img src="vistas/img/ropas/bolsos/816bTnX4ThS._AC_UL320_.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Bolso Marfex Tin</h5>
                          <ul>
                            <li>Precio: $<span>130.000</span></li>
                            <li>Colores: <span>Negro</span></li>
                            <li>Tallas: <span>N/A</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary btn-carrito"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                      <div class="card">
                        <div class="icon-card-best-seller-container">
                          <img src="./vistas/img/iconos/best-sellers.png" alt="">                                            
                        </div>                          
                        <img src="vistas/img/ropas/zapatos/61rrfOUmSYL._AC_SY575_.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Tacones Pullys Vost</h5>
                          <ul>
                            <li>Precio: $<span>170.000</span></li>
                            <li>Colores: <span>Negro</span></li>
                            <li>Tallas: <span>34, 36 y 38</span></li>
                          </ul>
                          <a href="#" class="btn btn-primary btn-carrito"><p class="m-0 p-0">Comprar <span class="carrito-de-compra"></span></p></a>
                        </div>
                      </div>
                    </div>                    
                  </div>
                </div>
              </div>
              <button class="carousel-control-prev carousel-prev-icon" type="button" data-bs-target="#carouselMasVendidos" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next carousel-next-icon" type="button" data-bs-target="#carouselMasVendidos" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </article>
          <article class="container-expand-lg mt-5">
            <h2 class="display-5 mb-3 ms-4 text-center texto-categoria">Noticias</h2>
            <div class="grid-container">
              <div>
                <video src="vistas/movies/movie-banner-1.mp4" autoplay loop muted></video>
                <a href="vistas/catalogo-camisas.php"><button>¡Ver catalogo!</button></a>                
              </div>
              <div>
                <video src="vistas/movies/movie-banner-2.mp4" autoplay loop muted></video>
                <a href="vistas/catalogo-bolsos.php"><button>¡Ver catalogo!</button></a>
              </div>
              <div>
                <img src="vistas/img/ropas/banners/anchos/banner-grand-opening.jpg" alt="">
              </div>
              <div>
                <img src="vistas/img/iconos/qr-turno002.jpg" alt="">
                <div>
                  <p>Escanea el QR y obten atencion personalizada para tus compras.</p>
                </div>
              </div>
              <div>
                <img src="vistas/img/ropas/banners/anchos/banner-mujer.jpg" alt="">
              </div>
              <div>
                <h5>Medios de pago aceptados</h5>
                <div class="container-payments mt-3">
                  <div>
                    <img src="vistas/img/iconos/payment.png" alt="">
                    <p>Pago contra entrega</p>
                  </div>
                  <div>
                    <img src="vistas/img/iconos/credit-card (1).png" alt="">
                    <p>Pago con tarjeta</p>
                  </div>
                </div>                
              </div>
              <div>
                <img src="vistas/img/ropas/banners/cuadrados-alargados/gran-oferta.jpg" alt="">
              </div>
            </div>
          </article>
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
                        <p><a href="vistas/contacto.php" class="footer-link">Escribenos</a></p>
                        <p><a href="vistas/equipo-de-desarrollo.php" class="footer-link">Conoce nuestro equipo de desarrollo</a></p>                       
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
      <script src="vistas/js/carrito.js"></script>
    </body>
</html>