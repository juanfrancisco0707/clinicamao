<!-- /.content -->
<!-- Ventana Modal para ingresar  los Periodos de pago de los Pacientes  -lg-->
<div class="modal fade" id="mdlGestionarPeriodos" role="dialog">

    <div class="modal-dialog modal-xl">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Agregar Períodos de Pago</h5>

                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal -->
            <div class="modal-body">
    
                <form class="needs-validation" novalidate >
                    <!-- Abrimos una fila -->
                    <div class="row">
                    <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptIdReg"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Número de período</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptIdReg"
                                    name="iptIdReg" placeholder="Número" required>
                                <div class="invalid-feedback">Número</div>
                            </div>
                        </div>
                        <!-- Columna para registro del Identificador del Expediente-->
                        <div class="col-12 col-lg-6">
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
                        <div class="col-12">
                            <div class="form-group mb-2">
                       
                                 <label class="" for="iptNombreReg"><i
                                        class="fas fa-file-signature fs-6"></i> <span
                                        class="small">Nombre del Paciente</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptNombreReg"
                                    placeholder="Nombre del Paciente" disabled> 
                            </div>
                        </div>
                
                        <!-- Columna para registro de la Fecha de Ingreso-->
                    
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptFecha_InicialReg"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Fecha de Inicial</span>
                                        <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="iptFecha_InicialReg"
                                    placeholder="Fecha Inicial">
                                <div class="invalid-feedback">Debe ingresar Fecha de Ingreso</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la Hora de Ingreso-->
                    
                
                        <!-- Columna para registro de la fecha de salida -->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptFecha_FinalReg"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Fecha de Final</span>
                                        <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="iptFecha_FinalReg"
                                    placeholder="Fecha de Final">
                                <div class="invalid-feedback">Debe ingresar Fecha de Salida</div>
                            </div>
                        </div>
                        <!-- Columna para registro del tiempo de duracion internado el Paciente -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptPagoReg"><i class="fas fa-plus-circle fs-6"></i>
                                    <span class="small">Pago</span><span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" id="iptPagoReg"
                                    placeholder="Pago" disabled>
                               <!-- <div class="invalid-feedback">Debe ingresar el tiempo de duración</div>-->
                            </div>
                        </div>
                    
                        <!-- Columna para registro del saldo-->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptSaldoReg"><i
                                        class="fas fa-dollar-sign fs-6"></i> <span class="small">Saldo</span><span class="text-danger">*</span></label>
                                <input type="number" min="0" class="form-control form-control-sm" id="iptSaldoReg"
                                    placeholder="Saldo" disabled>
                                <div class="invalid-feedback">Saldo</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                            <label class="" for="iptEstatusReg"><i
                                        class="fas fa-minus-circle fs-6"></i> <span class="small">Estatus</span><span class="text-danger">*</span></label>
                                        <select name="estatus" class="form-control form-control-sm" id ="iptEstatusReg" required>
                                         <option>Pendiente</option>
                                         <option>Pagado</option>
                                         <option>Abono</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar el estatus</div>
                            </div>
                        </div>
                         <!-- Columna para registro de la Fecha de Salida-->
                    
                         
                        </div>
                        <!-- creacion de botones para cancelar y guardar el Expediente -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarPeriodo">Guardar</button>
                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->
                        </div>
                    </div>
                </form>
            
            </div>

        </div>
    </div>


</div>
<!-- /. Fin de Ventana Modal para ingreso de Expedientes de Pacientes -->
<!-- /.content -->
<!-- Ventana Modal para ingresar  los Periodos de pago de los Pacientes  -lg-->
<div class="modal fade" id="mdlGestionarPeriodosM" role="dialog">

    <div class="modal-dialog modal-xl">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Modificar Períodos de Pago</h5>

                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModalm">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal -->
            <div class="modal-body">
    
                <form class="needs-validation" novalidate >
                    <!-- Abrimos una fila -->
                    <div class="row">
                    <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptIdRegm"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Número de período</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptIdRegm"
                                    name="iptIdRegm" placeholder="Número" disabled>
                                <div class="invalid-feedback">Número</div>
                            </div>
                        </div>
                        <!-- Columna para registro del Identificador del Expediente-->
                        <div class="col-12 col-lg-6">
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
                        <div class="col-12">
                            <div class="form-group mb-2">
                       
                                 <label class="" for="iptNombreRegm"><i
                                        class="fas fa-file-signature fs-6"></i> <span
                                        class="small">Nombre del Paciente</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptNombreRegm"
                                    placeholder="Nombre del Paciente" disabled> 
                            </div>
                        </div>
                
                        <!-- Columna para registro de la Fecha de Ingreso-->
                    
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptFecha_InicialRegm"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Fecha de Inicial</span>
                                        <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="iptFecha_InicialRegm"
                                    placeholder="Fecha Inicial">
                                <div class="invalid-feedback">Debe ingresar Fecha de Ingreso</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la Hora de Ingreso-->
                    
                
                        <!-- Columna para registro de la fecha de salida -->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptFecha_FinalRegm"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Fecha de Final</span>
                                        <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="iptFecha_FinalRegm"
                                    placeholder="Fecha de Final">
                                <div class="invalid-feedback">Debe ingresar Fecha de Salida</div>
                            </div>
                        </div>
                        <!-- Columna para registro del tiempo de duracion internado el Paciente -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptPagoRegm"><i class="fas fa-plus-circle fs-6"></i>
                                    <span class="small">Pago</span><span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" id="iptPagoRegm"
                                    placeholder="Pago" disabled>
                               <!-- <div class="invalid-feedback">Debe ingresar el tiempo de duración</div>-->
                            </div>
                        </div>
                    
                        <!-- Columna para registro de la cuota de Ingreso-->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptSaldoRegm"><i
                                        class="fas fa-dollar-sign fs-6"></i> <span class="small">Saldo</span><span class="text-danger">*</span></label>
                                <input type="number" min="0" class="form-control form-control-sm" id="iptSaldoRegm"
                                    placeholder="Saldo" disabled>
                                <div class="invalid-feedback">Saldo</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                            <label class="" for="iptEstatusRegm"><i
                                        class="fas fa-minus-circle fs-6"></i> <span class="small">Estatus</span><span class="text-danger">*</span></label>
                                        <select name="estatus" class="form-control form-control-sm" id ="iptEstatusRegm" required>
                                         <option>Pendiente</option>
                                         <option>Pagado</option>
                                         <option>Abono</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar el estatus</div>
                            </div>
                        </div>
                         <!-- Columna para registro de la Fecha de Salida-->
                    
                         
                        </div>
                        <!-- creacion de botones para cancelar y guardar el Expediente -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistrom">Cancelar</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarPeriodom">Guardar</button>
                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->
                        </div>
                    </div>
                </form>
            
            </div>

        </div>
    </div>


</div>