<style>
    .dataTables_filter{
        float: left !important;
    }
</style>
<div class="modal fade" id="mdlGestionarExpedientes" role="dialog">

    <div class="modal-dialog" style="max-width: 1350px!important;">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Buscar Expediente de Pacientes</h5>

                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal EXPEDIENTE-->
            <div class="modal-body">
    
                <form class="needs-validation" novalidate >
                    <!-- Abrimos una fila -->
                    <div class="row">

                    <div class="col-lg-12">
            <table id="tbl_expedientes" class="table table-striped w-100 shadow">
                <thead class="bg-info">
                    <tr role="row" style="font-size: 11px;">
                        <th></th>
                        <th>No.</th>
                        <th>No.Clínica</th>
                        <th>Id Paciente</th>
                        <th>Paciente</th>
                        <th>Id Representante</th>
                        <th>Representante</th>
                        <th>Teléfono</th>
                        <th>Fecha de ingreso</th>
                        <th>Hora de ingreso</th>
                        <th>Fecha de salida</th>
                        <th>Tiempo de duración</th>
                        <th>Firmó contrato</th> 
                        <th>Cuota de ingreso</th>
                        <th>Cuota semanal</th>
                        <th>Extras</th>
                        <th>Testigo</th>
                        <th>Estatus</th>
                        <th class="text-center">Seleccionar</th>
                       
                    </tr>
                </thead>
                <tbody class="text-small">
                </tbody>
            </table>
        </div>





                         
                       
                                        
                    </div>
                </form>
            
            </div>

        </div>
    </div>


</div>
<!-- /. Fin de Ventana Modal para ingreso de Expedientes de Pacientes -->

