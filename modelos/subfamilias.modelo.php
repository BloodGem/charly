<?php

require_once "conexion.php";

class ModeloSubfamilias{

	/*=============================================
	CREAR CATEGORIA
	=============================================*/

	static public function mdlCrearSubfamilia($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO subfamilias(subfamilia, id_familia, subfamilia_completa, id_usuario_creador) VALUES (:subfamilia, :id_familia, :subfamilia_completa, :id_usuario_creador)");

		$stmt -> bindParam(":subfamilia", $datos["subfamilia"], PDO::PARAM_STR);
		
        $stmt -> bindParam(":id_familia", $datos["id_familia"], PDO::PARAM_INT);
        
        $stmt -> bindParam(":subfamilia_completa", $datos["subfamilia_completa"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR AUTOS
	=============================================*/

	static public function mdlMostrarSubfamilias(){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM subfamilias");

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}











	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarSubfamiliasFiltro($columna, $valor){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM subfamilias WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}







	/*=============================================
	MOSTRAR AUTOS CON ARMADORA
	=============================================*/

	static public function mdlMostrarSubfamiliasModulo(){

			$stmt = Conexion::conectar()->prepare("SELECT subfamilias.id_subfamilia, subfamilias.subfamilia, familias.familia FROM subfamilias INNER JOIN familias ON subfamilias.id_familia = familias.id_familia");

			$stmt -> execute();

			return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

	}
	
	
	
	
	
	static public function mdlMostrarSubfamilia($id_subfamilia){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM subfamilias WHERE id_subfamilia = :id_subfamilia");

			$stmt -> bindParam(":id_subfamilia", $id_subfamilia, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();


		$stmt -> close();

		$stmt = null;

	}






	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarSubfamiliaFiltro($columna, $valor){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM subfamilias WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}









	/*=============================================
	EDITAR AUTO
	=============================================*/

	static public function mdlEditarSubfamilia($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE subfamilias SET subfamilia = :subfamilia, id_familia = :id_familia, subfamilia_completa = :subfamilia_completa, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_subfamilia = :id_subfamilia");

		$stmt -> bindParam(":subfamilia", $datos["subfamilia"], PDO::PARAM_STR);
		
        $stmt -> bindParam(":id_familia", $datos["id_familia"], PDO::PARAM_INT);
        $stmt -> bindParam(":subfamilia_completa", $datos["subfamilia_completa"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_subfamilia", $datos["id_subfamilia"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario_ult_mod", $datos["id_usuario_ult_mod"], PDO::PARAM_INT);

		if($stmt->execute() !== false && $stmt->rowCount() > 0){

			return "ok";

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function mdlEliminarSubfamilia($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM subfamilias WHERE id_subfamilia = :id_subfamilia");

		$stmt -> bindParam(":id_subfamilia", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlActualizarSubfamilia($columna, $valor, $id_subfamilia, $id_usuario_ult_mod){

		$stmt = Conexion::conectar()->prepare("UPDATE subfamilias SET $columna = :valor, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_subfamilia = :id_subfamilia");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_subfamilia", $id_subfamilia, PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario_ult_mod", $id_usuario_ult_mod, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}

