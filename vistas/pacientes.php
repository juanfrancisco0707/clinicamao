<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../index.php');
}
?>

<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                

                <h1 class="m-0">Pacientes</h1>
                
                <p id="clinica" value='<?php echo $_SESSION['S_CLINICA']; ?>'></p>
                <input type="hidden" id="vclinica" name="vclinica" value='<?php echo $_SESSION['S_CLINICA']; ?>'/> 
                <input type="hidden" id="vrol" name="vrol" value='<?php echo $_SESSION['S_ROL']; ?>'/> 
                  
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Pacientes</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">

    <div class="container-fluid">

        
        <!-- row para listado de Pacientes -->
        <div class="row">
            <div class="col-lg-12">
                <table id="tbl_pacientes" class="table table-striped w-100 shadow">
                    <thead class="bg-info">
                        <tr style="font-size: 12px;">
                            <th></th>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Sexo</th>
                            <th>Nacimiento</th>
                            <th>Edad</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Estado Civil</th>
                            <th>Escolaridad</th>
                            <th>id_ocupación</th>
                            <th>Ocupación</th>
                            <th>id_nacionalidad</th>
                            <th>Nacionalidad</th>
                            <th>Comorbilidad</th>
                            <th>Estatus</th>
                            <th>fecha_creacion</th>
                            <th>id_empresa</th>
                            <th>Clínica</th> 
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

<!-- Sección para la Ficha del Paciente con Pestañas (Inicialmente oculta o se muestra al seleccionar un paciente) -->
<div class="container-fluid" id="seccionFichaPaciente" style="display: none; margin-top: 20px;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ficha del Paciente: <span id="nombrePacienteEnFicha"></span></h3>
            <input type="hidden" id="id_paciente_actual_ficha"> <!-- Para guardar el ID del paciente activo en la ficha -->
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="fichaPacienteTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="datos-generales-tab" data-toggle="tab" href="#datos-generales" role="tab" aria-controls="datos-generales" aria-selected="true">Datos Generales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="historial-clinico-tab-paciente" data-toggle="tab" href="#historial-clinico-paciente" role="tab" aria-controls="historial-clinico-paciente" aria-selected="false">Historial Clínico</a>
                </li>
                <!-- Puedes añadir más pestañas aquí, por ejemplo, Citas Anteriores, Pagos, etc. -->
            </ul>
            <div class="tab-content" id="fichaPacienteTabsContent">
                <div class="tab-pane fade show active" id="datos-generales" role="tabpanel" aria-labelledby="datos-generales-tab">
                    <div class="mt-3">
                        <!-- Aquí cargarías los datos generales del paciente (podría ser un formulario no editable o una vista de detalles) -->
                        <p>Información detallada del paciente se mostrará aquí...</p>
                        <button class="btn btn-sm btn-info" id="btnEditarPacienteDesdeFicha">Editar Datos del Paciente</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="historial-clinico-paciente" role="tabpanel" aria-labelledby="historial-clinico-tab-paciente">
                    <div class="mt-3">
                        <button class="btn btn-primary mb-3" id="btnAbrirModalNuevaEvolucion">
                            <i class="fas fa-plus"></i> Agregar Nueva Evolución
                        </button>
                        <div id="contenedorHistorialClinico">
                            <!-- El historial se cargará aquí mediante AJAX -->
                            <p>Cargando historial clínico...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ventana Modal para ingresar o modificar un Paciente -->
<!-- Ventana Modal para ingresar o modificar un Paciente -->
<div class="modal fade" id="mdlGestionarPacientes" tabindex="-1" role="dialog" aria-labelledby="modalPacienteLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">

    <!-- contenido del modal -->
    <div class="modal-content">

      <!-- cabecera del modal -->
      <div class="modal-header bg-indigo py-1">
        <h5 class="modal-title" id="modalPacienteLabel">Agregar Paciente</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="btnCerrarModal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- cuerpo del modal -->
      <div class="modal-body">
        <form class="needs-validation" novalidate>
          <div class="row">

            <!-- Identificador -->
            <div class="col-12 col-lg-6">
              <div class="form-group mb-2">
                <label for="iptIdReg">
                  <i class="fas fa-barcode fs-6"></i>
                  <span class="small">Identificador</span><span class="text-danger">*</span>
                </label>
                <input type="number" class="form-control form-control-sm" id="iptIdReg" name="iptId" placeholder="Identificador" disabled>
                <div class="invalid-feedback">Debe ingresar el Identificador del Paciente</div>
              </div>
            </div>

            <!-- Nombre -->
            <div class="col-12">
              <div class="form-group mb-2">
                <label for="iptNombreReg"><i class="fas fa-file-signature fs-6"></i> <span class="small">Nombre</span><span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" id="iptNombreReg" placeholder="Nombre" required>
                <div class="invalid-feedback">Debe ingresar el nombre</div>
              </div>
            </div>

            <!-- Sexo -->
            <div class="col-12 col-lg-4">
              <div class="form-group mb-2">
                <label for="iptSexoReg"><i class="fa fa-venus-mars"></i> <span class="small">Sexo</span><span class="text-danger">*</span></label>
                <select name="sexo" class="form-control form-control-sm" id="iptSexoReg" required>
                  <option>Masculino</option>
                  <option>Femenino</option>
                  <option>Otro</option>
                </select>
                <div class="invalid-feedback">Debe ingresar el Sexo</div>
              </div>
            </div>

            <!-- Fecha de nacimiento -->
            <div class="col-12 col-lg-4">
              <div class="form-group mb-2">
                <label for="iptFecha_NacimientoReg"><i class="fa fa-calendar"></i> <span class="small">Fecha de Nacimiento</span><span class="text-danger">*</span></label>
                <input type="date" class="form-control form-control-sm" id="iptFecha_NacimientoReg" required>
                <div class="invalid-feedback">Debe ingresar Fecha de Nacimiento</div>
              </div>
            </div>

            <!-- Edad -->
            <div class="col-12 col-lg-4">
              <div class="form-group mb-2">
                <label for="iptEdadReg"> <span class="small">Edad</span></label>
                <input type="number" min="0" class="form-control form-control-sm" id="iptEdadReg" placeholder="Edad" disabled>
              </div>
            </div>

            <!-- Dirección -->
            <div class="col-12 col-lg-6">
              <div class="form-group mb-2">
                <label for="iptDireccionReg"><i class="fa fa-address-card"></i> <span class="small">Dirección</span><span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" id="iptDireccionReg" placeholder="Dirección" required>
                <div class="invalid-feedback">Debe ingresar la Dirección</div>
              </div>
            </div>

            <!-- Teléfono -->
            <div class="col-12 col-lg-6">
              <div class="form-group mb-2">
                <label for="iptTelefonoReg"><i class="fa fa-phone"></i> <span class="small">Teléfono</span><span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" id="iptTelefonoReg" placeholder="Teléfono" required>
                <div class="invalid-feedback">Debe ingresar el teléfono</div>
              </div>
            </div>

            <!-- Correo -->
            <div class="col-12 col-lg-6">
              <div class="form-group mb-2">
                <label for="iptCorreoReg"><i class="fa fa-envelope"></i> <span class="small">Correo</span><span class="text-danger">*</span></label>
                <input type="email" class="form-control form-control-sm" id="iptCorreoReg" placeholder="Correo" required>
                <div class="invalid-feedback">Debe ingresar el Correo electrónico</div>
              </div>
            </div>

            <!-- Estado Civil -->
            <div class="col-12 col-lg-4">
              <div class="form-group mb-2">
                <label for="iptEstado_CivilReg"><i class="fas fa-minus-circle fs-6"></i> <span class="small">Estado Civil</span><span class="text-danger">*</span></label>
                <select name="estadocivil" class="form-control form-control-sm" id="iptEstado_CivilReg" required>
                  <option>Casado(a)</option>
                  <option>Unión Libre</option>
                  <option>Anulado(a)</option>
                  <option>Separado(a)</option>
                  <option>Viudo(a)</option>
                  <option>Soltero(a)</option>
                </select>
                <div class="invalid-feedback">Debe ingresar el Estado Civil</div>
              </div>
            </div>

            <!-- Escolaridad -->
            <div class="col-12 col-lg-2">
              <div class="form-group mb-2">
                <label for="iptEscolaridadReg"><i class="fa fa-graduation-cap"></i> <span class="small">Escolaridad</span><span class="text-danger">*</span></label>
                <select name="escolaridad" class="form-control form-control-sm" id="iptEscolaridadReg" required>
                  <option>Primaria</option>
                  <option>Secundaria</option>
                  <option>Preparatoria</option>
                  <option>Licenciatura</option>
                  <option>Maestría</option>
                  <option>Doctorado</option>
                  <option>Sin Estudio</option>
                </select>
                <div class="invalid-feedback">Debe ingresar la Escolaridad</div>
              </div>
            </div>

            <!-- Ocupación -->
            <div class="col-12 col-lg-6">
              <div class="form-group mb-2">
                <label for="selOcupacionReg"><i class="fas fa-dumpster"></i> <span class="small">Ocupación</span><span class="text-danger">*</span></label>
                <select class="form-control form-control-sm" id="selOcupacionReg" required></select>
                <div class="invalid-feedback">Seleccione la ocupación</div>
              </div>
            </div>

            <!-- Nacionalidad -->
            <div class="col-12 col-lg-6">
              <div class="form-group mb-2">
                <label for="selNacionalidadReg"><i class="fa fa-flag-checkered"></i> <span class="small">Nacionalidad</span><span class="text-danger">*</span></label>
                <select class="form-control form-control-sm" id="selNacionalidadReg" required></select>
                <div class="invalid-feedback">Seleccione la Nacionalidad</div>
              </div>
            </div>

            <!-- Clínica -->
            <div class="col-12 col-lg-6">
              <div class="form-group mb-2">
                <label for="selEmpresaReg"><i class="fa fa-medkit"></i> <span class="small">Clínica</span><span class="text-danger">*</span></label>
                <select class="form-control form-control-sm" id="selEmpresaReg" required></select>
                <div class="invalid-feedback">Seleccione la Clínica</div>
              </div>
            </div>

            <!-- Comorbilidad -->
            <div class="col-12 col-lg-6">
              <div class="form-group mb-2">
                <label for="iptComorbilidadReg"><i class="fa fa-bed"></i> <span class="small">Comorbilidad</span><span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" id="iptComorbilidadReg" placeholder="Comorbilidad" required>
                <div class="invalid-feedback">Debe ingresar la Comorbilidad</div>
              </div>
            </div>

            <!-- Estatus -->
            <div class="col-12 col-lg-6">
              <div class="form-group mb-2">
                <label for="iptEstatusReg"><i class="fas fa-minus-circle"></i> <span class="small">Estatus</span><span class="text-danger">*</span></label>
                <select name="estatus" class="form-control form-control-sm" id="iptEstatusReg" required>
                  <option>Activo</option>
                  <option>Baja</option>
                </select>
                <div class="invalid-feedback">Debe seleccionar el estatus</div>
              </div>
            </div>

            <!-- Botones -->
            <div class="col-12 text-center mt-3">
              <button type="button" class="btn btn-danger mx-2" data-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
              <button type="button" class="btn btn-primary mx-2" id="btnGuardarPaciente">Guardar Paciente</button>
            </div>

          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- Fin de Modal -->


