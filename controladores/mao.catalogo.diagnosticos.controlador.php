<?php

// Es recomendable tener un autoloader o incluir el modelo aquí si no se usa uno.
// require_once "modelos/modelo.diagnosticos.php"; // Ajusta la ruta según tu estructura

class ControladorDiagnosticos {

    /*=============================================
    MOSTRAR DIAGNOSTICOS
    =============================================*/
    static public function ctrMostrarDiagnosticos($item, $valor) {
        $tabla = "catalogodiagnosticos";
        $respuesta = ModeloDiagnosticos::mdlMostrarDiagnosticos($tabla, $item, $valor);
        return $respuesta;
    }

    /*=============================================
    MOSTRAR CATEGORIAS DE DIAGNOSTICO
    =============================================*/
    static public function ctrMostrarCategoriasDiagnostico() {
        $tabla = "CategoriasDiagnostico"; // Nombre de la tabla de categorías
        $respuesta = ModeloDiagnosticos::mdlMostrarCategoriasDiagnostico($tabla);
        return $respuesta;
    }

    /*=============================================
    CREAR DIAGNOSTICO
    Este método sigue el ejemplo de ctrCrearServicio que toma parámetros directos.
    =============================================*/
    static public function ctrCrearDiagnostico($id_diagnostico, $codigo_estandar, $nombre_diagnostico, $descripcion_detallada, $id_categoria_diagnostico) {

        // Validar los datos antes de enviarlos al modelo
        // Adaptado del ejemplo: id, nombre y un "código/valor principal"
        // id_diagnostico (INT NOT NULL)
        // nombre_diagnostico (VARCHAR NOT NULL)
        // codigo_estandar (VARCHAR(20) DEFAULT NULL) - Tratado como 'precio' en el ejemplo (requerido por validación)
        if (!preg_match('/^[0-9]+$/', $id_diagnostico) ||
            !preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s.,()\-]{1,255}$/u', $nombre_diagnostico) ||
            // Si codigo_estandar es opcional y puede ser NULL/vacío, esta validación debe ajustarse.
            // Siguiendo el ejemplo de 'precio', se asume que si se valida aquí, no puede ser vacío.
            ($codigo_estandar !== null && $codigo_estandar !== "" && !preg_match('/^[a-zA-Z0-9\-_.\s]{1,20}$/', $codigo_estandar))
            // Si el código estándar es opcional y puede ser vacío, la validación anterior sería:
            // !preg_match('/^(|[a-zA-Z0-9\-_.\s]{1,20})$/', $codigo_estandar)
            // O si es estrictamente requerido como 'precio' en el ejemplo:
            // !preg_match('/^[a-zA-Z0-9\-_.\s]{1,20}$/', $codigo_estandar)
            // Por ahora, se valida si no es nulo/vacío.
        ) {
            return "error_validacion"; // O simplemente "error" como en el ejemplo
        }

        $tabla = "catalogodiagnosticos";
        $datos = array(
            "id_diagnostico"           => $id_diagnostico,
            "codigo_estandar"          => $codigo_estandar,
            "nombre_diagnostico"       => $nombre_diagnostico,
            "descripcion_detallada"    => $descripcion_detallada,
            "id_categoria_diagnostico" => $id_categoria_diagnostico
        );

