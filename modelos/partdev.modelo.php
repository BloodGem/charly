<?php

require_once "conexion.php";

class ModeloPartdev{

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarPartidasDevolucion($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO partdev (id_devolucion, id_producto, cantidad, precio_unitario, descuento) VALUES (:id_devolucion, :id_producto, :cantidad, :precio_unitario, :descuento)");

		$stmt->bindParam(":id_devolucion", $datos["id_devolucion"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":precio_unitario", $datos["precio_unitario"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_INT);


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

	static public function mdlMostrarPartidasDevolucion($id_devolucion){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM partdev WHERE id_devolucion = :id_devolucion");

			$stmt -> bindParam(":id_devolucion", $id_devolucion, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();

		
		
		$stmt -> close();

		$stmt = null;

	}


}