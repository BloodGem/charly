<?php

class ControladorPartDevCom{

	static public function ctrIngresarPartidasDevolucionCompra($datos){

		$respuesta = ModeloPartDevCom::mdlIngresarPartidasDevolucionCompra($datos);

		return $respuesta;

	}

	static public function ctrMostrarPartidasDevolucionCompra($id_devolucion_compra){
		$respuesta = ModeloPartDevCom::mdlMostrarPartidasDevolucionCompra($id_devolucion_compra);

		return $respuesta;
	}



}

?>