<!-- /. Fin de Ventana Modal para ingreso de Pacientes -->
                            
<!-- Ventana Modal para modificar un Paciente -->
<div class="modal fade" id="mdlGestionarPacientesm" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <!-- CABECERA -->
            <div class="modal-header bg-indigo py-1">
                <h5 class="modal-title">Modificar Paciente</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="btnCerrarModalm">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- CUERPO -->
            <div class="modal-body">
                <form class="needs-validation" novalidate>
                    <div class="row">

                        <!-- ID -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label for="iptIdRegm"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Identificador</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptIdRegm" name="iptIdm" placeholder="Identificador" disabled>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <!-- NOMBRE -->
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label for="iptNombreRegm"><i class="fas fa-file-signature fs-6"></i>
                                    <span class="small">Nombre</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptNombreRegm" placeholder="Nombre" required>
                                <div class="invalid-feedback">Debe ingresar el nombre</div>
                            </div>
                        </div>

                        <!-- SEXO -->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label for="iptSexoRegm"><i class="fa fa-venus-mars"></i> <span class="small">Sexo</span><span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" id="iptSexoRegm" required>
                                    <option>Masculino</option>
                                    <option>Femenino</option>
                                    <option>Otro</option>
                                </select>
                                <div class="invalid-feedback">Debe ingresar el Sexo</div>
                            </div>
                        </div>

                        <!-- FECHA NACIMIENTO -->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label for="iptFecha_NacimientoRegm"><i class="fa fa-calendar"></i> <span class="small">Fecha de Nacimiento</span><span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="iptFecha_NacimientoRegm" required>
                                <div class="invalid-feedback">Debe ingresar Fecha de Nacimiento</div>
                            </div>
                        </div>

                        <!-- EDAD -->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label for="iptEdadRegm"><span class="small">Edad</span></label>
                                <input type="number" min="0" class="form-control form-control-sm" id="iptEdadRegm" placeholder="Edad" disabled>
                            </div>
                        </div>

                        <!-- DIRECCIÓN -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label for="iptDireccionRegm"><i class="fa fa-address-card"></i> <span class="small">Dirección</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptDireccionRegm" placeholder="Dirección" required>
                                <div class="invalid-feedback">Debe ingresar la Dirección</div>
                            </div>
                        </div>

                        <!-- TELÉFONO -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label for="iptTelefonoRegm"><i class="fa fa-phone"></i> <span class="small">Teléfono</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptTelefonoRegm" placeholder="Teléfono" required>
                                <div class="invalid-feedback">Debe ingresar el teléfono</div>
                            </div>
                        </div>

                         <!-- Correo -->
                        <div class="col-12 col-lg-6">
                        <div class="form-group mb-2">
                            <label for="iptCorreoRegm"><i class="fa fa-envelope"></i> <span class="small">Correo</span><span class="text-danger">*</span></label>
                            <input type="email" class="form-control form-control-sm" id="iptCorreoRegm" placeholder="Correo" required>
                            <div class="invalid-feedback">Debe ingresar el Correo electrónico</div>
                        </div>
                        </div>

                        <!-- ESTADO CIVIL -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label for="iptEstado_CivilRegm"><i class="fas fa-minus-circle"></i> <span class="small">Estado Civil</span><span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" id="iptEstado_CivilRegm" required>
                                    <option>Casado(a)</option>
                                    <option>Unión Libre</option>
                                    <option>Anulado(a)</option>
                                    <option>Separado(a)</option>
                                    <option>Viudo(a)</option>
                                    <option>Soltero(a)</option>
                                </select>
                                <div class="invalid-feedback">Debe ingresar el Estado Civil</div>
                            </div>
                        </div>

                        <!-- ESCOLARIDAD -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label for="iptEscolaridadRegm"><i class="fas fa-minus-circle"></i> <span class="small">Escolaridad</span><span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" id="iptEscolaridadRegm" required>
                                    <option>Primaria</option>
                                    <option>Secundaria</option>
                                    <option>Preparatoria</option>
                                    <option>Licenciatura</option>
                                    <option>Maestría</option>
                                    <option>Doctorado</option>
                                    <option>Sin Estudio</option>
                                </select>
                                <div class="invalid-feedback">Debe ingresar la Escolaridad</div>
                            </div>
                        </div>

                        <!-- OCUPACIÓN -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label for="selOcupacionRegm"><i class="fas fa-dumpster"></i> <span class="small">Ocupación</span><span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" id="selOcupacionRegm" required></select>
                                <div class="invalid-feedback">Seleccione la ocupación</div>
                            </div>
                        </div>

                        <!-- NACIONALIDAD -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label for="selNacionalidadRegm"><i class="fa fa-flag-checkered"></i> <span class="small">Nacionalidad</span><span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" id="selNacionalidadRegm" required></select>
                                <div class="invalid-feedback">Seleccione la Nacionalidad</div>
                            </div>
                        </div>

                        <!-- CLÍNICA -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label for="selEmpresaRegm"><i class="fa fa-medkit"></i> <span class="small">Clínica</span><span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" id="selEmpresaRegm" required></select>
                                <div class="invalid-feedback">Seleccione la Clínica</div>
                            </div>
                        </div>

                        <!-- COMORBILIDAD -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label for="iptComorbilidadRegm"><i class="fa fa-bed"></i> <span class="small">Comorbilidad</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptComorbilidadRegm" placeholder="Comorbilidad" required>
                                <div class="invalid-feedback">Debe ingresar la Comorbilidad</div>
                            </div>
                        </div>

                        <!-- ESTATUS -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label for="iptEstatusRegm"><i class="fas fa-minus-circle"></i> <span class="small">Estatus</span><span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" id="iptEstatusRegm" required>
                                    <option>Activo</option>
                                    <option>Baja</option>
                                </select>
                                <div class="invalid-feedback">Debe seleccionar el estatus</div>
                            </div>
                        </div>

                        <!-- BOTONES -->
                        <div class="col-12 text-center mt-3">
                            <button type="button" class="btn btn-danger mx-2" style="width:170px;" data-dismiss="modal" id="btnCancelarRegistrom">Cancelar</button>
                            <button type="button" class="btn btn-primary mx-2" style="width:170px;" id="btnGuardarPacientem">Guardar Paciente</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- /. Fin de Ventana Modal para modificar a Pacientes name="id_historial_form -->
