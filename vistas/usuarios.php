 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Usuarios</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Usuarios</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->
 
<div class="container-fluid"> 
 <!-- DataTable de Usuarios headers -->
        <div class="col-lg-12">
            <table id="tbl_usuarios" class="table table-striped w-100 shadow">
                <thead class="bg-info">
                    <tr style="font-size: 12px;">
                        <th></th>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Correo</th>
                        <th>Rol Id</th>
                        <th>Roles</th>
                        <th>Estatus</th>
                        <th>Id Clínica</th>
                        <th>Clínica</th>
                                            
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody class="text-small">
                </tbody>
            </table>
        </div>
    </div>

</div><!-- /.container-fluid -->

</div>
<!-- /.content -->
<!-- Ventana Modal para ingresar o modificar los Usuarios de los Pacientes -->
<div class="modal fade" id="mdlGestionarUsuarios" role="dialog">

    <div class="modal-dialog modal-lg">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Agregar Usuarios</h5>

                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal de Usuarios-->
            <div class="modal-body">
                <form class="needs-validation" novalidate >
                    <!-- Abrimos una fila -->
                    <div class="row">

                        <!-- Columna para registro del Identificador del Usuario-->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_IdReg"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Identificador</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptUsu_IdReg"
                                    name="iptUsu_Id" placeholder="# del Usuario" required>
                                <div class="invalid-feedback">Debe ingresar el # del usuario</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_Nombre_CompletoReg"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Nombre Completo</span>
                                        <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptUsu_Nombre_CompletoReg"
                                    placeholder="Nombre completo"  required>
                                <div class="invalid-feedback">Debe ingresar el Nombre Completo</div>
                            </div>
                        </div>
                         <!-- Columna para registro del Usuario login -->
                        <div class="col-12 col-lg-12">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_nombreReg"><i class="fa fa-user" aria-hidden="true"></i>
                                    <span class="small">Usuario</span><span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="iptUsu_NombreReg"
                                    name="iptUsu_Nombre" placeholder="Usuario para login" required>
                                <div class="invalid-feedback">Debe ingresar el nombre del usuario</div>
                            </div>
                        </div>

                        <!-- Columna para registro del password del Usuario-->
                       <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_ContrasenaReg"><i class="fa fa-unlock" aria-hidden="true"></i>
                                    <span class="small">Contraseña</span><span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control form-control-sm" id="iptUsu_ContrasenaReg"
                                    name="iptUsu_Contrasena" placeholder="Contraseña" required>
                                <div class="invalid-feedback">Debe ingresar la contraseña</div>
                            </div>
                        </div>
                      
                        <!-- Columna para registro del password del Usuario-->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_Repetir_ContrasenaReg"><i class="fa fa-unlock" aria-hidden="true"></i>
                                    <span class="small">Repetir Contraseña</span><span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control form-control-sm" id="iptUsu_Repetir_ContrasenaReg"
                                    name="iptUsu_Repetir_Contrasena" placeholder="Repetir Contraseña" required>
                                <div class="invalid-feedback">Confirmar contraseña</div>
                            </div>
                        </div>
                      

                        <!-- Columna para registro del Rol -->
                        <div class="col-12 col-lg-4" >
                            <div class="form-group mb-2">
                            <label class="" for="selRolReg"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Rol</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selRolReg" required>
                                </select>
                                <div class="invalid-feedback">Seleccione el Rol</div>
                        </div>
                        </div>
                        <!-- Columna para registro del Estatus -->
                         <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                            <label class="" for="iptUsu_EstatusReg"><i class="fas fa-minus-circle fs-6"></i>
                                     <span class="small">Estatus</span><span class="text-danger">*</span></label>
                                        <select name="estatus" class="form-control form-control-sm" id ="iptUsu_EstatusReg" required>
                                         <option>Activo</option>
                                         <option>Inactivo</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar el estatus</div>
                            </div>
                        </div>
                         <!-- Columna para registro deL Correo-->
                         <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_CorreoReg"><i class="fa fa-envelope" aria-hidden="true"></i> <span class="small">Correo</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptUsu_CorreoReg"
                                 placeholder="Correo" required>
                                 <div class="invalid-feedback">Debe ingresar el correo</div>
                            </div>
                        </div>
                          
                        
                       
                        <!-- Columna para registro la Clínica-->
                        <div class="col-8">
                            <div class="form-group mb-2">
                                 <label class="" for="selEmpresaReg"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Clínica</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selEmpresaReg" required>
                                </select>
                                <div class="invalid-feedback">Seleccione la empresa</div>                        
                            </div> <!-- Columna para registro de la foto-->
                        </div>
                        </div>
                       

                            <!-- creacion de botones para cancelar y guardar el Usuario -->
                            <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                            <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarUsuario">Guardar</button>
                        </div>

                    </div>
                </form>
            
            </div>

        </div>
    </div>


