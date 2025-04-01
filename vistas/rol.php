<!-- Content Header -->
    <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Roles</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Roles</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->
 <!-- Main content -->

    <div class="content">

    <div class="container-fluid">
    <!-- row para listado de Roles -->
        <div class="row">
            <div class="col-lg-6">
                <table id="tbl_Roles" class="table table-striped w-100 shadow">
                <thead class="bg-info">
                    <tr style="font-size: 12px;">
                        <th></th>
                        <th>id</th>
                        <th>Nombre del Rol</th>
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
    <!-- Ventana Modal para ingresar o modificar un Roles -->
    <div class="modal fade" id="mdlGestionarRol" role="dialog">

    <div class="modal-dialog modal-lg">

    <!-- contenido del modal -->
        <div class="modal-content">

        <!-- cabecera del modal -->
         <div class="modal-header bg-gray py-1">

            <h5 class="modal-title">Agregar Roles</h5>

            <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                <i class="far fa-times-circle"></i>
            </button>

         </div>

        <!-- cuerpo del modal -->
        <div class="modal-body">

            <form class="needs-validation" novalidate >
                <!-- Abrimos una fila -->
                <div class="row">

                    <!-- Columna para registro del Identificador -->
                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-2">
                            <label class="" for="iptIdReg"><i class="fas fa-barcode fs-6"></i>
                                <span class="small">Identificador</span><span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control form-control-sm" id="iptIdReg"
                                name="iptId" placeholder="Identificador" required>
                            <div class="invalid-feedback">Debe ingresar el Identificador de el Rol</div>
                        </div>
                    </div>

                   
                    <!-- Columna para registro del Nombre de la Rol-->
                    <div class="col-12">
                        <div class="form-group mb-2">
                            <label class="" for="iptNombre_RolReg"><i
                                    class="fas fa-file-signature fs-6"></i> <span
                                    class="small">Nombre</span><span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="iptNombre_RolReg"
                                placeholder="Nombre" required>
                            <div class="invalid-feedback">Debe ingresar el nombre</div>
                        </div>
              
                        <!-- creacion de botones para cancelar y guardar el Rol -->
                     <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                        data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                     <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                        id="btnGuardarRol">Guardar</button>
                    </div>
                </div>
            </form>
        
        </div>

    </div>
    </div>
  <!-- </div> -->


<!-- /. Fin de Ventana Modal para ingreso de los Roles -->
<?php
       include "../vistas/modulos/modales.permisosn.php";
?>
<script>
var accion;
var table;
var tablep;
var vid_rol;

/*===================================================================*/
//INICIALIZAMOS EL MENSAJE DE TIPO TOAST (EMERGENTE EN LA PARTE SUPERIOR)
/*===================================================================*/
var Toast = Swal.mixin({
toast: true,
position: 'top',
showConfirmButton: false,
timer: 3000
});
$(document).ready(function() {
    /* ******************************************************************************************* */

    /*===================================================================*/
    // CARGA DEL LISTADO CON EL PLUGIN DATATABLE JS
    /*===================================================================*/
    table = $("#tbl_Roles").DataTable({
     dom: 'Bfrtip', // Para que los botones se pongan en la parte Superior
        buttons: [{
                text: 'Agregar Roles',
                className: 'addNewRecord',
                action: function(e, dt, node, config) {
                    $("#mdlGestionarRol").modal('show');
                   accion = 2; //registrar
                }
            },
            {
                extend: 'excel',
                text: 'Excel',
                title: 'Listado de Roles de los Usuarios'
            },
            {
                extend: 'print', 
                text: 'Imprimir',
                title: 'Listado de Roles de los Usuarios'},
            {
                extend:'pageLength',
                text: 'Longitud de la página'
            }           
        ],
        pageLength: [[5, 10, 15, 30, 50], 
                    ['5 Filas','10 Filas','15 Filas','30 Filas','50 Filas','Mostrar todo']], 
        pageLength: 10,
        ajax: {
         url: "../ajax/rol.ajax.php",
            dataSrc: '',
            type: "POST",
            data: {
                'accion': 1 //1: LISTAR Roles
        },
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
            targets: 3,
            orderable: false,
            render: function(data, type, full, meta) {
                return "<center>" +
                    "<span class='btnPermisosRol text-success px-1' style='cursor:pointer;'>" +
                        "<i class='fa fa-key' aria-hidden='true' onclick='editar_modal('.$row['id'].')'></i>" +
                        "</span>" +
                       
                    "<span class='btnEditarRol text-primary px-1' style='cursor:pointer;'>" +
                    "<i class='fas fa-pencil-alt fs-5'></i>" +
                    "</span>" +
                    "<span class='btnEliminarRol text-danger px-1' style='cursor:pointer;'>" +
                    "<i class='fas fa-trash fs-5'></i>" +
                    "</span>" +
                    "</center>"
            }
        }
    ],
    //fixedColumns: true,
    language: {
       // url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
         "url": "../vistas/assets/json/Spanish.json"
        // con esto se cambia al idioma español de los elementos del datatable
    }
    });

    $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {

    $("#validate_Id").css("display", "none");
    $("#validate_Nombre_Rol").css("display", "none");

    $("#iptIdReg").val("");
    $("#iptNombre_RolReg").val("");
    })

    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON EDITAR ROLES
    =========================================================================================*/
