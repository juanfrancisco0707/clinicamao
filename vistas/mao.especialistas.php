<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especialistas</title>
    <!-- Incluye Bootstrap CSS (puedes usar un CDN) 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    -->
    <!-- Incluye DataTables CSS (puedes usar un CDN) 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    -->
    <!-- Incluye Font Awesome (puedes usar un CDN) 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    -->
    <style>
        .text-small {
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <!-- row para listado de Especialistas -->
    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary my-3" id="btnNuevoEspecialista" data-bs-toggle="modal" data-bs-target="#modalEspecialista">
                <i class="fas fa-plus"></i> Nuevo Especialista
            </button>
            <table id="tbl_Especialistas" class="table table-striped w-100 shadow">
                <thead class="bg-info">
                    <tr style="font-size: 12px;">
                        <th></th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Especialidad</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Clínica</th>
                        <th class="text-center">Estatus</th>
                        <th class="text-center">Dar de Baja/Alta</th> <!-- Modificado para mayor claridad -->
                        <th class="text-center">Acciones</th> <!-- Nuevo TH para la 10ª columna -->
                    </tr>
                </thead>
                <tbody class="text-small">
                </tbody>
            </table>
        </div>
    </div>
</div><!-- /.container-fluid -->

<!-- Modal para agregar/editar Especialista -->
<div class="modal fade" id="modalEspecialista" tabindex="-1" aria-labelledby="modalEspecialistaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- contenido del modal -->
        <div class="modal-content">
            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">
                <h5 class="modal-title" id="modalEspecialistaLabel">Agregar Especialista</h5>
                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>
            </div>
            <!-- cuerpo del modal -->
            <div class="modal-body">
                <form class="needs-validation" novalidate id="formEspecialista">
                    <!-- Abrimos una fila -->
                    <div class="row">
                         <!-- Clínica -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label for="selEmpresaReg"><i class="fa fa-medkit"></i> <span class="small">Clínica</span><span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" id="selEmpresaReg" required></select>
                                <div class="invalid-feedback">Seleccione la Clínica</div>
                            </div>
                        </div>
                        <!-- Columna para registro del Identificador -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptIdReg"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Número</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptIdReg" name="iptId" placeholder="Identificador" readonly>
                                <div class="invalid-feedback">Debe ingresar el número del Especialista</div>
                            </div>
                        </div>
                        <!-- Columna para registro del Nombre -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptNombreReg"><i class="fas fa-file-signature fs-6"></i> <span class="small">Nombre</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptNombreReg" name="iptNombre" placeholder="Nombre" required>
                                <div class="invalid-feedback">Debe ingresar el nombre</div>
                            </div>
                        </div>
                        <!-- Columna para registro del Apellido -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptApellidoReg"><i class="fas fa-file-signature fs-6"></i> <span class="small">Apellido</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptApellidoReg" name="iptApellido" placeholder="Apellido" required>
                                <div class="invalid-feedback">Debe ingresar el apellido</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la Especialidad -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptEspecialidadReg"><i class="fas fa-briefcase-medical fs-6"></i> <span class="small">Especialidad</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptEspecialidadReg" name="iptEspecialidad" placeholder="Especialidad">
                            </div>
                        </div>
                        <!-- Columna para registro del Teléfono -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptTelefonoReg"><i class="fas fa-phone fs-6"></i> <span class="small">Teléfono</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptTelefonoReg" name="iptTelefono" placeholder="Teléfono">
                            </div>
                        </div>
                        <!-- Columna para registro del Email -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptEmailReg"><i class="fas fa-envelope fs-6"></i> <span class="small">Email</span></label>
                                <input type="email" class="form-control form-control-sm" id="iptEmailReg" name="iptEmail" placeholder="Email">
                            </div>
                        </div>
                       
                        <!-- creacion de botones para cancelar y guardar el Especialista -->
                        <div class="col-12">
                            <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;" data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                            <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2" id="btnGuardarEspecialista">Guardar Especialista</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Incluye jQuery (puedes usar un CDN) 
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>-->
<!-- Incluye Bootstrap JS (puedes usar un CDN) 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
-->
<!-- Incluye DataTables JS (puedes usar un CDN) 
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
-->
<script>
    $(document).ready(function () {
        // Check if modal is a function
        //console.log("Is $.fn.modal a function?", typeof $.fn.modal === 'function');
        let focusedElementBeforeModal;
        let accion = 2; // 2: add, 4: update
        //obtenerFolio('especialista');
        /*===================================================================
        CARGAR LISTADO DE ESPECIALISTAS CON DATATABLE
        ====================================================================*/
        var tablaEspecialistas = $('#tbl_Especialistas').DataTable({
            ajax: {
                url: '../ajax/mao.especialistas.ajax.php',
                type: 'POST',
                data: { accion: 1 }, // Acción para listar especialistas
                dataSrc: ''
            },
            columns: [
                {
                    defaultContent: '',
                    className: 'dt-control',
                    orderable: false,
                    width: '2px'
                },
                { data: 'id_fisioterapeuta' },
                { data: 'nombre_completo' },
                { data: 'especialidad' },
                { data: 'telefono' },
                { data: 'email' },
                { data: 'nombre_empresa'},
                {
                    data: 'estatus',
                    render: function (data, type, row) {
                        return data == 1 ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-danger">Inactivo</span>';
                    }
                },
                {
                    data: null,
                    className: 'text-center',
                    render: function (data, type, row) {
                        return row.estatus == 1 ? '<button class="btn btn-danger btn-sm btnEliminarEspecialista" data-id="' + row.id_fisioterapeuta + '"><i class="fas fa-user-slash"></i></button>' : '<button class="btn btn-success btn-sm btnAltaEspecialista" data-id="' + row.id_fisioterapeuta + '"><i class="fas fa-user-check"></i></button>';
                    }
                },
                
                {
                    data: null,
                    className: 'text-center',
                    render: function (data, type, row) {
                        return `
                            <button class="btn btn-warning btn-sm btnEditarEspecialista" data-id="${row.id_fisioterapeuta}"><i class="fas fa-pencil-alt"></i></button>
                           
                        `;
                    }
                }
            ],
            order: [[1, 'asc']],
            language: {
                //url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                 "url": "../vistas/assets/json/Spanish.json"
            }
        });
         /*===================================================================*/
        //SOLICITUD AJAX PARA CARGAR SELECT DE LAS CLINICAS
        /*===================================================================*/
        $.ajax({
            url: "../ajax/empresacb.ajax.php",
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(respuesta) {

                var options = '<option selected value="">Seleccione una clínica</option>';

                for (let index = 0; index < respuesta.length; index++) {
                    options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                        1
                    ] + '</option>';
                }

                $("#selEmpresaReg").append(options);
            }
        });
        /*===================================================================
        EVENTO PARA ABRIR DETALLE DE ESPECIALISTA
        ====================================================================*/
        $('#tbl_Especialistas tbody').on('click', 'td.dt-control', function () {
            var tr = $(this).closest('tr');
            var row = tablaEspecialistas.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
            } else {
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });
        /*===================================================================
        FUNCION PARA MOSTRAR DETALLE DE ESPECIALISTA
        ====================================================================*/
        function format(d) {
            return `
                <table class="table table-sm table-bordered">
                    <tr>
                        <td style="width:150px;">ID:</td>
                        <td>${d.id_fisioterapeuta}</td>
                    </tr>
                    <tr>
                        <td>Nombre:</td>
                        <td>${d.nombre_completo}</td>
                    </tr>
                   
                    <tr>
                        <td>Especialidad:</td>
                        <td>${d.especialidad}</td>
                    </tr>
                    <tr>
                        <td>Teléfono:</td>
                        <td>${d.telefono}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>${d.email}</td>
                    </tr>
                    <tr>
                        <td>Clinica:</td>
                        <td>${d.nombre_empresa}</td>
                    </tr>
                </table>
            `;
        }
        /*===================================================================
        EVENTO PARA REGISTRAR/ACTUALIZAR ESPECIALISTA
        ====================================================================*/
        $("#btnGuardarEspecialista").on('click', function () {
            if ($("#formEspecialista")[0].checkValidity()) {
                var id_fisioterapeuta = $("#iptIdReg").val();
                var nombre = $("#iptNombreReg").val();
                var apellido = $("#iptApellidoReg").val();
                var especialidad = $("#iptEspecialidadReg").val();
                var telefono = $("#iptTelefonoReg").val();
                var email = $("#iptEmailReg").val();
               
                var id_empresa = $("#selEmpresaReg").val();


                var datos = new FormData();
                datos.append("accion", accion); // Acción para registrar or update
                datos.append("id_fisioterapeuta", id_fisioterapeuta);
                datos.append("nombre", nombre);
                datos.append("apellido", apellido);
                datos.append("especialidad", especialidad);
                datos.append("telefono", telefono);
                datos.append("email", email);
                 datos.append("id_empresa", id_empresa);

                $.ajax({
                    url: "../ajax/mao.especialistas.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (respuesta) {
                        //if (respuesta == "ok") {
                        if (respuesta && respuesta.resultado === "ok") {
                            $("#modalEspecialista").modal('hide'); 
                            $("#formEspecialista")[0].reset();
                            tablaEspecialistas.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: (accion == 2 ? "¡Registrado!" : "¡Actualizado!"),
                                text: (accion == 2 ? "Especialista registrado correctamente." : "Especialista actualizado correctamente."),
                                showConfirmButton: false,
                                timer: 2000 // Opcional: cierra automáticamente después de 2 segundos
                            });
                        } else {
                            //alert(accion == 2 ? "Error al registrar el Especialista" : "Error al actualizar el Especialista");
                            let mensajeError = "Error desconocido.";
                            if (respuesta && respuesta.resultado) mensajeError = respuesta.resultado; // Usar el mensaje del SP si existe
                            // alert((accion == 2 ? "Error al registrar el Especialista: " : "Error al actualizar el Especialista: ") + mensajeError);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: (accion == 2 ? "Error al registrar el Especialista: " : "Error al actualizar el Especialista: ") + mensajeError
                            });
                       
                        }
                    }
                });
            } else {
                $("#formEspecialista")[0].classList.add('was-validated');
            }
        });
        /*===================================================================
        EVENTO PARA EDITAR ESPECIALISTA
        ====================================================================*/
        $("#tbl_Especialistas").on("click", ".btnEditarEspecialista", function () {
            accion = 4; //set action to update
            var id_fisioterapeuta = $(this).data("id");
            $("#modalEspecialistaLabel").text("Editar Especialista");
            $("#btnGuardarEspecialista").text("Actualizar Especialista");
            $("#btnGuardarEspecialista").addClass("btn-primary"); // Ensure button has btn-primary class

            var datos = new FormData();
            datos.append("accion", 7); // Acción para obtener datos del especialista
            datos.append("id_fisioterapeuta", id_fisioterapeuta);

            $.ajax({
                url: "../ajax/mao.especialistas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    $("#iptIdReg").val(respuesta.id_fisioterapeuta);
                    $("#iptNombreReg").val(respuesta.nombre);
                    $("#iptApellidoReg").val(respuesta.apellido);
                    $("#iptEspecialidadReg").val(respuesta.especialidad);
                    $("#iptTelefonoReg").val(respuesta.telefono);
                    $("#iptEmailReg").val(respuesta.email);
                    $("#selEmpresaReg").val(respuesta.id_empresa); // Asignar el valor de la empresa
                    $("#iptIdReg").attr("readonly", true); // Hacer el campo ID de solo lectura
                    $("#modalEspecialista").modal('show'); // This line was causing the error
                }
            });
        });
                /*===================================================================
        EVENTO PARA ELIMINAR ESPECIALISTA
        ====================================================================*/
        $("#tbl_Especialistas").on("click", ".btnEliminarEspecialista", function () {
            var id_fisioterapeuta = $(this).data("id");

            Swal.fire({
                title: '¿Está seguro?',
                text: "¿Está seguro de dar de baja a este Especialista?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, Dar de baja!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    var datos = new FormData();
                    datos.append("accion", 5); // Acción para eliminar
                    datos.append("id_fisioterapeuta", id_fisioterapeuta);

                    $.ajax({
                        url: "../ajax/mao.especialistas.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (respuesta) {
                            if (respuesta === "ok") {
                                tablaEspecialistas.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Baja!',
                                    text: 'Especialista dado de baja correctamente.',
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            } else {
                                 Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error al dar de baja el Especialista.'
                                });
                            }
                        }
                    });
                }
            })
        });
        /*EVENTO PARA restablecer ESPECIALISTA
        ====================================================================*/
        $("#tbl_Especialistas").on("click", ".btnAltaEspecialista", function () {
            var id_fisioterapeuta = $(this).data("id");

            Swal.fire({
                title: '¿Está seguro?',
                text: "¿Está seguro de dar de Alta a este Especialista?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, Dar de alta!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    var datos = new FormData();
                    datos.append("accion", 8); // Acción para dar de alta
                    datos.append("id_fisioterapeuta", id_fisioterapeuta);

                    $.ajax({
                        url: "../ajax/mao.especialistas.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (respuesta) {
                            if (respuesta === "ok") {
                                tablaEspecialistas.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Alta!',
                                    text: 'Especialista dado de Alta correctamente.',
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            } else {
                                 Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error al dar de alta el Especialista.'
                                });
                            }
                        }
                    });
                }
            })
        });
        /*===================================================================
        EVENTO PARA LIMPIAR FORMULARIO AL CERRAR MODAL
        ====================================================================*/
        $("#btnCerrarModal, #btnCancelarRegistro").on("click", function () {
            $("#modalEspecialistaLabel").text("Agregar Especialista");
            $("#btnGuardarEspecialista").text("Guardar Especialista");
            $("#btnGuardarEspecialista").addClass("btn-primary"); // Ensure button has btn-primary class
            $("#formEspecialista")[0].reset();
            $("#formEspecialista")[0].classList.remove('was-validated');
             // Remove focus from any element inside the modal
            $("#modalEspecialista :focus").blur(); // This line is key!

            $("#modalEspecialista").modal('hide');
            accion = 2; //set action to add
        });
        $("#btnNuevoEspecialista").on("click", function () {
            accion = 2; //set action to add
            $("#modalEspecialistaLabel").text("Agregar Especialista");
            $("#btnGuardarEspecialista").text("Guardar Especialista");
            $("#btnGuardarEspecialista").addClass("btn-primary"); // Ensure button has btn-primary class
            $("#formEspecialista")[0].reset();
            $("#formEspecialista")[0].classList.remove('was-validated');
            // Store the currently focused element
            focusedElementBeforeModal = document.activeElement;
            // Show the modal
            $("#modalEspecialista").modal('show');
        });
        // Event listener for when the modal is hidden
        $('#modalEspecialista').on('hidden.bs.modal', function () {
            // Restore focus to the element that had it before the modal was opened
            if (focusedElementBeforeModal) {
                //focusedElementBeforeModal.focus();
                //focusedElementBeforeModal.blur();
            }
        });
        // Event listener for when the modal is shown
        $('#modalEspecialista').on('shown.bs.modal', function () {
            // Store the currently focused element
            // var id_empresa = $("#selEmpresaReg").val();
            // obtenerFolio('especialista',id_empresa);
            focusedElementBeforeModal = document.activeElement;
        });
        $("#selEmpresaReg").on('change', function() {
            var id_empresa = $(this).val(); // Obtener el ID de la empresa seleccionada
            obtenerFolio('especialista', id_empresa); // Llamar a la función para obtener el nuevo folio
        });


    });
    function obtenerFolio(entidad,id_empresa) {
        $.ajax({
            url: "../ajax/mao.folio.ajax.php",
            method: "POST",
            data: {
                'accion': 11,
                'entidad': entidad,
                'id_empresa': id_empresa                                                                                                                               
                
            },
            dataType: 'json',
            success: function(respuesta) {
                let folio = respuesta.folio;
                $("#iptIdReg").val(folio);
            }
        });
    }

</script>



</body>
</html>
