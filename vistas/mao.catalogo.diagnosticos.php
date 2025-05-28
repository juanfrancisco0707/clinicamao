<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Catálogo de Diagnósticos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Diagnósticos</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <!-- row para listado de Diagnósticos -->
        <div class="row">
            <div class="col-lg-12">
                <table id="tbl_Diagnosticos" class="table table-striped w-100 shadow">
                    <thead class="bg-primary text-white">
                        <tr style="font-size: 12px;">
                            <th></th> <!-- Para control de DataTables responsive -->
                            <th>ID</th>
                            <th>Código Estándar</th>
                            <th>Nombre del Diagnóstico</th>
                            <th>Descripción Detallada</th>
                            <th>Categoría</th>
                            <th>Creado</th>
                            <th>Actualizado</th>
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

<!-- Ventana Modal para ingresar o modificar un Diagnóstico -->
<div class="modal fade" id="mdlGestionarDiagnostico" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- contenido del modal -->
        <div class="modal-content">
            <!-- cabecera del modal -->
            <div class="modal-header bg-primary text-white py-2" id="mdlGestionarDiagnosticoHeader">
                <h5 class="modal-title">Agregar Diagnóstico</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"
                    id="btnCerrarModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- cuerpo del modal -->
            <div class="modal-body">
                <form class="needs-validation" id="formDiagnostico" novalidate>
                    <!-- Fila para ID y Código Estándar -->
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label for="iptIdDiagnostico"><i class="fas fa-id-card fs-6"></i>
                                    <span class="small">ID Diagnóstico</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptIdDiagnostico"
                                    name="iptIdDiagnostico" placeholder="ID del Diagnóstico" required readonly>
                                <div class="invalid-feedback">Debe ingresar el ID del diagnóstico.</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label for="iptCodigoEstandar"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Código Estándar</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="iptCodigoEstandar"
                                    name="iptCodigoEstandar" placeholder="Código Estándar (Opcional)">
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label for="selCategoriaDiagnostico"><i class="fas fa-tags fs-6"></i> <span
                                        class="small">Categoría</span><span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" id="selCategoriaDiagnostico"
                                    name="selCategoriaDiagnostico" required>
                                    <!-- Opciones se cargarán dinámicamente -->
                                </select>
                                <div class="invalid-feedback">Seleccione una categoría.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Fila para Nombre del Diagnóstico -->
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label for="iptNombreDiagnostico"><i class="fas fa-file-signature fs-6"></i> <span
                                        class="small">Nombre del Diagnóstico</span><span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptNombreDiagnostico"
                                    name="iptNombreDiagnostico" placeholder="Nombre del Diagnóstico" required>
                                <div class="invalid-feedback">Debe ingresar el nombre del diagnóstico.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Fila para Descripción Detallada -->
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label for="iptDescripcionDetallada"><i class="fas fa-align-left fs-6"></i> <span
                                        class="small">Descripción Detallada</span></label>
                                <textarea class="form-control form-control-sm" id="iptDescripcionDetallada"
                                    name="iptDescripcionDetallada" rows="3"
                                    placeholder="Descripción detallada del diagnóstico"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Fila para Botones de acción -->
                    <div class="row">
                        <div class="col-12 mt-3 d-flex justify-content-end">
                            <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"
                                id="btnCancelarRegistro">Cancelar</button>
                            <button type="submit" class="btn btn-primary" id="btnGuardarDiagnostico">Guardar
                                Diagnóstico</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /. Fin de Ventana Modal -->

<style>
    #tbl_Diagnosticos td {
        white-space: normal !important;
        word-wrap: break-word;
        vertical-align: top;
    }

    .modal-header .close {
        padding: 0.75rem 1.25rem;
        margin: -0.75rem -1.25rem -0.75rem auto;
    }
</style>

