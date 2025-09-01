<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($columna, $valor){

		if($columna != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM productos WHERE $columna = :$columna");

			$stmt -> bindParam(":".$columna, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM productos GROUP BY clave_producto LIMIT 20");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}




	static public function mdlMostrarProductos2(){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM productos");

			$stmt -> execute();

			return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

	}

static public function mdlMostrarProducto2($id_producto){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM productos WHERE id_producto = :id_producto");

				$stmt -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProducto($valor){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM productos WHERE id_producto = :id_producto");



			$stmt -> bindParam(":id_producto", $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		

		$stmt -> close();

		$stmt = null;

	}












	static public function mdlMostrarMulticlaveProducto($id_multiclave){
 
		if($id_multiclave != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM multiclaves WHERE id_multiclave = :id_multiclave");

			$stmt -> bindParam(":id_multiclave", $id_multiclave, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}

	}


	static public function mdlMostrarMulticlaveProducto2($id_producto, $multiclave){
 
		if($id_producto != null && $multiclave != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM multiclaves WHERE multiclave = :multiclave AND id_producto = :id_producto");

			$stmt -> bindParam(":multiclave", $multiclave, PDO::PARAM_STR);

			$stmt -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}

	}





	static public function mdlMostrarMulticlaveProducto3($multiclave){
 
		if($multiclave != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM multiclaves WHERE multiclave = :multiclave");

			$stmt -> bindParam(":multiclave", $multiclave, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}

	}



	static public function mdlMostrarMulticlavesProducto($id_producto){
 
		if($id_producto != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM multiclaves WHERE id_producto = :id_producto");

			$stmt -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos

	}


static public function mdlCrearMulticlaveProducto($datos){



		$stmt = Conexion::conectar()->prepare("INSERT INTO multiclaves (id_producto, multiclave, multiplo_entrega, id_usuario_creador) VALUES
			(:id_producto, :multiclave, :multiplo_entrega, :id_usuario_creador)");

			
		$stmt -> bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);

		$stmt -> bindParam(":multiclave", $datos["multiclave"], PDO::PARAM_STR);

		$stmt -> bindParam(":multiplo_entrega", $datos["multiplo_entrega"], PDO::PARAM_INT);

		$stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);
			
			if ($stmt->execute()) {
				return 1;
			}else{
				return 0;
			}
		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos
	}






	static public function mdlEliminarMulticlaveProducto($id_multiclave){
 
		if($id_multiclave != null){

			$stmt = Conexion::conectar()->prepare("DELETE FROM multiclaves WHERE id_multiclave = :id_multiclave");

			$stmt -> bindParam(":id_multiclave", $id_multiclave, PDO::PARAM_INT);

			if ($stmt->execute()) {
				return 1;
			}else{
				return 0;
			}

		}

	}











	static public function mdlMostrarProveedoresProducto($id_producto){
 
		if($id_producto != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM productos_proveedores WHERE id_producto = :id_producto");

			$stmt -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos

	}









	static public function mdlMostrarProductoProveedor($clave_producto, $id_proveedor){
 
		if($clave_producto != null && $id_proveedor != null){

			$stmt = Conexion::conectar()->prepare("SELECT productos_proveedores.id_producto, productos_proveedores.clave_prod_prov, productos.clave_producto, productos.descripcion_corta FROM productos_proveedores INNER JOIN productos ON productos_proveedores.id_producto = productos.id_producto WHERE (productos_proveedores.clave_prod_prov = :clave_producto OR clave_producto = :clave_producto) AND id_proveedor = :id_proveedor");

			$stmt -> bindParam(":clave_producto", $clave_producto, PDO::PARAM_STR);

			$stmt -> bindParam(":id_proveedor", $id_proveedor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}

	}





	static public function mdlMostrarProductoProveedor2($id_producto, $id_proveedor){
 
		if($id_producto != null && $id_proveedor != null){

			$stmt = Conexion::conectar()->prepare("SELECT productos_proveedores.id_producto, productos_proveedores.clave_prod_prov, productos.clave_producto, productos.descripcion_corta FROM productos_proveedores INNER JOIN productos ON productos_proveedores.id_producto = productos.id_producto WHERE productos_proveedores.id_producto = :id_producto AND id_proveedor = :id_proveedor");

			$stmt -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);

			$stmt -> bindParam(":id_proveedor", $id_proveedor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}

	}











	static public function mdlCrearProductoProveedor($datos){



		$stmt = Conexion::conectar()->prepare("INSERT INTO productos_proveedores (id_producto, id_proveedor, clave_prod_prov) VALUES
			(:id_producto, :id_proveedor, :clave_prod_prov)");

			
		$stmt -> bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);

		$stmt -> bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);

		$stmt -> bindParam(":clave_prod_prov", $datos["clave_prod_prov"], PDO::PARAM_STR);
			
			if ($stmt->execute()) {
				return "ok";
			}else{
				return "error";
			}
		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos
	}










	static public function mdlActualizarProductoProveedor($columna, $valor, $id_producto, $id_proveedor){

		$stmt = Conexion::conectar()->prepare("UPDATE productos_proveedores SET $columna = :valor WHERE id_producto = :id_producto AND id_proveedor = :id_proveedor");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
		$stmt -> bindParam(":id_proveedor", $id_proveedor, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}












	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlCrearProducto($datos){



		$stmt = Conexion::conectar()->prepare("INSERT INTO productos (
			clave_producto,
			clave_sat,
			cve_unidad,
			unidad,
			descripcion_larga,
			descripcion_corta,
			id_marca,
			/*motor,
			viscosidad,
			apl,
			presentacion,
			medidas,
			color,
			no_canales,
			no_birlos,
			dientes,
			adicionales,
			id_proveedor1,
			id_proveedor2,
			id_proveedor3,*/
			imagen1,
			imagen2,
			imagen3,
			/*autos,
			id_familia,
			id_subfamilia,*/
			imprime_etiqueta,
			multiplo_etiqueta,
			es_compuesto,
			productos_compuesto,
			/*descontinuado,*/
			id_usuario_creador) VALUES
			(:clave_producto,
			:clave_sat,
			:cve_unidad,
			:unidad,
			:descripcion_larga,
			:descripcion_corta,
			:id_marca,
			/*:motor,
			:viscosidad,
			:apl,
			:presentacion,
			:medidas,
			:color,
			:no_canales,
			:no_birlos,
			:dientes,
			:adicionales,
			:id_proveedor1,
			:id_proveedor2,
			:id_proveedor3,*/
			:imagen1,
			:imagen2,
			:imagen3,
			/*:autos,
			:id_familia,
			:id_subfamilia,*/
			:imprime_etiqueta,
			:multiplo_etiqueta,
			:es_compuesto,
			:productos_compuesto,
			/*:descontinuado,*/
			:id_usuario_creador)");

			$stmt -> bindParam(":clave_producto", $datos["clave_producto"], PDO::PARAM_STR);
			$stmt -> bindParam(":clave_sat", $datos["clave_sat"], PDO::PARAM_STR);
			$stmt -> bindParam(":cve_unidad", $datos["cve_unidad"], PDO::PARAM_STR);
			$stmt -> bindParam(":unidad", $datos["unidad"], PDO::PARAM_STR);
			$stmt -> bindParam(":descripcion_larga", $datos["descripcion_larga"], PDO::PARAM_STR);
			$stmt -> bindParam(":descripcion_corta", $datos["descripcion_corta"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_INT);
			/*$stmt -> bindParam(":motor", $datos["motor"], PDO::PARAM_STR);
			$stmt -> bindParam(":viscosidad", $datos["viscosidad"], PDO::PARAM_STR);
			$stmt -> bindParam(":apl", $datos["apl"], PDO::PARAM_STR);
			$stmt -> bindParam(":presentacion", $datos["presentacion"], PDO::PARAM_STR);
			$stmt -> bindParam(":medidas", $datos["medidas"], PDO::PARAM_STR);
			$stmt -> bindParam(":color", $datos["color"], PDO::PARAM_STR);
			$stmt -> bindParam(":no_canales", $datos["no_canales"], PDO::PARAM_INT);
			$stmt -> bindParam(":no_birlos", $datos["no_birlos"], PDO::PARAM_INT);
			$stmt -> bindParam(":dientes", $datos["dientes"], PDO::PARAM_STR);
			$stmt -> bindParam(":adicionales", $datos["adicionales"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_proveedor1", $datos["id_proveedor1"], PDO::PARAM_INT);
			$stmt -> bindParam(":id_proveedor2", $datos["id_proveedor2"], PDO::PARAM_INT);
			$stmt -> bindParam(":id_proveedor3", $datos["id_proveedor3"], PDO::PARAM_INT);*/
			$stmt -> bindParam(":imagen1", $datos["imagen1"], PDO::PARAM_STR);
			$stmt -> bindParam(":imagen2", $datos["imagen2"], PDO::PARAM_STR);
			$stmt -> bindParam(":imagen3", $datos["imagen3"], PDO::PARAM_STR);
			/*$stmt -> bindParam(":autos", $datos["autos"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_familia", $datos["id_familia"], PDO::PARAM_INT);
			$stmt -> bindParam(":id_subfamilia", $datos["id_subfamilia"], PDO::PARAM_INT);*/
			$stmt -> bindParam(":imprime_etiqueta", $datos["imprime_etiqueta"], PDO::PARAM_INT);
			$stmt -> bindParam(":multiplo_etiqueta", $datos["multiplo_etiqueta"], PDO::PARAM_INT);
			$stmt -> bindParam(":es_compuesto", $datos["es_compuesto"], PDO::PARAM_INT);
			$stmt -> bindParam(":productos_compuesto", $datos["productos_compuesto"], PDO::PARAM_STR);
			//$stmt -> bindParam(":descontinuado", $datos["descontinuado"], PDO::PARAM_INT);
			$stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);
			
			$stmt2 = Conexion::conectar()->prepare("SELECT @@IDENTITY AS 'identity' FROM productos LIMIT 1;");

			if ($stmt->execute() && $stmt2->execute()) {
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
	static public function mdlEditarProducto($datos){


		$stmt = Conexion::conectar()->prepare("UPDATE productos SET
			clave_producto =:clave_producto,
			clave_sat=:clave_sat,
			cve_unidad=:cve_unidad,
			unidad=:unidad,
			descripcion_larga=:descripcion_larga,
			descripcion_corta=:descripcion_corta,
			id_marca=:id_marca,
			/*motor=:motor,
			viscosidad=:viscosidad,
			apl=:apl,
			presentacion=:presentacion,
			medidas=:medidas,
			color=:color,
			no_canales=:no_canales,
			no_birlos=:no_birlos,
			dientes=:dientes,
			adicionales=:adicionales,*/
			 imagen1=:imagen1,
			  imagen2=:imagen2,
			   imagen3=:imagen3,
			   /*id_proveedor1=:id_proveedor1,
			   id_proveedor2=:id_proveedor2,
			   id_proveedor3=:id_proveedor3,
			   autos=:autos,
			   id_familia=:id_familia,
			   id_subfamilia=:id_subfamilia,*/
			   imprime_etiqueta=:imprime_etiqueta,
			   multiplo_etiqueta=:multiplo_etiqueta,
			   es_compuesto=:es_compuesto,
			   productos_compuesto=:productos_compuesto,
			   /*descontinuado=:descontinuado,*/
			   id_usuario_ult_mod = :id_usuario_ult_mod
			    where id_producto= :id_producto");






			$stmt -> bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_STR);
			$stmt -> bindParam(":clave_producto", $datos["clave_producto"], PDO::PARAM_STR);
			$stmt -> bindParam(":clave_sat", $datos["clave_sat"], PDO::PARAM_STR);
			$stmt -> bindParam(":cve_unidad", $datos["cve_unidad"], PDO::PARAM_STR);
			$stmt -> bindParam(":unidad", $datos["unidad"], PDO::PARAM_STR);
			$stmt -> bindParam(":descripcion_larga", $datos["descripcion_larga"], PDO::PARAM_STR);
			$stmt -> bindParam(":descripcion_corta", $datos["descripcion_corta"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_INT);
			/*$stmt -> bindParam(":motor", $datos["motor"], PDO::PARAM_STR);
			$stmt -> bindParam(":viscosidad", $datos["viscosidad"], PDO::PARAM_STR);
			$stmt -> bindParam(":apl", $datos["apl"], PDO::PARAM_STR);
			$stmt -> bindParam(":presentacion", $datos["presentacion"], PDO::PARAM_STR);
			$stmt -> bindParam(":medidas", $datos["medidas"], PDO::PARAM_STR);
			$stmt -> bindParam(":color", $datos["color"], PDO::PARAM_STR);
			$stmt -> bindParam(":no_canales", $datos["no_canales"], PDO::PARAM_INT);
			$stmt -> bindParam(":no_birlos", $datos["no_birlos"], PDO::PARAM_INT);
			$stmt -> bindParam(":dientes", $datos["dientes"], PDO::PARAM_STR);
			
			$stmt -> bindParam(":adicionales", $datos["adicionales"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_proveedor1", $datos["id_proveedor1"], PDO::PARAM_INT);
			$stmt -> bindParam(":id_proveedor2", $datos["id_proveedor2"], PDO::PARAM_INT);
			$stmt -> bindParam(":id_proveedor3", $datos["id_proveedor3"], PDO::PARAM_INT);*/
			$stmt -> bindParam(":imagen1", $datos["imagen1"], PDO::PARAM_STR);
			$stmt -> bindParam(":imagen2", $datos["imagen2"], PDO::PARAM_STR);
			$stmt -> bindParam(":imagen3", $datos["imagen3"], PDO::PARAM_STR);
			/*$stmt -> bindParam(":autos", $datos["autos"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_familia", $datos["id_familia"], PDO::PARAM_INT);
			$stmt -> bindParam(":id_subfamilia", $datos["id_subfamilia"], PDO::PARAM_INT);*/
			$stmt -> bindParam(":imprime_etiqueta", $datos["imprime_etiqueta"], PDO::PARAM_INT);
			$stmt -> bindParam(":multiplo_etiqueta", $datos["multiplo_etiqueta"], PDO::PARAM_INT);
			$stmt -> bindParam(":es_compuesto", $datos["es_compuesto"], PDO::PARAM_INT);
			$stmt -> bindParam(":productos_compuesto", $datos["productos_compuesto"], PDO::PARAM_STR);
			//$stmt -> bindParam(":descontinuado", $datos["descontinuado"], PDO::PARAM_INT);
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

	static public function mdlEliminarProducto($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM productos WHERE id_producto = :id_producto");

		$stmt -> bindParam(":id_producto", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($columna, $valor, $id_producto, $id_usuario_ult_mod){

		$stmt = Conexion::conectar()->prepare("UPDATE productos SET $columna = :valor, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_producto = :id_producto");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario_ult_mod", $id_usuario_ult_mod, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}








	static public function mdlActualizarProducto2($valor, $id_producto){

		$stmt = Conexion::conectar()->prepare("UPDATE productos SET imagen1 = :valor WHERE id_producto = :id_producto");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}














	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlLogProductos($tipo_log, $id_producto, $id_usuario){


		$stmt = Conexion::conectar()->prepare("INSERT INTO log_productos (tipo_log, id_producto, id_usuario) VALUES (:tipo_log, :id_producto, :id_usuario)");

			$stmt -> bindParam(":tipo_log", $tipo_log, PDO::PARAM_STR);
			$stmt -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
			$stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);


			if ($stmt->execute()) {
				return "ok";
			}else{
				return "error";
			}
		$stmt -> close(); //cerramos la conexion

		$stmt = null; //lo vaciamos
	}
}


