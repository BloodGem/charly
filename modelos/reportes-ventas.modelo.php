<?php

require_once "conexion.php";

class ModeloReportesVentas{




	/*=============================================
	MOSTRAR CAJEROS EN REPORTE DE VENTAS POR CAJERO
	=============================================*/

	static public function mdlSelectCajerosReporteVentasCajero($sql){

			$stmt = Conexion::conectar()->prepare($sql);
		

			$stmt -> execute();

			return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}



	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlReporteVentasCajero($sql){

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt -> execute();

			return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}





	static public function mdlMostrarRegistros($sql){

			$stmt = Conexion::conectar()->prepare($sql);
		

			$stmt -> execute();

			return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}





	static public function mdlMostrarUnRegistro($sql){

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt -> execute();

			return $stmt -> fetch();
		
		$stmt -> close();

		$stmt = null;

	}










	static public function mdlCrearRegistro($sql){

			$stmt = Conexion::conectar()->prepare($sql);

			if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();
		
		}
		
		$stmt -> close();

		$stmt = null;

	}





	static public function mdlActualizarRegistro($sql){

			$stmt = Conexion::conectar()->prepare($sql);

			if($stmt->execute()){

			return 1;

		}else{

			return 0;
		
		}
		
		$stmt -> close();

		$stmt = null;

	}









	static public function mdlBorrarDatosTabla($tabla){

			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla");

			if($stmt->execute()){

			return 1;

		}else{

			return 0;
		
		}
		
		$stmt -> close();

		$stmt = null;

	}










}


?>