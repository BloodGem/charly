 <?php

require_once "conexion.php";

class ModeloVentas22{
static public function mdlMostrarVenta22($id_venta22){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE id = :id_venta22");

			$stmt -> bindParam(":id_venta22", $id_venta22, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		
		
		$stmt -> close();

		$stmt = null;

	}
}
