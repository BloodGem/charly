<?php

require_once "conexion.php";

class ModeloGarantias{


	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarGarantias($tabla, $columna, $valor){

		if($columna != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $columna = :$columna ORDER BY id ASC");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}






	



	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarGarantia($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM garantias WHERE id_garantia = :id_garantia");

			$stmt -> bindParam(":id_garantia", $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		
		$stmt -> close();

		$stmt = null;

	}









							   /*=============================================
	ACTUALIZAR DEVOLUCION
	=============================================*/

	static public function mdlActualizarGarantia($columna, $valor, $id_garantia, $id_sucursal, $id_usuario_ult_mod){

		$stmt = Conexion::conectar()->prepare("UPDATE garantias SET $columna = :valor, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_garantia = :id_garantia AND id_sucursal = :id_sucursal");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_garantia", $id_garantia, PDO::PARAM_INT);
		$stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);
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

	static public function mdlCrearGarantiaVenta($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO garantias (id_venta, id_cliente, nombre_cliente, id_producto, cantidad, precio, total, descripcion_falla, fecha_probable, tipo_garantia, id_sucursal, id_usuario_creador) VALUES (:id_venta, :id_cliente, :nombre_cliente, :id_producto, :cantidad, :precio, :total, :descripcion_falla, :fecha_probable, 1, :id_sucursal, :id_usuario_creador)");

		$stmt->bindParam(":id_venta", $datos["id_venta"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_falla", $datos["descripcion_falla"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_probable", $datos["fecha_probable"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM garantias LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){



			return $stmt2 -> fetch();

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}










	static public function mdlCrearGarantiaCompra($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO garantias (id_compra, id_proveedor, id_producto, cantidad, precio, total, descripcion_falla, tipo_garantia, id_sucursal, id_usuario_creador) VALUES (:id_compra, :id_proveedor, :id_producto, :cantidad, :precio, :total, :descripcion_falla, 2, :id_sucursal, :id_usuario_creador)");

		$stmt->bindParam(":id_compra", $datos["id_compra"], PDO::PARAM_INT);
		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_falla", $datos["descripcion_falla"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM garantias LIMIT 1;");

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

	static public function mdlAutorizarGarantia($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE garantias SET autorizada = 1, quien_autoriza = :quien_autoriza, fecha_autorizacion = NOW(), id_usuario_autoriza = :id_usuario_autoriza WHERE id_garantia = :id_garantia");

		$stmt->bindParam(":id_garantia", $datos["id_garantia"], PDO::PARAM_INT);
		$stmt->bindParam(":quien_autoriza", $datos["quien_autoriza"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario_autoriza", $datos["id_usuario_autoriza"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}











	static public function mdlConfirmarGarantia($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE garantias SET confirmada1 = 1, tipo_cambio = :tipo_cambio, fecha_confirmacion = NOW(), id_usuario_confirma = :id_usuario_confirma WHERE id_garantia = :id_garantia");

		$stmt->bindParam(":id_garantia", $datos["id_garantia"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo_cambio", $datos["tipo_cambio"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario_confirma", $datos["id_usuario_confirma"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}










	static public function mdlEditarEnvioProductosProveedor($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE garantias SET fecha_envio = :fecha_envio, fecha_regreso = :fecha_regreso, valida_garantia = :valida_garantia, observaciones = :observaciones, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_garantia = :id_garantia");

		$stmt->bindParam(":id_garantia", $datos["id_garantia"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_envio", $datos["fecha_envio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_regreso", $datos["fecha_regreso"], PDO::PARAM_STR);
		$stmt->bindParam(":valida_garantia", $datos["valida_garantia"], PDO::PARAM_INT);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_ult_mod", $datos["id_usuario_ult_mod"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}











	static public function mdlConfirmar2Garantia($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE garantias SET confirmada2 = 1, fecha_confirmacion2 = NOW(), id_usuario_confirma2 = :id_usuario_confirma2 WHERE id_garantia = :id_garantia");

		$stmt->bindParam(":id_garantia", $datos["id_garantia"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario_confirma2", $datos["id_usuario_confirma2"], PDO::PARAM_INT);

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

	static public function mdlEliminarGarantia($id_garantia){

		$stmt = Conexion::conectar()->prepare("DELETE FROM garantias WHERE id_garantia = :id_garantia");

		$stmt -> bindParam(":id_garantia", $id_garantia, PDO::PARAM_INT);

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

	static public function mdlGarantiaTimbrada($datosTimbrada){

		$stmt = Conexion::conectar()->prepare("UPDATE garantias SET facturado = 1,
					uuid = :uuid,
					certnumber = :certnumber,
					sello = :sello,
					sello_sat = :sello_sat,
					cadena_timbre = :cadena_timbre,
					no_certificado_sat = :no_certificado_sat,
					fecha_timbrado = :fecha_timbrado,
					ruta = :ruta, 
					id_usuario_ult_mod = :id_usuario_ult_mod
					WHERE id_garantia = :id_garantia");

		$stmt->bindParam(":id_garantia", $datosTimbrada["id_garantia"], PDO::PARAM_INT);
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










	static public function consultaReporteGarantiasCajero($id_usuario, $id_sucursal, $fecha1, $fecha2){
	$stmt = Conexion::conectar()->prepare("SELECT garantias.id_garantia, garantias.fecha_creacion, garantias.total, garantias.id_venta, ventas.folio, garantias.id_corte_caja FROM garantias INNER JOIN cortes_caja ON garantias.id_corte_caja = cortes_caja.id_corte_caja INNER JOIN usuarios ON cortes_caja.id_usuario_creador = usuarios.id INNER JOIN ventas ON garantias.id_venta = ventas.id WHERE garantias.fecha_creacion BETWEEN :fecha1 AND :fecha2 AND cortes_caja.id_usuario_creador = :id_usuario AND garantias.id_sucursal = :id_sucursal ORDER BY garantias.id_garantia DESC");
	

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










static public function consultaReporteGarantiasVendedor($id_usuario, $id_sucursal, $fecha1, $fecha2){
	$stmt = Conexion::conectar()->prepare("SELECT garantias.id_garantia, garantias.fecha_creacion, garantias.total, garantias.id_venta, ventas.folio, garantias.id_corte_caja FROM garantias INNER JOIN cortes_caja ON garantias.id_corte_caja = cortes_caja.id_corte_caja INNER JOIN usuarios ON cortes_caja.id_usuario_creador = usuarios.id INNER JOIN ventas ON garantias.id_venta = ventas.id WHERE garantias.fecha_creacion BETWEEN :fecha1 AND :fecha2 AND ventas.id_usuario_creador = :id_usuario AND garantias.id_sucursal = :id_sucursal ORDER BY garantias.id_garantia DESC");

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








		

static public function mdlMostrarGarantiasCorteCaja($id_corte_caja){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM garantias WHERE id_corte_caja = :id_corte_caja");

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