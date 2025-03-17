<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../index.php');
}
?>

 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Expedientes</h1>
                 <p id="clinica" value='<?php echo $_SESSION['S_CLINICA']; ?>'></p>
                <input type="hidden" id="vclinica" name="vclinica" value='<?php echo $_SESSION['S_CLINICA']; ?>'/> 
                <input type="hidden" id="vrolusu" name="vrolusu" value='<?php echo $_SESSION['S_ROL']; ?>'/>
                <input type="hidden" id="iptId_ClinicaRegs" name="vclinica" value='<?php echo $_SESSION['S_IDCLINICA']; ?>'/> 
                  
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Expedientes</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>


 <!-- /.content-header -->
  <!-- Main content -->
<div class="content">

<div class="container-fluid"> 
 <!-- DataTable de Expedientes headers -->
        <div class="col-lg-12">
       
            <table id="tbl_expedientes" class="table table-striped w-100 shadow">
                <thead class="bg-info">
                    <tr style="font-size: 13px;">
                        <th></th>
                        <th>No.</th>
                        <th>No.Clínica</th>
                        <th>Id Paciente</th>
                        <th>Paciente</th>
                        <th>Id Representante</th>
                        <th>Representante</th>
                        <th>Teléfono</th>
                        <th>Fecha de ingreso</th>
                        <th>Hora de ingreso</th>
                        <th>Fecha de salida</th>
                        <th>Tiempo de duración</th>
                        <th>Firmó contrato</th> 
                        <th>Cuota de ingreso</th>
                        <th>Cuota semanal</th>
                        <th>Extras</th>
                        <th>Testigo</th>
                        <th>Estatus</th>

                        <th>Tipo Ingreso</th>
                        <th>Refiere Institución</th>
                        <th>Motivo de Ingreos</th>
                        <th>Folio del M.P.</th>
                        <th>Operador M.P.</th>
                        <th>Descripción de Salud del Paciente</th>

                        <th>Id Consumo</th>
                        <th>Sustancia que Consume</th>
                        <th>Mesicamentos</th>
                        <th>Terapia Individual</th>
                        <th>Terapia Ocupacional</th>

                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody class="text-small">
                </tbody>
            </table>
        </div>
    </div>

</div><!-- /.container-fluid -->

<!-- /.content -->
<!-- Ventana Modal para ingresar  los Expedientes de los Pacientes -->
<div class="modal fade" id="mdlGestionarExpedientesServiciosee" role="dialog">
    

    <div class="modal-dialog modal-xl">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Datos del servicio de atención</h5>

                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModalServicio">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal EXPEDIENTE-->
            <div class="modal-body">
                <form class="needs-validation" novalidate >
                    <!-- Abrimos una fila -->
                    <div class="row">

                        <!-- Columna para registro del Identificador del Expediente-->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptId_ExpedienteRegs"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Número de Expediente</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptId_ExpedienteRegs"
                                    name="iptId_Expediente" placeholder="Número de Expediente" disabled>
                                <div class="invalid-feedback">Debe ingresar el # de expediente</div>
                            </div>
                        </div>
                      
                        <!-- Columna para registro del Nombre del Paciente -->
                        <div class="col-12 col-lg-8">
                            <div class="form-group mb-2">
                            <label class="" for="selPacienteRegs"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Nombre del Paciente</span><span class="text-danger">*</span>
                                </label>
                              <!--  <select class="form-control" data-live-search="true" id="selPacienteReg" name="selPacienteReg" required > -->
                              <input type="text" class="form-control form-control-sm" id="selPacienteRegs"
                                 placeholder="Paciente" disabled>
                                <div class="invalid-feedback">Seleccione el Paciente</div>

                            </div>
                        </div>
                        <!-- Columna para registro del motivo de la atención médica -->
                        <div class="col-12  col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptMotivo_AtencionRegs"><i class="fas fa-dumpster fs-6"></i>
                                <span class="small">Motivo de Atención</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="iptMotivo_AtencionRegs"
                                 placeholder="Motivo de Atención">
                                 <div class="invalid-feedback">Debe ingresar el motivo de la atención</div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                         <!-- Columna para registro de Reporte de Lesiones-->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptReporte_LesionesRegs"> <span class="small">Reporte de lesiones</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptReporte_LesionesRegs"
                                 placeholder="Reporte de lesiones">
                                 <div class="invalid-feedback">Debe ingresar si cuenta con reporte de lesiones</div>
                            </div>
                        </div>
                        <!-- Columna para registro de fecha de la notificación-->
                    
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptFecha_NotificacionRegs"><i
                                class="fa fa-calendar-plus-o"></i> <span class="small">Fecha de notificación</span>
                                        <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="iptFecha_NotificacionRegs"
                                    placeholder="Fecha de la Notaficación">
                                <div class="invalid-feedback">Debe ingresar la Fecha de Notificación</div>
                            </div>
                        </div>
                        <!-- Columna para registro del diagnóstico-->
                    
                        <div class="col-12 col-lg-10">
                            <div class="form-group mb-2">
                                <label class="" for="iptDiagnosticoRegs"><i
                                class="fa fa-clock-o"></i> <span class="small">Diagnóstico</span>
                                        <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptDiagnosticoRegs"
                                    placeholder="Diagnóstico médico">
                                <div class="invalid-feedback">Debe ingresar el diagnóstico médico</div>
                            </div>
                        </div>
                           <!-- Columna para registro del plan terapéutico -->
                           <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="selectplan"><i
                                class="fa fa-clock-o"></i> <span class="small">Servicio Médico</span>
                                        <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" id="selectplan" multiple="multiple" required>
                                       <option value="farmaco">Farmacoterapia</option>
                                        <option value="examenes">Exámenes deLaboratorio</option>
                                        <option value="terapia">Terapia Psicológica</option>
                                        <option value="consejeria">Consejería</option>
                                        <option value="canalizacion">Canalización</option> 
                                    </select>
                            <div class="invalid-feedback">Debe ingresar servicios de atención médica</div>
                            </div>
                        </div>
                        <!-- Columna para registro del pronóstico -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptPronosticoRegs"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Pronóstico</span>
                                        <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptPronosticoRegs"
                                    placeholder="Pronóstico">
                                <div class="invalid-feedback">Debe ingresar el pronóstico Médico</div>
                            </div>
                        </div>
                        
                        <!-- Columna para registro de la cédula del médico -->
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptCedula_MedicoRegs"><i class="fas fa-plus-circle fs-6"></i>
                                    <span class="small">Cédula del médico</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptCedula_MedicoRegs"
                                    placeholder="Cédula Profesional del Médico" required>
                               <!-- <div class="invalid-feedback">Debe ingresar el tiempo de duración</div>-->
                            </div>
                        </div>
                       <!-- Columna para registro del nombre del médico-->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-4">
                                <label class="" for="iptNombre_MedicoRegs"><i
                                        class="fas fa-user fs-6"></i> <span class="small">Nombre del Médico</span><span class="text-danger">*</span></label>
                                <input type="text" min="0" class="form-control form-control-sm" id="iptNombre_MedicoRegs"
                                    placeholder="Nombre del Médico" required>
                                <div class="invalid-feedback">Debe ingresar el nombre del Médico</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la Duración promedio del servicio de atencion residencial-->
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptDuracion_ConsultaRegs"><i
                                        class="fas calendar fs-6"></i> <span class="small">Duración promedio</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptDuracion_ConsultaRegs"
                                    placeholder="Duración promedio del servicio de atención">
                                <div class="invalid-feedback">Duración Promedio del Servicio de atención residencial</div>
                            </div>
                        </div>
                      
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptAgencia_MpRegs"><i
                                        class="fas  fs-6"></i> <span class="small">Agencia del Ministerio Público</span><span class="text-danger"></span></label>
                                <input type="text" class="form-control form-control-sm" id="iptAgencia_MpRegs"
                                    placeholder="Agencia del Ministerio Público">
                                <div class="invalid-feedback">Debe ingresar la Agencia del Ministerio Público</div>
                            </div>
                        </div>
                         <!-- Columna para registro de la Direccion de la Agencia del Ministerio Público -->
                         <div class="col-12 col-lg-8">
                            <div class="form-group mb-2">
                                <label class="" for="iptDomicilio_AgenciaRegs"><i
                                        class="fas fa-minus-circle fs-6"></i> <span class="small">Dirección de la Agencia</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptDomicilio_AgenciaRegs"
                                    placeholder="Direccion de la Agencia del M.P">
                                <div class="invalid-feedback">Debe ingresar la dirección de la Agencia del M.P</div>
                            </div>
                        </div>
                        
                       <div>
                        <!-- creacion de botones para cancelar y guardar el Expediente -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistroS">Cancelar</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarExpedienteS">Guardar Expediente</button>
                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->
                        </div>
                    </div>
                   
                </form>
               
            </div>

        </div>
    </div>


