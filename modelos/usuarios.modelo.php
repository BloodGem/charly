<?php

require_once "conexion.php";

class ModeloUsuarios{
    
    
    static public function mdlInicioSesion($usuario, $password){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password");

		$stmt -> bindParam(":usuario", $usuario, PDO::PARAM_STR);
		$stmt -> bindParam(":password", $password, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();
		
		$stmt -> close();

		$stmt = null;

	}




	static public function mdlMostrarUsuario2($codigo){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE codigo = :codigo");

		$stmt -> bindParam(":codigo", $codigo, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();
		
		$stmt -> close();

		$stmt = null;

	}



	static public function mdlMostrarUsuarios($columna, $valor){

		if($columna != null){
$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE $columna = :$columna");

		$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios");
		$stmt -> execute();

		return $stmt -> fetchall();
		}

		

		$stmt -> close();

		$stmt = null;

	}








	static public function mdlMostrarVendedores(){


			$stmt = Conexion::conectar()->prepare("SELECT ventas.id_usuario_creador AS id_usuario, usuarios.nombre FROM ventas LEFT JOIN usuarios ON ventas.id_usuario_creador = usuarios.id GROUP BY ventas.id_usuario_creador ORDER BY usuarios.nombre ASC ");
		$stmt -> execute();

		return $stmt -> fetchall();
		

		

		$stmt -> close();

		$stmt = null;

	}





	static public function mdlMostrarCajeros(){


			$stmt = Conexion::conectar()->prepare("SELECT cortes_caja.id_usuario_creador AS id_usuario, usuarios.nombre FROM cortes_caja INNER JOIN usuarios ON cortes_caja.id_usuario_creador = usuarios.id GROUP BY cortes_caja.id_usuario_creador ORDER BY usuarios.nombre ASC ");
		$stmt -> execute();

		return $stmt -> fetchall();
		

		

		$stmt -> close();

		$stmt = null;

	}





	static public function mdlMostrarUsuariosSucursal($id_sucursal){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE id_sucursal = :id_sucursal ORDER BY nombre ASC ");

			$stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);


		$stmt -> execute();

		return $stmt -> fetchall();
		

		

		$stmt -> close();

		$stmt = null;

	}











	static public function mdlMostrarUsuario($id_usuario){

		if($id_usuario != null){

$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE id = :id_usuario");

		$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

		$stmt -> execute(); //ejecutamos todo lo anterior

		return $stmt -> fetch(); //aqui retornamos una sola fila que es la del usuario consultado

		}

		

		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos

	}



	static public function mdlCrearUsuario($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO usuarios (nombre, usuario, password, codigo, id_grupo, id_sucursal, id_usuario_creador) VALUES (:nombre, :usuario, :password, :codigo, :id_grupo, :id_sucursal, :id_usuario_creador)");

			$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
			$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
			$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_grupo", $datos["id_grupo"], PDO::PARAM_INT);
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

	static public function mdlEditarUsuario($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE usuarios SET usuario = :usuario, nombre = :nombre, password = :password, codigo = :codigo, id_grupo = :id_grupo, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id = :id_usuario");

        $stmt -> bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_grupo", $datos["id_grupo"], PDO::PARAM_INT);
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

	static public function mdlActualizarUsuario($columna1, $valor1, $id_usuario, $id_usuario_ult_mod){

		$stmt = Conexion::conectar()->prepare("UPDATE usuarios SET $columna1 = :$columna1, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id = :id_usuario");



        $stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
		$stmt -> bindParam(":".$columna1, $valor1, PDO::PARAM_STR);
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

	static public function mdlEliminarUsuario($id_usuario){

		$stmt = Conexion::conectar()->prepare("DELETE FROM usuarios WHERE id = :id_usuario");

		$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}
}