<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Permisos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Permisos de Usuarios</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
 <!-- Main content -->
 <div class="content">

<div class="container-fluid">
<!-- row para listado de Roles -->
    <div class="row">
        <div class="col-lg-10">
            <table id="tbl_Permisos" class="table table-striped w-100 shadow">
            <thead class="bg-info">
                <tr style="font-size: 12px;">
                    <th></th>                 
                    <th>#</th>
                    <th>id_rol</th>
                    <th>Nombre_rol</th>
                    <th>id_modulo</th>
                    <th>Módulo</th>
                    <th>Ver</th>
                    <th>Crear</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
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

<!-- /.content-header  -->
<!-- Ventana Modal para ingresar  los Permisos de los Usuarios  -lg-->
<div class="modal fade" id="mdlGestionarPermisos" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- contenido del modal -->
        <div class="modal-content">
            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">
                <h5 class="modal-title">Agregar Permisos</h5>
                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>
            </div>
            <!-- cuerpo del modal PERMISOS-->
            <div class="modal-body">
                <form class="needs-validation" novalidate >
                    <!-- Abrimos una fila -->
                    <div class="row">

                        <!-- Columna para registro del Identificador del Persmiso-->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptIdReg"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Identificador</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptIdReg"
                                    name="iptId" placeholder="Número de Permiso" required>
                                <div class="invalid-feedback">Debe ingresar el # de Permiso</div>
                            </div>
                        </div>
                      
                        <!-- Columna para registro del Nombre del Permiso -->
                        <div class="col-8 col-lg-10">
                            <div class="form-group mb-2">
                            <label class="" for="selRolReg"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Nombre del Rol</span><span class="text-danger">*</span>
                                </label>
                               <select class="form-select  form-select-sm" data-live-search="true" aria-label=".form-select-sm example"
                                    id="selRolReg" require> 
                                </select>
                                <div class="invalid-feedback">Seleccione el Rol</div>
                            </div>
                        </div>
                        <!-- Columna para registro del módulo -->
                        <div class="col-8  col-lg-12">
                            <div class="form-group mb-2">
                                <label class="" for="selModuloReg"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Modulo</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selModuloReg">
                                </select>
                                <div class="invalid-feedback">Seleccione el Módulo del Permiso</div>
                            </div>
                        </div>
                         <!-- Columna para registro de consultas-->
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptConsultarReg"> <span class="small">Consultar</span></label>
                                <select name="Consultar" class="form-control form-control-sm" id ="iptConsultarReg" required>
                                         <option>Si</option>
                                         <option>No</option>
                                         </select>     
                                 <div class="invalid-feedback">Debe Seleccionar opción</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la grabar-->
                    
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptGrabarReg"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Grabar</span>
                                        <span class="text-danger">*</span></label>
                                        <select name="grabar" class="form-control form-control-sm" id ="iptGrabarReg" required>
                                         <option>Si</option>
                                         <option>No</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar opción</div>
                            </div>
                        </div>
                        <!-- Columna para registro de actualizar-->
                    
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptActualizarReg"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Modificar</span>
                                        <span class="text-danger">*</span></label>
                                        <select name="actualizar" class="form-control form-control-sm" id ="iptActualizarReg" required>
                                         <option>Si</option>
                                         <option>No</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar opción</div>
                            </div>
                        </div>
                        <!-- Columna para registro de Eliminar -->
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptBorrarReg"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Eliminar</span>
                                        <span class="text-danger">*</span></label>
                                        <select name="estatus" class="form-control form-control-sm" id ="iptBorrarReg" required>
                                         <option>Si</option>
                                         <option>No</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar opción</div>
                            </div>
                        </div>
                        </div>
                        <!-- creacion de botones para cancelar y guardar el Permiso -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarPermiso">Guardar</button>
                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->
                        </div>
                    </div>
                </form>
            
            </div>

        </div>
    </div>
</div>
<!-- /. Fin de Ventana Modal para ingreso de Permisos de Usuarios -->