</div>





</div>
    <?php
        include "../vistas/modulos/modales.expedientes.php";
    ?>
<script>
var accion;
var table;
var fecha;
var genero_periodos;
var encontrado = false;

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
    $("#mdlGestionarExpedientes").draggable({
    handle: ".modal-header"
    }); 
    $("#mdlGestionarExpedientesM").draggable({
    handle: ".modal-header"
    }); 
    $("#mdlGestionarExpedientesn").draggable({
    handle: ".modal-header"
    }); 
    $("#mdlGestionarExpedientesServiciosee").draggable({
    handle: ".modal-header"
    }); 

    $('#selectplan').multiselect({
        includeSelectAllOption:true,
        nonSelectedText:'Seleccione Opcion(es)',
        buttonWidth:'500px'
    });
    //$('#selectplan').multiselect('select', ['farmacoterapia', 'examenes']);
    /*{
        includeSelectAllOption:true,
        nonSelectedText:'Seleccione Opciones',
        buttonWidth:'500px'
    } */
    /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE REPRESENTANTES DEL PACIENTE
    /*===================================================================*/
    $.ajax({
        url: "../ajax/representantescb.ajax.php",
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
        url: "../ajax/representantescb.ajax.php",
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

            $("#selRepresentanteRegn").append(options);
        }
    });
    /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE REPRESENTANTES DEL PACIENTE
    /*===================================================================*/

    $.ajax({
        url: "../ajax/representantescb.ajax.php",
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
    //SOLICITUD AJAX PARA CARGAR SELECT DE DROGAS DEL PACIENTE
    /*===================================================================*/
    $.ajax({
        url: "../ajax/drogascb.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione una sustancia</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selDrogasReg").append(options);
        }
    });
     /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE DROGAS DEL PACIENTE
    /*===================================================================*/
    $.ajax({
        url: "../ajax/drogascb.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione una sustancia</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selDrogasRegm").append(options);
        }
    });
     /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR EL MULTISELECT
    /*===================================================================*/
    /*$.ajax({
        url: "../ajax/plan_terapeutico.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione un plan Terapéutico</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }
            //alert(" datos : " + options);
            $("#selectplan").append(options);
        }
    });*/

   /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE DROGAS DEL PACIENTE
    /*===================================================================*/
    $.ajax({
        url: "../ajax/drogascb.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione una sustancia</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selDrogasRegn").append(options);
        }
    });

    //$('select').selectpicker();

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
    //SOLICITUD AJAX PARA CARGAR SELECT DE LOS PACIENTES CON NUEVO EXPEDIENTE
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

            $("#selPacienteRegn").append(options);
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

                    $.ajax({

                        async: false,
                        url: "../ajax/expedientes.ajax.php",
                        method: "POST",
                        data: {
                            
                            'accion': 11
                        },
                        dataType: 'json',
                        success: function(respuesta) {
                           
                            folio = respuesta["folio"];
                            $("#iptId_ExpedienteReg").val(folio);
                        }
                    });

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
                extend:'pageLength',
                text: 'Longitud de la página'
            },
            {
                extend: 'print', 
                text: 'Imprimir',
                title: 'Listado de Expedientes',
                exportOptions: {
                    columns:':visible'
                }
            },
            'colvis'
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
                className: 'text-right', targets: [13,14]
            },
            {
                targets: 2, // no muestre el id del paciente
                visible: false
            },
            {
                targets: 3, // no muestre el id del paciente
                visible: false
            },
            {
                targets: 5, // no muestra el id del representante
                visible: false 
            },
            {
                targets: 7, // centra el teléfono
                className: 'dt-body-center',
                className: 'text-center'
            } ,
            {
                targets: 8, // centra la fecha de ingreso
                className: 'dt-body-center',
                className: 'text-center'
            },
            {
                targets: 9, // no muestra el id del representante
                visible: false 
            },
            {
                targets: 10, // fecha de salida
                visible: false 
            },
            {
                targets: 11, // centra tiempo de duración
               // visible: false 
                className: 'dt-body-center',
                className: 'text-center'
            },
            {
                targets: 12, // firma de contrato
                visible: false 
            },
            {
                targets: 13, // cuota mensual
                className: 'dt-body-right',
                render: $.fn.dataTable.render.number( ',', '.', 0, '$ ' )
            },
            {
                targets: 14, // cuota semanal
                className: 'dt-body-right',
                 render: $.fn.dataTable.render.number( ',', '.', 0, '$ ' )

            },
            {
                targets: 15, // cuota semanal
                className: 'dt-body-right',
                 render: $.fn.dataTable.render.number( ',', '.', 0, '$ ' )

            },
            {
                targets: 16, // no muestra el testigo
                visible: false 
            },
            {
                targets: 17, // estatus
                className: 'dt-body-center',
                      createdCell: function(td, cellData, rowData, row, col) {
                   if ((rowData[17]) == 'Baja') {
                      $(td).parent().css('background', '#FF5733')
                      $(td).parent().css('color', '#ffffff')
                    }
                }
            },
            {
                targets: 18, // no muestra el tipo de ingreso
                visible: false
            },
            {
                targets: 19, // no muestre La institución que lo refiere
                visible: false
            },
            {
                targets: 20, // no muestre el motivo de ingreso
                visible: false
            },
            {
                targets: 21, // no muestre el folio del M.P
                visible: false
            },
            {
                targets: 22, // no muestre el Operador del M.P
                visible: false
            },
            {
                targets: 23, // no muestre la descripción de Salud del paciente
                visible: false
            },
            {
                targets: 24, // no muestre la descripción de Salud del paciente
                visible: false
            },
            {
                targets: 25, // no muestre la descripción de Salud del paciente
                visible: false
            },
            {
                targets: 26, // no muestre la descripción de Salud del paciente
                visible: false
            },
            {
                targets: 27, // no muestre la descripción de Salud del paciente
                visible: false
            },
            {
                targets: 28, // no muestre la descripción de Salud del paciente
                visible: false
            },
            {
                targets: 29,
                orderable: false,
                render: function(data, type, full, meta) {
                    return "<center>" +
                        "<span class='btnEditarExpediente text-warning px-2' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Expediente'> " +
                        "<i class='fas fa-book fs-6'></i>" +
                        "</span>" +
                        "<span class='btnAgregarExpediente text-success px-2' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Nuevo Expediente'> " +
                        "<i class='fas fa-plus-circle fs-6'></i>" +
                        "</span>" +
                        "<span class='btnPeriodosExpediente text-primary px-2' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Crear períodos de Pago'> " +
                        "<i class='fas fa-calendar fs-6'></i>" +
                        "</span>" +
                        "<span class='btnServicioAtencion text-primary px-2' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Datos del Servicio de atención'> " +
                        "<i class='fas fa-bed fs-6'></i>" +
                        "</span>" +
                        "<span class='btnEliminarExpediente text-danger px-2' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Expediente'> " +
                        "<i class='fas fa-trash fs-6'></i>" +
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
  //  $(function() {  
   // $('#multiselect').multiselect();
   // alert('entro');
   // });

    

    $("table.dataTable").css("font-size", 0);
            table.columns.adjust().draw();
    
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
        $("#validate_extras").css("display", "none");
        $("#validate_testigo").css("display", "none");
        $("#validate_drogas").css("display", "none");
        $("#validate_terapia_individual").css("display", "none");
        $("#validate_terapia_ocupacional").css("display", "none");
        $("#validate_medicamentos").css("display", "none");

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
        $("#iptExtrasReg").val("");
        $("#iptTestigoReg").val("");
        $("#iptEstatusReg").val("");
        $("#selDrogasReg").val(0);
        $("#iptMedicamentosReg").val("");
        $("#iptTerapia_IndividualReg").val("");
        $("#iptTerapia_OcupacionalReg").val("");
        
      
    })
    $("#btnCancelarRegistrom, #btnCerrarModalm").on('click', function() {

        $("#validate_id_expedientem").css("display", "none");
        $("#validate_id_pacientem").css("display", "none");
        $("#validate_id_representantem").css("display", "none");
        $("#validate_fecha_ingresom").css("display", "none");
        $("#validate_fecha_salidam").css("display", "none");
        $("#validate_firmo_contratom").css("display", "none");
        $("#validate_tiempo_duracionm").css("display", "none");
        $("#validate_hora_ingresom").css("display", "none");
        $("#validate_cuota_ingresom").css("display", "none");
        $("#validate_cuota_semanalm").css("display", "none");
        $("#validate_testigom").css("display", "none");
        $("#validate_estatusm").css("display", "none");

        $("#iptId_ExpedienteRegm").val("");
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
        $("#iptEstatusRegm").val("");

    })
    $("#btnCancelarRegistroS").on('click', function() {

      /*  $("#validate_id_expedientem").css("display", "none");
        $("#validate_id_pacientem").css("display", "none");
        $("#validate_id_representantem").css("display", "none");
        $("#validate_fecha_ingresom").css("display", "none");
        $("#validate_fecha_salidam").css("display", "none");
        $("#validate_firmo_contratom").css("display", "none");
        $("#validate_tiempo_duracionm").css("display", "none");
        $("#validate_hora_ingresom").css("display", "none");
        $("#validate_cuota_ingresom").css("display", "none");
        $("#validate_cuota_semanalm").css("display", "none");
        $("#validate_testigom").css("display", "none");
        $("#validate_estatusm").css("display", "none"); */

        $("#iptMotivo_AtencionRegs").val("");
        $("#iptReporte_LesionesRegs").val("");
        $("#iptFecha_NotificacionRegs").val("");
        $("#iptDiagnosticoRegs").val("");
        $("#selectplan").val(0);
        $("#iptPronosticoRegs").val("");
        $("#iptCedula_MedicoRegs").val("");
        $("#iptNombre_MedicoRegs").val("");
        $("#iptDuracion_ConsultaRegs").val("");
        $("#iptAgencia_MpRegs").val("");
        $("#iptDomicilio_AgenciaRegs").val("");
     

        })


  /*===================================================================*/
    //EVENTO PARA CALCULAR LA DURACION DEL CONTRATO AL CAMBIAR EL CONTENIDO (PERDER FOCUS)
    /*===================================================================*/
    $("#iptFecha_SalidaReg").change(function() {
        monthDiff();
     
    });
    
  /*===================================================================*/
    //EVENTO PARA CALCULAR LA DURACION DEL CONTRATO AL CAMBIAR EL CONTENIDO (PERDER FOCUS)
    /*===================================================================*/
    $("#iptFecha_IngresoReg").change(function() {
        monthDiff();
     
    });
    /*===================================================================*/
    //EVENTO PARA CALCULAR LA DURACION DEL CONTRATO AL CAMBIAR EL CONTENIDO (PERDER FOCUS)
    /*===================================================================*/
    $("#iptFecha_SalidaRegm").change(function() {
        monthDiffm();
     
    });
    /*===================================================================*/
    //EVENTO PARA CALCULAR LA DURACION DEL CONTRATO AL CAMBIAR EL CONTENIDO (PERDER FOCUS)
    /*===================================================================*/
    $("#iptFecha_IngresoRegm").change(function() {
        monthDiffm();
     // calcularDuracionm();
    });

    /*===================================================================*/
    //EVENTO PARA CALCULAR LA DURACION DEL CONTRATO AL CAMBIAR EL CONTENIDO (PERDER FOCUS)
    /*===================================================================*/
    $("#iptFecha_SalidaRegn").change(function() {
        monthDiffn();
     
    });
    /*===================================================================*/
    //EVENTO PARA CALCULAR LA DURACION DEL CONTRATO AL CAMBIAR EL CONTENIDO (PERDER FOCUS)
    /*===================================================================*/
    $("#iptFecha_IngresoRegn").change(function() {
        monthDiffn();
     // calcularDuracionm();
    });


    
    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON EDITAR EXPEDIENTE
    =========================================================================================*/
    $('#tbl_expedientes tbody').on('click', '.btnEditarExpediente', function() {

        accion = 4; //seteamos la accion para editar

      //  $("#mdlGestionarExpedientesM").modal('show');
        $("#mdlGestionarExpedientesM").modal('show');

        var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }
      //  console.log("🚀 ~ file: expedientes.php ~ line 630 ~ $ ~ data", data)
       
        $("#iptId_ExpedienteRegm").val(data[1]);
       // $("#iptId_ClinicaRegm").val(data[1]);
        $("#selPacienteRegm").val(data[3]); // se pone el id
        $("#selRepresentanteRegm").val(data[5]); // se pone la posicion del ID
        $("#iptFecha_IngresoRegm").val(data["fecha_ingreso"]);
        $("#iptFecha_SalidaRegm").val(data["fecha_salida"]);
        $("#iptFirmo_ContratoRegm").val(data["firmo_contrato"]);
        $("#iptTiempo_DuracionRegm").val(data["tiempo_duracion"]);
        $("#iptHora_IngresoRegm").val(data["hora_ingreso"]);
        $("#iptCuota_IngresoRegm").val(data["cuota_ingreso"]);
        $("#iptCuota_SemanalRegm").val(data["cuota_semanal"]);
        $("#iptExtrasRegm").val(data["extras"]);
        $("#iptTestigoRegm").val(data["testigo"]);
        $("#iptEstatusRegm").val(data["estatus"]);

        $("#iptTipo_IngresoRegm").val(data["tipo_ingreso"]);
        $("#iptRefiereRegm").val(data["refiere_institucion"]);
        $("#iptMotivoRegm").val(data["motivo_ingreso"]);
        $("#iptFolio_MpRegm").val(data["folio_mp"]);
        $("#iptOperadorRegm").val(data["operador_mp"]);
        $("#iptDescripcion_SaludRegm").val(data["descripcion_salud"]);

        $("#selDrogasRegm").val(data["id_droga"]);
        $("#iptMedicamentosRegm").val(data["medicamentos"]);
        $("#iptTerapia_IndividualRegm").val(data["terapia_individual"]);
        $("#iptTerapia_OcupacionalRegm").val(data["terapia_ocupacional"]);
       

    })
    
    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON AGREGAR NUEVO EXPEDIENTE A UN PACIENTE CON EXISTENTE EXPEDIENTE
    =========================================================================================*/
    $('#tbl_expedientes tbody').on('click', '.btnAgregarExpediente', function() {
                                              
        accion = 8; //seteamos la accion para editar

       // $("#mdlGestionarExpedientesn").modal('show');

        var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }
      //  console.log("🚀 ~ file: expedientes.php ~ line 554 ~ $ ~ data", data)

       // $("#iptId_ExpedienteRegn").val(data[1]);
        $("#selPacienteRegn").val(data[3]); // se pone el id
        $("#selRepresentanteRegn").val(data[5]); // se pone la posicion del ID
        $("#iptEstatusRegn").val(data["estatus"]);
        $("#iptFecha_SalidaRegna").val(data["fecha_salida"]);
      //  alert('La fecha de salida = ' + '#iptFecha_SalidaRegna.val()' );
        
       if($("#iptEstatusRegn").val()=='Activo'){

        Swal.fire("Este Paciente ya cuenta con un expediente Activo... Verifique!!!");
       // $("#mdlGestionarExpedientesn").modal('hide');

       }
       //else if ($("#iptFecha_IngresoRegn").val()<$("#iptFecha_SalidaRegna").val()){
       // Swal.fire("La fecha introducida es incorrecta ... Verifique!!!");
       // }
       else
       {

        accion = 99; //seteamos la accion para editar
        
        var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }

        var id_paciente = data["id_paciente"];
        var id_empresa = data["id_empresa"];
                var datos = new FormData();

                datos.append("accion", accion);
                datos.append("id_paciente", id_paciente); //id_paciente    
                datos.append("id_empresa", id_empresa); //id de la clinica       
                $.ajax({
                    url: "../ajax/pacientes.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(respuesta) {

                        if (respuesta == "ok") {
                             Swal.fire("Este Paciente ya cuenta con un expediente Activo... Verifique!!!");
                           table.ajax.reload();
                           $("#mdlGestionarExpedientesn").modal('hide');
                       } else {
                        $.ajax({
                                async: false,
                                url: "../ajax/expedientes.ajax.php",
                                method: "POST",
                                data: {                                    
                                    'accion': 11
                                },
                                dataType: 'json',
                                success: function(respuesta) {                                
                                    folio = respuesta["folio"];
                                    $("#iptId_ExpedienteRegn").val(folio);
                                }
                                });
                           $("#mdlGestionarExpedientesn").modal('show');


                        }

                    }
                });
       }

    })

     /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON SERVICIO DE ATENCION DE PACIENTE CON EXISTENTE EXPEDIENTE
    =========================================================================================*/
    $('#tbl_expedientes tbody').on('click', '.btnServicioAtencion', function() {
                                           //  alert("entró al botón de servicios atencion medica");
                                             $("#mdlGestionarExpedientesServiciosee").modal('show');
                                             $("#modales").modal('show');
                                           //  alert("despues");
                                             // $("#mdlGestionarExpedientesM").modal('show');
                                              
                                              var data = table.row($(this).parents('tr')).data();
                                              if(table.row(this).child.isShown()){
                                                  var data = table.row(this).data();
                                              }
                                           //   console.log("🚀 ~ file: expedientes.php ~ line 1084 ~ $ ~ data", data)
                                          //  alert("antes");
                                            //iptId_ExpedienteRegs
                                             $("#iptId_ExpedienteRegs").val(data[1]);
                                             $("#iptId_ClinicaRegs").val(data[2]);
                                             $("#selPacienteRegs").val(data[4]);
                                             var id_expediente =  $("#iptId_ExpedienteRegs").val();
                                             var id_clinica =  $("#iptId_ClinicaRegs").val();
                                          //   alert("expediente :" + id_expediente +'  clinica :' + id_clinica);
                                           
                                            
                                                var datos = new FormData();

                                                datos.append("accion", 558);
                                                datos.append("id_expediente", id_expediente); //id_expediente    
                                                datos.append("id_clinica", id_clinica); //id de la clinica       
                                                $.ajax({
                                                    url: "../ajax/servicio.atencion.ajax.php",
                                                    method: "POST",
                                                    data: datos,
                                                    cache: false,
                                                    contentType: false,
                                                    processData: false,
                                                    dataType: 'json',
                                                    success: function(respuesta) {
                                                          //  alert("expediente de servicios :" +respuesta[0]["id_expediente"]);
                                                       if (id_expediente == respuesta[0]["id_expediente"]) {
                                                            encontrado = true;
                                                            var motivo_atencion = respuesta[0]["motivo_atencion"];
                                                            var reporte_lesion = respuesta[0]["reporte_lesion"];
                                                            var diagnostico = respuesta[0]["diagnostico"];
                                                            var pronostico = respuesta[0]["pronostico"];
                                                            var cedula_medico = respuesta[0]["cedula_medico"];
                                                            var duracion_consulta = respuesta[0]["duracion_consulta"];
                                                            var nombre_medico = respuesta[0]["nombre_medico"];
                                                            var agencia_mp = respuesta[0]["agencia_mp"];
                                                            var domicilio_agencia = respuesta[0]["domicilio_agencia"];
                                                            var fecha_notificacion = respuesta[0]["fecha_notificacion"];
                                                            var plan = respuesta[0]["plan_terapeutico"];
                                                           // alert("Plan :" + plan);
                                                            let arr = plan.split(',');
                                                           // alert("array :" + arr);
                                                           
                                                            for (i = 0; i < arr.length; i++) {
                                                               // alert("adentro del ciclo");
                                                                if(i==0 && arr.length==1){
                                                                $('#selectplan').multiselect('select', [arr[0]]);
                                                                }
                                                                if(i==1 && arr.length==2){
                                                                $('#selectplan').multiselect('select', [arr[0],arr[1]]);
                                                                }
                                                                if(i==2 && arr.length==3){
                                                                $('#selectplan').multiselect('select', [arr[0],arr[1],arr[2]]);
                                                                }
                                                                if(i==3 && arr.length==4){
                                                                $('#selectplan').multiselect('select', [arr[0],arr[1],arr[2],arr[3]]);
                                                                }
                                                                if(i==4 && arr.length==5){
                                                                    $('#selectplan').multiselect('select', [arr[0],arr[1],arr[2],arr[3],arr[4]]);
                                                                }

                                                            } 
                                                           //Código de exemplo de lo que no se debe de hacer
                                                         
                                                         /*       
                                                           if( arr.includes('farmacoterapia')=== true && arr.includes('examenes')==true && arr.includes('terapia')==true && arr.includes('consejeria')== true &&arr.includes('canalizacion')==true){
                                                            $('#selectplan').multiselect('select', ['farmacoterapia','examenes','terapia','consejeria','canalizacion']);
                                                            
                                                        }
                                                           else if( arr.includes('farmacoterapia')=== true && arr.includes('examenes')==true && arr.includes('terapia')==true && arr.includes('consejeria')== true ){
                                                            $('#selectplan').multiselect('select', ['farmacoterapia','examenes','terapia','consejeria']);
                                                            
                                                        }
                                                           else if( arr.includes('farmacoterapia')=== true && arr.includes('examenes')==true && arr.includes('terapia')==true){
                                                            $('#selectplan').multiselect('select', ['farmacoterapia','examenes','terapia']);
                                                            
                                                        }
                                                          else if( arr.includes('farmacoterapia')=== true && arr.includes('examenes')==true ){
                                                            $('#selectplan').multiselect('select', ['farmacoterapia','examenes']);
                                                            
                                                        }
                                                        else if( arr.includes('farmacoterapia')=== true && arr.includes('canalizacion')==true ){
                                                            $('#selectplan').multiselect('select', ['farmacoterapia','canalizacion']);
                                                            
                                                        }
                                                        else if( arr.includes('farmacoterapia')=== true && arr.includes('consejeria')==true ){
                                                            $('#selectplan').multiselect('select', ['farmacoterapia','consejeria']);
                                                            
                                                        }
                                                        else if( arr.includes('farmacoterapia')=== true && arr.includes('terapia')==true ){
                                                            $('#selectplan').multiselect('select', ['farmacoterapia','terapia']);
                                                            
                                                        }
                                                          else if( arr.includes('farmacoterapia')=== true  ){
                                                            $('#selectplan').multiselect('select', ['farmacoterapia']);
                                                            
                                                          }
                                                          // examenes
                                                          else if( arr.includes('examenes')=== true && arr.includes('canalizacion')==true && arr.includes('terapia')==true){
                                                            $('#selectplan').multiselect('select', ['examenes','canalizacion','terapia']);
                                                            
                                                        }
                                                        else if( arr.includes('examenes')=== true && arr.includes('canalizacion')==true && arr.includes('consejeria')==true){
                                                            $('#selectplan').multiselect('select', ['examenes','canalizacion','consejeria']);
                                                            
                                                        }
                                                        else if( arr.includes('examenes')=== true && arr.includes('consejeria')==true && arr.includes('terapia')==true){
                                                            $('#selectplan').multiselect('select', ['examenes','canalizacion','consejeria']);
                                                            
                                                        }
                                                      

                                                          else if( arr.includes('examenes')=== true && arr.includes('canalizacion')==true ){
                                                            $('#selectplan').multiselect('select', ['examenes','canalizacion']);
                                                            
                                                        }
                                                        else if( arr.includes('examenes')=== true && arr.includes('consejeria')==true ){
                                                            $('#selectplan').multiselect('select', ['examenes','consejeria']);
                                                            
                                                        }
                                                        else if( arr.includes('examenes')=== true && arr.includes('terapia')==true ){
                                                            $('#selectplan').multiselect('select', ['examenes','terapia']);
                                                            
                                                        }
                                                          else if( arr.includes('examenes')=== true  ){
                                                            $('#selectplan').multiselect('select', ['examenes']);
                                                            
                                                          }
                                                          // terapia
                                                          else if( arr.includes('terapia')=== true && arr.includes('consejeria')==true ){
                                                            $('#selectplan').multiselect('select', ['terapia','consejeria']);
                                                            
                                                        }
                                                        else if( arr.includes('terapia')=== true && arr.includes('canalizacion')==true ){
                                                            $('#selectplan').multiselect('select', ['terapia','canalizacion']);
                                                            
                                                        }
                                                          else if( arr.includes('terapia')=== true  ){
                                                            $('#selectplan').multiselect('select', ['terapia']);
                                                            
                                                          }
                                                          else if( arr.includes('consejeria')=== true && arr.includes('canalizacion')==true ){
                                                            $('#selectplan').multiselect('select', ['consejeria','canalizacion']);
                                                            
                                                        }
                                                          else if( arr.includes('consejeria')=== true  ){
                                                            $('#selectplan').multiselect('select', ['consejeria']);
                                                            
                                                          }
                                                          // canalizacion
                                                          else if( arr.includes('canalizacion')=== true  ){
                                                            $('#selectplan').multiselect('select', ['canalizacion']);
                                                            
                                                          }
                                                          
                                                           */
                                                           
                                                          

                                                           //$('#selectplan').multiselect('select', ['farmacoterapia', 'examenes']);
                                                                   
                                                                   // 
                                                                    $("#iptMotivo_AtencionRegs").val(motivo_atencion);
                                                                    $("#iptReporte_LesionesRegs").val(reporte_lesion);
                                                                    $("#iptFecha_NotificacionRegs").val(fecha_notificacion);
                                                                    $("#iptDiagnosticoRegs").val(diagnostico);
                                                                  //  $("#selectplan").val(plan);
                                                                    $("#iptPronosticoRegs").val(pronostico);
                                                                    $("#iptCedula_MedicoRegs").val(cedula_medico);
                                                                    $("#iptDuracion_ConsultaRegs").val(duracion_consulta);
                                                                    $("#iptNombre_MedicoRegs").val(nombre_medico);
                                                                    $("#iptAgencia_MpRegs").val(agencia_mp);
                                                                    $("#iptDomicilio_AgenciaRegs").val(domicilio_agencia);
                                                                    

                                                      //  table.ajax.reload();
                                                      //  $("#mdlGestionarExpedientesn").modal('hide');
                                                    } 
                                                   else {
                                                    encontrado = false;
                                                      }

                                                    }
                                                });




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
        var id_clinica = data["id_clinica"]; 
        vroles =  $('#vrolusu').val();
        
        //alert('vrol id = ' +vroles);

        if (vroles==1) 
          {     
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
                datos.append("id_clinica", id_clinica); //id_de la clinica 
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
                                title: 'El expediente se eliminó correctamente'
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
        } // sesion
        else{
            Swal.fire(
            'Lo siento!',
             'Usuario sin permisos',
             'error'
            );
        }
    })
        
 /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON CREAR PERIODOS DE PAGO
    =========================================================================================*/
    $('#tbl_expedientes tbody').on('click', '.btnPeriodosExpediente', function() {
        
        accion = 2; //seteamos la accion para crear los periodos de pago semanales
        var esta;
        var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }
     //   console.log("🚀 ~ file: expedientes.php ~ line 772 ~ $ ~ data", data)
        var id_expediente = data["id_expediente"];
        var id_clinica = data["id_clinica"]; 
        var paciente = data["NOMBRE"];


        var titulo = 'Está seguro de crear los períodos de pago para el paciente ' + paciente;
        
        var datosbe = new FormData();
                    datosbe.append("accion", 1);
                    datosbe.append("id_expediente", id_expediente); //Id expediente
        // busca el expediente en períodos
                          $.ajax({
                            url: "../ajax/periodos.ajax.php",
                            method: "POST",
                            data: datosbe,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                           }).then(function (result) {
                                 var id = result[0][1];                 
                                //    alert('Id = ' + id);
                                if (id >= 1) {
                                   
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'El período de pago ya fue generado'
                                    });
                                   
                                     }
                            }).catch(function (err) {
                               // alert(' no encontro los periodos');
                                var duracion = data["tiempo_duracion"];
                                   // alert('Duracion = ' + duracion);
                                    if(duracion != 0){
                                        Swal.fire({
                                    title: titulo,
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Si, deseo generarlos!',
                                    cancelButtonText: 'Cancelar',
                                }).then((result) => {

                                if (result.isConfirmed) {
                                        vroles =  $('#vrolusu').val();
                                        var finicio =data["fecha_ingreso"];
                                        var fsalida = data["fecha_salida"];
                                        var cuota_semanal = data["cuota_semanal"];
                                        var semanas = duracion * 4;
                                        var calcfecha = new Date(data["fecha_ingreso"]+"T00:00:00"); // fuerza la zona horaria  al formato yyyy-MM-ddT00:00:00, si no se hace esto los dias se resta uno (explicación? tiene que ver con la zona horaria y que resta tiempo automáticamente)
                                        for (var i=1; i <= semanas; i++)
                                        {      
                                            var datos = new FormData();
                                            datos.append("accion", accion);
                                            datos.append("id", i); //id
                                            datos.append("id_expediente", id_expediente); //Id expediente
                                            var finannof = calcfecha.getFullYear();//guardo año
                                            var finmesf = calcfecha.getMonth();//guardo mes
                                            var findiaf = calcfecha.getDate() < 10 ? '0' + calcfecha.getDate() : '' + calcfecha.getDate();//doy formato a dia para que sea de 2 dígitos "01", "05", "10", etc.
                                            finmesf = finmesf + 1; // sume + 1 por que parece que los meses inician desde "0" es decir que enero seria 0 y diciembre seria 11 (para que lo acepte el input date que tengo) 
                                            finmesf = finmesf < 10 ? '0' + finmesf : '' + finmesf; // el mismo tratamiento del día
                                            fpf= finannof+"-"+finmesf+"-"+findiaf;



                                            datos.append("fecha_inicial",fpf); //Fecha inicial
                                            calcfecha.setDate(calcfecha.getDate() + 7); //se suman los 7 dias de la semana
                                        
                                            datos.append("estatus",'Pendiente'); //estatus

                                        // alert('calcfecha = ' + calcfecha);
                                            calcfecha.setMonth(calcfecha.getMonth());

                                            var finanno = calcfecha.getFullYear();//guardo año
                                            var finmes = calcfecha.getMonth();//guardo mes
                                            var findia = calcfecha.getDate() < 10 ? '0' + calcfecha.getDate() : '' + calcfecha.getDate();//doy formato a dia para que sea de 2 dígitos "01", "05", "10", etc.
                                            finmes = finmes + 1; // sume + 1 por que parece que los meses inician desde "0" es decir que enero seria 0 y diciembre seria 11 (para que lo acepte el input date que tengo) 
                                            finmes = finmes < 10 ? '0' + finmes : '' + finmes; // el mismo tratamiento del día
                                            fp= finanno+"-"+finmes+"-"+findia;
                                            datos.append("fecha_final",fp); //Fecha inicial
                                            datos.append("pago", 0); //Fecha_Ingreso_Paciente
                                            datos.append("saldo", 0); //Fecha_Salida_Paciente                  
                                        // alert('fecha del periodo ' + fp);
                                            calcfecha = new Date(fp+"T00:00:00");
                                        // alert('calcfecha despues =' + calcfecha);
                                            
                                            // ***********************************************************************
                                            // graba los periodos
                                            // ***********************************************************************
                                            $.ajax({
                                                    url: "../ajax/periodos.ajax.php",
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
                                                               title: 'Espere... Generando Periodos de Pago!!!'
                                                         });

                                                          //  table.ajax.reload();

                                                        } else {
                                                            Toast.fire({
                                                                icon: 'success',
                                                                title: 'Espere... Generando Periodos de Pago!!!'
                                                                });
                                                            }

                                                        }
                                                    });
                                            //********************************************************************* 
                                            // fin de grabar los periodos
                                            // ********************************************************************
                                        } // fin del cliclo
                                    }          
                                 })   
                                }
                                else
                                {
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Advertencia',
                                    text: 'Este Expediente no cuenta con período de Duración!',
                                    footer: 'Favor de capturar la fecha de ingreso y Término...'
                                    })
                                }
                            });
                           // success: function(respuesta) {
                           
                        });
                       
                       
                                  
                           // } //validacion si esta o no

                           
  // Fin de búsqueda de expedientes en periodos de pagos 
            
    });

