<?php

require_once "conexion.php";

class ModeloDevolucionesCompras{

	/*=============================================
	MOSTRAR UNA DEVOLUCION DE COMPRA
	=============================================*/

	static public function mdlMostrarDevolucionCompra($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM devoluciones_compras WHERE id_devolucion_compra = :id_devolucion_compra");

			$stmt -> bindParam(":id_devolucion_compra", $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		
		$stmt -> close();

		$stmt = null;

	}









	/*=============================================
	ACTUALIZAR DEVOLUCION DE COMPRA
	=============================================*/

	static public function mdlActualizarDevolucion($columna, $valor, $id_devolucion_compra, $id_usuario_ult_mod){

		$stmt = Conexion::conectar()->prepare("UPDATE devoluciones_compras SET $columna = :valor, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_devolucion_compra = :id_devolucion_compra");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_devolucion_compra", $id_devolucion_compra, PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario_ult_mod", $id_usuario_ult_mod, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}	







	






	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlCrearDevolucionCompra($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO devoluciones_compras (id_compra, id_proveedor, productos, total, id_motivo_devolucion_compra, id_sucursal, id_usuario_creador) VALUES (:id_compra, :id_proveedor, :productos, :total, :id_motivo_devolucion_compra, :id_sucursal, :id_usuario_creador)");

		$stmt->bindParam(":id_compra", $datos["id_compra"], PDO::PARAM_INT);
		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":id_motivo_devolucion_compra", $datos["id_motivo_devolucion_compra"], PDO::PARAM_INT);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM devoluciones LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){



			return $stmt2 -> fetch();

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}










	












	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlAplicarPago($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE devoluciones SET id_corte_caja = :id_corte_caja, saldo_actual = :saldo_actual, efectivo = :efectivo, tarjeta_debito = :tarjeta_debido, tarjeta_credito = :tarjeta_credito, transferencia = :transferencia, cambio = :cambio, pagado = 1, id_forma_pago = :id_forma_pago, id_cfdi = :id_cfdi, id_metodo_pago = :id_metodo_pago WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":id_corte_caja", $datos["id_corte_caja"], PDO::PARAM_INT);
		$stmt->bindParam(":saldo_actual", $datos["saldo_actual"], PDO::PARAM_STR);
		$stmt->bindParam(":efectivo", $datos["efectivo"], PDO::PARAM_STR);
		$stmt->bindParam(":tarjeta_debido", $datos["tarjeta_debido"], PDO::PARAM_STR);
		$stmt->bindParam(":tarjeta_credito", $datos["tarjeta_credito"], PDO::PARAM_STR);
		$stmt->bindParam(":transferencia", $datos["transferencia"], PDO::PARAM_STR);
		$stmt->bindParam(":cambio", $datos["cambio"], PDO::PARAM_STR);
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

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarDevolucion($id_devolucion_compra){

		$stmt = Conexion::conectar()->prepare("DELETE FROM devoluciones WHERE id_devolucion_compra = :id_devolucion_compra");

		$stmt -> bindParam(":id_devolucion_compra", $id_devolucion_compra, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	ACTUALIZAR VENTA
	=============================================*/

	static public function mdlDevolucionTimbrada($datosTimbrada){

		$stmt = Conexion::conectar()->prepare("UPDATE devoluciones SET facturado = 1,
					uuid = :uuid,
					certnumber = :certnumber,
					sello = :sello,
					sello_sat = :sello_sat,
					cadena_timbre = :cadena_timbre,
					no_certificado_sat = :no_certificado_sat,
					fecha_timbrado = :fecha_timbrado,
					ruta = :ruta, 
					id_usuario_ult_mod = :id_usuario_ult_mod
					WHERE id_devolucion_compra = :id_devolucion_compra");

		$stmt->bindParam(":id_devolucion_compra", $datosTimbrada["id_devolucion_compra"], PDO::PARAM_INT);
		$stmt->bindParam(":uuid", $datosTimbrada["uuid"], PDO::PARAM_STR);
		$stmt->bindParam(":certnumber", $datosTimbrada["certnumber"], PDO::PARAM_STR);
		$stmt->bindParam(":sello", $datosTimbrada["sello"], PDO::PARAM_STR);
		$stmt->bindParam(":sello_sat", $datosTimbrada["sello_sat"], PDO::PARAM_STR);
		$stmt->bindParam(":cadena_timbre", $datosTimbrada["cadena_timbre"], PDO::PARAM_STR);
		$stmt->bindParam(":no_certificado_sat", $datosTimbrada["no_certificado_sat"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datosTimbrada["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_timbrado", $datosTimbrada["fecha_timbrado"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_usuario_ult_mod", $datos["id_usuario_ult_mod"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}










	static public function consultaReporteDevolucionesCajero($id_usuario, $id_sucursal, $fecha1, $fecha2){
	$stmt = Conexion::conectar()->prepare("SELECT devoluciones.id_devolucion_compra, devoluciones.fecha_creacion, devoluciones.total, devoluciones.id_compra, compras.folio, devoluciones.id_corte_caja FROM devoluciones INNER JOIN cortes_caja ON devoluciones.id_corte_caja = cortes_caja.id_corte_caja INNER JOIN usuarios ON cortes_caja.id_usuario_creador = usuarios.id INNER JOIN compras ON devoluciones.id_compra = compras.id WHERE devoluciones.fecha_creacion BETWEEN :fecha1 AND :fecha2 AND cortes_caja.id_usuario_creador = :id_usuario AND devoluciones.id_sucursal = :id_sucursal ORDER BY devoluciones.id_devolucion_compra DESC");
	

	$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
    $stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);
    $stmt -> bindParam(":fecha1", $fecha1, PDO::PARAM_STR);
    $stmt -> bindParam(":fecha2", $fecha2, PDO::PARAM_STR);

            if($stmt -> execute()){

      return $stmt -> fetchAll();
    
    }else{

      return "error"; 

    }

        $stmt -> close();

        $stmt = null;

}










static public function consultaReporteDevolucionesVendedor($id_usuario, $id_sucursal, $fecha1, $fecha2){
	$stmt = Conexion::conectar()->prepare("SELECT devoluciones.id_devolucion_compra, devoluciones.fecha_creacion, devoluciones.total, devoluciones.id_compra, compras.folio, devoluciones.id_corte_caja FROM devoluciones INNER JOIN cortes_caja ON devoluciones.id_corte_caja = cortes_caja.id_corte_caja INNER JOIN usuarios ON cortes_caja.id_usuario_creador = usuarios.id INNER JOIN compras ON devoluciones.id_compra = compras.id WHERE devoluciones.fecha_creacion BETWEEN :fecha1 AND :fecha2 AND compras.id_usuario_creador = :id_usuario AND devoluciones.id_sucursal = :id_sucursal ORDER BY devoluciones.id_devolucion_compra DESC");

	$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
    $stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);
    $stmt -> bindParam(":fecha1", $fecha1, PDO::PARAM_STR);
    $stmt -> bindParam(":fecha2", $fecha2, PDO::PARAM_STR);

            if($stmt -> execute()){

      return $stmt -> fetchAll();
    
    }else{

      return "error"; 

    }

        $stmt -> close();

        $stmt = null;

}








		

static public function mdlMostrarDevolucionesCorteCaja($id_corte_caja){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM devoluciones WHERE id_corte_caja = :id_corte_caja");

			$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);

			if($stmt -> execute()){

			return $stmt -> fetchAll();
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	

	
}