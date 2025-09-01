<?php

require_once "conexion.php";

class ModeloCajas{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarCajas($id_usuario){



			$stmt = Conexion::conectar()->prepare("SELECT * FROM cortes_caja WHERE id_usuario = :id_usuario");

			$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}










    
    static public function mdlMostrarTotalesCorteCaja($id_corte_caja){

		

			$stmt = Conexion::conectar()->prepare("SELECT SUM(efectivo) as sumaEfectivoVentas, SUM(tarjeta_debito) as sumaTarjetaDebitoVentas, SUM(tarjeta_credito) as sumaTarjetaCreditoVentas, SUM(transferencia) as sumaTransferenciaVentas FROM ventas WHERE pagada = 1 AND cancelada = 0 AND id_corte_caja = :id_corte_caja");
        

			//$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

			$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}









    
    
    static public function mdlMostrarTotalRetirosCorteCaja($id_corte_caja){

		

			$stmt = Conexion::conectar()->prepare("SELECT SUM(importe) as sumaImportesRetiros FROM retiros WHERE estatus = 0 AND id_corte_caja = :id_corte_caja");
        

			//$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

			$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlMostrarTotalRetirosBaulCorteCaja($id_corte_caja){

		

			$stmt = Conexion::conectar()->prepare("SELECT SUM(importe) as sumaImportesRetirosBaul FROM retiros_baul WHERE estatus = 0 AND id_corte_caja = :id_corte_caja");
        

			//$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

			$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}





	static public function mdlMostrarTotalTarjetaDebitoRetirosCorteCaja($id_corte_caja){

		

			$stmt = Conexion::conectar()->prepare("SELECT SUM(importe) as sumaImportesRetiros FROM retiros WHERE estatus = 0 AND tipo_retiro = 1 AND id_corte_caja = :id_corte_caja");
        

			//$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

			$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	MOSTRAR DEVOLUCIONES DEL CORTE
	=============================================*/
	static public function mdlMostrarTotalDevolucionesCorteCaja($id_corte_caja){

		

			$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as sumaImportesDevoluciones FROM devoluciones WHERE id_corte_caja = :id_corte_caja");
        

			//$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

			$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}





	/*=============================================
	MOSTRAR GARANTIAS DEL CORTE
	=============================================*/
	static public function mdlMostrarTotalGarantiasCorteCaja($id_corte_caja){

		

			$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as sumaImportesGarantias FROM garantias WHERE id_corte_caja = :id_corte_caja");
        

			//$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

			$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}




	static public function mdlMostrarCorteCaja($id_corte_caja){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM cortes_caja WHERE id_corte_caja = :id_corte_caja");

			//$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

			$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlRevisarCorteCajaActivo($id_usuario){



			$stmt = Conexion::conectar()->prepare("SELECT * FROM cortes_caja WHERE id_usuario_creador = :id_usuario AND estatus = 0");

			$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> rowCount();

		

		$stmt -> close();

		$stmt = null;

	}



/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlRevisarCorteCajaActivo2($id_usuario){



			$stmt = Conexion::conectar()->prepare("SELECT * FROM cortes_caja WHERE id_usuario_creador = :id_usuario AND estatus = 0");

			$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

			if($stmt->execute()){

			return $stmt -> fetch();
			}else{
				return "error";
			}
		

		$stmt -> close();

		$stmt = null;

	}








	static public function mdlMostrarRetirosCorteCaja($id_corte_caja){



			$stmt = Conexion::conectar()->prepare("SELECT * FROM retiros WHERE id_corte_caja = :id_corte_caja");

			$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}









	static public function mdlMostrarRetiroCorteCaja($id_retiro){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM retiros WHERE id_retiro = :id_retiro");

			//$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

			$stmt -> bindParam(":id_retiro", $id_retiro, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}









	static public function mdlMostrarRetirosBaulCorteCaja($id_corte_caja){



			$stmt = Conexion::conectar()->prepare("SELECT * FROM retiros_baul WHERE id_corte_caja = :id_corte_caja");

			$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}









	static public function mdlMostrarRetiroBaulCorteCaja($id_retiro_baul){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM retiros_baul WHERE id_retiro_baul = :id_retiro_baul");

			//$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

			$stmt -> bindParam(":id_retiro_baul", $id_retiro_baul, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlMostrarVentaInicialCorteCaja($id_corte_caja){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE id_corte_caja = :id_corte_caja ORDER BY id ASC LIMIT 1");

			//$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

			$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlMostrarVentaFinalCorteCaja($id_corte_caja){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE id_corte_caja = :id_corte_caja ORDER BY id DESC LIMIT 1");

			//$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

			$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlMostrarDevolucionInicialCorteCaja($id_corte_caja){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM devoluciones WHERE id_corte_caja = :id_corte_caja ORDER BY id_devolucion ASC LIMIT 1");

			//$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

			$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlMostrarDevolucionFinalCorteCaja($id_corte_caja){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM devoluciones WHERE id_corte_caja = :id_corte_caja ORDER BY id_devolucion DESC LIMIT 1");

			//$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

			$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}



	








	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlCrearCorteCaja($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO cortes_caja (apertura, id_usuario_creador) VALUES (:apertura, :id_usuario_creador)");

			
			$stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);
			$stmt -> bindParam(":apertura", $datos["apertura"], PDO::PARAM_STR);
			
		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM cortes_caja LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){

			return $stmt2 -> fetch();
			}else{
				return "error";
			}
		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos
	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarCorteCaja($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE cortes_caja SET
			c0 = :c0,
			c1 = :c1,
			c2 = :c2,
			c5 = :c5,
			c10 = :c10,
			c20 = :c20,
			c50 = :c50,
			c100 = :c100,
			c200 = :c200,
			c500 = :c500,
			c1000 = :c1000,
			id_usuario_ult_mod = :id_usuario_ult_mod
			where id_corte_caja = :id_corte_caja");

			$stmt -> bindParam(":id_corte_caja", $datos["id_corte_caja"], PDO::PARAM_INT);
			$stmt -> bindParam(":c0", $datos["c0"], PDO::PARAM_STR);
			$stmt -> bindParam(":c1", $datos["c1"], PDO::PARAM_STR);
			$stmt -> bindParam(":c2", $datos["c2"], PDO::PARAM_STR);
			$stmt -> bindParam(":c5", $datos["c5"], PDO::PARAM_STR);
			$stmt -> bindParam(":c10", $datos["c10"], PDO::PARAM_STR);
			$stmt -> bindParam(":c20", $datos["c20"], PDO::PARAM_STR);
			$stmt -> bindParam(":c50", $datos["c50"], PDO::PARAM_STR);
			$stmt -> bindParam(":c100", $datos["c100"], PDO::PARAM_STR);
			$stmt -> bindParam(":c200", $datos["c200"], PDO::PARAM_STR);
			$stmt -> bindParam(":c500", $datos["c500"], PDO::PARAM_STR);
			$stmt -> bindParam(":c1000", $datos["c1000"], PDO::PARAM_STR);
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

	static public function mdlEliminarCaja($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_caja = :id_caja");

		$stmt -> bindParam(":id_caja", $datos, PDO::PARAM_INT);

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

	static public function mdlActualizarCaja($columna1, $valor1, $id_corte_caja, $id_usuario_ult_mod){

		$stmt = Conexion::conectar()->prepare("UPDATE cortes_caja SET $columna1 = :$columna1, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_corte_caja = :id_corte_caja");

		$stmt -> bindParam(":".$columna1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id_corte_caja", $id_corte_caja, PDO::PARAM_INT);
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
	CREAR RETIRO DE EFECTIVO
	=============================================*/
	static public function mdlCrearRetiroCorteCaja($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO retiros (id_corte_caja, descripcion, importe, tipo_retiro, id_usuario_creador) VALUES (:id_corte_caja, :descripcion, :importe, :tipo_retiro, :id_usuario_creador)");

			
			$stmt -> bindParam(":id_corte_caja", $datos["id_corte_caja"], PDO::PARAM_INT);
			$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
			$stmt -> bindParam(":importe", $datos["importe"], PDO::PARAM_STR);

			$stmt -> bindParam(":tipo_retiro", $datos["tipo_retiro"], PDO::PARAM_INT);

			$stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);
			

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM retiros LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){

			return $stmt2 -> fetch();

			}else{
				return "error";
			}
		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos
	}









	static public function mdlActualizarRetiroCorteCaja($columna1, $valor1, $id_retiro, $id_usuario_ult_mod){

		$stmt = Conexion::conectar()->prepare("UPDATE retiros SET $columna1 = :$columna1, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_retiro= :id_retiro");

		$stmt -> bindParam(":".$columna1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id_retiro", $id_retiro, PDO::PARAM_INT);
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
	CREAR RETIRO DE EFECTIVO
	=============================================*/
	static public function mdlCrearRetiroBaulCorteCaja($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO retiros_baul (id_corte_caja, observaciones, importe, id_usuario_creador) VALUES (:id_corte_caja, :observaciones, :importe, :id_usuario_creador)");

			
			$stmt -> bindParam(":id_corte_caja", $datos["id_corte_caja"], PDO::PARAM_INT);
			$stmt -> bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
			$stmt -> bindParam(":importe", $datos["importe"], PDO::PARAM_STR);

			$stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);
			

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM retiros_baul LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){

			return $stmt2 -> fetch();

			}else{
				return "error";
			}
		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos
	}









	static public function mdlActualizarRetiroBaulCorteCaja($columna, $valor, $id_retiro_baul, $id_usuario_ult_mod){

		$stmt = Conexion::conectar()->prepare("UPDATE retiros_baul SET $columna = :valor, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_retiro_baul= :id_retiro_baul");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_retiro_baul", $id_retiro_baul, PDO::PARAM_INT);
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