$('#tbl_Roles tbody').on('click', '.btnEditarRol', function() {

    accion = 4; //seteamos la accion para editar

    $("#mdlGestionarRol").modal('show');

    var data = table.row($(this).parents('tr')).data();
    console.log("🚀 ~ file: Roles.php ~ line 220 ~ $ ~ data", data)
    
    $("#iptIdReg").val(data["id"]);
    $("#iptNombre_RolReg").val(data["nombre_rol"]);

    })
    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON ASIGNAR PERMISOS A LOS ROLES
    =========================================================================================*/
$('#tbl_Roles tbody').on('click', '.btnPermisosRol', function() {
    accion = 7; 
    $("#mdlGestionarPermisos").modal('show');
    var data = table.row($(this).parents('tr')).data();
    //vid_rol = data["id"];  
    console.log("🚀 ~ file: Roles.php ~ line 240 ~ $ ~ data", data)
    console.log(vid_rol);
    $("#iptIdReg").val(data["id"]);
   // $("#iptNombre_RolReg").val(data["nombre_rol"]);       
    })

    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON ELIMINAR Rol
    =========================================================================================*/
$('#tbl_Roles tbody').on('click', '.btnEliminarRol', function() {
    
    accion = 5; //seteamos la accion para editar
    
    var data = table.row($(this).parents('tr')).data();
    var id = data["id"];

    Swal.fire({
        title: 'Está seguro de eliminar el Rol?',
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
            datos.append("id", id); //id_Roles             

            $.ajax({
                url: "../ajax/rol.ajax.php",
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
                            title: 'El Rol se eliminó correctamente'
                        });

                        table.ajax.reload();

                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'el Rol no se pudo eliminar'
                        });
                    }

                }
            });

         }
        })
    })
   // TABLA DE PERMISOS 

   



});


/*===================================================================*/
//EVENTO QUE GUARDA LOS DATOS DEL REPRESENTANTE, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/
document.getElementById("btnGuardarRol").addEventListener("click", function() {

// Get the forms we want to add validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {

    if (form.checkValidity() === true) {   

       // console.log("Listo para registrar el Rol")
             if(accion == 4){
                    var titulo_msj = "El Rol se actualizó correctamente";
                    var tituloswal ="Está seguro de Modificar el Rol?";
                    var titulobutton ="Si, deseo modificarlo!";
                }
                if(accion == 2){
                    var titulo_msj = "El Rol se registró correctamente";
                    var tituloswal ="Está seguro de guardar el Rol?";
                    var titulobutton ="Si, deseo registrarlo!";
                }
        Swal.fire({
            title: tituloswal,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: titulobutton,
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var datos = new FormData();

                datos.append("accion", accion);
                datos.append("id", $("#iptIdReg").val()); //id
                datos.append("nombre_rol", $("#iptNombre_RolReg").val()); //Nombre_Rol
                $.ajax({
                    url: "../ajax/rol.ajax.php",
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
                            $("#mdlGestionarRol").modal('hide');
                            
                            $("#iptNombre_RolReg").val("");
                            

                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'El Rol no se pudo registrar'
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

</script>