<?php

require_once "conexion.php";

class ModeloAutos{

	/*=============================================
	CREAR CATEGORIA
	=============================================*/

	static public function mdlCrearAuto($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO autos(auto, submarca, id_motor, id_armadora, auto_completo, id_usuario_creador) VALUES (:auto, :submarca, :id_motor, :id_armadora, :auto_completo, :id_usuario_creador)");

		$stmt -> bindParam(":auto", $datos["auto"], PDO::PARAM_STR);
		$stmt -> bindParam(":submarca", $datos["submarca"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_motor", $datos["id_motor"], PDO::PARAM_INT);
        $stmt -> bindParam(":id_armadora", $datos["id_armadora"], PDO::PARAM_INT);
        $stmt -> bindParam(":auto_completo", $datos["auto_completo"], PDO::PARAM_STR);
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

	static public function mdlMostrarAutos(){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM autos");

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}











	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarAutosFiltro($columna, $valor){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM autos WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}







	/*=============================================
	MOSTRAR AUTOS CON ARMADORA
	=============================================*/

	static public function mdlMostrarAutosModulo(){

			$stmt = Conexion::conectar()->prepare("SELECT autos.id_auto, autos.auto, autos.submarca, motores.motor FROM autos INNER JOIN motores ON autos.id_motor = motores.id_motor");

			$stmt -> execute();

			return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

	}
	
	
	
	
	
	static public function mdlMostrarAuto($id_auto){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM autos WHERE id_auto = :id_auto");

			$stmt -> bindParam(":id_auto", $id_auto, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();


		$stmt -> close();

		$stmt = null;

	}






	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarAutoFiltro($columna, $valor){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM autos WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}









	/*=============================================
	EDITAR AUTO
	=============================================*/

	static public function mdlEditarAuto($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE autos SET auto = :auto, submarca = :submarca, id_motor = :id_motor, auto_completo = :auto_completo, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_auto = :id_auto");

		$stmt -> bindParam(":auto", $datos["auto"], PDO::PARAM_STR);
		$stmt -> bindParam(":submarca", $datos["submarca"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_motor", $datos["id_motor"], PDO::PARAM_INT);
        $stmt -> bindParam(":auto_completo", $datos["auto_completo"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_auto", $datos["id_auto"], PDO::PARAM_INT);
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

	static public function mdlEliminarAuto($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM autos WHERE id_auto = :id_auto");

		$stmt -> bindParam(":id_auto", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}

