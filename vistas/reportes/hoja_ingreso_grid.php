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
                <input type="hidden" id="Id_Expedientep"/> 
            
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
</div>
    <?php
       // include "../vistas/modulos/modales.expedientes.php";
    ?>
<script>
var accion;
var table;
var fecha;
var genero_periodos;

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
    // CARGA DEL LISTADO CON EL PLUGIN DATATABLE JS
    /*===================================================================*/
    table = $("#tbl_expedientes").DataTable({
        
        dom: 'f', // Para que los botones se pongan en la parte Superior
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
                'accion': 1 //1: LISTAR EXPEDIENTES DE PACIENTES
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
                        "<span class='btnImprimirNotificacion text-primary px-2' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Notificación a M.P.'> " +
                        "<i class='fas fa-print fs-6'></i>" 
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


    $('#tbl_expedientes tbody').on('click', '.btnImprimirNotificacion', function(){
           //alert('Entró a imprimir notificación');
           var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }

      $("#Id_Expedientep").val(data[1]);
      var expediente = $("#Id_Expedientep").val();
     
         //alert ('Expediente :' + expediente);
        generarPDF(expediente);
        location.reload();
     /*$.ajax({

    async: false,
    url: "../ajax/ingresos.ajax.php",
    method: "POST",
    data: {
        'accion': 6,
        'folio': folio
    },
    dataType: 'json',
    success: function(respuesta) {

    // alert('El ticket');
        generarPDF(folio);
        location.reload();
    // var estatuspac  = respuesta["estatus"];
    }
    }); */
    });

    
    
    
 
            
    }); //fin del document ready

    function generarPDF(expediente){
       // alert('adentro de generar PDF');
        var ancho =1000;
        var alto= 800;
        //calcular la posición x,y para centrar la ventana
        var x= parseInt((window.screen.width/2) - (ancho/2));
        var y= parseInt((window.screen.height/2) - (alto/2));
        $url = '../factura/generahojadeingreso.php?expediente=' + expediente;
       
        window.open($url,"Notificacion","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");

     }
    


</script>
<!--<script src="http://momentjs.com/downloads/moment.min.js"></script> -->
         

