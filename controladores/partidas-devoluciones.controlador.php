<?php

class ControladorPartidasDevoluciones{


	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function ctrIngresarPartidasDevolucion($datos){
		ModeloPartidasDevoluciones::mdlIngresarPartidasDevolucion($datos);
	}


	/*=============================================
	MOSTRAR MARCAS
	=============================================*/

	static public function ctrMostrarPartidasDevolucion($id_devolucion){

		$respuesta = ModeloPartidasDevoluciones::mdlMostrarPartidasDevolucion($id_devolucion);

		return $respuesta;
	
	}

}
