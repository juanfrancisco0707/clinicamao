
<!-- Content Header (Page header) -->
<div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Usuarios</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Usuarios</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->
 
<div class="container-fluid"> 
 <!-- DataTable de Usuarios headers -->
        <div class="col-lg-12">
            <table id="tbl_usuarios" class="table table-striped w-100 shadow">
                <thead class="bg-info">
                    <tr style="font-size: 12px;">
                        <th></th>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Correo</th>
                        <th>Rol Id</th>
                        <th>Roles</th>
                        <th>Estatus</th>
                        <th>Id Clínica</th>
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
<!-- Ventana Modal para ingresar o modificar los Usuarios de los Pacientes -->
<div class="modal fade" id="mdlGestionarUsuarios" role="dialog">

    <div class="modal-dialog modal-lg">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Modificar el Perfil del Usuario</h5>

                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal de Usuarios-->
            <div class="modal-body">
                <form class="needs-validation" novalidate >
                    <!-- Abrimos una fila -->
                    <div class="row">

                        <!-- Columna para registro del Identificador del Usuario-->
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_IdReg"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Identificador</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="iptUsu_IdReg"
                                    name="iptUsu_Id" placeholder="# del Usuario" disabled>
                                <div class="invalid-feedback">Debe ingresar el # del usuario</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_Nombre_CompletoReg"><i
                                class="fa-solid fa-calendar-days"></i> <span class="small">Nombre Completo</span>
                                        <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptUsu_Nombre_CompletoReg"
                                    placeholder="Nombre completo"  disabled>
                                <div class="invalid-feedback">Debe ingresar el Nombre Completo</div>
                            </div>
                        </div>
                         <!-- Columna para registro del Usuario login -->
                        <div class="col-12 col-lg-12">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_nombreReg"><i class="fa fa-user" aria-hidden="true"></i>
                                    <span class="small">Usuario</span><span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="iptUsu_NombreReg"
                                    name="iptUsu_Nombre" placeholder="Usuario para login" disabled>
                                <div class="invalid-feedback">Debe ingresar el nombre del usuario</div>
                            </div>
                        </div>

                        <!-- Columna para registro del password del Usuario-->
                       <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_ContrasenaReg"><i class="fa fa-unlock" aria-hidden="true"></i>
                                    <span class="small">Contraseña Actual</span><span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control form-control-sm" id="iptUsu_ContrasenaReg"
                                    name="iptUsu_Contrasena" placeholder="Ingrese Contraseña Actual" required>
                                <div class="invalid-feedback">Debe ingresar la contraseña</div>
                            </div>
                        </div>
                          <!-- Columna para registro del password del Usuario-->
                       <div class="col-12 col-lg-6" style="display:none;">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_ContrasenaPasoReg"><i class="fa fa-unlock" aria-hidden="true"></i>
                                    <span class="small">Contraseña Actual</span><span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control form-control-sm" id="iptUsu_ContrasenaPasoReg"
                                    name="iptUsu_ContrasenaPaso" placeholder="Contraseña" disabled>
                                <div class="invalid-feedback">Debe ingresar la contraseña</div>
                            </div>
                        </div>
                        <!-- Columna para registro del password del Usuario-->
                       <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_ContrasenaNuevaReg"><i class="fa fa-unlock" aria-hidden="true"></i>
                                    <span class="small">Contraseña Nueva</span><span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control form-control-sm" id="iptUsu_ContrasenaNuevaReg"
                                    name="iptUsu_ContrasenaNueva" placeholder="Ingrese Contraseña nueva" required>
                                <div class="invalid-feedback">Debe ingresar la contraseña Nueva</div>
                            </div>
                        </div>
                      
                        <!-- Columna para registro del password del Usuario-->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_Repetir_ContrasenaReg"><i class="fa fa-unlock" aria-hidden="true"></i>
                                    <span class="small">Repetir Contraseña</span><span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control form-control-sm" id="iptUsu_Repetir_ContrasenaReg"
                                    name="iptUsu_Repetir_Contrasena" placeholder="Repetir Contraseña nueva" required>
                                <div class="invalid-feedback">Confirmar contraseña</div>
                            </div>
                        </div>
                      

                        <!-- Columna para registro del Rol -->
                        <div class="col-12 col-lg-4" style="display:none;">
                            <div class="form-group mb-2">
                            <label class="" for="selRolReg"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Rol</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selRolReg" disabled>
                                </select>
                                <div class="invalid-feedback">Seleccione el Rol</div>
                        </div>
                        </div>
                        <!-- Columna para registro del Estatus -->
                         <div class="col-12 col-lg-2" style="display:none;">
                            <div class="form-group mb-2">
                            <label class="" for="iptUsu_EstatusReg"><i class="fas fa-minus-circle fs-6"></i>
                                     <span class="small">Estatus</span><span class="text-danger">*</span></label>
                                        <select name="estatus" class="form-control form-control-sm" id ="iptUsu_EstatusReg" disabled>
                                         <option>Activo</option>
                                         <option>Inactivo</option>
                                         </select>     
                                <div class="invalid-feedback">Debe Seleccionar el estatus</div>
                            </div>
                        </div>
                         <!-- Columna para registro deL Correo-->
                         <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsu_CorreoReg"><i class="fa fa-envelope" aria-hidden="true"></i> <span class="small">Correo</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptUsu_CorreoReg"
                                 placeholder="Correo" require>
                                 <div class="invalid-feedback">Debe ingresar el correo</div>
                            </div>
                        </div>
                          
                        
                       
                        <!-- Columna para registro la Clínica-->
                        <div class="col-8" style="display:none;">
                            <div class="form-group mb-2">
                                 <label class="" for="selEmpresaReg"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Clínica</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selEmpresaReg" disabled>
                                </select>
                                <div class="invalid-feedback">Seleccione la empresa</div>                        
                            </div> <!-- Columna para registro de la foto-->
                        </div>
                        </div>
                       

                            <!-- creacion de botones para cancelar y guardar el Usuario -->
                            <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                            <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarUsuario">Guardar</button>
                        </div>

                    </div>
                </form>
            
            </div>

        </div>
    </div>


