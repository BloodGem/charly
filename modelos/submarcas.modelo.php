<?php

require_once "conexion.php";

class ModeloSubmarcas{

	/*=============================================
	CREAR MARCA
	=============================================*/

	static public function mdlCrearSubmarca($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO submarcas(submarca) VALUES (:submarca)");

		$stmt -> bindParam(":submarca", $datos["submarca"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}










	/*=============================================
	CREAR MARCA DESDE ALGUN MODULO
	=============================================*/

	static public function mdlCrearSubmarcaModulo($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO submarcas(submarca) VALUES (:submarca)");

		$stmt -> bindParam(":submarca", $datos["submarca"], PDO::PARAM_STR);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM submarcas LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){



			return $stmt2 -> fetch();

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR MARCAS
	=============================================*/

	static public function mdlMostrarSubmarcas(){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM submarcas");

			if($stmt -> execute()){
			    return $stmt -> fetchAll();
			}else{
			    return "error";
			}


		$stmt -> close();

		$stmt = null;

	}



	static public function mdlMostrarSubmarcasFiltro($columna, $valor){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM submarcas WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			if($stmt -> execute()){
			    return $stmt -> fetchAll();
			}else{
			    return "error";
			}


		$stmt -> close();

		$stmt = null;

	}





	/*=============================================
	MOSTRAR MARCA
	=============================================*/

	static public function mdlMostrarSubmarca($id_submarca){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM submarcas WHERE id_submarca = :id_submarca");

			$stmt -> bindParam(":id_submarca", $id_submarca, PDO::PARAM_INT);

			if($stmt -> execute()){
			    return $stmt -> fetch();
			}else{
			    return "error";
			}

		

		$stmt -> close();

		$stmt = null;

	}










/*=============================================
	MOSTRAR MARCA FILTRO
	=============================================*/

	static public function mdlMostrarSubmarcaFiltro($columna, $valor){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM submarcas WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			if($stmt -> execute()){
			    return $stmt -> fetch();
			}else{
			    return "error";
			}

		

		$stmt -> close();

		$stmt = null;

	}










	/*=============================================
	EDITAR MARCA
	=============================================*/

	static public function mdlEditarSubmarca($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE submarcas SET submarca = :submarca WHERE id_submarca = :id_submarca");

		$stmt -> bindParam(":submarca", $datos["submarca"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_submarca", $datos["id_submarca"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR MARCA
	=============================================*/

	static public function mdlEliminarSubmarca($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM submarcas WHERE id_submarca = :id_submarca");

		$stmt -> bindParam(":id_submarca", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}

