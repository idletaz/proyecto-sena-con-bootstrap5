<!DOCTYPE html>
<html lang="en">
  <?php
  session_start();
  if (  isset ($_SESSION['user_id'])  == false){
    header("location: ../vistas/login.php");

  }else
  {
    $nombre=$_SESSION['nombre'];
  }
  
  ?>
  <!-- Consulta para traer los datos del producto -->
  <?php
  $consulta= Consultarproducto($_GET["id_producto"]);

  function Consultarproducto($id_produc){
    include 'db_proyecto.php';
    $conn=mysqli_connect($host,$user,$password,$db);
    $query="SELECT id_producto, nombre_producto, precio_producto, cantidad, color, descripcion, estado, talla, categoria, ruta_img FROM tprodu where id_producto='$id_produc' ;";
    $result=$conn->query($query);
    $datos=$result->fetch_assoc();

    return [
        $datos["id_producto"],
        $datos["nombre_producto"],
        $datos["precio_producto"],
        $datos["cantidad"],
        $datos["talla"],
        $datos["color"],
        $datos["categoria"],
        $datos["descripcion"],
        $datos["estado"]

    
    ];



  }


  

  
  ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrador InsideStore</title>

  <!--Script de Sweet alert  -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="Logo.png" alt="Logo" height="100" width=100">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="panel.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">PQRS</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
      <button class="btn btn-danger">
      <a href="../controlador/controlador_cerrarsesion.php">
        <i class="fas fa-power-off">Cerrar Sesión</i> 
      </a>
    </button>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="Logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">InsideStore</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="Logo.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $nombre ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Ver más
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="CrudProductos.php" class="nav-link">
                  <i class="fas fa-shopping-bag nav-icon"></i>
                  <p>Productos</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="ofertas_admin.php" class="nav-link">
                  <i class="fas fa-tag nav-icon"></i>
                  <p>Ofertas activas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.html" class="nav-link">
                  <i class="fas fa-chart-bar nav-icon"></i>
                  <p>Ventas</p>
                </a>
              </li>
             
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Seccion/Modificar Producto</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="CrudProductos.php">Productos</a></li>
              <li class="breadcrumb-item active">Panel de Productos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="container">
        <h1 class="mt-5">Modificar Producto</h1>
        <?php
        include 'db_proyecto.php';
        include 'Procesar_modproducto.php';
        ?>
        

        <!-- Formulario para agregar un nuevo producto -->
        <form id="formModificarProducto" action="" method="post" enctype="multipart/form-data">
            <div class="form-group d-flex flex-column">
                <label for="id_producto">ID producto:</label>
                <input type="hidden" id="id_producto" name="id_producto" value="<?php echo $consulta[0]?>">
                <span style="font-size: 24px;"><?php echo $consulta[0]?></span>
                <!-- <span style="font-size: 24px;" id="id_producto" name="id_producto" ><?php echo $consulta[0]?></span> -->
                <!-- <input type="text" id="id_producto" name="id_producto" class="form-control"> -->
            </div>

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $consulta[1]?>">
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" class="form-control" value="<?php echo $consulta[2]?>">
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" class="form-control" value="<?php echo $consulta[3]?>">
            </div>

            <div class="form-group">
              <label for="categoria">Categoria:</label>
                <select id="categoria" name="categoria" class="form-control" onchange="mostrarTallas()">
                   <option value="Ropa"<?php if ($consulta[6] == 'Ropa') echo ' selected="selected"'; ?>>Ropa</option>
                   <option value="Zapato"<?php if ($consulta[6] == 'Zapato') echo ' selected="selected"'; ?>>Zapato</option>
                    <option value="Bolso"<?php if ($consulta[6] == 'Bolso') echo ' selected="selected"'; ?>>Bolso</option>
                </select>
            </div>

            <div class="form-group" id="tallaFormulario">
             <label for="talla">Talla:</label>
                <select id="talla" name="talla" class="form-control">
                <?php
                  $tallas = array(
                      "Selecciona", "XS", "S", "M", "L", "XL", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44"
                  );

                  foreach ($tallas as $talla) {
                      echo '<option value="' . $talla . '"';
                      if ($consulta[4] == $talla) {
                          echo ' selected="selected"';
                      }
                      echo '>' . $talla . '</option>';
                  }
                  ?>
                </select>
            </div>

            <div class="form-group">
             <label for="color">Color:</label>
                <select id="color" name="color" class="form-control">
                <?php
                  $colores = array(
                      "Rojo", "Azul", "Verde", "Negro", "Blanco", "Gris", "Amarillo", "Rosado", "Morado", "Naranja",
                      "Café", "Beige", "Celeste", "Turquesa", "Marrón", "Crema", "Lila", "Violeta", "Coral", "Plateado",
                      "Dorado", "Bronce", "Púrpura", "Índigo", "Ocre", "Verde oliva", "Cian", "Carmesí", "Granate", 
                      "Turmalina", "Rubí", "Esmeralda", "Topacio", "Zafiro", "Amatista", "Perla", "Ámbar"
                  );

                  foreach ($colores as $color) {
                      echo '<option value="' . $color . '"';
                      if ($consulta[5] == $color) {
                          echo ' selected="selected"';
                      }
                      echo '>' . $color . '</option>';
                  }
                  ?>
               </select>
            </div>
            

            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" class="form-control-file" required>
            </div>

            <div class="form-group">
                <label for="detalle">Descripcion:</label>
                <input type="textarea" id="detalle" name="detalle" class="form-control" value="<?php echo $consulta[7]?>">
            </div>

            <div class="form-group">
              <label for="estado">Estado:</label>
                <select id="estado" name="estado" class="form-control">
                    <option value="activo"<?php if ($consulta[8] == 'activo') echo ' selected="selected"'; ?>>Activo</option>
                    <option value="no-activo"<?php if ($consulta[8] == 'no-activo') echo ' selected="selected"'; ?>>No Activo</option>                   
                </select>
            </div>

            <button type="submit" name="Guardar" id="Guardar" class="btn btn-primary" onclick="return confirmarGuardado();" >Guardar</button>
        </form>
    </div>
    <!-- Script de Verificacion para el guardar cambios -->
    <script>
    function confirmarGuardado() {
        return confirm("¿Estás seguro de que deseas guardar los cambios?");
    }
    </script>
    <script>
    function mostrarTallas() {
        var categoriaSeleccionada = document.getElementById("categoria").value;
        var tallaFormulario = document.getElementById("tallaFormulario");

        // Borra las opciones actuales
        tallaFormulario.innerHTML = '';

        // Añade las nuevas opciones según la categoría seleccionada
        if (categoriaSeleccionada === 'Zapato') {
            // Agrega las opciones de tallas de zapatos
            var selectTalla = document.createElement("select");
            selectTalla.id = "talla";
            selectTalla.name = "talla";
            selectTalla.className = "form-control";
            selectTalla.innerHTML += '<option value="">Selecciona</option>';
            selectTalla.innerHTML += '<option value="36">36</option>';
            selectTalla.innerHTML += '<option value="37">37</option>';
            selectTalla.innerHTML += '<option value="38">38</option>';
            selectTalla.innerHTML += '<option value="39">39</option>';
            selectTalla.innerHTML += '<option value="40">40</option>';
            tallaFormulario.appendChild(selectTalla);
        } else if (categoriaSeleccionada === 'Bolso') {
            // No se necesita mostrar la opción de talla para bolsos, así que puedes dejar el contenedor vacío
        } else {
            // Opciones de tallas para otras categorías
            var selectTalla = document.createElement("select");
            selectTalla.id = "talla";
            selectTalla.name = "talla";
            selectTalla.className = "form-control";
            selectTalla.innerHTML += '<option value="">Selecciona</option>';
            selectTalla.innerHTML += '<option value="XS">XS</option>';
            selectTalla.innerHTML += '<option value="S">S</option>';
            selectTalla.innerHTML += '<option value="M">M</option>';
            selectTalla.innerHTML += '<option value="L">L</option>';
            selectTalla.innerHTML += '<option value="XL">XL</option>';
            tallaFormulario.appendChild(selectTalla);
        }
    }

    // Llamar a la función al cargar la página para establecer el estado inicial
    //mostrarTallas();
</script>

   

     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024-2031 <a href="panel.php">Inside Store</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
