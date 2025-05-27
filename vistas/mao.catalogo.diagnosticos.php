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
            <div class="col-lg-12"> <!-- Ajustado a col-lg-12 para más espacio si es necesario -->
                <table id="tbl_Diagnosticos" class="table table-striped w-100 shadow">
                    <thead class="bg-primary text-white"> <!-- Cambiado color a primary -->
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
                <!-- Cambiado color y padding -->
                <h5 class="modal-title">Agregar Diagnóstico</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"
                    id="btnCerrarModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- cuerpo del modal -->
            <div class="modal-body">
                <form class="needs-validation" id="formDiagnostico" novalidate>
                    <!-- Abrimos una fila -->
                    <div class="row">

                        <!-- Columna para registro del ID del Diagnóstico -->
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

                        <!-- Columna para registro del Código Estándar -->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label for="iptCodigoEstandar"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Código Estándar</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="iptCodigoEstandar"
                                    name="iptCodigoEstandar" placeholder="Código Estándar (Opcional)">
                            </div>
                        </div>

                        <!-- Columna para registro de la Categoría del Diagnóstico -->
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

                        <!-- Columna para registro del Nombre del Diagnóstico -->
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

                        <!-- Columna para Descripcion Detallada -->
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label for="iptDescripcionDetallada"><i class="fas fa-align-left fs-6"></i> <span
                                        class="small">Descripción Detallada</span></label>
                                <textarea class="form-control form-control-sm" id="iptDescripcionDetallada"
                                    name="iptDescripcionDetallada" rows="3"
                                    placeholder="Descripción detallada del diagnóstico"></textarea>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="col-12 mt-3 d-flex justify-content-end">
                            <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"
                                id="btnCancelarRegistro">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="btnGuardarDiagnostico">Guardar
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
        /* Bootstrap 4 close button styling */
        padding: 0.75rem 1.25rem;
        margin: -0.75rem -1.25rem -0.75rem auto;
    }
</style>

