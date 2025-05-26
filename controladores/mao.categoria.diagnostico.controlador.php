<?php
class CategoriasDiagnosticoControlador{
    static public function ctrListarCategoriasDiagnostico(){
        $categorias = CategoriasDiagnosticoModelo::mdlListarCategoriasDiagnostico();
        return $categorias;
    }

    static public function ctrRegistrarCategoriaDiagnostico($nombre_categoria, $descripcion_categoria){
        $registro = CategoriasDiagnosticoModelo::mdlRegistrarCategoriaDiagnostico($nombre_categoria, $descripcion_categoria);
        return $registro;
    }

    static public function ctrActualizarCategoriaDiagnostico($table, $data, $id, $nameId){
        $respuesta = CategoriasDiagnosticoModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
        return $respuesta;
    }

    static public function ctrEliminarCategoriaDiagnostico($table, $id, $nameId){
        $respuesta = CategoriasDiagnosticoModelo::mdlEliminarInformacion($table, $id, $nameId);
        return $respuesta;
    }

    static public function ctrListarNombreCategoriasDiagnostico(){
        $categorias = CategoriasDiagnosticoModelo::mdlListarNombreCategoriasDiagnostico();
        return $categorias;
    }
}
?>
