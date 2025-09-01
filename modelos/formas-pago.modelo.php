<?php

require_once "conexion.php";

class ModeloFormasPago{

	/*=============================================
	CREAR FAMILIA
	=============================================

	static public function mdlCrearFormaPago($datos){

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
	=============================================

	static public function mdlCrearFormaPagoModulo($datos){

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
	=============================================

	static public function mdlMostrarFormasPago($columna, $valor){

		if($columna != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM familias WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			if($stmt -> execute()){
			    return $stmt -> fetch();
			}else{
			    return "error";
			}

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM familias");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}*/









	/*=============================================
	MOSTRAR FORMA COBRO
	=============================================*/

	static public function mdlMostrarFormaPago($id_forma_pago){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM formas_pago WHERE id_forma_pago = :id_forma_pago");

			$stmt -> bindParam(":id_forma_pago", $id_forma_pago, PDO::PARAM_INT);

			if($stmt -> execute()){
			    return $stmt -> fetch();
			}else{
			    return "error";
			}


		$stmt -> close();

		$stmt = null;

	}









	/*=============================================
	MOSTRAR FORMAS PAGO RESTANTES PARA EL COBRO DE VENTAS (CV)
	=============================================*/

	static public function mdlMostrarFormasPagoRestantesCV($id_forma_pago){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM formas_pago WHERE id_forma_pago != :id_forma_pago AND id_forma_pago != 2 AND id_forma_pago != 5 AND id_forma_pago != 6 AND id_forma_pago != 7 AND id_forma_pago != 9 AND id_forma_pago != 10");

			$stmt -> bindParam(":id_forma_pago", $id_forma_pago , PDO::PARAM_INT);

			if($stmt -> execute()){
			    return $stmt -> fetchAll();
			}else{
			    return "error";
			}

		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR FAMILIA
	=============================================

	static public function mdlEditarFormaPago($datos){

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
	=============================================

	static public function mdlEliminarFormaPago($datos){

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
*/
}

