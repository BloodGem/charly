<?php

require_once "conexion.php";

class ModeloPartres{

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarPartidasResurtido($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO partres (id_resurtido, id_producto, stock_actual, nivel_maximo, a_pedir) VALUES (:id_resurtido, :id_producto, :stock_actual, :nivel_maximo, :a_pedir)");

		$stmt->bindParam(":id_resurtido", $datos["id_resurtido"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":stock_actual", $datos["stock_actual"], PDO::PARAM_INT);
		$stmt->bindParam(":nivel_maximo", $datos["nivel_maximo"], PDO::PARAM_INT);
		$stmt->bindParam(":a_pedir", $datos["a_pedir"], PDO::PARAM_INT);


		if($stmt->execute()){



			return 'ok';

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}







	/*=============================================
	MOSTRAR PARTVTA
	=============================================*/

	static public function mdlMostrarPartres($id_partres){

		if($id_partres != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM partres WHERE id_partres = :id_partres");

			$stmt -> bindParam(":id_partres", $id_partres, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	
	
	
	
	
	
	
	
	/*=============================================
	MOSTRAR PARTVTA
	=============================================*/

	static public function mdlMostrarPartidasResurtido($id_resurtido){

		if($id_resurtido != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM partres WHERE id_resurtido = :id_resurtido");

			$stmt -> bindParam(":id_resurtido", $id_resurtido, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchall();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	
	
	
	
	
	
	
	
	

	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarPartres($columna, $valor, $id_partres){

		$stmt = Conexion::conectar()->prepare("UPDATE partres SET $columna = :valor WHERE id_partres = :id_partres");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_INT);
		$stmt -> bindParam(":id_partres", $id_partres, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}











	static public function mdlGuardaDatosPartidaResurtido($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE partres SET a_pedir = :a_pedir WHERE id_partres = :id_partres");

		$stmt -> bindParam(":id_partres", $datos['id_partres'], PDO::PARAM_INT);

		$stmt -> bindParam(":a_pedir", $datos['a_pedir'], PDO::PARAM_INT);

		if($stmt -> execute()){

			return 1;

		}else{

			return 0;	

		}

		$stmt -> close();

		$stmt = null;

	}











	static public function mdlEliminarPartidaResurtido($id_partres){


		$stmt = Conexion::conectar()->prepare("DELETE FROM partres WHERE id_partres = :id_partres");

		$stmt -> bindParam(":id_partres", $id_partres, PDO::PARAM_INT);

		if($stmt -> execute()){

			return 1;

		}else{

			return 0;	

		}

		$stmt -> close();

		$stmt = null;

	}

}