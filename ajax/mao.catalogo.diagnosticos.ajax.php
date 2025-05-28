<?php

// Ajusta las rutas según la ubicación de tus archivos de controlador y modelo
require_once "../controladores/mao.catalogo.diagnosticos.controlador.php";
require_once "../modelos/mao.catalogo.diagnosticos.modelo.php";

class AjaxDiagnosticos {

    // Propiedades para los datos del diagnóstico
    public $id_diagnostico;
    public $codigo_estandar;
    public $nombre_diagnostico;
    public $descripcion_detallada;
    public $id_categoria_diagnostico;

    // Propiedad para la edición (basado en el ejemplo "idServicio")
    public $idDiagnosticoParaEditar; // Usado para obtener datos para editar

    /*=============================================
    OBTENER DATOS DIAGNOSTICO PARA EDITAR (Equivalente a ajaxEditarServicio del ejemplo)
    =============================================*/
    public function ajaxObtenerDatosDiagnostico() { // Renombrado para claridad, similar a ajaxEditarServicio
        $item = "id_diagnostico";
        $valor = $this->idDiagnosticoParaEditar; // Usar la propiedad correcta

        $respuesta = ControladorDiagnosticos::ctrMostrarDiagnosticos($item, $valor);

        header('Content-Type: application/json');
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        exit;
    }

    /*=============================================
    LISTAR DIAGNOSTICOS (Para DataTables o Selects)
    =============================================*/
    public function ajaxListarDiagnosticos() {
        $diagnosticos = ControladorDiagnosticos::ctrMostrarDiagnosticos(null, null);

        header('Content-Type: application/json');
        echo json_encode($diagnosticos, JSON_UNESCAPED_UNICODE);
        exit;
    }

    /*=============================================
    LISTAR CATEGORIAS DE DIAGNOSTICO
    =============================================*/
    public function ajaxListarCategoriasDiagnostico() {
        $categorias = ControladorDiagnosticos::ctrMostrarCategoriasDiagnostico();

        header('Content-Type: application/json');
        echo json_encode($categorias, JSON_UNESCAPED_UNICODE);
        exit;
    }

