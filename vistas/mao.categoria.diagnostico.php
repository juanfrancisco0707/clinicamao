
    <div class="container-fluid pt-3">
        <!-- Botón para agregar nueva categoría -->
        <div class="row mb-3">
            <div class="col-md-12">
                <button id="btnNuevo" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Agregar Categoría
                </button>
            </div>
        </div>

        <!-- row para listado de Categorías de Diagnóstico -->
        <div class="row">
            <div class="col-lg-10"> <!-- Ajustado el ancho para mejor visualización -->
                <table id="tbl_Categorias" class="table table-striped table-bordered w-100 shadow">
                    <thead class="bg-info text-white">
                        <tr style="font-size: 12px;">
                            <th></th> <!-- Para el control de DataTables (responsive) -->
                            <th>ID</th>
                            <th>Nombre de la Categoría</th>
                            <th>Descripción (breve)</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-small">
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <!-- Modal para Agregar/Editar Categoría -->
    <div class="modal fade" id="modalCategorias" tabindex="-1" role="dialog" aria-labelledby="modalCategoriasLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white py-2">
                    <h5 class="modal-title" id="modalCategoriasLabel">Agregar Categoría</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="btnCerrarModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCategoria" class="needs-validation" novalidate>
                        <input type="hidden" id="id_categoria_diagnostico"> <!-- Campo oculto para el ID en edición -->
                        <div class="row">
                            <!-- Columna para registro del Nombre de la Categoría -->
                            <div class="col-12 col-md-6">
                                <div class="form-group mb-2">
                                    <label for="iptNombreCategoriaReg"><i class="fas fa-file-signature"></i> <span class="small">Nombre</span><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="iptNombreCategoriaReg" placeholder="Nombre de la categoría" required>
                                    <div class="invalid-feedback">Debe ingresar el nombre de la categoría.</div>
                                </div>
                            </div>

                            <!-- Columna para la descripción -->
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <label for="iptDescripcionCategoriaReg"><i class="fas fa-align-left"></i> <span class="small">Descripción</span></label>
                                    <textarea class="form-control form-control-sm" id="iptDescripcionCategoriaReg" rows="3" placeholder="Descripción detallada de la categoría"></textarea>
                                </div>
                            </div>

                            <!-- Botones -->
                            <div class="col-12 text-right mt-3">
                                <button type="button" class="btn btn-danger mx-2" style="width:170px;" data-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                                <button type="button" class="btn btn-primary mx-2" style="width:170px;" id="btnGuardarCategoria">Guardar Categoría</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Popper.js, necesario para tooltips y popovers de Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Bootstrap 4 JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Bootstrap 4 JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <!-- DataTables Responsive JS (opcional, pero recomendado) -->
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <!-- SweetAlert2 (opcional, para mejores alertas) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery UI (opcional, para hacer el modal arrastrable) -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    <script>
    $(document).ready(function () {
        let tablaCategorias;
        let accionActual = ''; // Para saber si estamos agregando o editando

        // Hacer el modal arrastrable (opcional, requiere jQuery UI)
        $("#modalCategorias").draggable({
            handle: ".modal-header"
        });

        /*===================================================================
        INICIALIZAR DATATABLE
        ====================================================================*/
        tablaCategorias = $('#tbl_Categorias').DataTable({
            ajax: {
                url: '../ajax/mao.categoria.diagnostico.ajax.php', // Ajusta la ruta a tu archivo AJAX
                type: 'POST',
                dataType: 'json',
                data: { accion: 1 }, // Acción para listar
                dataSrc: "" // Si tu AJAX devuelve directamente el array de datos
            },
            columns: [
                {
                    className: 'dt-control', // Para el botón de expandir/colapsar
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                { data: 'id_categoria_diagnostico' },
                { data: 'nombre_categoria' },
                { data: 'descripcion_categoria',
                  render: function(data, type, row){
                      if(type === 'display' && data && data.length > 60){ // Acortar descripción
                          return data.substr(0, 60) + '...';
                      }
                      return data || '<i>Sin descripción</i>';
                  }
                },
                {
                    data: null,
                    orderable: false,
                    render: function (data, type, row) {
                        return `<div class="text-center">
                                    <button class="btn btn-sm btn-primary btnEditar" data-id="${row.id_categoria_diagnostico}"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger btnBorrar" data-id="${row.id_categoria_diagnostico}"><i class="fas fa-trash"></i></button>
                                </div>`;
                    }
                }
            ],
            responsive: {
                details: {
                    type: 'column',
                    target: 0 // Usa la primera columna para el control de responsive
                }
            },
            columnDefs: [
                { responsivePriority: 1, targets: 2 }, // Nombre
                { responsivePriority: 2, targets: 4 }  // Opciones
            ],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            },
            order: [[1, 'asc']] // Ordenar por ID por defecto
        });

        /*===================================================================
        FUNCION PARA EXPANDIR/CONTRAER DETALLES (DESCRIPCIÓN COMPLETA)
        ====================================================================*/
        $('#tbl_Categorias tbody').on('click', 'td.dt-control', function () {
            var tr = $(this).closest('tr');
            var row = tablaCategorias.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown dt-hasChild'); // dt-hasChild es la clase que DataTables usa
            } else {
                // Formatear la información adicional (descripción completa)
                row.child(format(row.data())).show();
                tr.addClass('shown dt-hasChild');
            }
        });

        function format(rowData) {
            // Muestra la descripción completa en la fila expandida
            return `<div class="p-2" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: .25rem;">
                        <strong>Descripción Completa:</strong><br>
                        <p style="white-space: pre-wrap;">${rowData.descripcion_categoria || 'No hay descripción detallada.'}</p>
                    </div>`;
        }

        /*===================================================================
        ABRIR MODAL PARA NUEVA CATEGORÍA
        ====================================================================*/
        $('#btnNuevo').on('click', function () {
            accionActual = 'agregar';
            $('#formCategoria')[0].reset(); // Limpia el formulario
            $('#id_categoria_diagnostico').val(''); // Asegura que el ID oculto esté vacío
            $('#modalCategoriasLabel').text('Agregar Categoría');
            $('#formCategoria').removeClass('was-validated'); // Remueve clases de validación previas
            $('#modalCategorias').modal('show');
        });

        /*===================================================================
        GUARDAR (REGISTRAR O ACTUALIZAR) CATEGORÍA
        ====================================================================*/
        $('#btnGuardarCategoria').on('click', function () {
            var form = $('#formCategoria');
            form.addClass('was-validated'); // Activa la validación de Bootstrap

            if (form[0].checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                return;
            }

            let id_categoria = $('#id_categoria_diagnostico').val();
            let nombre_categoria = $('#iptNombreCategoriaReg').val();
            let descripcion_categoria = $('#iptDescripcionCategoriaReg').val();

            let datos = new FormData(); // Usar FormData para enviar datos
            datos.append('nombre_categoria', nombre_categoria);
            datos.append('descripcion_categoria', descripcion_categoria);

            if (accionActual === 'editar' && id_categoria) {
                datos.append('accion', 4); // Acción para actualizar
                datos.append('id_categoria_diagnostico', id_categoria);
            } else {
                datos.append('accion', 2); // Acción para registrar
                // No se envía id_categoria_diagnostico para el registro ya que es AUTO_INCREMENT
            }

            $.ajax({
                url: '../ajax/mao.categoria.diagnostico.ajax.php', // Ajusta la ruta si es necesario
                type: 'POST',
                data: datos,
                dataType: 'json',
                processData: false,  // Necesario para FormData
                contentType: false, // Necesario para FormData
                success: function (respuesta) {
                    if (respuesta === "ok") {
                        Swal.fire({
                            icon: 'success',
                            title: `Categoría ${accionActual === 'editar' ? 'actualizada' : 'registrada'} correctamente`,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        tablaCategorias.ajax.reload(); // Recarga la tabla para mostrar los cambios
                        $('#modalCategorias').modal('hide');
                    } else {
                        // Manejar errores específicos del backend
                        let mensajeError = 'No se pudo guardar la categoría.';
                        if (typeof respuesta === 'string' && respuesta.includes('Excepción capturada: Duplicate entry')) {
                            mensajeError = 'El nombre de la categoría ya existe.';
                        } else if (respuesta && respuesta.mensaje) { // Si el backend devuelve un JSON con mensaje
                            mensajeError = respuesta.mensaje;
                        } else if (Array.isArray(respuesta) && respuesta.length > 0 && respuesta[2]) { // Error PDO
                            mensajeError = 'Error de base de datos: ' + respuesta[2];
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: mensajeError
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de comunicación',
                        text: 'No se pudo conectar con el servidor: ' + textStatus
                    });
                }
            });
        });

        /*===================================================================
        EDITAR CATEGORÍA
        ====================================================================*/
        $('#tbl_Categorias tbody').on('click', '.btnEditar', function () {
            accionActual = 'editar';
            var data = tablaCategorias.row($(this).parents('tr')).data(); // Obtiene los datos de la fila

            $('#id_categoria_diagnostico').val(data.id_categoria_diagnostico);
            $('#iptNombreCategoriaReg').val(data.nombre_categoria);
            $('#iptDescripcionCategoriaReg').val(data.descripcion_categoria);

            $('#modalCategoriasLabel').text('Editar Categoría');
            $('#formCategoria').removeClass('was-validated');
            $('#modalCategorias').modal('show');
        });

        /*===================================================================
        ELIMINAR CATEGORÍA
        ====================================================================*/
        $('#tbl_Categorias tbody').on('click', '.btnBorrar', function () {
            var idCategoria = $(this).data('id'); // Obtiene el ID del atributo data-id

            Swal.fire({
                title: '¿Está seguro?',
                text: "¡No podrá revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, ¡bórralo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '../ajax/mao.categoria.diagnostico.ajax.php', // Ajusta la ruta
                        type: 'POST',
                        data: {
                            accion: 5, // Acción para eliminar
                            id_categoria_diagnostico: idCategoria
                        },
                        dataType: 'json',
                        success: function (respuesta) {
                            if (respuesta === "ok") {
                                Swal.fire(
                                    '¡Borrado!',
                                    'La categoría ha sido eliminada.',
                                    'success'
                                );
                                tablaCategorias.ajax.reload();
                            } else {
                                // Manejar errores específicos del backend al eliminar
                                let mensajeError = 'No se pudo eliminar la categoría.';
                                if (Array.isArray(respuesta) && respuesta.length > 0 && respuesta[2]) { // Error PDO
                                    if (respuesta[1] == 1451) { // Código de error para restricción de clave foránea
                                        mensajeError = 'No se puede eliminar la categoría porque está siendo utilizada en otros registros.';
                                    } else {
                                        mensajeError = 'Error al eliminar: ' + respuesta[2];
                                    }
                                } else if (respuesta && respuesta.mensaje) {
                                    mensajeError = respuesta.mensaje;
                                }
                                Swal.fire(
                                    'Error',
                                    mensajeError,
                                    'error'
                                );
                            }
                        },
                        error: function () {
                            Swal.fire(
                                'Error de Comunicación',
                                'No se pudo conectar con el servidor.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

        /*===================================================================
        LIMPIAR VALIDACIÓN AL CERRAR MODAL
        ====================================================================*/
        $('#btnCancelarRegistro, #btnCerrarModal').on('click', function() {
            $('#formCategoria').removeClass('was-validated');
            $('#formCategoria')[0].reset(); // También resetea el formulario
        });
         // También al cerrar el modal con la tecla ESC o haciendo clic fuera
        $('#modalCategorias').on('hidden.bs.modal', function () {
            $('#formCategoria').removeClass('was-validated');
            $('#formCategoria')[0].reset();
        });

    });
    </script>