<script>
    var accionDiagnostico;
    var tablaDiagnosticos;
    var ajaxUrlDiagnosticos = "../ajax/mao.catalogo.diagnosticos.ajax.php"; // Ajusta esta ruta

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });

    $(document).ready(function () {
        $('#mdlGestionarDiagnostico').draggable({
            handle: "#mdlGestionarDiagnosticoHeader"
        });

        tablaDiagnosticos = $("#tbl_Diagnosticos").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                text: 'Agregar Diagnóstico',
                className: 'btn btn-success btn-sm',
                action: function (e, dt, node, config) {
                    $("#formDiagnostico")[0].reset();
                    $(".needs-validation").removeClass("was-validated");
                    $("#selCategoriaDiagnostico").val("");
                    $(".modal-title").text("Agregar Diagnóstico");
                    $("#iptIdDiagnostico").removeAttr("readonly"); // Permitir edición para nuevo

                    $.ajax({
                        url: ajaxUrlDiagnosticos,
                        type: "POST",
                        data: { accion: "obtenerSiguienteIdDiagnostico" },
                        dataType: 'json',
                        success: function (respuesta) {
                            if (respuesta && respuesta.siguiente_id) {
                                $("#iptIdDiagnostico").val(respuesta.siguiente_id).attr("readonly", true);
                            } else {
                                $("#iptIdDiagnostico").val("").removeAttr("readonly"); // Permitir ingreso manual si falla
                                console.warn("No se pudo obtener el siguiente ID.");
                            }
                        },
                        error: function () {
                            $("#iptIdDiagnostico").val("").removeAttr("readonly");
                            Toast.fire({ icon: 'error', title: 'Error al obtener el siguiente ID.' });
                        }
                    });

                    $("#mdlGestionarDiagnostico").modal('show');
                    accionDiagnostico = "registrarDiagnostico";
                }
            },
            { extend: 'excel', text: 'Excel', className: 'btn btn-sm' },
            { extend: 'print', text: 'Imprimir', className: 'btn btn-sm' },
            { extend: 'pageLength', text: 'Mostrar', className: 'btn btn-sm' }
            ],
            pageLength: 10,
            ajax: {
                url: ajaxUrlDiagnosticos,
                dataSrc: '',
                type: "POST",
                data: { 'accion': 'listarDiagnosticos' },
            },
            responsive: {
                details: { type: 'column' }
            },
            columnDefs: [
                { targets: 0, data: null, defaultContent: '', orderable: false, className: 'control', width: '3%' },
                { targets: 1, data: 'id_diagnostico', width: '5%' },
                { targets: 2, data: 'codigo_estandar', width: '10%', render: function (data) { return data ? data : 'N/A'; } },
                { targets: 3, data: 'nombre_diagnostico', width: '25%' },
                { targets: 4, data: 'descripcion_detallada', width: '27%', render: function (data) { return data ? data.substring(0, 50) + (data.length > 50 ? '...' : '') : 'N/A'; } },
                { targets: 5, data: 'nombre_categoria_diagnostico', width: '10%', render: function (data) { return data ? data : 'Sin categoría'; } },
                { targets: 6, data: 'creado_en', width: '10%', render: function (data) { return moment(data).format('DD/MM/YYYY HH:mm'); } },
                { targets: 7, data: 'actualizado_en', width: '10%', render: function (data) { return moment(data).format('DD/MM/YYYY HH:mm'); } },
                {
                    targets: 8,
                    orderable: false,
                    width: '10%',
                    className: 'text-center',
                    render: function (data, type, full, meta) {
                        return "<center>" +
                            "<span class='btnEditarDiagnostico text-primary px-1' style='cursor:pointer;' title='Editar' data-id='" + full.id_diagnostico + "'>" +
                            "<i class='fas fa-pencil-alt fs-5'></i>" +
                            "</span>" +
                            "<span class='btnEliminarDiagnostico text-danger px-1' style='cursor:pointer;' title='Eliminar' data-id='" + full.id_diagnostico + "'>" +
                            "<i class='fas fa-trash fs-5'></i>" +
                            "</span>" +
                            "</center>";
                    }
                }
            ],
            language: { "url": "../vistas/assets/json/Spanish.json" }
        });

        $.ajax({
            url: ajaxUrlDiagnosticos,
            type: 'POST',
            data: { accion: 'listarCategoriasDiagnostico' },
            dataType: 'json',
            success: function (respuesta) {
                var options = '<option selected value="">Seleccione una Categoría...</option>';
                if (respuesta && respuesta.length > 0) {
                    respuesta.forEach(function (categoria) {
                        options += '<option value="' + categoria.id_categoria_diagnostico + '">' + categoria.nombre_categoria + '</option>';
                    });
                }
                $("#selCategoriaDiagnostico").empty().append(options);
            },
            error: function () {
                $("#selCategoriaDiagnostico").empty().append('<option value="">Error al cargar categorías</option>');
                Toast.fire({ icon: 'error', title: 'Error al cargar categorías de diagnóstico.' });
            }
        });

        $("#btnCancelarRegistro, #btnCerrarModal").on('click', function () {
            $("#formDiagnostico")[0].reset();
            $(".needs-validation").removeClass("was-validated");
            $("#selCategoriaDiagnostico").val("");
        });

        $('#tbl_Diagnosticos tbody').on('click', '.btnEditarDiagnostico', function () {
            accionDiagnostico = "actualizarDiagnostico";
            $(".modal-title").text("Editar Diagnóstico");
            $("#iptIdDiagnostico").attr("readonly", true); // ID no editable al actualizar

            var data = tablaDiagnosticos.row($(this).parents('tr')).data();

            $("#iptIdDiagnostico").val(data.id_diagnostico);
            $("#iptCodigoEstandar").val(data.codigo_estandar);
            $("#iptNombreDiagnostico").val(data.nombre_diagnostico);
            $("#iptDescripcionDetallada").val(data.descripcion_detallada);
            $("#selCategoriaDiagnostico").val(data.id_categoria_diagnostico);

            $("#mdlGestionarDiagnostico").modal('show');
        });

        // Evento para el envío del formulario (Registrar o Actualizar)
        $("#formDiagnostico").on("submit", function (event) {
            event.preventDefault(); // Prevenir el envío tradicional del formulario
            var form = this;

            if (form.checkValidity() === false) {
                event.stopPropagation();
                form.classList.add('was-validated');
                Toast.fire({ icon: 'error', title: 'Por favor, complete los campos requeridos.' });
                return;
            }

            var tituloConfirmacion = (accionDiagnostico === "registrarDiagnostico") ?
                '¿Está seguro de registrar el diagnóstico?' :
                '¿Está seguro de actualizar el diagnóstico?';

            Swal.fire({
                title: tituloConfirmacion,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, continuar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    var postData = {
                        iptIdDiagnostico: $("#iptIdDiagnostico").val(),
                        iptCodigoEstandar: $("#iptCodigoEstandar").val(),
                        iptNombreDiagnostico: $("#iptNombreDiagnostico").val(),
                        iptDescripcionDetallada: $("#iptDescripcionDetallada").val(),
                        selCategoriaDiagnostico: $("#selCategoriaDiagnostico").val()
                    };

                    if (accionDiagnostico === "registrarDiagnostico") {
                        // Para registrar, usamos el archivo AJAX que llama a ctrCrearDiagnostico
                        var formDataAjax = {
                            accion: "registrarDiagnostico",
                            id_diagnostico: $("#iptIdDiagnostico").val(),
                            codigo_estandar: $("#iptCodigoEstandar").val(),
                            nombre_diagnostico: $("#iptNombreDiagnostico").val(),
                            descripcion_detallada: $("#iptDescripcionDetallada").val(),
                            id_categoria_diagnostico: $("#selCategoriaDiagnostico").val()
                        };
                        $.ajax({
                            url: ajaxUrlDiagnosticos,
                            method: "POST",
                            data: formDataAjax,
                            dataType: 'json',
                            success: function (respuesta) {
                                if (respuesta == "ok") {
                                    Toast.fire({ icon: 'success', title: 'Diagnóstico registrado correctamente.' });
                                    tablaDiagnosticos.ajax.reload();
                                    $("#mdlGestionarDiagnostico").modal('hide');
                                } else {
                                    Toast.fire({ icon: 'error', title: 'Error al registrar: ' + (respuesta.mensaje || respuesta) });
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                Toast.fire({ icon: 'error', title: 'Error AJAX: ' + textStatus });
                            }
                        });
                    } else { // Para actualizar, el controlador ctrEditarDiagnostico maneja el POST directamente
                        // La URL debe apuntar a un script PHP que ejecute ControladorDiagnosticos::ctrEditarDiagnostico()
                        // Este script PHP devolverá el script de SweetAlert.
                        $.ajax({
                            url: '../ajax/mao.catalogo.diagnosticos.ajax.php', // DEBES CREAR ESTE ARCHIVO O AJUSTAR LA RUTA
                            method: "POST",
                            data: $(form).serialize(), // Envía los datos del formulario serializados
                            success: function (respuestaHTML) {
                                $("body").append(respuestaHTML); // Añade el script de SweetAlert a la página
                                $("#mdlGestionarDiagnostico").modal('hide');
                                // La recarga de la tabla es manejada por el script de SweetAlert (window.location)
                            },
                            error: function () {
                                Toast.fire({ icon: 'error', title: 'Error al conectar para actualizar.' });
                            }
                        });
                    }
                }
            });
            form.classList.remove('was-validated'); // Limpiar validación para el próximo uso
        });

 /* ======================================================================================
        EVENTO AL DAR CLICK EN EL BOTON ELIMINAR Servicio
        =========================================================================================*/
        $('#tbl_Diagnosticos tbody').on('click', '.btnEliminarDiagnostico', function () {

            accion = "eliminarDiagnostico"; //seteamos la accion para editar
            var id_diagnostico = $(this).data('id');
           // var data = table.row($(this).parents('tr')).data();

           // var idDiagnostico = data[0];

            Swal.fire({
                title: 'Está seguro de eliminar el Diagnóstico?',
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
                    datos.append("id_diagnostico", id_diagnostico); //idDiagnostico             

                    $.ajax({
                        url: "../ajax/mao.catalogo.diagnosticos.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function (respuesta) {

                            if (respuesta == "ok") {

                                Toast.fire({
                                    icon: 'success',
                                    title: 'El Diagnóstico se eliminó correctamente'
                                });

                                tablaDiagnosticos.ajax.reload();

                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'El Diagnóstico no se pudo eliminar'
                                });
                            }

                        }
                    });

                }
            })
        })


        $("#btnCancelarRegistro").on("click", function () {
            $(".needs-validation").removeClass("was-validated");
            $("#formDiagnostico")[0].reset();
        });
        $('#mdlGestionarDiagnostico').on('hidden.bs.modal', function () {
            $(".needs-validation").removeClass("was-validated");
            $("#formDiagnostico")[0].reset();
        });


    }); // Fin document.ready
</script>