    /*=============================================
    REGISTRAR DIAGNOSTICO
    =============================================*/
    public function ajaxRegistrarDiagnostico() {
        // El controlador ctrCrearDiagnostico espera los parámetros directamente
        $respuesta = ControladorDiagnosticos::ctrCrearDiagnostico(
            $this->id_diagnostico,
            $this->codigo_estandar,
            $this->nombre_diagnostico,
            $this->descripcion_detallada,
            $this->id_categoria_diagnostico
        );

        header('Content-Type: application/json');
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE); // El controlador debería devolver "ok" o "error"
        exit;
    }

    /*=============================================
    ACTUALIZAR DIAGNOSTICO
    =============================================*/
    public function ajaxActualizarDiagnostico($datos) {
        $tabla = "catalogodiagnosticos";
        // El ID del diagnóstico a actualizar se espera en $_POST["id_diagnostico"]
        $id = $_POST["id_diagnostico"];
        $nameId = "id_diagnostico";

        // Aquí necesitarías un método en ControladorDiagnosticos que maneje la actualización
        // y devuelva una respuesta JSON, similar a ServicioControlador::ctrActualizarServicio
        // Ejemplo: $respuesta = ControladorDiagnosticos::ctrActualizarDiagnostico($tabla, $datos, $id, $nameId);
        
        // Placeholder si el método del controlador no está listo para JSON o si ctrEditarDiagnostico maneja el POST completo
        $respuesta = ["mensaje" => "ControladorDiagnosticos::ctrActualizarDiagnostico no implementado para respuesta JSON o usa ctrEditarDiagnostico."]; 

        header('Content-Type: application/json');
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    /*=============================================
    ELIMINAR DIAGNOSTICO
    =============================================*/
    public function ajaxEliminarDiagnostico() {
        $table = "catalogodiagnosticos";
        // El ID del diagnóstico a eliminar se espera en $_POST["id_diagnostico"]
        $id = $_POST["id_diagnostico"];
        $nameId = "id_diagnostico";
        $respuesta = ControladorDiagnosticos::ctrEliminarDiagnosticoSimple($table, $id, $nameId);
    
        echo json_encode($respuesta);
        // Aquí necesitarías un método en ControladorDiagnosticos que maneje la eliminación
        // y devuelva una respuesta JSON, similar a ServicioControlador::ctrEliminarServicio
        // Ejemplo: $respuesta = ControladorDiagnosticos::ctrEliminarDiagnosticoJSON($tabla, $id, $nameId);

        // Placeholder si el método del controlador no está listo para JSON o si ctrBorrarDiagnostico maneja el GET completo
        //$respuesta = ["mensaje" => "ControladorDiagnosticos::ctrEliminarDiagnosticoJSON no implementado para respuesta JSON o usa ctrBorrarDiagnostico."];
       
    }

    /*=============================================
    OBTENER SIGUIENTE ID DE DIAGNOSTICO
    =============================================*/
    public function ajaxObtenerSiguienteIdDiagnostico() {
        $respuesta = ControladorDiagnosticos::ctrObtenerSiguienteIdDiagnostico();

        header('Content-Type: application/json');
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

/*=============================================
MANEJO DE PETICIONES AJAX
=============================================*/

// OBTENER DATOS PARA EDITAR DIAGNÓSTICO (cuando se hace clic en editar en la tabla)
// El ejemplo de servicios usa "idServicio" para esto. Adaptamos a "idDiagnosticoParaEditar"
if (isset($_POST["idDiagnosticoParaEditar"])) {
    $obtenerDatosAjax = new AjaxDiagnosticos();
    $obtenerDatosAjax->idDiagnosticoParaEditar = $_POST["idDiagnosticoParaEditar"];
    $obtenerDatosAjax->ajaxObtenerDatosDiagnostico();
}

// LISTAR DIAGNÓSTICOS (ej: para DataTables)
if (isset($_POST["accion"]) && $_POST["accion"] == "listarDiagnosticos") { // Acción 1 en tu ejemplo de servicios
    $listarAjax = new AjaxDiagnosticos();
    $listarAjax->ajaxListarDiagnosticos();
}

// LISTAR CATEGORÍAS DE DIAGNÓSTICO
if (isset($_POST["accion"]) && $_POST["accion"] == "listarCategoriasDiagnostico") { // Acción 22 en tu ejemplo de servicios
    $listarCategoriasAjax = new AjaxDiagnosticos();
    $listarCategoriasAjax->ajaxListarCategoriasDiagnostico();
}

// REGISTRAR NUEVO DIAGNÓSTICO
if (isset($_POST["accion"]) && $_POST["accion"] == "registrarDiagnostico") { // Acción 2 en tu ejemplo de servicios
    $registrarAjax = new AjaxDiagnosticos();
    $registrarAjax->id_diagnostico = $_POST["id_diagnostico"]; // Asegúrate de enviar este ID
    $registrarAjax->codigo_estandar = $_POST["codigo_estandar"];
    $registrarAjax->nombre_diagnostico = $_POST["nombre_diagnostico"];
    $registrarAjax->descripcion_detallada = $_POST["descripcion_detallada"];
    $registrarAjax->id_categoria_diagnostico = $_POST["id_categoria_diagnostico"];
    $registrarAjax->ajaxRegistrarDiagnostico();
}

// ACTUALIZAR DIAGNÓSTICO
if (isset($_POST['accion']) && $_POST['accion'] == "actualizarDiagnostico") { // Acción 4 en tu ejemplo de servicios
    $actualizarAjax = new AjaxDiagnosticos();
    // Los datos se recogen de $_POST dentro de la función ajaxActualizarDiagnostico
    // o se pasan como un array si el controlador lo espera así.
    // Siguiendo el ejemplo de AjaxServicios, $data se construye y se pasa.
    $datosParaActualizar = array(
        // "id_diagnostico" se tomará de $_POST["id_diagnostico"] dentro de la función ajaxActualizarDiagnostico
        "codigo_estandar"          => $_POST["codigo_estandar"],
        "nombre_diagnostico"       => $_POST["nombre_diagnostico"],
        "descripcion_detallada"    => $_POST["descripcion_detallada"],
        "id_categoria_diagnostico" => $_POST["id_categoria_diagnostico"]
    );
    $actualizarAjax->ajaxActualizarDiagnostico($datosParaActualizar);
}

// ELIMINAR DIAGNÓSTICO
if (isset($_POST['accion']) && $_POST['accion'] == "eliminarDiagnostico") { // Acción 5 en tu ejemplo de servicios (comentado)
    $eliminarAjax = new AjaxDiagnosticos();
    // El id_diagnostico se tomará de $_POST["id_diagnostico"] dentro de la función ajaxEliminarDiagnostico
    $eliminarAjax->ajaxEliminarDiagnostico();
}

// OBTENER SIGUIENTE ID DE DIAGNÓSTICO
if (isset($_POST["accion"]) && $_POST["accion"] == "obtenerSiguienteIdDiagnostico") { // "obtenerSiguienteId" en tu ejemplo
    $siguienteIdAjax = new AjaxDiagnosticos();
    $siguienteIdAjax->ajaxObtenerSiguienteIdDiagnostico();
}

?>
