<?php

// Ajusta las rutas según la ubicación de tus archivos de controlador y modelo
//require_once "../controladores/controlador.diagnosticos.php"; // Asumiendo que el controlador se llama así
//require_once "../modelos/modelo.diagnosticos.php";     // Asumiendo que el modelo se llama así
require_once "../mao/controladores/mao.catalogo.diagnosticos.controlador.php"; 
require_once "../mao/modelos/mao.catalogo.diagnosticos.modelo.php";

  
class AjaxDiagnosticos {

    // Propiedades para los datos del diagnóstico
    public $id_diagnostico;
    public $codigo_estandar;
    public $nombre_diagnostico;
    public $descripcion_detallada;
    public $id_categoria_diagnostico;

    // Propiedad para la edición (basado en el ejemplo "idServicio")
    public $idDiagnosticoParaEditar;

    /*=============================================
    EDITAR DIAGNOSTICO (Obtener datos para el formulario de edición)
    =============================================*/
    public function ajaxObtenerDatosDiagnosticoParaEditar() {
        $item = "id_diagnostico";
        $valor = $this->idDiagnosticoParaEditar;

        // Llama al método del controlador para mostrar un diagnóstico específico
        $respuesta = ControladorDiagnosticos::ctrMostrarDiagnosticos($item, $valor);

        echo json_encode($respuesta);
    }

    /*=============================================
    LISTAR DIAGNOSTICOS (Para DataTables o Selects)
    =============================================*/
    public function ajaxListarDiagnosticos() {
        // Llama al método del controlador para mostrar todos los diagnósticos
        $diagnosticos = ControladorDiagnosticos::ctrMostrarDiagnosticos(null, null);
        echo json_encode($diagnosticos, JSON_UNESCAPED_UNICODE); // JSON_UNESCAPED_UNICODE para caracteres especiales
    }

    /*=============================================
    LISTAR CATEGORIAS DE DIAGNOSTICO
    =============================================*/
    public function ajaxListarCategoriasDiagnostico() {
        $categorias = ControladorDiagnosticos::ctrMostrarCategoriasDiagnostico();
        echo json_encode($categorias, JSON_UNESCAPED_UNICODE);
    }

    /*=============================================
    REGISTRAR DIAGNOSTICO
    =============================================*/
    public function ajaxRegistrarDiagnostico() {
        // Llama al método del controlador para crear un nuevo diagnóstico
        // El controlador ctrCrearDiagnostico espera los parámetros directamente
        $respuesta = ControladorDiagnosticos::ctrCrearDiagnostico(
            $this->id_diagnostico,
            $this->codigo_estandar,
            $this->nombre_diagnostico,
            $this->descripcion_detallada,
            $this->id_categoria_diagnostico
        );

        echo json_encode($respuesta); // Debería ser "ok" o "error"
    }

    /*=============================================
    ACTUALIZAR DIAGNOSTICO
    El ejemplo de ajaxActualizarServicio usa un método diferente en el controlador.
    Si sigues el patrón de ctrEditarServicio (que maneja $_POST directamente),
    esta función ajax podría no ser necesaria si la lógica de actualización
    se maneja directamente en el controlador con la respuesta HTML/JS.
    Si necesitas una respuesta JSON pura para la actualización, este es un enfoque:
    =============================================*/
    public function ajaxActualizarDiagnostico($datosDiagnostico) {
        // Este método asume que tienes un método en tu ControladorDiagnosticos
        // similar a ctrActualizarServicio del ejemplo, que toma un array de datos.
        // Si no, y usas ctrEditarDiagnostico que lee $_POST, esta función es diferente.

        // $tabla = "catalogodiagnosticos";
        // $id = $datosDiagnostico["id_diagnostico"]; // Asegúrate que el ID esté en los datos
        // $nameId = "id_diagnostico";

        // $respuesta = ControladorDiagnosticos::ctrActualizarDiagnostico($tabla, $datosDiagnostico, $id, $nameId);
        // echo json_encode($respuesta);

        // Por ahora, lo comentaré ya que ctrEditarDiagnostico en tu ejemplo de controlador
        // ya maneja la lógica de actualización y la respuesta con SweetAlert.
        // Si necesitas una respuesta JSON pura, necesitarías un método en el controlador
        // que devuelva JSON en lugar de scripts.
        echo json_encode(["mensaje" => "Función ajaxActualizarDiagnostico no implementada completamente según el patrón del controlador ctrEditarDiagnostico."]);
    }

