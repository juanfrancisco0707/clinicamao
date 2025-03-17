<!-- /.content -->
<!-- Ventana Modal para ingresar  los Expedientes de los Pacientes  -lg-->
<div class="modal fade" id="mdlGestionarExpedientes" role="dialog">

    <div class="modal-dialog modal-xl">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Agregar Expediente de Pacientes</h5>

                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal EXPEDIENTE-->
            <div class="modal-body">
    
                <form class="needs-validation" novalidate >
                    <!-- Abrimos una fila -->
                    <div class="row">

                        <!-- Columna para registro del Identificador del Expediente-->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptId_ExpedienteReg"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Número de Expediente</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptId_ExpedienteReg"
                                    name="iptId_Expediente" placeholder="Número de Expediente" disabled>
                                <div class="invalid-feedback">Debe ingresar el # de expediente</div>
                            </div>
                        </div>
                      
                        <!-- Columna para registro del Nombre del Paciente -->
                        <div class="col-12 col-lg-8">
                            <div class="form-group mb-2">
                            <label class="" for="selPacienteReg"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Nombre del Paciente</span><span class="text-danger">*</span>
                                </label>
                              <!--  <select class="form-control" data-live-search="true" id="selPacienteReg" name="selPacienteReg" required > -->
                               <select class="form-select  form-select-sm" data-live-search="true" aria-label=".form-select-sm example"
                                    id="selPacienteReg" require> 
                                </select>
                                <div class="invalid-feedback">Seleccione el Paciente                                  
                                </div>



                              <!--  <label class="" for="iptNombreReg"><i
                                        class="fas fa-file-signature fs-6"></i> <span
                                        class="small">Nombre del Paciente</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptNombreReg"
                                    placeholder="Nombre del Paciente" required> -->
                            </div>
                        </div>
                        <!-- Columna para registro del Representante del Paciente -->
                        <div class="col-12  col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="selRepresentanteReg"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Representante</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selRepresentanteReg">
                                </select>
                                <div class="invalid-feedback">Seleccione el representante del Paciente</div>
                            </div>
                        </div>
                         <!-- Columna para registro de firma del contrato-->
                                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptFirmo_ContratoReg"> <span class="small">Firmó Contrato</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptFirmo_ContratoReg"
                                 placeholder="Verificar si firmó Contrato">
                                 <div class="invalid-feedback">Debe ingresar si firmó Contrato</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la Fecha de Ingreso-->
                    
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptFecha_IngresoReg"><i
                                class="fa fa-calendar-plus-o"></i> <span class="small">Fecha de Ingreso</span>
                                        <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="iptFecha_IngresoReg"
                                    placeholder="Fecha de Ingreso">
                                <div class="invalid-feedback">Debe ingresar Fecha de Ingreso</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la Hora de Ingreso-->
                    
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptHora_IngresoReg"><i
                                class="fa fa-clock-o"></i> <span class="small">Hora de Ingreso</span>
                                        <span class="text-danger">*</span></label>
                                <input type="time" class="form-control form-control-sm" id="iptHora_IngresoReg"
                                    placeholder="Hora de Ingreso">
                                <div class="invalid-feedback">Debe ingresar Hora de Ingreso</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la fecha de salida -->
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptFecha_SalidaReg"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Fecha de Salida</span>
                                        <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="iptFecha_SalidaReg"
                                    placeholder="Fecha de Salida">
                                <div class="invalid-feedback">Debe ingresar Fecha de Salida</div>
                            </div>
                        </div>
                        <!-- Columna para registro del tiempo de duracion internado el Paciente -->
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptTiempo_DuracionReg"><i class="fas fa-plus-circle fs-6"></i>
                                    <span class="small">Duración en meses</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptTiempo_DuracionReg"
                                    placeholder="Tiempo de duración" required>
                               <!-- <div class="invalid-feedback">Debe ingresar el tiempo de duración</div>-->
                            </div>
                        </div>
                    
                        <!-- Columna para registro de la cuota de Ingreso-->
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptCuota_IngresoReg"><i
                                        class="fas fa-dollar-sign fs-6"></i> <span class="small">Cuota de Ingreso</span><span class="text-danger">*</span></label>
                                <input type="number" min="0" class="form-control form-control-sm" id="iptCuota_IngresoReg"
                                    placeholder="Cuota de Ingreso">
                                <div class="invalid-feedback">Debe ingresar la Cuota de Ingreso</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptCuota_SemanalReg"><i
                                        class="fas fa-dollar-sign fs-6"></i> <span class="small">Cuota Semanal</span><span class="text-danger">*</span></label>
                                <input type="number" min="0" class="form-control form-control-sm" id="iptCuota_SemanalReg"
                                    placeholder="Cuota de pago Semanal" required>
                                <div class="invalid-feedback">Debe ingresar la Cuota de pago semanal</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptExtrasReg"><i
                                        class="fas fa-dollar-sign fs-6"></i> <span class="small">Extras</span><span class="text-danger"></span></label>
                                <input type="text" min="0" class="form-control form-control-sm" id="iptExtrasReg"
                                    placeholder="Extras para Gastos Internos">
                                <div class="invalid-feedback">Debe ingresar el dinero Extra</div>
                            </div>
                        </div>
                         <!-- Columna para registro del Testigo -->
                         <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptTestigoReg"><i
                                        class="fas fa-minus-circle fs-6"></i> <span class="small">Testigo</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptTestigoReg"
                                    placeholder="Testigo">
                                <div class="invalid-feedback">Debe ingresar el Testigo</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                            <label class="" for="iptEstatusReg"><i
                                        class="fas fa-minus-circle fs-6"></i> <span class="small">Estatus</span><span class="text-danger">*</span></label>
                                        <select name="estatus" class="form-control form-control-sm" id ="iptEstatusReg" required>
                                         <option>Activo</option>
                                         <option>Baja</option>
                                         <option>Suspendido</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar el estatus</div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                            <label class="" for="iptTipo_IngresoReg"><i
                                        class="fas fa-minus-circle fs-6"></i> <span class="small">Tipo Ingreso</span><span class="text-danger">*</span></label>
                                        <select name="tipo_ingreso" class="form-control form-control-sm" id ="iptTipo_IngresoReg" required>
                                         <option>Voluntario</option>
                                         <option>Involuntario</option>
                                         <option>Obligatorio</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar el tipo de Ingreso</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                        <div class="form-group mb-2">
                                <label class="" for="iptRefiereReg"><i
                                        class="fa fa-handshake-o"></i> <span class="small">Institucion que lo refiere</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptRefiereReg"
                                    placeholder="Intitución de referencia">
                                <div class="invalid-feedback">Debe ingresar la referencia</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                        <div class="form-group mb-2">
                                <label class="" for="iptMotivoReg"><i
                                        class="fas fa-minus-circle fs-6"></i> <span class="small">Motivo del Ingreso</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptMotivoReg"
                                    placeholder="Ingrese el motivo del Ingreso">
                                <div class="invalid-feedback">Debe ingresar el motivo del Ingreso</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2">
                        <div class="form-group mb-2">
                                <label class="" for="iptFolio_MpReg"><i
                                        class="fas fa-barcode fs-6"></i> <span class="small">Folio M.P.</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptFolio_MpReg"
                                    placeholder="Ingrese el folio del M.P.">
                                <div class="invalid-feedback">Debe ingresar el folio del M.P.</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                        <div class="form-group mb-2">
                                <label class="" for="iptOperadorReg"><i
                                        class="fa fa-user-circle-o"></i> <span class="small">Operador M.P.</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptOperadorReg"
                                    placeholder="Ingrese el nombre del Operador del M.P.">
                                <div class="invalid-feedback">Debe ingresar el Operador del M.P.</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                        <div class="form-group mb-2">
                                <label class="" for="iptDescripcion_SaludReg"><i
                                        class="fa fa-heartbea"></i> <span class="small">Salud actual</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptDescripcion_SaludReg"
                                    placeholder="Ingrese breve descripción de Salud">
                                <div class="invalid-feedback">Debe ingresar una breve descripción de Salud</div>
                            </div>
                        </div>
                        <div class="col-12  col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="selDrogasReg"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Sustancia de Consumo</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selDrogasReg">
                                </select>
                                <div class="invalid-feedback">Seleccione la sustancia de consumo</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                        <div class="form-group mb-2">
                                <label class="" for="iptMedicamentoReg"><i
                                        class="fa fa-heartbea"></i> <span class="small">Medicamentos</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptMedicamentoRegn"
                                    placeholder="Ingrese medicamentos que consume">
                                <div class="invalid-feedback">Debe ingresar algún medicamento que consuma</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                        <div class="form-group mb-2">
                                <label class="" for="iptTerapia_IndividualReg"><i
                                        class="fa fa-heartbea"></i> <span class="small">Terapia Individual</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptTerapia_IndividualReg"
                                    placeholder="Ingrese si recibe terapia Individual">
                                <div class="invalid-feedback">Debe ingresar si recibe terapia Individual</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptTerapia_OcupacionalReg"><i
                                        class="fa fa-heartbea"></i> <span class="small">Terapia Ocupacional</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptTerapia_OcupacionalReg"
                                    placeholder="Ingrese si recibe terapia Ocupacional">
                                <div class="invalid-feedback">Debe ingresar si recibe terapia Ocupacional</div>
                            </div>
                        </div>
                         
                    </div>
                        <!-- creacion de botones para cancelar y guardar el Expediente -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarExpediente">Guardar Expediente</button>
                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->
                       
                   
                </form>
            
            </div>

        </div>
    </div>


