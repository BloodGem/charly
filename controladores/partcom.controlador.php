<?php

class ControladorPartCom{

	static public function ctrMostrarPartidasCompra($id_compra){
		$respuesta = ModeloPartCom::mdlMostrarPartidasCompra($id_compra);

		return $respuesta;
	}




	static public function ctrMostrarPartCom($id_partcom){
		$respuesta = ModeloPartCom::mdlMostrarPartCom($id_partcom);

		return $respuesta;
	}




	static public function ctrMostrarPartCom2($id_producto, $id_compra){
		$respuesta = ModeloPartCom::mdlMostrarPartCom2($id_producto, $id_compra);

		return $respuesta;
	}







	static public function ctrActualizarPartCom($columnaCantDev, $nuevaCantDev, $id_partcom){
		$respuesta = ModeloPartCom::mdlActualizarPartCom($columnaCantDev, $nuevaCantDev, $id_partcom);

		return $respuesta;
	}



}

?>