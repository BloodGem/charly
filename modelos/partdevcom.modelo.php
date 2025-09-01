<?php

require_once "conexion.php";

class ModeloPartDevCom{

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarPartidasDevolucionCompra($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO partdevcom (id_devolucion_compra, id_producto, cantidad, precio_unitario, precio_neto, total, descuento) VALUES (:id_devolucion_compra, :id_producto, :cantidad, :precio_unitario, :precio_neto, :total, :descuento)");

		$stmt->bindParam(":id_devolucion_compra", $datos["id_devolucion_compra"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":precio_unitario", $datos["precio_unitario"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_neto", $datos["precio_neto"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);


		if($stmt->execute()){



			return 'ok';

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}









	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarPartidasDevolucionCompra($id_devolucion_compra){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM partdevcom WHERE id_devolucion_compra = :id_devolucion_compra");

			$stmt -> bindParam(":id_devolucion_compra", $id_devolucion_compra, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();

		
		
		$stmt -> close();

		$stmt = null;

	}


}