<script>
    var accionDiagnostico; // Cambiado para evitar conflictos si hay otras variables 'accion'
    var tablaDiagnosticos;
    //var ajaxUrlDiagnosticos = "../mao/ajax/mao.catalogo.diagnosticos.ajax.php"; // Ruta al archivo AJAX de diagnósticos
    var ajaxUrlDiagnosticos = "../ajax/mao.catalogo.diagnosticos.ajax.php"; // Ruta al archivo AJAX de diagnósticos
    
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end', // Cambiado a top-end
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true // Añadido progress bar
    });

    $(document).ready(function () {
        // Hacer el modal arrastrable
        $('#mdlGestionarDiagnostico').draggable({
            handle: "#mdlGestionarDiagnosticoHeader"
        });

        // Carga del listado con DataTables
        tablaDiagnosticos = $("#tbl_Diagnosticos").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                text: 'Agregar Diagnóstico',
                className: 'btn btn-success btn-sm', // Estilo Bootstrap
                action: function (e, dt, node, config) {
                    $("#formDiagnostico")[0].reset();
                    $(".needs-validation").removeClass("was-validated");
                    $("#selCategoriaDiagnostico").val("");
                    $(".modal-title").text("Agregar Diagnóstico"); // Título del modal

                    $.ajax({
                        url: ajaxUrlDiagnosticos,
                        type: "POST",
                        data: { accion: "obtenerSiguienteIdDiagnostico" }, // Acción para obtener ID
                        dataType: 'json',
                        success: function (respuesta) {
                            if (respuesta && respuesta.siguiente_id) {
                                $("#iptIdDiagnostico").val(respuesta.siguiente_id);
                            } else {
                                $("#iptIdDiagnostico").val(1); // Fallback si no se obtiene ID
                                console.warn("No se pudo obtener el siguiente ID, se usó 1 como fallback.");
                            }
                        },
                        error: function () {
                            $("#iptIdDiagnostico").val(1); // Fallback en caso de error
                            Toast.fire({ icon: 'error', title: 'Error al obtener el siguiente ID.' });
                        }
                    });

                    $("#mdlGestionarDiagnostico").modal('show');
                    accionDiagnostico = "registrarDiagnostico"; // Acción para registrar
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
                data: { 'accion': 'listarDiagnosticos' }, // Acción para listar
            },
            responsive: {
                details: { type: 'column' }
            },
            columnDefs: [
                { targets: 0, orderable: false, className: 'control', width: '3%' },
                { targets: 1, data: 'id_diagnostico', width: '5%' },
                { targets: 2, data: 'codigo_estandar', width: '10%', render: function (data) { return data ? data : 'N/A'; } },
                { targets: 3, data: 'nombre_diagnostico', width: '25%' },
                { targets: 4, data: 'descripcion_detallada', width: '27%', render: function (data) { return data ? data : 'N/A'; } },
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
                            "<span class='btnEditarDiagnostico text-primary px-1' style='cursor:pointer;' title='Editar'>" +
                            "<i class='fas fa-pencil-alt fs-5'></i>" +
                            "</span>" +
                            // El botón de eliminar se manejará por el controlador directamente si sigue el patrón del ejemplo
                            // "<span class='btnEliminarDiagnostico text-danger px-1' style='cursor:pointer;' title='Eliminar'>" +
                            // "<i class='fas fa-trash fs-5'></i>" +
                            // "</span>" +
                            "</center>";
                    }
                }
            ],
            language: { "url": "../vistas/assets/json/Spanish.json" } // Asegúrate que esta ruta sea correcta
        });

        // Cargar Select de Categorías de Diagnóstico
        $.ajax({
            url: ajaxUrlDiagnosticos,
            type: 'POST',
            data: { accion: 'listarCategoriasDiagnostico' }, // Acción para listar categorías
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

        // Limpiar formulario al cerrar modal con botón de cancelar o 'x'
        $("#btnCancelarRegistro, #btnCerrarModal").on('click', function () {
            $("#formDiagnostico")[0].reset();
            $(".needs-validation").removeClass("was-validated");
            $("#selCategoriaDiagnostico").val("");
        });

        // Evento para Editar Diagnóstico
        $('#tbl_Diagnosticos tbody').on('click', '.btnEditarDiagnostico', function () {
            accionDiagnostico = "actualizarDiagnostico"; // Esta acción es para el frontend, el backend usará la del form
            $(".modal-title").text("Editar Diagnóstico");

            var data = tablaDiagnosticos.row($(this).parents('tr')).data();

            $("#iptIdDiagnostico").val(data.id_diagnostico);
            $("#iptCodigoEstandar").val(data.codigo_estandar);
            $("#iptNombreDiagnostico").val(data.nombre_diagnostico);
            $("#iptDescripcionDetallada").val(data.descripcion_detallada);
            $("#selCategoriaDiagnostico").val(data.id_categoria_diagnostico);

            $("#mdlGestionarDiagnostico").modal('show');
        });

        // Evento para Guardar (Registrar o Actualizar) Diagnóstico
        $("#btnGuardarDiagnostico").on("click", function () {
            var form = document.getElementById('formDiagnostico');

            if (form.checkValidity() === false) {
                event.preventDefault();
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
                    var datos = new FormData();
                    // El controlador ctrCrearDiagnostico y ctrEditarDiagnostico esperan los datos del POST directamente
                    // No se envía 'accion' aquí porque el controlador lo maneja por la presencia de ciertos campos POST
                    // o por la URL a la que se envía el formulario (si fuera un submit tradicional).
                    // Para AJAX, el controlador determinará la acción basado en si es un nuevo ID o uno existente.

                    // Para el controlador `ctrCrearDiagnostico` (que toma parámetros individuales):
                    // Si `accionDiagnostico` es "registrarDiagnostico", podrías enviar una acción específica.
                    // Para `ctrEditarDiagnostico` (que lee `$_POST` directamente):
                    // Los nombres de los inputs deben coincidir con los esperados por el controlador.

                    // Construimos los datos para el AJAX que llama a los métodos del controlador
                    // que esperan los datos directamente de $_POST (para editar) o como parámetros (para crear)
                    // El archivo ajax.diagnosticos.php se encargará de llamar al método correcto del controlador.

                    var formData = {
                        id_diagnostico: $("#iptIdDiagnostico").val(),
                        codigo_estandar: $("#iptCodigoEstandar").val(),
                        nombre_diagnostico: $("#iptNombreDiagnostico").val(),
                        descripcion_detallada: $("#iptDescripcionDetallada").val(),
                        id_categoria_diagnostico: $("#selCategoriaDiagnostico").val()
                    };

                    // Determinar la acción para el archivo AJAX
                    var ajaxAction = (accionDiagnostico === "registrarDiagnostico") ? "registrarDiagnostico" : "actualizarDiagnosticoViaForm";
                    // 'actualizarDiagnosticoViaForm' es una acción hipotética si el controlador de edición
                    // espera un POST simple y no una llamada AJAX específica con 'accion'.
                    // Si tu `ControladorDiagnosticos::ctrEditarDiagnostico` maneja `$_POST` directamente,
                    // el envío del formulario (incluso vía AJAX) debería funcionar.

                    // Si usas el archivo ajax.diagnosticos.php para registrar:
                    if (accionDiagnostico === "registrarDiagnostico") {
                        formData.accion = "registrarDiagnostico"; // Acción para el archivo AJAX
                        $.ajax({
                            url: ajaxUrlDiagnosticos, // Llama al archivo AJAX
                            method: "POST",
                            data: formData, // Envía los datos del formulario
                            dataType: 'json',
                            success: function (respuesta) {
                                if (respuesta == "ok") {
                                    Toast.fire({ icon: 'success', title: 'Diagnóstico registrado correctamente.' });
                                    tablaDiagnosticos.ajax.reload();
                                    $("#mdlGestionarDiagnostico").modal('hide');
                                    $("#formDiagnostico")[0].reset();
                                    $(".needs-validation").removeClass("was-validated");
                                } else {
                                    Toast.fire({ icon: 'error', title: 'Error al registrar el diagnóstico: ' + respuesta });
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                Toast.fire({ icon: 'error', title: 'Error en la solicitud AJAX: ' + textStatus });
                            }
                        });
                    } else { // Para actualizar, el controlador ctrEditarDiagnostico maneja el POST
                        // Se envía el formulario directamente al script del controlador que maneja la edición.
                        // Esto asume que tu `ControladorDiagnosticos::ctrEditarDiagnostico` está en un archivo
                        // que puede ser el target de un form action, o que el archivo AJAX lo redirige.
                        // Para simplificar y seguir el patrón de tu AJAX, podrías tener una acción en ajax.diagnosticos.php
                        // que llame a ctrEditarDiagnostico.
                        // Por ahora, vamos a simular el envío del formulario al controlador directamente.
                        // Esto requiere que el controlador esté configurado para manejar un POST de esta forma.
                        // La forma más limpia es que el controlador `ctrEditarDiagnostico` se llame desde el archivo AJAX.
                        // Como el controlador `ctrEditarDiagnostico` ya genera la respuesta con SweetAlert,
                        // simplemente enviamos el formulario a un script que lo procese.
                        // Aquí, asumimos que el controlador se invoca y devuelve el script de SweetAlert.

                        // Para que esto funcione como el ejemplo de servicios, el form se enviaría a una página
                        // que incluya y ejecute el `ControladorDiagnosticos::ctrEditarDiagnostico()`.
                        // Y esa página devolvería el script.
                        // Si quieres una respuesta JSON y manejarla aquí, el controlador debe cambiar.

                        // Solución: Enviar el formulario al mismo archivo PHP que contiene el controlador
                        // y que este ejecute la función de edición.
                        // O, mejor, que el archivo AJAX maneje la llamada al controlador de edición.
                        // Como el controlador `ctrEditarDiagnostico` ya está hecho para manejar `$_POST`,
                        // podemos hacer un POST a un script que lo llame.
                        // Para este ejemplo, vamos a asumir que el controlador se llama y la página se recarga
                        // o el controlador devuelve el script de SweetAlert.

                        // Para que funcione con el `ControladorDiagnosticos::ctrEditarDiagnostico` que genera HTML/JS:
                        var formElement = $("#formDiagnostico")[0];
                        var datosPost = new FormData(formElement);
                        // Añadimos los nombres que espera el controlador si son diferentes
                        datosPost.set("iptIdDiagnostico", $("#iptIdDiagnostico").val());
                        datosPost.set("iptCodigoEstandar", $("#iptCodigoEstandar").val());
                        datosPost.set("iptNombreDiagnostico", $("#iptNombreDiagnostico").val());
                        datosPost.set("iptDescripcionDetallada", $("#iptDescripcionDetallada").val());
                        datosPost.set("selCategoriaDiagnostico", $("#selCategoriaDiagnostico").val());

                        $.ajax({
                            url: 'ruta_a_tu_script_que_ejecuta_ctrEditarDiagnostico.php', // DEBES CAMBIAR ESTO
                            method: "POST",
                            data: datosPost,
                            contentType: false,
                            processData: false,
                            success: function (respuestaHTML) {
                                // El controlador ctrEditarDiagnostico devuelve HTML con script de SweetAlert
                                $("body").append(respuestaHTML); // Añade el script a la página para que se ejecute
                                $("#mdlGestionarDiagnostico").modal('hide');
                                // La recarga de la tabla y limpieza del form se haría por el script de SweetAlert
                                // o podrías hacerlo aquí si la respuesta es solo "ok"
                                // tablaDiagnosticos.ajax.reload();
                                // $("#formDiagnostico")[0].reset();
                            },
                            error: function () {
                                Toast.fire({ icon: 'error', title: 'Error al actualizar el diagnóstico.' });
                            }
                        });
                    }
                }
            });
        });

        // Limpiar mensajes de validación al cancelar
        $("#btnCancelarRegistro").on("click", function () {
            $(".needs-validation").removeClass("was-validated");
        });

    }); // Fin document.ready
</script>