<?php
require_once "conexion.php";

class EspecialistasModelo
{
    /*===================================================================
    OBTENER LISTADO TOTAL DE Especialistas PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarEspecialistasCb()
    {
        $stmt = Conexion::conectar()->prepare("SELECT  id_fisioterapeuta, nombre, apellido
                                                FROM tblmaoespecialistas
                                            order BY apellido asc");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlListarEspecialistas()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM tblmaoespecialistas");
        $stmt->execute();

        return $stmt->fetchAll();
    }
    /*===================================================================
    REGISTRAR Especialistas UNO A UNO DESDE EL FORMULARIO DE Especialistas
    ====================================================================*/
    static public function mdlRegistrarEspecialista($data)
    {
        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO tblmaoespecialistas(nombre, apellido, especialidad, telefono, email) 
                                                    VALUES (:nombre, :apellido, :especialidad, :telefono, :email)");

            $stmt->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":apellido", $data["apellido"], PDO::PARAM_STR);
            $stmt->bindParam(":especialidad", $data["especialidad"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $data["telefono"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                $resultado = "ok";
            } else {
                $resultado = "error";
            }
        } catch (Exception $e) {
            $resultado = 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }

        return $resultado;

        $stmt = null;
    }

    static public function mdlActualizarInformacion($table, $data, $id, $nameId)
    {

        $set = "";

        foreach ($data as $key => $value) {

            $set .= $key . " = :" . $key . ",";
        }

        $set = substr($set, 0, -1);

        $stmt = Conexion::conectar()->prepare("UPDATE $table SET $set WHERE $nameId = :$nameId");

        foreach ($data as $key => $value) {

            $stmt->bindParam(":" . $key, $data[$key], PDO::PARAM_STR);
        }

        $stmt->bindParam(":" . $nameId, $id, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return Conexion::conectar()->errorInfo();
        }
    }

    /*=============================================
    Peticion DELETE para eliminar datos
    =============================================*/

    static public function mdlEliminarInformacion($table, $id, $nameId)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $table WHERE $nameId = :$nameId");

        $stmt->bindParam(":" . $nameId, $id, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";;
        } else {

            return Conexion::conectar()->errorInfo();
        }
    }

    /*===================================================================
    LISTAR NOMBRE DE Especialistas PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function mdlListarNombreEspecialistas()
    {

        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM tblmaoespecialistas");

        $stmt->execute();

        return $stmt->fetchAll();
    }
    
    /*===================================================================
    OBTENER UN ESPECIALISTA POR ID
    ====================================================================*/
    static public function mdlObtenerEspecialista($id)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM tblmaoespecialistas WHERE id_fisioterapeuta = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