<!-- /.content-header -->
<!-- Ventana Modal para Modificar  los Permisos de los Usuarios  -lg-->
<div class="modal fade" id="mdlGestionarPermisosm" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- contenido del modal -->
        <div class="modal-content">
            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">
                <h5 class="modal-title">Modificar Permisos</h5>
                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModalm">
                    <i class="far fa-times-circle"></i>
                </button>
            </div>
            <!-- cuerpo del modal PERMISOS PARA MODIFICAR-->
            <div class="modal-body">
                <form class="needs-validation" novalidate >
                    <!-- Abrimos una fila -->
                    <div class="row">

                        <!-- Columna para registro del Identificador del Permiso-->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptIdRegm"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Identificador</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptIdRegm"
                                    name="iptIdm" placeholder="Número de Permiso" disabled>
                                <div class="invalid-feedback">Debe ingresar el # de Permiso</div>
                            </div>
                        </div>
                      
                        <!-- Columna para registro del Nombre del Permiso -->
                        <div class="col-8 col-lg-10">
                            <div class="form-group mb-2">
                            <label class="" for="selRolRegm"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Nombre del Rol</span><span class="text-danger">*</span>
                                </label>
                               <select class="form-select  form-select-sm" data-live-search="true" aria-label=".form-select-sm example"
                                    id="selRolRegm" disabled> 
                                </select>
                                <div class="invalid-feedback">Seleccione el Rol</div>
                            </div>
                        </div>
                        <!-- Columna para registro del módulo -->
                        <div class="col-8  col-lg-12">
                            <div class="form-group mb-2">
                                <label class="" for="selModuloRegm"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Modulo</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selModuloRegm" disabled>
                                </select>
                                <div class="invalid-feedback">Seleccione el Módulo del Permiso</div>
                            </div>
                        </div>
                         <!-- Columna para registro de consultas-->
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptConsultarRegm"> <span class="small">Consultar</span></label>
                                <select name="Consultar" class="form-control form-control-sm" id ="iptConsultarRegm" required>
                                         <option>Si</option>
                                         <option>No</option>
                                         </select>     
                                 <div class="invalid-feedback">Debe Seleccionar opción</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la grabar-->
                    
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptGrabarRegm"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Grabar</span>
                                        <span class="text-danger">*</span></label>
                                        <select name="grabar" class="form-control form-control-sm" id ="iptGrabarRegm" required>
                                         <option>Si</option>
                                         <option>No</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar opción</div>
                            </div>
                        </div>
                        <!-- Columna para registro de actualizar-->
                    
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptActualizarRegm"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Modificar</span>
                                        <span class="text-danger">*</span></label>
                                        <select name="actualizar" class="form-control form-control-sm" id ="iptActualizarRegm" required>
                                         <option>Si</option>
                                         <option>No</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar opción</div>
                            </div>
                        </div>
                        <!-- Columna para registro de Eliminar -->
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptBorrarRegm"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Eliminar</span>
                                        <span class="text-danger">*</span></label>
                                        <select name="estatus" class="form-control form-control-sm" id ="iptBorrarRegm" required>
                                         <option>Si</option>
                                         <option>No</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar opción</div>
                            </div>
                        </div>
                        </div>
                        <!-- creacion de botones para cancelar y guardar el Permiso -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistrom">Cancelar</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarPermisom">Guardar</button>
                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->
                        </div>
                    </div>
                </form>
            
            </div>

        </div>
    </div>
</div>
<!-- /. Fin de Ventana Modal para ingreso de Permisos de Usuarios -->


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


$(document).ready(function() {
    $("#mdlGestionarPermisos").draggable({
    handle: ".modal-header"
}); 
    /* ******************************************************************************************* */
  /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE LAS ROLES
    /*===================================================================*/
    $.ajax({
        url: "../ajax/rolcb.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione el rol</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selRolReg").append(options);
        }
    });
