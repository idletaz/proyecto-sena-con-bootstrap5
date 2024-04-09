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
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrador InsideStore</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
        <a href="pqrs_admin.php" class="nav-link">PQRS</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
      <button class="btn btn-danger">
      <a href="../controlador/controlador_cerrarsesion.php">
        <i class="fas fa-power-off"></i> Cerrar Sesión
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
    <a href="panel.php" class="brand-link">
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
              <a href="ofertas_admin.php" class="nav-link">
                  <i class="fas fa-tag nav-icon"></i>
                  <p>Ofertas activas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="ventas_admin.php" class="nav-link">
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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="panel.php">Home</a></li>
              <li class="breadcrumb-item active">Panel de administrador</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <?php
                include_once "db_proyecto.php";
                $conn=mysqli_connect($host,$user,$password,$db);
                $sql = "SELECT total_venta FROM tventas";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {                    
                    $total_ventas = 0;                    
                    while($row = $result->fetch_assoc()) {                        
                        $total_ventas += $row["total_venta"];
                    }
                    $total_ventas_formateado = number_format($total_ventas, 2, ',', '.');
                    
                    echo "<h3>" . $total_ventas_formateado . "</h3>";
                    echo "<p>Ventas totales</p>";
                } else {
                    echo "No se encontraron ventas registradas";
                }

                // Cerrar conexión
                $conn->close();               
                ?>
              </div>
              <div class="icon">
                <i class="ion ion-ios-cart"></i>
              </div>
              <a href="ventas_admin.php" class="small-box-footer">Ver más  <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <!-- Mostrar Usuarios registrados en la pagina -->
                <?php
                include_once "db_proyecto.php";
                $conn=mysqli_connect($host,$user,$password,$db);
                $sql = "SELECT COUNT(*) as total_usuarios FROM tusuarios";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {                    
                    $row = $result->fetch_assoc();
                    echo "<h3>" . $row["total_usuarios"] . "</h3>";
                    echo "<p>Usuarios registrados</p>";
                } else {
                    echo "No se encontraron usuarios registrados";
                }

                // Cerrar conexión
                $conn->close();               
                ?>
                
                <!-- <h3>44</h3>

                <p>Usuarios registrados</p> -->
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="Usuarios_admin.php" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- Apertura de php -->
        <?php
        require "db_proyecto.php";
        $conn=mysqli_connect($host,$user,$password,$db);
        $sql = "SELECT 
            CASE WEEKDAY(fecha_venta)
                WHEN 0 THEN 'Lunes'
                WHEN 1 THEN 'Martes'
                WHEN 2 THEN 'Miércoles'
                WHEN 3 THEN 'Jueves'
                WHEN 4 THEN 'Viernes'
                WHEN 5 THEN 'Sábado'
                WHEN 6 THEN 'Domingo'
            END AS dia_semana, 
            SUM(total_venta) AS total 
        FROM tventas 
        GROUP BY dia_semana";
        $resultado = mysqli_query($conn, $sql);

        
        $datosVentas = array();
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $dia_semana = $fila['dia_semana'];
            $total = (float)$fila['total'];
            $datosVentas[$dia_semana] = $total;
        }

        
        mysqli_close($conn);
                

        ?>
          <div class="col-lg-8 col-6">
          <div class="container mt-4">
          <h2 class="text-center">Ventas por Dia</h2>
          <div id="graficoVentas" style="height: 400px"></div>
          </div>

          </div>

          <!-- Script de ventas diarias -->
          <script>
        
        var datosVentas = <?php echo json_encode($datosVentas); ?>;

        
        google.charts.load('current', { packages: ['corechart', 'bar'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Dia de la semana');
            data.addColumn('number', 'Ventas');

            
            var filas = Object.keys(datosVentas).map(function(dia) {
                return [dia, datosVentas[dia]];
            });

            data.addRows(filas);

            var options = {
            title: 'Ventas por Día de la Semana',
            legend: { position: 'none' },
            backgroundColor: '#f9f9f9',
            chartArea: { width: '70%', height: '70%' },
            hAxis: {
                title: 'Día de la Semana',
                titleTextStyle: { fontSize: 16, bold: true },
                textStyle: { fontSize: 12 }
            },
            vAxis: {
                title: 'Ventas',
                titleTextStyle: { fontSize: 16, bold: true },
                minValue: 0,
                format: 'decimal',
                textStyle: { fontSize: 12 }
            },
            colors: ['#3366cc']
        };

            var chart = new google.visualization.BarChart(document.getElementById('graficoVentas'));
            chart.draw(data, options);
        }

    </script>
          <!-- ./col -->
          
          <!-- ./col -->
        </div>
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
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
