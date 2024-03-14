<!DOCTYPE html>
<html lang="en">
  <!-- Sesion iniciada -->
  <?php
  session_start();
  if (  isset ($_SESSION['user_id'])  == false){
    header("location: ../vistas/login.php");

  }else
  {
    $nombre=$_SESSION['nombre'];
  }
  
  ?>
  <!-- Llamar para la paginacion -->
   
   <?php
  include_once "db_proyecto.php";
  $conn=mysqli_connect($host,$user,$password,$db);
  require_once 'Paginar_user.php';

  // Configuración
  $users_por_pagina = 5;
  $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
  $offset = ($pagina - 1) * $users_por_pagina;

 

 
  $sql="SELECT tusuarios.*, tciudades.nombre_ciudad, tgeneros.nombre_genero
        FROM tusuarios
        INNER JOIN tciudades ON tusuarios.id_ciudad = tciudades.id_ciudad
        INNER JOIN tgeneros ON tusuarios.id_gen = tgeneros.id_genero where tusuarios.id_rol=1 ORDER BY tusuarios.id DESC";


  // Agregar LIMIT y OFFSET para la paginación
  $sql .= " LIMIT $offset, $users_por_pagina";
  $resultado = mysqli_query($conn, $sql);


    // Obtener el total de registros
    $total_registros = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tusuarios"));
    // Calcular el total de páginas
    $total_paginas = ceil($total_registros / $users_por_pagina);
    // Generar enlaces de paginación
    $enlaces_paginacion = generar_enlaces_paginacion($total_registros, $users_por_pagina, $pagina);



  
  ?>
  
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrador InsideStore</title>

  <!-- Incluye SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">


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
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
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
                <a href="Usuarios_admin.php" class="nav-link">
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
                <a href="panel.php" class="nav-link">
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
            <h1 class="m-0">Usuarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
              <li class="breadcrumb-item active">Panel de Usuarios</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container">
        <div class="text-right">
            <!-- Botón a la Derecha -->
            <!-- <a href="agrega_producto.php" class="btn btn-primary btn-circle">Agregar Producto</a> -->
        </div>
    </div>
     <!-- Barra de buscar -->
     <div class="container">
        <div class="text-center">
          <form class="form-inline mb-3">
          <input class="form-control mr-sm-2" type="search" placeholder="Buscar cedula" aria-label="Buscar" name="q">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>
      </form>
        </div>
    </div>
    


    <!-- Main content -->
    <section class="content">
    

    <br>

    <!-- Tabla de productos -->
    <div class="container">
    <h2 class="bg-ligth text-black p-2">Lista de Productos</h2>
    <table class="table table-ligth table-striped">
