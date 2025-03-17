 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Datos de las Clínicas</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Clínicas</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->
 <!-- Main content -->
<div class="content">

<div class="container-fluid">
    <!-- row para listado de Empresas -->
    <div class="row">
        <div class="col-lg-12">
            <table id="tbl_Empresas" class="table table-striped w-100 shadow">
                <thead class="bg-info">
                    <tr style="font-size: 12px;">
                        <th></th>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Teléfono</th>
                        <th>Representante Legal</th>
                        <th>Cédula</th>
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

<!-- Ventana Modal para ingresar o modificar un Empresa -->
<div class="modal fade" id="mdlGestionarEmpresas" role="dialog">

<div class="modal-dialog modal-lg">

    <!-- contenido del modal -->
    <div class="modal-content">

        <!-- cabecera del modal -->
        <div class="modal-header bg-gray py-1">

            <h5 class="modal-title">Modifcar Datos de la Clínica</h5>
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
                                name="iptId" placeholder="Identificador" disabled>
                            <div class="invalid-feedback">Debe ingresar el Identificador de la Clínica</div>
                        </div>
                    </div>

                   
                    <!-- Columna para registro del Nombre del Empresa-->
                    <div class="col-12">
                        <div class="form-group mb-2">
                            <label class="" for="iptNombreReg"><i
                                    class="fas fa-file-signature fs-6"></i> <span
                                    class="small">Nombre</span><span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="iptNombreReg"
                                placeholder="Nombre" required>
                            <div class="invalid-feedback">Debe ingresar el nombre</div>
                        </div>
                    </div>
                    <!-- Columna para registro de la Dirección del Paciente -->
                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-2">
                            <label class="" for="iptDireccionReg"><i class="fas fa-plus-circle fs-6"></i>
                                <span class="small">Direccion</span><span class="text-danger">*</span></label>
                            <input type="text" min="0" class="form-control form-control-sm" id="iptDireccionReg"
                                placeholder="Dirección" required>
                            <div class="invalid-feedback">Debe ingresar la Direccion</div>
                        </div>
                    </div>
                   
                     <!-- Columna para registro del Telefono -->
                     <div class="col-12 col-lg-6">
                        <div class="form-group mb-2">
                            <label class="" for="iptTelefonoReg"><i
                                    class="fas fa-minus-circle fs-6"></i> <span class="small">Telefono</span><span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="iptTelefonoReg"
                                placeholder="Teléfono" required>
                            <div class="invalid-feedback">Debe ingresar El teléfono</div>
                        </div>
                    </div>
                      <!-- Columna para registro del representante legal de la clínica -->
                      <div class="col-12 col-lg-6">
                        <div class="form-group mb-2">
                            <label class="" for="iptRepresentante_LegalReg"><i
                                    class="fas fa-minus-circle fs-6"></i> <span class="small">Representante legal</span><span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="iptRepresentante_LegalReg"
                                placeholder="Represente Legal" required>
                            <div class="invalid-feedback">Debe ingresar El representante legal</div>
                        </div>
                    </div>
                    </div>
                    <!-- Columna para registro de la cédula del representante -->
                    <div class="col-12 col-lg-6">
                        <div class="form-group mb-2">
                            <label class="" for="iptCedula_LegalReg"><i
                                    class="fas fa-minus-circle fs-6"></i> <span class="small">Cédula Representante legal</span><span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="iptCedula_LegalReg"
                                placeholder="Cédula del Represente Legal" required>
                            <div class="invalid-feedback">Debe ingresar la Cédula del representante legal</div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                        data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                    <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                        id="btnGuardarEmpresa">Guardar</button>
                    </div>
                    </div>
                    <!-- creacion de botones para cancelar y guardar el Empresa -->
                    
                </div>
            </form>
        
        </div>

    </div>
</div>


</div>
<!-- /. Fin de Ventana Modal para ingreso de Pacientes -->

<script>
var accion;
var table;

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
// CARGA DEL LISTADO CON EL PLUGIN DATATABLE JS
/*===================================================================*/
  table = $("#tbl_Empresas").DataTable({
    dom: 'Bfrtip', // Para que los botones se pongan en la parte Superior
    buttons: [/* {
           text: 'Agregar Empresa',
            className: 'addNewRecord',
            action: function(e, dt, node, config) {
                $("#mdlGestionarEmpresas").modal('show');
               accion = 2; //registrar
             }
        }*/ 
        'excel', 'print', 'pageLength'
    ],
    pageLength: [5, 10, 15, 30, 50, 100], // 
    pageLength: 10,
    ajax: {
        url: "../ajax/empresa.ajax.php",
        dataSrc: '',
        type: "POST",
        data: {
            'accion': 1 //1: LISTAR CLINICAS
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
                targets: 3, // no muestre el id del paciente
                visible: false
        },
        {
            targets: 7,
            orderable: false,
            render: function(data, type, full, meta) {
                return "<center>" +
                    "<span class='btnEditarEmpresa text-primary px-1' style='cursor:pointer;'>" +
                    "<i class='fas fa-pencil-alt fs-5'></i>" +
                    "</span>" +
                    "</center>"
            }
        }
    ],
    //fixedColumns: true,
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"

    }
});