</div>
<!-- /. Fin de Ventana Modal para ingreso de Expedientes de Pacientes -->

<!-- /.content -->
<!-- Ventana Modal para ingresar o modificar los Usuarios de los Pacientes -->
<div class="modal fade" id="mdlGestionarUsuariosm" role="dialog">

    <div class="modal-dialog modal-lg">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-green py-1">

                <h5 class="modal-title">Modificar Usuarios</h5>

                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModalm">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal de Usuarios-->
            <div class="modal-body">
                <form class="needs-validation" novalidate >
                    <!-- Abrimos una fila -->
                    <div class="row">

                        <!-- Columna para registro del Identificador del Usuario-->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_IdRegm"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Identificador</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptUsu_IdRegm"
                                    name="iptUsu_Idm" placeholder="# del Usuario" disabled>
                                <div class="invalid-feedback">Debe ingresar el # del usuario</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_Nombre_CompletoRegm"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Nombre Completo</span>
                                        <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptUsu_Nombre_CompletoRegm"
                                    placeholder="Nombre completo"  required>
                                <div class="invalid-feedback">Debe ingresar el Nombre Completo</div>
                            </div>
                        </div>
                         <!-- Columna para registro del Usuario login -->
                        <div class="col-12 col-lg-12">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_nombreRegm"><i class="fa fa-user" aria-hidden="true"></i>
                                    <span class="small">Usuario</span><span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="iptUsu_NombreRegm"
                                    name="iptUsu_Nombrem" placeholder="Usuario para login" required>
                                <div class="invalid-feedback">Debe ingresar el nombre del usuario</div>
                            </div>
                        </div>

                        <!-- Columna para registro del password del Usuario-->
                       <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_ContrasenaRegm"><i class="fa fa-unlock" aria-hidden="true"></i>
                                    <span class="small">Contraseña</span><span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control form-control-sm" id="iptUsu_ContrasenaRegm"
                                    name="iptUsu_Contrasena" placeholder="Contraseña" required>
                                <div class="invalid-feedback">Debe ingresar la contraseña</div>
                            </div>
                        </div>
                      
                        <!-- Columna para registro del password del Usuario-->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_Repetir_ContrasenaRegm"><i class="fa fa-unlock" aria-hidden="true"></i>
                                    <span class="small">Repetir Contraseña</span><span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control form-control-sm" id="iptUsu_Repetir_ContrasenaRegm"
                                    name="iptUsu_Repetir_Contrasenam" placeholder="Repetir Contraseña" required>
                                <div class="invalid-feedback">Confirmar contraseña</div>
                            </div>
                        </div>
                      

                        <!-- Columna para registro del Rol -->
                        <div class="col-12 col-lg-4" >
                            <div class="form-group mb-2">
                            <label class="" for="selRolRegm"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Rol</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selRolRegm" required>
                                </select>
                                <div class="invalid-feedback">Seleccione el Rol</div>
                        </div>
                        </div>
                        <!-- Columna para registro del Estatus -->
                         <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                            <label class="" for="iptUsu_EstatusRegm"><i class="fas fa-minus-circle fs-6"></i>
                                     <span class="small">Estatus</span><span class="text-danger">*</span></label>
                                        <select name="estatus" class="form-control form-control-sm" id ="iptUsu_EstatusRegm" required>
                                         <option>Activo</option>
                                         <option>Inactivo</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar el estatus</div>
                            </div>
                        </div>
                         <!-- Columna para registro deL Correo-->
                         <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_CorreoRegm"><i class="fa fa-envelope" aria-hidden="true"></i> <span class="small">Correo</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptUsu_CorreoRegm"
                                 placeholder="Correo" required>
                                 <div class="invalid-feedback">Debe ingresar el correo</div>
                            </div>
                        </div>
                          
                        
                       
                        <!-- Columna para registro la Clínica-->
                        <div class="col-8">
                            <div class="form-group mb-2">
                                 <label class="" for="selEmpresaRegm"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Clínica</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selEmpresaRegm" required>
                                </select>
                                <div class="invalid-feedback">Seleccione la empresa</div>                        
                            </div> <!-- Columna para registro de la foto-->
                        </div>
                        </div>
                       

                            <!-- creacion de botones para cancelar y guardar el Usuario -->
                            <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistrom">Cancelar</button>
                            <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarUsuariom">Guardar</button>
                        </div>

                    </div>
                </form>
            
            </div>

        </div>
    </div>


