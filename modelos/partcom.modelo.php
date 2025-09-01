<?php

require_once "conexion.php";

class ModeloPartCom{

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarPartidasCompra($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO partcom (id_compra, id_producto, clave_xml, cantidad, stock_actual, precio_unitario, precio, descuento, total) VALUES (:id_compra, :id_producto, :clave_xml, :cantidad, :stock_actual, :precio_unitario, :precio, :descuento, :total)");

		$stmt->bindParam(":id_compra", $datos["id_compra"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":clave_xml", $datos["clave_xml"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":stock_actual", $datos["stock_actual"], PDO::PARAM_INT);
		$stmt->bindParam(":precio_unitario", $datos["precio_unitario"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM partcom LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){



			return $stmt2 -> fetch();

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}












	static public function mdlGuardaDatosPartidaCompra($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE partcom SET cantidad = :cantidad, descuento = :descuento, precio_unitario = :precio_unitario, precio = :precio, total = :total WHERE id_partcom = :id_partcom");

		$stmt -> bindParam(":id_partcom", $datos['id_partcom'], PDO::PARAM_INT);

		$stmt -> bindParam(":cantidad", $datos['cantidad'], PDO::PARAM_INT);

		$stmt -> bindParam(":descuento", $datos['descuento'], PDO::PARAM_STR);

		$stmt -> bindParam(":precio_unitario", $datos['precio_unitario'], PDO::PARAM_STR);

		$stmt -> bindParam(":precio", $datos['precio'], PDO::PARAM_STR);

		$stmt -> bindParam(":total", $datos['total'], PDO::PARAM_STR);

		if($stmt -> execute()){

			return 1;

		}else{

			return 0;	

		}

		$stmt -> close();

		$stmt = null;

	}







	/*=============================================
	MOSTRAR PARTVTA
	=============================================*/

	static public function mdlMostrarPartCom($id_partcom){

		if($id_partcom != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM partcom WHERE id_partcom = :id_partcom");

			$stmt -> bindParam(":id_partcom", $id_partcom, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		$stmt -> close();

		$stmt = null;

	}











	static public function mdlMostrarPartCom2($id_producto, $id_compra){

		if($id_producto != null && $id_compra != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM partcom WHERE id_producto = :id_producto AND id_compra = :id_compra");

			$stmt -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);

			$stmt -> bindParam(":id_compra", $id_compra, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	
	
	
	
	
	
	
	
	/*=============================================
	MOSTRAR PARTVTA
	=============================================*/

	static public function mdlMostrarPartidasCompra($id_compra){

		if($id_compra != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM partcom WHERE id_compra = :id_compra");

			$stmt -> bindParam(":id_compra", $id_compra, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchall();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	
	
	

	
	
	
	
	
	
	

	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarPartCom($columna, $valor, $id_partcom){

		$stmt = Conexion::conectar()->prepare("UPDATE partcom SET $columna = :valor WHERE id_partcom = :id_partcom");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_partcom", $id_partcom, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlEliminarPartidaCompra($id_partcom){


		$stmt = Conexion::conectar()->prepare("DELETE FROM partcom WHERE id_partcom = :id_partcom");

		$stmt -> bindParam(":id_partcom", $id_partcom, PDO::PARAM_INT);

		if($stmt -> execute()){

			return 1;

		}else{

			return 0;	

		}

		$stmt -> close();

		$stmt = null;

	}

	


}