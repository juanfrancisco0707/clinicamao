<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Servicios</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Servicios</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">

    <div class="container-fluid">
        <!-- row para listado de Servicios -->
        <div class="row">
            <div class="col-lg-10">
                <table id="tbl_Servicios" class="table table-striped w-100 shadow">
                    <thead class="bg-info">
                        <tr style="font-size: 12px;">
                            <th></th>
                            <th>ID</th>
                            <th>Nombre del Servicio</th>
                            <th>Descripción</th>
                            <th class="text-right">Precio</th>
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

<!-- Ventana Modal para ingresar o modificar un Servicio -->
<div class="modal fade" id="mdlGestionarServicio" role="dialog">

    <div class="modal-dialog modal-lg">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Agregar Servicio</h5>

                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal -->
            <div class="modal-body">

                <form class="needs-validation" novalidate>
                    <!-- Abrimos una fila -->
                    <div class="row">

                        <!-- Columna para registro del Identificador -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptIdServicio"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Número</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptIdServicio" name="iptId" placeholder="Identificador" required>
                                <div class="invalid-feedback">Debe ingresar el número del Servicio</div>
                            </div>
                        </div>


                        <!-- Columna para registro del Nombre del Servicio -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptNombreServicio"><i class="fas fa-file-signature fs-6"></i> <span class="small">Nombre</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptNombreServicio" placeholder="Nombre" required>
                                <div class="invalid-feedback">Debe ingresar el nombre</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label class="" for="iptDescripcion"><i class="fas fa-file-alt fs-6"></i> <span class="small">Descripción</span></label>
                                <textarea class="form-control form-control-sm" id="iptDescripcion" placeholder="Descripción"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptPrecio"><i class="fas fa-dollar-sign fs-6"></i> <span class="small">Precio</span><span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" id="iptPrecio" placeholder="Precio" required>
                                <div class="invalid-feedback">Debe ingresar el precio</div>
                            </div>
                        </div>

                        <!-- creacion de botones para cancelar y guardar el Servicio -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;" data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2" id="btnGuardarServicio">Guardar Servicio</button>
                    </div>
                </form>

            </div>

        </div>
    </div>


</div>
<!-- /. Fin de Ventana Modal para ingreso de Pacientes -->

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
        table = $("#tbl_Servicios").DataTable({
            dom: 'Bfrtip', // Para que los botones se pongan en la parte Superior
            buttons: [{
                    text: 'Agregar Servicio',
                    className: 'addNewRecord',
                    action: function(e, dt, node, config) {
                        $("#mdlGestionarServicio").modal('show');
                        accion = 2; //registrar
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    title: 'Listado de Servicios'
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    title: 'Listado de Servicios'
                },
                {
                    extend: 'pageLength',
                    text: 'Longitud de la página'
                }
            ],
            pageLength: [
                [5, 10, 15, 30, 50],
                ['5 Filas', '10 Filas', '15 Filas', '30 Filas', '50 Filas', 'Mostrar todo']
            ],
            pageLength: 10,
            ajax: {
                url: "../ajax/mao.servicios.ajax.php",
                dataSrc: '',
                type: "POST",
                data: {
                    'accion': 1 //1: LISTAR SERVICIOS
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
                    targets: 1, // Nombre del Servicio
                    data: 'id_servicio'
                },
                {
                    targets: 2, // Nombre del Servicio
                    data: 'nombre_servicio'
                },
                {
                    targets: 3, // Descripción
                    data: 'descripcion'
                },
                {
                targets: 4, 
                data: 'precio',
                className: 'dt-body-right',
                render: $.fn.dataTable.render.number( ',', '.', 0, '$ ' )
            },
                {
                    targets: 5,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return "<center>" +
                            "<span class='btnEditarServicio text-primary px-1' style='cursor:pointer;'>" +
                            "<i class='fas fa-pencil-alt fs-5'></i>" +
                            "</span>" +
                            "<span class='btnEliminarServicio text-danger px-1' style='cursor:pointer;'>" +
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

            $("#iptIdServicio").val("");
            $("#iptNombreServicio").val("");
            $("#iptDescripcion").val("");
            $("#iptPrecio").val("");


        })

        /* ======================================================================================
        EVENTO AL DAR CLICK EN EL BOTON EDITAR Servicios
        =========================================================================================*/
        $('#tbl_Servicios tbody').on('click', '.btnEditarServicio', function() {

            accion = 4; //seteamos la accion para editar

            $("#mdlGestionarServicio").modal('show');

            var data = table.row($(this).parents('tr')).data();
            // console.log("🚀 ~ file: Servicios.php ~ line 225 ~ $ ~ data", data)

            $("#iptIdServicio").val(data[1]);
            $("#iptNombreServicio").val(data[2]);
            $("#iptDescripcion").val(data[3]);
            $("#iptPrecio").val(data[4]);

        })

        /* ======================================================================================
        EVENTO AL DAR CLICK EN EL BOTON ELIMINAR Servicio
        =========================================================================================*/
        $('#tbl_Servicios tbody').on('click', '.btnEliminarServicio', function() {

            accion = 5; //seteamos la accion para editar

            var data = table.row($(this).parents('tr')).data();

            var id_servicio = data[1];

            Swal.fire({
                title: 'Está seguro de eliminar el Servicio?',
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
                    datos.append("id_servicio", id_servicio); //id_Servicios             

                    $.ajax({
                        url: "../ajax/mao.servicios.ajax.php",
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
                                    title: 'El Servicio se eliminó correctamente'
                                });

                                table.ajax.reload();

                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'El Servicio no se pudo eliminar'
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
    document.getElementById("btnGuardarServicio").addEventListener("click", function() {

        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {

            if (form.checkValidity() === true) {

                // console.log("Listo para registrar el Servicio")

                Swal.fire({
                    title: 'Está seguro de registrar el Servicio?',
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
                        datos.append("id_servicio", $("#iptIdServicio").val()); //id
                        datos.append("nombre_servicio", $("#iptNombreServicio").val()); //Nombre_Servicio
                        datos.append("descripcion", $("#iptDescripcion").val()); //Descripcion
                        datos.append("precio", $("#iptPrecio").val()); //Precio
                        if (accion == 2) {
                            var titulo_msj = "El Servicio se registró correctamente"
                        }

                        if (accion == 4) {
                            var titulo_msj = "El Servicio se actualizó correctamente"
                        }

                        $.ajax({
                            url: "../ajax/mao.servicios.ajax.php",
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
                                    $("#mdlGestionarServicio").modal('hide');

                                    $("#iptIdServicio").val("");
                                    $("#iptNombreServicio").val("");
                                    $("#iptDescripcion").val("");
                                    $("#iptPrecio").val("");


                                } else {
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'El Servicio no se pudo registrar'
                                    });
                                }

                            }
                        });

                    }
                })
            } else {
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
