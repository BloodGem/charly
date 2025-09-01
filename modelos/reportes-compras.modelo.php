<?php

require_once "conexion.php";

class ModeloReportesCompras{





	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlReporteComprasMarca($sql){

			$stmt = Conexion::conectar()->prepare($sql);
		

			$stmt -> execute();

			return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}



	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlSelectProveedoresReporteComprasMarca($sql){

			$stmt = Conexion::conectar()->prepare($sql);
		

			$stmt -> execute();

			return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

}


?>