<?php
require_once "../controladores/mao.categoria.diagnostico.controlador.php";
require_once "../modelos/mao.categoria.diagnostico.modelo.php";

class AjaxCategoriasDiagnostico{
    public $id_categoria_diagnostico;
    public $nombre_categoria;
    public $descripcion_categoria;

    public function ajaxListarCategoriasDiagnostico(){
        $categorias = CategoriasDiagnosticoControlador::ctrListarCategoriasDiagnostico();
        echo json_encode($categorias, JSON_UNESCAPED_UNICODE);
    }

    public function ajaxRegistrarCategoriaDiagnostico(){                                          
        $categoria = CategoriasDiagnosticoControlador::ctrRegistrarCategoriaDiagnostico($this->nombre_categoria, $this->descripcion_categoria);
        echo json_encode($categoria);
    }  

    public function ajaxActualizarCategoriaDiagnostico($data){        
        $table = "CategoriasDiagnostico";
        $id = $_POST["id_categoria_diagnostico"];
        $nameId = "id_categoria_diagnostico";
        $respuesta = CategoriasDiagnosticoControlador::ctrActualizarCategoriaDiagnostico($table, $data, $id, $nameId);
        echo json_encode($respuesta);
    }

    public function ajaxEliminarCategoriaDiagnostico(){
        $table = "CategoriasDiagnostico"; 
        $id = $_POST["id_categoria_diagnostico"]; 
        $nameId = "id_categoria_diagnostico";
        $respuesta = CategoriasDiagnosticoControlador::ctrEliminarCategoriaDiagnostico($table, $id, $nameId);
        echo json_encode($respuesta);
    }
}

if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar categorias
    $categorias = new AjaxCategoriasDiagnostico();
    $categorias->ajaxListarCategoriasDiagnostico();
}

else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar Categoria
    $registrarCategoria = new AjaxCategoriasDiagnostico();
    $registrarCategoria->nombre_categoria = $_POST["nombre_categoria"];
    $registrarCategoria->descripcion_categoria = $_POST["descripcion_categoria"];
    $registrarCategoria->ajaxRegistrarCategoriaDiagnostico();
}

else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UNA Categoria
    $actualizarCategoria = new AjaxCategoriasDiagnostico();

    $data = array(
        "id_categoria_diagnostico" => $_POST["id_categoria_diagnostico"],
        "nombre_categoria" => $_POST["nombre_categoria"],
        "descripcion_categoria" => $_POST["descripcion_categoria"],
    );
                   
    $actualizarCategoria->ajaxActualizarCategoriaDiagnostico($data);
}

else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UNA Categoria
    $eliminarCategoria = new AjaxCategoriasDiagnostico();
    $eliminarCategoria->ajaxEliminarCategoriaDiagnostico();
}

else if(isset($_POST["accion"]) && $_POST["accion"] == 6){ // TRAER LISTADO DE categorias PARA EL AUTOCOMPLETE (Adaptar si es necesario)
    // $nombreCategoria = new AjaxCategoriasDiagnostico(); 
    // $nombreCategoria->ajaxListarNombreCategorias();  // Asumiendo que tienes esta función en el controlador y modelo
}

else if(isset($_POST["accion"]) && $_POST["accion"] == 7){ // OBTENER DATOS DE UNA categoria POR SU ID (Adaptar si es necesario)
    // $listaCategoria = new AjaxCategoriasDiagnostico();
    // $listaCategoria->id_categoria_diagnostico = $_POST["id_categoria_diagnostico"];
    // $listaCategoria->ajaxGetDatosCategoria(); // Asumiendo que tienes esta función en el controlador y modelo
}
?>