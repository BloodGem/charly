<?php

require_once "conexion.php";

class ModeloGastos{

	/*=============================================
	CREAR TIPO DE GASTO
	=============================================*/

	static public function mdlCrearGasto($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO gastos (id_tipo_gasto, total, archivo, comentario, id_usuario_creador) VALUES (:id_tipo_gasto, :total, :archivo, :comentario, :id_usuario_creador)");

		$stmt->bindParam(":id_tipo_gasto", $datos["id_tipo_gasto"], PDO::PARAM_INT);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":archivo", $datos["archivo"], PDO::PARAM_STR);
		$stmt->bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR GASTOS
	=============================================*/

	static public function mdlMostrarGastos($columna, $valor){

		if($columna != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM gastos WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM gastos");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR GASTO
	=============================================*/
	static public function mdlEditarGasto($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE gastos SET id_tipo_gasto = :id_tipo_gasto, total = :total, archivo = :archivo, comentario = :comentario, id_usuario_ult_mod = :id_usuario_ult_mod  WHERE id_gasto = :id_gasto");

		$stmt->bindParam(":id_tipo_gasto", $datos["id_tipo_gasto"], PDO::PARAM_INT);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":archivo", $datos["archivo"], PDO::PARAM_STR);
		$stmt->bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_gasto", $datos["id_gasto"], PDO::PARAM_INT);
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
	BORRAR GASTO
	=============================================*/

	static public function mdlEliminarGasto($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM gastos WHERE id_gasto = :id_gasto");

		$stmt -> bindParam(":id_gasto", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}

