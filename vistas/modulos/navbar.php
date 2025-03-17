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
        <li class="nav-item d-none d-sm-inline-block">
        <a style="cursor: pointer;" class="nav-link" onclick="">
                Ingresos
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
        <a style="cursor: pointer;" class="nav-link" onclick="CargarContenido('../vistas/gastos.php','content-wrapper')">
                Gastos
            </a>
        </li>
        </ul>
    </ul>

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
                  <?php echo $_SESSION['S_NOMBRE']; ?> 
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">                
                <div class="pull-left">
                <a href="#" onclick="CargarContenido('../vistas/ingresos.php')">"btn btn-default btn-flat">Salir</a>
                Perfil
            </a>       
                </div>
              </li>
              <li class="user-footer">                
                <div class="pull-right">
                  <a href="../controladores/usuario/controlador_cerrar_session.php" class="btn btn-default btn-flat">Salirpn</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
   
     
</nav>
