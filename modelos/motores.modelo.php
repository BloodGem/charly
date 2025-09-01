<?php

require_once "conexion.php";

class ModeloMotores{

	/*=============================================
	CREAR MOTOR
	=============================================*/

	static public function mdlCrearMotor($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO motores(motor) VALUES (:motor)");

		$stmt -> bindParam(":motor", $datos["motor"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}










	/*=============================================
	CREAR MOTOR DESDE ALGUN MODULO
	=============================================*/

	static public function mdlCrearMotorModulo($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO motores(motor) VALUES (:motor)");

		$stmt -> bindParam(":motor", $datos["motor"], PDO::PARAM_STR);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM motores LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){



			return $stmt2 -> fetch();

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR MOTORES
	=============================================*/

	static public function mdlMostrarMotores(){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM motores");

			if($stmt -> execute()){
			    return $stmt -> fetchAll();
			}else{
			    return "error";
			}


		$stmt -> close();

		$stmt = null;

	}









	/*=============================================
	MOSTRAR MOTOR
	=============================================*/

	static public function mdlMostrarMotor($id_motor){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM motores WHERE id_motor = :id_motor");

			$stmt -> bindParam(":id_motor", $id_motor, PDO::PARAM_INT);

			if($stmt -> execute()){
			    return $stmt -> fetch();
			}else{
			    return "error";
			}

		

		$stmt -> close();

		$stmt = null;

	}










/*=============================================
	MOSTRAR MOTOR FILTRO
	=============================================*/

	static public function mdlMostrarMotorFiltro($columna, $valor){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM motores WHERE $columna = :$columna");

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
	EDITAR MOTOR
	=============================================*/

	static public function mdlEditarMotor($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE motores SET motor = :motor WHERE id_motor = :id_motor");

		$stmt -> bindParam(":motor", $datos["motor"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_motor", $datos["id_motor"], PDO::PARAM_INT);

		if($stmt->execute() !== false && $stmt->rowCount() > 0){

			return "ok";

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR MOTOR
	=============================================*/

	static public function mdlEliminarMotor($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM motores WHERE id_motor = :id_motor");

		$stmt -> bindParam(":id_motor", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}