<!-- Modal para Registrar/Editar Historial Clínico -->
<div class="modal fade" id="modalHistorialClinico" tabindex="-1" role="dialog" aria-labelledby="modalHistorialClinicoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHistorialClinicoLabel">Registrar Evolución Clínica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formHistorialClinico"> 
                    <input type="hidden" id="id_historial_form" name="id_historial_form" value="">

                    <div class="form-group">
                        <label for="id_sesion_historial">Sesión Asociada <span class="text-danger">*</span></label>
                        <select class="form-control" id="id_sesion_historial" name="id_sesion_historial" required>
                            <!-- Opciones se cargarán dinámicamente -->
                        </select>
                        <small class="form-text text-muted">Seleccione la sesión a la que corresponde esta evolución.</small>
                    </div>

                    <div class="form-group">
                        <label for="fecha_evaluacion_historial">Fecha de Evaluación <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="fecha_evaluacion_historial" name="fecha_evaluacion_historial" required>
                    </div>

                    <div class="form-group">
                        <label for="subjetivo_historial">Subjetivo (S.O.A.P.)</label>
                        <textarea class="form-control" id="subjetivo_historial" name="subjetivo_historial" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="objetivo_historial">Objetivo (S.O.A.P.)</label>
                        <textarea class="form-control" id="objetivo_historial" name="objetivo_historial" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="diagnostico_historial">Diagnóstico Fisioterapéutico</label>
                        <select class="form-control" id="diagnostico_historial" name="diagnostico_historial">
                            <option value="">Seleccione un diagnóstico...</option>
                            <!-- Opciones se cargarán dinámicamente -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="plan_tratamiento_historial">Plan de Tratamiento / Intervención en Sesión</label>
                        <textarea class="form-control" id="plan_tratamiento_historial" name="plan_tratamiento_historial" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="evolucion_historial">Evolución / Análisis (S.O.A.P.)</label>
                        <textarea class="form-control" id="evolucion_historial" name="evolucion_historial" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="objetivos_corto_historial">Objetivos a Corto Plazo</label>
                        <textarea class="form-control" id="objetivos_corto_historial" name="objetivos_corto_historial" rows="2"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="objetivos_largo_historial">Objetivos a Largo Plazo</label>
                        <textarea class="form-control" id="objetivos_largo_historial" name="objetivos_largo_historial" rows="2"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="recomendaciones_historial">Recomendaciones Domiciliarias / Plan (S.O.A.P.)</label>
                        <textarea class="form-control" id="recomendaciones_historial" name="recomendaciones_historial" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="proxima_cita_historial">Próxima Cita Sugerida</label>
                        <input type="date" class="form-control" id="proxima_cita_historial" name="proxima_cita_historial">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarHistorialClinico">Guardar Evolución</button>
            </div>
        </div>
    </div>
</div>


<script>
var accion;
var table;
var fecha;
var clinicaf;
var vroles;
//var sesion = $_SESSION['S_ROL'];
//var clinica;//= $('#clinica').val();

/*===================================================================*/
//INICIALIZAMOS EL MENSAJE DE TIPO TOAST (EMERGENTE EN LA PARTE SUPERIOR)
/*===================================================================*/
var Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000
});
//$(function () {    
  //  clinica = $('#clinica').val();
  //  console.log(clinica);   
//});

