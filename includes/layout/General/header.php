<?php 

//include de conexion
require_once 'includes/db.php';
require_once 'includes/sucursalFunciones.php';
require_once 'includes/rutasFunciones.php';
require_once 'includes/detalle_rutas_sucursalFunciones.php';
require_once 'includes/usuarioFunciones.php';
require_once 'includes/unidadesFunciones.php';
require_once 'includes/helpers.php';
require_once 'includes/parametros.php';
require_once 'includes/talleresFunciones.php';



//instancias 
$functiones = new sucursalFunciones();
$funcionesRuta = new rutasFunciones();
$funcionesDetalle = new detalle_rutas_sucursalFunciones();
$funcionUsuarios = new usuarioFunciones();
$funcionesUnidades = new unidadesFunciones();
$funcionesTalleres = new talleresFunciones();




?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo Empresa ?></title>
  <!--Estilos Propios-->
   <!---Mios-->
  <link rel="stylesheet" type="text/css" href="<?=url?>assent/css/estiloTablas.css">
  <link rel="stylesheet" type="text/css" href="<?=url?>assent/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?=url?>assent/css/datatables.min.css">
  <script type="text/javascript" src="<?=url?>assent/js/datatables.min.js"></script>
  <script type="text/javascript" src="<?=url?>assent/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="<?=url?>assent/js/select2.js"></script>
  <link rel="stylesheet" type="text/css" href="<?=url?>assent/css/select2.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <!---Mios-->
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- DataTables -->
	<link rel="stylesheet" href="<?=url?>assent/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=url?>assent/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?=url?>assent/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?=url?>assent/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?=url?>assent/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?=url?>assent/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?=url?>assent/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?=url?>assent/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?=url?>assent/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=url?>assent/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">	
  <!-- DataTables -->
  <script src="<?=url?>assent/plugins/datatables/jquery.dataTables.js"></script>
  <script src="<?=url?>assent/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <!--JQuery--->

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
 
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

  <style type="text/css">
    #loadpage{
      display: block;
      background:red;
      width: 100%;
      height: 100%;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1000;
      color: white;
    }
    #loadpage p{
      display: block;
      width: 100px;
      height: 30px;
      font-size: 30px;
      position: absolute;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      margin: auto;
    }
.loader {
    position: fixed;
    z-index: 99;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: white;
    display: flex;
    justify-content: center;
    align-items: center;
}

.loader > img {
    width: 100px;
}

.loader.hidden {
    animation: fadeOut 1s;
    animation-fill-mode: forwards;
}

@keyframes fadeOut {
    100% {
        opacity: 0;
        visibility: hidden;
    }
}
  </style>
  
<script type="text/javascript">
  window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});
</script>

</head>
<body class="hold-transition layout-top-nav" id="">

<div class="loader">
  <img src="assent/img/25.gif" alt="Loading...">
</div>

<div class="wrapper">

 <!-- Navbar  fixed-top propiedad para inmobilizar navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark ">
    <div class="container">
      <a href="inicio.php" class="navbar-brand">
        <img src="<?=url?>assent/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"><?= Empresa ?></span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Reportes</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <!-- Level two dropdown-->
              <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Mantenimiento</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                  <li>
                    <a tabindex="-1" href="unidades.php" class="dropdown-item">Relacion de Unidad</a>
                  </li>         
                  <!-- End Level three -->
                   <li><a href="disponibilidad.php" class="dropdown-item">Disponibilidad</a></li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>	

      </div>
    </div>
    <ul class="navbar-nav">
       <i><a id="dropdownSubMenu1" href="cerrar_sesion.php" aria-haspopup="true" aria-expanded="false" class="nav-link ml-auto"><span class="fas fa-user "> Cerrar Sesion</span></a></i>
    </ul>
   
  </nav>


<div class="content-wrapper" style="height: 100%">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Bienvenido <small><?php echo $_SESSION['user']['usuario'] ?></small></h1>
            <p><?php echo $_SESSION['user']['correoElectronico']; ?></p>
            <small><?php echo "Nombre Usuario : " . $_SESSION['usuario']['usuario']; ?></small><br>
            <small><?php echo "Sucursal : " . $_SESSION['usuario']['nombreSucursal']; ?></small><br>
            <small><?php echo "Tipo de Cuenta : " . $_SESSION['usuario']['nombreCategoria']; ?></small>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
<!-- /.col-md-6 -->
             <div class="col-lg-24">
            <div class="card card-primary card-outline">





             