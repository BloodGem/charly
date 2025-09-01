<?php

require_once "conexion.php";

class ModeloGlobal{
	static public function mdlEliminarCrearVista($sqlDrop, $sqlView){

		$stmt = Conexion::conectar()->prepare($sqlDrop);

		if($stmt -> execute()){
			$stmt2 = Conexion::conectar()->prepare($sqlView);
			if($stmt2 -> execute()){
				return "ok";
			}else{
				return "error";
			}
		}else{
			$stmt2 = Conexion::conectar()->prepare($sqlView);
			if($stmt2 -> execute()){
				return "ok";
			}else{
				return "error";
			}
		}

		

		

		$stmt -> close();

		$stmt = null;
	}

}


?>