    /*=============================================
    ELIMINAR DIAGNOSTICO
    Similar a la actualización, ctrBorrarDiagnostico maneja la respuesta.
    Si necesitas una respuesta JSON pura:
    =============================================*/
    public function ajaxEliminarDiagnostico() {
        // $tabla = "catalogodiagnosticos";
        // $id = $this->id_diagnostico; // Asumiendo que se setea esta propiedad
        // $nameId = "id_diagnostico";
        // $respuesta = ControladorDiagnosticos::ctrEliminarDiagnostico($tabla, $id, $nameId); // Necesitaría un método así en el controlador
        // echo json_encode($respuesta);
        echo json_encode(["mensaje" => "Función ajaxEliminarDiagnostico no implementada completamente según el patrón del controlador ctrBorrarDiagnostico."]);
    }

    /*=============================================
    OBTENER SIGUIENTE ID DE DIAGNOSTICO
    =============================================*/
    public function ajaxObtenerSiguienteIdDiagnostico() {
        $respuesta = ControladorDiagnosticos::ctrObtenerSiguienteIdDiagnostico();
        echo json_encode($respuesta); // Devuelve algo como {"siguiente_id": VALOR}
    }
}

/*=============================================
MANEJO DE PETICIONES AJAX
=============================================*/

// OBTENER DATOS PARA EDITAR DIAGNÓSTICO
if (isset($_POST["idDiagnosticoParaEditar"])) {
    $editarAjax = new AjaxDiagnosticos();
    $editarAjax->idDiagnosticoParaEditar = $_POST["idDiagnosticoParaEditar"];
    $editarAjax->ajaxObtenerDatosDiagnosticoParaEditar();
}

// LISTAR DIAGNÓSTICOS (ej: para DataTables)
if (isset($_POST["accion"]) && $_POST["accion"] == "listarDiagnosticos") {
    $listarAjax = new AjaxDiagnosticos();
    $listarAjax->ajaxListarDiagnosticos();
}

// LISTAR CATEGORÍAS DE DIAGNÓSTICO
if (isset($_POST["accion"]) && $_POST["accion"] == "listarCategoriasDiagnostico") {
    $listarCategoriasAjax = new AjaxDiagnosticos();
    $listarCategoriasAjax->ajaxListarCategoriasDiagnostico();
}

// REGISTRAR NUEVO DIAGNÓSTICO
if (isset($_POST["accion"]) && $_POST["accion"] == "registrarDiagnostico") {
    $registrarAjax = new AjaxDiagnosticos();
    $registrarAjax->id_diagnostico = $_POST["id_diagnostico"]; // Asegúrate de enviar este ID
    $registrarAjax->codigo_estandar = $_POST["codigo_estandar"];
    $registrarAjax->nombre_diagnostico = $_POST["nombre_diagnostico"];
    $registrarAjax->descripcion_detallada = $_POST["descripcion_detallada"];
    $registrarAjax->id_categoria_diagnostico = $_POST["id_categoria_diagnostico"];
    $registrarAjax->ajaxRegistrarDiagnostico();
}

// OBTENER SIGUIENTE ID DE DIAGNÓSTICO
if (isset($_POST["accion"]) && $_POST["accion"] == "obtenerSiguienteIdDiagnostico") {
    $siguienteIdAjax = new AjaxDiagnosticos();
    $siguienteIdAjax->ajaxObtenerSiguienteIdDiagnostico();
}

// NOTA SOBRE ACTUALIZAR Y ELIMINAR:
// En tu ejemplo de ControladorServicios, los métodos ctrEditarServicio y ctrBorrarServicio
// manejan directamente $_POST y $_GET respectivamente, y luego imprimen scripts de SweetAlert.
// Si sigues ese patrón para ControladorDiagnosticos, no necesitarías bloques `if` específicos aquí
// para "actualizar" o "eliminar" que llamen a métodos ajax como `ajaxActualizarDiagnostico`
// a menos que quieras una respuesta JSON pura y manejes la redirección/feedback en el lado del cliente (JavaScript).
// Los métodos `ctrEditarDiagnostico` y `ctrBorrarDiagnostico` se invocarían directamente
// por el envío del formulario (para editar) o un enlace con parámetros GET (para borrar).

?>