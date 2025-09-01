<?php

require_once "conexion.php";

class ModeloCompras{


	/*=============================================
	MOSTRAR COMPRAS
	=============================================*/

	static public function mdlMostrarCompras($columna, $valor){

		if($columna != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM compras WHERE $columna = :$columna ORDER BY id ASC");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM compras ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	MOSTRAR COMPRAS CLIENTE
	=============================================*/

	static public function mdlMostrarCompra($id_compra){

		if($id_compra != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM compras WHERE id = :id_compra");

			$stmt -> bindParam(":id_compra", $id_compra, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		
		$stmt -> close();

		$stmt = null;

	}














	/*=============================================
	REGISTRO DE COMPRA
	=============================================*/

	static public function mdlIngresarCompra($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO compras (id_sucursal, id_usuario_creador) VALUES (:id_sucursal, :id_usuario_creador)");
		
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM compras LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){



			return $stmt2 -> fetch();

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}




	/*=============================================
	EDITAR COMPRA
	=============================================*/

static public function mdlEditarCompra($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE compras SET id_proveedor = :id_proveedor, total = :total, descuento1 = :descuento1, descuento2 = :descuento2, descuento3 = :descuento3, descuento4 = :descuento4, descuento5 = :descuento5, descuento_general = :descuento_general, observaciones = :observaciones, no_factura = :no_factura, tipo_compra = :tipo_compra, cambiar_precios = :cambiar_precios, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id = :id");

		$stmt->bindParam(":id", $datos["id_compra"], PDO::PARAM_INT);
		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento1", $datos["descuento1"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento2", $datos["descuento2"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento3", $datos["descuento3"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento4", $datos["descuento4"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento5", $datos["descuento5"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento_general", $datos["descuento_general"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":no_factura", $datos["no_factura"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_compra", $datos["tipo_compra"], PDO::PARAM_INT);
		$stmt->bindParam(":cambiar_precios", $datos["cambiar_precios"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario_ult_mod", $datos["id_usuario_ult_mod"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	ELIMINAR COMPRA
	=============================================*/

	static public function mdlEliminarCompra($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM compras WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



  /*=============================================
  ACTUALIZAR COMPRA
  =============================================*/

  static public function mdlActualizarCompra($columna, $valor, $id_compra, $id_usuario_ult_mod){

    $stmt = Conexion::conectar()->prepare("UPDATE compras SET $columna = :$columna, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id = :id_compra");

    $stmt -> bindParam(":id_compra", $id_compra, PDO::PARAM_INT);
    $stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);
    $stmt -> bindParam(":id_usuario_ult_mod", $id_usuario_ult_mod, PDO::PARAM_INT);




    if($stmt -> execute()){

      return "ok";
    
    }else{

      return "error"; 

    }

    $stmt -> close();

    $stmt = null;

  }










  static public function mdlMostrarSumaComprasRangoFechas($fecha1, $fecha2){
	    
            $stmt = Conexion::conectar()->prepare("SELECT SUM(total) AS total_compras FROM compras WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND estatus <> 0");  
        
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlMostrarUltimaCompraProducto($id_producto, $id_sucursal){
	    
            $stmt = Conexion::conectar()->prepare("SELECT compras.id, compras.fecha_confirmacion, partcom.* FROM partcom INNER JOIN compras ON partcom.id_compra = compras.id WHERE partcom.id_producto = $id_producto AND compras.id_sucursal = $id_sucursal ORDER BY compras.id DESC LIMIT 1");  
        
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}
	









	static public function mdlMostrarPenultimaCompraProducto($id_producto, $id_sucursal){
	    
            $stmt = Conexion::conectar()->prepare("SELECT compras.id, compras.fecha_confirmacion, partcom.* FROM partcom INNER JOIN compras ON partcom.id_compra = compras.id WHERE partcom.id_producto = $id_producto AND compras.id_sucursal = $id_sucursal ORDER BY compras.id DESC LIMIT 1,1");  
        
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlActualizarCompraConfirmada1($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE compras SET saldo_actual = :saldo_actual, estatus = :estatus, fecha_confirmacion = :fecha_confirmacion, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id = :id_compra");

		$stmt->bindParam(":id_compra", $datos["id_compra"], PDO::PARAM_INT);
		$stmt->bindParam(":saldo_actual", $datos["saldo_actual"], PDO::PARAM_STR);
		$stmt->bindParam(":estatus", $datos["estatus"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_confirmacion", $datos["fecha_confirmacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_usuario_ult_mod", $datos["id_usuario_ult_mod"], PDO::PARAM_INT);

		if($stmt->execute()){

			return 1;

		}else{

			return 0;
		
		}

		$stmt->close();
		$stmt = null;

	}







	
}