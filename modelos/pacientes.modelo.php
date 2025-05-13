<?php
require_once "conexion.php";

class PacientesModelo{

    /*===================================================================
    BUSCAR EL ID DE UNA OCUPACION POR EL NOMBRE DE LA CLINICA
    ====================================================================*/
    static public function mdlBuscarIdEmpresa($nombreEmpresa){

        $stmt = Conexion::conectar()->prepare("select id from tblempresa where nombre = :nombreEmpresa");
        
        $stmt -> bindParam(":nombreEmpresa", $nombreEmpresa,PDO::PARAM_STR);
        
        $stmt->execute();

        return $stmt->fetch();

    }
     /*===================================================================
    BUSCAR EL ID DE UNA OCUPACION POR EL NOMBRE DE LA OCUPACION
    ====================================================================*/
    static public function mdlBuscarIdOcupacion($nombreOcupacion){

        $stmt = Conexion::conectar()->prepare("select id from tblocupaciones where nombre_ocupacion = :nombreOcupacion");
        $stmt -> bindParam(":nombreOcupacion", $nombreOcupacion,PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();

    }
     /*===================================================================
    BUSCAR EL ID DE UNA NACIONALIDAD POR EL NOMBRE DE LA NACIONALIDAD
    ====================================================================*/
    static public function mdlBuscarIdNacionalidad($nombreNacionalidad){

        $stmt = Conexion::conectar()->prepare("select id from tblnacionalidad where gentilicio_nac = :nombreNacionalidad");
        $stmt -> bindParam(":nombreNacionalidad", $nombreNacionalidad,PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();

    }
     
    /*===================================================================
    OBTENER LISTADO TOTAL DE PACIENTES PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarPacientesadmin(){
    
       // $stmt = Conexion::conectar()->prepare('call prc_ListarPacientes');
       $stmt = Conexion::conectar()->prepare("SELECT   '' as detalles,
       p.id,
       p.nombre,
       p.sexo,
       p.fecha_nacimiento,
       p.edad,
       p.direccion,
       p.telefono,
       p.correo,
       p.estado_civil,
       p.escolaridad,
       p.id_ocupacion,
       left(o.nombre_ocupacion,20) as nombre_ocupacion,
       p.id_nacionalidad,
       n.gentilicio_nac,
       p.comorbilidad,
       p.estatus,
       p.fecha_creacion,
       p.id_empresa,
       e.nombre as nombre_clinica,                                                   
       '' as acciones
            FROM tblpacientes p INNER JOIN tblocupaciones o on p.id_ocupacion = o.id 
            inner join tblnacionalidad n on p.id_nacionalidad = n.id
            inner join tblempresa e on p.id_empresa = e.id
            order by p.id desc");
        $stmt->execute();
    
        return $stmt->fetchAll();
    }


     /*===================================================================
    OBTENER LISTADO TOTAL DE PACIENTES PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarPacientes($clinica){
        
        // $stmt = Conexion::conectar()->prepare('call prc_ListarPacientes');
        $stmt = Conexion::conectar()->prepare("SELECT   '' as detalles,
        p.id,
        p.nombre,
        p.sexo,
        p.fecha_nacimiento,
        p.edad,
        p.direccion,
        p.telefono,
        p.correo,
        p.estado_civil,
        p.escolaridad,
        p.id_ocupacion,
        left(o.nombre_ocupacion,20) as nombre_ocupacion,
        p.id_nacionalidad,
        n.gentilicio_nac,
        p.comorbilidad,
        p.estatus,
        p.fecha_creacion,
        p.id_empresa,
        e.nombre as nombre_clinica,                                                   
        '' as acciones
        FROM tblpacientes p INNER JOIN tblocupaciones o on p.id_ocupacion = o.id 
        inner join tblnacionalidad n on p.id_nacionalidad = n.id
        inner join tblempresa e on p.id_empresa = e.id
        where e.nombre = :clinica order by p.id desc");
 
         $stmt -> bindParam(":clinica", $clinica , PDO::PARAM_STR);   
 
         $stmt->execute();
     
         return $stmt->fetchAll();
     }
     /*===================================================================
    OBTENER LISTADO TOTAL DE PACIENTES PARA EL COMBOBOX
    ====================================================================*/
    static public function mdlListarPacientesCb($idclinica){
    
        
        $stmt = Conexion::conectar()->prepare('SELECT  id, nombre
        FROM tblpacientes p 
        WHERE NOT EXISTS (SELECT NULL
                     FROM tblexpedientes e
                    WHERE p.id = e.id_paciente AND p.id_empresa = e.id_clinica)
                     and p.id_empresa=:idclinica
        order BY nombre asc'); 
        $stmt -> bindParam(":idclinica",$idclinica,PDO::PARAM_STR);                                         
            $stmt->execute();
    
        return $stmt->fetchAll();
    }
   /*===================================================================
    FOLIO DE PACIENTES POR SUCURSAL
    ====================================================================*/

    static public function mdlListarFolioPacientes($idclinica){
        $stmt = Conexion::conectar()->prepare("
        select max(id) + 1  as folio
        from tblpacientes p where p.id_empresa=:idclinica
        ");
        $stmt -> bindParam(":idclinica",$idclinica,PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
     }
    /*===================================================================*/

    static public function mdlListarFolioEntidad($entidad, $id_empresa){
        $stmt = Conexion::conectar()->prepare("
            SELECT (ultimo_folio + 1) AS folio
            FROM consecutivos
            WHERE entidad = :entidad AND id_empresa = :id_empresa
        ");
        
        $stmt->bindParam(":entidad", $entidad, PDO::PARAM_STR);
        $stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_OBJ);

        // Si no hay registro, devolvemos 1
        if (!$resultado) {
            return ['folio' => 1];
        }

        return ['folio' => $resultado->folio];
    }

    /*===================================================================
    OBTENER LISTADO TOTAL DE PACIENTES ACTIVOS INDIVIDUALES
    ====================================================================*/
    static public function mdlListarPacientesActivo($id){        
        $stmt = Conexion::conectar()->prepare("select * from tblexpedientes e inner
         join tblpacientes p on p.id= e.id_paciente where e.estatus ='Activo' and e.id_paciente=:id"); 
        $stmt -> bindParam(":id", $id , PDO::PARAM_STR);                                        
        $stmt->execute();
        //return $stmt->fetchAll();
        if($stmt -> execute()){

            $count = $stmt->rowCount();
            if($count > 0){ 
                return "ok";
            }
             else {
                return "no";
        }
        
        }else{

            return Conexion::conectar()->errorInfo();

        }

    }
  /*===================================================================
    OBTENER LISTADO TOTAL DE PACIENTES PARA EL COMBOBOX FULL
    ====================================================================*/
    static public function mdlListarPacientesCbFull(){
    
        $stmt = Conexion::conectar()->prepare('SELECT  id, nombre
        FROM tblpacientes p 
        order BY nombre asc'); 
    
        $stmt->execute();
    
        return $stmt->fetchAll();
    }

    /*===================================================================
    REGISTRAR PACIENTES UNO A UNO DESDE EL FORMULARIO DE PACIENTES
    ====================================================================*/
    /*static public function mdlRegistrarPaciente($id, $nombre,$sexo,$fecha_nacimiento,
                                                $edad,$direccion,$telefono,$estado_civil,$escolaridad,
                                                $id_ocupacion,$id_nacionalidad,$comorbilidad,
                                                $id_empresa,$estatus){        

        try{

            $fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO tblPacientes(id, nombre,
                                                                       sexo,
                                                                       fecha_nacimiento,
                                                                       edad,
                                                                       direccion,
                                                                       telefono,
                                                                       estado_civil,
                                                                       escolaridad,
                                                                       id_ocupacion,
                                                                       id_nacionalidad,
                                                                       comorbilidad,
                                                                       fecha_creacion,
                                                                       id_empresa, 
                                                                       estatus
                                                                       ) 
                                                VALUES (:id, 
                                                        :nombre, 
                                                        :sexo, 
                                                        :fecha_nacimiento, 
                                                        :edad, 
                                                        :direccion,
                                                        :telefono, 
                                                        :estado_civil, 
                                                        :escolaridad, 
                                                        :id_ocupacion,
                                                        :id_nacionalidad,
                                                        :comorbilidad,
                                                        :fecha_creacion,
                                                        :id_empresa,
                                                        :estatus
                                                        )");      
                                                        
            $stmt -> bindParam(":id", $id , PDO::PARAM_STR);
            $stmt -> bindParam(":nombre", $nombre , PDO::PARAM_STR);
            $stmt -> bindParam(":sexo", $sexo , PDO::PARAM_STR);
            $stmt -> bindParam(":fecha_nacimiento", $fecha_nacimiento, PDO::PARAM_STR);
            $stmt -> bindParam(":edad", $edad , PDO::PARAM_STR);
            $stmt -> bindParam(":direccion", $direccion , PDO::PARAM_STR);
            $stmt -> bindParam(":telefono", $telefono , PDO::PARAM_STR);
            $stmt -> bindParam(":estado_civil", $estado_civil , PDO::PARAM_STR);
            $stmt -> bindParam(":escolaridad", $escolaridad , PDO::PARAM_STR);
            $stmt -> bindParam(":id_ocupacion", $id_ocupacion , PDO::PARAM_STR);
            $stmt -> bindParam(":id_nacionalidad", $id_nacionalidad , PDO::PARAM_STR);                                                    
            $stmt -> bindParam(":comorbilidad", $comorbilidad , PDO::PARAM_STR);
            $stmt -> bindParam(":fecha_creacion", $fecha , PDO::PARAM_STR);
            $stmt -> bindParam(":id_empresa", $id_empresa , PDO::PARAM_STR);
            $stmt -> bindParam(":estatus", $estatus , PDO::PARAM_STR);
        
            if($stmt -> execute()){
                $resultado = "ok";
            }else{
                $resultado = "error";
            }  
        }catch (Exception $e) {
            $resultado = 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
        
        return $resultado;

        $stmt = null;

    }*/
    static public function mdlRegistrarPaciente($id,$nombre, $sexo, $fecha_nacimiento,
                                            $edad, $direccion, $telefono,$correo, $estado_civil, $escolaridad,
                                            $id_ocupacion, $id_nacionalidad, $comorbilidad,
                                            $id_empresa, $estatus) {

        try {

            $stmt = Conexion::conectar()->prepare("CALL sp_registrar_paciente(
                                                        :nombre,
                                                        :sexo,
                                                        :fecha_nacimiento,
                                                        :edad,
                                                        :direccion,
                                                        :telefono,
                                                        :correo,
                                                        :estado_civil,
                                                        :escolaridad,
                                                        :id_ocupacion,
                                                        :id_nacionalidad,
                                                        :comorbilidad,
                                                        :id_empresa,
                                                        :estatus
                                                    )");

            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":sexo", $sexo, PDO::PARAM_STR);
            $stmt->bindParam(":fecha_nacimiento", $fecha_nacimiento, PDO::PARAM_STR);
            $stmt->bindParam(":edad", $edad, PDO::PARAM_INT);
            $stmt->bindParam(":direccion", $direccion, PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
            $stmt->bindParam(":estado_civil", $estado_civil, PDO::PARAM_STR);
            $stmt->bindParam(":escolaridad", $escolaridad, PDO::PARAM_STR);
            $stmt->bindParam(":id_ocupacion", $id_ocupacion, PDO::PARAM_INT);
            $stmt->bindParam(":id_nacionalidad", $id_nacionalidad, PDO::PARAM_INT);
            $stmt->bindParam(":comorbilidad", $comorbilidad, PDO::PARAM_STR);
            $stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
            $stmt->bindParam(":estatus", $estatus, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $resultado = "ok";
            } else {
                // Captura errores del statement PDO
                $errorInfo = $stmt->errorInfo();
                $resultado = "Error en la ejecución: " . $errorInfo[2]; // Mensaje de error
            }

        } catch (Exception $e) {
            $resultado = 'Excepción capturada: ' . $e->getMessage() . "\n";
        }

        return $resultado;

        $stmt = null;
    }

/*===================================================================
    BUSCAR POR ID DEL PACIENTE
    ====================================================================*/
    static public function mdlGetDatosPaciente($id){

        $stmt = Conexion::conectar()->prepare("SELECT 
        p.id, p.nombre, p.sexo, p.fecha_nacimiento, p.edad, p.direccion,
        p.estado_civil, p.escolaridad, p.id_ocupacion, left(o.nombre_ocupacion,20) as nombre_ocupacion,
        p.id_nacionalidad, n.gentilicio_nac, p.comorbilidad, p.estatus,
        p.fecha_creacion, p.id_empresa, e.nombre as nombre_clinica                                                  
        FROM tblpacientes p INNER JOIN tblocupaciones o on p.id_ocupacion = o.id 
        inner join tblnacionalidad n on p.id_nacionalidad = n.id
        inner join tblempresa e on p.id_empresa = e.id WHERE p.id = :id");
        
        $stmt -> bindParam(":id",$id,PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    static public function mdlActualizarInformacion($table, $data, $id, $id_clinica, $nameId){

        $set = "";

        foreach ($data as $key => $value) {
            
            $set .= $key." = :".$key.",";
                
        }

        $set = substr($set, 0, -1);

        $stmt = Conexion::conectar()->prepare("UPDATE $table SET $set WHERE $nameId = :$nameId and id_empresa=:id_empresa");

        foreach ($data as $key => $value) {
            
            $stmt->bindParam(":".$key, $data[$key], PDO::PARAM_STR);
            
        }		

        $stmt->bindParam(":".$nameId, $id, PDO::PARAM_INT);
        $stmt->bindParam(":id_empresa", $id_clinica, PDO::PARAM_INT);

        if($stmt->execute()){

            return "ok";

        }else{

            return Conexion::conectar()->errorInfo();
        
        }
    }


 /*   static public function mdlActualizarInformacion($table, $data, $id, $nameId){

        $set = "";

        foreach ($data as $key => $value) {
            
            $set .= $key." = :".$key.",";
                
        }

        $set = substr($set, 0, -1);

        $stmt = Conexion::conectar()->prepare("UPDATE $table SET $set WHERE $nameId = :$nameId");

        foreach ($data as $key => $value) {
            
            $stmt->bindParam(":".$key, $data[$key], PDO::PARAM_STR);
            
        }		

        $stmt->bindParam(":".$nameId, $id, PDO::PARAM_INT);

        if($stmt->execute()){

            return "ok";

        }else{

            return Conexion::conectar()->errorInfo();
        
        }
    } */

    /*=============================================
    Peticion DELETE para eliminar datos
    =============================================*/

    static public function mdlEliminarInformacion($table, $id, $nameId,$id_empresa,$nameId2){

        $stmt = Conexion::conectar()->prepare("DELETE FROM 
        $table WHERE $nameId = :$nameId and $nameId2=:$nameId2");

        $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_INT);
        $stmt -> bindParam(":".$nameId2, $id_empresa, PDO::PARAM_INT);


        if($stmt -> execute()){

            return "ok";;
        
        }else{

            return Conexion::conectar()->errorInfo();

        }

    }   

    /*===================================================================
    LISTAR NOMBRE DE PACIENTES PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function mdlListarNombrePacientes(){

        $stmt = Conexion::conectar()->prepare("SELECT Concat(id , ' - ' ,c.nombre_categoria,' - ',descripcion_producto, ' - S./ ' , p.precio_venta_producto)  as descripcion_producto
                                                FROM Pacientes p inner join categorias c on p.id_categoria_producto = c.id_categoria");

        $stmt -> execute();

        return $stmt->fetchAll();
    }

    

    
}