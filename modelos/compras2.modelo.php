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

		$stmt = Conexion::conectar()->prepare("INSERT INTO compras (id_proveedor, productos, total, cambiar_precios, id_sucursal, id_usuario_creador) VALUES (:id_proveedor, :productos, :total, :cambiar_precios, :id_sucursal, :id_usuario_creador)");

		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":cambiar_precios", $datos["cambiar_precios"], PDO::PARAM_INT);
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

		$stmt = Conexion::conectar()->prepare("UPDATE compras SET  productos = :productos, total = :total, cambiar_precios = :cambiar_precios, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id = :id");

		$stmt->bindParam(":id", $datos["id_compra"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
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



	
}