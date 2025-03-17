<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0">Carrerasss</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Carrerasss</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- Main content -->
<div class="content">

    <div class="container-fluid">
        <!-- row para listado de Representantes -->
        <div class="row">
            <div class="col-lg-12">
                <table id="tbl_representantes" class="table table-striped w-100 shadow">
                    <thead class="bg-info">
                        <tr style="font-size: 12px;">
                            <th></th>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Edad</th>
                            <th>Parentesco</th>
                            <th>Teléfono</th>
                            <th>id_ocupacion</th>
                            <th>Ocupaciones</th>
                            <th>id_clinica</th>
                            <th>Clínica</th>
                            <th>Estatus</th>
                            <th></th>
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

<!-- Ventana Modal para ingresar o modificar un Representante -->
<div class="modal fade" id="mdlGestionarRepresentantes" role="dialog">

    <div class="modal-dialog modal-lg">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Agregar-Modificar Representante</h5>

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
                                <div class="invalid-feedback">Debe ingresar el Identificador del Representante</div>
                            </div>
                        </div>

                       
                        <!-- Columna para registro del Nombre del Representante-->
                        <div class="col-12col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptNombre_RepresentanteReg"><i
                                        class="fas fa-file-signature fs-6"></i> <span
                                        class="small">Nombre</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptNombre_RepresentanteReg"
                                    placeholder="Nombre" required>
                                <div class="invalid-feedback">Debe ingresar el nombre</div>
                            </div>
                        </div>
                        <div class="col-12col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptDireccionReg"><i
                                        class="fas fa-file-signature fs-6"></i> <span
                                        class="small">Dirección</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptDireccionReg"
                                    placeholder="Introduzca la Direccion" required>
                                <div class="invalid-feedback">Debe ingresar la dirección</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="iptEdadReg"><i
                                        class="fas fa-file-signature fs-6"></i> <span
                                        class="small">Edad</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptEdadReg"
                                    placeholder="Ingrese Edad" required>
                                <div class="invalid-feedback">Debe ingresar la Edad </div>
                            </div>
                        </div>
                        <!-- Columna para registro de la Dirección del Paciente -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptParentescoReg"><i class="fas fa-plus-circle fs-6"></i>
                                    <span class="small">Parentesco</span><span class="text-danger">*</span></label>
                                <input type="text" min="0" class="form-control form-control-sm" id="iptParentescoReg"
                                    placeholder="Parentesco" required>
                                <div class="invalid-feedback">Debe ingresar el parentesco</div>
                            </div>
                        </div>
                       
                         <!-- Columna para registro del Telefono -->
                         <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptTelefonoReg"><i
                                        class="fas fa-minus-circle fs-6"></i> <span class="small">Telefono</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptTelefonoReg"
                                    placeholder="Teléfono" required>
                                <div class="invalid-feedback">Debe ingresar El teléfono</div>
                            </div>
                        </div>
                        <div class="col-12  col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="selOcupacionReg"><i class="fa fa-medkit" aria-hidden="true"></i>
                                    <span class="small">Ocupación</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selOcupacionReg" required>
                                </select>
                                <div class="invalid-feedback">Seleccione la Ocupación</div>
                            </div>
                        </div>
                                                <!-- Columna para registro de Clínica del Paciente -->
                        <div class="col-12  col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="selEmpresaReg"><i class="fa fa-medkit" aria-hidden="true"></i>
                                    <span class="small">Clínica</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="selEmpresaReg" required>
                                </select>
                                <div class="invalid-feedback">Seleccione la Clínica</div>
                            </div>
                        </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group mb-2">
                                    <label class="" for="iptEstatusReg"><i
                                        class="fas fa-minus-circle fs-6"></i> <span class="small">Estatus</span><span class="text-danger">*</span></label>
                                        <select name="estatus" class="form-control form-control-sm" id ="iptEstatusReg" required>
                                         <option>Activo</option>
                                         <option>Inactivo</option>
                                         </select>     
                                    <div class="invalid-feedback">Debe Seleccionar el estatus</div>
                                </div>
                            </div>

                        </div>
                            <!-- creacion de botones para cancelar y guardar el Representante -->
                            <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                            <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarRepresentante">Guardar</button>
                        </div>
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
    // CARGA DEL LISTADO CON EL PLUGIN DATATABLE JS
    /*===================================================================*/
    table = $("#tbl_representantes").DataTable({
        dom: 'Bfrtip', // Para que los botones se pongan en la parte Superior
        buttons: [{
                text: 'Agregar Representante',
                className: 'addNewRecord',
                action: function(e, dt, node, config) {
                    $.ajax({

                        async: false,
                        url: "../ajax/representantes.ajax.php",
                        method: "POST",
                        data: {
                            'accion': 11
                        },
                        dataType: 'json',
                        success: function(respuesta) {
                            folio = respuesta["folio"];
                            $("#iptIdReg").val(folio);
                        }
                        });

                    $("#mdlGestionarRepresentantes").modal('show');
                    cargarfolio();
                   accion = 2; //registrar
                }
            },
            {
                extend: 'excel',
                text: 'Excel',
                title: 'Listado de Representantes de los Pacientes'
            },
            {
                extend: 'print', 
                text: 'Imprimir',
                title: 'Listado de Representantes de los Pacientes'},
            {
                extend:'pageLength',
                text: 'Longitud de la página'
            }           
        ],
        pageLength: [[5, 10, 15, 30, 50], 
                    ['5 Filas','10 Filas','15 Filas','30 Filas','50 Filas','Mostrar todo']], 
        pageLength: 10,
        ajax: {
            url: "../ajax/representantes.ajax.php",
            dataSrc: '',
            type: "POST",
            data: {
                'accion': 1 //1: LISTAR PACIENTES
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
                targets: 5, // no muestra 
                visible: false
            },
            {
                targets: 7, // no muestra 
                visible: false
            },
            {
                targets: 8, // no muestra 
                visible: false
            },
            {
                targets: 9, // no muestra 
                visible: false
            }
            ,
            {
                targets: 10, // no muestra 
                visible: false
            },
            {
                targets: 13
                ,
                orderable: false,
                render: function(data, type, full, meta) {
                    return "<center>" +
                        "<span class='btnEditarRepresentante text-primary px-1' style='cursor:pointer;'>" +
                        "<i class='fas fa-pencil-alt fs-5'></i>" +
                        "</span>" +
                        "<span class='btnEliminarRepresentante text-danger px-1' style='cursor:pointer;'>" +
                        "<i class='fas fa-trash fs-5'></i>" +
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

        $("#validate_id").css("display", "none");
        $("#validate_nombre_representante").css("display", "none");
        $("#validate_parentesco").css("display", "none");
        $("#validate_telefono").css("display", "none");
        $("#validate_direccion").css("display", "none");
        $("#validate_edad").css("display", "none");

        $("#validate_estatus").css("display", "none");
      

        $("#iptIdReg").val("");
        $("#iptNombre_RepresentanteReg").val("");
        $("#iptDireccionReg").val("");
        $("#iptParentescoReg").val("");
        $("#iptTelefonoReg").val("");
        $("#iptEdadReg").val("");
        $("#selEmpresaReg").val(0);
        $("#selOcupacionReg").val(0);

        $("#iptEstatusReg").val("");
       
      
    })

    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON EDITAR REPRESENTANTE
    =========================================================================================*/
    $('#tbl_representantes tbody').on('click', '.btnEditarRepresentante', function() {

        accion = 4; //seteamos la accion para editar

        $("#mdlGestionarRepresentantes").modal('show');

        var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }
       console.log("🚀 ~ file: Representantes.php ~ line 403 ~ $ ~ data", data)
        
        $("#iptIdReg").val(data["id"]);
        $("#iptNombre_RepresentanteReg").val(data["nombre_representante"]);
        $("#iptDireccionReg").val(data["direccion"]);
        $("#iptEdadReg").val(data["edad"]);
        $("#iptParentescoReg").val(data["parentesco"]);
        $("#iptTelefonoReg").val(data["telefono"]);
        $("#selOcupacionReg").val(data[7]);
        $("#selEmpresaReg").val(data[9]);
        
        $("#iptEstatusReg").val(data["estatus"]);

    })

    /* ======================================================================================
    EVENTO AL DAR CLICK EN EL BOTON ELIMINAR REPRESENTANTE
    =========================================================================================*/
    $('#tbl_representantes tbody').on('click', '.btnEliminarRepresentante', function() {
        
        accion = 5; //seteamos la accion para editar
        
        var data = table.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data = table.row(this).data();
        }

        var id = data["id"];
        var id_clinica = data["id_clinica"];
        console.log("🚀 ~ file: Representantes.php ~ line 331 ~ $ ~ data", data)
        Swal.fire({
            title: 'Está seguro de eliminar el Representante?',
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
                datos.append("id", id); //id_Representante   
                datos.append("id_clinica", id_clinica); //id_Representante              

                $.ajax({
                    url: "../ajax/representantes.ajax.php",
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
                                title: 'El Representante se eliminó correctamente'
                            });
                            table.ajax.reload();

                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'El representante no se pudo eliminar'
                            });
                        }

                    }
                });

            }
        })
    })
        

});
/*===================================================================*/
//EVENTO QUE GUARDA LOS DATOS DEL REPRESENTANTE, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/
document.getElementById("btnGuardarRepresentante").addEventListener("click", function() {

    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {

        if (form.checkValidity() === true) {   

           // console.log("Listo para registrar el representante")
            if(accion == 4){
                $mensaje='Está seguro de Modificar el Representante?';
                $confirmar='Si, deseo Modificarlo!';
            }
            if (accion == 2){
                $mensaje='Está seguro de registrar el Representante?';
                $confirmar='Si, deseo registrarlo!';
            }
            Swal.fire({
                title: $mensaje,
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
                    datos.append("id", $("#iptIdReg").val()); //id_representante
                    datos.append("nombre_representante", $("#iptNombre_RepresentanteReg").val()); //Nombre_Representante
                    datos.append("parentesco", $("#iptParentescoReg").val()); //ParentescoRepresentante
                    datos.append("telefono", $("#iptTelefonoReg").val()); //Telefono del representante
                    datos.append("id_clinica", $("#selEmpresaReg").val()); //Telefono del representante
                    datos.append("estatus", $("#iptEstatusReg").val()); //Estatus
                    datos.append("direccion", $("#iptDireccionReg").val()); //Estatus
                    datos.append("edad", $("#iptEdadReg").val()); //Estatus
                    datos.append("id_ocupacion", $("#selOcupacionReg").val()); //Estatus
            
                    if(accion == 2){
                        var titulo_msj = "El Representante se registró correctamente"
                        console.log("GRABANDO!!!")
                    }

                    if(accion == 4){
                        var titulo_msj = "El Representante se actualizó correctamente"
                        console.log("MODIFICANDO!!!")
                    }

                    $.ajax({
                        url: "../ajax/representantes.ajax.php",
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
                                $("#mdlGestionarRepresentantes").modal('hide');                            
                                $("#iptNombre_RepresentanteReg").val("");
                                $("#iptParentescoReg").val("");
                                $("#iptTelefonoReg").val("");
                                $("#selEmpresaReg").val(0);
                                $("#selOcupacionReg").val(0);
                                $("#iptEstatusReg").val("");
                                $("#iptDireccionReg").val("");
                                $("#iptEdadReg").val("");
                               

                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'El Representante no se pudo registrar'
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

function cargarfolio(){
    $.ajax({

async: false,
url: "../ajax/representantes.ajax.php",
method: "POST",
data: {
    'accion': 11
},
dataType: 'json',
success: function(respuesta) {
    folio = respuesta["folio"];
    $("#iptIdReg").val(folio);
}
});
}

</script>