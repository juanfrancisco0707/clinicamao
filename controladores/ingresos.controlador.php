<?php

class IngresosControlador{

   
    static public function ctrListarIngresos($fechaDesde, $fechaHasta,$id_clinica,$rol){

        $ingresos = IngresosModelo::mdlListarIngresos($fechaDesde,$fechaHasta,$id_clinica,$rol);

        return $ingresos;
    }
    static public function ctrListarIngresosf($fechaDesde, $fechaHasta,$paciente,$folio,$id_clinica,$rol){

        $ingresos = IngresosModelo::mdlListarIngresosf($fechaDesde,$fechaHasta,$paciente,$folio,$id_clinica,$rol);

        return $ingresos;
    }
    static public function ctrObtenerFolioIngreso($clinica){
        
        $folio = ingresosModelo::mdlObtenerFolioIngreso($clinica);
        return $folio;

    }
    static public function ctrBuscarPagoCuotaIngresos($idexpediente,$idclinica){

        $expedientepagocuotaingreso = IngresosModelo::mdlBuscarPagoCuotaIngreso($idexpediente,$idclinica);
        return $expedientepagocuotaingreso;
    
    }    
//                         
    static public function ctrRegistrarIngresos( $datos,$folio,$id_clinica, $id_expediente,$fecha_pago,$total,$descripcion){

        $ingresos = IngresosModelo::mdlRegistrarIngresos( $datos,$folio,$id_clinica, $id_expediente,$fecha_pago,$total,$descripcion);

        return $ingresos;

    }
    static public function ctrActualizarIngresos($table, $data, $id, $nameId){

        $respuesta = ingresosModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
        
        return $respuesta;
        }
        
        static public function ctrEliminarIngresos($folio, $id_clinica)
        {
        $respuesta = ingresosModelo::mdlEliminarInformacion($folio, $id_clinica);
        
        return $respuesta;
        }
        static public function ctrImprimirIngresos($folio, $id_clinica)
        {
        $respuesta = ingresosModelo::mdlImprimirInformacion($folio, $id_clinica);
        
        return $respuesta;
        }
        static public function ctrImprimirTicket($folio)
        {
        $respuesta = ingresosModelo::mdlImprimirTicket($folio);
        
        return $respuesta;
        }
        




}