<?php

require_once "conexion.php";

class ModeloFamilias{

	/*=============================================
	CREAR FAMILIA
	=============================================*/

	static public function mdlCrearFamilia($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO familias(familia) VALUES (:familia)");

		$stmt -> bindParam(":familia", $datos["familia"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}









	/*=============================================
	CREAR FAMILIA DESDE ALGUN MODULO
	=============================================*/

	static public function mdlCrearFamiliaModulo($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO familias (familia) VALUES (:familia)");

		$stmt -> bindParam(":familia", $datos["familia"], PDO::PARAM_STR);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM familias LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){



			return $stmt2 -> fetch();

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR FAMILIAS
	=============================================*/

	static public function mdlMostrarFamilias(){

	
			$stmt = Conexion::conectar()->prepare("SELECT * FROM familias");

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}









	/*=============================================
	MOSTRAR FAMILIAS
	=============================================*/

	static public function mdlMostrarFamilia($id_familia){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM familias WHERE id_familia = :id_familia");

			$stmt -> bindParam(":id_familia", $id_familia, PDO::PARAM_INT);

			if($stmt -> execute()){
			    return $stmt -> fetch();
			}else{
			    return "error";
			}


		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR FAMILIA
	=============================================*/

	static public function mdlEditarFamilia($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE familias SET familia = :familia WHERE id_familia = :id_familia");

		$stmt -> bindParam(":familia", $datos["familia"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_familia", $datos["id_familia"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR FAMILIA
	=============================================*/

	static public function mdlEliminarFamilia($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM familias WHERE id_familia = :id_familia");

		$stmt -> bindParam(":id_familia", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}

