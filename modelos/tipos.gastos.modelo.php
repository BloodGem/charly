<?php

require_once "conexion.php";

class ModeloTiposGastos{

	/*=============================================
	CREAR TIPO DE GASTO
	=============================================*/

	static public function mdlCrearTipoGasto($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO tipos_gastos(tipo_gasto, id_usuario_creador) VALUES (:tipo_gasto, :id_usuario_creador)");

		$stmt->bindParam(":tipo_gasto", $datos['tipo_gasto'], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_creador", $datos['id_usuario_creador'], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR TIPO DE GASTO
	=============================================*/

	static public function mdlMostrarTiposGastos($columna, $valor){

		if($columna != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM tipos_gastos WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM tipos_gastos");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR TIPO DE GASTO
	=============================================*/

	static public function mdlEditarTipoGasto($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE tipos_gastos SET tipo_gasto = :tipo_gasto, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_tipo_gasto = :id_tipo_gasto");

		$stmt -> bindParam(":tipo_gasto", $datos["tipo_gasto"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_tipo_gasto", $datos["id_tipo_gasto"], PDO::PARAM_INT);
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
	BORRAR TIPO DE GASTO
	=============================================*/

	static public function mdlEliminarTipoGasto($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM tipos_gastos WHERE id_tipo_gasto = :id_tipo_gasto");

		$stmt -> bindParam(":id_tipo_gasto", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}