</div>
<!-- /. Fin de Ventana Modal para ingreso de Expedientes de Pacientes -->

<!-- /.content -->
<!-- Ventana Modal para modificar los Expedientes de los Pacientes -->
<div class="modal fade" id="mdlGestionarExpedientesM" role="dialog">

    <div class="modal-dialog modal-xl">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Modificar Expediente de Pacientes</h5>

                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModalm">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal EXPEDIENTE-->
            <div class="modal-body">
                <form class="needs-validation" novalidate >
                    <!-- Abrimos una fila -->
                    <div class="row">

                                <!-- Columna para registro del Identificador del Expediente-->
                                <div class="col-12 col-lg-4">
                                    <div class="form-group mb-2">
                                        <label class="" for="iptId_ExpedienteRegm"><i class="fas fa-barcode fs-6"></i>
                                            <span class="small">Número de Expediente</span><span class="text-danger">*</span>
                                        </label>
                                        <input type="number" class="form-control form-control-sm" id="iptId_ExpedienteRegm"
                                            name="iptId_Expedientem" placeholder="Número de Expediente" disabled>
                                        <div class="invalid-feedback">Debe ingresar el # de expediente</div>
                                    </div>
                                </div>
                            
                                <!-- Columna para registro del Nombre del Paciente -->
                                <div class="col-12 col-lg-8">
                                    <div class="form-group mb-2">
                                    <label class="" for="selPacienteRegm"><i class="fas fa-dumpster fs-6"></i>
                                            <span class="small">Nombre del Paciente</span><span class="text-danger">*</span>
                                        </label>
                                    <!--  <select class="form-control" data-live-search="true" id="selPacienteReg" name="selPacienteReg" required > -->
                                    <select class="form-select  form-select-sm" data-live-search="true" aria-label=".form-select-sm example"
                                            id="selPacienteRegm" require> 
                                        </select>
                                        <div class="invalid-feedback">Seleccione el Paciente</div>

                                    </div>
                                </div>
                                <!-- Columna para registro del Representante del Paciente -->
                                <div class="col-12  col-lg-6">
                                    <div class="form-group mb-2">
                                        <label class="" for="selRepresentanteRegm"><i class="fas fa-dumpster fs-6"></i>
                                            <span class="small">Representante</span><span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            id="selRepresentanteRegm">
                                        </select>
                                        <div class="invalid-feedback">Seleccione el representante del Paciente</div>
                                    </div>
                                </div>
                                <!-- Columna para registro de firma del contrato-->
                                <div class="col-12 col-lg-2">
                                    <div class="form-group mb-2">
                                        <label class="" for="iptFirmo_ContratoRegm"> <span class="small">Firmó Contrato</span></label>
                                        <input type="text" class="form-control form-control-sm" id="iptFirmo_ContratoRegm"
                                        placeholder="Verificar si firmó Contrato">
                                        <div class="invalid-feedback">Debe ingresar si firmó Contrato</div>
                                    </div>
                                </div>
                                <!-- Columna para registro de la Fecha de Ingreso-->
                            
                                <div class="col-12 col-lg-2">
                                    <div class="form-group mb-2">
                                        <label class="" for="iptFecha_IngresoRegm"><i
                                        class="fa fa-calendar-plus-o"></i> <span class="small">Fecha de Ingreso</span>
                                                <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-sm" id="iptFecha_IngresoRegm"
                                            placeholder="Fecha de Ingreso">
                                        <div class="invalid-feedback">Debe ingresar Fecha de Ingreso</div>
                                    </div>
                                </div>
                                <!-- Columna para registro de la Hora de Ingreso-->
                            
                                <div class="col-12 col-lg-2">
                                    <div class="form-group mb-2">
                                        <label class="" for="iptHora_IngresoRegm"><i
                                        class="fa fa-clock-o"></i> <span class="small">Hora de Ingreso</span>
                                                <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control form-control-sm" id="iptHora_IngresoRegm"
                                            placeholder="Hora de Ingreso">
                                        <div class="invalid-feedback">Debe ingresar Hora de Ingreso</div>
                                    </div>
                                </div>
                                <!-- Columna para registro de la fecha de salida -->
                                <div class="col-12 col-lg-2">
                                    <div class="form-group mb-2">
                                        <label class="" for="iptFecha_SalidaRegm"><i
                                        class="fa-solid fa-calendar-days"></i> <span class="small">Fecha de Salida</span>
                                                <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-sm" id="iptFecha_SalidaRegm"
                                            placeholder="Fecha de Salida">
                                        <div class="invalid-feedback">Debe ingresar Fecha de Salida</div>
                                    </div>
                                </div>
                                <!-- Columna para registro del tiempo de duracion internado el Paciente -->
                                <div class="col-12 col-lg-2">
                                    <div class="form-group mb-2">
                                        <label class="" for="iptTiempo_DuracionRegm"><i class="fas fa-plus-circle fs-6"></i>
                                            <span class="small">Duración en meses</span><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="iptTiempo_DuracionRegm"
                                            placeholder="Tiempo de duración" required>
                                    <!-- <div class="invalid-feedback">Debe ingresar el tiempo de duración</div>-->
                                    </div>
                                </div>
                            
                                <!-- Columna para registro de la cuota de Ingreso-->
                                <div class="col-12 col-lg-2">
                                    <div class="form-group mb-2">
                                        <label class="" for="iptCuota_IngresoRegm"><i
                                                class="fas fa-dollar-sign fs-6"></i> <span class="small">Cuota de Ingreso</span><span class="text-danger">*</span></label>
                                        <input type="number" min="0" class="form-control form-control-sm" id="iptCuota_IngresoRegm"
                                            placeholder="Cuota de Ingreso">
                                        <div class="invalid-feedback">Debe ingresar la Cuota de Ingreso</div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="form-group mb-2">
                                        <label class="" for="iptCuota_SemanalRegm"><i
                                                class="fas fa-dollar-sign fs-6"></i> <span class="small">Cuota Semanal</span><span class="text-danger">*</span></label>
                                        <input type="number" min="0" class="form-control form-control-sm" id="iptCuota_SemanalRegm"
                                            placeholder="Cuota de pago Semanal" required>
                                        <div class="invalid-feedback">Debe ingresar la Cuota de pago semanal</div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="form-group mb-2">
                                        <label class="" for="iptExtrasRegm"><i
                                                class="fas fa-dollar-sign fs-6"></i> <span class="small">Extras</span><span class="text-danger"></span></label>
                                        <input type="text" min="0" class="form-control form-control-sm" id="iptExtrasRegm"
                                            placeholder="Extras para Gastos Internos">
                                        <div class="invalid-feedback">Debe ingresar el dinero Extra</div>
                                    </div>
                                </div>
                                <!-- Columna para registro del Testigo -->
                                <div class="col-12 col-lg-4">
                                    <div class="form-group mb-2">
                                        <label class="" for="iptTestigoRegm"><i
                                                class="fas fa-minus-circle fs-6"></i> <span class="small">Testigo</span><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="iptTestigoRegm"
                                            placeholder="Testigo">
                                        <div class="invalid-feedback">Debe ingresar el Testigo</div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="form-group mb-2">
                                    <label class="" for="iptEstatusRegm"><i
                                                class="fas fa-minus-circle fs-6"></i> <span class="small">Estatus</span><span class="text-danger">*</span></label>
                                                <select name="estatus" class="form-control form-control-sm" id ="iptEstatusRegm" required>
                                                <option>Activo</option>
                                                <option>Baja</option>
                                                <option>Suspendido</option>
                                                </select>     
                                        <div class="invalid-feedback">Debe Seleccionar el estatus</div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-lg-2">
                                    <div class="form-group mb-2">
                                    <label class="" for="iptTipo_IngresoRegm"><i
                                                class="fas fa-minus-circle fs-6"></i> <span class="small">Tipo Ingreso</span><span class="text-danger">*</span></label>
                                                <select name="tipo_ingreso" class="form-control form-control-sm" id ="iptTipo_IngresoRegm" required>
                                                <option>Voluntario</option>
                                                <option>Involuntario</option>
                                                <option>Obligatorio</option>
                                                </select>     
                                        <div class="invalid-feedback">Debe Seleccionar el tipo de Ingreso</div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group mb-2">
                                        <label class="" for="iptRefiereRegm"><i
                                                class="fa fa-handshake-o"></i> <span class="small">Institucion que lo refiere</span><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="iptRefiereRegm"
                                            placeholder="Intitución de referencia">
                                        <div class="invalid-feedback">Debe ingresar la referencia</div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group mb-2">
                                        <label class="" for="iptMotivoRegm"><i
                                                class="fas fa-minus-circle fs-6"></i> <span class="small">Motivo del Ingreso</span><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="iptMotivoRegm"
                                            placeholder="Ingrese el motivo del Ingreso">
                                        <div class="invalid-feedback">Debe ingresar el motivo del Ingreso</div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2">
                                <div class="form-group mb-2">
                                        <label class="" for="iptFolio_MpRegm"><i
                                                class="fas fa-barcode fs-6"></i> <span class="small">Folio M.P.</span><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="iptFolio_MpRegm"
                                            placeholder="Ingrese el folio del M.P.">
                                        <div class="invalid-feedback">Debe ingresar el folio del M.P.</div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group mb-2">
                                        <label class="" for="iptOperadorRegm"><i
                                                class="fa fa-user-circle-o"></i> <span class="small">Operador M.P.</span><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="iptOperadorRegm"
                                            placeholder="Ingrese el nombre del Operador del M.P.">
                                        <div class="invalid-feedback">Debe ingresar el Operador del M.P.</div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="form-group mb-2">
                                        <label class="" for="iptDescripcion_SaludRegm"><i
                                                class="fa fa-heartbea"></i> <span class="small">Salud actual</span><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="iptDescripcion_SaludRegm"
                                            placeholder="Ingrese breve descripción de Salud">
                                        <div class="invalid-feedback">Debe ingresar una breve descripción de Salud</div>
                                    </div>
                                </div>
                                <div class="col-12  col-lg-4">
                                    <div class="form-group mb-2">
                                        <label class="" for="selDrogasRegm"><i class="fas fa-dumpster fs-6"></i>
                                            <span class="small">Sustancia de Consumo</span><span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                            id="selDrogasRegm">
                                        </select>
                                        <div class="invalid-feedback">Seleccione la sustancia de consumo</div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                 <div class="form-group mb-2">
                                        <label class="" for="iptMedicamentoRegm"><i
                                                class="fa fa-heartbea"></i> <span class="small">Medicamentos</span><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="iptMedicamentoRegm"
                                            placeholder="Ingrese medicamentos que consume">
                                        <div class="invalid-feedback">Debe ingresar algún medicamento que consuma</div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group mb-2">
                                        <label class="" for="iptTerapia_IndividualRegm"><i
                                                class="fa fa-heartbea"></i> <span class="small">Terapia Individual</span><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="iptTerapia_IndividualRegm"
                                            placeholder="Ingrese si recibe terapia Individual">
                                        <div class="invalid-feedback">Debe ingresar si recibe terapia Individual</div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                 <div class="form-group mb-2">
                                        <label class="" for="iptTerapia_OcupacionalRegm"><i
                                                class="fa fa-heartbea"></i> <span class="small">Terapia Ocupacional</span><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="iptTerapia_OcupacionalRegm"
                                            placeholder="Ingrese si recibe terapia Ocupacional">
                                        <div class="invalid-feedback">Debe ingresar si recibe terapia Ocupacional</div>
                                    </div>
                                </div>
                                
                        </div>
                        <!-- creacion de botones para cancelar y guardar el Expediente -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistrom">Cancelar</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarExpedientem">Modificar Expediente</button>
                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->
                       
                </form>
            
            
            
            </div>

        </div>
    </div>


