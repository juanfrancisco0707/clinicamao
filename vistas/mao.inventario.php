<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <!-- Incluye Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluye DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Incluye Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .text-small {
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <!-- row para listado de Inventario -->
    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary mb-3" id="btnNuevoItem">Nuevo Item</button>
            <table id="tbl_Inventario" class="table table-striped w-100 shadow">
                <thead class="bg-info">
                    <tr style="font-size: 12px;">
                        <th></th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody class="text-small">
                </tbody>
            </table>
        </div>
    </div>
</div><!-- /.container-fluid -->

<!-- Modal para agregar/editar Item -->
<div class="modal fade" id="modalItem" tabindex="-1" aria-labelledby="modalItemLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- contenido del modal -->
        <div class="modal-content">
            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">
                <h5 class="modal-title" id="modalItemLabel">Agregar Item</h5>
                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>
            </div>
            <!-- cuerpo del modal -->
            <div class="modal-body">
                <form class="needs-validation" novalidate id="formItem">
                    <!-- Abrimos una fila -->
                    <div class="row">
                        <!-- Columna para registro del Nombre -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptNombreReg"><i class="fas fa-file-signature fs-6"></i> <span class="small">Nombre</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptNombreReg" name="iptNombre" placeholder="Nombre" required>
                                <div class="invalid-feedback">Debe ingresar el nombre</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la Descripcion -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptDescripcionReg"><i class="fas fa-align-left fs-6"></i> <span class="small">Descripción</span></label>
                                <textarea class="form-control form-control-sm" id="iptDescripcionReg" name="iptDescripcion" placeholder="Descripción"></textarea>
                            </div>
                        </div>
                        <!-- Columna para registro de la Cantidad -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptCantidadReg"><i class="fas fa-hashtag fs-6"></i> <span class="small">Cantidad</span><span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" id="iptCantidadReg" name="iptCantidad" placeholder="Cantidad" value="0" required>
                                <div class="invalid-feedback">Debe ingresar la cantidad</div>
                            </div>
                        </div>
                        <!-- Columna para registro del Precio Unitario -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptPrecioUnitarioReg"><i class="fas fa-dollar-sign fs-6"></i> <span class="small">Precio Unitario</span><span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control form-control-sm" id="iptPrecioUnitarioReg" name="iptPrecioUnitario" placeholder="Precio Unitario" required>
                                <div class="invalid-feedback">Debe ingresar el precio unitario</div>
                            </div>
                        </div>

                        <!-- creacion de botones para cancelar y guardar el Item -->
                        <div class="col-12">
                            <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;" data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                            <button type="submit" style="width:170px;" class="btn btn-primary mt-3 mx-2" id="btnGuardarItem">Guardar Item</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Incluye jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<!-- Incluye Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Incluye DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<!-- Incluye SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        /*===================================================================
        VARIABLE PARA ALMACENAR LA INFORMACION DEL ITEM
        ====================================================================*/
        let dataTable;
        let modoEdicion = false;
        let idItemEdicion = null;
        /*===================================================================
        FUNCION PARA CARGAR LA TABLA DE INVENTARIO
        ====================================================================*/
        const cargarTablaInventario = () => {
            dataTable = $('#tbl_Inventario').DataTable({
                ajax: {
                    url: '../ajax/mao.inventario.ajax.php', // Reemplaza con la URL correcta
                    type: 'POST',
                    data: { accion: 'listar' },
                    dataSrc: ''
                },
                columns: [
                    {
                        defaultContent: '',
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    },
                    { data: 'id_item' },
                    { data: 'nombre' },
                    { data: 'descripcion' },
                    { data: 'cantidad' },
                    { data: 'precio_unitario' },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return `
                                <div class="text-center">
                                    <button class="btn btn-warning btn-sm btnEditarItem" data-id="${row.id_item}"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btn-sm btnEliminarItem" data-id="${row.id_item}"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            `;
                        }
                    }
                ],
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                order: [[1, 'asc']],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                }
            });
        }
        /*===================================================================
        FUNCION PARA CARGAR LA TABLA DE INVENTARIO
        ====================================================================*/
        cargarTablaInventario();
        /*===================================================================
        FUNCION PARA ABRIR EL MODAL DE REGISTRO DE ITEM
        ====================================================================*/
        $("#btnNuevoItem").on('click', function () {
            modoEdicion = false;
            idItemEdicion = null;
            $("#modalItemLabel").text("Agregar Item");
            $("#formItem")[0].reset();
            $("#modalItem").modal('show');
        });
        /*===================================================================
        FUNCION PARA GUARDAR O ACTUALIZAR UN ITEM
        ====================================================================*/
        $("#formItem").on('submit', function (event) {
            event.preventDefault();
            if (this.checkValidity()) {
                let datosItem = {
                    nombre: $("#iptNombreReg").val(),
                    descripcion: $("#iptDescripcionReg").val(),
                    cantidad: $("#iptCantidadReg").val(),
                    precio_unitario: $("#iptPrecioUnitarioReg").val(),
                    accion: modoEdicion ? 'actualizar' : 'registrar'
                };

                if (modoEdicion) {
                    datosItem.id_item = idItemEdicion;
                }

                $.ajax({
                    url: '../ajax/mao.inventario.ajax.php', // Reemplaza con la URL correcta
                    type: 'POST',
                    data: datosItem,
                    success: function (response) {
                        if (response === 'ok') {
                            Swal.fire({
                                icon: 'success',
                                title: modoEdicion ? 'Item Actualizado' : 'Item Registrado',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#modalItem").modal('hide');
                            dataTable.ajax.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un error al guardar el item.'
                            });
                        }
                    }
                });
            } else {
                this.classList.add('was-validated');
            }
        });
        /*===================================================================
        FUNCION PARA EDITAR UN ITEM
        ====================================================================*/
        $("#tbl_Inventario").on('click', '.btnEditarItem', function () {
            modoEdicion = true;
            idItemEdicion = $(this).data('id');
            $("#modalItemLabel").text("Editar Item");

            $.ajax({
                url: '../ajax/mao.inventario.ajax.php', // Reemplaza con la URL correcta
                type: 'POST',
                data: { accion: 'obtener', id_item: idItemEdicion },
                dataType: 'json',
                success: function (item) {
                    $("#iptNombreReg").val(item.nombre);
                    $("#iptDescripcionReg").val(item.descripcion);
                    $("#iptCantidadReg").val(item.cantidad);
                    $("#iptPrecioUnitarioReg").val(item.precio_unitario);
                    $("#modalItem").modal('show');
                }
            });
        });
        /*===================================================================
        FUNCION PARA ELIMINAR UN ITEM
        ====================================================================*/
        $("#tbl_Inventario").on('click', '.btnEliminarItem', function () {
            let idItem = $(this).data('id');
            Swal.fire({
                title: '¿Estás seguro de eliminar este item?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '../ajax/mao.inventario.ajax.php', // Reemplaza con la URL correcta
                        type: 'POST',
                        data: { accion: 'eliminar', id_item: idItem },
                        success: function (response) {
                            if (response === 'ok') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Item Eliminado',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                dataTable.ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Hubo un error al eliminar el item.'
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>

</body>
</html>
