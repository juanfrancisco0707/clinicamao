<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Estados de Citas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Estados de Citas</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">

    <div class="container-fluid">
        <!-- row para listado de Estados de Citas -->
        <div class="row">
            <div class="col-lg-8">
                <table id="tbl_EstadosCitas" class="table table-striped w-100 shadow">
                    <thead class="bg-info">
                        <tr style="font-size: 12px;">
                            <th></th>
                            <th>ID</th>
                            <th>Nombre del Estado</th>
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

<!-- Ventana Modal para ingresar o modificar un Estado de Cita -->
<div class="modal fade" id="mdlGestionarEstadoCita" role="dialog">

    <div class="modal-dialog modal-lg">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Agregar Estado de Cita</h5>

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
                                <label class="" for="iptIdEstadoReg"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Número</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptIdEstadoReg" name="iptId" placeholder="Identificador" required>
                                <div class="invalid-feedback">Debe ingresar el número del Estado de Cita</div>
                            </div>
                        </div>


                        <!-- Columna para registro del Nombre del Estado de Cita-->
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label class="" for="iptNombreEstadoReg"><i class="fas fa-file-signature fs-6"></i> <span class="small">Nombre</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptNombreEstadoReg" placeholder="Nombre" required>
                                <div class="invalid-feedback">Debe ingresar el nombre</div>
                            </div>

                            <!-- creacion de botones para cancelar y guardar el Estado de Cita -->
                            <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;" data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                            <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2" id="btnGuardarEstadoCita">Guardar Estado de Cita</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>


</div>
<!-- /. Fin de Ventana Modal para ingreso de Estados de Citas -->

<script>
    var accion;
    var table;

    /*=======================================================================*/
    //INICIALIZAMOS EL MENSAJE DE TIPO TOAST (EMERGENTE EN LA PARTE SUPERIOR)
    /*=======================================================================*/
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
        table = $("#tbl_EstadosCitas").DataTable({
            dom: 'Bfrtip', // Para que los botones se pongan en la parte Superior
            buttons: [{
                    text: 'Agregar Estado de Cita',
                    className: 'addNewRecord',
                    action: function(e, dt, node, config) {
                        $("#mdlGestionarEstadoCita").modal('show');
                        accion = 2; //registrar
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    title: 'Listado de Estados de Citas'
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    title: 'Listado de Estados de Citas'
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
                url: "../ajax/mao.estados_citas.ajax.php",
                dataSrc: '',
                type: "POST",
                data: {
                    'accion': 1 //1: LISTAR ESTADOS DE CITAS
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
                    data: 'id_estado'
                },
                {
                    targets: 2, // Nombre del Servicio
                    data: 'nombre_estado'
                },
                {
                    targets: 3,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return "<center>" +
                            "<span class='btnEditarEstadoCita text-primary px-1' style='cursor:pointer;'>" +
                            "<i class='fas fa-pencil-alt fs-5'></i>" +
                            "</span>" +
                            "<span class='btnEliminarEstadoCita text-danger px-1' style='cursor:pointer;'>" +
                            "<i class='fas fa-trash fs-5'></i>" +
                            "</span>" +
                            "</center>"
                    }
                }
            ],
            //fixedColumns: true,
            language: {
                //url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                 "url": "../vistas/assets/json/Spanish.json"
                // con esto se cambia al idioma español de los elementos del datatable
            }
        });



        $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {

            $("#validate_id").css("display", "none");
            $("#validate_nombre_estado").css("display", "none");

            $("#iptIdEstadoReg").val("");
            $("#iptNombreEstadoReg").val("");


        })

        /* ======================================================================================
        EVENTO AL DAR CLICK EN EL BOTON EDITAR Estado de Cita
        =========================================================================================*/
        $('#tbl_EstadosCitas tbody').on('click', '.btnEditarEstadoCita', function() {

            accion = 4; //seteamos la accion para editar

            $("#mdlGestionarEstadoCita").modal('show');

            var data = table.row($(this).parents('tr')).data();
            // console.log("🚀 ~ file: EstadosCitas.php ~ line 225 ~ $ ~ data", data)

            $("#iptIdEstadoReg").val(data["id_estado"]);
            $("#iptNombreEstadoReg").val(data["nombre_estado"]);

        })

        /* ======================================================================================
        EVENTO AL DAR CLICK EN EL BOTON ELIMINAR Estado de Cita
        =========================================================================================*/
        $('#tbl_EstadosCitas tbody').on('click', '.btnEliminarEstadoCita', function() {

            accion = 5; //seteamos la accion para editar

            var data = table.row($(this).parents('tr')).data();

            var id_estado = data["id_estado"];

            Swal.fire({
                title: 'Está seguro de eliminar el Estado de Cita?',
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
                    datos.append("id_estado", id_estado); //id_estado             

                    $.ajax({
                        url: "../ajax/mao.estados_citas.ajax.php",
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
                                    title: 'El Estado de Cita se eliminó correctamente'
                                });

                                table.ajax.reload();

                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'El Estado de Cita no se pudo eliminar'
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
    document.getElementById("btnGuardarEstadoCita").addEventListener("click", function() {

        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {

            if (form.checkValidity() === true) {

                // console.log("Listo para registrar el Estado de Cita")

                Swal.fire({
                    title: 'Está seguro de registrar el Estado de Cita?',
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
                        datos.append("id_estado", $("#iptIdEstadoReg").val()); //id
                        datos.append("nombre_estado", $("#iptNombreEstadoReg").val()); //Nombre_estado
                        if (accion == 2) {
                            var titulo_msj = "El Estado de Cita se registró correctamente"
                        }

                        if (accion == 4) {
                            var titulo_msj = "El Estado de Cita se actualizó correctamente"
                        }

                        $.ajax({
                            url: "../ajax/mao.estados_citas.ajax.php",
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
                                    $("#mdlGestionarEstadoCita").modal('hide');

                                    $("#iptNombreEstadoReg").val("");


                                } else {
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'El Estado de Cita no se pudo registrar'
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


    /*=================================================================*/
    //EVENTO QUE LIMPIA LOS MENSAJES DE ALERTA DE INGRESO DE DATOS DE CADA INPUT AL CANCELAR LA VENTANA MODAL
    /*===================================================================*/
    document.getElementById("btnCancelarRegistro").addEventListener("click", function() {
        $(".needs-validation").removeClass("was-validated");
    })
</script>
