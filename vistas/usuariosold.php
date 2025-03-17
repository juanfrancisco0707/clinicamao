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
 <!-- DataTable de Expedientes headers -->
        <div class="col-lg-12">
            <table id="tbl_expedientes" class="table table-striped w-100 shadow">
                <thead class="bg-info">
                    <tr style="font-size: 12px;">
                        <th></th>
                        <th>id</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Roles</th>
                        <th>Estatus</th>                     
                        <th class="text-cetner">Opciones</th>
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
<!-- Ventana Modal para ingresar o modificar los Expedientes de los Pacientes -->
<div class="modal fade" id="mdlGestionarExpedientes" role="dialog">

    <div class="modal-dialog modal-lg">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Agregar-Modificar Expediente de Pacientes</h5>

                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModalEx">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal EXPEDIENTE-->
            <div class="modal-body">
    
                <form class="needs-validation" novalidate >
                    <!-- Abrimos una fila -->
                    <div class="row">

                        <!-- Columna para registro del Identificador del Expediente-->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptId_ExpedienteReg"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Identificador</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptId_ExpedienteReg"
                                    name="iptId_Expediente" placeholder="Número de Expediente" required>
                                <div class="invalid-feedback">Debe ingresar el # de expediente</div>
                            </div>
                        </div>
                      
                        <!-- Columna para registro del Nombre del Paciente -->
                        <div class="col-12">
                            <div class="form-group mb-2">
                            <label class="" for="selPacienteReg"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Nombre del Paciente</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selPacienteReg" required>
                                </select>
                                <div class="invalid-feedback">Seleccione el Paciente</div>



                              <!--  <label class="" for="iptNombreReg"><i
                                        class="fas fa-file-signature fs-6"></i> <span
                                        class="small">Nombre del Paciente</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptNombreReg"
                                    placeholder="Nombre del Paciente" required> -->
                            </div>
                        </div>
                        <!-- Columna para registro del Representante del Paciente -->
                        <div class="col-12  col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="selRepresentanteReg"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Representante</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selRepresentanteReg" required>
                                </select>
                                <div class="invalid-feedback">Seleccione el representante del Paciente</div>
                            </div>
                        </div>
                         <!-- Columna para registro de firma del contrato-->
                                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptFirmo_ContratoReg"> <span class="small">Firmó Contrato</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptFirmo_ContratoReg"
                                 placeholder="Verificar si firmó Contrato" required>
                                 <div class="invalid-feedback">Debe ingresar si firmó Contrato</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la Fecha de Ingreso-->
                    
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptFecha_IngresoReg"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Fecha de Ingreso</span>
                                        <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="iptFecha_IngresoReg"
                                    placeholder="Fecha de Ingreso"  required>
                                <div class="invalid-feedback">Debe ingresar Fecha de Ingreso</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la Hora de Ingreso-->
                    
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptHora_IngresoReg"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Hora de Ingreso</span>
                                        <span class="text-danger">*</span></label>
                                <input type="time" class="form-control form-control-sm" id="iptHora_IngresoReg"
                                    placeholder="Hora de Ingreso"  required>
                                <div class="invalid-feedback">Debe ingresar Hora de Ingreso</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la fecha de salida -->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptFecha_SalidaReg"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Fecha de Salida</span>
                                        <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="iptFecha_SalidaReg"
                                    placeholder="Fecha de Salida"  >
                                <div class="invalid-feedback">Debe ingresar Fecha de Salida</div>
                            </div>
                        </div>
                        <!-- Columna para registro del tiempo de duracion internado el Paciente -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptTiempo_DuracionReg"><i class="fas fa-plus-circle fs-6"></i>
                                    <span class="small">Tiempo de duración en meses</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptTiempo_DuracionReg"
                                    placeholder="Tiempo de duración" disabled>
                               <!-- <div class="invalid-feedback">Debe ingresar el tiempo de duración</div>-->
                            </div>
                        </div>
                    
                        <!-- Columna para registro de la cuota de Ingreso-->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptCuota_IngresoReg"><i
                                        class="fas fa-dollar-sign fs-6"></i> <span class="small">Cuota de Ingreso</span><span class="text-danger">*</span></label>
                                <input type="text" min="0" class="form-control form-control-sm" id="iptCuota_IngresoReg"
                                    placeholder="Cuota de Ingreso" required>
                                <div class="invalid-feedback">Debe ingresar la Cuota de Ingreso</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptCuota_SemanalReg"><i
                                        class="fas fa-dollar-sign fs-6"></i> <span class="small">Cuota Semanal</span><span class="text-danger">*</span></label>
                                <input type="text" min="0" class="form-control form-control-sm" id="iptCuota_SemanalReg"
                                    placeholder="Cuota de pago Semanal" required>
                                <div class="invalid-feedback">Debe ingresar la Cuota de pago semanal</div>
                            </div>
                        </div>
                         <!-- Columna para registro del Testigo -->
                         <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptTestigoReg"><i
                                        class="fas fa-minus-circle fs-6"></i> <span class="small">Tetigo</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptTestigoReg"
                                    placeholder="Testigo" required>
                                <div class="invalid-feedback">Debe ingresar el Testigo</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                            <label class="" for="iptEstatusReg"><i
                                        class="fas fa-minus-circle fs-6"></i> <span class="small">Estatus</span><span class="text-danger">*</span></label>
                                        <select name="estatus" class="form-control form-control-sm" id ="iptEstatusReg" required>
                                         <option>Activo</option>
                                         <option>Baja</option>
                                         <option>Suspendido</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar el estatus</div>
                            </div>
                        </div>
                         <!-- Columna para registro de la Fecha de Salida-->
                    
                         
                        </div>
                        <!-- creacion de botones para cancelar y guardar el Expediente -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarExpediente">Guardar Expediente</button>
                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->
                        </div>
                    </div>
                </form>
            
            </div>

        </div>
    </div>


