<?php

require_once "conexion.php";

class ModeloNotas{




/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlConvertirNotaFactura($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE ventas SET tipo_venta = 'FC', id_forma_pago = :id_forma_pago, id_cfdi = :id_cfdi, id_metodo_pago = :id_metodo_pago WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":id_forma_pago", $datos["id_forma_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cfdi", $datos["id_cfdi"], PDO::PARAM_STR);
		$stmt->bindParam(":id_metodo_pago", $datos["id_metodo_pago"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

	
}