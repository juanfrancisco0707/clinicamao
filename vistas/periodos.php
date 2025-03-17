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
                 <h1 class="m-0">Períodos de Pago</h1>
                 <p id="clinica" value='<?php echo $_SESSION['S_CLINICA']; ?>'></p>
                <input type="hidden" id="vclinica" name="vclinica" value='<?php echo $_SESSION['S_CLINICA']; ?>'/> 
                <input type="hidden" id="vrolusu" name="vrolusu" value='<?php echo $_SESSION['S_ROL']; ?>'/> 
                  
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Períodos de pago</li>
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
       
            <table id="tbl_periodos" class="table table-striped w-100 shadow">
                <thead class="bg-info">
                    <tr style="font-size: 13px;">
                        <th></th>
                        <th>No.</th>
                        <th>Expediente</th>
                        <th>Clínica</th>
                        <th>Nombre de Paciente</th>
                        <th>Fecha Inicial</th>
                        <th>Fecha Final</th>
                        <th>Pago</th>
                        <th>Saldo</th>
                        <th>Estatus</th>
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
        include "../vistas/modulos/modal.periodos.pago.php";
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
    $("#mdlGestionarPeriodos").draggable({
    handle: ".modal-header"
    }); 
 /*   $("#mdlGestionarExpedientesM").draggable({
    handle: ".modal-header"
    }); 
    $("#mdlGestionarExpedientesn").draggable({
    handle: ".modal-header"
    });  */
    
   
   
    /*===================================================================*/
    // CARGA DEL LISTADO CON EL PLUGIN DATATABLE JS
    /*===================================================================*/
    table = $("#tbl_periodos").DataTable({
        
        dom: 'Bfrtip', // Para que los botones se pongan en la parte Superior
        buttons: [{
                text: 'Agregar Período',
                className: 'addNewRecord',
                action: function(e, dt, node, config) {

                 /*   $.ajax({

                        async: false,
                        url: "../ajax/periodos.ajax.php",
                        method: "POST",
                        data: {
                            
                            'accion': 1

                        },
                        dataType: 'json',
                        success: function(respuesta) {
                           
                            folio = respuesta["folio"];
                            $("#iptIdReg").val(folio);
                        }
                    }); */ 

                    $("#mdlGestionarPeriodos").modal('show');
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
            url: "../ajax/periodos.ajax.php",
            dataSrc: '',
            type: "POST",
            data: {
                'accion': 11 //1: LISTAR Períodos de toda una clínica
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
                className: 'text-right', targets: [5,6]
            },
            {
                targets: 5, // 
                className: 'dt-body-center',
                className: 'text-center'
            } ,
            {
                targets: 6, // centra la fecha de ingreso
                className: 'dt-body-center',
                className: 'text-center'
            },
            {
                targets: 7, // pago
                className: 'dt-body-right',
                render: $.fn.dataTable.render.number( ',', '.', 0, '$ ' )
            },
            {
                targets: 8, // saldo
                className: 'dt-body-right',
                 render: $.fn.dataTable.render.number( ',', '.', 0, '$ ' )

            },
            {
                targets: 9, // estatus
                className: 'dt-body-center',
                      createdCell: function(td, cellData, rowData, row, col) {
                   if ((rowData[9]) == 'Pendiente') {
                      $(td).parent().css('background', '#cc958e')
                      $(td).parent().css('color', '#030303')
                    }
                }
            },
            {
                targets: 10,
                orderable: false,
                render: function(data, type, full, meta) {
                    return "<center>" +
                        "<span class='btnEditarPeriodo text-warning px-2' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Expediente'> " +
                        "<i class='fas fa-book fs-6'></i>" +
                        "</span>"  +
                        "<span class='btnEliminarPeriodo text-danger px-2' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Expediente'> " +
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

        $("#validate_id").css("display", "none");
        $("#validate_id_expediente").css("display", "none");
       
        $("#validate_nombre").css("display", "none");
        $("#validate_fecha_inicial").css("display", "none");
        $("#validate_fecha_final").css("display", "none");
        $("#validate_pago").css("display", "none");
        $("#validate_saldo").css("display", "none");
      

        $("#iptIdReg").val("");
        $("#iptId_ExpedienteReg").val("");
        $("#iptNombreReg").val("");
        $("#iptFecha_IngresoReg").val("");
        $("#iptFecha_InicialReg").val("");
        $("#iptPagoReg").val("");
        $("#iptSaldoReg").val("");
        $("#iptEstatusReg").val("");
      
    })
    $("#btnCancelarRegistrom, #btnCerrarModalm").on('click', function() {
 $("#validate_id").css("display", "none");
        $("#validate_id_expedientem").css("display", "none");
       
        $("#validate_nombrem").css("display", "none");
        $("#validate_fecha_inicialm").css("display", "none");
        $("#validate_fecha_finalm").css("display", "none");
        $("#validate_pagom").css("display", "none");
        $("#validate_saldom").css("display", "none");
      

        $("#iptIdRegm").val("");
        $("#iptId_ExpedienteRegm").val("");
        $("#iptNombreRegm").val("");
        $("#iptFecha_IngresoRegm").val("");
        $("#iptFecha_InicialRegm").val("");
        $("#iptPagoRegm").val("");
        $("#iptSaldoRegm").val("");
        $("#iptEstatusRegm").val("");
      
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
    $('#tbl_periodos tbody').on('click', '.btnEditarPeriodo', function() {

        accion = 4; //seteamos la accion para editar
//alert('antes de llamar el modal');
        $("#mdlGestionarPeriodosM").modal('show');

        var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }
        console.log("🚀 ~ file: expedientes.php ~ line 394 ~ $ ~ data", data)
       
        $("#iptIdRegm").val(data[1]);
       // $("#iptId_ClinicaRegm").val(data[1]);
        $("#iptId_ExpedienteRegm").val(data[2]); // se pone el id
        $("#iptNombreRegm").val(data[4]); // se pone la posicion del ID
        $("#iptFecha_InicialRegm").val(data["fecha_inicial"]);
        $("#iptFecha_FinalRegm").val(data["fecha_final"]);
        $("#iptPagoRegm").val(data["pago"]);
        $("#iptSaldoRegm").val(data["saldo"]);
      
        $("#iptEstatusRegm").val(data["estatus"]);

    })

  
   
    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON ELIMINAR EXPEDIENTE
    =========================================================================================*/
    $('#tbl_periodos tbody').on('click', '.btnEliminarPeriodo', function() {
        
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
                title: 'Está seguro de eliminar el Período de Pago?',
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
                                title: 'El período de Pago se eliminó correctamente'
                            });

                            table.ajax.reload();

                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'El período de pago no se pudo eliminar'
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
    $('#tbl_periodos tbody').on('click', '.btnPeriodosExpediente', function() {
        
        accion = 2; //seteamos la accion para crear los periodos de pago semanales
        var esta;
        var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }
        console.log("🚀 ~ file: expedientes.php ~ line 772 ~ $ ~ data", data)
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
document.getElementById("btnGuardarPeriodo").addEventListener("click", function() {
                         
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
        //calcularedad();
        if (form.checkValidity() === true) {   

           // console.log("Listo para registrar el paciente")
            if(accion == 4){
                $mensaje='Está seguro de Modificar el Período de Pago?';
                $confirmar='Si, deseo Modificarlo!';
                //alert("dentro de la accion 4");
            }
            if (accion==2){
                $mensaje='Está seguro de registrar el Período de Pago?';
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
                  
                    datos.append("accion", accion);
                    datos.append("id", $("#iptIdReg").val()); //id_Expediente
                    datos.append("id_expediente", $("#iptId_ExpedienteReg").val()); //Id Paciente
                  
                    datos.append("fecha_inicio", $("#iptFecha_InicialReg").val()); //Fecha_Ingreso_Paciente
                    datos.append("fecha_final", $("#iptFecha_FinalReg").val()); //Fecha_Salida_Paciente
                    datos.append("pago", $("#iptPagoReg").val()); //Firmó Contrato
                    datos.append("saldo", $("#iptSaldoReg").val()); //Duración_Paciente
                    datos.append("estatus", $("#iptEstatusReg").val()); //Estatus
                    

                    

                    if(accion == 2){
                        var titulo_msj = "El período de Pago se registró correctamente"
                    }

                    if(accion == 4){
                        var titulo_msj = "El Período de Pago se actualizó correctamente"
                    }

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
                                    title: titulo_msj
                                });

                                table.ajax.reload();

                                $("#mdlGestionarPeriodos").modal('hide');

                                $("#iptIdReg").val("");
                                $("#iptId_ExpedienteReg").val(0);
                                $("#iptFecha_InicialReg").val("");
                                $("#iptFecha_FinalReg").val("");
                                $("#iptPagoReg").val("");
                                $("#iptSaldoReg").val("");
                                $("#iptEstatus").val("");
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Verificar el Período de pago grabado'
                                });
                            table.ajax.reload();
                                $("#mdlGestionarPeriodos").modal('hide');

                         
                                $("#iptIdReg").val("");
                                $("#iptId_ExpedienteReg").val(0);
                                $("#iptFecha_InicialReg").val("");
                                $("#iptFecha_FinalReg").val("");
                                $("#iptPagoReg").val("");
                                $("#iptSaldoReg").val("");
                                $("#iptEstatus").val("");
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
document.getElementById("btnGuardarPeriodom").addEventListener("click", function() {
                         
                         // Get the forms we want to add validation styles to
                         var forms = document.getElementsByClassName('needs-validation');
                         // Loop over them and prevent submission
                         var validation = Array.prototype.filter.call(forms, function(form) {
                             //calcularedad();
                             if (form.checkValidity() === true) {   
                           // alert("dentro del alert antes de accion=4")
                                // console.log("Listo para registrar el paciente")
                                 if(accion == 4){
                                     $mensaje='Está seguro de Modificar el Período de Pago?';
                                     $confirmar='Si, deseo Modificarlo!';
                                 }
                                 if (accion==2){
                                     $mensaje='Está seguro de registrar el ¨Período de Pago?';
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
                    datos.append("id", $("#iptIdRegm").val()); //id_Expediente
                    datos.append("id_expediente", $("#iptId_ExpedienteRegm").val()); //Id Paciente
                                                      
                    datos.append("fecha_inicial", $("#iptFecha_InicialRegm").val()); //Fecha_Ingreso_Paciente
                    datos.append("fecha_final", $("#iptFecha_FinalRegm").val()); //Fecha_Salida_Paciente
                    datos.append("pago", $("#iptPagoRegm").val()); //Firmó Contrato
                    datos.append("saldo", $("#iptSaldoRegm").val()); //Duración_Paciente
                    datos.append("estatus", $("#iptEstatusRegm").val()); //Estatus
                           
                                      
                     
                                         if(accion == 2){
                                             var titulo_msj = "El Período de pago se registró correctamente"
                                         }
                     
                                         if(accion == 4){
                                             var titulo_msj = "El Período de Pago se se actualizó correctamente"
                                         }
                                      
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
                                                         title: titulo_msj
                                                     });
                     
                                                     table.ajax.reload();

                                                     $("#mdlGestionarperiodosM").modal('hide');
                                                        $("#iptIdReg").val("");
                                                        $("#iptId_ExpedienteReg").val(0);
                                                        $("#iptFecha_InicialReg").val("");
                                                        $("#iptFecha_FinalReg").val("");
                                                        $("#iptPagoReg").val("");
                                                        $("#iptSaldoReg").val("");
                                                        $("#iptEstatus").val("");
                                                    } else {
                                                        $("#mdlGestionarPeriodosM").modal('hide');
                                                        $("#iptIdReg").val("");
                                                        $("#iptId_ExpedienteReg").val(0);
                                                        $("#iptFecha_InicialReg").val("");
                                                        $("#iptFecha_FinalReg").val("");
                                                        $("#iptPagoReg").val("");
                                                        $("#iptSaldoReg").val("");
                                                        $("#iptEstatus").val("");
                                                     Toast.fire({
                                                         icon: 'error',
                                                         title: 'El período de pago no se pudo Modificar'
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
document.getElementById("btnCancelarRegistrom").addEventListener("click", function() {
    $(".needs-validation").removeClass("was-validated");
})




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
<!--<script src="http://momentjs.com/downloads/moment.min.js"></script> -->
         