</div>
<!-- /. Fin de Ventana Modal para ingreso de Expedientes de Pacientes -->



<script>
var accion;
var table;
var fecha;
var contra;
var retorno;

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
    /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT DE ROLES
    /*===================================================================*/
    $.ajax({
        url: "../ajax/rolcb.ajax.php",
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {

            var options = '<option selected value="">Seleccione un rol</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selRolReg").append(options);
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

            var options = '<option selected value="">Seleccione la clínica</option>';

            for (let index = 0; index < respuesta.length; index++) {
                options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                    1
                ] + '</option>';
            }

            $("#selEmpresaReg").append(options);
        }
    });

/*===================================================================*/
// CARGA DEL LISTADO CON EL PLUGIN DATATABLE JS
/*===================================================================*/

    table = $("#tbl_usuarios").DataTable({
         // Para que los botones se pongan en la parte Superior
         "bPaginate": false, "bFilter": false, "bInfo": false,
        ajax: {
            url: "../ajax/usuarios.ajax.php",
            dataSrc: '',
            type: "POST",
            data: {
                'accion': 77 //1: LISTAR USUARIO PERFIL
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
                className: 'control',
                visible: false 
            },
            {
               targets: 4, // no muestra el correo
               visible: false 
            },
            {
                targets: 6, // no muestra el id del rol
                visible: false 
            }, 
            {
                targets: 8, // 
                visible: false 
            },
           {
                targets: 9, // no muestra el id del rol
                visible: false 
            },
            {
                targets: 10, // no muestra el id del rol
                visible: false 
            },
            {
                targets: 11,
                orderable: false,
                render: function(data, type, full, meta) {
                    return "<center>" +
                         
                        "<span class='btnEditarUsuario text-success px-1' style='cursor:pointer;'>" +
                        "<i class='fas fa-pencil-alt fs-5'></i>" +
                        "</span>" +
                        
                        "</center>"
                }
            }

        ],
        //fixedColumns: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            // con esto se cambia al idioma español de los elementos del datatable
        }
    });
    $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {

        $("#validate_Usu_Id").css("display", "none");
        $("#validate_Usu_Nombre").css("display", "none");
        $("#validate_Usu_Contrasena").css("display", "none");
        $("#validate_Usu_Repetir_Contrasena").css("display", "none");
        $("#validate_Rol_Id").css("display", "none");
        $("#validate_Usu_Estatus").css("display", "none");
        $("#validate_Usu_Correo").css("display", "none");
        $("#validate_Usu_Nombre_Completo").css("display", "none");
        $("#validate_Usu_Clinica").css("display", "none");
       
        $("#iptUsu_IdReg").val("");
        $("#iptUsu_NombreReg").val("");
        $("#iptUsu_ContrasenaReg").val("");
        $("#iptUsu_Repetir_ContrasenaReg").val("");
        $("#selRolReg").val(0);
        $("#iptUsu_EstatusReg").val("");
        $("#iptUsu_CorreoReg").val("");
        $("#iptUsu_Nombre_CompletoReg").val("");
        $("#selEmpresaReg").val("");
      
    })
   
    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON EDITAR USUARIO
    =========================================================================================*/
    $('#tbl_usuarios tbody').on('click', '.btnEditarUsuario', function() {

        accion = 4; //seteamos la accion para editar

        $("#mdlGestionarUsuarios").modal('show');

        var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }
        console.log("🚀 ~ file: usuarios.php ~ line 642 ~ $ ~ data", data)
       
        $("#iptUsu_IdReg").val(data[1]);
        $("#iptUsu_NombreReg").val(data["usu_nombre"]);
      //  $("#iptUsu_ContrasenaReg").val(data["usu_contrasena"]);
        $("#iptUsu_ContrasenaPasoReg").val(data["usu_contrasena"]);
    
        $("#selRolReg").val(data[6]); // se pone el id
        $("#iptUsu_EstatusReg").val(data["usu_estatus"]);
        $("#iptUsu_CorreoReg").val(data["usu_correo"]);
        $("#iptUsu_Nombre_CompletoReg").val(data["usu_nombre_completo"]);
        $("#selEmpresaReg").val(data[9]);
    })
});

