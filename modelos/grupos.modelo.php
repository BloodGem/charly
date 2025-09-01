<?php

require_once "conexion.php";

class ModeloGrupos{

	/*=============================================
	CREAR GRUPO
	=============================================*/

	static public function mdlCrearGrupo($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO grupos (nombre_grupo, permisos, id_usuario_creador) VALUES (:nombre_grupo, :permisos, :id_usuario_creador)");

		$stmt->bindParam(":nombre_grupo", $datos["nombre_grupo"], PDO::PARAM_STR);
		$stmt->bindParam(":permisos", $datos["permisos"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR GRUPOS
	=============================================*/

	static public function mdlMostrarGrupos(){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM grupos");

			$stmt -> execute();

			return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

	}



/*=============================================
	MOSTRAR GRUPO
	=============================================*/
	static public function mdlMostrarGrupo($id_grupo){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM grupos WHERE id_grupo = :id_grupo");

			$stmt -> bindParam(":id_grupo", $id_grupo, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}










	/*=============================================
	MOSTRAR GRUPO
	=============================================*/
	static public function mdlMostrarGrupo2($columna, $valor){


			if($columna != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM grupos WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR GRUPO
	=============================================*/

	static public function mdlEditarGrupo($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE grupos SET nombre_grupo = :nombre_grupo, permisos = :permisos, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_grupo = :id_grupo");

		$stmt -> bindParam(":nombre_grupo", $datos["nombre_grupo"], PDO::PARAM_STR);
		$stmt -> bindParam(":permisos", $datos["permisos"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_grupo", $datos["id_grupo"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario_ult_mod", $datos["id_usuario_ult_mod"], PDO::PARAM_INT);
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR GRUPO
	=============================================*/

	static public function mdlEliminarGrupo($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM grupos WHERE id_grupo = :id_grupo");

		$stmt -> bindParam(":id_grupo", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}