/*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE LAS ROLES MODIFICAR
    /*===================================================================*/
    $.ajax({
        url: "../ajax/rolcb.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione el rol</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selRolRegm").append(options);
        }
    });

    /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE LOS MODULOS
    /*===================================================================*/
    $.ajax({
        url: "../ajax/modulos.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione el módulo</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selModuloReg").append(options);
        }
    });
    /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE LOS MODULOS MODIFICAR
    /*===================================================================*/
    $.ajax({
        url: "../ajax/modulos.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione el módulo</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selModuloRegm").append(options);
        }
    });
    /*===================================================================*/
    // CARGA DEL LISTADO CON EL PLUGIN DATATABLE JS
    /*===================================================================*/
    table = $("#tbl_Permisos").DataTable({
     dom: 'Bfrtip', // Para que los botones se pongan en la parte Superior
        buttons: [{
                text: 'Agregar Permisos',
                className: 'addNewRecord',
                action: function(e, dt, node, config) {
                    $("#mdlGestionarPermisos").modal('show');
                   accion = 2; //registrar
                }
            },
            {
                extend: 'excel',
                text: 'Excel',
                title: 'Listado de Permisos de los Usuarios'
            },
            {
                extend: 'print', 
                text: 'Imprimir',
                title: 'Listado de Permisos de los Usuarios'},
            {
                extend:'pageLength',
                text: 'Longitud de la página'
            }           
        ],
        pageLength: [[5, 10, 15, 30, 50], 
                    ['5 Filas','10 Filas','15 Filas','30 Filas','50 Filas','Mostrar todo']], 
        pageLength: 10,
        ajax: {
         url: "../ajax/permisos.ajax.php",
            dataSrc: '',
            type: "POST",
            data: {
                'accion': 1 //1: LISTAR Permisos
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
                targets: 2, // 
                visible: false
            }, {
                targets: 4, // 
                visible: false
            },

        {
            targets: 10,
            orderable: false,
            render: function(data, type, full, meta) {
                return "<center>" +
                    "<span class='btnEditarPermiso text-primary px-1' style='cursor:pointer;'>" +
                    "<i class='fas fa-pencil-alt fs-5'></i>" +
                    "</span>" +
                    "<span class='btnEliminarPermiso text-danger px-1' style='cursor:pointer;'>" +
                    "<i class='fas fa-trash fs-5'></i>" +
                    "</span>" +
                    "</center>"
            }
        }
    ],
    //fixedColumns: true,
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        // con esto se cambia al idioma español de los elementos del datatable
    }
    });

    $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {

    $("#validate_Id").css("display", "none");
    $("#validate_Id_rol").css("display", "none");
    $("#validate_Id_modulo").css("display", "none");
    $("#validate_Consultar").css("display", "none");
    $("#validate_Grabar").css("display", "none");
    $("#validate_Actualizar").css("display", "none");
    $("#validate_Borrar").css("display", "none");


    $("#iptIdReg").val("");
    $("#iptRolReg").val(0);
    $("#iptModuloReg").val(0);
    $("#ipConsultarReg").val("");
    $("#iptGrabarReg").val("");
    $("#iptActualizarReg").val("");
    $("#iptBorrarReg").val("");


    })
    $("#btnCancelarRegistrom, #btnCerrarModalm").on('click', function() {

        $("#validate_Id").css("display", "none");
        $("#validate_Id_rol").css("display", "none");
        $("#validate_Id_modulo").css("display", "none");
        $("#validate_Consultar").css("display", "none");
        $("#validate_Grabar").css("display", "none");
        $("#validate_Actualizar").css("display", "none");
        $("#validate_Borrar").css("display", "none");


        $("#iptIdRegm").val("");
        $("#iptRolRegm").val(0);
        $("#iptModuloRegm").val(0);
        $("#ipConsultarRegm").val("");
        $("#iptGrabarRegm").val("");
        $("#iptActualizarRegm").val("");
        $("#iptBorrarRegm").val("");

    })

    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON EDITAR Permisos
    =========================================================================================*/
