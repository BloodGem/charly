<?php

require_once "conexion.php";

class ModeloPartidasInventarios{

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarPartidaInventario($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO partidas_inventarios (id_inventario, id_producto, anaquel_actual, ubicacion_actual, existencias_actuales) VALUES (:id_inventario, :id_producto, :anaquel_actual, :ubicacion_actual, :existencias_actuales)");

		$stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":ubicacion_actual", $datos["ubicacion_actual"], PDO::PARAM_STR);
		$stmt->bindParam(":anaquel_actual", $datos["anaquel_actual"], PDO::PARAM_STR);
		$stmt->bindParam(":existencias_actuales", $datos["existencias_actuales"], PDO::PARAM_INT);


		if($stmt->execute()){



			return 'ok';

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}










	static public function mdlMostrarPartidasInventario($id_inventario){

		if($id_inventario != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM partidas_inventarios WHERE id_inventario = :id_inventario");

			$stmt -> bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlMostrarPartidaInventario($id_partida_inventario){

		if($id_partida_inventario != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM partidas_inventarios WHERE id_partida_inventario = :id_partida_inventario");

			$stmt -> bindParam(":id_partida_inventario", $id_partida_inventario, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlMostrarProductosAnaquelInventario($id_inventario, $anaquel){


      $stmt = Conexion::conectar()->prepare("SELECT * FROM partidas_inventarios WHERE id_inventario = :id_inventario AND anaquel_actual = :anaquel_actual");

      $stmt -> bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);
      $stmt -> bindParam(":anaquel_actual", $anaquel, PDO::PARAM_STR);


    $stmt -> execute();

    return $stmt -> fetchAll();
    

    

    $stmt -> close();

    $stmt = null;

  

  }










static public function mdlIngresarCantidadEncontrada($id_partida_inventario, $cantidad1, $cantidad2, $cantidad3, $cantidad4, $cantidad5, $existencias_encontradas, $id_usuario_ult_mod){

		$stmt = Conexion::conectar()->prepare("UPDATE partidas_inventarios SET existencias_encontradas = :existencias_encontradas, cantidad1 = :cantidad1, cantidad2 = :cantidad2, cantidad3 = :cantidad3, cantidad4 = :cantidad4, cantidad5 = :cantidad5, fecha_ult_mod = NOW(), id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_partida_inventario = :id_partida_inventario");
		
		$stmt->bindParam(":existencias_encontradas", $existencias_encontradas, PDO::PARAM_INT);
		$stmt->bindParam(":cantidad1", $cantidad1, PDO::PARAM_INT);
		$stmt->bindParam(":cantidad2", $cantidad2, PDO::PARAM_INT);
		$stmt->bindParam(":cantidad3", $cantidad3, PDO::PARAM_INT);
		$stmt->bindParam(":cantidad4", $cantidad4, PDO::PARAM_INT);
		$stmt->bindParam(":cantidad5", $cantidad5, PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario_ult_mod", $id_usuario_ult_mod, PDO::PARAM_INT);
		$stmt->bindParam(":id_partida_inventario", $id_partida_inventario, PDO::PARAM_INT);

		if($stmt->execute()){

			return 1;

		}else{

			return 0;
		
		}

		$stmt->close();
		$stmt = null;

	}










	static public function mdlActualizarPartidaInventario($columna, $valor, $id_partida_inventario){

		$stmt = Conexion::conectar()->prepare("UPDATE partidas_inventarios SET $columna = :valor WHERE id_partida_inventario = :id_partida_inventario");
		
		
		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->bindParam(":id_partida_inventario", $id_partida_inventario, PDO::PARAM_INT);

		if($stmt->execute()){

			return 1;

		}else{

			return 0;
		
		}

		$stmt->close();
		$stmt = null;

	}






}


?>