//}); // fin del document ready

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
                alert("dentro de la accion 4");
            }
            if (accion==2){
                $mensaje='Está seguro de registrar el Expediente?';
                $confirmar='Si, deseo registrarlo!';
            }
          //  alert("Antes del Swal");
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
                  //  alert("Entro a la confirmación")
                    var datos = new FormData();
                    var num = $("#iptCuota_IngresoReg").val().replace(/\,/g,'');
                    var num2 = $("#iptCuota_SemanalReg").val().replace(/\,/g,'');
                  //  var num3 = $("#iptExtrasReg").val().replace(/\,/g,'');
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
                    datos.append("extras", $("#iptExtrasReg").val()); //Cuota_Semanal 
                    datos.append("testigo", $("#iptTestigoReg").val()); //Testigo
                    datos.append("estatus", $("#iptEstatusReg").val()); //Estatus

                    datos.append("tipo_ingreso", $("#iptTipo_IngresoReg").val()); //tipo de ingreso
                    datos.append("refiere_institucion", $("#iptRefiereReg").val()); //refiere institucion
                    datos.append("motivo_ingreso", $("#iptMotivoReg").val()); //Motivo de ingreso
                    datos.append("folio_mp", $("#iptFolio_MpReg").val()); //folio del Ministertio Público
                    datos.append("operador_mp", $("#iptOperadorReg").val()); //Operador del M.P
                    datos.append("descripcion_salud", $("#iptDescripcion_SaludReg").val()); //Descripcion de Salud del Paciente
                    
                    datos.append("id_droga", $("#selDrogasReg").val()); //Motivo de ingreso
                    datos.append("medicamentos", $("#iptMedicamentosReg").val()); //folio del Ministertio Público
                    datos.append("terapia_individual", $("#iptTerapia_IndividualReg").val()); //Operador del M.P
                    datos.append("terapia_ocupacional", $("#iptTerapia_OcupacionalReg").val()); //Descripcion de Salud del Paciente
                    

                    

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

                                $("#mdlGestionarExpedientes").modal('hide');

                                $("#selPacienteReg").val(0);
                                $("#selRepresentanteReg").val(0);
                                $("#iptFecha_IngresoReg").val("");
                                $("#iptFecha_SalidaReg").val("");
                                $("#iptFirmo_ContratoReg").val("");
                                $("#iptTiempo_DuracionReg").val("");
                                $("#iptHora_IngresoReg").val("");
                                $("#iptCuota_IngresoReg").val("");
                                $("#iptCuota_SemanalReg").val("");
                                $("#iptExtrasReg").val("");
                                $("#iptTestigoReg").val("");
                                $("#iptEstatusReg").val("");

                                $("#iptTipo_IngresoReg").val("");
                                $("#iptRefiere_InstitucionReg").val("");
                                $("#iptMotivo_IngresoReg").val("");
                                $("#iptFolio_MpReg").val("");
                                $("#iptOperadorReg").val("");
                                $("#iptDescripcion_saludReg").val("");
                                
                                $("#selDrogasReg").val(0);
                                $("#iptMedicamentosReg").val("");
                                $("#iptTerapia_individualReg").val("");
                                $("#iptTerapia_ocupacionalReg").val("");

                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Verificar el Expediente grabado'
                                });
                            table.ajax.reload();
                                $("#mdlGestionarExpedientes").modal('hide');

                                $("#selPacienteReg").val(0);
                                $("#selRepresentanteReg").val(0);
                                $("#iptFecha_IngresoReg").val("");
                                $("#iptFecha_SalidaReg").val("");
                                $("#iptFirmo_ContratoReg").val("");
                                $("#iptTiempo_DuracionReg").val("");
                                $("#iptHora_IngresoReg").val("");
                                $("#iptCuota_IngresoReg").val("");
                                $("#iptCuota_SemanalReg").val("");
                                $("#iptExtrasReg").val("");
                                $("#iptTestigoReg").val("");
                                $("#iptEstatus").val("");

                                $("#iptTipo_IngresoReg").val("");
                                $("#iptRefiere_InstitucionReg").val("");
                                $("#iptMotivo_IngresoReg").val("");
                                $("#iptFolio_MpReg").val("");
                                $("#iptOperadorReg").val("");
                                $("#iptDescripcion_saludReg").val("");

                                $("#selDrogasReg").val(0);
                                $("#iptMedicamentosReg").val("");
                                $("#iptTerapia_individualReg").val("");
                                $("#iptTerapia_ocupacionalReg").val("");


                            }

                        }
                    });

                }
            })
            // antes de esas llaves insertar los periodos
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
                                var id_expediente= $("#iptId_ExpedienteRegm").val();
                               // alert('ed expediente : ' + id_expediente);          
                                var estatusb = $("#iptEstatusRegm").val();
                              //  alert('estatus : ' + estatusb);
                               // if(estatusb==='Baja'){
                                    // checar si tiene períodos de pago Pendientes
                                   $.ajax({
                                    async: false,
                                    url: "../ajax/periodos.ajax.php",
                                    method: "POST",
                                    data: {
                                        'accion': 9,
                                        'id_expediente': id_expediente
                                    },
                                    dataType: 'json',
                                    success: function(respuesta) {
                                  //   alert('entro a checar si debe :'+ estatusb);
                                     if(respuesta=='ok' && estatusb==='Baja'){
                                        Swal.fire('Este paciente tiene periodos de pago Pendientes, no lo puede dar de baja','Warning');
                                     }
                                    else
                                    {
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
                                       //  var num3 = $("#iptExtrasm").val().replace(/\,/g,'');
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
                                         datos.append("extras", $("#iptExtrasRegm").val());
                                         datos.append("testigo", $("#iptTestigoRegm").val()); //Testigo
                                         datos.append("estatus", $("#iptEstatusRegm").val()); //Estatus
                                      
                                         datos.append("tipo_ingreso", $("#iptTipo_IngresoRegm").val()); //Estatus
                                         datos.append("refiere_institucion", $("#iptRefiereRegm").val()); //Estatus
                                         datos.append("motivo_ingreso", $("#iptMotivoRegm").val()); //Estatus
                                         datos.append("folio_mp", $("#iptFolio_MpRegm").val()); //Estatus
                                         datos.append("operador_mp", $("#iptOperadorRegm").val()); //Estatus
                                         datos.append("descripcion_salud", $("#iptDescripcion_SaludRegm").val()); //Estatus
                                            
                                         datos.append("id_droga", $("#selDrogasRegm").val()); //Motivo de ingreso
                                         datos.append("medicamentos", $("#iptMedicamentosRegm").val()); //folio del Ministertio Público
                                         datos.append("terapia_individual", $("#iptTerapia_IndividualRegm").val()); //Operador del M.P
                                         datos.append("terapia_ocupacional", $("#iptTerapia_OcupacionalRegm").val()); //Descripcion de Salud del Paciente
                                        

                                         
                     
                                         if(accion == 2){
                                             var titulo_msj = "El Expediente se registró correctamente"
                                         }
                     
                                         if(accion == 4){
                                             var titulo_msj = "El Expediente se actualizó correctamente"
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

                                                     $("#mdlGestionarExpedientesM").modal('hide');
                     
                                                     $("#selPacienteRegm").val(0);
                                                     $("#selRepresentanteRegm").val(0);
                                                     $("#iptFecha_IngresoRegm").val("");
                                                     $("#iptFecha_SalidaRegm").val("");
                                                     $("#iptFirmo_ContratoRegm").val("");
                                                     $("#iptTiempo_DuracionRegm").val("");
                                                     $("#iptHora_IngresoRegm").val("");
                                                     $("#iptCuota_IngresoRegm").val("");
                                                     $("#iptCuota_SemanalRegm").val("");
                                                     $("#iptExtrasRegm").val("");
                                                     $("#iptTestigoRegm").val("");
                                                     $("#iptEstatusm").val("");

                                                     $("#iptTipo_IngresoRegm").val("");
                                                     $("#iptRefiereRegm").val("");
                                                     $("#iptMotivo_IngresoRegm").val("");
                                                     $("#iptFolio_MpRegm").val("");
                                                     $("#iptOperadorRegm").val("");
                                                     $("#iptDescripcion_SaludRegm").val("");

                                                     $("#selDrogasRegm").val(0);
                                                     $("#iptMedicamentosRegm").val("");
                                                     $("#iptTerapia_individualRegm").val("");
                                                     $("#iptTerapia_ocupacionalRegm").val("");

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




                                    }

                                    }//

                                });
                             //  }
                              //  var id_clinica = $("#selEmpresaRegm").val();
                         
                           // alert("dentro del alert antes de accion=4")
                                // console.log("Listo para registrar el paciente")
                                
                             }else {
                                 console.log("No pasó la validación")
                             }
                     
                             form.classList.add('was-validated');
                     
                         });
});


