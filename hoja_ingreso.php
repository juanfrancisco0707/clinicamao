<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../index.php');
}
include_once('tbs_class.php'); 
include_once('plugins/tbs_plugin_opentbs.php'); 

?>


<style>
    .dataTables_filter{
        float: left !important;
    }
</style>
 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Hoja de ingreso</h1>
                 
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Hoja de Ingreso</li>
        <input type="hidden" id="vclinica" name="vclinica" value='<?php echo $_SESSION['S_CLINICA']; ?>'/> 
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->
 <!-- Main content -->
<div class="content">

<div class="container-fluid">
    <!-- row para listado de Ocupaciones -->
    <div class="row">
        <div class="col-lg-12">
        <table id="tbl_expedientes" class="table table-striped w-100 shadow">
                <thead class="bg-info">
                    <tr role="row" style="font-size: 11px;">
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
                        <th class="text-center">Seleccionar</th>
                       
                    </tr>
                </thead>
                <tbody class="text-small">
                </tbody>
            </table>
        </div>
    </div>

</div><!-- /.container-fluid -->
</div>
    <?php
  //  include "ejemplo.php";
    ?>

<script> // La búsqueda avanzada lista

     var table;
     var itemConcepto = 1;
     var consecutivo=0;
     var id_expediente=0;

     var Toast = Swal.mixin({
         toast: true,
         position: 'top',
         showConfirmButton: false,
         timer: 3000
     });

      /*===================================================================*/
     // BUSQUEDA AVANZADA DE LOS PACIENTES EN LOS EXPEDIENTES
     /*===================================================================*/
     $(document).ready(function() {   
         tableEx = $("#tbl_expedientes").DataTable({
             dom: 'frtip', //Bfrtip Para que los botones se pongan en la parte Superior
             pageLength: [
                 [5, 10, 15, 30, 50],
                 ['5 Filas', '10 Filas', '15 Filas', '30 Filas', '50 Filas', 'Mostrar todo']
             ],
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
                     className: 'text-right',
                     targets: [13, 14, 15]
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
                     targets: 6, // no muestra el id del representante
                     visible: false
                 },
                 {
                     targets: 9, // Hora de Entrada
                     visible: false
                 },
                 {
                     targets: 10, // centra tiempo de duración
                     visible: false
                 },
                 {
                     targets: 12, // firma de contrato
                     visible: false
                 },
                 {
                     targets: 13, // cuota mensual
                     className: 'dt-body-right',
                     render: $.fn.dataTable.render.number(',', '.', 0, '$ ')
                 },
                 {
                     targets: 14, // cuota semanal
                     className: 'dt-body-right',
                     render: $.fn.dataTable.render.number(',', '.', 0, '$ ')

                 },
                 {
                     targets: 15, // cuota semanal
                     className: 'dt-body-right',
                     render: $.fn.dataTable.render.number(',', '.', 0, '$ ')

                 },
                 {
                     targets: 16, // no muestra el testigo
                     visible: false
                 },
                 {
                     targets: 18,


                     orderable: false,
                     render: function(data, type, full, meta) {
                         return "<center>" +
                             "<span class='btnBuscarExpediente text-success px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Seleccionar Expediente'> " +
                             "<i class='fa fa-print' aria-hidden=true></i>" +
                             "</span>" +
                             "</center>"
                     }
                 }

             ],



      /*  
      ,
                 {
                     targets: 17, // estatus
                     className: 'dt-body-center',
                     createdCell: function(td, cellData, rowData, row, col) {
                         if ((rowData[17]) == 'Baja') {
                             $(td).parent().css('background', '#FF5733')
                             $(td).parent().css('color', '#ffffff')
                         }
                     }
                 }
        ], */
             fixedColumns: {
                 left: 1,
                 right: 1
             },
             language: {
                 url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
              }
         });

     })
     /* ======================================================================================
           EVENTO PARA CARGAR EL DATATABLE DE EXPEDIENTES DE PACIENTES
       ===================================================================================== */
     $('#tbl_expedientes tbody').on('click', '.btnBuscarExpediente', function() {

         var dataex = tableEx.row($(this).parents('tr')).data(); //Recuperar los datos de la fila

         var idx = tableEx.row($(this).parents('tr')).index(); // Recuperar el Indice de la Fila
       //  console.log("🚀 ~ file: expedientes.php ~ line 1198 ~ $ ~ data", dataex)
         //var id_concepto = data['id_concepto'];
         var id_paciente = dataex['id_paciente'];
         var id_expediente = dataex['id_expediente'];
         var id_clinica = dataex['id_clinica'];
       // alert('id expediente = ' + id_expediente +' id paciente =' + id_paciente + '  id clinica = ' + id_clinica);
        $.ajax({

            async: false,
            url: "../ejemplo.php",
            method: "POST",
            data: {
                'accion': 7,
                'id': id_paciente
            },
            dataType: 'json',
            success: function(respuesta) {

            }
            });
         $.ajax({

                async: false,
                url: "../ejemplo.php",
                method: "POST",
                data: {
                    'accion': 77, // cuenta el número de veces dentro de la clínica
                    'id_paciente': id_paciente,
                    'id_clinica': id_clinica
                },
                dataType: 'json',
                success: function(respuesta) {

                }
         });
         $.ajax({

            async: false,
            url: "../ejemplo.php",
            method: "POST",
            data: {
                'accion': 79, // cuenta el número de veces dentro de la clínica
                'id_expediente': id_expediente,
                'id_clinica': id_clinica
            },
            dataType: 'json',
            success: function(respuesta) {

            }
            });
        
     /*   $.ajax({

            async: false,
            url: "../ajax/pacientes.ajax.php",
            method: "POST",
            data: {
                'accion': 7,
                'id': id_paciente
            },
            dataType: 'json',
            success: function(respuesta) {
              var estatuspac  = respuesta["estatus"];
             // if(estatuspac == 'Becado'){
                 // alert('Paciente Becado');
              //    Swal.fire(' El Paciente ' + respuesta['nombre'] + ' está Becado... Verifique!!!'
                //    )
               // LimpiarInputs();
              //}
             // else
              //{
                var nombre = dataex['NOMBRE'];
             //   $("#iptNombre_Paciente").val(dataex["NOMBRE"]);
             //   $("#iptId_Expediente").val(dataex["id_expediente"]);
                    id_expediente = dataex['id_expediente'];
                  //  alert('id expediente ' + id_expediente);
                var cuota_ingreso = dataex['cuota_ingreso'];
                var cuota_semanal = dataex['cuota_semanal'];
                var extras = dataex['extras'];
                var estatus = dataex['estatus'];
                //iptCuota_Ingreso
              //  $("#iptCuota_Ingreso").val(dataex["cuota_ingreso"]);
             //   $("#iptCuota_Semanal").val(dataex["cuota_semanal"]);
              //  $("#iptExtras").val(dataex["extras"]);
              //
             //   cargarperiodosdepago();
              //  if (cuota_ingreso==0 && cuota_semanal==0 && extras == 0){
              //      Swal.fire(' El Paciente ' + respuesta['nombre'] + ' no tiene asignada ninguna Cuota... Verifique!!!');
              //      $("#mdlGestionarExpedientes").modal('hide');
              //  }
             //   else{
             //       $("#mdlGestionarExpedientes").modal('hide');
              //  }
               
              //}
            }
            }); */

     });
 </script>