        $respuesta = ModeloDiagnosticos::mdlIngresarDiagnostico($tabla, $datos);
        return $respuesta; // Debería ser "ok" o "error"
    }

    /*=============================================
    EDITAR DIAGNOSTICO
    =============================================*/
    static public function ctrEditarDiagnostico() {
        if (isset($_POST["iptIdDiagnostico"])) { // Campo hidden con el ID del diagnóstico a editar

            // Validaciones similares al ejemplo
            // iptIdDiagnostico (INT NOT NULL)
            // iptNombreDiagnostico (VARCHAR NOT NULL)
            // iptCodigoEstandar (VARCHAR(20) DEFAULT NULL) - Tratado como 'precio'
            if (preg_match('/^[0-9]+$/', $_POST["iptIdDiagnostico"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s.,()\-]{1,255}$/u', $_POST["iptNombreDiagnostico"]) &&
                // Para codigo_estandar: permite vacío o que cumpla el patrón.
                // La validación del ejemplo para 'precio' era !preg_match('/^[0-9.]+$/', $_POST["iptPrecio"]), lo que implica que no puede ser vacío.
                // Si codigo_estandar puede ser vacío, la siguiente regex es más adecuada:
                preg_match('/^(|[a-zA-Z0-9\-_.\s]{0,20})$/', $_POST["iptCodigoEstandar"])
                // Si debe tener contenido (como 'precio' en el ejemplo):
                // preg_match('/^[a-zA-Z0-9\-_.\s]{1,20}$/', $_POST["iptCodigoEstandar"])
            ) {

                $tabla = "catalogodiagnosticos";

                $datos = array(
                    "id_diagnostico"           => $_POST["iptIdDiagnostico"],
                    "codigo_estandar"          => $_POST["iptCodigoEstandar"], // Asume que el input se llama así
                    "nombre_diagnostico"       => $_POST["iptNombreDiagnostico"],
                    "descripcion_detallada"    => $_POST["iptDescripcionDetallada"], // Asume que el input se llama así
                    "id_categoria_diagnostico" => $_POST["selCategoriaDiagnostico"] // Asume que el select se llama así
                );

                $respuesta = ModeloDiagnosticos::mdlEditarDiagnostico($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>

                    Swal.fire({
                          icon: "success",
                          title: "El diagnóstico ha sido editado correctamente",
                          showConfirmButton: false,
                          timer: 1500
                        }).then(function(result){
                                window.location = "diagnosticos"; // Ajusta esta ruta
                            });
                    
                    </script>';
                } else {
                    echo '<script>

                    Swal.fire({
                          icon: "error",
                          title: "¡Error al editar el diagnóstico!",
                          text: "' . (is_array($respuesta) ? implode(" ", $respuesta) : $respuesta) . '",
                          showConfirmButton: false,
                          timer: 2500
                        });
                    
                    </script>';
                }
            } else {
                echo '<script>

                    Swal.fire({
                          icon: "error",
                          title: "¡El diagnóstico no puede ir vacío o llevar caracteres especiales en campos clave!",
                          showConfirmButton: false,
                          timer: 2000
                        });
                    
                    </script>';
            }
        }
    }

    /*=============================================
    BORRAR DIAGNOSTICO
    =============================================*/
    static public function ctrBorrarDiagnostico() {
        if (isset($_GET["idDiagnostico"])) { // Parámetro GET con el ID del diagnóstico a borrar
            $tabla = "catalogodiagnosticos";
            $idDiagnostico = $_GET["idDiagnostico"];

            // Podrías añadir una validación para $idDiagnostico si es necesario
            // if(!preg_match('/^[0-9]+$/', $idDiagnostico)){ /* error */ }

            $respuesta = ModeloDiagnosticos::mdlBorrarDiagnostico($tabla, $idDiagnostico);

            if ($respuesta == "ok") {
                echo '<script>

                Swal.fire({
                      icon: "success",
                      title: "El diagnóstico ha sido borrado correctamente",
                      showConfirmButton: false,
                      timer: 1500
                    }).then(function(result){
                            window.location = "diagnosticos"; // Ajusta esta ruta
                        });
                
                </script>';
            } else {
                 echo '<script>

                    Swal.fire({
                          icon: "error",
                          title: "¡Error al borrar el diagnóstico!",
                           text: "' . (is_array($respuesta) ? implode(" ", $respuesta) : $respuesta) . '",
                          showConfirmButton: false,
                          timer: 1500
                        });
                    
                    </script>';
            }
        }
    }

    /*=============================================
    OBTENER SIGUIENTE ID DE DIAGNOSTICO
    (Si id_diagnostico no es AUTO_INCREMENT y necesitas generarlo manualmente)
    =============================================*/
    static public function ctrObtenerSiguienteIdDiagnostico() {
        $tabla = "catalogodiagnosticos";
        $respuesta = ModeloDiagnosticos::mdlObtenerSiguienteIdDiagnostico($tabla);
        return $respuesta; // Devuelve un array como ['siguiente_id' => VALOR]
    }
}
?>