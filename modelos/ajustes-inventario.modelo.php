<?php

require_once "conexion.php";

class ModeloAjustesInventario{


	/*=============================================
	MOSTRAR COMPRAS
	=============================================*/

	static public function mdlMostrarAjustesInventario($columna, $valor){

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

	static public function mdlMostrarAjusteInventario($id_ajuste_inventario){

		if($id_ajuste_inventario != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM ajustes_inventario WHERE id_ajuste_inventario = :id_ajuste_inventario");

			$stmt -> bindParam(":id_ajuste_inventario", $id_ajuste_inventario, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		
		$stmt -> close();

		$stmt = null;

	}














	/*=============================================
	REGISTRO DE COMPRA
	=============================================*/

	static public function mdlCrearAjusteInventario($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO ajustes_inventario (productos, tipo_ajuste, id_sucursal, id_usuario_creador) VALUES (:productos, :tipo_ajuste, :id_sucursal, :id_usuario_creador)");

		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_ajuste", $datos["tipo_ajuste"], PDO::PARAM_INT);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM ajustes_inventario LIMIT 1;");

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

static public function mdlEditarAjusteInventario($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE ajustes_inventario SET  productos = :productos, tipo_ajuste = :tipo_ajuste, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_ajuste_inventario = :id_ajuste_inventario");

		$stmt->bindParam(":id_ajuste_inventario", $datos["id_ajuste_inventario"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_ajuste", $datos["tipo_ajuste"], PDO::PARAM_INT);
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

	static public function mdlEliminarAjusteInventario($datos){

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

  static public function mdlActualizarAjusteInventario($columna, $valor, $id_ajuste_inventario, $id_usuario_ult_mod){

    $stmt = Conexion::conectar()->prepare("UPDATE ajustes_inventario SET $columna = :$columna, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_ajuste_inventario = :id_ajuste_inventario");

    $stmt -> bindParam(":id_ajuste_inventario", $id_ajuste_inventario, PDO::PARAM_INT);
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