$('#tbl_Permisos tbody').on('click', '.btnEditarPermiso', function() {

    accion = 4; //seteamos la accion para editar

    $("#mdlGestionarPermisosm").modal('show');

    var data = table.row($(this).parents('tr')).data();
    console.log("🚀 ~ file: Permisos.php ~ line 551 ~ $ ~ data", data)
    
        $("#iptIdRegm").val(data["id"]);
        $("#selRolRegm").val(data[2]); // se pone el id
        $("#selModuloRegm").val(data[4]); // se pone la posicion del ID
        $("#iptConsultarRegm").val(data["consultar"]);
        $("#iptGrabarRegm").val(data["grabar"]);
        $("#iptActualizarRegm").val(data["actualizar"]);
        $("#iptBorrarRegm").val(data["borrar"]);
    })
  
    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON ELIMINAR Rol
    =========================================================================================*/
$('#tbl_Permisos tbody').on('click', '.btnEliminarPermiso', function() {
    
    accion = 5; //seteamos la accion para editar
    
    var data = table.row($(this).parents('tr')).data();
    var id = data["id"];

    Swal.fire({
        title: 'Está seguro de eliminar el permiso?',
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
            datos.append("id", id); //id_Permisos             

            $.ajax({
                url: "../ajax/permisos.ajax.php",
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
                            title: 'El permiso se eliminó correctamente'
                        });

                        table.ajax.reload();

                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'El permiso no se pudo eliminar'
                        });
                    }

                }
            });

         }
        })
    })

});