/*===================================================================*/
//EVENTO QUE GUARDA LAS MODIFICACIONES DE LOS DATOS DEL USUARIO, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/
document.getElementById("btnGuardarUsuario").addEventListener("click", function() {
                         
                         // Get the forms we want to add validation styles to
                         var forms = document.getElementsByClassName('needs-validation');
                         // Loop over them and prevent submission
                         var validation = Array.prototype.filter.call(forms, function(form) {
                             if (validarpass()){
                                var contra_actual=$("#iptUsu_ContrasenaReg").val();
                                  var contra_paso = $("#iptUsu_ContrasenaPasoReg").val();
                                  var datosc = new FormData();

                                    datosc.append("accion", 78);
                                    datosc.append("contra_actual", contra_actual); //Usu_id             
                                    datosc.append("contra_paso", contra_paso); 
                                    $.ajax({
                                        url: "../ajax/usuarios.ajax.php",
                                        method: "POST",
                                        data: datosc,
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        dataType: 'json',
                                        success: function(respuesta) {
                                            if(respuesta === "ok") 
                                            {
                                                if (form.checkValidity() === true) {   
                     
                     // console.log("Listo para registrar el paciente")
                      if(accion == 4){
                          $mensaje='Está seguro de Modificar su Perfil?';
                          $confirmar='Si, deseo Modificarlo!';
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
                              datos.append("usu_id", $("#iptUsu_IdReg").val()); //Usu_id
                              datos.append("usu_nombre", $("#iptUsu_NombreReg").val()); //Usu_nombre
                              datos.append("usu_contrasena", $("#iptUsu_ContrasenaNuevaReg").val()); //Usu_contraseña
                              datos.append("rol_id", $("#selRolReg").val()); //Rol_id
                              datos.append("usu_estatus", $("#iptUsu_EstatusReg").val()); //Usu_estatus
                              datos.append("usu_correo", $("#iptUsu_CorreoReg").val()); //Usu_Correo
                              
                              datos.append("usu_nombre_completo", $("#iptUsu_Nombre_CompletoReg").val()); //Usu_nombre_completo
                              datos.append("usu_clinica", $("#selEmpresaReg").val()); 
                          
                                  if(accion == 4){
                                    var titulo_msj = "El Perfil se actualizó correctamente"
                                  }
          
                                  $.ajax({
                                   url: "../ajax/usuarios.ajax.php",
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
                                          $("#mdlGestionarUsuarios").modal('hide');
                                          $("#iptUsu_IdReg").val("");
                                          $("#iptUsu_NombreReg").val("");
                                          $("#iptUsu_ContrasenaReg").val("");
                                          $("#selRol_IdReg").val(0);
                                          $("#iptUsu_EstatusReg").val("");
                                          $("#iptUsu_CorreoReg").val("");
                                       
                                          $("#iptUsu_Nombre_CompletoReg").val("");
                                          $("#selEmpresaReg").val(0);
                                      } else {
                                          Toast.fire({
                                              icon: 'error',
                                              title: 'El Perfil no se pudo registrar'
                                          });
                                      }
          
                                  }
                              });
                          
          
                          }
                      })
                      }else {
                      console.log("No pasó la validación")
                      }
       
                                            }
                                            else
                                            {
                                                Swal.fire("Las Contraseña actual no coincide... Verifique!!!");
                                            }

                                        }
                                    })
                           //  if (validarpassactual()=='ok')    
                               //  {
                                
                             //}
                            // else
                            //     {
                            //        alert ("retorno "+ retorno);
                             //    Swal.fire("Las Contraseña actual no coincide... Verifique!!!");
                             //    }
                            }
                            else{
                                Swal.fire("La Nueva Contraseña no coincide... Verifique!!!");
                            }
                             form.classList.add('was-validated');
                     
                         });
                     });
                     
                     
                     $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {
                     
                         $("#validate_Usu_Id").css("display", "none");
                         $("#validate_Usu_Nombre").css("display", "none");
                         $("#validate_Usu_Contrasena").css("display", "none");
                         $("#validate_Usu_Repetir_Contrasena").css("display", "none");
                         $("#validate_Rol_Id").css("display", "none");
                         $("#validate_Usu_Estatus").css("display", "none");
                         $("#validate_Usu_Correo").css("display", "none");
                         $("#validate_Usu_Nombre_Completo").css("display", "none");
                         $("#validate_Usu_Clinica").css("display", "none");
                     
                         $("#iptUsu_IdReg").val("");
                         $("#iptUsu_NombreReg").val("");
                         $("#iptUsu_ContrasenaReg").val("");
                         $("#iptUsu_Repetir_ContrasenaReg").val("");
                         $("#selRolReg").val(0);
                         $("#iptUsu_EstatusReg").val("");
                         $("#iptUsu_CorreoReg").val("");
                         $("#iptUsu_Nombre_CompletoReg").val("");
                         $("#selEmpresaReg").val(0);
                     
                     })
                     

