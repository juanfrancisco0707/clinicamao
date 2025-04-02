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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> </script>