</div>
<!-- /. Fin de Ventana Modal para ingreso de Expedientes de Pacientes -->

<!-- /.content -->
<!-- Ventana Modal para modificar los Expedientes de los Pacientes -->
<div class="modal fade" id="mdlGestionarExpedientesM" role="dialog">

    <div class="modal-dialog modal-lg">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Modificar Expediente de Pacientes</h5>

                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModalEx">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal EXPEDIENTE-->
            <div class="modal-body">
    
                <form class="needs-validation" novalidate >
                    <!-- Abrimos una fila -->
                    <div class="row">

                        <!-- Columna para registro del Identificador del Expediente-->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptId_ExpedienteRegm"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Identificador</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptId_ExpedienteRegm"
                                    name="iptId_Expedientem" placeholder="Número de Expediente" required>
                                <div class="invalid-feedback">Debe ingresar el # de expediente</div>
                            </div>
                        </div>
                      
                        <!-- Columna para registro del Nombre del Paciente -->
                        <div class="col-12">
                            <div class="form-group mb-2">
                            <label class="" for="selPacienteRegm"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Nombre del Paciente</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selPacienteRegm" required>
                                </select>
                                <div class="invalid-feedback">Seleccione el Paciente</div>



                              <!--  <label class="" for="iptNombreReg"><i
                                        class="fas fa-file-signature fs-6"></i> <span
                                        class="small">Nombre del Paciente</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptNombreReg"
                                    placeholder="Nombre del Paciente" required> -->
                            </div>
                        </div>
                        <!-- Columna para registro del Representante del Paciente -->
                        <div class="col-12  col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="selRepresentanteRegm"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Representante</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selRepresentanteRegm" required>
                                </select>
                                <div class="invalid-feedback">Seleccione el representante del Paciente</div>
                            </div>
                        </div>
                         <!-- Columna para registro de firma del contrato-->
                                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptFirmo_ContratoRegm"> <span class="small">Firmó Contrato</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptFirmo_ContratoRegm"
                                 placeholder="Verificar si firmó Contrato" required>
                                 <div class="invalid-feedback">Debe ingresar si firmó Contrato</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la Fecha de Ingreso-->
                    
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptFecha_IngresoRegm"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Fecha de Ingreso</span>
                                        <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="iptFecha_IngresoRegm"
                                    placeholder="Fecha de Ingreso"  required>
                                <div class="invalid-feedback">Debe ingresar Fecha de Ingreso</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la Hora de Ingreso-->
                    
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptHora_IngresoRegm"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Hora de Ingreso</span>
                                        <span class="text-danger">*</span></label>
                                <input type="time" class="form-control form-control-sm" id="iptHora_IngresoRegm"
                                    placeholder="Hora de Ingreso"  required>
                                <div class="invalid-feedback">Debe ingresar Hora de Ingreso</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la fecha de salida -->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptFecha_SalidaRegm"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Fecha de Salida</span>
                                        <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="iptFecha_SalidaRegm"
                                    placeholder="Fecha de Salida"  >
                                <div class="invalid-feedback">Debe ingresar Fecha de Salida</div>
                            </div>
                        </div>
                        <!-- Columna para registro del tiempo de duracion internado el Paciente -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptTiempo_DuracionRegm"><i class="fas fa-plus-circle fs-6"></i>
                                    <span class="small">Tiempo de duración en meses</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptTiempo_DuracionRegm"
                                    placeholder="Tiempo de duración" disabled>
                               <!-- <div class="invalid-feedback">Debe ingresar el tiempo de duración</div>-->
                            </div>
                        </div>
                    
                        <!-- Columna para registro de la cuota de Ingreso-->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptCuota_IngresoRegm"><i
                                        class="fas fa-dollar-sign fs-6"></i> <span class="small">Cuota de Ingreso</span><span class="text-danger">*</span></label>
                                <input type="text" min="0" class="form-control form-control-sm" id="iptCuota_IngresoRegm"
                                    placeholder="Cuota de Ingreso" required>
                                <div class="invalid-feedback">Debe ingresar la Cuota de Ingreso</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptCuota_SemanalRegm"><i
                                        class="fas fa-dollar-sign fs-6"></i> <span class="small">Cuota Semanal</span><span class="text-danger">*</span></label>
                                <input type="text" min="0" class="form-control form-control-sm" id="iptCuota_SemanalRegm"
                                    placeholder="Cuota de pago Semanal" required>
                                <div class="invalid-feedback">Debe ingresar la Cuota de pago semanal</div>
                            </div>
                        </div>
                         <!-- Columna para registro del Testigo -->
                         <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptTestigoRegm"><i
                                        class="fas fa-minus-circle fs-6"></i> <span class="small">Tetigo</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptTestigoRegm"
                                    placeholder="Testigo" required>
                                <div class="invalid-feedback">Debe ingresar el Testigo</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                            <label class="" for="iptEstatusRegm"><i
                                        class="fas fa-minus-circle fs-6"></i> <span class="small">Estatus</span><span class="text-danger">*</span></label>
                                        <select name="estatus" class="form-control form-control-sm" id ="iptEstatusRegm" required>
                                         <option>Activo</option>
                                         <option>Baja</option>
                                         <option>Suspendido</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar el estatus</div>
                            </div>
                        </div>
                         <!-- Columna para registro de la Fecha de Salida-->
                    
                         
                        </div>
                        <!-- creacion de botones para cancelar y guardar el Expediente -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistrom">Cancelar</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarExpedientem">Guardar Expediente</button>
                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->
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
    //SOLICITUD AJAX PARA CARGAR SELECT DE REPRESENTANTES DEL PACIENTE
    /*===================================================================*/
    $.ajax({
        url: "../ajax/representantes.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione un representante</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selRepresentanteReg").append(options);
        }
    });
    /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE REPRESENTANTES DEL PACIENTE
    /*===================================================================*/
    $.ajax({
        url: "../ajax/representantes.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione un representante</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selRepresentanteRegm").append(options);
        }
    });
     /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE LOS PACIENTES AGREGAR UNO NUEVO
    /*===================================================================*/
    $.ajax({
        url: "../ajax/pacientescb.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione un paciente</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selPacienteReg").append(options);
        }
    });
       /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE LOS PACIENTES MODIFICAR
    /*===================================================================*/
    $.ajax({
        url: "../ajax/pacientescbfull.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione un paciente</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selPacienteRegm").append(options);
        }
    });
    /*===================================================================*/
    // CARGA DEL LISTADO CON EL PLUGIN DATATABLE JS
    /*===================================================================*/
    table = $("#tbl_expedientes").DataTable({
        dom: 'Bfrtip', // Para que los botones se pongan en la parte Superior
        buttons: [{
                text: 'Agregar Expediente',
                className: 'addNewRecord',
                action: function(e, dt, node, config) {
                    $("#mdlGestionarExpedientes").modal('show');
                   accion = 2; //registrar
                }
            },
            {
                extend: 'excel',
                text: 'Excel',
                title: 'Listado de Expedientes'
            },
            {
                extend: 'print', 
                text: 'Imprimir',
                title: 'Listado de Expedientes'},
            {
                extend:'pageLength',
                text: 'Longitud de la página'
            }
        ],
        pageLength: [[5, 10, 15, 30, 50], 
                    ['5 Filas','10 Filas','15 Filas','30 Filas','50 Filas','Mostrar todo']], 
        pageLength: 10,

        ajax: {
            url: "../ajax/expedientes.ajax.php",
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
                targets: 2, // no muestre el id del paciente
                visible: false
            },
            {
                targets: 4, // no muestra el id del representante
                visible: false 
            },
            {
                targets: 13, // no muestra el testigo
                visible: false 
            },
           // cambia de color para indicar e
           // {
           //     targets: 9,
           //     createdCell: function(td, cellData, rowData, row, col) {
           //        if (parseFloat(rowData[9]) <= parseFloat(rowData[10])) {
           //             $(td).parent().css('background', '#FF5733')
           //            $(td).parent().css('color', '#ffffff')
           //         }
           //     }
           // },
            
            {
                targets: 15,
                orderable: false,
                render: function(data, type, full, meta) {
                    return "<center>" +
                        "<span class='btnEditarExpediente text-success px-1' style='cursor:pointer;'>" +
                        "<i class='fas fa-book fs-5'></i>" +
                        "</span>" +
                        "<span class='btnEliminarExpediente text-danger px-1' style='cursor:pointer;'>" +
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
            url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            // con esto se cambia al idioma español de los elementos del datatable
        }
    });

    /*===================================================================*/
    // EVENTOS PARA CRITERIOS DE BUSQUEDA (ID, NOMBRE Y DIRECCION)
    /*===================================================================*/
    $("#iptId").keyup(function() {
        table.column($(this).data('index')).search(this.value).draw();
    })

    $("#iptNombre").keyup(function() {
        table.column($(this).data('index')).search(this.value).draw();
    })

    $("#iptDireccion").keyup(function() {
        table.column($(this).data('index')).search(this.value).draw();
    })

    /*===================================================================*/
    // EVENTOS PARA CRITERIOS DE BUSQUEDA POR RANGO (PREVIO VENTA)
    /*===================================================================*/
    $("#iptPrecioVentaDesde, #iptPrecioVentaHasta").keyup(function() {
        table.draw();
    })

    $.fn.dataTable.ext.search.push(

        function(settings, data, dataIndex) {

            var precioDesde = parseFloat($("#iptPrecioVentaDesde").val());
            var precioHasta = parseFloat($("#iptPrecioVentaHasta").val());

            var col_venta = parseFloat(data[7]);

            if ((isNaN(precioDesde) && isNaN(precioHasta)) ||
                (isNaN(precioDesde) && col_venta <= precioHasta) ||
                (precioDesde <= col_venta && isNaN(precioHasta)) ||
                (precioDesde <= col_venta && col_venta <= precioHasta)) {
                return true;
            }

            return false;
        }
    )

    /*===================================================================*/
    // EVENTO PARA LIMPIAR INPUTS DE CRITERIOS DE BUSQUEDA
    /*===================================================================*/
    $("#btnLimpiarBusqueda").on('click', function() {

        $("#iptId").val('')
        $("#iptNombre").val('')
        $("#iptDireccion").val('')
       // $("#iptPrecioVentaDesde").val('')
       // $("#iptPrecioVentaHasta").val('')

        table.search('').columns().search('').draw();
    })

    $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {

        $("#validate_id_expediente").css("display", "none");
        $("#validate_id_paciente").css("display", "none");
        $("#validate_id_representante").css("display", "none");
        $("#validate_fecha_ingreso").css("display", "none");
        $("#validate_fecha_salida").css("display", "none");
        $("#validate_firmo_contrato").css("display", "none");
        $("#validate_tiempo_duracion").css("display", "none");
        $("#validate_hora_ingreso").css("display", "none");
        $("#validate_cuota_ingreso").css("display", "none");
        $("#validate_cuota_semanal").css("display", "none");
        $("#validate_testigo").css("display", "none");
        $("#validate_estatus").css("display", "none");

        $("#iptId_ExpedienteReg").val("");
        $("#selPacienteReg").val(0);
        $("#selRepresentanteReg").val(0);
        $("#iptFecha_IngresoReg").val("");
        $("#iptFecha_SalidaReg").val("");
        $("#iptFirmo_ContratoReg").val("");
        $("#iptTiempo_DuracionReg").val("");
        $("#iptHora_IngresoReg").val("");
        $("#iptCuota_IngresoReg").val("");
        $("#iptCuota_SemanalReg").val("");
        $("#iptTestigoReg").val("");
        $("#iptEstatusReg").val("");
      
    })

    

    /*===================================================================*/
    //EVENTO PARA CALCULAR LA EDAD AL CAMBIAR EL CONTENIDO (PERDER FOCUS)
    /*===================================================================*/
    $("#iptFecha_NacimientoReg").change(function() {
      
      calcularEdad();
    });
  /*===================================================================*/
    //EVENTO PARA CALCULAR LA DURACION DEL CONTRATO AL CAMBIAR EL CONTENIDO (PERDER FOCUS)
    /*===================================================================*/
    $("#iptFecha_SalidaReg").change(function() {
      
      calcularDuracion();
    });

    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON EDITAR EXPEDIENTE
    =========================================================================================*/
    $('#tbl_expedientes tbody').on('click', '.btnEditarExpediente', function() {

        accion = 4; //seteamos la accion para editar

        $("#mdlGestionarExpedientesM").modal('show');

        var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }
        console.log("🚀 ~ file: expedientes.php ~ line 736 ~ $ ~ data", data)
       
        $("#iptId_ExpedienteRegm").val(data[1]);
        $("#selPacienteRegm").val(data[2]); // se pone el id
        $("#selRepresentanteRegm").val(data[4]); // se pone la posicion del ID
        $("#iptFecha_IngresoRegm").val(data["fecha_ingreso"]);
        $("#iptFecha_SalidaRegm").val(data["fecha_salida"]);
        $("#iptFirmo_ContratoRegm").val(data["firmo_contrato"]);
        $("#iptTiempo_DuracionRegm").val(data["tiempo_duracion"]);
        $("#iptHora_IngresoRegm").val(data["hora_ingreso"]);
        $("#iptCuota_IngresoRegm").val(data["cuota_ingreso"]);
        $("#iptCuota_SemanalRegm").val(data["cuota_semanal"]);
        $("#iptTestigoRegm").val(data["testigo"]);
        $("#iptEstatusRegm").val(data["estatus"]);

    })
   
    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON ELIMINAR EXPEDIENTE
    =========================================================================================*/
    $('#tbl_expedientes tbody').on('click', '.btnEliminarExpediente', function() {
        
        accion = 5; //seteamos la accion para editar
        
        var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }

        var id_expediente = data["id_expediente"];

        Swal.fire({
            title: 'Está seguro de eliminar el Expediente?',
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
                datos.append("id_expediente", id_expediente); //id_Expediente              

                $.ajax({
                    url: "../ajax/expedientes.ajax.php",
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
                                title: 'El expedinte se eliminó correctamente'
                            });

                            table.ajax.reload();

                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'El expediente no se pudo eliminar'
                            });
                        }

                    }
                });

            }
        })
    })
        

});