</div>
<!-- /. Fin de Ventana Modal para ingreso de Expedientes de Pacientes -->

<!-- /.content -->
<!-- Ventana Modal para ingresar  los Expedientes de los Pacientes -->
<div class="modal fade" id="mdlGestionarExpedientesn" role="dialog">

        <div class="modal-dialog modal-xl">

            <!-- contenido del modal -->
            <div class="modal-content">

                    <!-- cabecera del modal -->
                    <div class="modal-header bg-gray py-1">

                        <h5 class="modal-title">Agregar otro Expediente a Paciente</h5>

                        <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModaln">
                            <i class="far fa-times-circle"></i>
                        </button>

                    </div>

                    <!-- cuerpo del modal EXPEDIENTE-->
                        <div class="modal-body">
                                <form class="needs-validation" novalidate >
                                    <!-- Abrimos una fila -->
                                        <div class="row">

                                                <!-- Columna para registro del Identificador del Expediente-->
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptId_ExpedienteRegn"><i class="fas fa-barcode fs-6"></i>
                                                            <span class="small">Número de Expediente</span><span class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" class="form-control form-control-sm" id="iptId_ExpedienteRegn"
                                                            name="iptId_Expediente" placeholder="Número de Expediente" disabled>
                                                        <div class="invalid-feedback">Debe ingresar el # de expediente</div>
                                                    </div>
                                                </div>
                                            
                                                <!-- Columna para registro del Nombre del Paciente -->
                                                <div class="col-12 col-lg-8">
                                                    <div class="form-group mb-2">
                                                    <label class="" for="selPacienteRegn"><i class="fas fa-dumpster fs-6"></i>
                                                            <span class="small">Nombre del Paciente</span><span class="text-danger">*</span>
                                                        </label>
                                                    <!--  <select class="form-control" data-live-search="true" id="selPacienteReg" name="selPacienteReg" required > -->
                                                    <select class="form-select  form-select-sm" data-live-search="true" aria-label=".form-select-sm example"
                                                            id="selPacienteRegn" disabled> 
                                                        </select>
                                                        <div class="invalid-feedback">Seleccione el Paciente</div>



                                                    <!--  <label class="" for="iptNombreReg"><i
                                                                class="fas fa-file-signature fs-6"></i> <span
                                                                class="small">Nombre del Paciente</span><span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-sm" id="iptNombreReg"
                                                            placeholder="Nombre del Paciente" required> -->
                                                    </div>
                                                </div>
                                                <!-- Columna para registro del Representante del Paciente -->
                                                <div class="col-12  col-lg-6">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="selRepresentanteRegn"><i class="fas fa-dumpster fs-6"></i>
                                                            <span class="small">Representante</span><span class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                                            id="selRepresentanteRegn">
                                                        </select>
                                                        <div class="invalid-feedback">Seleccione el representante del Paciente</div>
                                                    </div>
                                                </div>
                                                <!-- Columna para registro de firma del contrato-->
                                                <div class="col-12 col-lg-2">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptFirmo_ContratoRegn"> <span class="small">Firmó Contrato</span></label>
                                                        <input type="text" class="form-control form-control-sm" id="iptFirmo_ContratoRegn"
                                                        placeholder="Verificar si firmó Contrato">
                                                        <div class="invalid-feedback">Debe ingresar si firmó Contrato</div>
                                                    </div>
                                                </div>
                                                <!-- Columna para registro de la Fecha de Ingreso-->
                                            
                                                <div class="col-12 col-lg-2">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptFecha_IngresoRegn"><i
                                                        class="fa fa-calendar-plus-o"></i> <span class="small">Fecha de Ingreso</span>
                                                                <span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control form-control-sm" id="iptFecha_IngresoRegn"
                                                            placeholder="Fecha de Ingreso">
                                                        <div class="invalid-feedback">Debe ingresar Fecha de Ingreso</div>
                                                    </div>
                                                </div>
                                                <!-- Columna para registro de la Hora de Ingreso-->
                                            
                                                <div class="col-12 col-lg-2">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptHora_IngresoRegn"><i
                                                        class="fa fa-clock-o"></i> <span class="small">Hora de Ingreso</span>
                                                                <span class="text-danger">*</span></label>
                                                        <input type="time" class="form-control form-control-sm" id="iptHora_IngresoRegn"
                                                            placeholder="Hora de Ingreso">
                                                        <div class="invalid-feedback">Debe ingresar Hora de Ingreso</div>
                                                    </div>
                                                </div>
                                                <!-- Columna para registro de la fecha de salida -->
                                                <div class="col-12 col-lg-2">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptFecha_SalidaRegn"><i
                                                        class="fa-solid fa-calendar-days"></i> <span class="small">Fecha de Salida</span>
                                                                <span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control form-control-sm" id="iptFecha_SalidaRegn"
                                                            placeholder="Fecha de Salida">
                                                        <div class="invalid-feedback">Debe ingresar Fecha de Salida</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2" style="display:none;" >
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptFecha_SalidaRegna"><i
                                                        class="fa-solid fa-calendar-days"></i> <span class="small">Fecha de Salida</span>
                                                                <span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control form-control-sm" id="iptFecha_SalidaRegna"
                                                            placeholder="Fecha de Salida">
                                                        <div class="invalid-feedback">Debe ingresar Fecha de Salida</div>
                                                    </div>
                                                </div>
                                                <!-- Columna para registro del tiempo de duracion internado el Paciente -->
                                                <div class="col-12 col-lg-2">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptTiempo_DuracionRegn"><i class="fas fa-plus-circle fs-6"></i>
                                                            <span class="small">Duración en meses</span><span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-sm" id="iptTiempo_DuracionRegn"
                                                            placeholder="Tiempo de duración" required>
                                                    <!-- <div class="invalid-feedback">Debe ingresar el tiempo de duración</div>-->
                                                    </div>
                                                </div>
                                            
                                                <!-- Columna para registro de la cuota de Ingreso-->
                                                <div class="col-12 col-lg-2">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptCuota_IngresoRegn"><i
                                                                class="fas fa-dollar-sign fs-6"></i> <span class="small">Cuota de Ingreso</span><span class="text-danger">*</span></label>
                                                        <input type="number" min="0" class="form-control form-control-sm" id="iptCuota_IngresoRegn"
                                                            placeholder="Cuota de Ingreso">
                                                        <div class="invalid-feedback">Debe ingresar la Cuota de Ingreso</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptCuota_SemanalRegn"><i
                                                                class="fas fa-dollar-sign fs-6"></i> <span class="small">Cuota Semanal</span><span class="text-danger">*</span></label>
                                                        <input type="number" min="0" class="form-control form-control-sm" id="iptCuota_SemanalRegn"
                                                            placeholder="Cuota de pago Semanal" required>
                                                        <div class="invalid-feedback">Debe ingresar la Cuota de pago semanal</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptExtrasRegn"><i
                                                                class="fas fa-dollar-sign fs-6"></i> <span class="small">Extras</span><span class="text-danger"></span></label>
                                                        <input type="text" min="0" class="form-control form-control-sm" id="iptExtrasRegn"
                                                            placeholder="Extras para Gastos Internos">
                                                        <div class="invalid-feedback">Debe ingresar el dinero Extra</div>
                                                    </div>
                                                </div>
                                                <!-- Columna para registro del Testigo -->
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptTestigoRegn"><i
                                                                class="fas fa-minus-circle fs-6"></i> <span class="small">Testigo</span><span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-sm" id="iptTestigoRegn"
                                                            placeholder="Testigo">
                                                        <div class="invalid-feedback">Debe ingresar el Testigo</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <div class="form-group mb-2">
                                                    <label class="" for="iptEstatusRegn"><i
                                                                class="fas fa-minus-circle fs-6"></i> <span class="small">Estatus</span><span class="text-danger">*</span></label>
                                                                <select name="estatus" class="form-control form-control-sm" id ="iptEstatusRegn" required>
                                                                <option>Activo</option>
                                                                <option>Baja</option>
                                                                <option>Suspendido</option>
                                                                </select>     
                                                        <div class="invalid-feedback">Debe Seleccionar el estatus</div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12 col-lg-2">
                                                    <div class="form-group mb-2">
                                                    <label class="" for="iptTipo_IngresoRegn"><i
                                                                class="fas fa-minus-circle fs-6"></i> <span class="small">Tipo Ingreso</span><span class="text-danger">*</span></label>
                                                                <select name="tipo_ingreso" class="form-control form-control-sm" id ="iptTipo_IngresoRegn" required>
                                                                <option>Voluntario</option>
                                                                <option>Involuntario</option>
                                                                <option>Obligatorio</option>
                                                                </select>     
                                                        <div class="invalid-feedback">Debe Seleccionar el tipo de Ingreso</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptRefiereRegn"><i
                                                                class="fa fa-handshake-o"></i> <span class="small">Institucion que lo refiere</span><span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-sm" id="iptRefiereRegn"
                                                            placeholder="Intitución de referencia">
                                                        <div class="invalid-feedback">Debe ingresar la referencia</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptMotivoRegn"><i
                                                                class="fas fa-minus-circle fs-6"></i> <span class="small">Motivo del Ingreso</span><span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-sm" id="iptMotivoRegn"
                                                            placeholder="Ingrese el motivo del Ingreso">
                                                        <div class="invalid-feedback">Debe ingresar el motivo del Ingreso</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptFolio_MpRegn"><i
                                                                class="fas fa-barcode fs-6"></i> <span class="small">Folio M.P.</span><span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-sm" id="iptFolio_MpRegn"
                                                            placeholder="Ingrese el folio del M.P.">
                                                        <div class="invalid-feedback">Debe ingresar el folio del M.P.</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptOperadorRegn"><i
                                                                class="fa fa-user-circle-o"></i> <span class="small">Operador M.P.</span><span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-sm" id="iptOperadorRegn"
                                                            placeholder="Ingrese el nombre del Operador del M.P.">
                                                        <div class="invalid-feedback">Debe ingresar el Operador del M.P.</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-8">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptDescripcion_SaludRegn"><i
                                                                class="fa fa-heartbea"></i> <span class="small">Salud actual</span><span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-sm" id="iptDescripcion_SaludRegn"
                                                            placeholder="Ingrese breve descripción de Salud">
                                                        <div class="invalid-feedback">Debe ingresar una breve descripción de Salud</div>
                                                    </div>
                                                </div>
                                                <div class="col-12  col-lg-4">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="selDrogasRegn"><i class="fas fa-dumpster fs-6"></i>
                                                            <span class="small">Sustancia de Consumo</span><span class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                                            id="selDrogasRegn">
                                                        </select>
                                                        <div class="invalid-feedback">Seleccione la sustancia de consumo</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptMedicamentoRegn"><i
                                                                class="fa fa-heartbea"></i> <span class="small">Medicamentos</span><span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-sm" id="iptMedicamentoRegn"
                                                            placeholder="Ingrese medicamentos que consume">
                                                        <div class="invalid-feedback">Debe ingresar algún medicamento que consuma</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptTerapia_IndividualRegn"><i
                                                                class="fa fa-heartbea"></i> <span class="small">Terapia Individual</span><span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-sm" id="iptTerapia_IndividualRegn"
                                                            placeholder="Ingrese si recibe terapia Individual">
                                                        <div class="invalid-feedback">Debe ingresar si recibe terapia Individual</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-group mb-2">
                                                        <label class="" for="iptTerapia_OcupacionalRegn"><i
                                                                class="fa fa-heartbea"></i> <span class="small">Terapia Ocupacional</span><span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-sm" id="iptTerapia_OcupacionalRegn"
                                                            placeholder="Ingrese si recibe terapia Ocupacional">
                                                        <div class="invalid-feedback">Debe ingresar si recibe terapia Ocupacional</div>
                                                    </div>
                                                </div>
                                                
                                        </div>
                                        <!-- creacion de botones para cancelar y guardar el Expediente -->
                                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                                            data-bs-dismiss="modal" id="btnCancelarRegistron">Cancelar</button>
                                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                                            id="btnGuardarExpedienten">Guardar Expediente</button>
                                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->
                                    
                                </form>
                        </div>
            </div>
        </div>
