<?php

class Conexion{

    static public function conectar(){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=bdclinica","root","clave",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
           // $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            return $conn;
        }
        catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }

    }
}