$(document).ready(function() {
        /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON VER FICHA DEL PACIENTE
    =========================================================================================*/
    $('#tbl_pacientes tbody').on('click', '.btnVerFichaPaciente', function() {
        var idPaciente = $(this).data('id-paciente');
        var nombrePaciente = $(this).data('nombre-paciente');

        // Llenar los campos de la ficha
        $('#id_paciente_actual_ficha').val(idPaciente);
        $('#nombrePacienteEnFicha').text(nombrePaciente);

        // Aquí deberías cargar los datos generales del paciente en la pestaña "Datos Generales"
        // Por ejemplo, haciendo una llamada AJAX para obtener los detalles del paciente
        // y luego poblando los campos correspondientes dentro de la pestaña #datos-generales.
        // Por ahora, solo mostraremos un mensaje:
        $('#datos-generales .mt-3').html('<p>Cargando datos generales del paciente ' + nombrePaciente + '...</p>' +
                                         '<button class="btn btn-sm btn-info" id="btnEditarPacienteDesdeFicha">Editar Datos del Paciente</button>');
        
        // Simulación de carga de datos (reemplaza con tu lógica AJAX real)
        setTimeout(function() {
            // Suponiendo que tienes una función para cargar los datos del paciente en el formulario de edición
            // o directamente en elementos de texto dentro de la pestaña de datos generales.
            // Ejemplo:
            // $('#campoNombreFicha').text(nombrePaciente);
            // $('#campoEdadFicha').text(edadDelPaciente); // etc.
            // Por ahora, solo un mensaje:
             $('#datos-generales .mt-3').html('<p>Mostrando datos generales de ' + nombrePaciente + '. Implementa la carga de datos aquí.</p>' +
                                         '<button class="btn btn-sm btn-info" id="btnEditarPacienteDesdeFicha">Editar Datos del Paciente</button>');
        }, 500);


        // Mostrar la sección de la ficha del paciente
        $('#seccionFichaPaciente').show();

        // Activar la primera pestaña (Datos Generales) por defecto
        $('#fichaPacienteTabs a[href="#datos-generales"]').tab('show');
        
        // Ocultar la tabla de listado de pacientes (opcional, para dar más foco a la ficha)
        // $('.row:has(#tbl_pacientes)').hide(); // Opcional

        // Si la pestaña de historial clínico ya está activa o se activa, cargar su contenido
        if ($('#historial-clinico-tab-paciente').hasClass('active')) {
            cargarHistorialClinico(idPaciente); // Asegúrate que esta función exista y esté definida
        }
    });

    // Manejar el clic en la pestaña de Historial Clínico para cargar los datos
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        if (e.target.id === "historial-clinico-tab-paciente") {
            var idPacienteActual = $("#id_paciente_actual_ficha").val();
            if (idPacienteActual) {
                cargarHistorialClinico(idPacienteActual); // Asegúrate que esta función exista
            }
        }
    });

    // (Opcional) Botón para volver al listado de pacientes desde la ficha
    // Podrías añadir un botón "Volver al Listado" en la #seccionFichaPaciente
    // y manejar su clic para ocultar la ficha y mostrar la tabla de nuevo.
    // Ejemplo:
    // $('#btnVolverAlListado').on('click', function() {
    //     $('#seccionFichaPaciente').hide();
    //     $('.row:has(#tbl_pacientes)').show();
    // });

    // Botón para editar paciente desde la ficha (ejemplo de cómo abrir el modal de edición)
    $(document).on('click', '#btnEditarPacienteDesdeFicha', function() {
        var idPaciente = $('#id_paciente_actual_ficha').val();
        // Aquí simulas el clic en el botón de editar de la tabla para reutilizar tu lógica existente
        // o llamas directamente a una función que cargue los datos en el modal de edición.
        
        // Opción 1: Simular clic (si tienes un botón de editar en la tabla con una clase específica)
        // $('#tbl_pacientes tbody tr').find('.btnEditarPaciente[data-id="' + idPaciente + '"]').click(); 
        // Necesitarías añadir data-id al botón de editar en la tabla.

        // Opción 2: Llamar a una función que cargue datos y muestre el modal de edición
        // Esta es más limpia si no quieres depender de la estructura de la tabla.
        cargarYMostrarModalEdicionPaciente(idPaciente);
    });

    function cargarYMostrarModalEdicionPaciente(idPaciente) {
        // 1. Hacer una llamada AJAX para obtener los datos del paciente por su ID
        // (similar a como lo harías al editar desde la tabla)
        // 2. Poblar los campos del modal #mdlGestionarPacientesm con los datos recibidos
        // 3. Mostrar el modal: $('#mdlGestionarPacientesm').modal('show');
        
        // Ejemplo simplificado (debes implementar la carga de datos real):
        console.log("Abrir modal de edición para paciente ID:", idPaciente);
        // Aquí iría tu lógica para obtener datos del paciente y poblar el modal #mdlGestionarPacientesm
        // Por ejemplo:
        $.ajax({
            url: '../ajax/pacientes.ajax.php', // Ajusta la URL y la acción
            type: 'POST',
            data: { accion: 'obtenerPacientePorId', id_paciente: idPaciente }, // Necesitarás esta acción en tu AJAX
            dataType: 'json',
            success: function(paciente) {
                if(paciente){
                    $("#iptIdRegm").val(paciente.id); // Asegúrate que las claves coincidan
                    $("#iptNombreRegm").val(paciente.nombre);
                    $("#iptSexoRegm").val(paciente.sexo);
                    $("#iptFecha_NacimientoRegm").val(paciente.fecha_nacimiento);
                    $("#iptEdadRegm").val(paciente.edad); // Si la edad se calcula, puede que no venga aquí
                    $("#iptDireccionRegm").val(paciente.direccion);
                    $("#iptTelefonoRegm").val(paciente.telefono);
                    $("#iptCorreoRegm").val(paciente.correo);
                    $("#iptEstado_CivilRegm").val(paciente.estado_civil);
                    $("#iptEscolaridadRegm").val(paciente.escolaridad);
                    $("#selOcupacionRegm").val(paciente.id_ocupacion);
                    $("#selNacionalidadRegm").val(paciente.id_nacionalidad);
                    $("#iptComorbilidadRegm").val(paciente.comorbilidad);
                    $("#iptEstatusRegm").val(paciente.estatus);
                    $("#selEmpresaRegm").val(paciente.id_empresa);
                    
                    $('#mdlGestionarPacientesm').modal('show');
                    accion = 4; // Indicar que es una acción de edición
                } else {
                    Swal.fire('Error', 'No se pudieron obtener los datos del paciente para editar.', 'error');
                }
            },
            error: function(){
                Swal.fire('Error', 'Problema al obtener datos del paciente.', 'error');
            }
        });
    }

    // Asegúrate que la función cargarHistorialClinico esté definida
    // (debería estar en el script que te proporcioné anteriormente para el historial)
    // function cargarHistorialClinico(idPaciente) { ... }

     // Asume que tienes el ID del paciente actual en un input oculto o variable JS
    const idPacienteActual = $("#id_paciente_actual_ficha").val(); // Ajusta este selector

    // Función para cargar el historial clínico del paciente
    function cargarHistorialClinico(idPaciente) {
        $("#contenedorHistorialClinico").html('<p>Cargando historial clínico...</p>');
        $.ajax({
            url: '../ajax/historialclinico.ajax.php', // Ajusta la ruta
            type: 'POST',
            data: {
                accionHistorial: 'mostrarPorPaciente',
                id_paciente: idPaciente
            },
            dataType: 'json',
            success: function(historial) {
                let htmlHistorial = '<ul class="list-group">';
                if (historial && historial.length > 0) {
                    historial.forEach(function(entrada) {
                        htmlHistorial += `
                            <li class="list-group-item">
                                <h5>Evaluación del: ${new Date(entrada.fecha_evaluacion).toLocaleString()} (Sesión: ${new Date(entrada.fecha_hora_sesion).toLocaleDateString()})</h5>
                                <p><strong>Diagnóstico:</strong> ${entrada.nombre_diagnostico || 'No especificado'}</p>
                                <p><strong>Subjetivo:</strong> ${entrada.subjetivo || 'N/A'}</p>
                                <p><strong>Objetivo:</strong> ${entrada.objetivo || 'N/A'}</p>
                                <p><strong>Evolución:</strong> ${entrada.evolucion_notas || 'N/A'}</p>
                                <p><strong>Plan en sesión:</strong> ${entrada.plan_tratamiento_sesion || 'N/A'}</p>
                                <button class="btn btn-sm btn-info btnVerDetalleHistorial" data-idhistorial="${entrada.id_historial}">Ver/Editar</button>
                                <button class="btn btn-sm btn-danger btnEliminarHistorial" data-idhistorial="${entrada.id_historial}">Eliminar</button>
                            </li>`;
                    });
                } else {
                    htmlHistorial += '<li class="list-group-item">No hay entradas en el historial clínico para este paciente.</li>';
                }
                htmlHistorial += '</ul>';
                $("#contenedorHistorialClinico").html(htmlHistorial);
            },
            error: function() {
                $("#contenedorHistorialClinico").html('<p class="text-danger">Error al cargar el historial clínico.</p>');
            }
        });
    }

    // Cargar el historial cuando se muestra la pestaña
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        if (e.target.id === "historial-clinico-tab" && idPacienteActual) {
            cargarHistorialClinico(idPacienteActual);
        }
    });

    // Si la pestaña de historial es la activa por defecto al cargar la página
    if ($("#historial-clinico-tab").hasClass('active') && idPacienteActual) {
         cargarHistorialClinico(idPacienteActual);
    }


    // Función para cargar el select de sesiones sin historial
    //function cargarSesionesParaHistorial(idPaciente, idSesionSeleccionada = null) {
    function cargarSesionesParaHistorial(idPaciente, idSesionActualEdicion = null, callback) {
        $.ajax({
            url: '../ajax/historialclinico.ajax.php',
            type: 'POST',
            data: {
                accionHistorial: 'obtenerSesionesSinHistorial',
                id_paciente_sesiones: idPaciente
            },
            dataType: 'json',
            success: function(sesiones) {
                let options = '<option value="">Seleccione una sesión...</option>';
                if (sesiones && sesiones.length > 0) {
                    sesiones.forEach(function(sesion) {
                        options += `<option value="${sesion.id_sesion}" ${idSesionActualEdicion  == sesion.id_sesion ? 'selected' : ''}>
                                        ${new Date(sesion.fecha_hora).toLocaleString()} - ${sesion.nombre_servicio || 'Servicio no especificado'}
                                    </option>`;
                    });
                }
                 /* Si estamos editando y la sesión ya tiene historial, la añadimos manualmente si no está en la lista
                if (idSesionSeleccionada && !sesiones.find(s => s.id_sesion == idSesionSeleccionada)) {
                    // Necesitaríamos una forma de obtener los detalles de esta sesión específica si no está en la lista
                    // Por ahora, si se está editando, el id_sesion ya vendrá y se seleccionará si existe.
                    // Si la sesión ya tiene historial, no aparecerá en "sesiones sin historial".
                    // Para edición, el select de sesión debería estar deshabilitado o mostrar la sesión actual.
                    // Aquí simplificaremos: si es edición, el select se poblará y se seleccionará el valor.
                }*/
                 // Si estamos editando y la sesión actual no está en la lista de "sesiones sin historial",
                // la obtenemos y la añadimos.
                if (idSesionActualEdicion && (!sesiones || !sesiones.find(s => s.id_sesion == idSesionActualEdicion))) {
                    $.ajax({
                        url: '../ajax/historialclinico.ajax.php',
                        type: 'POST',
                        data: {
                            accionHistorial: 'obtenerDetallesSesionPorId',
                            id_sesion_detalle: idSesionActualEdicion
                        },
                        dataType: 'json',
                        success: function(sesionActual) {
                            if (sesionActual) {
                                options = `<option value="${sesionActual.id_sesion}" selected>
                                                ${new Date(sesionActual.fecha_hora).toLocaleString()} - ${sesionActual.nombre_servicio || 'Servicio no especificado'} (Sesión actual)
                                           </option>` + options.replace('<option value="">Seleccione una sesión...</option>', ''); // Evitar duplicar el placeholder
                            }
                            $("#id_sesion_historial").html(options);
                            if (callback) callback();
                        }
                    });
                } else {
                    $("#id_sesion_historial").html(options);
                    if (idSesionActualEdicion) {
                        $("#id_sesion_historial").val(idSesionActualEdicion);
                    }
                    if (callback) callback();
                }
                /*
                $("#id_sesion_historial").html(options);
                 if (idSesionSeleccionada) { // Asegurar que se seleccione si viene de una edición
                    $("#id_sesion_historial").val(idSesionSeleccionada);
                }*/
            },
            error: function() {
                $("#id_sesion_historial").html('<option value="">Error al cargar sesiones</option>');
            }
        });
    }

    // Función para cargar el catálogo de diagnósticos
    function cargarCatalogoDiagnosticos(idDiagnosticoSeleccionado = null) {
        $.ajax({
            url: '../ajax/historialclinico.ajax.php',
            type: 'POST',
            data: { accionHistorial: 'obtenerCatalogoDiagnosticos' },
            dataType: 'json',
            success: function(diagnosticos) {
                let options = '<option value="">Seleccione un diagnóstico...</option>';
                if (diagnosticos && diagnosticos.length > 0) {
                    diagnosticos.forEach(function(diag) {
                        options += `<option value="${diag.id_diagnostico}" ${idDiagnosticoSeleccionado == diag.id_diagnostico ? 'selected' : ''}>
                                        ${diag.codigo_estandar ? diag.codigo_estandar + ' - ' : ''}${diag.nombre_diagnostico}
                                    </option>`;
                    });
                }
                $("#diagnostico_historial").html(options);
                if (idDiagnosticoSeleccionado) {
                    $("#diagnostico_historial").val(idDiagnosticoSeleccionado);
                }
            }
        });
    }


    // Abrir modal para NUEVA evolución
    $("#btnAbrirModalNuevaEvolucion").on("click", function() {
      /*  if (!idPacienteActual) {
            Swal.fire("Error", "No se ha identificado un paciente.", "error");
            return;
        }*/
       var idPacienteActual = $("#id_paciente_actual_ficha").val();
        // Opción 1: Detener con un alert y ver el valor
       // alert("El idPacienteActual es: " + idPacienteActucontenedorHistorialClinicoal + ". La ejecución se detendrá aquí.");
        // Si quieres que la ejecución NO continúe después del alert, puedes añadir un return:
        // return; 
         const idPacienteFicha = $("#id_paciente_actual_ficha").val();
        $("#formHistorialClinico")[0].reset();
        $("#id_historial_form").val(""); // Limpiar ID para nuevo registro
        $("#modalHistorialClinicoLabel").text("Registrar Nueva Evolución Clínica");
        $("#id_sesion_historial").prop("disabled", false); // Habilitar select de sesión
        
        // alert("antes de cargar sesiones");
        //cargarSesionesParaHistorial(idPacienteActual); // Cargar sesiones disponibles
        cargarSesionesParaHistorial(idPacienteFicha); // Cargar sesiones disponibles
        cargarCatalogoDiagnosticos(); // Cargar diagnósticos
        
        // Poner fecha y hora actual por defecto
        const now = new Date();
        const year = now.getFullYear();
        const month = (now.getMonth() + 1).toString().padStart(2, '0');
        const day = now.getDate().toString().padStart(2, '0');
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        $("#fecha_evaluacion_historial").val(`${year}-${month}-${day}T${hours}:${minutes}`);
       
        $("#modalHistorialClinico").modal("show");
    });

    // Abrir modal para EDITAR/VER evolución (delegado)
    $("#contenedorHistorialClinico").on("click", ".btnVerDetalleHistorial", function() {
        const idHistorial = $(this).data("idhistorial");
         const idPacienteFicha = $("#id_paciente_actual_ficha").val();
        $("#formHistorialClinico")[0].reset();
        $("#modalHistorialClinicoLabel").text("Editar Evolución Clínica");

        $.ajax({
            url: '../ajax/historialclinico.ajax.php',
            type: 'POST',
            data: {
                accionHistorial: 'obtenerPorId',
                id_historial_editar: idHistorial
            },
            dataType: 'json',
            success: function(data) {
                if (data) {
                    $("#id_historial_form").val(data.id_historial);
                    
                    // Cargar y seleccionar la sesión. Para edición, la sesión no debería cambiar.
                    // Podrías deshabilitar el select o cargarlo con la sesión actual.
                    // Aquí lo cargaremos y seleccionaremos, pero idealmente se deshabilita.
                   // cargarSesionesParaHistorial(idPacienteActual, data.id_sesion); 
                   // $("#id_sesion_historial").val(data.id_sesion).prop("disabled", true); // Deshabilitar para edición
                    // Cargar sesiones, asegurando que la sesión actual esté y se seleccione.
                    // El select permanecerá habilitado para permitir cambios.
                    cargarSesionesParaHistorial(idPacienteFicha, data.id_sesion, function() {
                        $("#id_sesion_historial").val(data.id_sesion).prop("disabled", false); 
                    }); 
                    let fechaEval = data.fecha_evaluacion.replace(' ', 'T').substring(0, 16);
                    $("#fecha_evaluacion_historial").val(fechaEval);
                    $("#subjetivo_historial").val(data.subjetivo);
                    $("#objetivo_historial").val(data.objetivo);
                    
                    cargarCatalogoDiagnosticos(data.id_diagnostico); // Cargar y seleccionar diagnóstico
                    
                    $("#plan_tratamiento_historial").val(data.plan_tratamiento_sesion);
                    $("#objetivos_corto_historial").val(data.objetivos_corto_plazo);
                    $("#objetivos_largo_historial").val(data.objetivos_largo_plazo);
                    $("#recomendaciones_historial").val(data.recomendaciones_domiciliarias);
                    $("#evolucion_historial").val(data.evolucion_notas);
                    $("#proxima_cita_historial").val(data.proxima_cita_sugerida);
                    
                    $("#modalHistorialClinico").modal("show");
                } else {
                    Swal.fire("Error", "No se pudieron obtener los datos de la evolución.", "error");
                }
            },
            error: function() {
                 Swal.fire("Error", "Ocurrió un problema al cargar la evolución.", "error");
            }
        });
    });

    // Guardar (Registrar o Editar) Historial Clínico
    $("#btnGuardarHistorialClinico").on("click", function() {
        
        // Validación simple del lado del cliente (puedes mejorarla)
        if (!$("#id_sesion_historial").val() || !$("#fecha_evaluacion_historial").val()) {
            Swal.fire("Atención", "La sesión asociada y la fecha de evaluación son obligatorias.", "warning");
            return;
        }
        
        const idHistorial = $("#id_historial_form").val();
        const accion = idHistorial ? "editar" : "registrar";
        let formData = $("#formHistorialClinico").serializeArray(); // Obtiene datos del form
        formData.push({name: "accionHistorial", value: accion});
        // El id_historial_form ya está en el serialize si tiene valor.
        // El id_sesion_historial también.
        // Los nombres de los campos en el form deben coincidir con los esperados por el controlador.
        // Ejemplo: name="subjetivo_historial" en el textarea.

        // Convertir serializeArray a un objeto para facilitar el acceso
        let dataToSend = {};
        formData.forEach(item => {
            dataToSend[item.name] = item.value;
        });
        // Asegurar que el id_sesion se envíe correctamente si estaba deshabilitado
        if (accion === "editar") {
            dataToSend["id_sesion_historial"] = $("#id_sesion_historial").val();
        }


        $.ajax({
            url: '../ajax/historialclinico.ajax.php',
            type: 'POST',
            data: dataToSend,
            dataType: 'json',
            success: function(response) {
                if (response.status === "ok") {
                    Swal.fire("¡Guardado!", `La evolución clínica ha sido ${accion === 'registrar' ? 'registrada' : 'actualizada'}.`, "success");
                    $("#modalHistorialClinico").modal("hide");
                    if (idPacienteFicha) { // Usar el id de la ficha
                        cargarHistorialClinico(idPacienteFicha); // Recargar la lista
                    //if (idPacienteActual) {
                    //    cargarHistorialClinico(idPacienteActual); // Recargar la lista
                    }
                } else {
                    Swal.fire("Error", response.message || "No se pudo guardar la evolución.", "error");
                }
            },
            error: function() {
                Swal.fire("Error", "Ocurrió un problema de comunicación.", "error");
            }
        });
    });

    // Eliminar Historial (delegado)
    $("#contenedorHistorialClinico").on("click", ".btnEliminarHistorial", function() {
        const idHistorial = $(this).data("idhistorial");
        Swal.fire({
            title: '¿Está seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, ¡eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../ajax/historialclinico.ajax.php',
                    type: 'POST',
                    data: {
                        accionHistorial: 'eliminar',
                        id_historial_eliminar: idHistorial
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === "ok") {
                            Swal.fire('¡Eliminado!', 'La entrada del historial ha sido eliminada.', 'success');
                            if (idPacienteActual) {
                                cargarHistorialClinico(idPacienteActual);
                            }
                        } else {
                            Swal.fire('Error', response.message || 'No se pudo eliminar la entrada.', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Ocurrió un problema de comunicación.', 'error');
                    }
                });
            }
        });
    });






    /* ************************************************************************************************************************ */




    /*===================================================================*/
    $.ajax({
        async: false,
        url: "../ajax/mao.folio.ajax.php",
        method: "POST",
        data: {
            'accion': 11,
            'entidad': 'paciente'
        },
        dataType: 'json',
        success: function(respuesta) {
            const folio = respuesta["folio"];
            $("#iptIdReg").val(folio);
        }
    });

   // alert(clinica2);
    /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE OCUPACIONES
    /*===================================================================*/
    $.ajax({
        url: "../ajax/ocupacionescb.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione una ocupación</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selOcupacionReg").append(options);
        }
    });
    /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE OCUPACIONES MODIFICAR
    /*===================================================================*/
    $.ajax({
        url: "../ajax/ocupacionescb.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione una ocupación</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selOcupacionRegm").append(options);
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
      /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE LAS CLINICAS MODIFICAR
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

            $("#selEmpresaRegm").append(options);
        }
    });
    /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE NACIONALIDADES
    /*===================================================================*/
    $.ajax({
        url: "../ajax/nacionalidades.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione una Nacionalidad</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selNacionalidadReg").append(options);
        }
    });
    /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE NACIONALIDADES MODIFICAR
    /*===================================================================*/
    $.ajax({
        url: "../ajax/nacionalidades.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione una Nacionalidad</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selNacionalidadRegm").append(options);
        }
    });

      /*===================================================================*/
    // CARGA DEL LISTADO CON EL PLUGIN DATATABLE JS
    /*===================================================================*/
  
    //var datos4 = new FormData();
   // $clinica = $_POST[$clinica];
   // datos.append("accion", 1);
    // datos.append("clinica", $clinica); //id_Paciente
      //    var datos12 = new FormData();
       //  var clin = $('#clinica').val();
      //   datos12.append("accion", 1);
       //  clinicaf =$('#vclinica').val();
       //  alert(clinicaf);
     //   datos12.append("clinica", clinicaf); //nombre de la clinica
      //  datos.append("id", $("#iptIdRegm").val()); //id_Paciente
       
    table = $("#tbl_pacientes").DataTable({
    
        dom: 'Bfrtip', // Para que los botones se pongan en la parte Superior
        buttons: [{
                text: 'Agregar Paciente',
                className: 'addNewRecord',
                action: function(e, dt, node, config) {
                    $.ajax({

                        async: false,
                        url: "../ajax/mao.folio.ajax.php",
                        method: "POST",
                        data: {
                            'accion': 11,
                            'entidad': 'paciente'
                        },
                        dataType: 'json',
                        success: function(respuesta) {
                            folio = respuesta["folio"];
                            $("#iptIdReg").val(folio);
                        }
                        });


                    $("#mdlGestionarPacientes").modal('show');

                   accion = 2; //registrar
                },
                titleAttr: 'Agrega un nuevo registro de Pacientes'
            }, 
            
            {
                extend: 'excel',
                text: "Excel",
                title: 'Listado de Pacientes',
                titleAttr: 'Genera un Excel del Listado',
                className:"btn btn-warning",
            },
              {
                 extend:'pageLength',
                 text: 'Longitud de la página',
                 titleAttr: 'Indica el número de renglones por página'
              },
            {
                extend: 'print', 
                text: 'Imprimir',
                title: 'Listado de Pacientes',
                exportOptions: {
                    columns:':visible'
                }
                ,
                 titleAttr: 'Genera un archivo PDF del listado'
            },
            'colvis'
            
        ],        
        pageLength: [[5, 10, 15, 30, 50], 
                    ['5 Filas','10 Filas','15 Filas','30 Filas','50 Filas','Mostrar todo']], 
        pageLength: 10,

        
        ajax: {
            url: "../ajax/pacientes.ajax.php",
            dataSrc: '',
            type: "POST",
            data:{
                accion: 1
                }
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
                targets: 3, // no muestre el id de la ocupacion
                className: 'dt-body-center',
                className: 'text-center',
                render: function(data, type, row) {
                    if ((row[3]) == 'Masculino') {
                            return data === 'Masculino' ? "M" :"";
                        }
                        else{
                            return data === 'Femenino' ? "F":"";
                        }
                      
            }
            
            },
            {
                targets: 4, // no muestre el id de la ocupacion
                visible: false
            },
            {
                targets: 5, // edad
                className: 'dt-body-center',
                className: 'text-center'
            },
            {
                targets: 6, // 
                visible: false
            },
            {
                targets: 7, // 
                visible: false
            },
            {
                targets: 8, // 
                visible: false
            }
            ,
            {
                targets: 10, // no muestra el estado civil
                visible: false
            },
            {
                targets: 11, // 
                visible: false
            },
            {   width: "100px",
                targets: 12, // La Nacionalidad
                
            },
            {
                targets: 13, // no muestre el id nacionalidad
                visible: false
            },
            {
                targets: 14, // no muestre la Nacionalidad
            },
            {
                targets: 15, // 
                className: 'dt-body-center',
                className: 'text-center'
            },
            {
                targets: 16, // 
                      createdCell: function(td, cellData, rowData, row, col) {
                   if ((rowData[15]) == 'Becado') {
                      $(td).parent().css('background', '#a7e698')
                      $(td).parent().css('color', '#050404')
                      $(td).parent().css('font size', 5)
                    }
                    if ((rowData[15]) == 'Baja') {
                      $(td).parent().css('background', '#cd5c5c')
                      $(td).parent().css('color', '#ffffff')
                      $(td).parent().css('font size', 5)
                    }
                },
                className: 'dt-body-center',
                className: 'text-center'

             /*   targets: 14,
                  render: function(data, type, row) {
                    if (type === 'myExport') {
              return data === 'Active' ? "Y" : "N";
            }
                 if (data === 'Becado') {
                    return '<input type="checkbox" class="editor-active" onclick="return false;" checked>';
                  } else {
                    return '<input type="checkbox" onclick="return false;" class="editor-active">';
                  }
                 return data;
                }*/
           },
              {
                targets: 17, // no muestra 
                visible: false
            },
            {
                targets: 18, // no muestra 
                visible: false
            }
            ,
            {
                targets: 19, // no muestra 
                visible: false
            },
            
           // cambia de color para indicar e
           // {
           //     targets: 9,
           //     createdCell: function(td, cellData, rowData, row, col) {
           //        if (parseFloat(rowData[9]) <= parseFloat(rowData[10])) {
           //             $(td).parent().css('background', '#FF5733')
           //            $(td).parent().css('color', '#ffffff')
           //         }
           //     }
           // },
            
            {
                targets: 20,
                orderable: false,
                render: function(data, type, full, meta) {
                    return "<center>" +
                    "<span class='btnVerFichaPaciente text-info px-1' style='cursor:pointer;' data-toggle='tooltip' title='Ver Ficha del Paciente' data-id-paciente='" + full.id + "' data-nombre-paciente='" + full.nombre + "'>" +
                        "<i class='fas fa-eye fs-5'></i>" +
                        "</span>" +                        
                        "<span class='btnEditarPaciente text-primary px-1' style='cursor:pointer;' data-toggle='tooltip' title='Editar Paciente'>" +
                        "<i class='fas fa-pencil-alt fs-5'></i>" +
                        "</span>" +
                        "<span class='btnEliminarPaciente text-danger px-1' style='cursor:pointer;' data-toggle='tooltip' title='Eliminar Paciente'>" +
                        "<i class='fas fa-trash fs-5'></i>" +
                        "</span>" +
                        "</center>"
                },
                className: 'dt-body-center'
            
            }

        ],
        fixedColumns:   {
            left: 1,
            right: 1
        },
        //fixedColumns: true,
        language: {
           // url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
             "url": "../vistas/assets/json/Spanish.json"
            // con esto se cambia al idioma español de los elementos del datatable
        },
                    "fnDrawCallback": function() {
                        if (typeof oTable != 'undefined') {
                            $('.toggleCheckBox').bootstrapToggle({});
                        }

                        $('#tbl_pacientes thead tr').each(function () {
                            var sTitle;
                            var nTds = $('td', this);
                            var columnTitle= $(nTds[0]).text();

                             this.setAttribute('title', columnTitle);
                        });

                    }
    });
   // $("#vclinica").change(function(){         
   // table
    //    .columns(17)
     //   .search(this.value)
    //    .draw();
   // });
    //$('div.dataTables_filter input').unbind();
     //   $('div.dataTables_filter input').bind('keyup', function(e) {
     //       if(e.keyCode == 13) {
     //           table.fnFilter(this.value);
     //       }
    //    });
    $('#mdlGestionarPacientes').on('show.bs.modal', function () {
        var id_empresa = $("#selEmpresaReg").val();
        obtenerFolio('paciente',id_empresa);
    });
                /* Apply the tooltips */
    $('#tbl_pacientes thead tr[title]').tooltip({
                    "delay": 0,
                     "track": true,
                     "fade": 250
    });
    /*===================================================================*/
    // EVENTOS PARA CRITERIOS DE BUSQUEDA (ID, NOMBRE Y DIRECCION)
    /*===================================================================*/
    $("#iptId").keyup(function() {
        table.column($(this).data('index')).search(this.value).draw();
    })

    $("#iptNombre").keyup(function() {
        table.column($(this).data('index')).search(this.value).draw();
    })

    $("#iptDireccion").keyup(function() {
        table.column($(this).data('index')).search(this.value).draw();
    })

    /*===================================================================*/
    // EVENTOS PARA CRITERIOS DE BUSQUEDA POR RANGO (PREVIO VENTA)
    /*===================================================================*/
    $("#iptPrecioVentaDesde, #iptPrecioVentaHasta").keyup(function() {
        table.draw();
    })

    $.fn.dataTable.ext.search.push(

        function(settings, data, dataIndex) {

            var precioDesde = parseFloat($("#iptPrecioVentaDesde").val());
            var precioHasta = parseFloat($("#iptPrecioVentaHasta").val());

            var col_venta = parseFloat(data[7]);

            if ((isNaN(precioDesde) && isNaN(precioHasta)) ||
                (isNaN(precioDesde) && col_venta <= precioHasta) ||
                (precioDesde <= col_venta && isNaN(precioHasta)) ||
                (precioDesde <= col_venta && col_venta <= precioHasta)) {
                return true;
            }

            return false;
        }
    )

    /*===================================================================*/
    // EVENTO PARA LIMPIAR INPUTS DE CRITERIOS DE BUSQUEDA
    /*===================================================================*/
    $("#btnLimpiarBusqueda").on('click', function() {

        $("#iptId").val('')
        $("#iptNombre").val('')
        $("#iptDireccion").val('')
       // $("#iptPrecioVentaDesde").val('')
       // $("#iptPrecioVentaHasta").val('')

        table.search('').columns().search('').draw();
    })

    $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {

        $("#validate_id").css("display", "none");
        $("#validate_nombre").css("display", "none");
        $("#validate_sexo").css("display", "none");
        $("#validate_fecha_nacimiento").css("display", "none");
        $("#validate_edad").css("display", "none");
        $("#validate_direccion").css("display", "none");
        $("#validate_telefono").css("display", "none");
        $("#validate_correo").css("display", "none");
        $("#validate_estado_civil").css("display", "none");
        $("#validate_escolaridad").css("display", "none");
        $("#validate_id_ocupacion").css("display", "none");
        $("#validate_id_nacionalidad").css("display", "none");
        $("#validate_comorbilidad").css("display", "none");
        $("#validate_fecha_creacion").css("display", "none");
        $("#validate_id_empresa").css("display", "none");
        $("#validate_estatus").css("display", "none");

        $("#iptIdReg").val("");
        $("#iptNombreReg").val("");
        $("#iptSexoReg").val("");
        $("#iptFecha_NacimientoReg").val("");
        $("#iptDireccionReg").val("");
        $("#iptTelefonoReg").val("");
        $("#iptCorreoReg").val("");
        $("#iptEstado_CivilReg").val("");
        $("#iptEscolaridadReg").val("");
        $("#selId_OcupacionReg").val(0);
        $("#selId_NacionalidadReg").val(0);
        $("#iptComorbilidadReg").val("");
        $("#iptFecha_CreacionReg").val("");
        $("#selId_EmpresaReg").val(0);
        $("#iptEstatusReg").val("");
      
    })
    $("#btnCancelarRegistrom, #btnCerrarModalm").on('click', function() {

        $("#validate_idm").css("display", "none");
        $("#validate_nombrem").css("display", "none");
        $("#validate_sexom").css("display", "none");
        $("#validate_fecha_nacimientom").css("display", "none");
        $("#validate_edadm").css("display", "none");
        $("#validate_direccionm").css("display", "none");
        $("#validate_telefonom").css("display", "none");
         $("#validate_correom").css("display", "none");
        $("#validate_estado_civilm").css("display", "none");
        $("#validate_escolaridadm").css("display", "none");
        $("#validate_id_ocupacionm").css("display", "none");
        $("#validate_id_nacionalidadm").css("display", "none");
        $("#validate_comorbilidadm").css("display", "none");
        $("#validate_fecha_creacionm").css("display", "none");
        $("#validate_id_empresam").css("display", "none");
        $("#validate_estatusm").css("display", "none");

        $("#iptIdRegm").val("");
        $("#iptNombreRegm").val("");
        $("#iptSexoRegm").val("");
        $("#iptFecha_NacimientoRegm").val("");
        $("#iptDireccionRegm").val("");
        $("#iptTelefonoRegm").val("");
        $("#iptCorreoRegm").val("");
        $("#iptEstado_CivilRegm").val("");
        $("#iptEscolaridadRegm").val("");
        $("#selId_OcupacionRegm").val(0);
        $("#selId_NacionalidadRegm").val(0);
        $("#iptComorbilidadRegm").val("");
        $("#iptFecha_CreacionRegm").val("");
        $("#selId_EmpresaRegm").val(0);
        $("#iptEstatusRegm").val("");

    })
    

    /*===================================================================*/
    //EVENTO PARA CALCULAR LA EDAD AL CAMBIAR EL CONTENIDO (PERDER FOCUS)
    /*===================================================================*/
    $("#iptFecha_NacimientoReg").change(function() {
      
      calcularEdad();
    });
  /*===================================================================*/
    //EVENTO PARA CALCULAR LA EDAD AL CAMBIAR EL CONTENIDO (PERDER FOCUS)
    /*===================================================================*/
    $("#iptFecha_NacimientoRegm").change(function() {
      
      calcularEdadm();
    });

    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON EDITAR Paciente
    =========================================================================================*/
    $('#tbl_pacientes tbody').on('click', '.btnEditarPaciente', function() {

        accion = 4; //seteamos la accion para editar

        $("#mdlGestionarPacientesm").modal('show');

        var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }
        console.log("🚀 ~ file: Pacientes.php ~ line 1134 ~ $ ~ data", data)
      //  alert('antes de asignar valores');
        $("#iptIdRegm").val(data["id"]);
        $("#iptNombreRegm").val(data["nombre"]);
        $("#iptSexoRegm").val(data["sexo"]);
        $("#iptFecha_NacimientoRegm").val(data["fecha_nacimiento"]);
        $("#iptEdadRegm").val(data[5]);
        $("#iptDireccionRegm").val(data["direccion"]);
        $("#iptTelefonoRegm").val(data[7]);
         $("#iptCorreoRegm").val(data[8]);
        $("#iptEstado_CivilRegm").val(data[9]);
        $("#iptEscolaridadRegm").val(data[10]);
        $("#selOcupacionRegm").val(data[11]);// ocupacion
        $("#selNacionalidadRegm").val(data[13]);
        $("#iptComorbilidadRegm").val(data[15]);
        $("#iptEstatusRegm").val(data["estatus"]);
        $("#selEmpresaRegm").val(data[18]);

    })
   
    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON ELIMINAR PACIENTE
    =========================================================================================*/
    $('#tbl_pacientes tbody').on('click', '.btnEliminarPaciente', function() {
        
        accion = 5; //seteamos la accion para editar
        
        var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }
        console.log("🚀 ~ file: Pacientes.php ~ line 1093 ~ $ ~ data", data)
        
         vroles = $('#vrol').val();
        if (vroles==1) 
          {                  
                        
            var id = data["id"];
            var id_empresa = data["id_empresa"];  
          
            Swal.fire({
                title: 'El registro será borrado permanentemente, Está seguro de eliminar el paciente?',
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
                datos.append("id", id); //id_Paciente                
                datos.append("id_empresa", id_empresa); //id_de la clinica             

                $.ajax({
                    url: "../ajax/pacientes.ajax.php",
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
                                title: 'El paciente se eliminó correctamente'
                            });

                            table.ajax.reload();

                            } else {
                                Toast.fire({
                                icon: 'error',
                                title: 'El paciente no se pudo eliminar'
                                });
                            }

                        }
                    });

                }
            })
        } // condiciona el borrado solo al administrador
        else{
            Swal.fire(
            'Lo siento!',
             'Usuario sin permisos para realizar esta operacion',
             'error'
            );
        }

    })

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
// CALCULA LA UTILIDAD
function calcularUtilidad() {

    var iptPrecioCompraReg = $("#iptPrecioCompraReg").val();
    var iptPrecioVentaReg = $("#iptPrecioVentaReg").val();
    var Utilidad = iptPrecioVentaReg - iptPrecioCompraReg;

    $("#iptUtilidadReg").val(Utilidad.toFixed(2));

}
// CALCULA LA EDAD 
//function calcularEdad() {
   /* var anios =0;
    var Fecha_Nacimiento =$("#iptFecha_NacimientoReg").val();

    $cumpleanos = new DateTime($var_PHP);
    $hoy = new DateTime();
    $annos = $hoy->diff($cumpleanos);
    $annos->y; ?>
    $("#iptEdadReg").val($annos);*/
    
    
