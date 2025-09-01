<?php

require_once "conexion.php";

class ModeloClientes{

	/*=============================================
	MOSTRAR CLIENTES DINAMICO
	=============================================*/

	static public function mdlMostrarClientes($columna, $valor){

		if($columna != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM clientes WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM clientes");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}










static public function mdlMostrarClientes2(){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM clientes");

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}










	/*=============================================
	MOSTRAR CLIENTES DINAMICO
	=============================================*/

	static public function mdlMostrarCliente($id_cliente){

		if($id_cliente != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM clientes WHERE id_cliente = :id_cliente");

			$stmt -> bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		$stmt -> close();

		$stmt = null;

	}











	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlCrearCliente($datos){



		



		$stmt = Conexion::conectar()->prepare("INSERT INTO clientes (
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
			no_precio,
			password,
			id_regimen,
			estatus,
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
			:no_precio,
			:password,
			:id_regimen,
			1,
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
			$stmt -> bindParam(":no_precio", $datos["no_precio"], PDO::PARAM_INT);
			$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_regimen", $datos["id_regimen"], PDO::PARAM_INT);
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
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlCrearClienteModulo($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO clientes (
			nombre,
			rfc,
			email,
			telefono1,
			codigo_postal,
			id_regimen,
			no_precio,
			id_usuario_creador,
			password) VALUES (
			:nombre,
			:rfc,
			:email,
			:telefono1,
			:codigo_postal,
			:id_regimen,
			:no_precio,
			:id_usuario_creador,
			:password)");

			
			$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":rfc", $datos["rfc"], PDO::PARAM_STR);
			$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
			$stmt -> bindParam(":codigo_postal", $datos["codigo_postal"], PDO::PARAM_INT);
			$stmt -> bindParam(":id_regimen", $datos["id_regimen"], PDO::PARAM_INT);
			$stmt -> bindParam(":telefono1", $datos["telefono1"], PDO::PARAM_INT);
			$stmt -> bindParam(":no_precio", $datos["no_precio"], PDO::PARAM_INT);
			$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
			
			$stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);

			$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM clientes LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){



			return $stmt2 -> fetch();
			}else{
				return "error";
			}
		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos
	}











	/*=============================================
	EDITAR DATOS CORTOS DEL CLIENTE DESDE ALGUN MODULO
	=============================================*/
	static public function mdlEditarDatosCortosCliente($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE clientes SET
			nombre =:nombre,
			rfc=:rfc,
			email=:email,
			telefono1=:telefono1,
			codigo_postal=:codigo_postal,
			id_regimen=:id_regimen,
			no_precio=:no_precio,
			id_usuario_ult_mod = :id_usuario_ult_mod
			where id_cliente= :id_cliente");

			$stmt -> bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
			$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":rfc", $datos["rfc"], PDO::PARAM_STR);
			$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
			$stmt -> bindParam(":telefono1", $datos["telefono1"], PDO::PARAM_INT);
			$stmt -> bindParam(":codigo_postal", $datos["codigo_postal"], PDO::PARAM_INT);
			$stmt -> bindParam(":id_regimen", $datos["id_regimen"], PDO::PARAM_INT);
			$stmt -> bindParam(":no_precio", $datos["no_precio"], PDO::PARAM_INT);
			$stmt -> bindParam(":id_usuario_ult_mod", $datos["id_usuario_ult_mod"], PDO::PARAM_INT);


		if($stmt->execute()){

			return 1;
			}else{
				return 0;
			}
		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos
	}











	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarCliente($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE clientes SET
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
			no_precio=:no_precio,
			id_regimen=:id_regimen,
			id_usuario_ult_mod = :id_usuario_ult_mod
			where id_cliente= :id_cliente");






			$stmt -> bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
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
			$stmt -> bindParam(":no_precio", $datos["no_precio"], PDO::PARAM_INT);
			$stmt -> bindParam(":id_regimen", $datos["id_regimen"], PDO::PARAM_INT);
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

	static public function mdlEliminarCliente($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM clientes WHERE id_cliente = :id_cliente");

		$stmt -> bindParam(":id_cliente", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarCliente($columna1, $valor1, $valor, $id_usuario_ult_mod){

		$stmt = Conexion::conectar()->prepare("UPDATE clientes SET $columna1 = :$columna1, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_cliente = :id_cliente");

		$stmt -> bindParam(":".$columna1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id_cliente", $valor, PDO::PARAM_INT);
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