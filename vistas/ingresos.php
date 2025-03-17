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
                 <h1 class="m-0">Ingresos</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Ingresos</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->

 <!-- Main content -->
 <div class="content">
     <div class="container-fluid">
         <div class="row mb-3">
             <div class="col-md-9">
                 <div class="row">
                     <!-- INPUT  -->
                     <!-- Columna para registro del Id del Paciente-->
                     <div class="col-8 col-lg-6" style="display:none;">
                         <div class="form-group mb-2">
                             <label class="" for="iptId_Paciente"><i class="fa fa-unlock" aria-hidden="true"></i>
                                 <span class="small">id Paciente</span><span class="text-danger">*</span>
                             </label>
                             <input type="text" class="form-control form-control-sm" id="iptId_Paciente" name="iptId_Paciente" disabled>
                         </div>
                     </div>
                     <div class="col-8 col-lg-6" style="display:none;">
                         <div class="form-group mb-2">
                             <label class="" for="iptId_Expediente"><i class="fa fa-unlock" aria-hidden="true"></i>
                                 <span class="small">id Expediente</span><span class="text-danger">*</span>
                             </label>
                             <input type="text" class="form-control form-control-sm" id="iptId_Expediente" name="iptId_Expediente" disabled>
                         </div>
                     </div>

                     <!--  <div class="input-group">
                         <input id="txtPassword" type="Password" class="form-control form-control-sm" />
                         <div class="input-group-append">
                             <button id="show_password" class="btn btn-success btn-sm" type="button" onclick="mostrarPassword()">
                                 <span class="fa fa-search" aria-hidden="true"></span>
                             </button>
                         </div>
                     </div> -->
                     <div class="col-md-8 mb-1">
                           <div class="form-group mb-1" >
                        <label class="col-form-label" for="iptNombre_Paciente">
                            <i class="fas fa-barcode fs-6"></i>
                            <span class="small">Pacientes</span>
                        </label>
                      
                    </div>
                         <div class="input-group mb-1">
                           
                             <input type="text" class="form-control form-control-sm" id="iptNombre_Paciente" placeholder="Nombre del paciente" disabled>
                             <button class="btn btn-outline-primary btn-sm" class="input-control form-control-sm " type="button" id="btnbuscaPaciente">
                             <span class="fa fa-search" aria-hidden="true"></span></button>
                         </div>
                     </div> <!-- fin del div del nombre del Paciente -->



                     <!-- Fecha del pago -->
                     <div class="col-4  col-lg-4">
                         <div class="form-group mb-1">
                             <label class="col-form-label" for="iptFecha_Pago">
                                 <i class="fa fa-calendar" aria-hidden="true"></i>
                                 <span class="small">Fecha</span>
                             </label>
                             <input type="Date" class="form-control form-control-sm" id="iptFecha_Pago" value="<?php echo date("Y-m-d"); ?>">
                         </div>
                     </div>
                     <!-- Cuota de Ingreso -->
                     <div class="col-4  col-lg-4">
                         <div class="form-group mb-1">
                             <label class="col-form-label" for="iptCuota_Ingreso">
                                 <i class="fas fa-dollar-sign fs-6"></i>
                                 <span class="small">Cuota Ingreso</span>
                             </label>
                             <input type="number" class="form-control form-control-sm" id="iptCuota_Ingreso" placeholder="Cuota de Ingreso" disabled>
                         </div>
                     </div>
                     <!-- Cuota Semanal -->
                     <div class="col-4  col-lg-4">
                         <div class="form-group mb-1">
                             <label class="col-form-label" for="iptCuota_Semanal">
                                 <i class="fas fa-dollar-sign fs-6"></i>
                                 <span class="small">Semanal</span>
                             </label>
                             <input type="number" class="form-control form-control-sm" id="iptCuota_Semanal" placeholder="Cuota Semanal">
                         </div>
                     </div>
                     <!-- Cuota Semanal -->
                     <div class="col-4  col-lg-4">
                         <div class="form-group mb-1">
                             <label class="col-form-label" for="iptExtras">
                                 <i class="fas fa-dollar-sign fs-6"></i>
                                 <span class="small">Extras</span>
                             </label>
                             <input type="number" class="form-control form-control-sm" id="iptExtras" placeholder="Extras para consumo interno" disabled>
                         </div>
                     </div>
                 <!--    <div class="form-group mb-1">-->
                 <div class="col-6  col-lg-6">
                         <label class="col-form-label" for="selId_Concepto">
                             <i class="fas fa-barcode fs-6"></i>
                             <span class="small">Conceptos</span>
                         </label>
                         <!--  <input type="text" class="form-control form-control-sm" id="iptId_Concepto"
                            placeholder="Ingrese el número ó nombre del paciente"> -->
                         <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="selId_Concepto" required>
                         </select>   
                </div>   
                <div class="col-6  col-lg-6">
                         <label class="col-form-label" for="selId_Periodo">
                         <i class="fa fa-calendar" aria-hidden="true"></i>
                             <span class="small">Períodos</span>
                         </label>
                         <!--  <input type="text" class="form-control form-control-sm" id="iptId_Concepto"
                            placeholder="Ingrese el número ó nombre del paciente"> -->
                         <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="selId_Periodo" required>
                         </select>
                 </div> 
                <!--   </div> -->
                 </div> <!-- Este es del row -->

                 <div class="col-md-12 mb-2">
                     
                     
                     <div class="form-group mb-1">
                         <label class="col-form-label" for="iptDescripcion">
                             <i class="fas fa-barcode fs-6"></i>
                             <span class="small">Descripción</span>
                         </label>
                           <input type="text" class="form-control form-control-sm" id="iptDescripcion"
                            placeholder="Ingrese descripción del Ingreso">
                         
                     </div>
                     <!-- ETIQUETA QUE MUESTRA LA SUMA TOTAL DE LOS CONCEPTOS DE PAGO AGREGADOS AL LISTADO -->
                     <div class="col-md-6 mb-3">
                         <h4 style="display:none;">Total Pago: $<span id="totalPago" style="display:none;">0.00 </span> </h4>
                     </div>

                     <!-- BOTONES PARA VACIAR LISTADO Y COMPLETAR EL PAGO -->
                     <div class="col-md-12 text-right">
                         <button class="btn btn-success" id="btnAgregarDetalle" style="margin-right: 10px">
                             <i class="fa fa-plus-square" aria-hidden="true"></i> Agregar
                         </button>
                         <button class="btn btn-primary" id="btnIniciarPago" style="margin-right: 10px">
                             <i class="fas fa-shopping-cart"></i> Realizar Pago
                         </button>
                         <button class="btn btn-danger" id="btnVaciarListado">
                             <i class="far fa-trash-alt"></i> Vaciar Listado
                         </button>
                     </div>
                     <div class="col-md-8 mb-2">

                     </div>
                     <!-- LISTADO QUE CONTIENE LOS CONCEPTOS QUE SE VAN AGREGANDO PARA EL PAGO -->
                     <div class="col-md-12">

                         <table id="lstConceptosPagos" class="display nowrap table-striped w-100 shadow ">
                             <thead class="bg-info text-left fs-6">
                                 <tr>
                                     <th>Id</th>
                                     <th>Folio</th>
                                     <th>Id Periodo</th>
                                     <th>Cantidad</th>
                                     <th>Id Concepto</th>
                                     <th>Descripción</th>
                                     <th>Cuota</th>
                                     <th>Importe</th>
                                     <th class="text-center">Opciones</th>
                                 </tr>
                             </thead>
                             <tbody class="small text-left fs-6">
                             </tbody>
                         </table>
                         <!-- / table -->
                     </div>
                     <!-- /.col -->

                 </div>

             </div>

             <div class="col-md-3">

                 <div class="card shadow">

                     <h5 class="card-header py-1 bg-primary text-white text-center">
                         Total Pago: $./ <span id="totalPagoRegistrar">0.00</span>
                     </h5>

                     <div class="card-body p-2">

                         <!-- SELECCIONAR TIPO DE DOCUMENTO -->
                         <div class="form-group mb-2">

                             <label class="col-form-label" for="selCategoriaReg">
                                 <i class="fas fa-file-alt fs-6"></i>
                                 <span class="small">Documento</span><span class="text-danger">*</span>
                             </label>

                             <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="selDocumentoVenta" disabled>
                                 <option value="0">Seleccione Documento</option>
                                 <option value="1" selected="true">Ticket</option>
                             </select>

                             <span id="validate_categoria" class="text-danger small fst-italic" style="display:none">
                                 Seleccione documento
                             </span>

                         </div>

                         <!-- SELECCIONAR TIPO DE PAGO -->
                         <div class="form-group mb-2">

                             <label class="col-form-label" for="selCategoriaReg">
                                 <i class="fas fa-money-bill-alt fs-6"></i>
                                 <span class="small">Tipo Pago</span><span class="text-danger">*</span>
                             </label>

                             <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="selTipoPago" disabled>
                                 <option value="0">Seleccione Tipo Pago</option>
                                 <option value="1" selected="true">Efectivo</option>
                                 <option value="2">Tarjeta</option>
                             </select>

                             <span id="validate_categoria" class="text-danger small fst-italic" style="display:none">
                                 Debe Ingresar tipo de pago
                             </span>

                         </div>

                         <!-- FOLIO DEL TICKET-->
                         <div class="form-group">

                             <div class="row">

                                 <div class="col-md-8">

                                     <label for="iptFolioPago">Folio</label>

                                     <input type="text" min="0" name="iptEfectivo" id="iptFolioPago" class="form-control form-control-sm" placeholder="Folio" disabled style="text-align:center">
                                 </div>
                             </div>
                         </div>

                         <!-- INPUT DE EFECTIVO ENTREGADO -->
                         <div class="form-group">
                             <label for="iptEfectivoRecibido">Efectivo recibido</label>
                             <input type="number" min="0" name="iptEfectivo" id="iptEfectivoRecibido" class="form-control form-control-sm" placeholder="Cantidad de efectivo recibida">
                         </div>

                         <!-- INPUT CHECK DE EFECTIVO EXACTO -->
                         <div class="form-check">
                             <input class="form-check-input" type="checkbox" value="" id="chkEfectivoExacto">
                             <label class="form-check-label" for="chkEfectivoExacto">
                                 Efectivo Exacto
                             </label>
                         </div>

                         <!-- MOSTRAR MONTO EFECTIVO ENTREGADO Y EL VUELTO -->
                         <div class="row mt-2">

                             <div class="col-12">
                                 <h6 class="text-start fw-bold">Monto Efectivo: $  <span id="EfectivoEntregado">0.00</span></h6>
                             </div>

                             <div class="col-12">
                                 <h6 class="text-start text-danger fw-bold">Vuelto: $ <span id="Vuelto">0.00</span>
                                 </h6>
                             </div>

                         </div>

                         <!-- MOSTRAR EL SUBTOTAL, IVA Y TOTAL DEL PAGO -->
                         <div class="row">
                             <div class="col-md-7">
                                 <span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                             </div>
                             <div class="col-md-5 text-right">
                             &nbsp  <span class="" id="pago_subtotal">&nbsp&nbsp&nbsp</span>
                             </div>

                             <!--    <div class="col-md-7">
                            <span>__________</span>
                        </div>
                        <div class="col-md-5 text-right">
                            ___ <span class="" id="boleta_igv">0.00</span>
                        </div> -->

                             <div class="col-md-7">
                                 <span>TOTAL</span>
                             </div>
                             <div class="col-md-5 text-right">
                                 $ <span class="" id="pago_total">0.00</span>
                             </div>
                         </div>

                     </div><!-- ./ CARD BODY -->

                 </div><!-- ./ CARD -->
             </div>

         </div>
     </div>
 </div>
 <?php
    include "../vistas/modulos/modal.expediente.pagos.php";
    ?>
 <script>
     var table;
     var items = []; // SE USA PARA EL INPUT DE AUTOCOMPLETE
     var itemConcepto = 1;
     var consecutivo=0;
     var id_expediente=0;

     var Toast = Swal.mixin({
         toast: true,
         position: 'top',
         showConfirmButton: false,
         timer: 3000
     });

     $(document).ready(function() {

         /*===================================================================*/
         //SOLICITUD AJAX PARA CARGAR SELECT DE CONCEPTOS
         /*===================================================================*/
         $.ajax({
             url: "../ajax/conceptoscb.ajax.php",
             cache: false,
             contentType: false,
             processData: false,
             dataType: 'json',
             success: function(respuesta) {

                 var options = '<option selected value="">Seleccione un concepto</option>';

                 for (let index = 0; index < respuesta.length; index++) {
                     options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                         1
                     ] + '</option>';
                 }

                 $("#selId_Concepto").append(options);
             }
         });

         /*===================================================================*/
         //SOLICITUD AJAX PARA CARGAR SELECT DE PERIODOS
         /*===================================================================*/
        
         /*===================================================================== */
         // CARGA EL FOLIO DEL RECIBO DE PAGO 
         /*===================================================================== */
         $.ajax({

             async: false,
             url: "../ajax/ingresos.ajax.php",
             method: "POST",
             data: {
                 'accion': 1
             },
             dataType: 'json',
             success: function(respuesta) {
                 folio_pago = respuesta["folio_pago"];
                 $("#iptFolioPago").val(folio_pago);

             }
         });

         /* ======================================================================================
         EVENTO PARA VACIAR LOS DATOS INGRESADOS
         =========================================================================================*/
         $("#btnVaciarListado").on('click', function() {
             var c=0;
            table.rows().eq(0).each(function(index) {
             c = c + 1;
         });
                 if(c >0)
                     {

             Swal.fire({
                        title: 'Está seguro de eliminar el listado de Pagos?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, deseo eliminarlo!',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {

                    if (result.isConfirmed) {
                        vaciarListado();
                        recalcularTotales();
                        }
                    })

                }

         })

         /* ======================================================================================
         INICIALIZAR LA TABLA DE INGRESOS
         ======================================================================================*/
         table = $('#lstConceptosPagos').DataTable({
             "bPaginate": false,
             "bFilter": false,
             "bInfo": false,
             "columns": [{
                     "data": "id"
                 },
                 {
                     "data": "id_periodo"
                 },
                 {
                     "data": "folio_detalle"
                 },
                 {
                     "data": "cantidad"
                 },
                 {
                     "data": "id_concepto"
                 },
                 {
                     "data": "descripcion_detalle"
                 },
                 {
                     "data": "precio"
                 },
                 {
                     "data": "importe"
                 },
                 {
                     "data": "acciones"
                 }
             ],
             columnDefs: [{
                 
                     targets: 0, // id
                     visible: false
                 },
                 { 
                     className: 'text-center', targets: [0]
                 },
                 { 
                     className: 'text-right', targets: [6,7]
                 },
                 { 
                     className: 'text-center', targets: [3]
                 },
                 {
                     targets: 1, // folio
                     visible: false
                 },
                 {
                     targets: 2, // folio
                     visible: false
                 },
                 {
                     targets: 3, // cantidad
                     className: 'dt-body-center',
                     visible: true
                 },
                 {
                     targets:  4, //id concepto
                     visible: false
                 },
                 {
                     targets:  5, // descripcion
                     visible: true
                 },
                 {
                     targets:  6, // precio
                     className: 'dt-body-right',
                     render: $.fn.dataTable.render.number( ',', '.', 0, '$ ' ),
                     visible: true
                 },
                 {
                     targets: 7, // importe
                     className: 'dt-body-right',
                     render: $.fn.dataTable.render.number( ',', '.', 0, '$ ' ),
                     visible: true
                 }
                 ,
                 {
                     targets: 8, // Opciones
                     visible: true,
                     orderable: false
                 }
             ],
             "order": [
                 [0, 'desc']
             ],
             "language": {
                 "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
             }
         });
        /* ======================================================================================
         EVENTO QUE REGISTRA EL CONCEPTO EN EL LISTADO
         ======================================================================================*/
         $("#iptCodigoConcepto").change(function() {
            // CargarDetalle();
         });
         /* ======================================================================================
         EVENTO QUE REGISTRA EL CONCEPTO EN EL LISTADO
         ======================================================================================*/
         $("#btnAgregarDetalle").click(function() {
           
             var nombre_paciente =$("#iptNombre_Paciente").val();
             var concepto = parseInt($("#selId_Concepto").val());
             var vextras = $("#iptExtras").val();
             if (isNaN(concepto) || nombre_paciente == '') {
                Swal.fire({
                        title: 'Por favor ingrese el Concepto de pago o los datos del Paciente',
                        icon: 'warning',
                         })
            }
            else if(concepto == 1){
                
                   $.ajax({
                        async: false,
                        url: "../ajax/ingresos.ajax.php",
                        method: "POST",
                        data: {
                            'accion': 5,
                            'id_expediente':id_expediente
                        },
                        dataType: 'json',
                        success: function(respuesta) {
                           if(respuesta ==="ok")
                           {
                           // alert('encontró el pago');
                            Swal.fire('Precaucion','El paciente ya realizó el pago de la Cuota de Ingreso de este Expediente, Favor de Verificar','warning'
                          );
                          }
                           else{
                            CargarConceptos();
                             //  alert('no encontró el pago');
                           }
                        }
                        });
            }



            else
            {
                if (concepto == 3 && vextras == 0){
                Swal.fire({
                        title: 'Lo siento, este paciente no tiene Dinero Extra en su Expediente',
                        icon: 'warning',
                         })
                        }
                        else{ 
                            CargarConceptos();
                        }
            }
            
                   
                
         });
         /* ======================================================================================
         EVENTO PARA ELIMINAR UN CONCEPTO DEL LISTADO
         ======================================================================================*/
         $('#lstConceptosPagos tbody').on('click', '.btnEliminarConcepto', function() {

          //  if (vroles==1) 
          //{     
                    Swal.fire({
                        title: 'Está seguro de eliminar este concepto de Pago?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, deseo eliminarlo!',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {

                    if (result.isConfirmed) {
                        table.row($(this).parents('tr')).remove().draw();
                        recalcularTotales();
                        }
                    })
        //} // sesion
        //else{
           // Swal.fire(
          //  'Lo siento!',
          //   'Usuario sin permisos',
           //  'error'
           // );
        //}
         });

         /* ======================================================================================
         EVENTO PARA AUMENTAR LA CANTIDAD DE PAGO DE UN CONCEPTO DEL LISTADO
         ====================================================================================== */
         $('#lstConceptosPagos tbody').on('click', '.btnAumentarCantidad', function() {

             var data = table.row($(this).parents('tr')).data(); //Recuperar los datos de la fila

             var idx = table.row($(this).parents('tr')).index(); // Recuperar el Indice de la Fila

             var id_concepto = data['id_concepto'];
             var cantidad = data['cantidad'];
             cantidad = parseInt(data['cantidad']) + 1;

                table.cell(idx, 2).data(cantidad).draw();

                NuevoPrecio = (parseInt(data['cantidad']) * data['precio']);
                //NuevoPrecio = "S./ " + NuevoPrecio;
                table.cell(idx, 6).data(NuevoPrecio).draw();

                recalcularTotales();

         });

         /* ======================================================================================
         EVENTO PARA DESMINUIR LA CANTIDAD DE PAGOS DE UN CONCEPTO DEL LISTADO
         ======================================================================================*/
         $('#lstConceptosPagos tbody').on('click', '.btnDisminuirCantidad', function() {

             var data = table.row($(this).parents('tr')).data();

             if (parseInt(data['cantidad']) >= 2) {

                 cantidad = parseInt(data['cantidad']) - 1;

                 var idx = table.row($(this).parents('tr')).index();

                 table.cell(idx, 2).data(cantidad).draw();

                 NuevoPrecio = (parseInt(data['cantidad']) * data['precio']);
                 //NuevoPrecio = "S./ " + NuevoPrecio;

                 table.cell(idx, 6).data(NuevoPrecio).draw();

             }

             recalcularTotales();
         });
         /* =======================================================================================
         EVENTO QUE PERMITE CHECKEAR EL EFECTIVO CUANDO ES EXACTO
         =========================================================================================*/
         $("#chkEfectivoExacto").change(function() {

             if ($("#chkEfectivoExacto").is(':checked')) {

                 var vuelto = 0;
                 var totalPago = $("#totalPago").html();

                 $("#iptEfectivoRecibido").val(totalPago);

                 $("#EfectivoEntregado").html(totalPago);

                 var EfectivoRecibido = parseFloat($("#EfectivoEntregado").html().replace("S./ ", ""));

                 vuelto = parseFloat(totalPago) - parseFloat(EfectivoRecibido);

                 $("#Vuelto").html(vuelto.toFixed(2));

             } else {

                 $("#iptEfectivoRecibido").val("")
                 $("#EfectivoEntregado").html("0.00");
                 $("#Vuelto").html("0.00");

             }
         })

         /* ======================================================================================
         EVENTO QUE SE DISPARA AL DIGITAR EL MONTO EN EFECTIVO ENTREGADO POR EL CLIENTE
         =========================================================================================*/
         $("#iptEfectivoRecibido").keyup(function() {
             actualizarVuelto();
         });

         /* ======================================================================================
         EVENTO PARA INICIAR EL REGISTRO DEL INGRESO
         ====================================================================================== */
         $("#btnIniciarPago").on('click', function() {
             realizarPago();
         })
         $("#btnbuscaPaciente").on('click', function() {
             $("#mdlGestionarExpedientes").modal('show');

         })
         $("#selId_Periodo").change(function() {
            // alert(' entro a cargar los periodos de pago');


        })
        $("#selId_Concepto").change(function() {
            
             var id_concepto = $("#selId_Concepto").val();
            // alert(' id concepto = ' + id_concepto);
             if(id_concepto != 2)
             {
                  $("#selId_Periodo").prop("selectedIndex", 0).val();
                  //$("#selId_Periodo").eq(0);
                  $("#selId_Periodo").prop( "disabled", true );
                  
             }
                else $("#selId_Periodo").prop( "disabled", false );


        })


})  //FIN DOCUMENT READY
     var cci =0 ; // contador de cuota de ingreso
    
    function CargarConceptos(){
       // buscar si ya pagó la cuota de ingreso del expediente
            var id_expediente = $("#iptId_Expediente").val();
            consecutivo++;
            var id_concepto = $("#selId_Concepto").val();
             // busca si la cuota de ingreso ya fue pagada
           
             var descripcion="";
             var precio=0;
             var folio_detalle =$("#iptFolioPago").val();
             var cuota_ingreso = $("#iptCuota_Ingreso").val();
             var cuota_semanal = $("#iptCuota_Semanal").val();
             var extras = $("#iptExtras").val();
             var cantidad = 1;
             var id_periodo = $("#selId_Periodo").val();
               
           
             var periodo= $( "#selId_Periodo option:selected" ).text();
             var aai = periodo.substr(0,4);
             var mmi = periodo.substr(5,2);
             var ddi = periodo.substr(8,2);
             var aaf = periodo.substr(13,4);
             var mmf = periodo.substr(18,2);
             var ddf = periodo.substr(21,2);
             periodo = ddi+'-'+mmi+'-'+aai+' al '+ddf +'-'+mmf+'-'+aaf;
            //var newdate = date.split("/").reverse().join("-");
         

            // alert('Periodo = ' + periodo);
             var folio_detalle = $("#iptFolioPago").val();
             if(id_concepto == 1) precio = cuota_ingreso;
             if(id_concepto == 2) precio = cuota_semanal;
             if(id_concepto == 3) precio = extras;
             var importe = cantidad * precio;
             if (importe == 0)
             {
                Swal.fire('El paciente no cuenta con ninguna Cuota, Favor de Verificar'
                   );
             }
             else
             {
          // BUSCAR LA DESCRIPCION DEL CONCEPTO POR SU ID          
                    $.ajax({
                        async: false,
                        url: "../ajax/conceptos.ajax.php",
                        method: "POST",
                        data: {
                            'accion': 7,
                            'id':id_concepto
                        },
                        dataType: 'json',
                        success: function(respuesta) {
                            descripcion = respuesta["descripcion"];
                        }
                    });
            
                       // alert('pase el ajax de cargar conceptos');
                       var concepto_repetido = 0;
                      
                        if (parseInt(id_concepto) == 2){
                        descripcion = descripcion + ' del ' + periodo;
                        }
                        else{
                            id_periodo=0;
                        }
         
           // alert('id_periodo= '+ id_periodo);

         /*===================================================================*/
         // AUMENTAMOS LA CANTIDAD SI EL CONCEPTO YA EXISTE EN EL LISTADO
         /*===================================================================*/
          table.rows().eq(0).each(function(index) {
             var row = table.row(index);
             var data = row.data();
           //  if(data['id_concepto']!='2'){
                 
             
           //  if ((parseInt(id_concepto) == data['id_concepto']) && (parseInt(id_periodo)==data['id_periodo'])){
            if ((parseInt(id_concepto) == data['id_concepto']) ){

               // alert('Entró al concepto igual');
              if (parseInt(id_periodo)==data['id_periodo']){
                 // alert('Entró al periodo igual');
                  concepto_repetido = 1;
                  
                }
                else
                {
                  if (parseInt(id_concepto) == 1){  concepto_repetido = 1;}
                 if (parseInt(id_concepto) == 3){
                    concepto_repetido = 0;
                 table.cell(index, 3).data(parseFloat(data['cantidad']) + 1).draw();
                 // ACTUALIZAR 
                             NuevoPrecio = (parseInt(data['cantidad']) * data['precio']);
                            // NuevoPrecio = "S./ " + NuevoPrecio;
                             table.cell(index, 7).data(NuevoPrecio).draw();

                             // RECALCULAMOS TOTALES
                             recalcularTotales();
                }
            }
            };
          
         }); 
               
         if (concepto_repetido == 1 ) {
             return;
         }
         
         //if(parseInt(id_concepto) == 1) concepto_repetido == 1
             
         // agrega los encabezados al detalle
         table.row.add({
                           'id': consecutivo,
                           'id_periodo': id_periodo,
                           'folio_detalle':folio_detalle,
                           'cantidad':cantidad,
                           'id_concepto':id_concepto,
                           'descripcion_detalle':descripcion,
                           'precio':precio,
                           'importe':importe,
                           'acciones': "<center>" +
                                           
                                           "<span class='btnEliminarConcepto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar concepto'> " +
                                           "<i class='fas fa-trash fs-5'> </i> " +
                                           "</span>"+
                                       "</center>"
                       }).draw();

              itemConcepto = itemConcepto + 1;
          //  Recalculamos el total del pago
          recalcularTotales();
                    }

    }

     /*===================================================================*/
     //FUNCION PARA CARGAR EL NRO DE BOLETA (no la uso la puse directo al abrir el formulario)
     /*===================================================================*/
     function CargarFolioTicket() {

         $.ajax({
             async: false,
             url: "../ajax/ingresos.ajax.php",
             method: "POST",
             data: {
                 'accion': 1
             },
             dataType: 'json',
             success: function(respuesta) {
               //  alert('folio pago ' + folio_pago);

                 folio_pago = respuesta["folio_pago"];
                 $("#iptFolioPago").val(folio_pago);

             }
         });
     }

     /*===================================================================*/
     //FUNCION PARA LIMPIAR TOTALMENTE EL CARRITO DE PAGOS
     /*===================================================================*/
     function vaciarListado() {
    
         table.clear().draw();
         LimpiarInputs();
     }

     /*===================================================================*/
     //FUNCION PARA LIMPIAR LOS INPUTS DE LA BOLETA Y LABELS QUE TIENEN DATOS
     /*===================================================================*/
     function LimpiarInputs() {

        $("#iptNombre_Paciente").val("");
        $("#iptCuota_Ingreso").val("");
        $("#iptCuota_Semanal").val("");
        $("#iptExtras").val("");
        $("#iptDescripcion").val("");
        $("#selId_concepto").val(0);
         $("#totalPago").html("0.00");
         $("#totalPagoRegistrar").html("0.00");
         $("#pago_total").html("0.00");
         $("#iptEfectivoRecibido").val("");
         $("#EfectivoEntregado").html("0.00");
         $("#Vuelto").html("0.00");
         $("#chkEfectivoExacto").prop('checked', false);
       //  $("#pago_subtotal").html("0.00");
       //  $("#boleta_igv").html("0.00")
     } /* FIN LimpiarInputs */

     /*===================================================================*/
     //FUNCION PARA ACTUALIZAR EL VUELTO
     /*===================================================================*/
     function actualizarVuelto() {

         var totalPago = $("#totalPago").html();

         $("#chkEfectivoExacto").prop('checked', false);

         var efectivoRecibido = $("#iptEfectivoRecibido").val();

         if (efectivoRecibido > 0) {

             $("#EfectivoEntregado").html(parseFloat(efectivoRecibido).toFixed(2));

             vuelto = parseFloat(efectivoRecibido) - parseFloat(totalPago);

             $("#Vuelto").html(vuelto.toFixed(2));

         } else {

             $("#EfectivoEntregado").html("0.00");
             $("#Vuelto").html("0.00");

         }
     }
     function  cargarperiodosdepago(){


     }

     function recalcularMontos(id_concepto, precio_venta) {

         table.rows().eq(0).each(function(index) {

             var row = table.row(index);

             var data = row.data();

             if (data['id_concepto'] == id_concepto) {

                 // AUMENTAR EN 1 EL VALOR DE LA CANTIDAD
                 table.cell(index, 6).data(parseFloat(precio)).draw();

                 // ACTUALIZAR EL NUEVO PRECIO DEL ITEM DEL LISTADO DE VENTA
                 NuevoPrecio = (parseFloat(data['cantidad']) * data['precio']);
                // NuevoPrecio = "S./ " + NuevoPrecio;
                 table.cell(index, 6).data(NuevoPrecio).draw();

             }


         });

         // RECALCULAMOS TOTALES
         recalcularTotales();

     }

     /*===================================================================*/
     //FUNCION PARA RECALCULAR LOS TOTALES DE VENTA
     /*===================================================================*/
    function recalcularTotales() {

         var totalPago = 0.00;
      
         table.rows().eq(0).each(function(index) {

             var row = table.row(index);
             var data = row.data();

          //   totalPago = parseFloat(totalPago) + parseFloat(data['importe'].replace("S./ ", ""));
            totalPago = parseFloat(totalPago) + parseFloat(data['importe']);
         });
        // alert('total pago ' + totalPago);
         $("#totalPago").html("");
         $("#totalPago").html(totalPago.toFixed(2));

         var totalPago = $("#totalPago").html();
         var igv = 0; //parseFloat(totalPago) * 0.16
         var subtotal = 0; //parseFloat(totalPago) - parseFloat(igv);

         $("#totalPagoRegistrar").html(totalPago);

         $("#pago_subtotal").html(parseFloat(subtotal).toFixed(2));
         $("#boleta_igv").html(parseFloat(igv).toFixed(2));
         $("#pago_total").html(parseFloat(totalPago).toFixed(2));

         //limpiamos el input de efectivo exacto; desmarcamos el check de efectivo exacto
         //borramos los datos de efectivo entregado y vuelto
         $("#iptEfectivoRecibido").val("");
         $("#chkEfectivoExacto").prop('checked', false);
         $("#EfectivoEntregado").html("0.00");
         $("#Vuelto").html("0.00");

         $("#iptCodigoConcepto").val("");
         $("#iptCodigoConcepto").focus();
     }


    /*===================================================================*/
    //REALIZAR EL PAGO
    /*===================================================================*/
    function realizarPago() {

         var count = 0;
         var folio=0;
         //var trimmed = s.replace(/\b(0(?!\b))+/g, "")
         var totalPago = $("#totalPago").html();
             folio = ($("#iptFolioPago").val()).replace(/\b0+/g, "");

        // alert('Folio sin ceros', folio)
         var fecha_pago =$("#iptFecha_Pago").val(); //iptFecha_Pago
         var descripcion = $("#iptDescripcion").val(); //iptDescripcion
        // var id_expediente = $(#iptId_Expediente)

         table.rows().eq(0).each(function(index) {
             count = count + 1;
         });

         if (count > 0) {

             if ($("#iptEfectivoRecibido").val() > 0 && $("#iptEfectivoRecibido").val() != "") {

                 if ($("#iptEfectivoRecibido").val() < parseFloat(totalPago)) {
                    // 
                    Swal.fire({icon: warning,
                        title:'El efectivo es menor al costo total del Pago'
                    
                    })
                 /*    Toast.fire({
                         icon: 'warning',
                         title: 'El efectivo es menor al costo total del Pago'
                     }); */

                     return false;
                 }

                 var formData = new FormData();
                 var arr = [];
                 //data['id']+ ","+
                 table.rows().eq(0).each(function(index) {

                     var row = table.row(index);
                    // alert('dentro del table row' + row);
                     var data = row.data();
                      arr[index] = data['folio_detalle'] + ","
                      + data['id_periodo'] + ","
                      + data['id_concepto'] + ","
                      + data['descripcion_detalle'] + "," 
                      + parseFloat(data['cantidad']) + ","
                      + parseFloat(data['precio']) + "," 
                      + parseFloat(data['importe']);

                     formData.append('arr[]', arr[index]);

                 });

                 formData.append('folio', folio);
                 formData.append('fecha_pago', fecha_pago);
                 formData.append('id_expediente', id_expediente);
                 formData.append('total', parseFloat(totalPago));
                 formData.append('descripcion', descripcion);
                

                 $.ajax({
                     url: "../ajax/ingresos.ajax.php",
                     method: "POST",
                     data: formData,
                     cache: false,
                     contentType: false,
                     processData: false,
                     success: function(respuesta) {
                         Swal.fire({
                             position: 'center',
                             icon: 'success',
                             title: respuesta,
                             showConfirmButton: false,
                             timer: 3500
                         })
                // generar el ajax para el ticket
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
                         table.clear().draw();

                         LimpiarInputs();

                         CargarFolioTicket();
                        
                     }
                 });
             } else {

                 Toast.fire({
                     icon: 'warning',
                     title: 'Ingrese el monto en efectivo'
                 });
             }

         } else {

             Toast.fire({
                 icon: 'warning',
                 title: 'No hay datos capturados en el listado.'
             });

         }

         $("#iptCodigoConcepto").focus();

     } /* FIN realizarPago */

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
 <script>
 
 </script>
  
 <script> // La búsqueda avanzada lista
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
                     targets: 18,


                     orderable: false,
                     render: function(data, type, full, meta) {
                         return "<center>" +
                             "<span class='btnBuscarExpediente text-success px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Seleccionar Expediente'> " +
                             "<i class='fa fa-search' aria-hidden=true></i>" +
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
         $.ajax({

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
                $("#iptNombre_Paciente").val(dataex["NOMBRE"]);
                $("#iptId_Expediente").val(dataex["id_expediente"]);
                    id_expediente = dataex['id_expediente'];
                  //  alert('id expediente ' + id_expediente);
                var cuota_ingreso = dataex['cuota_ingreso'];
                var cuota_semanal = dataex['cuota_semanal'];
                var extras = dataex['extras'];
                var estatus = dataex['estatus'];
                //iptCuota_Ingreso
                $("#iptCuota_Ingreso").val(dataex["cuota_ingreso"]);
                $("#iptCuota_Semanal").val(dataex["cuota_semanal"]);
                $("#iptExtras").val(dataex["extras"]);
              //
             //   cargarperiodosdepago();
                if (cuota_ingreso==0 && cuota_semanal==0 && extras == 0){
                    Swal.fire(' El Paciente ' + respuesta['nombre'] + ' no tiene asignada ninguna Cuota... Verifique!!!');
                    $("#mdlGestionarExpedientes").modal('hide');
                }
                else{
                    $("#mdlGestionarExpedientes").modal('hide');
                }
               
              //}
            }
            });
            // carga el combo de periodos de pago  cache: false,
            // contentType: false,
            // processData: false,
         //   alert('id expediente ' + id_expediente);
        $.ajax({

             async: false,
             url: "../ajax/periodoscb.ajax.php",
             method: "POST",
             data: {
                'accion': 1,
                'id_expediente': id_expediente
            },
             dataType: 'json',
            }).then(function (respuesta) {
                if(respuesta.length>0){
                    $("#selId_Periodo").val(0);
                    $("#selId_Periodo").empty();
                 var options = '<option selected value="">Seleccione un período de pago</option>';                
                 for (let index = 0; index < respuesta.length; index++) {
                     options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                         1
                     ] + '</option>';
                 }
                 $("#selId_Periodo").append(options);
                }
             else
             {
                Toast.fire({
                         icon: 'error',
                         title: 'No existen períodos de pago generados para este paciente'
                       });
                       $('#selId_Periodo')
                         .empty()
                         .append('<option selected value="">Seleccione un período de pago</option>')
                        ;

             }
         }).catch(function (err) {
             alert('entro aqui al error');
             $('#selId_Periodo')
                         .empty()
                         .append('<option selected value="">Seleccione un período de pago</option>')
                        ;
               
        });                    







     });

/*"<span class='btnAumentarCantidad text-success px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Aumentar cantidad'> " +
                                           "<i class='fas fa-cart-plus fs-5'></i> " +
                                           "</span> " +
                                           "<span class='btnDisminuirCantidad text-warning px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Disminuir cantidad'> " +
                                           "<i class='fas fa-cart-arrow-down fs-5'></i> " +
                                           "</span> " + */

 </script>
 