//}
/*===================================================================*/
//EVENTO QUE GUARDA LOS DATOS DEL PACIENTE, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/
document.getElementById("btnGuardarPaciente").addEventListener("click", function() {

    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
        //calcularedad();
        if (form.checkValidity() === true) {   

           // console.log("Listo para registrar el paciente")
            if(accion == 4){
                $mensaje='Está seguro de Modificar el paciente?';
                $confirmar='Si, deseo Modificarlo!';
            }
            if (accion==2){
                $mensaje='Está seguro de registrar el paciente?';
                $confirmar='Si, deseo registrarlo!';
            }
            Swal.fire({
                title:$mensaje ,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: $confirmar,
                cancelButtonText: 'Cancelar',
            }).then((result) => {

                if (result.isConfirmed) {

                    var datos = new FormData();

                    datos.append("accion", accion);
                    datos.append("id", $("#iptIdReg").val()); //id_Paciente
                    datos.append("nombre", $("#iptNombreReg").val()); //Nombre_Paciente
                    datos.append("sexo", $("#iptSexoReg").val()); //Sexo_Paciente
                    datos.append("fecha_nacimiento", $("#iptFecha_NacimientoReg").val()); //Fecha_Nacimeinto_Paciente
                    datos.append("edad", $("#iptEdadReg").val()); //Edad_Paciente
                    datos.append("direccion", $("#iptDireccionReg").val()); //Direccion_Paciente
                    datos.append("telefono", $("#iptTelefonoReg").val()); //Telefono_Paciente
                     datos.append("correo", $("#iptCorreoReg").val()); //Correo_Paciente
                    datos.append("estado_civil", $("#iptEstado_CivilReg").val()); //Estado Civil
                    datos.append("escolaridad", $("#iptEscolaridadReg").val()); //Escolaridad
                    datos.append("id_ocupacion", $("#selOcupacionReg").val()); //Id_ocupacion 
                    datos.append("id_nacionalidad", $("#selNacionalidadReg").val()); //Id_Nacionalidad
                    datos.append("comorbilidad", $("#iptComorbilidadReg").val()); //Comorbilidad
                   
                    datos.append("id_empresa", $("#selEmpresaReg").val()); //Id_empresa
                    datos.append("estatus", $("#iptEstatusReg").val()); //Estatus
                    

                    

                    if(accion == 2){
                        var titulo_msj = "El paciente se registró correctamente"
                    }

                    if(accion == 4){
                        var titulo_msj = "El paciente se actualizó correctamente"
                    }

                    $.ajax({
                        url: "../ajax/pacientes.ajax.php",
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

                                $("#mdlGestionarPacientes").modal('hide');

                                $("#iptNombreReg").val("");
                                $("#iptSexoReg").val("");
                                $("#iptFechaNacimientoReg").val("");
                                $("#iptEdadReg").val("");
                                $("#iptDireccionReg").val("");
                                $("#iptTelefonoReg").val("");
                                $("#iptCorreoReg").val("");
                                $("#iptEstadoCivilReg").val("");
                                $("#iptEscolaridadReg").val("");
                                $("#selOcupacionReg").val(0);
                                $("#selNacionalidadReg").val(0);
                                $("#iptComorbilidadReg").val("");
                                $("#selEmpresaReg").val(0);
                                $("#iptEstatus").val(0);
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'El paciente no se pudo registrar'
                                });
                            }

                        }
                    });

                }
            })
        }else {
            console.log("No pasó la validación")
        }

        form.classList.add('was-validated');

    });
});

