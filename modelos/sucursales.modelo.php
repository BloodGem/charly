<?php

require_once "conexion.php";

class ModeloSucursales{

	/*=============================================
	MOSTRAR SUCURSALES
	=============================================*/

	static public function mdlMostrarSucursales(){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM sucursales");

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}



	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarSucursal($valor){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM sucursales WHERE id_sucursal = $valor");


			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlEditarSucursal($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE sucursales SET
			ccer = :ccer,
			ckey = :ckey,
			clave = :clave,
			rfc = :rfc,
			nombre = :nombre,
			id_regimen = :id_regimen,
			email = :email,
			telefono1 = :telefono1,
			telefono2 = :telefono2,
			direccion = :direccion,
			no_interior = :no_interior,
			no_exterior = :no_exterior,
			colonia = :colonia,
			codigo_postal = :codigo_postal,
			ciudad = :ciudad,
			id_estado = :id_estado,
			sitio_web = :sitio_web
			where id_sucursal = :id_sucursal");






			$stmt -> bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
			$stmt -> bindParam(":ccer", $datos["ccer"], PDO::PARAM_STR);
			$stmt -> bindParam(":ckey", $datos["ckey"], PDO::PARAM_STR);
			$stmt -> bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
			$stmt -> bindParam(":rfc", $datos["rfc"], PDO::PARAM_STR);
			$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_regimen", $datos["id_regimen"], PDO::PARAM_INT);
			$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
			$stmt -> bindParam(":telefono1", $datos["telefono1"], PDO::PARAM_STR);
			$stmt -> bindParam(":telefono2", $datos["telefono2"], PDO::PARAM_STR);
			$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
			$stmt -> bindParam(":no_interior", $datos["no_interior"], PDO::PARAM_STR);
			$stmt -> bindParam(":no_exterior", $datos["no_exterior"], PDO::PARAM_STR);
			$stmt -> bindParam(":colonia", $datos["colonia"], PDO::PARAM_STR);
			$stmt -> bindParam(":codigo_postal", $datos["codigo_postal"], PDO::PARAM_INT);
			$stmt -> bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_INT);
			$stmt -> bindParam(":sitio_web", $datos["sitio_web"], PDO::PARAM_STR);
			

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

}

