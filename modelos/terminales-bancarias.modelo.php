<?php

require_once "conexion.php";

class ModeloTerminalesBancarias{

	/*=============================================
	CREAR MOTOR
	=============================================*/

	static public function mdlCrearTerminalBancaria($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO terminales_bancarias(terminal_bancaria, id_sucursal, id_usuario_creador) VALUES (:terminal_bancaria, :id_sucursal, :id_usuario_creador)");

		$stmt -> bindParam(":terminal_bancaria", $datos["terminal_bancaria"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_STR);

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

	static public function mdlCrearTerminalBancariaModulo($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO terminales_bancarias(terminal_bancaria) VALUES (:terminal_bancaria)");

		$stmt -> bindParam(":terminal_bancaria", $datos["terminal_bancaria"], PDO::PARAM_STR);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM terminales_bancarias LIMIT 1;");

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

	static public function mdlMostrarTerminalesBancarias(){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM terminales_bancarias");

			if($stmt -> execute()){
			    return $stmt -> fetchAll();
			}else{
			    return "error";
			}


		$stmt -> close();

		$stmt = null;

	}












	static public function mdlMostrarTerminalesBancariasSucursal($id_sucursal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM terminales_bancarias WHERE id_sucursal = :id_sucursal");

			$stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);

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

	static public function mdlMostrarTerminalBancaria($id_terminal_bancaria){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM terminales_bancarias WHERE id_terminal_bancaria = :id_terminal_bancaria");

			$stmt -> bindParam(":id_terminal_bancaria", $id_terminal_bancaria, PDO::PARAM_INT);

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

	static public function mdlMostrarTerminalBancariaFiltro($columna, $valor){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM terminales_bancarias WHERE $columna = :$columna");

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

	static public function mdlEditarTerminalBancaria($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE terminales_bancarias SET terminal_bancaria = :terminal_bancaria, id_usuario_ult_mod = :id_usuario_ult_mod, fecha_ult_mod = NOW() WHERE id_terminal_bancaria = :id_terminal_bancaria");

		$stmt -> bindParam(":terminal_bancaria", $datos["terminal_bancaria"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_terminal_bancaria", $datos["id_terminal_bancaria"], PDO::PARAM_INT);
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
	BORRAR MOTOR
	=============================================*/

	static public function mdlEliminarTerminalBancaria($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM terminales_bancarias WHERE id_terminal_bancaria = :id_terminal_bancaria");

		$stmt -> bindParam(":id_terminal_bancaria", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}

