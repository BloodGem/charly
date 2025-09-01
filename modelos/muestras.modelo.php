<?php

require_once "conexion.php";

class ModeloMuestras{


	/*=============================================
	MOSTRAR COMPRAS
	=============================================*/

	static public function mdlMostrarMuestras(){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM muestras");

			$stmt -> execute();

			return $stmt -> fetchAll();

		
		
		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	MOSTRAR COMPRAS CLIENTE
	=============================================*/

	static public function mdlMostrarMuestra($id_muestra){

		if($id_compra != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM muestras WHERE id_muestra = :id_muestra");

			$stmt -> bindParam(":id_muestra", $id_muestra, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		
		$stmt -> close();

		$stmt = null;

	}












	/*=============================================
	REGISTRO DE COMPRA
	=============================================*/

	static public function mdlIngresarMuestra($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO muestras (id_producto, id_usuario, id_sucursal) VALUES (:id_producto, :id_usuario, :id_sucursal)");

		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM muestras LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){



			return $stmt2 -> fetch();

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}








	
}