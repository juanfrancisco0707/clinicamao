<?php
class PacientesControlador{

static public function ctrListarPacientes($clinica){

    $pacientes = PacientesModelo::mdlListarPacientes($clinica);

    return $pacientes;

}
static public function ctrListarFolioEntidad($entidad, $id_empresa){

    return FoliosModelo::mdlListarFolioEntidad($entidad, $id_empresa);
    
}
static public function ctrListarPacientesadmin(){

    $pacientes = PacientesModelo::mdlListarPacientesadmin();

    return $pacientes;

}
  /*===================================================================
    LISTAR PACIENTES PARA SELECT (ID Y NOMBRE)
    ====================================================================*/
    static public function ctrListarPacientesParaSelect(){
        
        $pacientes = PacientesModelo::mdlListarPacientesParaSelect();
        return $pacientes;
    }

static public function ctrListarPacientesCb($idclinica){

    $PacientesCb = PacientesModelo::mdlListarPacientesCb($idclinica);

    return $PacientesCb;

}
static public function ctrListarPacientesCbFull(){

    $PacientesCb = PacientesModelo::mdlListarPacientesCbFull();

    return $PacientesCb;

} 
static public function ctrListarFolioPacientes($idclinica){
        
    $pacientes = PacientesModelo::mdlListarFolioPacientes($idclinica);

    return $pacientes;

}
static public function ctrGetDatosPacienteActivo($id){

    $PacientesActivo = PacientesModelo::mdlListarPacientesActivo($id);

    return $PacientesActivo;

}

static public function ctrRegistrarPaciente($id, $nombre, $sexo, $fecha_nacimiento, $edad,$direccion,$telefono, $correo, $estado_civil, $escolaridad,$id_ocupacion,
$id_nacionalidad,$comorbilidad, $id_empresa, $estatus){

    $registroPaciente = PacientesModelo::mdlRegistrarPaciente($id, $nombre, $sexo, $fecha_nacimiento, $edad,$direccion,$telefono,$correo, $estado_civil, $escolaridad,$id_ocupacion,
    $id_nacionalidad,$comorbilidad,  $id_empresa, $estatus);

    return $registroPaciente;
}

/*static public function ctrActualizarStock($table, $data, $id, $nameId){
    
    $respuesta = PacientesModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
    
    return $respuesta;
}*/
static public function ctrActualizarPaciente($table, $data, $id, $id_clinica,$nameId){
        
    $respuesta = PacientesModelo::mdlActualizarInformacion($table, $data, $id, $id_clinica, $nameId);
    
    return $respuesta;
}
/*static public function ctrActualizarPaciente($table, $data, $id, $nameId){
    
    $respuesta = PacientesModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
    
    return $respuesta;
}*/

static public function ctrEliminarPaciente($table, $id, $nameId,$id_empresa,$nameId2)
{  
    $respuesta = PacientesModelo::mdlEliminarInformacion($table, $id, $nameId,$id_empresa,$nameId2);
    
    return $respuesta;
}

/*===================================================================
LISTAR NOMBRE DE Pacientes PARA INPUT DE AUTO COMPLETADO
====================================================================*/
static public function ctrListarNombrePacientes(){

    $paciente = PacientesModelo::mdlListarNombrePacientes();

    return $paciente;
}

/*===================================================================
BUSCAR paciente POR SU id
====================================================================*/
static public function ctrGetDatosPaciente($codigo_paciente){
        
    $paciente = PacientesModelo::mdlGetDatosPaciente($codigo_paciente);

    return $paciente;

}

}
   