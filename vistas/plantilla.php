<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../index.php');
}
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Clínica</title>
    <link rel="shortcut icon" href="../vistas/assets/dist/img/logomaofisioterapia.png" type="image/x-icon">

    <!-- ============================================================================================================= -->
    <!-- REQUIRED CSS -->
    <!-- ============================================================================================================= -->

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../vistas/assets/plugins/fontawesome-free/css/all.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../vistas/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- Jquery CSS -->
    <link rel="stylesheet" href="../vistas/assets/plugins/jquery-ui/css/jquery-ui.css">

    <!-- Bootstrap 5 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->


    <!-- ============================================================
    =ESTILOS PARA USO DE DATATABLES JS
    ===============================================================-->
   <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css"> -->
   <!-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"> -->
   <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css"> -->

   <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../vistas/assets/dist/css/adminlte.min.css">
      <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../vistas/assets/dist/css/plantilla.css">
    
    <!-- Multiselect -->
    <link rel="stylesheet" href="../vistas/assets/css/bootstrap-multiselect.min.css">

    <!-- ============================================================================================================= -->
    <!-- REQUIRED SCRIPTS -->
    <!-- ============================================================================================================= -->

    <!-- jQuery -->
    <script src="../vistas/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Moment.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/es.js"></script> <!-- Opcional: para localización en español -->


    <!-- Bootstrap 4 -->
    <script src="../vistas/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!-- ChartJS -->
    <script src="../vistas/assets/plugins/chart.js/Chart.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="../vistas/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

    <!-- Multiselect -->
    <script src="../vistas/assets/js/bootstrap-multiselect.min.js"></script>

    <!-- jquery UI -->
    <script src="../vistas/assets/plugins/jquery-ui/js/jquery-ui.js"></script>

    <!-- JS Bootstrap 5 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    -->
    <!-- ============================================================
    =LIBRERIAS PARA USO DE DATATABLES JS
    ===============================================================-->
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>        
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


    <!-- ============================================================
    =LIBRERIAS PARA EXPORTAR A ARCHIVOS
    ===============================================================-->
   <!--  <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script> -->
    
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.9.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
   
   
    <script src="../vistas/assets/dist/js/adminlte.min.js"></script>

         <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <!-- Opcional: FullCalendar locale para español (si lo necesitas) -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.js"></script> 
    <!-- AdminLTE App -->

</head>

<body class="hold-transition sidebar-mini">
    



<div class="wrapper">

    <!-- Doomos Logo -->
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
     <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a style="cursor: pointer;" class="nav-link active" onclick="CargarContenido('../vistas/dashboard.php','content-wrapper')">
                Tablero
                </a>
            </li>
        <!--    <li class="nav-item d-none d-sm-inline-block">
                <a style="cursor: pointer;" class="nav-link" onclick="CargarContenido('../vistas/ingresos.php','content-wrapper')">
                Ingresos
                </a> -->
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a style="cursor: pointer;" class="nav-link" onclick="CargarContenido('../vistas/maocalendario.php','content-wrapper')">
                Agenda
                </a>
            </li>
        </ul>
        <!-- </ul> -->

      <ul class="navbar-nav ml-auto">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- User Account: style can be found in dropdown.less dropdown-menu-right-->
           <li class="dropdown user user-menu dropleft ">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="../Plantilla/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                     <span class="hidden-xs"><?php echo $_SESSION['S_USER']; ?></span>
                 </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../Plantilla/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                <p>
                  <?php //echo $_SESSION['S_NOMBRE']; ?> 
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
             
              <li class="user-footer"> 
                                 
                <div class="row align-items-center">
                     <div lass="col-4"> 
                     <div class="card card-block" class="font-weight-bold">  
                  <!--  <a href="../vistas/perfilnav.php" class="btn btn-default btn-flat" id="btnperfil">Perfil</a> -->
                         <a id="bperfil" style="cursor: pointer;" class="nav-link" onclick="CargarContenido('../vistas/perfilnav.php','content-wrapper')" class="btn btn-default btn-flat">
                        Perfil 
                        </a> 
                       
                    </div>
                </div>
                    
                    <div lass="col-4">
                    <div class="card card-block"> 
                        <a href="../controladores/usuario/controlador_cerrar_session.php" class="btn btn-default btn-flat">Salir</a>
                    </div></div>
                </div>
              </li>
            </ul>
           </li>
                 <!-- Control Sidebar Toggle Button -->
             <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
             </li>
        </ul>
    </nav>
  
     
</nav>
        <?php
           // include "../vistas/modulos/navbar.php";
            include "../vistas/modulos/aside.php";
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <?php include "../vistas/dashboard.php" ?>
            
        </div>
        <!-- /.content-wrapper -->

        <?php include "../vistas/modulos/footer.php"; ?>
        

    
</div>  <!-- ./wrapper -->
<script src="../js/usuario.js"></script>
<script>
    function CargarContenido(pagina_php,contenedor){
        $("." + contenedor).load(pagina_php);
    }
</script>

</body>

</html>
