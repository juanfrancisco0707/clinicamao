<div class="modal fade" id= "mdlGestionarPermisos" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title h4" >Permisos Roles de Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="modal-body">
            <?php 
                //dep($data);
             ?>
            <div class="col-md-12">
              <div class="tile">
                <form action="" id="formPermisos" name="formPermisos">
                 <!-- <input type="hidden" id="idrol" name="idrol" value="" required=""> -->
                    <div class="table-responsive">
                      <table id="tbl_Permisos" class="table">
                        <thead>
                          <tr>                         
                            <th>#</th>
                            <th>id_rol</th>
                            <th>Nombre_rol</th>
                            <th>id_modulo</th>
                            <th>Módulo</th>
                            <th>Ver</th>
                            <th>Crear</th>
                            <th>Actualizar</th>
                            <th>Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>
                   
                        </tbody>
                      </table>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle" aria-hidden="true"></i> Guardar</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="app-menu__icon fas fa-sign-out-alt" aria-hidden="true"></i> Salir</button>
                    </div>
                </form>
              </div>
            </div>
        </div>
      </div>
  </div>
</div>

<script>

var tablep;

var Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000
});

$(document).ready(function(){

 // codigo_producto = $("#stock_codigoProducto").html();
    tablep = $('#tbl_Permisos').DataTable({
      dom: '',
        ajax: {
         url: "../ajax/permisos.ajax.php",
            dataSrc: '',
            type: "POST",
            data: {
              id_rol: id,
                'accion': 7 //1: LISTAR PERMISOS
        },
    },
        columnDefs: [{
                targets: 0,
               
            },
            {
                targets: 1,
                visible: false
            },
            {
                targets: 2,
                visible: false
            },
            {
                targets: 3,
                orderable: false
            }
        ],
        "order": [
            [0, 'desc']
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
    });

    
  


})//FIN DOCUMENT READY

</script>