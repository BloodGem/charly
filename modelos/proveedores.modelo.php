<?php

require_once "conexion.php";

class ModeloProveedores{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProveedores(){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM proveedores ORDER BY nombre ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}



	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProveedor($id_proveedor){

		if($id_proveedor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM proveedores WHERE id_proveedor = :id_proveedor");

			$stmt -> bindParam(":id_proveedor", $id_proveedor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		$stmt -> close();

		$stmt = null;

	}








	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProveedor2($columna, $valor){

		if($columna != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM proveedores WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		$stmt -> close();

		$stmt = null;

	}











	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlCrearProveedor($datos){



		



		$stmt = Conexion::conectar()->prepare("INSERT INTO proveedores (
			nombre,
			nombre_comercial,
			rfc,
			email,
			telefono1,
			telefono2,
			direccion,
			no_interior,
			no_exterior,
			colonia,
			codigo_postal,
			ciudad,
			id_estado,
			dia_revpag,
			dias_credito,
			limite_credito,
			descuento,
			id_usuario_creador) VALUES (
			:nombre,
			:nombre_comercial,
			:rfc,
			:email,
			:telefono1,
			:telefono2,
			:direccion,
			:no_interior,
			:no_exterior,
			:colonia,
			:codigo_postal,
			:ciudad,
			:id_estado,
			:dia_revpag,
			:dias_credito,
			:limite_credito,
			:descuento,
			:id_usuario_creador)");

			
			$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":nombre_comercial", $datos["nombre_comercial"], PDO::PARAM_STR);
			$stmt -> bindParam(":rfc", $datos["rfc"], PDO::PARAM_STR);
			$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
			$stmt -> bindParam(":telefono1", $datos["telefono1"], PDO::PARAM_STR);
			$stmt -> bindParam(":telefono2", $datos["telefono2"], PDO::PARAM_STR);
			$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
			$stmt -> bindParam(":no_interior", $datos["no_interior"], PDO::PARAM_INT);
			$stmt -> bindParam(":no_exterior", $datos["no_exterior"], PDO::PARAM_INT);
			$stmt -> bindParam(":colonia", $datos["colonia"], PDO::PARAM_STR);
			$stmt -> bindParam(":codigo_postal", $datos["codigo_postal"], PDO::PARAM_INT);
			$stmt -> bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_INT);
			$stmt -> bindParam(":dia_revpag", $datos["dia_revpag"], PDO::PARAM_STR);
			$stmt -> bindParam(":dias_credito", $datos["dias_credito"], PDO::PARAM_STR);
			$stmt -> bindParam(":limite_credito", $datos["limite_credito"], PDO::PARAM_STR);
			$stmt -> bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
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
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProveedor($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE proveedores SET
			nombre =:nombre,
			nombre_comercial=:nombre_comercial,
			rfc=:rfc,
			email=:email,
			telefono1=:telefono1,
			telefono2=:telefono2,
			direccion=:direccion,
			no_interior=:no_interior,
			no_exterior=:no_exterior,
			colonia=:colonia,
			codigo_postal=:codigo_postal,
			ciudad=:ciudad,
			id_estado=:id_estado,
			dia_revpag=:dia_revpag,
			dias_credito=:dias_credito,
			limite_credito=:limite_credito,
			descuento=:descuento,
			id_usuario_ult_mod = :id_usuario_ult_mod
			where id_proveedor= :id_proveedor");






			$stmt -> bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
			$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":nombre_comercial", $datos["nombre_comercial"], PDO::PARAM_STR);
			$stmt -> bindParam(":rfc", $datos["rfc"], PDO::PARAM_STR);
			$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
			$stmt -> bindParam(":telefono1", $datos["telefono1"], PDO::PARAM_STR);
			$stmt -> bindParam(":telefono2", $datos["telefono2"], PDO::PARAM_STR);
			$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
			$stmt -> bindParam(":no_interior", $datos["no_interior"], PDO::PARAM_INT);
			$stmt -> bindParam(":no_exterior", $datos["no_exterior"], PDO::PARAM_INT);
			$stmt -> bindParam(":colonia", $datos["colonia"], PDO::PARAM_STR);
			$stmt -> bindParam(":codigo_postal", $datos["codigo_postal"], PDO::PARAM_INT);
			$stmt -> bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_INT);
			$stmt -> bindParam(":dia_revpag", $datos["dia_revpag"], PDO::PARAM_STR);
			$stmt -> bindParam(":dias_credito", $datos["dias_credito"], PDO::PARAM_STR);
			$stmt -> bindParam(":limite_credito", $datos["limite_credito"], PDO::PARAM_STR);
			$stmt -> bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
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
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProveedor($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM proveedores WHERE id_proveedor = :id_proveedor");

		$stmt -> bindParam(":id_proveedor", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



}