<?php

require_once "conexion.php";

class ModeloComputadoras{


	static public function mdlMostrarComputadoras(){

		

		$stmt = Conexion::conectar()->prepare("SELECT * FROM computadoras");
		$stmt -> execute();

		return $stmt -> fetchall();
		

		

		$stmt -> close();

		$stmt = null;

	}



	static public function mdlMostrarComputadorasSucursal($id_sucursal){


		$stmt = Conexion::conectar()->prepare("SELECT * FROM computadoras WHERE id_sucursal = :id_sucursal ORDER BY computadora ASC ");

		$stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);


		$stmt -> execute();

		return $stmt -> fetchall();
		

		

		$stmt -> close();

		$stmt = null;

	}











	static public function mdlMostrarComputadora($id_computadora){

		if($id_computadora != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM computadoras WHERE id_computadora = :id_computadora");

			$stmt -> bindParam(":id_computadora", $id_computadora, PDO::PARAM_INT);

		$stmt -> execute(); //ejecutamos todo lo anterior

		return $stmt -> fetch(); //aqui retornamos una sola fila que es la del computadora consultado

	}



		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos

	}










	static public function mdlMostrarComputadora2($columna, $valor){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM computadoras WHERE $columna = :valor");

			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt -> execute(); 

		return $stmt -> fetch(); 

	

	

		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos

	}









	static public function mdlCrearComputadora($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO computadoras (codigo, computadora, imp_ventas, imp_caja, imp_almacen, imp_devoluciones, imp_compras, imp_cotizaciones, imp_garantias, id_sucursal, id_usuario_creador) VALUES (:codigo, :computadora, :imp_ventas, :imp_caja, :imp_almacen, :imp_devoluciones, :imp_compras, :imp_cotizaciones, :imp_garantias, :id_sucursal, :id_usuario_creador)");

		$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":computadora", $datos["computadora"], PDO::PARAM_STR);
		$stmt -> bindParam(":imp_ventas", $datos["imp_ventas"], PDO::PARAM_STR);
		$stmt -> bindParam(":imp_caja", $datos["imp_caja"], PDO::PARAM_STR);
		$stmt -> bindParam(":imp_almacen", $datos["imp_almacen"], PDO::PARAM_STR);
		$stmt -> bindParam(":imp_devoluciones", $datos["imp_devoluciones"], PDO::PARAM_STR);
		$stmt -> bindParam(":imp_compras", $datos["imp_compras"], PDO::PARAM_STR);
		$stmt -> bindParam(":imp_cotizaciones", $datos["imp_cotizaciones"], PDO::PARAM_STR);
		$stmt -> bindParam(":imp_garantias", $datos["imp_garantias"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos
	}



	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarComputadora($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE computadoras SET codigo = :codigo, computadora = :computadora, imp_ventas= :imp_ventas, imp_caja= :imp_caja, imp_almacen = :imp_almacen, imp_devoluciones= :imp_devoluciones, imp_compras = :imp_compras, imp_cotizaciones = :imp_cotizaciones, imp_garantias = :imp_garantias, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_computadora = :id_computadora");

		$stmt -> bindParam(":id_computadora", $datos["id_computadora"], PDO::PARAM_INT);
		$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":computadora", $datos["computadora"], PDO::PARAM_STR);
		$stmt -> bindParam(":imp_ventas", $datos["imp_ventas"], PDO::PARAM_STR);
		$stmt -> bindParam(":imp_caja", $datos["imp_caja"], PDO::PARAM_STR);
		$stmt -> bindParam(":imp_almacen", $datos["imp_almacen"], PDO::PARAM_STR);
		$stmt -> bindParam(":imp_devoluciones", $datos["imp_devoluciones"], PDO::PARAM_STR);
		$stmt -> bindParam(":imp_compras", $datos["imp_compras"], PDO::PARAM_STR);
		$stmt -> bindParam(":imp_cotizaciones", $datos["imp_cotizaciones"], PDO::PARAM_STR);
		$stmt -> bindParam(":imp_garantias", $datos["imp_garantias"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_usuario_ult_mod", $datos["id_usuario_ult_mod"], PDO::PARAM_INT);
		

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarComputadora($columna, $valor, $id_computadora, $id_usuario_ult_mod){

		$stmt = Conexion::conectar()->prepare("UPDATE computadoras SET $columna1 = :$columna1, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_computadora = :id_computadora");



		$stmt -> bindParam(":id_computadora", $id_computadora, PDO::PARAM_INT);
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




	/*=============================================
	ELIMINAR USUARIO
	=============================================*/

	static public function mdlEliminarComputadora($id_computadora){

		$stmt = Conexion::conectar()->prepare("DELETE FROM computadoras WHERE id_computadora = :id_computadora");

		$stmt -> bindParam(":id_computadora", $id_computadora, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}
}