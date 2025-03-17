<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Drogas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Drogas</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">

    <div class="container-fluid">
        <!-- row para listado de Drogas -->
        <div class="row">
            <div class="col-lg-8">
                <table id="tbl_Drogas" class="table table-striped w-100 shadow">
                    <thead class="bg-info">
                        <tr style="font-size: 12px;">
                            <th></th>
                            <th>id</th>
                            <th>Nombre de la Droga</th>
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

<!-- Ventana Modal para ingresar o modificar un Drogas -->
<div class="modal fade" id="mdlGestionarDroga" role="dialog">

    <div class="modal-dialog modal-lg">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Agregar Droga</h5>

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
                                <label class="" for="iptIdReg"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Número</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptIdReg" name="iptId" placeholder="Identificador" required>
                                <div class="invalid-feedback">Debe ingresar el número de la Droga</div>
                            </div>
                        </div>


                        <!-- Columna para registro del Nombre de la Droga-->
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label class="" for="iptNombre_DrogaReg"><i class="fas fa-file-signature fs-6"></i> <span class="small">Nombre</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptNombre_DrogaReg" placeholder="Nombre" required>
                                <div class="invalid-feedback">Debe ingresar el nombre</div>
                            </div>

                            <!-- creacion de botones para cancelar y guardar la Droga -->
                            <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;" data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                            <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2" id="btnGuardarDroga">Guardar Droga</button>
                        </div>
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
        table = $("#tbl_Drogas").DataTable({
            dom: 'Bfrtip', // Para que los botones se pongan en la parte Superior
            buttons: [{
                    text: 'Agregar Drogas',
                    className: 'addNewRecord',
                    action: function(e, dt, node, config) {
                        $("#mdlGestionarDroga").modal('show');
                        accion = 2; //registrar
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    title: 'Listado de Drogas'
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    title: 'Listado de Drogas'
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
                url: "../ajax/drogas.ajax.php",
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
                    targets: 3,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return "<center>" +
                            "<span class='btnEditarDroga text-primary px-1' style='cursor:pointer;'>" +
                            "<i class='fas fa-pencil-alt fs-5'></i>" +
                            "</span>" +
                            "<span class='btnEliminarDroga text-danger px-1' style='cursor:pointer;'>" +
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
            $("#validate_nombre_Droga").css("display", "none");

            $("#iptIdReg").val("");
            $("#iptNombre_DrogaReg").val("");


        })

        /* ======================================================================================
        EVENTO AL DAR CLICK EN EL BOTON EDITAR Drogas
        =========================================================================================*/
        $('#tbl_Drogas tbody').on('click', '.btnEditarDroga', function() {

            accion = 4; //seteamos la accion para editar

            $("#mdlGestionarDroga").modal('show');

            var data = table.row($(this).parents('tr')).data();
            // console.log("🚀 ~ file: Drogas.php ~ line 225 ~ $ ~ data", data)

            $("#iptIdReg").val(data["id_droga"]);
            $("#iptNombre_DrogaReg").val(data["nombre_droga"]);

        })

        /* ======================================================================================
        EVENTO AL DAR CLICK EN EL BOTON ELIMINAR Droga
        =========================================================================================*/
        $('#tbl_Drogas tbody').on('click', '.btnEliminarDroga', function() {

            accion = 5; //seteamos la accion para editar

            var data = table.row($(this).parents('tr')).data();

            var id_droga = data["id_droga"];

            Swal.fire({
                title: 'Está seguro de eliminar la Droga?',
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
                    datos.append("id_droga", id_droga); //id_Drogas             

                    $.ajax({
                        url: "../ajax/Drogas.ajax.php",
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
                                    title: 'La Droga se eliminó correctamente'
                                });

                                table.ajax.reload();

                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'La Droga no se pudo eliminar'
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
    document.getElementById("btnGuardarDroga").addEventListener("click", function() {

        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {

            if (form.checkValidity() === true) {

                // console.log("Listo para registrar la Droga")

                Swal.fire({
                    title: 'Está seguro de registrar la Droga?',
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
                        datos.append("id_droga", $("#iptIdReg").val()); //id
                        datos.append("nombre_droga", $("#iptNombre_DrogaReg").val()); //Nombre_Droga
                        if (accion == 2) {
                            var titulo_msj = "La Droga se registró correctamente"
                        }

                        if (accion == 4) {
                            var titulo_msj = "La Droga se actualizó correctamente"
                        }

                        $.ajax({
                            url: "../ajax/drogas.ajax.php",
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
                                    $("#mdlGestionarDroga").modal('hide');

                                    $("#iptNombre_DrogaReg").val("");


                                } else {
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'La Droga no se pudo registrar'
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