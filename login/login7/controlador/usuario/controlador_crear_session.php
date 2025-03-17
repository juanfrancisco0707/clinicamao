<?php
$IDUSUARIO = $_POST['idusuario'];
$USER = $_POST['user'];
$ROL = $_POST['rol'];
$ESTATUS = $_POST['estatus'];
$CLINICA = $_POST['clinica'];
$IDCLINICA=$_POST['idclinica'];
$NOMBRE= $_POST['nombre'];
//$CORREO=$_POST['correo'];
session_start();
$_SESSION['S_IDUSUARIO']=$IDUSUARIO;
$_SESSION['S_USER']=$USER;
$_SESSION['S_ROL']=$ROL;
$_SESSION['S_ESTATUS']=$ESTATUS;
$_SESSION['S_CLINICA']=$CLINICA;
$_SESSION['S_NOMBRE']=$NOMBRE;
$_SESSION['S_IDCLINICA']=$IDCLINICA;
//$_SESSION['S_CORREO']=$CORREO;

?>