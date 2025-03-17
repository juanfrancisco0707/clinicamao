 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Conceptos de Ingresos/Gastos</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Conceptos de Ingresos/Gastos</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->
 <div class="content">

<div class="container-fluid">
    <!-- row para listado de conceptos -->
    <div class="row">
        <div class="col-lg-8">
            <table id="tbl_conceptos" class="table table-striped w-100 shadow">
                <thead class="bg-info">
                    <tr style="font-size: 12px;">
                        <th></th>
                        <th>id</th>
                        <th>Descripción del Concepto</th>
                        <th>Tipo</th>
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

<!-- Ventana Modal para ingresar o modificar un conceptos -->
<div class="modal fade" id="mdlGestionarConcepto" role="dialog">

<div class="modal-dialog modal-lg">

    <!-- contenido del modal -->
    <div class="modal-content">

        <!-- cabecera del modal -->
        <div class="modal-header bg-gray py-1">

            <h5 class="modal-title">Agregar Conceptos</h5>

            <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                <i class="far fa-times-circle"></i>
            </button>

        </div>

        <!-- cuerpo del modal -->
        <div class="modal-body">

            <form class="needs-validation" novalidate >
                <!-- Abrimos una fila -->
                <div class="row">

                    <!-- Columna para registro del Identificador -->
                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-2">
                            <label class="" for="iptIdReg"><i class="fas fa-barcode fs-6"></i>
                                <span class="small">Identificador</span><span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control form-control-sm" id="iptIdReg"
                                name="iptId" placeholder="Identificador" required>
                            <div class="invalid-feedback">Debe ingresar el Identificador del Concepto</div>
                        </div>
                    </div>

                   
                    <!-- Columna para registro del Nombre de la Concepto-->
                    <div class="col-12">
                        <div class="form-group mb-2">
                            <label class="" for="iptDescripcionReg"><i
                                    class="fas fa-file-signature fs-6"></i> <span
                                    class="small">Nombre</span><span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="iptDescripcionReg"
                                placeholder="Nombre" required>
                            <div class="invalid-feedback">Debe ingresar la descripción del concepto </div>
                    </div>
                    <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                            <label class="" for="iptTipoReg"><i
                                        class="fas fa-minus-circle fs-6"></i> <span class="small">Tipo</span><span class="text-danger">*</span></label>
                                        <select name="tipo" class="form-control form-control-sm" id ="iptTipoReg" required>
                                         <option>Ingresos</option>
                                         <option>Gastos</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar el tipo</div>
                            </div>
                        </div>

              
                    <!-- creacion de botones para cancelar y guardar la Concepto -->
                    <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                        data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                    <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                        id="btnGuardarConcepto">Guardar Conceptos</button>
                    </div>
                </div>
            </form>
        
        </div>

    </div>
</div>


</div>
<!-- /. Fin de Ventana Modal para ing -->

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
/*===================================================================*/
// CARGA DEL LISTADO CON EL PLUGIN DATATABLE JS
/*===================================================================*/
        table = $("#tbl_conceptos").DataTable({
    dom: 'Bfrtip', // Para que los botones se pongan en la parte Superior
    buttons: [{
                text: 'Agregar conceptos',
                className: 'addNewRecord',
                action: function(e, dt, node, config) {
                    $("#mdlGestionarConcepto").modal('show');
                   accion = 2; //registrar
                }
            },
            {
                extend: 'excel',
                text: 'Excel',
                title: 'Listado de conceptos'
            },
            {
                extend: 'print', 
                text: 'Imprimir',
                title: 'Listado de conceptos'},
            {
                extend:'pageLength',
                text: 'Longitud de la página'
            }           
        ],
        pageLength: [[5, 10, 15, 30, 50], 
                    ['5 Filas','10 Filas','15 Filas','Mostrar todo']], 
        pageLength: 10,
    ajax: {
        url: "../ajax/conceptos.ajax.php",
        dataSrc: '',
        type: "POST",
        data: {
            'accion': 1 //1:
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
            targets: 4,
            orderable: false,
            render: function(data, type, full, meta) {
                return "<center>" +
                    "<span class='btnEditarConcepto text-primary px-1' style='cursor:pointer;'>" +
                    "<i class='fas fa-pencil-alt fs-5'></i>" +
                    "</span>" +
                    "<span class='btnEliminarConcepto text-danger px-1' style='cursor:pointer;'>" +
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

    $("#validate_id").css("display", "none");
    $("#validate_Descripcion").css("display", "none");
    $("#validate_Tipo").css("display", "none");

    $("#iptIdReg").val("");
    $("#iptDescripcionReg").val("");
    $("#iptTipoReg").val("");
   
   
  
    })

    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON EDITAR conceptos
    =========================================================================================*/
    $('#tbl_conceptos tbody').on('click', '.btnEditarConcepto', function() {

    accion = 4; //seteamos la accion para editar

    $("#mdlGestionarConcepto").modal('show');

    var data = table.row($(this).parents('tr')).data();
    console.log("🚀 ~ file: conceptos.php ~ line 225 ~ $ ~ data", data)
    
    $("#iptIdReg").val(data["id"]);
    $("#iptDescripcionReg").val(data["descripcion"]);
    $("#iptTipoReg").val(data["tipo"]);

    })

    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON ELIMINAR Concepto
    =========================================================================================*/
    $('#tbl_conceptos tbody').on('click', '.btnEliminarConcepto', function() {
    
    accion = 5; //seteamos la accion para editar
    
    var data = table.row($(this).parents('tr')).data();

    var id = data["id"];

    Swal.fire({
        title: 'Está seguro de eliminar el Concepto?',
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
            datos.append("id", id); //id_conceptos             

            $.ajax({
                url: "../ajax/conceptos.ajax.php",
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
                            title: 'El Concepto se eliminó correctamente'
                        });

                        table.ajax.reload();

                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'El Concepto no se pudo eliminar'
                        });
                    }

                }
            });

        }
    })
    })
    

    });
/*===================================================================*/
//EVENTO QUE GUARDA LOS DATOS DEL REPRESENTANTE, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/
document.getElementById("btnGuardarConcepto").addEventListener("click", function() {

// Get the forms we want to add validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {

    if (form.checkValidity() === true) {   

       // console.log("Listo para registrar la Conceptos")

        Swal.fire({
            title: 'Está seguro de registrar el Conceptos?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo registrarlo!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var datos = new FormData();

                datos.append("accion", accion);
                datos.append("id", $("#iptIdReg").val()); //id
                datos.append("descripcion", $("#iptDescripcionReg").val()); //Descripcion
                datos.append("tipo", $("#iptTipoReg").val()); //Descripcion
            if(accion == 2){
                    var titulo_msj = "El Concepto se registró correctamente"
                }

                if(accion == 4){
                    var titulo_msj = "El Concepto se actualizó correctamente"
                }

                $.ajax({
                    url: "../ajax/conceptos.ajax.php",
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
                            $("#mdlGestionarConcepto").modal('hide');
                            
                            $("#iptDescripcionReg").val("");
                            $("#iptTipoReg").val("");
                            

                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'El Concepto no se pudo registrar'
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