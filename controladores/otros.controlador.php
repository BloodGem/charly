<?php

class ControladorOtros{


	static public function number_words($valor,$desc_moneda, $sep, $desc_decimal) {
     $arr = explode(".", $valor);
     $entero = $arr[0];
     if (isset($arr[1])) {
         $decimos = strlen($arr[1]) == 1 ? $arr[1] . '0' : $arr[1];
     }

     $fmt = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
     if (is_array($arr)) {
         $num_word = ($arr[0]>=1000000) ? "{$fmt->format($entero)} de $desc_moneda" : "{$fmt->format($entero)} $desc_moneda";
         if (isset($decimos) && $decimos > 0) {
             $num_word .= " $sep  {$fmt->format($decimos)} $desc_decimal";
         }
     }
     return $num_word;
}

/*=============================================
	MOSTRAR REGIMENES
	=============================================*/

	static public function ctrMostrarRegimenes($columna, $valor){

		$tabla = "regimenes";

		$respuesta = ModeloOtros::mdlMostrarRegimenes($tabla, $columna, $valor);

		return $respuesta;
	
	}


	/*=============================================
	MOSTRAR ESTADOS
	=============================================*/

	static public function ctrMostrarEstados($columna, $valor){

		$tabla = "estados";

		$respuesta = ModeloOtros::mdlMostrarEstados($tabla, $columna, $valor);

		return $respuesta;
	
	}




	/*=============================================
	MOSTRAR METODOS	
	=============================================*/

	static public function ctrMostrarMetodosDePago(){


		$respuesta = ModeloOtros::mdlMostrarMetodosDePago();

		return $respuesta;
	
	}






	/*=============================================
	MOSTRAR FORMAS DE PAGO
	=============================================*/

	static public function ctrMostrarFormasDePago(){


		$respuesta = ModeloOtros::mdlMostrarFormasDePago();

		return $respuesta;
	
	}





	/*=============================================
	MOSTRAR METODO DE PAGO
	=============================================*/

	static public function ctrMostrarMetodoPago($id_metodo_pago){


		$respuesta = ModeloOtros::mdlMostrarMetodoPago($id_metodo_pago);

		return $respuesta;
	
	}






	/*=============================================
	MOSTRAR FORMA DE PAGO
	=============================================*/

	static public function ctrMostrarFormaPago($id_forma_pago){


		$respuesta = ModeloOtros::mdlMostrarFormaPago($id_forma_pago);

		return $respuesta;
	
	}





	/*=============================================
	MOSTRAR CFDI
	=============================================*/

	static public function ctrMostrarCFDI($id_cfdi){


		$respuesta = ModeloOtros::mdlMostrarCFDI($id_cfdi);

		return $respuesta;
	
	}





	/*=============================================
	MOSTRAR PERMISOS
	=============================================*/

	static public function ctrMostrarPermisos(){

		$respuesta = ModeloOtros::mdlMostrarPermisos();

		return $respuesta;
	
	}





	/*=============================================
	MOSTRAR PERIODOS
	=============================================*/

	static public function ctrMostrarPeriodosFG(){

		$respuesta = ModeloOtros::mdlMostrarPeriodosFG();

		return $respuesta;
	
	}





	/*=============================================
	MOSTRAR RANGO FECHAS PARA FACTURA GLOBAL
	=============================================*/

	static public function ctrMostrarRangoMesesFG(){

		$respuesta = ModeloOtros::mdlMostrarRangoMesesFG();

		return $respuesta;
	
	}








	/*=============================================
	MOSTRAR MOTIVOS DE DEVOLUCION
	=============================================*/

	static public function ctrMostrarMotivosDevoluciones(){

		$respuesta = ModeloOtros::mdlMostrarMotivosDevoluciones();

		return $respuesta;
	
	}





	/*=============================================
	MOSTRAR MOTIVOS DE DEVOLUCION
	=============================================*/

	static public function ctrMostrarMotivoDevolucion($id_motivo_devolucion){

		$respuesta = ModeloOtros::mdlMostrarMotivoDevolucion($id_motivo_devolucion);

		return $respuesta;
	
	}





	/*=============================================
	MOSTRAR MOTIVOS DE DEVOLUCION
	=============================================*/

	static public function ctrMostrarMotivosDevolucionesCompras(){

		$respuesta = ModeloOtros::mdlMostrarMotivosDevolucionesCompras();

		return $respuesta;
	
	}





	/*=============================================
	MOSTRAR MOTIVOS DE DEVOLUCION
	=============================================*/

	static public function ctrMostrarMotivoDevolucionCompra($id_motivo_devolucion_compra){

		$respuesta = ModeloOtros::mdlMostrarMotivoDevolucionCompra($id_motivo_devolucion_compra);

		return $respuesta;
	
	}

}