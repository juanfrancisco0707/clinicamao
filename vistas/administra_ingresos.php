<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../index.php');
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h4 class="m-0">Ingresos</h4>
                <input type="hidden" id="vrol" name="vrol" value='<?php echo $_SESSION['S_ROL']; ?>'/> 
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item">Ingresos</li>
                    <li class="breadcrumb-item active">Administrar Ingresos</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content pb-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Criterios de Búsqueda</h3>
                        <div class="card-tools"><button class="btn btn-tool" type="button" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Ingresos desde:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                        <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" id="ingresos_desde" value="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Ingresos hasta:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                        <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" id="ingresos_hasta" value="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Paciente:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-user"></i></span></div>
                                        <input type="text" id="iptPaciente"  class="form-control" data-index="0"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Folio:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-barcode"></i></span></div>
                                        <input type="text" id="iptFolio" placeholder="0" class="form-control" data-index="0"/>
                                    </div>
                                </div>
                            </div>
                          <!--  <div style="width: 20%;" class="form-floating mx-1">
                                    <input type="text" id="iptPaciente" class="form-control" data-index="5">
                                    <label for="iptProducto">Paciente</label>
                                </div> -->
                            <div class="col-md-2 d-flex flex-row align-items-center justify-content-end">
                                <div href="#" class="form-group m-0"><a class="btn btn-primary" style="width:120px;" id="btnFiltrar">Buscar</a></div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <h4>Total pago: $  <span id="totalPago">0.00</span></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="display nowrap table-striped w-100 shadow" id="lstPagos">
                    <thead class="bg-info">
                        <tr>
                            <th>Id</th>
                            <th>Folio</th>                                                        
                            <th>Descripcion</th>
                            <th>Cantidad</th>            
                            <th>Cuota</th>
                            <th>Importe</th>
                            <th>Fecha Pago</th>
                        </tr>
                    </thead>
                    <tbody class="small"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        var table, ingresos_desde, ingresos_hasta,paciente;
        var groupColumn = 0;
        var total_pago=0;
        var folio=0;

       // $('#ingresos_desde, #ingresos_hasta').inputmask('dd/mm/yyyy', {
       //     'placeholder': 'dd/mm/yyyy'
       // })
      
       // $("#ingresos_desde").val(moment().startOf('month').format('DD/MM/YYYY'));
       // $("#ingresos_hasta").val(moment().format('DD/MM/YYYY'));

        ingresos_desde = $("#ingresos_desde").val();
        ingresos_hasta = $("#ingresos_hasta").val();
       
  
        table = $('#lstPagos').DataTable({  
            "columnDefs": [
                { visible: false, targets: groupColumn },
                {
                    targets: [1,2,3,4,5],
                    orderable: false
                }
            ],
            "order": [[ 6, 'desc' ]],
            dom: 'Brtip',
            buttons: [
                'excel', 'print', 'pageLength',

            ],
            lengthMenu: [0, 5, 10, 15, 20, 50],
            "pageLength": 15,
            ajax: {
                url: '../ajax/ingresos.ajax.php',
                type: 'POST',
                dataType: 'json',
                "dataSrc": function(respuesta){
                    totalPago=0.00;
                   // alert('entró a totalizar');
                    for(let i=0; i< respuesta.length; i++){
                     totalPago=parseFloat(respuesta[i][5].replace('$ ','')) + parseFloat(totalPago);
                   //  totalPago=parseFloat(respuesta[i][5]) + parseFloat(totalPago);
                    }
                    $("#totalPago").html(totalPago.toFixed(2))
                    return respuesta;
                },
                data: {
                    'accion': 2,
                    'fechaDesde': ingresos_desde,
                    'fechaHasta' : ingresos_hasta
                }                              
            },
            drawCallback: function (settings) {
               
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;
    
                api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {                
                                    
                    if ( last !== group ) {

                        const data = group.split("-");
                        var nro_folio = data[0];
                        nro_folio = nro_folio.split(":")[1].trim();   
                                           
                      //  console.log("🚀 ~ file: administrar_ingresos.php ~ line 144 ~ nro_folio", nro_folio)

                        $(rows).eq(i).before(
                            '<tr class="group">'+
                                '<td colspan="6" class="fs-6 fw-bold fst-italic bg-success text-white"> ' +
                                '<i nro_folio = ' + nro_folio + ' class="fas fa-trash fs-6 text-danger mx-2 btnEliminarPago" style="cursor:pointer;"></i> <i nro_folio = ' + nro_folio + ' class="fas fa-print fs-6 text-secondary mx-2 btnImprimirPago" style="cursor:pointer;"></i> '+
                                        group +  
                                '</td>'+
                            '</tr>'
                        );

                        last = group;
                    }
                } );
            },
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });
        /* ***************************
        Evento para Imprimir un Ticket de pago
        ***************************** */
       // var table = $('#lstPagos').DataTable({  });

    /*===================================================================*/
    // EVENTOS PARA CRITERIOS DE BUSQUEDA (PACIENTE)
    /*===================================================================*/
    $("#iptPaciente").keyup(function() {
       // alert('entró al criterio de busqueda');
       // table.column($(this).data('index')).search(this.value).draw();
    })



        $('#lstPagos tbody').on('click', 'tr', function () {
           
           
  
             
        });

        
        $('#lstPagos tbody').on('click', '.btnImprimirPago', function(){

           
            var folio = $(this).attr("nro_folio");
            $.ajax({

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
            });
        });

        /* Evento para eliminar un ticket de pago
        ***************************** */
        $('#lstPagos tbody').on('click', '.btnEliminarPago', function(){
          var   vroles = $('#vrol').val();
         // alert('vroles = ' + vroles);
        if (vroles==1) 
          {      

               var nrofolio = $(this).attr("nro_folio");
             // alert(' FOLIO a BORRAR= '+ nrofolio);
               Swal.fire({
                        title: 'Está seguro de eliminar este folio del registro de pagos?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, deseo eliminarlo!',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {

                         if (result.isConfirmed) {
                            $.ajax({
                                url:"../ajax/ingresos.ajax.php",
                                type: "POST",
                                data:{accion : '3',folio: String(nrofolio)},
                                dataType: 'json',
                                success:function(respuesta){
                                    Swal.fire({
                                        position:'center',
                                        icon:'success',
                                        title:respuesta,
                                        showConfirmButton:false,
                                        timer:1500
                                        })
                     

                                  table.ajax.reload();
                                   }   
                             });
                           }
                    })

                }
                else{
            Swal.fire(
            'Lo siento!',
             'Usuario sin permisos para realizar esta operación',
             'error'
            );
        }
        });

        
        /* ***************************
        Evento para filtrar un folio de pago
        ***************************** */
        $('#btnFiltrar').on('click', function(){
          
            table.destroy();
        
            if($("#ingresos_desde").val() == '' ){
                ingresos_desde = '2000-01-01';
            }else {
                ingresos_desde = $("#ingresos_desde").val();
            }
            if($("#ingresos_hasta").val()==''){
                ingresos_hasta ='2000/01/01';
            }else{
                ingresos_hasta =$("#ingresos_hasta").val();
            }
            paciente = $("#iptPaciente").val();
            folio = $("#iptFolio").val();
               var groupColumn =0;
          table = $('#lstPagos').DataTable({  
            "columnDefs": [
                { visible: false, targets: groupColumn },
                {
                    targets: [1,2,3,4,5],
                    orderable: false
                }
            ],
            "order": [[ 6, 'desc' ]],
            dom: 'Brtip',
            buttons: [
                'excel', 'print', 'pageLength',

            ],
            lengthMenu: [0, 5, 10, 15, 20, 50],
            "pageLength": 15,
                ajax: {
                    url: '../ajax/ingresos.ajax.php',
                    type: 'POST',
                    dataType: 'json',
                    "dataSrc": function(respuesta){
                        totalPago=0.00;
                       
                       // alert('despues del filtro');
                        for(let i=0; i< respuesta.length; i++){

                        totalPago=parseFloat(respuesta[i][5].replace('$ ','')) + parseFloat(totalPago);
                       // totalPago=parseFloat(respuesta[i][5]) + parseFloat(totalPago);
                        }
                        $("#totalPago").html(totalPago.toFixed(2))
                        return respuesta;
                    },
                    data: {
                        'accion': 22,
                        'fechaDesde': ingresos_desde,
                        'fechaHasta' : ingresos_hasta,
                        'paciente': paciente,
                        'folio': folio
                    }                              
                },
                drawCallback: function (settings) {
                
                    var api = this.api();
                    var rows = api.rows( {page:'current'} ).nodes();
                    var last=null;
        
                    api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {                
                                        
                        if ( last !== group ) {

                            const data = group.split("-");
                            var nro_folio = data[0];
                            nro_folio = nro_folio.split(":")[1].trim();                        
                         //   console.log("🚀 ~ file: administrar_ingresos.php ~ line 144 ~ nro_folio", nro_folio)

                            $(rows).eq(i).before(
                                '<tr class="group">'+
                                  '<td colspan="6" class="fs-6 fw-bold fst-italic bg-success text-white"> ' +
                                  '<i nro_folio = ' + nro_folio + ' class="fas fa-trash fs-6 text-danger mx-2 btnEliminarPago" style="cursor:pointer;"></i> <i nro_folio = ' + nro_folio + ' class="fas fa-print fs-6 text-primary mx-2 btnImprimirPago" style="cursor:pointer;"></i> '+
                                        group +  
                                  '</td>'+
                                '</tr>'
                            );

                            last = group;
                        }
                        });
                    },
                    language: {
                          "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                    }
         });
        });

      
})

$(document).ready(function() {
   
    

});
function adaptar ( value ) {
  return !isNaN(value) ? value : 0;
}
function generarPDF(folio){
       // alert('adentro de generar PDF');
        var ancho =1000;
        var alto= 800;
        //calcular la posición x,y para centrar la ventana
        var x= parseInt((window.screen.width/2) - (ancho/2));
        var y= parseInt((window.screen.height/2) - (alto/2));
        $url = '../factura/generaFactura.php?folio=' + folio;
       
        window.open($url,"Ticket","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");

     }
    

</script>
