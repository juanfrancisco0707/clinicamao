<?php

require_once "conexion.php";

class HorariosModelo
{

    /*===================================================================
    OBTENER LISTADO TOTAL DE HORARIOS PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarHorarios()
    {
        $stmt = Conexion::conectar()->prepare("SELECT 
                                                    h.id_horario,
                                                    h.id_fisioterapeuta,
                                                    e.nombre as nombre_fisioterapeuta,
                                                    h.dia_semana,
                                                    h.hora_inicio,
                                                    h.hora_fin
                                                FROM tblmao_horarios h
                                                INNER JOIN tblmaoespecialistas e ON h.id_fisioterapeuta = e.id_fisioterapeuta
                                                ORDER BY h.id_fisioterapeuta, 
                                                CASE h.dia_semana
                                                    WHEN 'Lunes' THEN 1
                                                    WHEN 'Martes' THEN 2
                                                    WHEN 'Miércoles' THEN 3
                                                    WHEN 'Jueves' THEN 4
                                                    WHEN 'Viernes' THEN 5
                                                    WHEN 'Sábado' THEN 6
                                                    WHEN 'Domingo' THEN 7
                                                END, h.hora_inicio ASC");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /*===================================================================
    REGISTRAR HORARIO UNO A UNO DESDE EL FORMULARIO DE HORARIOS
    ====================================================================*/
    static public function mdlRegistrarHorario($id_fisioterapeuta, $dia_semana, $hora_inicio, $hora_fin)
    {
        try {

            $stmt = Conexion::conectar()->prepare("INSERT INTO tblmao_horarios(id_fisioterapeuta, dia_semana, hora_inicio, hora_fin) 
                                                VALUES (:id_fisioterapeuta, :dia_semana, :hora_inicio, :hora_fin)");

            $stmt->bindParam(":id_fisioterapeuta", $id_fisioterapeuta, PDO::PARAM_INT);
            $stmt->bindParam(":dia_semana", $dia_semana, PDO::PARAM_STR);
            $stmt->bindParam(":hora_inicio", $hora_inicio, PDO::PARAM_STR);
            $stmt->bindParam(":hora_fin", $hora_fin, PDO::PARAM_STR);

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

    /*===================================================================
    OBTENER LISTADO DE HORARIOS POR FISIOTERAPEUTA PARA EL COMBOBOX
    ====================================================================*/
    static public function mdlListarHorariosPorFisioterapeuta($id_fisioterapeuta)
    {
        $stmt = Conexion::conectar()->prepare("SELECT id_horario, CONCAT(dia_semana, ' - ', TIME_FORMAT(hora_inicio, '%h:%i %p'), ' a ', TIME_FORMAT(hora_fin, '%h:%i %p')) AS horario
                                                FROM tblmao_horarios
                                                WHERE id_fisioterapeuta = :id_fisioterapeuta
                                                ORDER BY 
                                                CASE dia_semana
                                                    WHEN 'Lunes' THEN 1
                                                    WHEN 'Martes' THEN 2
                                                    WHEN 'Miércoles' THEN 3
                                                    WHEN 'Jueves' THEN 4
                                                    WHEN 'Viernes' THEN 5
                                                    WHEN 'Sábado' THEN 6
                                                    WHEN 'Domingo' THEN 7
                                                END, hora_inicio ASC");
        $stmt->bindParam(":id_fisioterapeuta", $id_fisioterapeuta, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
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
    LISTAR NOMBRE DE HORARIOS PARA INPUT DE AUTO COMPLETADO (si es necesario)
    ====================================================================*/
    static public function mdlListarNombreHorarios()
    {
        // Puedes ajustar esta consulta si necesitas un listado específico para autocompletado
        $stmt = Conexion::conectar()->prepare("SELECT id_horario, CONCAT(dia_semana, ' - ', TIME_FORMAT(hora_inicio, '%h:%i %p'), ' a ', TIME_FORMAT(hora_fin, '%h:%i %p')) AS horario
                                                FROM tblmao_horarios");

        $stmt->execute();

        return $stmt->fetchAll();
    }
    /*===================================================================
    OBTENER UN HORARIO POR ID
    ====================================================================*/
    static public function mdlObtenerHorarioPorId($id_horario){
        $stmt = Conexion::conectar()->prepare("SELECT  id_horario, id_fisioterapeuta, dia_semana, hora_inicio, hora_fin
                                                FROM tblmao_horarios
                                                WHERE id_horario = :id_horario");
        $stmt->bindParam(":id_horario", $id_horario, PDO::PARAM_INT);
        $stmt -> execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

