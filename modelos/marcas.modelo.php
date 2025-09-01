<?php

require_once "conexion.php";

class ModeloMarcas{

	/*=============================================
	CREAR MARCA
	=============================================*/

	static public function mdlCrearMarca($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO marcas(marca) VALUES (:marca)");

		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);


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

	static public function mdlCrearMarcaModulo($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO marcas(marca) VALUES (:marca)");

		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM marcas LIMIT 1;");

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

	static public function mdlMostrarMarcas(){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM marcas");

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

	static public function mdlMostrarMarca($id_marca){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM marcas WHERE id_marca = :id_marca");

			$stmt -> bindParam(":id_marca", $id_marca, PDO::PARAM_INT);

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

	static public function mdlMostrarMarcaFiltro($columna, $valor){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM marcas WHERE $columna = :$columna");

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

	static public function mdlEditarMarca($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE marcas SET marca = :marca WHERE id_marca = :id_marca");

		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_INT);

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

	static public function mdlEliminarMarca($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM marcas WHERE id_marca = :id_marca");

		$stmt -> bindParam(":id_marca", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}

