<?php

require_once "conexion.php";

class ModeloVendedores{

	static public function mdlMostrarVendedores(){


		$stmt = Conexion::conectar()->prepare("SELECT * FROM vendedores");

		$stmt -> execute();

		return $stmt -> fetchall();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarVendedorIdVendedor($id_vendedor){

		if($id_vendedor != null){

$stmt = Conexion::conectar()->prepare("SELECT * FROM vendedores WHERE id_vendedor = :id_vendedor");

		$stmt -> bindParam(":id_vendedor", $id_vendedor, PDO::PARAM_INT);

		$stmt -> execute(); //ejecutamos todo lo anterior

		return $stmt -> fetch(); //aqui retornamos una sola fila que es la del usuario consultado

		}

		

		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos

	}











	static public function mdlMostrarVendedor($columna, $valor){

		if($columna != null && $valor != null){

$stmt = Conexion::conectar()->prepare("SELECT * FROM vendedores WHERE $columna = :valor");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt -> execute(); //ejecutamos todo lo anterior

		return $stmt -> fetch(); //aqui retornamos una sola fila que es la del usuario consultado

		}

		

		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos

	}





	static public function mdlMostrarVendedor2($id_vendedor){


$stmt = Conexion::conectar()->prepare("SELECT * FROM vendedores WHERE id_vendedor = :id_vendedor");

		$stmt -> bindParam(":id_vendedor", $id_vendedor, PDO::PARAM_INT);

		$stmt -> execute(); //ejecutamos todo lo anterior

		return $stmt -> fetch(); //aqui retornamos una sola fila que es la del usuario consultado

		

		

		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos

	}










	static public function mdlCrearVendedor($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO vendedores (codigo, nombres, apellido_p, apellido_m, id_sucursal) VALUES (:codigo, :nombres, :apellido_p, :apellido_m, :id_sucursal)");

			$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
			$stmt -> bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
			$stmt -> bindParam(":apellido_p", $datos["apellido_p"], PDO::PARAM_STR);
			$stmt -> bindParam(":apellido_m", $datos["apellido_m"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);

			if ($stmt->execute()) {
				return "ok";
			}else{
				return "error";
			}
		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos
	}






/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarVendedor($columna1, $valor1, $columna2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE vendedores SET $columna1 = :valor1 WHERE $columna2 = :valor2");

		$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);

		$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
}