</div>
<!-- /. Fin de Ventana Modal para ingreso de Expedientes de Pacientes -->




<script>
var accion;
var table;
var fecha;

/*===================================================================*/
//INICIALIZAMOS EL MENSAJE DE TIPO TOAST (EMERGENTE EN LA PARTE SUPERIOR)
/*===================================================================*/
var Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000
});

$(document).ready(function() {
    /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE ROLES
    /*===================================================================*/
$.ajax({
        url: "../ajax/rolcb.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione un rol</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selRolReg").append(options);
        }
});
   /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE ROLES MODIFICAR
    /*===================================================================*/
    $.ajax({
        url: "../ajax/rolcb.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione un rol</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selRolRegm").append(options);
        }
});
     /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE LAS CLINICAS
    /*===================================================================*/
$.ajax({
        url: "../ajax/empresacb.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione la clínica</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selEmpresaReg").append(options);
        }
    });
    /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE LAS CLINICAS MODIFICAR
    /*===================================================================*/
$.ajax({
        url: "../ajax/empresacb.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione la clínica</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selEmpresaRegm").append(options);
        }
    });
     
/*===================================================================*/
// CARGA DEL LISTADO CON EL PLUGIN DATATABLE JS
/*===================================================================*/

table = $("#tbl_usuarios").DataTable({
        dom: 'Bfrtip', // Para que los botones se pongan en la parte Superior
        buttons: [{
                text: 'Agregar Usuarios',
                className: 'addNewRecord',
                action: function(e, dt, node, config) {
                    $("#mdlGestionarUsuarios").modal('show');
                   accion = 2; //registrar
                }
            },
            {
                extend: 'excel',
                text: 'Excel',
                title: 'Listado de Usuarios'
            },
            {
                extend: 'print', 
                text: 'Imprimir',
                title: 'Listado de Usuarios'},
            {
                extend:'pageLength',
                text: 'Longitud de la página'
            }
        ],
        pageLength: [[5, 10, 15, 30, 50], 
                    ['5 Filas','10 Filas','15 Filas','30 Filas','50 Filas','Mostrar todo']], 
        pageLength: 10,

        ajax: {
            url: "../ajax/usuarios.ajax.php",
            dataSrc: '',
            type: "POST",
            data: {
                'accion': 1 //1: LISTAR PACIENTES
            },
        },
        bAutoWidth: false,
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [{
                targets: 0,
                orderable: false,
                width: '10%',
                className: 'control'
               
            },
            {
               targets: 4, // no muestra el correo
               visible: false 
            },
            {
                targets: 6, // no muestra el id del rol
                visible: false 
            }, 
            {
                targets: 8, // 
                      createdCell: function(td, cellData, rowData, row, col) {
                   if ((rowData[8]) == 'Inactivo') {
                      $(td).parent().css('background', '#7D2A19')
                      $(td).parent().css('color', '#ffffff')
                    }
                }
            },
           {
                targets: 9, // no muestra el id del rol
                visible: false 
            },
            {
                targets: 10, // no muestra el id del rol
                visible: false 
            },
            {
                targets: 11,
                orderable: false,
                render: function(data, type, full, meta) {
                    return "<center>" +
                         
                        "<span class='btnEditarUsuario text-success px-1' style='cursor:pointer;'>" +
                        "<i class='fas fa-pencil-alt fs-5'></i>" +
                        "</span>" +
                        "<span class='btnEliminarUsuario text-danger px-1' style='cursor:pointer;'>" +
                        "<i class='fas fa-trash fs-5'></i>" +
                        "</span>" +
                        "</center>"
                }
            }

        ],
        fixedColumns:   {
            left: 1,
            right: 1
        },
        //fixedColumns: true,
        language: {
           // url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
             "url": "../vistas/assets/json/Spanish.json"
            // con esto se cambia al idioma español de los elementos del datatable
        }
    });
    $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {

        $("#validate_Usu_Id").css("display", "none");
        $("#validate_Usu_Nombre").css("display", "none");
        $("#validate_Usu_Contrasena").css("display", "none");
        $("#validate_Usu_Repetir_Contrasena").css("display", "none");
        $("#validate_Rol_Id").css("display", "none");
        $("#validate_Usu_Estatus").css("display", "none");
        $("#validate_Usu_Correo").css("display", "none");
        $("#validate_Usu_Nombre_Completo").css("display", "none");
        $("#validate_Usu_Clinica").css("display", "none");
       
        $("#iptUsu_IdReg").val("");
        $("#iptUsu_NombreReg").val("");
        $("#iptUsu_ContrasenaReg").val("");
        $("#iptUsu_Repetir_ContrasenaReg").val("");
        $("#selRolReg").val(0);
        $("#iptUsu_EstatusReg").val("");
        $("#iptUsu_CorreoReg").val("");
        $("#iptUsu_Nombre_CompletoReg").val("");
        $("#selEmpresaReg").val("");
      
    })
    $("#btnCancelarRegistrom, #btnCerrarModalm").on('click', function() {

$("#validate_Usu_Idm").css("display", "none");
$("#validate_Usu_Nombrem").css("display", "none");
$("#validate_Usu_Contrasenam").css("display", "none");
$("#validate_Usu_Repetir_Contrasenam").css("display", "none");
$("#validate_Rol_Idm").css("display", "none");
$("#validate_Usu_Estatusm").css("display", "none");
$("#validate_Usu_Correom").css("display", "none");
$("#validate_Usu_Nombre_Completom").css("display", "none");
$("#validate_Usu_Clinicam").css("display", "none");

$("#iptUsu_IdRegm").val("");
$("#iptUsu_NombreRegm").val("");
$("#iptUsu_ContrasenaRegm").val("");
$("#iptUsu_Repetir_ContrasenaRegm").val("");
$("#selRolRegm").val(0);
$("#iptUsu_EstatusRegm").val("");
$("#iptUsu_CorreoRegm").val("");
$("#iptUsu_Nombre_CompletoRegm").val("");
$("#selEmpresaRegm").val("");

})

    

    /*===================================================================*/
    //EVENTO PARA CALCULAR LA EDAD AL CAMBIAR EL CONTENIDO (PERDER FOCUS)
    /*===================================================================*/
  //  $("#iptUsu_Repetir_ContrasenaReg").change(function() {
        
   //   validarpass();
  //  });
  /*===================================================================*/
    //EVENTO PARA CALCULAR LA DURACION DEL CONTRATO AL CAMBIAR EL CONTENIDO (PERDER FOCUS)
    /*===================================================================*/
    $("#iptFecha_SalidaReg").change(function() {
      
      calcularDuracion();
    });

    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON EDITAR USUARIO
    =========================================================================================*/
    $('#tbl_usuarios tbody').on('click', '.btnEditarUsuario', function() {

        accion = 4; //seteamos la accion para editar

        $("#mdlGestionarUsuariosm").modal('show');

        var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }
        console.log("🚀 ~ file: usuarios.php ~ line 642 ~ $ ~ data", data)
       
        $("#iptUsu_IdRegm").val(data[1]);
        $("#iptUsu_NombreRegm").val(data["usu_nombre"]);
        $("#iptUsu_ContrasenaRegm").val(data["usu_contrasena"]);
        $("#selRolRegm").val(data[6]); // se pone el id
        $("#iptUsu_EstatusRegm").val(data["usu_estatus"]);
        $("#iptUsu_CorreoRegm").val(data["usu_correo"]);
        $("#iptUsu_Nombre_CompletoRegm").val(data["usu_nombre_completo"]);
        $("#selEmpresaRegm").val(data[9]); 

    })
   
    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON ELIMINAR USUARIO
    =========================================================================================*/
    $('#tbl_usuarios tbody').on('click', '.btnEliminarUsuario', function() {
        
        accion = 5; //seteamos la accion para editar
        
        var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }

        var usu_id = data["usu_id"];

        Swal.fire({
            title: 'Está seguro de eliminar el Usuario?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo eliminarlo!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var datos = new FormData();

                datos.append("accion", accion);
                datos.append("usu_id", usu_id); //Usu_id             

                $.ajax({
                    url: "../ajax/usuarios.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(respuesta) {

                        if (respuesta == "ok") {

                            Toast.fire({
                                icon: 'success',
                                title: 'El usuario se eliminó correctamente'
                            });

                            table.ajax.reload();

                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'El usuario no se pudo eliminar'
                            });
                        }

                    }
                });

            }
        })
    })
        

});