<!-- Apertura de php -->
        <?php
        require "db_proyecto.php";
        $conn=mysqli_connect($host,$user,$password,$db);
        $sql="SELECT tusuarios.*, tciudades.nombre_ciudad, tgeneros.nombre_genero
        FROM tusuarios
        INNER JOIN tciudades ON tusuarios.id_ciudad = tciudades.id_ciudad
        INNER JOIN tgeneros ON tusuarios.id_gen = tgeneros.id_genero where tusuarios.id_rol=1 ORDER BY tusuarios.id DESC";
        $result=mysqli_query($conn,$sql);              

        ?>

        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre y apellido</th>
                <th>Email</th>
                <th>Cedula</th>
                <th>Telefono</th>
                <th>Fecha de registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
          <!-- Trae los datos de los productos al crud -->
          <?php
          while($datos=mysqli_fetch_assoc($resultado)){
           echo "<tr>";
           echo "<td>"; echo $datos["id"];"</td>";
           echo "<td>"; echo $datos["nombre"]; echo " "; echo $datos['apellido'];"</td>";          
           echo "<td>"; echo $datos["email"];"</td>";
           echo "<td>"; echo $datos["cedula"];"</td>";
           echo "<td>"; echo $datos["Telefono"];"</td>";
           echo "<td>"; echo $datos["Fecha_registro"];"</td>";
           echo "<td>"; 
              //Botones de acciones
           echo '<button class="btn btn-primary btn-circle" data-toggle="modal" data-target="#modalProducto_' . $datos['id'] . '"><i class="fas fa-book"></i> Ver más</button>';
           echo '<button class="btn btn-danger btn-circle" onclick="eliminarusuario(' . $datos['id'] . ')"><i class="fas fa-trash"></i>Eliminar</button>';
           echo "<td>";
           echo "</tr>"; 


            echo '<div class="modal fade" id="modalProducto_' . $datos['id'] . '" tabindex="-1" role="dialog" aria-labelledby="modalProductoLabel_' . $datos['id'] . '" aria-hidden="true">';
            echo '  <div class="modal-dialog modal-lg" role="document">';
            echo '      <div class="modal-content">';
            echo '          <div class="modal-header bg-primary text-white">';
            echo '              <h5 class="modal-title" id="modalProductoLabel_' . $datos['id'] . '">Detalles del Producto</h5>';
            echo '              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">';
            echo '                  <span aria-hidden="true">&times;</span>';
            echo '              </button>';
            echo '          </div>';
            echo '          <div class="modal-body">';
            echo '              <h5 class="text-primary">' . $datos['nombre'] .' '. $datos['apellido']. '</h5>';           
            echo '              <p><strong>Email:</strong> ' . $datos['email'] . '</p>';
            echo '              <p><strong>Cedula: </strong> ' . $datos['cedula'] . '</p>';
            echo '              <p><strong>Telefono:</strong> ' . $datos['Telefono'] . '</p>';
            echo '              <p><strong>Direccion:</strong> ' . $datos['direccion'] . '</p>';
            echo '              <p><strong>Barrio:</strong> ' . $datos['nombre_barrio'] . '</p>';
            echo '              <p><strong>Ciudad: </strong> ' . $datos['nombre_ciudad'] . '</p>';
            echo '              <p><strong>Genero:</strong> ' . $datos['nombre_genero'] . '</p>';
            echo '              <p><strong>Fecha de registro: </strong> ' . $datos['Fecha_registro'] . '</p>';            
            echo '          </div>';
            echo '          <div class="modal-footer">';
            echo '              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
            echo '          </div>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';   

          }
          ?>  

            </tbody>         
         </table> 
</div>
 <!-- Mostrar enlaces de paginación -->
            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center bg-ligth">
              <!-- Botón para la página anterior -->
                <li class="page-item <?php echo ($pagina <= 1) ? 'disabled' : ''; ?>">
                  <a class="page-link" href="?pagina=<?php echo $pagina - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>

            <!-- Enlaces para cada página -->
                  <?php for ($i = 1; $i <= $total_paginas; $i++) : ?>
                  <li class="page-item <?php echo ($pagina == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                  </li>
                  <?php endfor; ?>

            <!-- Botón para la página siguiente -->
                  <li class="page-item <?php echo ($pagina >= $total_paginas) ? 'disabled' : ''; ?>">
                      <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                  </ul>
              </nav>
          













<!-- Script para Eliminar -->
<script>
    function eliminarusuario(id) {
        // Mostrar un mensaje de confirmación con SweetAlert2
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción eliminará el usuario de forma permanente.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            // Si el usuario confirma la eliminación
            if (result.isConfirmed) {
                // Envía una solicitud POST al servidor para eliminar el producto
                $.post("procesar_eliminaruser.php", {id: id}, function(data, status) {
                    // Maneja la respuesta del servidor
                    if (status === "success") {
                        // Muestra un mensaje de éxito con SweetAlert2
                        Swal.fire('Eliminado', 'El usuario ha sido eliminado exitosamente.', 'success').then((result) => {
                            // Recarga la página después de cerrar el mensaje
                            if (result.isConfirmed || result.isDismissed) {
                                window.location.reload();
                            }
                        });
                    } else {
                        // Si hay un error al eliminar el producto, muestra un mensaje de error con SweetAlert2
                        Swal.fire('Error', 'Ha ocurrido un error al eliminar el usuario.', 'error');
                    }
                });
            }
        });
    }
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

<!-- Incluye SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


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
