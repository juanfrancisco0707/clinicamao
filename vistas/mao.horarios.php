<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Horarios</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Horarios</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <table id="tbl_horarios" class="table table-striped w-100 shadow">
                    <thead class="bg-info">
                        <tr style="font-size: 12px;">
                            <th></th>
                            <th>ID</th>
                            <th>Fisioterapeuta</th>
                            <th>Día</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-small"></tbody>
                </table>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<!-- Modal for managing horarios -->
<div class="modal fade" id="mdlGestionarHorario" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gray py-1">
                <h5 class="modal-title">Agregar/Modificar Horario</h5>
                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label for="selFisioterapeuta">Fisioterapeuta<span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" id="selFisioterapeuta" required>
                                </select>
                                <div class="invalid-feedback">Seleccione un fisioterapeuta</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label for="iptDiaSemana">Día<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptDiaSemana" placeholder="Día de la semana" required>
                                <div class="invalid-feedback">Ingrese el día de la semana</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label for="iptHoraInicio">Hora Inicio<span class="text-danger">*</span></label>
                                <input type="time" class="form-control form-control-sm" id="iptHoraInicio" required>
                                <div class="invalid-feedback">Ingrese la hora de inicio</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label for="iptHoraFin">Hora Fin<span class="text-danger">*</span></label>
                                <input type="time" class="form-control form-control-sm" id="iptHoraFin" required>
                                <div class="invalid-feedback">Ingrese la hora de fin</div>
                            </div>
                        </div>
                        <input type="hidden" id="iptIdHorario">
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;" data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2" id="btnGuardarHorario">Guardar Horario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>


<script>
    var accion;
    var table;

    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });

    $(document).ready(function() {
        // Load fisioterapeutas into the select
        $.ajax({
            url: "../ajax/mao.especialistas.ajax.php", 
            method: "POST",
            data: { accion: 1 }, 
            dataType: 'json',
            success: function(response) {
                let options = '<option value="">Seleccione Fisioterapeuta</option>';
                response.forEach(item => {
                    options += `<option value="${item.id_fisioterapeuta}">${item.nombre} ${item.apellido}</option>`;
                });
                $("#selFisioterapeuta").html(options);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching fisioterapeutas:", error);
                Toast.fire({ icon: 'error', title: 'Error al cargar la lista de fisioterapeutas' });
            }
        });

        table = $("#tbl_horarios").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    text: 'Agregar Horario',
                    className: 'addNewRecord',
                    action: function(e, dt, node, config) {
                        accion = 2;
                        $("#mdlGestionarHorario").modal('show');
                        $("#mdlGestionarHorario").find("form")[0].reset(); // Clear the form
                        $("#mdlGestionarHorario").find("form").removeClass("was-validated"); //remove validation styles
                        $("#iptIdHorario").val(""); 
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    title: 'Listado de Horarios'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    title: 'Listado de Horarios'
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    title: 'Listado de Horarios'
                },
                {
                    extend: 'pageLength',
                    text: 'Longitud de la página'
                }
            ],
            pageLength: [5, 10, 15, 30, 50],
            pageLength: 10,
            ajax: {
                url: "../ajax/mao.horarios.ajax.php",
                method: "POST",
                data: { accion: 1 },
                dataType: 'json',
                error: function(xhr, status, error) {
                    console.error("Error fetching horarios:", error);
                    Toast.fire({ icon: 'error', title: 'Error al cargar la lista de horarios' });
                }
            },
            columns: [{
                    data: null,
                    defaultContent: ''
                },
                { data: 'id_horario' },
                { data: 'nombre_fisioterapeuta' },
                { data: 'dia_semana' },
                { data: 'hora_inicio' },
                { data: 'hora_fin' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<center>
                                <button class="btn btn-warning btn-sm btnEditarHorario" data-id="${row.id_horario}"><i class="fas fa-pencil-alt"></i></button>
                                <button class="btn btn-danger btn-sm btnEliminarHorario" data-id="${row.id_horario}"><i class="fas fa-trash-alt"></i></button>
                            </center>`;
                    }
                }
            ],
            language: {
                url: "../vistas/assets/json/Spanish.json"
            }
        });

        $("#btnCancelarRegistro, #btnCerrarModal").click(function() {
            $("#mdlGestionarHorario").find("input, select").val("");
            $("#mdlGestionarHorario").find("form").removeClass("was-validated");
        });

        $('#tbl_horarios tbody').on('click', '.btnEditarHorario', function() {
            accion = 4;
            $("#mdlGestionarHorario").modal('show');
            let data = table.row($(this).parents('tr')).data();
            $("#iptIdHorario").val(data.id_horario);
            $("#selFisioterapeuta").val(data.id_fisioterapeuta);
            $("#iptDiaSemana").val(data.dia_semana);
            $("#iptHoraInicio").val(data.hora_inicio);
            $("#iptHoraFin").val(data.hora_fin);
        });

        $('#tbl_horarios tbody').on('click', '.btnEliminarHorario', function() {
            accion = 5;
            let data = table.row($(this).parents('tr')).data();
            let id_horario = data.id_horario;
            Swal.fire({
                title: '¿Está seguro de eliminar el horario?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "../ajax/mao.horarios.ajax.php",
                        method: "POST",
                        data: { accion: accion, id_horario: id_horario },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === "ok") {
                                Toast.fire({ icon: 'success', title: 'Horario eliminado correctamente' });
                                table.ajax.reload();
                            } else {
                                Toast.fire({ icon: 'error', title: 'Error al eliminar el horario' });
                            }
                        }
                    });
                }
            });
        });

        $("#btnGuardarHorario").click(function() {
            let form = $("#mdlGestionarHorario").find("form");
            if (form[0].checkValidity()) {
                let data = {
                    accion: accion,
                    id_fisioterapeuta: $("#selFisioterapeuta").val(),
                    dia_semana: $("#iptDiaSemana").val(),
                    hora_inicio: $("#iptHoraInicio").val(),
                    hora_fin: $("#iptHoraFin").val(),
                    id_horario: $("#iptIdHorario").val()
                };
                $.ajax({
                    url: "../ajax/mao.horarios.ajax.php",
                    method: "POST",
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === "ok") {
                            let message = (accion === 2) ? 'Horario registrado correctamente' : 'Horario actualizado correctamente';
                            Toast.fire({ icon: 'success', title: message });
                            table.ajax.reload();
                            $("#mdlGestionarHorario").modal('hide');
                        } else {
                            Toast.fire({ icon: 'error', title: response.message || 'Error al guardar el horario' });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error saving horario:", error);
                        Toast.fire({ icon: 'error', title: 'Error de servidor al guardar el horario' });
                    }
                });
            } else {
                form.addClass("was-validated");
            }
        });
    });
</script>