/*===================================================================*/
//EVENTO QUE GUARDA  LOS DATOS DEL USUARIO, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/
document.getElementById("btnGuardarUsuario").addEventListener("click", function() {
                         
                         // Get the forms we want to add validation styles to
                         var forms = document.getElementsByClassName('needs-validation');
                         // Loop over them and prevent submission
                         var validation = Array.prototype.filter.call(forms, function(form) {
                             //calcularedad();
                             if (validarpass())    
                                 {
                                 if (form.checkValidity() === true) {   
                     
                                // console.log("Listo para registrar el paciente")
                                 if (accion==2){
                                     $mensaje='Está seguro de registrar el Usuario?';
                                     $confirmar='Si, deseo registrarlo!';
                                 }
                                 Swal.fire({
                                     title:$mensaje ,
                                     icon: 'warning',
                                     showCancelButton: true,
                                     confirmButtonColor: '#3085d6',
                                     cancelButtonColor: '#d33',
                                     confirmButtonText: $confirmar,
                                     cancelButtonText: 'Cancelar',
                                 }).then((result) => {
                     
                                     if (result.isConfirmed) {
                                         
                     
                                         var datos = new FormData();
                                         datos.append("accion", accion);
                                         datos.append("usu_id", $("#iptUsu_IdReg").val()); //Usu_id
                                         datos.append("usu_nombre", $("#iptUsu_NombreReg").val()); //Usu_nombre
                                         datos.append("usu_contrasena", $("#iptUsu_ContrasenaReg").val()); //Usu_contraseña
                                         datos.append("rol_id", $("#selRolReg").val()); //Rol_id
                                         datos.append("usu_estatus", $("#iptUsu_EstatusReg").val()); //Usu_estatus
                                         datos.append("usu_correo", $("#iptUsu_CorreoReg").val()); //Usu_Correo
                                         
                                         datos.append("usu_nombre_completo", $("#iptUsu_Nombre_CompletoReg").val()); //Usu_nombre_completo
                                         datos.append("usu_clinica", $("#selEmpresaReg").val()); 
                                     
                                             if(accion == 2){
                                             var titulo_msj = "El Usuario se registró correctamente"
                                             }
                     
    
                                             $.ajax({
                                              url: "../ajax/usuarios.ajax.php",
                                              method: "POST",
                                              data: datos,
                                              cache: false,
                                                 contentType: false,
                                                 processData: false,
                                                 dataType: 'json',
                                                 success: function(respuesta) {
                     
                                                 if (respuesta == "ok") {
                     
                                                     Toast.fire({
                                                         icon: 'success',
                                                         title: titulo_msj
                                                     });
                     
                                                     table.ajax.reload();
                                                     $("#mdlGestionarUsuarios").modal('hide');
                                                     $("#iptUsu_IdReg").val("");
                                                     $("#iptUsu_NombreReg").val("");
                                                     $("#iptUsu_ContrasenaReg").val("");
                                                     $("#selRol_IdReg").val(0);
                                                     $("#iptUsu_EstatusReg").val("");
                                                     $("#iptUsu_CorreoReg").val("");
                                                  
                                                     $("#iptUsu_Nombre_CompletoReg").val("");
                                                     $("#selEmpresaReg").val(0);
                                                 } else {
                                                     Toast.fire({
                                                         icon: 'error',
                                                         title: 'El Usuario no se pudo registrar'
                                                     });
                                                 }
                     
                                             }
                                         });
                                     
                     
                                     }
                                 })
                                 }else {
                                 console.log("No pasó la validación")
                                 }
                             }
                             else
                                 {
                                 Swal.fire("Las Contraseñas no coinciden... Verifique!!!");
                                 }
                             form.classList.add('was-validated');
                     
                         });
                     });
                     
                     