<!-- 
<
/. Fin de Ventana Modal para ingreso de Expedientes de Pacientes -->

<!-- /.content -->
<!-- Ventana Modal para ingresar  los Expedientes de los Pacientes -->
<div class="modal fade" id="mdlGestionarExpedientesServiciosee" role="dialog">
    

    <div class="modal-dialog modal-xl">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Datos del servicio de atención</h5>

                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModalServicio">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal EXPEDIENTE-->
            <div class="modal-body">
                <form class="needs-validation" novalidate >
                    <!-- Abrimos una fila -->
                    <div class="row">

                        <!-- Columna para registro del Identificador del Expediente-->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptId_ExpedienteRegs"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Número de Expediente</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptId_ExpedienteRegs"
                                    name="iptId_Expediente" placeholder="Número de Expediente" disabled>
                                <div class="invalid-feedback">Debe ingresar el # de expediente</div>
                            </div>
                        </div>
                      
                        <!-- Columna para registro del Nombre del Paciente -->
                        <div class="col-12 col-lg-8">
                            <div class="form-group mb-2">
                            <label class="" for="selPacienteReg"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Nombre del Paciente</span><span class="text-danger">*</span>
                                </label>
                              <!--  <select class="form-control" data-live-search="true" id="selPacienteReg" name="selPacienteReg" required > -->
                              <input type="text" class="form-control form-control-sm" id="selPacienteReg"
                                 placeholder="Paciente" disabled>
                                <div class="invalid-feedback">Seleccione el Paciente</div>

                            </div>
                        </div>
                        <!-- Columna para registro del motivo de la atención médica -->
                        <div class="col-12  col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="selMotivo_AtencionReg"><i class="fas fa-dumpster fs-6"></i>
                                <span class="small">Motivo de Atención</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="iptMotivo_AtencionRegn"
                                 placeholder="Motivo de Atención">
                                 <div class="invalid-feedback">Debe ingresar el motivo de la atención</div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                         <!-- Columna para registro de Reporte de Lesiones-->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptReporte_LesionesRegn"> <span class="small">Reporte de lesiones</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptReporte_LesionesRegn"
                                 placeholder="Reporte de lesiones">
                                 <div class="invalid-feedback">Debe ingresar si cuenta con reporte de lesiones</div>
                            </div>
                        </div>
                        <!-- Columna para registro de fecha de la notificación-->
                    
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptFecha_NotificacionRegn"><i
                                class="fa fa-calendar-plus-o"></i> <span class="small">Fecha de notificación</span>
                                        <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="iptFecha_NotificacionRegn"
                                    placeholder="Fecha de la Notaficación">
                                <div class="invalid-feedback">Debe ingresar la Fecha de Notificación</div>
                            </div>
                        </div>
                        <!-- Columna para registro del diagnóstico-->
                    
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptDiagnosticoReg"><i
                                class="fa fa-clock-o"></i> <span class="small">Diagnóstico</span>
                                        <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptDiagnosticoReg"
                                    placeholder="Diagnóstico médico">
                                <div class="invalid-feedback">Debe ingresar el diagnóstico médico</div>
                            </div>
                        </div>
                           <!-- Columna para registro del plan terapéutico -->
                        
        
                        <!-- Columna para registro del pronóstico -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptPronosticoReg"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Pronóstico</span>
                                        <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptPronosticoReg"
                                    placeholder="Pronóstico">
                                <div class="invalid-feedback">Debe ingresar el pronóstico Médico</div>
                            </div>
                        </div>
                        
                        <!-- Columna para registro de la cédula del médico -->
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptCedula_MedicoReg"><i class="fas fa-plus-circle fs-6"></i>
                                    <span class="small">Cédula del médico</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptCedula_MedicoReg"
                                    placeholder="Cédula Profesional del Médico" required>
                               <!-- <div class="invalid-feedback">Debe ingresar el tiempo de duración</div>-->
                            </div>
                        </div>
                       <!-- Columna para registro del nombre del médico-->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-4">
                                <label class="" for="iptNombre_MedicoReg"><i
                                        class="fas fa-dollar-sign fs-6"></i> <span class="small">Nombre del Médico</span><span class="text-danger">*</span></label>
                                <input type="text" min="0" class="form-control form-control-sm" id="iptNombre_MedicoReg"
                                    placeholder="Nombre del Médico" required>
                                <div class="invalid-feedback">Debe ingresar el nombre del Médico</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la Duración promedio del servicio de atencion residencial-->
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptDuracion_ConsultaReg"><i
                                        class="fas calendar fs-6"></i> <span class="small">Duración promedio</span><span class="text-danger">*</span></label>
                                <input type="text"class="form-control form-control-sm" id="iptDuracion_ConsultaReg"
                                    placeholder="Duración promedio del servicio de atención">
                                <div class="invalid-feedback">Duración Promedio del Servicio de atención residencial</div>
                            </div>
                        </div>
                      
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptAgencia_MpReg"><i
                                        class="fas  fs-6"></i> <span class="small">Agencia del Ministerio Público</span><span class="text-danger"></span></label>
                                <input type="text" class="form-control form-control-sm" id="iptAgencia_MpReg"
                                    placeholder="Agencia del Ministerio Público">
                                <div class="invalid-feedback">Debe ingresar la Agencia del Ministerio Público</div>
                            </div>
                        </div>
                         <!-- Columna para registro de la Direccion de la Agencia del Ministerio Público -->
                         <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptDomicilio_AgenciaReg"><i
                                        class="fas fa-minus-circle fs-6"></i> <span class="small">Dirección de la Agencia</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptDomicilio_AgenciaReg"
                                    placeholder="Direccion de la Agencia del M.P">
                                <div class="invalid-feedback">Debe ingresar la dirección de la Agencia del M.P</div>
                            </div>
                        </div>
                       
                       
                        <!-- creacion de botones para cancelar y guardar el Expediente -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarExpedienteS">Guardar Expediente</button>
                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->
                    </div>
                   
                </form>
               
            </div>

        </div>
    </div>


