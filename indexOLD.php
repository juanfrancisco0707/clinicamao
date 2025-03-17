<?php
session_start();
if(isset($_SESSION['S_IDUSUARIO'])){
	//header('Location: ../vista/index.php');
	header('Location: vistas/plantilla.php');
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Sistema Control de Ingreso de Pacientes</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="login/image/png" href="login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
	<link rel="stylesheet" type="text/css" href="vistas/assets/dist/css/tabla.css">
<!--===============================================================================================-->

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
					<span class="login100-form-title p-b-49">
						INICIAR SESI&Oacute;N
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Nombre de Usuario requerido">
						<span class="label-input100">Usuario</span>
						<input class="input100" type="text" name="username" placeholder="Escriba el usuario" id="txt_usu" autocomplete="new-password">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Contraseña requerida">
						<span class="label-input100">Contrase&ntilde;a</span>
						<input class="input100" type="password" name="pass" placeholder="Escriba la contrase&ntilde;a" id="txt_con">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					
					<div class="text-right p-t-8 p-b-31">
						<a href="#">
							Olvidaste la contrase&ntilde;a?
						</a>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="btnBuscarUsuario" id="btnBuscarUsuario" onclick="VerificarUsuario()">
								ENTRAR
							</button>
						</div>
					</div><br>

					<div class="flex-c-m">
						<a href="https://facebook.com/" class="login100-social-item bg1">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="https://twitter.com/" class="login100-social-item bg2">
							<i class="fa fa-twitter"></i>
						</a>

						<a href="https://google.com/" class="login100-social-item bg3">
							<i class="fa fa-google"></i>
						</a>
					</div>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="login/vendor/sweetalert2/sweetalert2.js"></script>
<!--===============================================================================================-->
	
<!--===============================================================================================-->
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/daterangepicker/moment.min.js"></script>
	<script src="login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<!--<script src="login/login7/js/main.js"></script>-->
	<!--<script src="js/usuario.js"></script>-->


<!--	   <script src="login/login7/js/usuario.js"></script>-->


<!--	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
-->


<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" 
integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" 
referrerpolicy="no-referrer"></script> -->

<script src="https://code.jquery.com/jquery-migrate-3.4.0.min.js"></script>


</body>
<script>
txt_usu.focus();

</script>


<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	var el = document.getElementById('btnbuscarUsuario');

$(document).ready(function() {
	if(el){
  el.addEventListener('click', swapper, false);
}
	$('#btnbuscarUsuario').on('click', '.btnBuscarExpediente', function() {
		alert('entro al evento');
	})

});
</script>


<script>
var accion;


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
		$("#btnbuscarUsuario").click(function() {
			alert(' entro al click del boton');

		}) // fin del Document Ready
	})
/*document.getElementById("btnbuscarUsuario").addEventListener("click", function() {
	alert(' entro al click del boton');
		VerificarUsuario();
})*/
 function VerificarUsuario(){
    var usu_nombre = $("#txt_usu").val();
    var con = $("#txt_con").val();

    if(usu_nombre.length==0 || con.length==0){
        return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");
    }

    $.ajax({
		async:false,
        url:'ajax/usuarios.ajax.php',
        type:'POST',
        data:{
			'accion': 80,
             usu_nombre:usu_nombre
        },
		dataType: 'json',
		//success: function(respuesta) {
		
		//}
    }).done(function(respuesta){ 
		alert('contrasena antes' + contra_paso);
			var contra_paso  = respuesta['usu_contrasena'];
				alert('contrasena ' + contra_paso);
		

	
	
	/*	$.ajax({
		async:false,
        url:'ajax/usuarios.ajax.php',
        type:'POST',
        data:{
			'accion': 78,
             user:contra
        }
		});

        if(resp==1)
        Swal.fire("Mensaje De Advertencia","Lo sentimos el usuario "+usu+" se encuentra Inactivo, comuniquese con el administrador","warning");
        //Swal.fire("Mensaje de Error, Este Usuario está Inactivo!!!","error");
        else{
        if(resp==0){
            Swal.fire("Mensaje De Error",'Usuario y/o contrase\u00f1a incorrecta',"error");
        }else{
           // var obj = resp.replace(/'/g,"\"");
            var data= JSON.parse(resp);
            $.ajax({
                url:'../login/login7/controlador/usuario/controlador_crear_session.php',
                type:'POST',
                data:{
                    idusuario:data[0][0],
                    user:data[0][1],
                    rol:data[0][3],
                    estatus:data[0][4],
                    nombre:data[0][6],
                    idclinica:data[0][11],
                    clinica:data[0][12],
                    correo:data[0][5]                  
                }
            }).done(function(resp){
               
                let timerInterval
                Swal.fire({
                title: 'BIENVENIDO AL SISTEMA',
                html: 'Usted será redireccionado en <b></b> milisegundos.',
                timer: 500,
                timerProgressBar: true,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                    const content = Swal.getContent()
                    if (content) {
                        const b = content.querySelector('b')
                        if (b) {
                        b.textContent = Swal.getTimerLeft()
                        }
                    }
                    }, 100)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
              
                if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload();
                }
                })
            })
           
        }
      }*/
    }) 
	}

	</script>
</html>