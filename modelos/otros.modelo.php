<?php

require_once "conexion.php";

class ModeloOtros{


/*=============================================
	MOSTRAR REGIMENES
	=============================================*/

	static public function mdlMostrarRegimenes($tabla, $columna, $valor){

		if($columna != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR ESTADOS
	=============================================*/

	static public function mdlMostrarEstados($tabla, $columna, $valor){

		if($columna != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}





	/*=============================================
	MOSTRAR METODOS
	=============================================*/

	static public function mdlMostrarMetodosDePago(){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM metodos_pago");

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


}






/*=============================================
	MOSTRAR FORMAS DE PAGO
	=============================================*/

	static public function mdlMostrarFormasDePago(){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM formas_pago");

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


}











	/*=============================================
	MOSTRAR METODO DE PAGO
	=============================================*/

	static public function mdlMostrarMetodoPago($id_metodo_pago){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM metodos_pago WHERE id_metodo_pago = :id_metodo_pago");

			$stmt -> bindParam(":id_metodo_pago", $id_metodo_pago, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;


}






/*=============================================
	MOSTRAR FORMA DE PAGO
	=============================================*/

	static public function mdlMostrarFormaPago($id_forma_pago){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM formas_pago WHERE id_forma_pago = :id_forma_pago");

			$stmt -> bindParam(":id_forma_pago", $id_forma_pago, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;


}






/*=============================================
	MOSTRAR CFDI
	=============================================*/

	static public function mdlMostrarCFDI($id_cfdi){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM cfdi WHERE id_cfdi = :id_cfdi");

			$stmt -> bindParam(":id_cfdi", $id_cfdi, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;


}






/*=============================================
	MOSTRAR PERMISOS
	=============================================*/

	static public function mdlMostrarPermisos(){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM permisos");

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


}



/*=============================================
	FOLEAJE
	=============================================*/

	static public function mdlIncrementarFolio($tipo){

		$stmt = Conexion::conectar()->prepare("UPDATE folios SET folio = folio+1 WHERE tipo = :tipo");

		$stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);

		$stmt2 = Conexion::conectar()->prepare("SELECT folio FROM folios WHERE tipo = :tipo");
		$stmt2 -> bindParam(":tipo", $tipo, PDO::PARAM_STR);

		if($stmt->execute() && $stmt2->execute()){

			return $stmt2 -> fetch();

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}










	/*=============================================
	MOSTRAR PERIODOS
	=============================================*/

	static public function mdlMostrarPeriodosFG(){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM periodos");

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


}





/*=============================================
	MOSTRAR RANGO DE FECHAS PARA LAS FACTURAS GLOBALES
	=============================================*/

	static public function mdlMostrarRangoMesesFG(){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM rango_meses");

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


}










/*=============================================
	MOSTRAR MOTIVOS DE DEVOLUCIONES DE VENTAS
	=============================================*/

	static public function mdlMostrarMotivosDevoluciones(){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM motivos_devoluciones");

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


}












/*=============================================
	MOSTRAR MOTIVO DE DEVOLUCION
	=============================================*/

	static public function mdlMostrarMotivoDevolucion($id_motivo_devolucion){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM motivos_devoluciones WHERE id_motivo_devolucion = :id_motivo_devolucion");

			$stmt -> bindParam(":id_motivo_devolucion", $id_motivo_devolucion, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;


}










/*=============================================
	MOSTRAR MOSTIVOS DE DEVOLUCIONES DE COMPRAS
	=============================================*/

	static public function mdlMostrarMotivosDevolucionesCompras(){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM motivos_devoluciones_compras");

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


}












/*=============================================
	MOSTRAR MOTIVO DE DEVOLUCION DE COMPRA
	=============================================*/

	static public function mdlMostrarMotivoDevolucionCompra($id_motivo_devolucion_compra){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM motivos_devoluciones_compras WHERE id_motivo_devolucion_compra = :id_motivo_devolucion_compra");

			$stmt -> bindParam(":id_motivo_devolucion_compra", $id_motivo_devolucion_compra, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;


}




}