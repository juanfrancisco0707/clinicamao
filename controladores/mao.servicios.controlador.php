<?php
class ControladorServicios{

    
    /*=============================================
    MOSTRAR SERVICIOS
    =============================================*/

    static public function ctrMostrarServicios($item, $valor){

        $tabla = "tblmao_servicio";

        $respuesta = ModeloServicios::mdlMostrarServicios($tabla, $item, $valor);

        return $respuesta;
    }
    static public function ctrMostrarCategoriaServicios()
    {
          $tabla = "tblmao_categoria_servicios";

        $respuesta = ModeloServicios::mdlMostrarCategoriaServicios($tabla);

        return $respuesta;
    }

    /*=============================================
    CREAR SERVICIO
    =============================================*/
    /*===================================================================
    REGISTRAR Servicio
    ====================================================================*/
    static public function ctrCrearServicio($id_servicio, $nombre_servicio, $descripcion, $precio, $id_categoria){
    
        // Validar los datos antes de enviarlos al modelo
        if(!preg_match('/^[0-9]+$/', $id_servicio) ||
           !preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/', $nombre_servicio) ||
           !preg_match('/^[0-9.]+$/', $precio)){
            return "error";
        }
        
        // Llamar al modelo para registrar el servicio
    
       // $registroServicio = ServicioModelo::mdlRegistrarServicio($id_servicio, $nombre_servicio, $descripcion, $precio);
        $registroServicio = ServicioModelo::mdlRegistrarServicio($id_servicio, $nombre_servicio, $descripcion, $precio, $id_categoria);
        return $registroServicio;
    }
 

    /*=============================================
    EDITAR SERVICIO
    =============================================*/

    static public function ctrEditarServicio(){

        if(isset($_POST["iptIdServicio"])){

            if(preg_match('/^[0-9]+$/', $_POST["iptIdServicio"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/', $_POST["iptNombreServicio"]) &&
               preg_match('/^[0-9.]+$/', $_POST["iptPrecio"])){

                $tabla = "tblmao_servicio";

                $datos = array("id_servicio" => $_POST["iptIdServicio"],
                               "nombre_servicio" => $_POST["iptNombreServicio"],
                               "descripcion" => $_POST["iptDescripcion"],
                               "precio" => $_POST["iptPrecio"],
                               "id_categoria" => $_POST["selCategoria"]);

                $respuesta = ModeloServicios::mdlEditarServicio($tabla, $datos);

                if($respuesta == "ok"){

                    echo'<script>

                    Swal.fire({
                          icon: "success",
                          title: "El servicio ha sido editado correctamente",
                          showConfirmButton: false,
                          timer: 1500
                        }).then(function(result){
                                window.location = "servicios";
                            });
                    
                    </script>';

                }

            }else{

                echo'<script>

                    Swal.fire({
                          icon: "error",
                          title: "¡El servicio no puede ir vacío o llevar caracteres especiales!",
                          showConfirmButton: false,
                          timer: 1500
                        });
                    
                    </script>';

            }

        }

    }

    /*=============================================
    BORRAR SERVICIO
    =============================================*/

    static public function ctrBorrarServicio(){

        if(isset($_GET["idServicio"])){

            $tabla ="tblmao_servicio";
            $datos = $_GET["idServicio"];

            $respuesta = ModeloServicios::mdlBorrarServicio($tabla, $datos);

            if($respuesta == "ok"){

                echo'<script>

                Swal.fire({
                      icon: "success",
                      title: "El servicio ha sido borrado correctamente",
                      showConfirmButton: false,
                      timer: 1500
                    }).then(function(result){
                            window.location = "servicios";
                        });
                
                </script>';

            }

        }

    }
     /*=============================================
    OBTENER SIGUIENTE ID DE SERVICIO
    =============================================*/
    static public function ctrObtenerSiguienteIdServicio(){
        // Asegúrate que el nombre de la tabla aquí sea el correcto.
        $tabla = "tblmao_servicio"; 
        $respuesta = ModeloServicios::mdlObtenerSiguienteIdServicio($tabla);
        return $respuesta;
    }
}
class ServicioControlador{

    /*===================================================================
    OBTENER LISTADO TOTAL DE Servicios
    ====================================================================*/
    static public function ctrListarServicios(){
        
        $servicios = ServicioModelo::mdlListarServicios();

        return $servicios;

    }

    /*===================================================================
    REGISTRAR Servicio
    ====================================================================*/
    static public function ctrRegistrarServicio($id_servicio, $nombre_servicio, $descripcion, $precio, $id_categoria){
    
        $registroServicio = ServicioModelo::mdlRegistrarServicio($id_servicio, $nombre_servicio, $descripcion, $precio, $id_categoria);
    
        return $registroServicio;
    }
    
    /*===================================================================
    ACTUALIZAR Servicio
    ====================================================================*/
    static public function ctrActualizarServicio($table, $data, $id, $nameId){
        
        $respuesta = ServicioModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
        
        return $respuesta;
    }
    
    /*===================================================================
    ELIMINAR Servicio
    ====================================================================*/
    static public function ctrEliminarServicio($table, $id, $nameId)
    {
        $respuesta = ServicioModelo::mdlEliminarInformacion($table, $id, $nameId);
        
        return $respuesta;
    }
    
    /*===================================================================
    LISTAR NOMBRE DE Servicios PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function ctrListarNombreServicios(){
    
        $servicios = ServicioModelo::mdlListarNombreServicios();
    
        return $servicios;
    }
    
    /*===================================================================
    OBTENER UN SERVICIO POR ID
    ====================================================================*/
    static public function ctrObtenerServicioPorId($id_servicio){
        $servicio = ServicioModelo::mdlObtenerServicioPorId($id_servicio);
        return $servicio;
    }
}