/*===================================================================*/
//EVENTO QUE GUARDA LOS DATOS DE LOS PERMISOS, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/
document.getElementById("btnGuardarPermiso").addEventListener("click", function() {

// Get the forms we want to add validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {

    if (form.checkValidity() === true) { 
        
        var datos1 = new FormData();

        datos1.append("accion", 8);
        datos1.append("id", $("#iptIdReg").val()); 
           
            $.ajax({
            url: "../ajax/permisos.ajax.php",
            method: "POST",
            data: datos1,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(respuesta) {

            if (respuesta == "ok") {
                 Swal.fire({
                icon: 'warning',
                title: 'Verifique...',
                text: 'El Id de este Permiso ya está registrado!'         
                }) 


            } else{
       // console.log("Listo para registrar el Permiso")
             if(accion == 4){
                    var titulo_msj = "El Permiso se actualizó correctamente";
                    var tituloswal ="Está seguro de Modificar el Permiso?";
                    var titulobutton ="Si, deseo modificarlo!";
                }
                if(accion == 2){
                    var titulo_msj = "El Permiso se registró correctamente";
                    var tituloswal ="Está seguro de guardar el Permiso?";
                    var titulobutton ="Si, deseo registrarlo!";
                }
        Swal.fire({
            title: tituloswal,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: titulobutton,
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var datos1 = new FormData();

                datos1.append("accion", 7);
                datos1.append("id_rol", $("#selRolReg").val()); //Nombre_Rol
                datos1.append("id_modulo", $("#selModuloReg").val()); //Módulo
            $.ajax({
             url: "../ajax/permisos.ajax.php",
                method: "POST",
                 data: datos1,
                 cache: false,
                 contentType: false,
                 processData: false,
                 dataType: 'json',
                 success: function(respuesta) {

        if (respuesta == "ok") {
            Swal.fire({
             icon: 'warning',
             title: 'Verifique...',
             text: 'El Permiso de este módulo ya fue asignado a este Rol!'         
            })            

        } else {

            var datos = new FormData();

            datos.append("accion", accion);
            datos.append("id", $("#iptIdReg").val()); //id
            datos.append("id_rol", $("#selRolReg").val()); //Nombre_Rol
            datos.append("id_modulo", $("#selModuloReg").val()); //Módulo
            datos.append("consultar", $("#iptConsultarReg").val()); //consultar
            datos.append("grabar", $("#iptGrabarReg").val()); //grabar
            datos.append("actualizar", $("#iptActualizarReg").val()); //actualizar
            datos.append("borrar", $("#iptBorrarReg").val()); //Borrar
            $.ajax({
                url: "../ajax/permisos.ajax.php",
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
             $("#mdlGestionarPermisos").modal('hide');
            
             $("#iptIdReg").val("");
             $("#selRolReg").val(0);
             $("#selModuloReg").val(0);
             $("#iptConsultarReg").val("");
             $("#iptGrabarReg").val("");
             $("#iptActualizarReg").val("");
             $("#iptBorrarReg").val("");
            

            } else {
                Toast.fire({
                icon: 'error',
                title: 'El Permiso no se pudo registrar'
                });
            }

             } // cierra la funcion de respuesta del ajax
             }); // cierra el ajax de grabar el permiso
           
            }// cierra la pregunta si lo encuentra por rol y modulo

         } // cierra el ajax de busqueda por rol y modulo de la funcion respuesta
            }); // cierra el ajax de busqueda por rol y modulo con parentesis
            
            } // cierra if (result.isConfirmed)
        }) // then((result) => {
        } // cierra el else cuando no encuentra el id del permiso
     } //  success: function(respuesta) {
        }); //$.ajax({ de busqueda por id del permiso
    } //if (form.checkValidity() === true) { 
    else {
        console.log("No pasó la validación")
    }

    form.classList.add('was-validated');

    }); // var validation = Array.prototype.filter.call(forms, function(form) {
});
/*===================================================================*/
//EVENTO QUE GUARDA LAS MODIFICACIONES LOS DATOS DE LOS PERMISOS
/*===================================================================*/
document.getElementById("btnGuardarPermisom").addEventListener("click", function() {

// Get the forms we want to add validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {

    if (form.checkValidity() === true) {   

       // console.log("Listo para registrar el Permiso")
             if(accion == 4){
                    var titulo_msj = "El Permiso se actualizó correctamente";
                    var tituloswal ="Está seguro de Modificar el Permiso?";
                    var titulobutton ="Si, deseo modificarlo!";
                }
                if(accion == 2){
                    var titulo_msj = "El Permiso se registró correctamente";
                    var tituloswal ="Está seguro de guardar el Permiso?";
                    var titulobutton ="Si, deseo registrarlo!";
                }
        Swal.fire({
            title: tituloswal,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: titulobutton,
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var datos = new FormData();

                datos.append("accion", accion);
                datos.append("id", $("#iptIdRegm").val()); //id
                datos.append("id_rol", $("#selRolRegm").val()); //Nombre_Rol
                datos.append("id_modulo", $("#selModuloRegm").val()); //Módulo
                datos.append("consultar", $("#iptConsultarRegm").val()); //consultar
                datos.append("grabar", $("#iptGrabarRegm").val()); //grabar
                datos.append("actualizar", $("#iptActualizarRegm").val()); //actualizar
                datos.append("borrar", $("#iptBorrarRegm").val()); //Borrar
                $.ajax({
                    url: "../ajax/permisos.ajax.php",
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
                            $("#mdlGestionarPermisosm").modal('hide');
                            
                            $("#iptIdRegm").val("");
                            $("#selRolRegm").val(0);
                            $("#selModuloRegm").val(0);
                            $("#iptConsultarRegm").val("");
                            $("#iptGrabarRegm").val("");
                            $("#iptActualizarRegm").val("");
                            $("#iptBorrarRegm").val("");
                            

                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'El Permiso no se pudo registrar'
                            });
                        }

                    }
                });

            }
        })
    }else {
        console.log("No pasó la validación")
    }

    form.classList.add('was-validated');

});
});


/*===================================================================*/
//EVENTO QUE LIMPIA LOS MENSAJES DE ALERTA DE INGRESO DE DATOS DE CADA INPUT AL CANCELAR LA VENTANA MODAL
/*===================================================================*/
document.getElementById("btnCancelarRegistro").addEventListener("click", function() {
$(".needs-validation").removeClass("was-validated");
})

</script>
