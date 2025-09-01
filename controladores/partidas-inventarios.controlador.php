<?php

class ControladorPartidasInventarios{

	static public function ctrIngresarPartidaInventario($datos){
		$respuesta = ModeloPartidasInventarios::mdlIngresarPartidaInventario($datos);

		return $respuesta;
	}










	static public function ctrMostrarPartidasInventario($id_inventario){
		$respuesta = ModeloPartidasInventarios::mdlMostrarPartidasInventario($id_inventario);

		return $respuesta;
	}










	static public function ctrMostrarPartidaInventario($id_partida_inventario){
		$respuesta = ModeloPartidasInventarios::mdlMostrarPartidaInventario($id_partida_inventario);

		return $respuesta;
	}










	static public function ctrMostrarProductosAnaquelInventario($id_inventario, $anaquel){
		$respuesta = ModeloPartidasInventarios::mdlMostrarProductosAnaquelInventario($id_inventario, $anaquel);

		return $respuesta;
	}










	static public function ctrActualizarPartidaInventario($columna, $valor, $id_partida_inventario){
		$respuesta = ModeloPartidasInventarios::mdlActualizarPartidaInventario($columna, $valor, $id_partida_inventario);

		return $respuesta;
	}










	static public function ctrIngresarCantidadEncontrada($id_partida_inventario, $cantidad1, $cantidad2, $cantidad3, $cantidad4, $cantidad5){

        $existencias_encontradas = $cantidad1 + $cantidad2 + $cantidad3 + $cantidad4 + $cantidad5;

        $id_usuario_ult_mod = $_SESSION['id'];
        
        $respuesta = ModeloPartidasInventarios::mdlIngresarCantidadEncontrada($id_partida_inventario, $cantidad1, $cantidad2, $cantidad3, $cantidad4, $cantidad5, $existencias_encontradas, $id_usuario_ult_mod);
        
        return $respuesta;
    
    }

}

?>