/*===================================================================*/
//EVENTO QUE GUARDA LOS DATOS DEL Paciente, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/
document.getElementById("btnGuardarExpediente").addEventListener("click", function() {
                         
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
        //calcularedad();
        if (form.checkValidity() === true) {   

           // console.log("Listo para registrar el paciente")
            if(accion == 4){
                $mensaje='Está seguro de Modificar el Expediente?';
                $confirmar='Si, deseo Modificarlo!';
            }
            if (accion==2){
                $mensaje='Está seguro de registrar el Expediente?';
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
                    var num = $("#iptCuota_IngresoReg").val().replace(/\,/g,'');
                    var num2 = $("#iptCuota_SemanalReg").val().replace(/\,/g,'');
                    datos.append("accion", accion);
                    datos.append("id_expediente", $("#iptId_ExpedienteReg").val()); //id_Expediente
                    datos.append("id_paciente", $("#selPacienteReg").val()); //Id Paciente
                    datos.append("id_representante", $("#selRepresentanteReg").val()); //Id_representante
                    datos.append("fecha_ingreso", $("#iptFecha_IngresoReg").val()); //Fecha_Ingreso_Paciente
                    datos.append("fecha_salida", $("#iptFecha_SalidaReg").val()); //Fecha_Salida_Paciente
                    datos.append("firmo_contrato", $("#iptFirmo_ContratoReg").val()); //Firmó Contrato
                    datos.append("tiempo_duracion", $("#iptTiempo_DuracionReg").val()); //Duración_Paciente
                    datos.append("hora_ingreso", $("#iptHora_IngresoReg").val()); //Hora de Ingreso del Paciente
                    datos.append("cuota_ingreso", num); //Cuota de Ingreso
                    datos.append("cuota_semanal", num2); //Cuota_Semanal 
                    datos.append("testigo", $("#iptTestigoReg").val()); //Testigo
                    datos.append("estatus", $("#iptEstatusReg").val()); //Estatus
                    

                    

                    if(accion == 2){
                        var titulo_msj = "El Expediente se registró correctamente"
                    }

                    if(accion == 4){
                        var titulo_msj = "El expediente se actualizó correctamente"
                    }

                    $.ajax({
                        url: "../ajax/expedientes.ajax.php",
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

                                $("#mdlGestionarExpediente").modal('hide');

                                $("#selPacienteReg").val(0);
                                $("#selRepresentanteReg").val(0);
                                $("#iptFecha_IngresoReg").val("");
                                $("#iptFecha_SalidaReg").val("");
                                $("#iptFirmo_ContratoReg").val("");
                                $("#iptTiempo_DuracionReg").val("");
                                $("#iptHora_IngresoReg").val("");
                                $("#iptCuota_IngresoReg").val("");
                                $("#iptCuota_SemanalReg").val("");
                                $("#iptTestigoReg").val("");
                                $("#iptEstatus").val("");
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'El Expediente no se pudo registrar'
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
//EVENTO QUE GUARDA LOS DATOS DEL Paciente, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/
document.getElementById("btnGuardarExpedientem").addEventListener("click", function() {
                         
                         // Get the forms we want to add validation styles to
                         var forms = document.getElementsByClassName('needs-validation');
                         // Loop over them and prevent submission
                         var validation = Array.prototype.filter.call(forms, function(form) {
                             //calcularedad();
                             if (form.checkValidity() === true) {   
                     
                                // console.log("Listo para registrar el paciente")
                                 if(accion == 4){
                                     $mensaje='Está seguro de Modificar el Expediente?';
                                     $confirmar='Si, deseo Modificarlo!';
                                 }
                                 if (accion==2){
                                     $mensaje='Está seguro de registrar el Expediente?';
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
                                         var num = $("#iptCuota_IngresoRegm").val().replace(/\,/g,'');
                                         var num2 = $("#iptCuota_SemanalRegm").val().replace(/\,/g,'');
                                         datos.append("accion", accion);
                                         datos.append("id_expediente", $("#iptId_ExpedienteRegm").val()); //id_Expediente
                                         datos.append("id_paciente", $("#selPacienteRegm").val()); //Id Paciente
                                         datos.append("id_representante", $("#selRepresentanteRegm").val()); //Id_representante
                                         datos.append("fecha_ingreso", $("#iptFecha_IngresoRegm").val()); //Fecha_Ingreso_Paciente
                                         datos.append("fecha_salida", $("#iptFecha_SalidaRegm").val()); //Fecha_Salida_Paciente
                                         datos.append("firmo_contrato", $("#iptFirmo_ContratoRegm").val()); //Firmó Contrato
                                         datos.append("tiempo_duracion", $("#iptTiempo_DuracionRegm").val()); //Duración_Paciente
                                         datos.append("hora_ingreso", $("#iptHora_IngresoRegm").val()); //Hora de Ingreso del Paciente
                                         datos.append("cuota_ingreso", num); //Cuota de Ingreso
                                         datos.append("cuota_semanal", num2); //Cuota_Semanal 
                                         datos.append("testigo", $("#iptTestigoRegm").val()); //Testigo
                                         datos.append("estatus", $("#iptEstatusRegm").val()); //Estatus
                                         
                     
                                         
                     
                                         if(accion == 2){
                                             var titulo_msj = "El Expediente se registró correctamente"
                                         }
                     
                                         if(accion == 4){
                                             var titulo_msj = "El expediente se actualizó correctamente"
                                         }
                     
                                         $.ajax({
                                             url: "../ajax/expedientes.ajax.php",
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
                     
                                                     $("#mdlGestionarExpedientem").modal('hide');
                     
                                                     $("#selPacienteRegm").val(0);
                                                     $("#selRepresentanteRegm").val(0);
                                                     $("#iptFecha_IngresoRegm").val("");
                                                     $("#iptFecha_SalidaRegm").val("");
                                                     $("#iptFirmo_ContratoRegm").val("");
                                                     $("#iptTiempo_DuracionRegm").val("");
                                                     $("#iptHora_IngresoRegm").val("");
                                                     $("#iptCuota_IngresoRegm").val("");
                                                     $("#iptCuota_SemanalRegm").val("");
                                                     $("#iptTestigoRegm").val("");
                                                     $("#iptEstatusm").val("");
                                                 } else {
                                                     Toast.fire({
                                                         icon: 'error',
                                                         title: 'El Expediente no se pudo Modificar'
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
//EVENTO QUE GUARDA LOS DATOS DEL EXPEDIENTE, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================
document.getElementById("btnGuardarExpediente").addEventListener("click", function() {

// Get the forms we want to add validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {
    
    if (form.checkValidity() === true) {   

       // console.log("Listo para registrar el paciente")
        if(accion == 9){
            $mensaje='Está seguro de Modificar el expediente del paciente?';
            $confirmar='Si, deseo Modificarlo!';
        }
        if (accion==8){
            $mensaje='Está seguro de registrar el expediente del paciente?';
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
// Expediente
                datos.append("accion", accion);
                datos.append("id_Expediente", $("#iptId_ExpedienteReg").val()); //id_Expediente
                datos.append("id_paciente", $("#selId_PacienteReg").val()); //id_Paciente
                datos.append("id_representante", $("#selId_RepresentanteReg").val()); //id_Paciente
                datos.append("fecha_ingreso", $("#iptFecha_IngresoReg").val()); //Fecha_Ingreso_Paciente
                datos.append("hora_ingreso", $("#iptHora_IngresoReg").val()); //Hora_Ingreso_Paciente
                datos.append("firmo_contrato", $("#iptFirmo_ContratoReg").val()); //Firmó contrato el Paciente
                datos.append("tiempo_duracion", $("#iptTiempo_DuracionReg").val()); //Duración del contrato del Paciente
                datos.append("cuota_ingreso", $("#iptCuota_IngresoReg").val()); //Estado Civil
                datos.append("cuota_semanal", $("#iptCuota_SemanalReg").val()); //Escolaridad
                datos.append("testigo", $("#iptTestigoReg").val()); //Id_ocupacion 
                datos.append("estatus", $("#iptEstatusReg").val()); //Id_Nacionalidad
                if(accion == 2){
                    var titulo_msj = "El Expediente se registró correctamente"
                }

                if(accion == 4){
                    var titulo_msj = "El expediente se actualizó correctamente"
                }

                $.ajax({
                    url: "../ajax/expediente.ajax.php",
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

                            $("#mdlGestionarPaciente").modal('hide');

                            $("#iptNombreReg").val("");
                            $("#iptSexoReg").val("");
                            $("#iptFechaNacimientoReg").val("");
                            $("#iptEdadReg").val("");
                            $("#iptDireccionReg").val("");
                            $("#iptEstadoCivilReg").val("");
                            $("#iptEscolaridadReg").val("");
                            $("#selOcupacionReg").val(0);
                            $("#selNacionalidadReg").val(0);
                            $("#iptComorbilidadReg").val("");
                            $("#selEmpresaReg").val(0);
                            $("#iptEstatus").val(0);
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'El paciente no se pudo registrar'
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
*/

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

    iptFecha_IngresoReg
    var fecha1 = moment(fechai);
    var fecha2 = moment(fechas);
    $("#iptTiempo_DuracionReg").val(fecha2.diff(fecha1, 'months'));
//console.log(fecha2.diff(fecha1, 'days'), ' dias de diferencia');
}


</script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>
         

