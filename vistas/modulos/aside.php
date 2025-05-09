<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="index.html" class="brand-link">
        <img src="../vistas/assets/dist/img/logomaofisioterapia.png" alt="Clínica logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">

        <span class="brand-text font-weight-light ">Clínica</span>
    </a>
    <!-- font-weight-light -->
    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a style="cursor: pointer;" class="nav-link active" id="mdashboard"
                        onclick="CargarContenido('../vistas/dashboard.php','content-wrapper')">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            <?php
                            if ($_SESSION['S_ROL'] == 1) {
                                echo 'Administración';
                            } else
                                $_SESSION['S_CLINICA'];
                            ?>

                        </p>
                    </a>
                </li>
                <!--Datos Generales -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Datos Generales
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" id="mrepresentantes"
                                onclick="CargarContenido('../vistas/representantes.php','content-wrapper')">
                                <i class="fa fa-id-card" aria-hidden="true"></i>&nbsp;&nbsp;
                                <p>Representantes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" id="mpacientes"
                                onclick="CargarContenido('../vistas/pacientes.php','content-wrapper')">
                                <i class="fa fa-user-secret" aria-hidden="true"></i>&nbsp;&nbsp;
                                <p>Pacientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" id="mexpedientes"
                                onclick="CargarContenido('../vistas/expedientes.php','content-wrapper')">
                                <i class="fa fa-folder-open" aria-hidden="true"></i>&nbsp;
                                <p>Expedientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" id="mservicios"
                                onclick="CargarContenido('../vistas/mao.servicios.php','content-wrapper')">
                                <i class="fa fa-folder-open" aria-hidden="true"></i>&nbsp;
                                <p>Servicios</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" id="mnespecialistas"
                                onclick="CargarContenido('../vistas/mao.especialistas.php','content-wrapper')">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;&nbsp;
                                <p>Especialistas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" id="mestadoscitas"
                                onclick="CargarContenido('../vistas/mao.estados_citas.php','content-wrapper')">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;&nbsp;
                                <p>Estados Citas</p>
                            </a>
                        </li>

                        <!-- <li class="nav-item">
                         <a style="cursor: pointer;" class="nav-link" id="mexpedientes" onclick="CargarContenido('../vistas/servicios_medicos.php','content-wrapper')">
                                 <i class="fa fa-folder-open" aria-hidden="true"></i>&nbsp;
                                 <p>expedientes</p>
                             </a>
                         </li> -->
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" id="mperiodos"
                                onclick="CargarContenido('../vistas/periodos.php','content-wrapper')">
                                <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;
                                <p>Períodos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" id="mocupaciones"
                                onclick="CargarContenido('../vistas/ocupaciones.php','content-wrapper')">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;&nbsp;
                                <p>Ocupaciones</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" id="mconceptos"
                                onclick="CargarContenido('../vistas/conceptos.php','content-wrapper')">
                                <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;
                                <p>Conceptos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" id="mhorarios"
                                onclick="CargarContenido('../vistas/mao.horarios.php','content-wrapper')">
                                <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;
                                <p>Horarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" id="minventario"
                                onclick="CargarContenido('../vistas/mao.inventario.php','content-wrapper')">
                                <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;
                                <p>Inventario</p>
                            </a>
                        </li>
                        

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart text-ligth"></i>
                        <p>
                            Ingresos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <a style="cursor: pointer;" class="nav-link" id="mcapturaingresos"
                            onclick="CargarContenido('../vistas/Ingresos.php','content-wrapper')">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;
                            <p>
                                Captura de Ingresos
                            </p>
                        </a>
                        <a style="cursor: pointer;" class="nav-link" id="madministraingresos"
                            onclick="CargarContenido('../vistas/administra_ingresos.php','content-wrapper')">
                            <i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;
                            <p>
                                Administrar Ingresos
                            </p>
                        </a>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart text-ligth"></i>
                        <p>
                            Agenda
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <a style="cursor: pointer;" class="nav-link" id="mcalendario"
                            onclick="CargarContenido('../vistas/mao.calendario.php','content-wrapper')">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;
                            <p>
                                Calendario
                            </p>
                        </a>
                        <a style="cursor: pointer;" class="nav-link" id="mrecordatorio"
                            onclick="CargarContenido('../vistas/mao.recordatorio.php','content-wrapper')">
                            <i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;
                            <p>
                                Recordatorio
                            </p>
                        </a>
                    </ul>
                </li>

                <li class="nav-item">
                    <a style="cursor: pointer;" class="nav-link" id="mngastos"
                        onclick="CargarContenido('../vistas/gastos.php','content-wrapper')">
                        <i class="nav-icon fas fa-dolly text-ligth"></i>
                        <p>
                            Gastos
                        </p>
                    </a>
                </li>

                <li class="nav-item">

                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-print"></i>&nbsp;
                        <p>
                            Reportes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <!-- Reportes -->
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" id="musuarios" onclick="CargarContenido('../vistas/usuarios.php','content-wrapper')"><i class="fa fa-user-md" aria-hidden="true"></i>&nbsp;&nbsp;Usuarios </a>            
                         </li>
                         <li class="nav-item">
                         <?php
                         if ($_SESSION['S_ROL']==1) 
                            { echo '<a style="cursor: pointer;" class="nav-link" id="mroles" onclick="CargarContenido(\'../vistas/rols.php\',\'content-wrapper\')"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;Tipo de Usuario</a>';}?>
                         </li>
                         <li class="nav-item">
                         <?php
                         if ($_SESSION['S_ROL']==1) 
                            { echo '<a style="cursor: pointer;" class="nav-link" id="mpermisos" onclick="CargarContenido(\'../vistas/permisos.php\',\'content-wrapper\')"><i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;Permisos</a>';}?>
                         </li>
                         <li class="nav-item">
                         <?php
                         if ($_SESSION['S_ROL']==1) 
                            { echo '<a style="cursor: pointer;" class="nav-link" id="mempresa" onclick="CargarContenido(\'../vistas/empresa.php\',\'content-wrapper\')"><i class="fa fa-stethoscope" aria-hidden="true"></i>&nbsp;&nbsp;Datos de la Clínica</a>';}?>
                         </li>
                         <li class="nav-item">
                         <?php
                         if ($_SESSION['S_ROL']==1) 
                            { echo '<a style="cursor: pointer;" class="nav-link" id="mmodulos" onclick="CargarContenido(\'../vistas/modulos.php\',\'content-wrapper\')"><i class="fa fa-stethoscope" aria-hidden="true"></i>&nbsp;&nbsp;Módulos</a>';}?>
                         </li>
                         <li class="nav-item">
                         <?php
                         if ($_SESSION['S_ROL']!=1) 
                            { echo '<a style="cursor: pointer;" class="nav-link" id="mperfiles" onclick="CargarContenido(\'../vistas/perfil.php\',\'content-wrapper\')"><i class="fa fa-user-md" aria-hidden="true"></i>&nbsp;&nbsp;Perfil de Usuario</a>';}?>
                         </li>
                         <?php
                         if ($_SESSION['S_ROL']!=-1) 
                            { echo '<a style="cursor: pointer;" class="nav-link" id="mrespaldos" onclick="CargarContenido(\'../email/index.php\',\'content-wrapper\')"><i class="fa fa-server" aria-hidden="true" ></i>&nbsp;&nbsp;Respaldo de Datos</a>';}?>
                         </li>
                        
                     </ul>
                 </li>


                    </ul>
                </li>
                <!--CONFIGURACION -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;
                        <p>
                            Configuración
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" id="mdashboardo"
                                onclick="CargarContenido('../vistas/dashboard.php','content-wrapper')"><i
                                    class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Panel de Control </a>
                        </li>

                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" id="musuarios"
                                onclick="CargarContenido('../vistas/usuarios.php','content-wrapper')"><i
                                    class="fa fa-user-md" aria-hidden="true"></i>&nbsp;&nbsp;Usuarios </a>
                        </li>
                        <li class="nav-item">
                            <?php
                            if ($_SESSION['S_ROL'] == 1) {
                                echo '<a style="cursor: pointer;" class="nav-link" id="mroles" onclick="CargarContenido(\'../vistas/rols.php\',\'content-wrapper\')"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;Tipo de Usuario</a>';
                            } ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            if ($_SESSION['S_ROL'] == 1) {
                                echo '<a style="cursor: pointer;" class="nav-link" id="mpermisos" onclick="CargarContenido(\'../vistas/permisos.php\',\'content-wrapper\')"><i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;Permisos</a>';
                            } ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            if ($_SESSION['S_ROL'] == 1) {
                                echo '<a style="cursor: pointer;" class="nav-link" id="mempresa" onclick="CargarContenido(\'../vistas/empresa.php\',\'content-wrapper\')"><i class="fa fa-stethoscope" aria-hidden="true"></i>&nbsp;&nbsp;Datos de la Clínica</a>';
                            } ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            if ($_SESSION['S_ROL'] == 1) {
                                echo '<a style="cursor: pointer;" class="nav-link" id="mmodulos" onclick="CargarContenido(\'../vistas/modulos.php\',\'content-wrapper\')"><i class="fa fa-stethoscope" aria-hidden="true"></i>&nbsp;&nbsp;Módulos</a>';
                            } ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            if ($_SESSION['S_ROL'] != 1) {
                                echo '<a style="cursor: pointer;" class="nav-link" id="mperfiles" onclick="CargarContenido(\'../vistas/perfil.php\',\'content-wrapper\')"><i class="fa fa-user-md" aria-hidden="true"></i>&nbsp;&nbsp;Perfil de Usuario</a>';
                            } ?>
                        </li>
                        <?php
                        if ($_SESSION['S_ROL'] != -1) {
                            echo '<a style="cursor: pointer;" class="nav-link" id="mrespaldos" onclick="CargarContenido(\'../email/index.php\',\'content-wrapper\')"><i class="fa fa-server" aria-hidden="true" ></i>&nbsp;&nbsp;Respaldo de Datos</a>';
                        } ?>
                </li>

            </ul>
            </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<script>
    $(".nav-link").on('click', function () {
        $(".nav-link").removeClass('active');
        $(this).addClass('active');
    })