$("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {

    $("#validate_Id").css("display", "none");
    $("#validate_Nombre").css("display", "none");
    $("#validate_Direccion").css("display", "none");
    $("#validate_Telefono").css("display", "none");
    $("#validate_Representante_Legal").css("display", "none");
    $("#validate_Cedula_Legal").css("display", "none");
  

    $("#iptIdReg").val("");
    $("#iptNombre_EmpresaReg").val("");
    $("#iptDireccionReg").val("");
    $("#iptTelefonoReg").val("");
    $("#iptEstatusReg").val("");
    $("#iptRepresentante_LegalReg").val("");
    $("#iptCedula_LegalReg").val("");
   
  
})

/* ======================================================================================
EVENTO AL DAR CLICK EN EL BOTON EDITAR Empresa
=========================================================================================*/
$('#tbl_Empresas tbody').on('click', '.btnEditarEmpresa', function() {

    accion = 4; //seteamos la accion para editar

    $("#mdlGestionarEmpresas").modal('show');

    var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }
   // console.log("🚀 ~ file: Empresas.php ~ line 250 ~ $ ~ data", data)
    
    $("#iptIdReg").val(data["id"]);
    $("#iptNombreReg").val(data["nombre"]);
    $("#iptDireccionReg").val(data["direccion"]);
    $("#iptTelefonoReg").val(data["telefono"]);
    $("#iptRepresentante_LegalReg").val(data["representante_legal"]);
    $("#iptCedula_LegalReg").val(data["cedula_legal"]);

})

/* ======================================================================================
EVENTO AL DAR CLICK EN EL BOTON ELIMINAR Paciente
=========================================================================================*/
$('#tbl_empresas tbody').on('click', '.btnEliminarEmpresa', function() {
    
    accion = 5; //seteamos la accion para editar
    
    var data = table.row($(this).parents('tr')).data();

    var id = data["id"];

    Swal.fire({
        title: 'Está seguro de eliminar el registro de la Clínica?',
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
            datos.append("id", id); //id_Empresa              

            $.ajax({
                url: "../ajax/empresa.ajax.php",
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
                            title: 'La Empresa se eliminó correctamente'
                        });

                        table.ajax.reload();

                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'La Empresa no se pudo eliminar'
                        });
                    }

                }
            });

        }
    })
})
    

});
/*===================================================================*/
//EVENTO QUE GUARDA LOS DATOS DEL Empresa, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/
document.getElementById("btnGuardarEmpresa").addEventListener("click", function() {

    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {

    if (form.checkValidity() === true) {   

      //  console.log("Listo para registrar la Clínica")

        Swal.fire({
            title: 'Está seguro de Modificar la Clínica?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo registrarla!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {
                
                var datos = new FormData();
                datos.append("accion", accion);
                datos.append("id", $("#iptIdReg").val()); //id_Empresa
                datos.append("nombre", $("#iptNombreReg").val()); //Nombre_Empresa
                datos.append("direccion", $("#iptDireccionReg").val()); //DireccionEmpresa
                datos.append("telefono", $("#iptTelefonoReg").val()); //Telefono del Empresa
                datos.append("representante_legal", $("#iptRepresentante_LegalReg").val());
                                                       
                datos.append("cedula_legal", $("#iptCedula_LegalReg").val()); //Telefono del Empresa
                                                      
                  if(accion == 2){
                    var titulo_msj = "La Clínica se registró correctamente"
                    console.log("GRABANDO!!!")
                }

                if(accion == 4){
                    var titulo_msj = "La Clínica se actualizó correctamente"
                    console.log("MODIFICANDO!!!")
                }

                $.ajax({
                    url: "../ajax/empresa.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(respuesta) {

                        if (respuesta === "ok") {
                            alert("Datos Modificados");
                            Toast.fire({
                                icon: 'success',
                                title: titulo_msj
                            });
                            table.ajax.reload();
                            $("#mdlGestionarEmpresas").modal('hide');                            
                            $("#iptNombreReg").val("");
                            $("#iptDireccionReg").val("");
                            $("#iptTelefonoReg").val("");
                            $("#iptRepresentante_LegalReg").val("");
                            $("#iptCedula_LegalReg").val("");
                           

                        } else {
                            alert("entro al no ok segunda vuelta");
                            Toast.fire({
                                icon: 'error',
                                title: 'La Clínica no se pudo registrar'
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