/*===================================================================*/
//EVENTO QUE GUARDA LAS MODIFICACIONES DE LOS DATOS DEL USUARIO, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/
document.getElementById("btnGuardarUsuariom").addEventListener("click", function() {
                         
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
        //calcularedad();
        if (validarpassm())    
            {
            if (form.checkValidity() === true) {   

           // console.log("Listo para registrar el paciente")
            if(accion == 4){
                $mensaje='Está seguro de Modificar el Usuario?';
                $confirmar='Si, deseo Modificarlo!';
            }
            if (accion==2){
                $mensaje='Está seguro de registrar el Usuario?';
                $confirmar='Si, deseo registrarlo!';
            }
            Swal.fire({
                title:$mensaje ,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: $confirmar,
                cancelButtonText: 'Cancelar',
            }).then((result) => {

                if (result.isConfirmed) {
                    

                    var datos = new FormData();
                    datos.append("accion", accion);
                    datos.append("usu_id", $("#iptUsu_IdRegm").val()); //Usu_id
                    datos.append("usu_nombre", $("#iptUsu_NombreRegm").val()); //Usu_nombre
                    datos.append("usu_contrasena", $("#iptUsu_ContrasenaRegm").val()); //Usu_contraseña
                    datos.append("rol_id", $("#selRolRegm").val()); //Rol_id
                    datos.append("usu_estatus", $("#iptUsu_EstatusRegm").val()); //Usu_estatus
                    datos.append("usu_correo", $("#iptUsu_CorreoRegm").val()); //Usu_Correo
                    
                    datos.append("usu_nombre_completo", $("#iptUsu_Nombre_CompletoRegm").val()); //Usu_nombre_completo
                    datos.append("usu_clinica", $("#selEmpresaRegm").val()); 
                
                        if(accion == 2){
                        var titulo_msj = "El Usuario se registró correctamente"
                        }

                        if(accion == 4){
                          var titulo_msj = "El Usuario se actualizó correctamente"
                        }

                        $.ajax({
                         url: "../ajax/usuarios.ajax.php",
                         method: "POST",
                         data: datos,
                         cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(respuesta) {

                            if (respuesta == "ok") {

                                Toast.fire({
                                    icon: 'success',
                                    title: titulo_msj
                                });

                                table.ajax.reload();
                                $("#mdlGestionarUsuariosm").modal('hide');
                                $("#iptUsu_IdRegm").val("");
                                $("#iptUsu_NombreRegm").val("");
                                $("#iptUsu_ContrasenaRegm").val("");
                                $("#selRol_IdRegm").val(0);
                                $("#iptUsu_EstatusRegm").val("");
                                $("#iptUsu_CorreoRegm").val("");
                             
                                $("#iptUsu_Nombre_CompletoRegm").val("");
                                $("#selEmpresaRegm").val(0);
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'El Usuario no se pudo registrar'
                                });
                            }

                        }
                    });
                

                }
            })
            }else {
            console.log("No pasó la validación")
            }
        }
        else
            {
            Swal.fire("Las Contraseñas no coinciden... Verifique!!!");
            }
        form.classList.add('was-validated');

    });
});