/*===================================================================*/
//EVENTO QUE MODIFICA LOS DATOS DEL PACIENTE, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/
document.getElementById("btnGuardarPacientem").addEventListener("click", function() {

    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
    
    if (form.checkValidity() === true) {   
     // validar si el paciente tiene expediente activo para que no se pueda dar de baja
           var id_paciente= $("#iptIdRegm").val();
           var id_clinica = $("#selEmpresaRegm").val();
          
                
                    if(accion == 4){
                        $mensaje='Está seguro de Modificar el paciente?';
                        $confirmar='Si, deseo Modificarlo!';
                    }
                    if (accion==2){
                        $mensaje='Está seguro de registrar el paciente?';
                        $confirmar='Si, deseo registrarlo!';
                    }
                    Swal.fire({
                        title:$mensaje ,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: $confirmar,
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {

                        if (result.isConfirmed) {

                            var datos = new FormData();

                            datos.append("accion", accion);
                            datos.append("id", $("#iptIdRegm").val()); //id_Paciente
                            datos.append("nombre", $("#iptNombreRegm").val()); //Nombre_Paciente
                            datos.append("sexo", $("#iptSexoRegm").val()); //Sexo_Paciente
                            datos.append("fecha_nacimiento", $("#iptFecha_NacimientoRegm").val()); //Fecha_Nacimeinto_Paciente
                            datos.append("edad", $("#iptEdadRegm").val()); //Edad_Paciente
                            datos.append("direccion", $("#iptDireccionRegm").val()); //Direccion_Paciente
                            datos.append("telefono", $("#iptTelefonoRegm").val()); //Teléfono_Paciente
                            datos.append("correo", $("#iptCorreoRegm").val()); //Correo_Paciente
                            datos.append("estado_civil", $("#iptEstado_CivilRegm").val()); //Estado Civil
                            datos.append("escolaridad", $("#iptEscolaridadRegm").val()); //Escolaridad
                            datos.append("id_ocupacion", $("#selOcupacionRegm").val()); //Id_ocupacion 
                            datos.append("id_nacionalidad", $("#selNacionalidadRegm").val()); //Id_Nacionalidad
                            datos.append("comorbilidad", $("#iptComorbilidadRegm").val()); //Comorbilidad             
                            datos.append("id_empresa", $("#selEmpresaRegm").val()); //Id_empresa
                            datos.append("estatus", $("#iptEstatusRegm").val()); //Estatus
                            

                            

                        if(accion == 2){
                                var titulo_msj = "El paciente se registró correctamente"
                            }

                            if(accion == 4){
                                var titulo_msj = "El paciente se actualizó correctamente"
                            }

                            $.ajax({
                                url: "../ajax/pacientes.ajax.php",
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

                                        $("#mdlGestionarPacientesm").modal('hide');
                                        $("#iptNombreRegm").val("");
                                        $("#iptSexoRegm").val("");
                                        $("#iptFechaNacimientoRegm").val("");
                                        $("#iptEdadRegm").val("");
                                        $("#iptDireccionRegm").val("");
                                        $("#iptTelefonoRegm").val("");
                                        $("#iptEstadoCivilRegm").val("");
                                        $("#iptEscolaridadRegm").val("");
                                        $("#selOcupacionRegm").val(0);
                                        $("#selNacionalidadRegm").val(0);
                                        $("#iptComorbilidadRegm").val("");
                                        $("#selEmpresaRegm").val(0);
                                        $("#iptEstatusm").val(0);
                                    } else {
                                        Toast.fire({
                                            icon: 'error',
                                            title: 'El paciente no se pudo modificar'
                                        });
                                    }

                                }
                            });

                        }
                    })
                
    }else {
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

/*===================================================================*/
//EVENTO QUE LIMPIA LOS MENSAJES DE ALERTA DE INGRESO DE DATOS DE CADA INPUT AL CANCELAR LA VENTANA MODAL
/*===================================================================*/
document.getElementById("btnCancelarRegistrom").addEventListener("click", function() {
    $(".needs-validation").removeClass("was-validated");
})

$("#iptCuota_IngresoReg").on({
  "focus": function(event) {
    $(event.target).select();
  },
  "keyup": function(event) {
    $(event.target).val(function(index, value) {
      return value.replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
    });
  }
});

$("#iptCuota_SemanalReg").on({
  "focus": function(event) {
    $(event.target).select();
  },
  "keyup": function(event) {
    $(event.target).val(function(index, value) {
      return value.replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
    });
  }
});
function Edad(FechaNacimiento) {

    var fechaNace = new Date(FechaNacimiento);
    var fechaActual = new Date()

    var mes = fechaActual.getMonth();
    var dia = fechaActual.getDate();
    var año = fechaActual.getFullYear();

    fechaActual.setDate(dia);
    fechaActual.setMonth(mes);
    fechaActual.setFullYear(año);

    edad = Math.floor(((fechaActual - fechaNace) / (1000 * 60 * 60 * 24) / 365));
   
    return edad;
}
function edad(e) {

   
 /* edadMS = Date.parse(Date()) - Date.parse(e.target.value);
  edads = new Date();
  edads.setTime(edadMS);
  resultado = edads.getFullYear() - 1970;
  res = (resultado <= 0) ? 0 : resultado; // Para evitar que sea negativo
  document.getElementById('iptEdadReg').innerHTML = res;
*/
}
function isValidDate(day,month,year)
{
    var dteDate;
 
    // En javascript, el mes empieza en la posicion 0 y termina en la 11 
    //   siendo 0 el mes de enero
    // Por esta razon, tenemos que restar 1 al mes
    month=month-1;
    // Establecemos un objeto Data con los valore recibidos
    // Los parametros son: año, mes, dia, hora, minuto y segundos
    // getDate(); devuelve el dia como un entero entre 1 y 31
    // getDay(); devuelve un num del 0 al 6 indicando siel dia es lunes,
    //   martes, miercoles ...
    // getHours(); Devuelve la hora
    // getMinutes(); Devuelve los minutos
    // getMonth(); devuelve el mes como un numero de 0 a 11
    // getTime(); Devuelve el tiempo transcurrido en milisegundos desde el 1
    //   de enero de 1970 hasta el momento definido en el objeto date
    // setTime(); Establece una fecha pasandole en milisegundos el valor de esta.
    // getYear(); devuelve el año
    // getFullYear(); devuelve el año
    dteDate=new Date(year,month,day);
 
    //Devuelva true o false...
    return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));
}
 
