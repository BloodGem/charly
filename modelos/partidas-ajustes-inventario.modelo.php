<?php

require_once "conexion.php";

class ModeloPartidasAjustesInventario{

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarPartidasAjusteInventario($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO partidas_ajustes_inventario (id_ajuste_inventario, id_producto, cantidad) VALUES (:id_ajuste_inventario, :id_producto, :cantidad)");

		$stmt->bindParam(":id_ajuste_inventario", $datos["id_ajuste_inventario"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);


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

	static public function mdlMostrarPartidasAjusteInventario($id_ajuste_inventario){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM partidas_ajustes_inventario WHERE id_ajuste_inventario = :id_ajuste_inventario");

			$stmt -> bindParam(":id_ajuste_inventario", $id_ajuste_inventario, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();

		
		
		$stmt -> close();

		$stmt = null;

	}


}