/*===================================================================*/
//EVENTO QUE GUARDA LOS DATOS DEL Paciente, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/
document.getElementById("btnGuardarExpedienten").addEventListener("click", function() {
                    var fechaig = $("#iptFecha_IngresoRegn").val();
                    var fechaipa = $("#iptFecha_SalidaRegna").val();
                    var estatusn = $("#iptEstatusRegn").val();
                   // var d = new Date();
                   // var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
                 //  var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
                  //  alert('fecha actual ' + strDate + ' fecha ingreso = ' + fechaig);
                   


                          if ($("#iptFecha_IngresoRegn").val()<$("#iptFecha_SalidaRegna").val()){
                            Swal.fire(
                                "La fecha de INGRESO " + fechaig +" es Incorrecta",
                                "El término del período anterior fue : " + fechaipa,
                                'error'
                                )
                        //  Swal.fire("La fecha de INGRESO " + fechaig +" es incorrecta, La fecha de terminación del período anterior fue : " + fechaipa + " ... Verifique!!!");
                     }
                  //   else if (fechaig> strDate){
                     //   Swal.fire(
                     //           "La Fecha de Ingreso",
                     //           "Es mayor a la fecha actual",
                     //           'error'
                      //          )
                       // Swal.fire("Favor de cambiar el estatus del Expediente a Activo... Verifique!!!");                    
                    // }
                     else if (estatusn!='Activo'){
                        Swal.fire(
                                "El estatus debe estar Activo",
                                "Favor de realizar el cambio",
                                'error'
                                )
                       // Swal.fire("Favor de cambiar el estatus del Expediente a Activo... Verifique!!!");                    
                     }
                     else{

                         // Get the forms we want to add validation styles to
                         var forms = document.getElementsByClassName('needs-validation');
                         // Loop over them and prevent submission
                         var validation = Array.prototype.filter.call(forms, function(form) {
                             //calcularedad();
                             if (form.checkValidity() === true) {   
                                accion=2;
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
                                         var num = $("#iptCuota_IngresoRegn").val().replace(/\,/g,'');
                                         var num2 = $("#iptCuota_SemanalRegn").val().replace(/\,/g,'');
                                        // var num3 = $("#iptExtrasRegn").val().replace(/\,/g,'');
                                         datos.append("accion", accion);
                                         datos.append("id_expediente", $("#iptId_ExpedienteRegn").val()); //id_Expediente
                                         datos.append("id_paciente", $("#selPacienteRegn").val()); //Id Paciente
                                         datos.append("id_representante", $("#selRepresentanteRegn").val()); //Id_representante
                                         datos.append("fecha_ingreso", $("#iptFecha_IngresoRegn").val()); //Fecha_Ingreso_Paciente
                                         datos.append("fecha_salida", $("#iptFecha_SalidaRegn").val()); //Fecha_Salida_Paciente
                                         datos.append("firmo_contrato", $("#iptFirmo_ContratoRegn").val()); //Firmó Contrato
                                         datos.append("tiempo_duracion", $("#iptTiempo_DuracionRegn").val()); //Duración_Paciente
                                         datos.append("hora_ingreso", $("#iptHora_IngresoRegn").val()); //Hora de Ingreso del Paciente
                                         datos.append("cuota_ingreso", num); //Cuota de Ingreso
                                         datos.append("cuota_semanal", num2); //Cuota_Semanal 
                                         datos.append("extras", $("#iptExtrasRegn").val());
                                         datos.append("testigo", $("#iptTestigoRegn").val()); //Testigo
                                         datos.append("estatus", $("#iptEstatusRegn").val()); //Estatus
                                         
                                         datos.append("tipo_ingreso", $("#iptTipo_IngresoRegn").val()); //Estatus
                                         datos.append("refiere_institucion", $("#iptRefiereRegn").val()); //Estatus
                                         datos.append("motivo_ingreso", $("#iptMotivo_IngresoRegn").val()); //Estatus
                                         datos.append("folio_mp", $("#iptFolio_MpRegn").val()); //Estatus
                                         datos.append("operador_mp", $("#iptOperadorRegn").val()); //Estatus
                                         datos.append("descripcion_salud", $("#iptDescripcion_SaludRegn").val()); //Estatus
                                            
                     
                                         datos.append("id_droga", $("#selDrogasRegn").val()); //Motivo de ingreso
                                         datos.append("medicamentos", $("#iptMedicamentosRegn").val()); //folio del Ministertio Público
                                         datos.append("terapia_individual", $("#iptTerapia_IndividualRegn").val()); //Operador del M.P
                                         datos.append("terapia_ocupacional", $("#iptTerapia_OcupacionalRegn").val()); //Descripcion de Salud del Paciente
                    

                     
                                         
                     
                                         if(accion == 2){
                                             var titulo_msj = "El Expediente se registró correctamente"
                                         }
                     
                                         if(accion == 4){
                                             var titulo_msj = "El Expediente se actualizó correctamente"
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

                                                     $("#mdlGestionarExpedientesn").modal('hide');
                     
                                                     $("#selPacienteRegn").val(0);
                                                     $("#selRepresentanteRegn").val(0);
                                                     $("#iptFecha_IngresoRegn").val("");
                                                     $("#iptFecha_SalidaRegn").val("");
                                                     $("#iptFirmo_ContratoRegn").val("");
                                                     $("#iptTiempo_DuracionRegn").val("");
                                                     $("#iptHora_IngresoRegn").val("");
                                                     $("#iptCuota_IngresoRegn").val("");
                                                     $("#iptCuota_SemanalRegn").val("");
                                                     $("#iptExtrasRegn").val("");
                                                     $("#iptTestigoRegn").val("");
                                                     $("#iptEstatusn").val("");

                                                     $("#iptTipo_IngresoRegn").val("");
                                                     $("#iptRefiereRegn").val("");
                                                     $("#iptMotivo_IngresoRegn").val("");
                                                     $("#iptFolio_MpRegn").val("");
                                                     $("#iptOperadorRegn").val("");
                                                     $("#iptDescripcion_SaludRegn").val("");

                                                     $("#selDrogasReg").val(0);
                                                     $("#iptMedicamentosRegn").val("");
                                                     $("#iptTerapia_individualRegn").val("");
                                                     $("#iptTerapia_ocupacionalRegn").val("");

                                                 } else {
                                                     Toast.fire({
                                                         icon: 'error',
                                                         title: 'Verifique Información del Expedienteeeee!!!'
                                                     });
                                                     table.ajax.reload();
                                                    $("#mdlGestionarExpedientesn").modal('hide');
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
                    }
});

/*===================================================================*/
//EVENTO QUE GUARDA LOS DATOS DEL Paciente, DE SERVICIOS DE ATENCION MEDICA
/*===================================================================*/
document.getElementById("btnGuardarExpedienteS").addEventListener("click", function() {
              // alert("entró al botón de servicio");
                                             var id_expediente =  $("#iptId_ExpedienteRegs").val();
                                             var id_clinica =  $("#iptId_ClinicaRegs").val();
                                           //  var domicilioc = $("#iptDomicilio_AgenciaRegs").val();
                                             //alert('Domicilio :' + domicilioc);
                                    var datos = new FormData();
                                    accion = 55; // BUSCA EL EXPEDIENTE
                                    datos.append("accion", accion);
                                    datos.append("id_expediente", id_expediente); //id_Expediente              
                                    datos.append("id_clinica", id_clinica); //id_de la clinica 
                                    $.ajax({
                                        url: "../ajax/servicio.atencion.ajax.php",
                                        method: "POST",
                                        data: datos,
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        dataType: 'json',
                                        success: function(respuesta) {
                                            if (encontrado === true) {

                                            //Modifica el registro
                                      var datosg = new FormData();
                                       
                                    datosg.append("accion", 4);
                                    datosg.append("id_expediente", $("#iptId_ExpedienteRegs").val()); //id_Expediente
                                    datosg.append("id_clinica", $("#iptId_ClinicaRegs").val()); //Id Paciente
                                    datosg.append("motivo_atencion", $("#iptMotivo_AtencionRegs").val()); //Id_representante
                                    datosg.append("reporte_lesion", $("#iptReporte_LesionesRegs").val()); //Fecha_Ingreso_Paciente
                                    datosg.append("diagnostico", $("#iptDiagnosticoRegs").val()); //Fecha_Salida_Paciente
                                    datosg.append("plan_terapeutico", $("#selectplan").val()); //Firmó Contrato
                                    datosg.append("pronostico", $("#iptPronosticoRegs").val()); //Duración_Paciente
                                    datosg.append("cedula_medico", $("#iptCedula_MedicoRegs").val()); //Hora de Ingreso del Paciente
                                    datosg.append("duracion_consulta", $("#iptDuracion_ConsultaRegs").val());
                                    datosg.append("nombre_medico", $("#iptNombre_MedicoRegs").val()); //Cuota_Semanal 
                                    datosg.append("fecha_notificacion", $("#iptFecha_NotificacionRegs").val()); //Cuota_Semanal 
                                    datosg.append("agencia_mp", $("#iptAgencia_MpRegs").val()); //Testigo
                                    datosg.append("domicilio_agencia", $("#iptDomicilio_AgenciaRegs").val()); 
                                   
                                          
                                                var titulo_msj = "El expediente se actualizó correctamente"
                                            

                    $.ajax({
                        url: "../ajax/servicio.atencion.ajax.php",
                        method: "POST",
                        data: datosg,
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

                                $("#mdlGestionarExpedientes").modal('hide');

                               

                            } else {
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Verificar el Expediente grabado'
                                });
                            table.ajax.reload();
                                $("#mdlGestionarExpedientes").modal('hide');

                               

                            }

                        }
                    });


                                                } else {
                                                    
                                            // Graba el registro
                                            var datosg = new FormData();
                                          //  var num3 = $("#iptExtrasReg").val().replace(/\,/g,'');
                                    datosg.append("accion", 2);
                                    datosg.append("id_expediente", $("#iptId_ExpedienteRegs").val()); //id_Expediente
                                    datosg.append("id_clinica", $("#iptId_ClinicaRegs").val()); //Id Paciente
                                    datosg.append("motivo_atencion", $("#iptMotivo_AtencionRegs").val()); //Id_representante
                                    datosg.append("reporte_lesion", $("#iptReporte_LesionesRegs").val()); //Fecha_Ingreso_Paciente
                                    datosg.append("diagnostico", $("#iptDiagnosticoRegs").val()); //Fecha_Salida_Paciente
                                    datosg.append("plan_terapeutico", $("#selectplan").val()); //Firmó Contrato
                                    datosg.append("pronostico", $("#iptPronosticoRegs").val()); //Duración_Paciente
                                    datosg.append("cedula_medico", $("#iptCedula_MedicoRegs").val()); //Hora de Ingreso del Paciente
                                    datosg.append("duracion_consulta", $("#iptDuracion_ConsultaRegs").val());
                                    datosg.append("nombre_medico", $("#iptNombre_MedicoRegs").val()); //Cuota_Semanal 
                                    datosg.append("fecha_notificacion", $("#iptFecha_NotificacionRegs").val()); //Cuota_Semanal 
                                    datosg.append("agencia_mp", $("#iptAgencia_MpRegs").val()); //Testigo
                                    datosg.append("domicilio_agencia", $("#iptDomicilio_AgenciaRegs").val()); 
                                    if(accion == 2){
                                                var titulo_msj = "El Expediente se registró correctamente"
                                            }

                                            if(accion == 4){
                                                var titulo_msj = "El expediente se actualizó correctamente"
                                            }

                    $.ajax({
                        url: "../ajax/servicio.atencion.ajax.php",
                        method: "POST",
                        data: datosg,
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

                                $("#mdlGestionarExpedientes").modal('hide');

                               

                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Verificar el Expediente grabado'
                                });
                            table.ajax.reload();
                                $("#mdlGestionarExpedientes").modal('hide');

                               

                            }

                        }
                    });



                                                }

                                            
                                            
                                        }
                                    })

               //
               //mdlGestionarExpedientesServicios
});