$("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {

    $("#validate_Usu_Id").css("display", "none");
    $("#validate_Usu_Nombre").css("display", "none");
    $("#validate_Usu_Contrasena").css("display", "none");
    $("#validate_Usu_Repetir_Contrasena").css("display", "none");
    $("#validate_Rol_Id").css("display", "none");
    $("#validate_Usu_Estatus").css("display", "none");
    $("#validate_Usu_Correo").css("display", "none");
    $("#validate_Usu_Nombre_Completo").css("display", "none");
    $("#validate_Usu_Clinica").css("display", "none");

    $("#iptUsu_IdReg").val("");
    $("#iptUsu_NombreReg").val("");
    $("#iptUsu_ContrasenaReg").val("");
    $("#iptUsu_Repetir_ContrasenaReg").val("");
    $("#selRolReg").val(0);
    $("#iptUsu_EstatusReg").val("");
    $("#iptUsu_CorreoReg").val("");
    $("#iptUsu_Nombre_CompletoReg").val("");
    $("#selEmpresaReg").val(0);

})



/*===================================================================*/
//EVENTO QUE LIMPIA LOS MENSAJES DE ALERTA DE INGRESO DE DATOS DE CADA INPUT AL CANCELAR LA VENTANA MODAL
/*===================================================================*/
document.getElementById("btnCancelarRegistro").addEventListener("click", function() {
    $(".needs-validation").removeClass("was-validated");
})

