<?php

require_once "conexion.php";

class ModeloKardexProductos{

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarPartidaKarprod($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO kardex_productos (mo_tipo, mo_refer, mo_entsal, id_producto, mo_cant, mo_pu, mo_existencias, id_sucursal) VALUES (:mo_tipo, :mo_refer, :mo_entsal, :id_producto, :mo_cant, :mo_pu, :mo_existencias, :id_sucursal)");

		$stmt->bindParam(":mo_tipo", $datos["mo_tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":mo_refer", $datos["mo_refer"], PDO::PARAM_INT);
		$stmt->bindParam(":mo_entsal", $datos["mo_entsal"], PDO::PARAM_STR);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":mo_cant", $datos["mo_cant"], PDO::PARAM_INT);
		$stmt->bindParam(":mo_pu", $datos["mo_pu"], PDO::PARAM_STR);
		$stmt->bindParam(":mo_existencias", $datos["mo_existencias"], PDO::PARAM_INT);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);


		return array($stmt->execute(),
					$stmt->errorInfo());

		$stmt->close();
		$stmt = null;

	}







	/*=============================================
	MOSTRAR PARTVTA
	=============================================*/

	static public function mdlMostrarKarprod($karprod){

		if($karprod != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM kardex_productos WHERE karprod = :karprod");

			$stmt -> bindParam(":karprod", $karprod, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	
	
	
	
	
	
	
	
	/*=============================================
	MOSTRAR PARTVTA
	=============================================*/

	static public function mdlMostrarPartidasVenta($id_producto){

		if($id_producto != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM kardex_productos WHERE id_producto = :id_producto");

			$stmt -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchall();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	
	
	
	
	
	
	
	
	

	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarKarprod($columna, $valor, $karprod){

		$stmt = Conexion::conectar()->prepare("UPDATE kardex_productos SET $columna = :valor WHERE karprod = :karprod");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":karprod", $karprod, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlConvertirPartidasNotaFactura($mo_refer){

		if($mo_refer != null){

			$stmt = Conexion::conectar()->prepare("UPDATE kardex_productos SET mo_tipo = 'FACTURA' WHERE mo_tipo = 'NOTA' AND mo_refer = :mo_refer");

			$stmt -> bindParam(":mo_refer", $mo_refer, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		$stmt -> close();

		$stmt = null;

	}


}