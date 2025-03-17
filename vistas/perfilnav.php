<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Perfil</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Perfil de Usuarios</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<!-- Ventana Modal para modificar el perfil del usuario -->
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
                      

                        <!-- Columna para registro del Rol 
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
                        </div>-->
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
                          
                        
                       
                        <!-- Columna para registro la Clínica
                        <div class="col-8" style="display:none;">
                            <div class="form-group mb-2">
                                 <label class="" for="selEmpresaReg"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Clínica</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selEmpresaReg" disabled>
                                </select>
                                <div class="invalid-feedback">Seleccione la empresa</div>                        
                            </div> 
                        </div>-->

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
<!-- /. Fin de Ventana Modal para ingreso del perfil del usuario -->



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
   // $('#table').parents('div.dataTables_wrapper').first().hide();
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


//$('#btnperfil').on('click', function() {
    $("#mdlGestionarUsuarios").modal('show');
    $.ajax({
    async: false,
    url: "../ajax/usuarios.ajax.php",
    method: "POST",
    data: {
        'accion': 77
    },
    dataType: 'json',
    success: function(respuesta) {

        var options = '';
        $("#iptUsu_IdReg").val(respuesta[0][1]);
        $("#iptUsu_NombreReg").val(respuesta[0][3]);
        //  $("#iptUsu_ContrasenaReg").val(data["usu_contrasena"]);
        $("#iptUsu_ContrasenaPasoReg").val(respuesta[0][4]);

      //  $("#selRolReg").val(respuesta[0][6]); // se pone el id
        $("#iptUsu_EstatusReg").val(respuesta[0][8]);
        $("#iptUsu_CorreoReg").val(respuesta[0][5]);
        $("#iptUsu_Nombre_CompletoReg").val(respuesta[0][2]);
      //  $("#selEmpresaReg").val(respuesta[0][9]);
  
    }
    });
    })

    $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {

        $("#validate_Usu_Id").css("display", "none");
        $("#validate_Usu_Nombre").css("display", "none");
        $("#validate_Usu_Contrasena").css("display", "none");
        $("#validate_Usu_Repetir_Contrasena").css("display", "none");
      //  $("#validate_Rol_Id").css("display", "none");
        $("#validate_Usu_Estatus").css("display", "none");
        $("#validate_Usu_Correo").css("display", "none");
        $("#validate_Usu_Nombre_Completo").css("display", "none");
      //  $("#validate_Usu_Clinica").css("display", "none");

        $("#iptUsu_IdReg").val("");
        $("#iptUsu_NombreReg").val("");
        $("#iptUsu_ContrasenaReg").val("");
        $("#iptUsu_Repetir_ContrasenaReg").val("");
      //  $("#selRolReg").val(0);
        $("#iptUsu_EstatusReg").val("");
        $("#iptUsu_CorreoReg").val("");
        $("#iptUsu_Nombre_CompletoReg").val("");
       // $("#selEmpresaReg").val("");

//})



})
/*===================================================================*/
//EVENTO QUE GUARDA LAS MODIFICACIONES DE LOS DATOS DEL USUARIO, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/
document.getElementById("btnGuardarUsuario").addEventListener("click", function() {
                         
                         // Get the forms we want to add validation styles to
                         var forms = document.getElementsByClassName('needs-validation');
                         var accion=4;
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
                          accion=44;
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
                
                                alert('entró a la confirmación');
                              var datos = new FormData();
                              datos.append("accion", accion);
                              datos.append("usu_id", $("#iptUsu_IdReg").val()); //Usu_id
                              datos.append("usu_nombre", $("#iptUsu_NombreReg").val()); //Usu_nombre
                              datos.append("usu_contrasena", $("#iptUsu_ContrasenaNuevaReg").val()); //Usu_contraseña
                              //datos.append("rol_id", $("#selRolReg").val()); //Rol_id
                              datos.append("usu_estatus", $("#iptUsu_EstatusReg").val()); //Usu_estatus
                              datos.append("usu_correo", $("#iptUsu_CorreoReg").val()); //Usu_Correo
                              
                              datos.append("usu_nombre_completo", $("#iptUsu_Nombre_CompletoReg").val()); //Usu_nombre_completo
                             // datos.append("usu_clinica", $("#selEmpresaReg").val()); 
                          
                                  if(accion == 44){
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
                                            alert("Entro al final");
                                          Toast.fire({
                                              icon: 'success',
                                              title: titulo_msj
                                          });
          
                                         // table.ajax.reload();
                                          $("#mdlGestionarUsuarios").modal('hide');
                                          $("#iptUsu_IdReg").val("");
                                          $("#iptUsu_NombreReg").val("");
                                          $("#iptUsu_ContrasenaReg").val("");
                                        //  $("#selRol_IdReg").val(0);
                                          $("#iptUsu_EstatusReg").val("");
                                          $("#iptUsu_CorreoReg").val("");
                                       
                                          $("#iptUsu_Nombre_CompletoReg").val("");
                                       //   $("#selEmpresaReg").val(0);
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
                     //    $("#validate_Usu_Clinica").css("display", "none");
                     
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