$("#iptCuota_IngresoReg").on({
  "focus": function(event) {
    $(event.target).select();
  },
  "keyup": function(event) {
    $(event.target).val(function(index, value) {
      return value.replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
    });
  }
});

$("#iptCuota_SemanalReg").on({
  "focus": function(event) {
    $(event.target).select();
  },
  "keyup": function(event) {
    $(event.target).val(function(index, value) {
      return value.replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
    });
  }
});
function Edad(FechaNacimiento) {

    var fechaNace = new Date(FechaNacimiento);
    var fechaActual = new Date()

    var mes = fechaActual.getMonth();
    var dia = fechaActual.getDate();
    var año = fechaActual.getFullYear();

    fechaActual.setDate(dia);
    fechaActual.setMonth(mes);
    fechaActual.setFullYear(año);

    edad = Math.floor(((fechaActual - fechaNace) / (1000 * 60 * 60 * 24) / 365));
   
    return edad;
}
function edad(e) {

   
 /* edadMS = Date.parse(Date()) - Date.parse(e.target.value);
  edads = new Date();
  edads.setTime(edadMS);
  resultado = edads.getFullYear() - 1970;
  res = (resultado <= 0) ? 0 : resultado; // Para evitar que sea negativo
  document.getElementById('iptEdadReg').innerHTML = res;
*/
}
function validarpass(){
    var pass1 = $("#iptUsu_ContrasenaReg").val();
    var pass2 = $("#iptUsu_Repetir_ContrasenaReg").val();
  if (pass1 == pass2){
      return(true);
  }else
  return(false);

}
function validarpassm(){
    var pass1 = $("#iptUsu_ContrasenaRegm").val();
    var pass2 = $("#iptUsu_Repetir_ContrasenaRegm").val();
  if (pass1 == pass2){
      return(true);
  }else
  return(false);

}
function isValidDate(day,month,year)
{
    var dteDate;
 
    // En javascript, el mes empieza en la posicion 0 y termina en la 11 
    //   siendo 0 el mes de enero
    // Por esta razon, tenemos que restar 1 al mes
    month=month-1;
    // Establecemos un objeto Data con los valore recibidos
    // Los parametros son: año, mes, dia, hora, minuto y segundos
    // getDate(); devuelve el dia como un entero entre 1 y 31
    // getDay(); devuelve un num del 0 al 6 indicando siel dia es lunes,
    //   martes, miercoles ...
    // getHours(); Devuelve la hora
    // getMinutes(); Devuelve los minutos
    // getMonth(); devuelve el mes como un numero de 0 a 11
    // getTime(); Devuelve el tiempo transcurrido en milisegundos desde el 1
    //   de enero de 1970 hasta el momento definido en el objeto date
    // setTime(); Establece una fecha pasandole en milisegundos el valor de esta.
    // getYear(); devuelve el año
    // getFullYear(); devuelve el año
    dteDate=new Date(year,month,day);
 
    //Devuelva true o false...
    return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));
}
 
