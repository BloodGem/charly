<?php

require_once "conexion.php";

class ModeloResurtidos{


	/*=============================================
	MOSTRAR COMPRAS
	=============================================*/

	static public function mdlMostrarResurtidos($columna, $valor){

		if($columna != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM resurtidos WHERE $columna = :$columna ORDER BY id ASC");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM resurtidos ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	MOSTRAR COMPRAS CLIENTE
	=============================================*/

	static public function mdlMostrarResurtido($id_resurtido){

		if($id_resurtido != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM resurtidos WHERE id_resurtido = :id_resurtido");

			$stmt -> bindParam(":id_resurtido", $id_resurtido, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		
		$stmt -> close();

		$stmt = null;

	}











	static public function mdlMostrarPartidasResurtido($id_resurtido){

		if($id_resurtido != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM partres WHERE id_resurtido = :id_resurtido");

			$stmt -> bindParam(":id_resurtido", $id_resurtido, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}










static public function mdlEliminarCrearVista($sqlDrop, $sqlView){

	$stmt = Conexion::conectar()->prepare($sqlDrop);

	if($stmt -> execute()){
		$stmt2 = Conexion::conectar()->prepare($sqlView);
		if($stmt2 -> execute()){
		return "ok";
	}else{
		return "error";
	}
	}else{
		$stmt2 = Conexion::conectar()->prepare($sqlView);
		if($stmt2 -> execute()){
		return "ok";
	}else{
		return "error";
	}
	}

	

	

	$stmt -> close();

	$stmt = null;
}









	static public function mdlAgregarProductosResurtido($id_resurtido, $wiew){

		$stmt = Conexion::conectar()->prepare("INSERT INTO partres (id_resurtido, id_producto, precio_compra, stock_actual, nivel_minimo, nivel_maximo, a_pedir) SELECT :id_resurtido, id_producto, precio_compra, stock, nivel_minimo, nivel_maximo, a_pedir FROM ".$wiew);

		$stmt -> bindParam(":id_resurtido", $id_resurtido, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}










	static public function mdlAgregarProductosCompraResurtido($id_resurtido, $id_compra){

		$stmt = Conexion::conectar()->prepare("INSERT INTO partcom (id_compra, id_producto, cantidad, stock_actual, precio, total) SELECT :id_compra, id_producto, a_pedir, stock_actual, (precio_compra * 1.16), ((precio_compra * 1.16) * a_pedir) FROM partres WHERE id_resurtido = :id_resurtido");

		$stmt -> bindParam(":id_resurtido", $id_resurtido, PDO::PARAM_INT);
		$stmt -> bindParam(":id_compra", $id_compra, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
	












	/*=============================================
	CONVERTIR RESURTIDO A COMPRA
	=============================================*/

	static public function mdlConvertirResurtidoACompra($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO compras (id_proveedor, id_resurtido, cambiar_precios, id_sucursal, id_usuario_creador) VALUES (:id_proveedor, :id_resurtido, :cambiar_precios, :id_sucursal, :id_usuario_creador)");

		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":id_resurtido", $datos["id_resurtido"], PDO::PARAM_INT);
		$stmt->bindParam(":cambiar_precios", $datos["cambiar_precios"], PDO::PARAM_INT);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM compras LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){



			return $stmt2 -> fetch();

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}
















	/*=============================================
	REGISTRO DE COMPRA
	=============================================*/

	static public function mdlCrearResurtido($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO resurtidos (id_proveedor, wiew_productos, id_sucursal, id_usuario_creador) VALUES (:id_proveedor, :wiew_productos, :id_sucursal, :id_usuario_creador)");

		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":wiew_productos", $datos["wiew_productos"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);

		$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM resurtidos LIMIT 1;");

		if($stmt->execute() && $stmt2->execute()){

			return $stmt2 -> fetch();

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}





	/*=============================================
	ELIMINAR COMPRA
	=============================================*/

	static public function mdlEliminarResurtido($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM resurtidos WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}










	 /*=============================================
  ACTUALIZAR COMPRA
  =============================================*/

  static public function mdlActualizarResurtido($columna, $valor, $id_resurtido, $id_usuario_ult_mod){

    $stmt = Conexion::conectar()->prepare("UPDATE resurtidos SET $columna = :$columna, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_resurtido = :id_resurtido");

    $stmt -> bindParam(":id_resurtido", $id_resurtido, PDO::PARAM_INT);
    $stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);
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
	Se consultan los productos de un proveedor que estan en ceros
	=============================================*/
	static public function mdlMostrarProductosProveedorResurtidoEnCeros($id_proveedor, $id_sucursal){

			$stmt = Conexion::conectar()->prepare("SELECT existencias_sucursales.id_producto, productos.clave_producto, productos.descripcion_corta, productos.descripcion_larga, existencias_sucursales.stock, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, (existencias_sucursales.nivel_maximo - existencias_sucursales.stock) as a_pedir, existencias_sucursales.precio_compra FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE (productos.id_proveedor1 = :id_proveedor OR productos.id_proveedor2 = :id_proveedor OR productos.id_proveedor3 = :id_proveedor) AND existencias_sucursales.stock <= 0 AND productos.descontinuado = 0 AND existencias_sucursales.id_sucursal = :id_sucursal ORDER BY productos.descripcion_larga ASC");

			$stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);
			$stmt -> bindParam(":id_proveedor", $id_proveedor, PDO::PARAM_INT);

			

			if($stmt -> execute()){

      return $stmt -> fetchAll();
    
    }else{

      return "error"; 

    }

		$stmt -> close();

		$stmt = null;

	}











	/*=============================================
	Se consultan los productos de un proveedor que estan en ceros
	=============================================*/
	static public function mdlMostrarProductosProveedorResurtido($id_proveedor, $id_sucursal){

			$stmt = Conexion::conectar()->prepare("SELECT existencias_sucursales.id_producto, productos.clave_producto, productos.descripcion_corta, productos.descripcion_larga, existencias_sucursales.stock, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, (existencias_sucursales.nivel_maximo - existencias_sucursales.stock) as a_pedir, existencias_sucursales.precio_compra FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE (productos.id_proveedor1 = :id_proveedor OR productos.id_proveedor2 = :id_proveedor OR productos.id_proveedor3 = :id_proveedor) AND existencias_sucursales.stock <= existencias_sucursales.nivel_minimo AND productos.descontinuado = 0 AND existencias_sucursales.id_sucursal = :id_sucursal ORDER BY productos.descripcion_larga ASC");

			$stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);
			$stmt -> bindParam(":id_proveedor", $id_proveedor, PDO::PARAM_INT);

			if($stmt -> execute()){

      return $stmt -> fetchAll();
    
    }else{

      return "error"; 

    }

		$stmt -> close();

		$stmt = null;

	}



	
}