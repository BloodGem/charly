<?php

require_once "conexion.php";

class ModeloPartvta{

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarPartidasVenta($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO partvta (id_venta, id_producto, cantidad, precio_unitario, precio_neto, descuento, precio_compra) VALUES (:id_venta, :id_producto, :cantidad, :precio_unitario, :precio_neto, :descuento, :precio_compra)");

		$stmt->bindParam(":id_venta", $datos["id_venta"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":precio_unitario", $datos["precio_unitario"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_neto", $datos["precio_neto"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_INT);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		

			return array($stmt->execute(),
					$stmt->errorInfo());
		

		$stmt->close();
		$stmt = null;

	}







	/*=============================================
	MOSTRAR PARTVTA
	=============================================*/

	static public function mdlMostrarPartvta($id_partvta){

		if($id_partvta != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM partvta WHERE id_partvta = :id_partvta");

			$stmt -> bindParam(":id_partvta", $id_partvta, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	
	
	
	
	
	
	
	
	/*=============================================
	MOSTRAR PARTVTA
	=============================================*/

	static public function mdlMostrarPartidasVenta($id_venta){

		if($id_venta != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM partvta WHERE id_venta = :id_venta");

			$stmt -> bindParam(":id_venta", $id_venta, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchall();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	
	
	
	
	
	
	
	
	

	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarPartvta($columna, $valor, $id_partvta){

		$stmt = Conexion::conectar()->prepare("UPDATE partvta SET $columna = :valor WHERE id_partvta = :id_partvta");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_partvta", $id_partvta, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


}