</script>
<script>
    var accion;
    var table;

    /*===================================================================*/
    //INICIALIZAMOS EL MENSAJE DE TIPO TOAST (EMERGENTE EN LA PARTE SUPERIOR)
    /*===================================================================*/
    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });

    $(document).ready(function () {
        ocultaropcionesdelmenu();
        $.ajax({
            async: false,
            url: "../ajax/configuracion.ajax.php",
            method: "POST",
            data: {
                'accion': 1
            },
            dataType: 'json',
            success: function (respuesta) {
                var options = '';
                for (let index = 0; index < respuesta.length; index++) {
                    //  options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][1] + '</option>';
                    options = respuesta[index][1] + '';
                    switch (options) {
                        case '1':
                            $("#musuarios").show();
                            break;
                        case '2':
                            $("#mrepresentantes").show();
                            break;
                        case '3':
                            $("#mpacientes").show();
                            break;
                        case '4':
                            $("#mexpedientes").show();
                            break;
                        case '5':
                            $("#mocupaciones").show();
                            break;
                        case '6':
                            $("#mconceptos").show();
                            break;
                        case '7':
                            $("#mcapturaingresos").show();
                            break;
                        case '8':
                            $("#mgastos").show();
                            break;
                        case '9':
                            $("#mroles").show();
                            break;
                        case '10':
                            $("#mpermisos").show();
                            break;
                        case '11':
                            $("#mempresa").show();
                            break;
                        case '12':
                            $("#mperfiles").show();
                            break;
                        case '13':
                            $("#mrespaldos").show();
                        case '14':
                            $("#mdashboardo").show();
                            break;
                        case '15':
                            $("#mcontrato_internamiento").show();
                            break;
                        case '16':
                            $("#mhoja_ingreso").show();
                            break;
                        case '17':
                            $("#mrconsentimiento").show();
                            break;
                        case '18':
                            $("#mrconsentimiento_familiar").show();
                            break;
                        case '19':
                            $("#mrinformacion_costos").show();
                            break;
                        case '20':
                            $("#mrcarta_compromiso").show();
                            break;
                        case '21':
                            $("#mrregistro_lesiones").show();
                            break;
                        case '22':
                            $("#mrcondiciones_generales_ingreso").show();
                            break;
                        case '23':
                            $("#madministraingresos").show();
                            break;
                        case '24':
                            $("#mperiodos").show();
                            break;
                        case '25':
                            $("#mdrogas").show();
                            break;
                        case '26':
                            $("#mrnotificacion_mp").show();
                            break;
                        case '27':
                            $("#mservicios").show();
                            break;
                        case '28':
                            $("#mnespecialistas").show();
                            break;
                        case '2':
                            $("#mestadoscitas").show();
                            break;
                        case '30':
                            $("#mmodulos").show();
                            break;
                        case '31':
                            $("#mcalendario").show();
                            break;
                        case '32':
                            $("#mhorarios").show();
                            break;
                        case '33':
                            $("#minventario").show();
                            break;

                        default:
                            break;
                    }// fin del casee
                }
            }
        });
    });
    function ocultaropcionesdelmenu() {
        $("#mrepresentantes").hide();
        $("#mpacientes").hide();
        $("#mexpedientes").hide();
        $("#mocupaciones").hide();
        $("#mconceptos").hide();
        $("#mngastos").hide();
        $("#mcapturaingresos").hide();
        $("#madministraingresos").hide();
        $("#mgastos").hide();
        $("#mservicios").hide();
        $("#mnespecialistas").hide();
        $("#mperiodos").hide();
        $("#mdrogas").hide();
        $("#mestadoscitas").hide();
        $("#mhorarios").hide();

        // $("#mringresos").hide();

        $("#mcontrato_internamiento").hide();
        $("#mhoja_ingreso").hide();
        $("#mrconsentimiento").hide();
        $("#mrconsentimiento_familiar").hide();
        $("#mrinformacion_costos").hide();
        $("#mrcarta_compromiso").hide();
        $("#mrregistro_lesiones").hide();
        $("#mrcondiciones_generales_ingreso").hide();
        $("#mrnotificacion_mp").hide();

        $("#musuarios").hide();
        $("#mroles").hide();
        $("#mpermisos").hide();
        $("#mempresa").hide();
        $("#mperfiles").hide();
        $("#mrespaldos").hide();
        $("#mdashboardo").hide();
        $("#mmodulos").hide();
        $("#minventario").hide();
        






        $("#mrgastos").hide();
    }

</script>