</div>

<!-- /.content -->
<!-- Ventana Modal para modificar los Expedientes de los Pacientes -->
<div class="modal fade" id="mdlGestionarExpedientesServicio" role="dialog">

    <div class="modal-dialog modal-xl">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Modificar Expediente de Pacientes</h5>

                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModalm">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal EXPEDIENTE-->
            <div class="modal-body">
                <form class="needs-validation" novalidate >
                    <!-- Abrimos una fila -->
                    <div class="row">

                                <!-- Columna para registro del Identificador del Expediente-->
                                <div class="col-12 col-lg-4">
                                    <div class="form-group mb-2">
                                        <label class="" for="iptId_ExpedienteRegpm"><i class="fas fa-barcode fs-6"></i>
                                            <span class="small">Número de Expediente</span><span class="text-danger">*</span>
                                        </label>
                                        <input type="number" class="form-control form-control-sm" id="iptId_ExpedienteRegpm"
                                            name="iptId_Expedientepm" placeholder="Número de Expediente" disabled>
                                        <div class="invalid-feedback">Debe ingresar el # de expediente</div>
                                    </div>
                                </div>
                            
                             
                        </div>
                        <!-- creacion de botones para cancelar y guardar el Expediente -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistropm">Cancelar</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarExpedientepm">Modificar Expediente</button>
                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->
                       
                </form>
            
            
            
            </div>

        </div>
    </div>


</div>
