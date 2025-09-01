<?php

require_once "conexion.php";

class ModeloCsxp{






	static public function mdlCrearAbono($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO cxp (id_compra, id_proveedor, id_metodo, importe, documento, observacion) VALUES (:id_compra, :id_proveedor, :id_metodo, :importe, :documento, :observacion)");

		$stmt -> bindParam(":id_compra", $datos["id_compra"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_metodo", $datos["id_metodo"], PDO::PARAM_STR);
		$stmt -> bindParam(":importe", $datos["importe"], PDO::PARAM_STR);
		$stmt -> bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt -> bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		}else{
			return "error";
		}
		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos
	}



















	static public function mdlMostrarAdeudoTotalProveedorC($id_proveedor){

		if($id_proveedor != null){
			$stmt = Conexion::conectar()->prepare("SELECT proveedores.id_proveedor, proveedores.nombre, SUM(compras.saldo_actual) as adeudo_total FROM `compras` INNER JOIN proveedores on compras.id_proveedor = proveedores.id_proveedor WHERE proveedores.id_proveedor = :id_proveedor");

		$stmt -> bindParam(":id_proveedor", $id_proveedor, PDO::PARAM_INT);//Aquí enlazamos un el parametro que se manda por PDO por ejemplo la sentencia de arriba manda por PDO el :$valor por lo que lo tenemos que enlazar el parametro, entonces se le dice que vamos a comparar la columna con el valor y le vamos a decir que solo va a recibir string

		$stmt -> execute(); //ejecutamos todo lo anterior

		return $stmt -> fetch(); //aqui retornamos una sola fila que es la del usuario consultado

	}


		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos

	}



	static public function mdlCrearCxp($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO cxp (id_compra, id_proveedor, importe, id_usuario_creador) VALUES (:id_compra, :id_proveedor, :importe, :id_usuario_creador)");

		$stmt -> bindParam(":id_compra", $datos["id_compra"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		//$stmt -> bindParam(":id_metodo", $datos["id_metodo"], PDO::PARAM_STR);
		$stmt -> bindParam(":importe", $datos["importe"], PDO::PARAM_STR);
		//$stmt -> bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		//$stmt -> bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		}else{
			return "error";
		}
		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos
	}




}