/*===================================================================*/
//EVENTO QUE LIMPIA LOS MENSAJES DE ALERTA DE INGRESO DE DATOS DE CADA INPUT AL CANCELAR LA VENTANA MODAL
/*===================================================================*/
document.getElementById("btnCancelarRegistro").addEventListener("click", function() {
    $(".needs-validation").removeClass("was-validated");
})
/*
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
}); */
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

}
function generar_periodos(){
    var duracion = $("#iptTiempo_DuracionReg").val();
    var fechai = $("#iptFecha_IngresoRegm").val();
    var fechas= $("#iptFecha_SalidaRegm").val();
    

}
function calcularDuracionm()
{
    var fechai = $("#iptFecha_IngresoRegm").val();
    var fechas = $("#iptFecha_SalidaRegm").val();

    iptFecha_IngresoReg
    var fecha1 = moment(fechai);
    var fecha2 = moment(fechas);
    $("#iptTiempo_DuracionRegm").val(fecha2.diff(fecha1, 'months'));

}

function monthDiffm() {
    var d1= $("#iptFecha_IngresoRegm").val();
    var d2 = $("#iptFecha_SalidaRegm").val();
    var aDate = new Date(d1);
    var bDate = new Date(d2);
    var months;
    months = (bDate.getFullYear() - aDate.getFullYear()) * 12;
    months -= aDate.getMonth();
    months += bDate.getMonth();
    if (months>0)
    $("#iptTiempo_DuracionRegm").val(months);
    else
    $("#iptTiempo_DuracionRegm").val(0);

    //return months <= 0 ? 0 : months;
}
function monthDiff() {
    var d1= $("#iptFecha_IngresoReg").val();
    var d2 = $("#iptFecha_SalidaReg").val();
    var aDate = new Date(d1);
    var bDate = new Date(d2);
    var months;
    months = (bDate.getFullYear() - aDate.getFullYear()) * 12;
    months -= aDate.getMonth();
    months += bDate.getMonth();
    if (months>0)
    $("#iptTiempo_DuracionReg").val(months);
    else
    $("#iptTiempo_DuracionReg").val(0);

    //return months <= 0 ? 0 : months;
}

function monthDiffn() {
    var d1= $("#iptFecha_IngresoRegn").val();
    var d2 = $("#iptFecha_SalidaRegn").val();
    var aDate = new Date(d1);
    var bDate = new Date(d2);
    var months;
    months = (bDate.getFullYear() - aDate.getFullYear()) * 12;
    months -= aDate.getMonth();
    months += bDate.getMonth();
    if (months>0)
    $("#iptTiempo_DuracionRegn").val(months);
    else
    $("#iptTiempo_DuracionRegn").val(0);

    //return months <= 0 ? 0 : months;
}

function calcularperiodos(){
    alert('antes del parse');
       // var fi=date.Parse(data["fecha_ingreso"]);
        alert('fecha inicial parseada = ' + fi);
       // dia = finicio.getDate();
        //mes = finicio.getMonth()+1;// +1 porque los meses empiezan en 0
        //anio = finicio.getFullYear();
       // ffp = new date();
       // ffp.setDate(ffp.getDate() + 7);

}

</script>