/**
 * Funcion para validar una fecha
 * Tiene que recibir:
 *  La fecha en formato ingles yyyy-mm-dd
 * Devuelve:
 *  true-Fecha correcta
 *  false-Fecha Incorrecta
 */
function validate_fecha(fecha)
{
    var patron=new RegExp("^(19|20)+([0-9]{2})([-])([0-9]{1,2})([-])([0-9]{1,2})$");
 
    if(fecha.search(patron)==0)
    {
        var values=fecha.split("-");
        if(isValidDate(values[2],values[1],values[0]))
        {
            return true;
        }
    }
    return false;
}
 
/**
 * Esta función calcula la edad de una persona y los meses
 * La fecha la tiene que tener el formato yyyy-mm-dd que es
 * metodo que por defecto lo devuelve el <input type="date">
 */
function calcularEdad()
{
    var fecha = $("#iptFecha_NacimientoReg").val();
   // fecha=document.getElementById("#iptFecha_NacimientoReg").value;
    if(validate_fecha(fecha)==true)
    {
        // Si la fecha es correcta, calculamos la edad
        var values=fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];
 
        // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth()+1;
        var ahora_dia = fecha_hoy.getDate();
 
        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if ( ahora_mes < mes )
        {
            edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia))
        {
            edad--;
        }
        if (edad > 1900)
        {
            edad -= 1900;
        }
 
        // calculamos los meses
        var meses=0;
        if(ahora_mes>mes)
            meses=ahora_mes-mes;
        if(ahora_mes<mes)
            meses=12-(mes-ahora_mes);
        if(ahora_mes==mes && dia>ahora_dia)
            meses=11;
 
        // calculamos los dias
        var dias=0;
        if(ahora_dia>dia)
            dias=ahora_dia-dia;
        if(ahora_dia<dia)
        {
            ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
            dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
        }
        //$("#iptEdadReg").val($anios);
        $("#iptEdadReg").val(edad);
        
    }else{
       // document.getElementById("result").innerHTML="La fecha "+fecha+" es incorrecta";
    }
}
function calcularEdadm()
{
    var fecha = $("#iptFecha_NacimientoRegm").val();
   // fecha=document.getElementById("#iptFecha_NacimientoReg").value;
    if(validate_fecha(fecha)==true)
    {
        // Si la fecha es correcta, calculamos la edad
        var values=fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];
 
        // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth()+1;
        var ahora_dia = fecha_hoy.getDate();
 
        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if ( ahora_mes < mes )
        {
            edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia))
        {
            edad--;
        }
        if (edad > 1900)
        {
            edad -= 1900;
        }
 
        // calculamos los meses
        var meses=0;
        if(ahora_mes>mes)
            meses=ahora_mes-mes;
        if(ahora_mes<mes)
            meses=12-(mes-ahora_mes);
        if(ahora_mes==mes && dia>ahora_dia)
            meses=11;
 
        // calculamos los dias
        var dias=0;
        if(ahora_dia>dia)
            dias=ahora_dia-dia;
        if(ahora_dia<dia)
        {
            ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
            dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
        }
        //$("#iptEdadReg").val($anios);
        $("#iptEdadRegm").val(edad);
        
    }else{
       // document.getElementById("result").innerHTML="La fecha "+fecha+" es incorrecta";
    }
}
function cargarfolio(){
  
}
var clinica2 = '<?php echo $_SESSION['S_CLINICA']; ?>';

</script>
<script>
    // Inicializar tooltips de Bootstrap después de que la tabla se haya dibujado
    $(document).ready(function() {
        $('#tbl_pacientes').on('draw.dt', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    });
</script>
      