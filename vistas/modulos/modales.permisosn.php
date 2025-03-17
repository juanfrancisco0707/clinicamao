<!-- /.content -->
<!-- Ventana Modal para ingresar  los Permisos de los Permisos  -lg-->
<div class="modal fade" id="mdlGestionarPermisos" role="dialog">

    <div class="modal-dialog modal-xl">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Agregar Permisos</h5>
                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal PERMISOS-->
            <div class="modal-body">
    
                <form class="needs-validation" novalidate >
                    <!-- Abrimos una fila -->
                    <div class="row">

                        <!-- Columna para registro del Identificador del Persmiso-->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptIdReg"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Identificador</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptIdReg"
                                    name="iptId" placeholder="Número de Permiso">
                                <div class="invalid-feedback">Debe ingresar el # de Permiso</div>
                            </div>
                        </div>
                      
                        <!-- Columna para registro del Nombre del Permiso -->
                        <div class="col-12">
                            <div class="form-group mb-2">
                            <label class="" for="selRolReg"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Nombre del Rol</span><span class="text-danger">*</span>
                                </label>
                               <select class="form-select  form-select-sm" data-live-search="true" aria-label=".form-select-sm example"
                                    id="selRolReg" require> 
                                </select>
                                <div class="invalid-feedback">Seleccione el Rol</div>
                            </div>
                        </div>
                        <!-- Columna para registro del módulo -->
                        <div class="col-12  col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="selModuloReg"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Modulo</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selModuloReg">
                                </select>
                                <div class="invalid-feedback">Seleccione el Modulo del Permiso</div>
                            </div>
                        </div>
                         <!-- Columna para registro de consultas-->
                                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptConsultarReg"> <span class="small">Consultar</span></label>
                                <select name="Consultar" class="form-control form-control-sm" id ="iptConsultarRegm" required>
                                         <option>Si</option>
                                         <option>No</option>
                                         </select>     
                                 <div class="invalid-feedback">Debe Seleccionar opción</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la grabar-->
                    
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptGrabarReg"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Grabar</span>
                                        <span class="text-danger">*</span></label>
                                        <select name="grabar" class="form-control form-control-sm" id ="iptGrabarRegm" required>
                                         <option>Si</option>
                                         <option>No</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar opción</div>
                            </div>
                        </div>
                        <!-- Columna para registro de actualizar-->
                    
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptActualizarReg"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Modificar</span>
                                        <span class="text-danger">*</span></label>
                                        <select name="actualizar" class="form-control form-control-sm" id ="iptActualizarRegm" required>
                                         <option>Si</option>
                                         <option>No</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar opción</div>
                            </div>
                        </div>
                        <!-- Columna para registro de Eliminar -->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptEliminar_SalidaReg"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Eliminar</span>
                                        <span class="text-danger">*</span></label>
                                        <select name="estatus" class="form-control form-control-sm" id ="iptEliminarRegm" required>
                                         <option>Si</option>
                                         <option>No</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar opción</div>
                            </div>
                        </div>
                      
                         
                        </div>
                        <!-- creacion de botones para cancelar y guardar el Permiso -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarPermiso">Guardar</button>
                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->
                        </div>
                    </div>
                </form>
            
            </div>

        </div>
    </div>


</div>
<!-- /. Fin de Ventana Modal para ingreso de Permisos de Permisos -->
