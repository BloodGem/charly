<?php

require_once "conexion.php";
//require_once "conexionPruebas.php";

class ModeloInventarios{


	static public function mdlVerificarInventarioAbierto(){

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS contador FROM inventarios WHERE estatus = 0");

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}





	/*=============================================
	MOSTRAR inventarios
	=============================================*/

	static public function mdlMostrarInventarios(){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM inventarios");

			$stmt -> execute();

			return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

	}

static public function mdlCrearInventario($id_sucursal, $responsables, $participantes, $id_usuario_creador){

		//$sql = "INSERT INTO inventarios (id_sucursal, responsables, fecha_creacion, id_usuario_creador, estatus) VALUES ($id_sucursal, '$responsables', NOW(), $id_usuario, 0)";

		$stmt = Conexion::conectar()->prepare("INSERT INTO inventarios (id_sucursal, responsables, participantes, fecha_creacion, id_usuario_creador, estatus) VALUES (:id_sucursal, :responsables, :participantes, NOW(), :id_usuario_creador, 0)");

		$stmt->bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);
		$stmt->bindParam(":responsables", $responsables, PDO::PARAM_STR);
		$stmt->bindParam(":participantes", $participantes, PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_creador", $id_usuario_creador, PDO::PARAM_INT);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM inventarios LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){



			return $stmt2 -> fetch();

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}










	static public function mdlMostrarInventario($id_inventario){

	$stmt = Conexion::conectar()->prepare("SELECT * FROM inventarios WHERE id_inventario = :id_inventario");

	$stmt->bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlMostrarMovimientosInventario($id_inventario){

	$stmt = Conexion::conectar()->prepare("SELECT kardex_productos.id_producto, kardex_productos.mo_tipo, kardex_productos.mo_entsal, kardex_productos.mo_cant, kardex_productos.mo_existencias, productos.clave_producto, productos.descripcion_corta FROM kardex_productos INNER JOIN productos ON kardex_productos.id_producto = productos.id_producto WHERE kardex_productos.mo_refer = :id_inventario AND kardex_productos.mo_tipo = 'INVENTARIO' ORDER BY productos.descripcion_corta ASC");

	$stmt->bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlConfirmarInventario($id_inventario, $id_usuario_confirmacion){

		$stmt = Conexion::conectar()->prepare("UPDATE inventarios SET fecha_confirmacion = NOW(), id_usuario_confirmacion = :id_usuario_confirmacion, estatus = 1 WHERE id_inventario = :id_inventario");
		

		$stmt->bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario_confirmacion", $id_usuario_confirmacion, PDO::PARAM_INT);

		if($stmt->execute()){

			return 1;

		}else{

			return 0;
		
		}

		$stmt->close();
		$stmt = null;

		

		

	}












	static public function mdlVerificarInventario($id_inventario){

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(id_partida_inventario) AS contador FROM partidas_inventarios WHERE existencias_encontradas IS NULL AND id_inventario = :id_inventario");

		$stmt->bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlSubirArchivoPagoInventario($id_inventario, $ruta_archivo){

		$stmt = Conexion::conectar()->prepare("UPDATE inventarios SET ruta_archivo = :ruta_archivo WHERE id_inventario = :id_inventario");
		

		$stmt->bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);
		$stmt->bindParam(":ruta_archivo", $ruta_archivo, PDO::PARAM_STR);

		if($stmt->execute()){

			return 1;

		}else{

			return 0;
		
		}

	}










	static public function mdlIngresarParticipante($datos){

	$con = ConexionAccess::conectar();
	//$con = ConexionDBPruebas::conectarDBPrueba();


		$sql = "INSERT INTO PARTICIPANTES_INV (id_inventario, IDVENDEDOR) VALUES (".$datos['id_inventario'].", ".$datos['IDVENDEDOR'].")";

		/*$sql = "INSERT INTO inventarios (id_sucursal, fecha_creacion, id_usuario_creador, estatus) VALUES ($id_sucursal, NOW(), $id_usuario, 0)";*/
		
        
    	if(odbc_exec( $con, $sql )){
    		return "ok";
    	}else{
    		return odbc_errormsg($con);
    	} 

	}
}