$("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {

    $("#validate_Usu_Id").css("display", "none");
    $("#validate_Usu_Nombre").css("display", "none");
    $("#validate_Usu_Contrasena").css("display", "none");
    $("#validate_Usu_Repetir_Contrasena").css("display", "none");
    $("#validate_Rol_Id").css("display", "none");
    $("#validate_Usu_Estatus").css("display", "none");
    $("#validate_Usu_Correo").css("display", "none");
    $("#validate_Usu_Nombre_Completo").css("display", "none");
    $("#validate_Usu_Clinica").css("display", "none");

    $("#iptUsu_IdReg").val("");
    $("#iptUsu_NombreReg").val("");
    $("#iptUsu_ContrasenaReg").val("");
    $("#iptUsu_Repetir_ContrasenaReg").val("");
    $("#selRolReg").val(0);
    $("#iptUsu_EstatusReg").val("");
    $("#iptUsu_CorreoReg").val("");
    $("#iptUsu_Nombre_CompletoReg").val("");
    $("#selEmpresaReg").val(0);

})

/*$('#iptUsu_ContrasenaReg').click( function() {
    alert('Enviando!');
        $.ajax(
                {
                    url: '../ajax/usuarios.ajax.php?var=' ,
                    success: function( data ) {
                        alert( 'El servidor devolvio "' + data + '"' );
                    }
                }
            )
        }
    );*/



/*===================================================================*/
//EVENTO QUE LIMPIA LOS MENSAJES DE ALERTA DE INGRESO DE DATOS DE CADA INPUT AL CANCELAR LA VENTANA MODAL
/*===================================================================*/
document.getElementById("btnCancelarRegistro").addEventListener("click", function() {
    $(".needs-validation").removeClass("was-validated");
})
function validarpassactual(){
    var contra_actual=$("#iptUsu_ContrasenaReg").val();
    var contra_paso = $("#iptUsu_ContrasenaPasoReg").val();
   var datosc = new FormData();

datosc.append("accion", 78);
datosc.append("contra_actual", contra_actual); //Usu_id             
datosc.append("contra_paso", contra_paso); 
$.ajax({
    url: "../ajax/usuarios.ajax.php",
    method: "POST",
    data: datosc,
    cache: false,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function(respuesta) {
    if(respuesta === "ok") 
    {
        retorno="ok"
        return(retorno);
    }
    else
    {
        retorno="no";
         return(retorno);
    }
    }
  
    })
}
function validarpass(){
              
    var pass1 = $("#iptUsu_ContrasenaNuevaReg").val();
    var pass2 = $("#iptUsu_Repetir_ContrasenaReg").val();  
  if (pass1 === pass2){
      return(true);
  }else
  return(false);
}


 
</script>
<!-- <script src="http://momentjs.com/downloads/moment.min.js"></script> -->
         