/**
 * Funcion para validar una fecha
 * Tiene que recibir:
 *  La fecha en formato ingles yyyy-mm-dd
 * Devuelve:
 *  true-Fecha correcta
 *  false-Fecha Incorrecta
 */
function validate_fecha(fecha)
{
    var patron=new RegExp("^(19|20)+([0-9]{2})([-])([0-9]{1,2})([-])([0-9]{1,2})$");
 
    if(fecha.search(patron)==0)
    {
        var values=fecha.split("-");
        if(isValidDate(values[2],values[1],values[0]))
        {
            return true;
        }
    }
    return false;
}
 
/**
 * Esta función calcula la edad de una persona y los meses
 * La fecha la tiene que tener el formato yyyy-mm-dd que es
 * metodo que por defecto lo devuelve el <input type="date">
 */
function calcularEdad()
{
    var fecha = $("#iptFecha_NacimientoReg").val();
   // fecha=document.getElementById("#iptFecha_NacimientoReg").value;
    if(validate_fecha(fecha)==true)
    {
        // Si la fecha es correcta, calculamos la edad
        var values=fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];
 
        // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth()+1;
        var ahora_dia = fecha_hoy.getDate();
 
        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if ( ahora_mes < mes )
        {
            edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia))
        {
            edad--;
        }
        if (edad > 1900)
        {
            edad -= 1900;
        }
 
        // calculamos los meses
        var meses=0;
        if(ahora_mes>mes)
            meses=ahora_mes-mes;
        if(ahora_mes<mes)
            meses=12-(mes-ahora_mes);
        if(ahora_mes==mes && dia>ahora_dia)
            meses=11;
 
        // calculamos los dias
        var dias=0;
        if(ahora_dia>dia)
            dias=ahora_dia-dia;
        if(ahora_dia<dia)
        {
            ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
            dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
        }
        //$("#iptEdadReg").val($anios);
        $("#iptEdadReg").val(edad);
        
    }else{
       // document.getElementById("result").innerHTML="La fecha "+fecha+" es incorrecta";
    }
}
function calcularDuracion()
{
    var fechai = $("#iptFecha_IngresoReg").val();
    var fechas = $("#iptFecha_SalidaReg").val();

   // iptFecha_IngresoReg
    var fecha1 = moment(fechai);
    var fecha2 = moment(fechas);
    $("#iptTiempo_DuracionReg").val(fecha2.diff(fecha1, 'months'));
//console.log(fecha2.diff(fecha1, 'days'), ' dias de diferencia');
}


</script>
<!-- <script src="http://momentjs.com/downloads/moment.min.js"></script> -->
         

