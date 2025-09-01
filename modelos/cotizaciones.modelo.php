 <?php

require_once "conexion.php";

class ModeloCotizaciones{



		/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarCotizacion($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO cotizaciones (id_cliente, nombre, celular, productos, total, id_sucursal, id_vendedor) VALUES (:id_cliente, :nombre, :celular, :productos, :total, :id_sucursal, :id_vendedor)");

		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM cotizaciones LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){



			return $stmt2 -> fetch();

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}




	/*=============================================
	MOSTRAR COTIZACIONES
	=============================================*/

	static public function mdlMostrarCotizaciones(){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM cotizaciones ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}




		/*=============================================
	MOSTRAR COTIZACIONES
	=============================================*/

	static public function mdlMostrarCotizaciones2($columna, $valor){

		if($columna != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM cotizaciones WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		
		$stmt -> close();

		$stmt = null;

	}
	



	/*=============================================
	MOSTRAR COTIZACIONES
	=============================================*/

	static public function mdlMostrarCotizacion($id_cotizacion){

		if($id_cotizacion != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM cotizaciones WHERE id_cotizacion = :id_cotizacion");

			$stmt -> bindParam(":id_cotizacion", $id_cotizacion, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		
		$stmt -> close();

		$stmt = null;

	}

}