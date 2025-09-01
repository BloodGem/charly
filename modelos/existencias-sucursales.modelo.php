<?php

require_once "conexion.php";



class ModeloExistenciasSucursales{




  /*=============================================
  ACTUALIZAR STOCK DEL PRODUCTO POR SUCURSAL
  =============================================*/

  static public function mdlMostrarProductoES($id_producto, $id_sucursal){

    $stmt = Conexion::conectar()->prepare("SELECT existencias_sucursales.id_sucursal, existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.en_garantia, existencias_sucursales.precio_compra, existencias_sucursales.ubicacion, productos.clave_producto, productos.clave_sat, productos.imagen1, productos.imagen2, productos.imagen3, productos.id_marca, productos.multiplo, productos.es_compuesto, productos.productos_compuesto, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, existencias_sucursales.utilidad1, existencias_sucursales.utilidad2, existencias_sucursales.utilidad3, productos.descripcion_larga, productos.descripcion_corta, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE existencias_sucursales.id_producto = :id_producto AND existencias_sucursales.id_sucursal = :id_sucursal");

    $stmt -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
    $stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);

    if($stmt -> execute()){

      return $stmt -> fetch();
    
    }else{

      return "error"; 

    }

    $stmt -> close();

    $stmt = null;

  }







  static public function mdlMostrarProductoESFiltro($columna, $valor, $id_sucursal){

    $stmt = Conexion::conectar()->prepare("SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, productos.clave_producto,  productos.descripcion_larga, productos.clave_producto, productos.clave_sat, productos.descripcion_corta, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3 FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE $columna = :valor AND existencias_sucursales.id_sucursal = :id_sucursal");

    $stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
    $stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);

    if($stmt -> execute()){

      return $stmt -> fetch();
    
    }else{

      return "error"; 

    }

    $stmt -> close();

    $stmt = null;

  }










  static public function mdlMostrarProductoESMulticlave($multiclave, $id_sucursal){

    $stmt = Conexion::conectar()->prepare("SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, productos.clave_producto FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto LEFT JOIN multiclaves ON productos.id_producto = multiclaves.id_producto WHERE productos.clave_producto = :multiclave OR multiclaves.multiclave = :multiclave AND existencias_sucursales.id_sucursal = :id_sucursal");

    $stmt -> bindParam(":multiclave", $multiclave, PDO::PARAM_STR);
    $stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);

    if($stmt -> execute()){

      return $stmt -> fetch();
    
    }else{

      return "error"; 

    }

    $stmt -> close();

    $stmt = null;

  }











  /*=============================================
  INGRESAR PRODUCTO A EXISTENCIAS DE SUCURSAL DEL PRODUCTO CREADO 
  =============================================*/

  static public function mdlCrearProductoES($datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO existencias_sucursales (id_sucursal, id_producto, id_usuario_creador) VALUES (:id_sucursal, :id_producto, :id_usuario_creador)");

    $stmt -> bindParam(":id_sucursal", $datos['id_sucursal'], PDO::PARAM_INT);
    $stmt -> bindParam(":id_producto", $datos['id_producto'], PDO::PARAM_INT);
    $stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);
    

    if($stmt -> execute()){
      return "ok";
    }else{
      return "error";
    }

      

    $stmt -> close();

    $stmt = null;

  }







  static public function mdlCrearProductoESMasivo($datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO existencias_sucursales (id_sucursal, id_producto, precio1, utilidad1, precio2, utilidad2, precio3, utilidad3, id_usuario_creador) VALUES (:id_sucursal, :id_producto, :precio1, :utilidad1, :precio2, :utilidad2, :precio3, :utilidad3, :id_usuario_creador)");

    $stmt -> bindParam(":id_sucursal", $datos['id_sucursal'], PDO::PARAM_INT);
    $stmt -> bindParam(":id_producto", $datos['id_producto'], PDO::PARAM_INT);
    $stmt -> bindParam(":utilidad1", $datos['utilidad1'], PDO::PARAM_STR);
    $stmt -> bindParam(":precio1", $datos['precio1'], PDO::PARAM_STR);
    $stmt -> bindParam(":utilidad2", $datos['utilidad2'], PDO::PARAM_STR);
    $stmt -> bindParam(":precio2", $datos['precio2'], PDO::PARAM_STR);
    $stmt -> bindParam(":utilidad3", $datos['utilidad3'], PDO::PARAM_STR);
    $stmt -> bindParam(":precio3", $datos['precio3'], PDO::PARAM_STR);
    $stmt -> bindParam(":id_usuario_creador", $datos["id_usuario_creador"], PDO::PARAM_INT);
    

    if($stmt -> execute()){
      return "ok";
    }else{
      return "error";
    }

      

    $stmt -> close();

    $stmt = null;

  }


	/*=============================================
  ACTUALIZAR STOCK DEL PRODUCTO POR SUCURSAL
  =============================================*/

  static public function mdlMostrarProductoESVenta($id_producto, $id_sucursal){

    $stmt = Conexion::conectar()->prepare("SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, productos.descripcion_larga, productos.descripcion_corta, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE productos.descontinuado = 0 AND existencias_sucursales.id_producto = :id_producto AND existencias_sucursales.id_sucursal = :id_sucursal");
    $stmt -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
    $stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);
    
    if($stmt -> execute()){

      return $stmt -> fetch();
    
    }else{

      return "error"; 

    }

    $stmt -> close();

    $stmt = null;

  }











     /*=============================================
  ACTUALIZAR STOCK DEL PRODUCTO POR SUCURSAL
  =============================================*/

  static public function mdlEditarProductoExistenciaSucursal($datos){

    $stmt = Conexion::conectar()->prepare("UPDATE existencias_sucursales SET
			precio1=:precio1,
			precio2=:precio2,
			precio3=:precio3,
			utilidad1=:utilidad1,
			utilidad2=:utilidad2,
			utilidad3=:utilidad3,
			nivel_maximo=:nivel_maximo,
			nivel_medio=:nivel_medio,
			nivel_minimo=:nivel_minimo,
			ubicacion=:ubicacion, 
      id_usuario_ult_mod = :id_usuario_ult_mod
			    where id_producto= :id_producto AND id_sucursal = :id_sucursal");
			    
    $stmt -> bindParam(":id_producto", $datos['id_producto'], PDO::PARAM_INT);
    $stmt -> bindParam(":id_sucursal", $datos['id_sucursal'], PDO::PARAM_INT);
			$stmt -> bindParam(":precio1", $datos["precio1"], PDO::PARAM_STR);
			$stmt -> bindParam(":utilidad1", $datos["utilidad1"], PDO::PARAM_STR);
			$stmt -> bindParam(":precio2", $datos["precio2"], PDO::PARAM_STR);
			$stmt -> bindParam(":utilidad2", $datos["utilidad2"], PDO::PARAM_STR);
			$stmt -> bindParam(":precio3", $datos["precio3"], PDO::PARAM_STR);
			$stmt -> bindParam(":utilidad3", $datos["utilidad3"], PDO::PARAM_STR);
			$stmt -> bindParam(":nivel_minimo", $datos["nivel_minimo"], PDO::PARAM_INT);
			$stmt -> bindParam(":nivel_medio", $datos["nivel_medio"], PDO::PARAM_INT);
			$stmt -> bindParam(":nivel_maximo", $datos["nivel_maximo"], PDO::PARAM_INT);
			$stmt -> bindParam(":ubicacion", $datos["ubicacion"], PDO::PARAM_STR);
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
  REGRESAR STOCK POR CANCELACIÓN DE VENTA
  =============================================*/

  static public function mdlRegresarStock($id_prodcuto, $cantidad, $id_sucursal, $id_usuario_ult_mod){

    $stmt = Conexion::conectar()->prepare("UPDATE `existencias_sucursales` SET `stock`= (stock + :cantidad), id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_producto= :id_producto AND id_sucursal = :id_sucursal");
			    
    $stmt -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
    $stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);
	$stmt -> bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
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
  ACTUALIZAR STOCK DEL PRODUCTO POR SUCURSAL
  =============================================*/

  static public function mdlActualizarProductoES($columna, $valor, $id_producto, $id_sucursal, $id_usuario_ult_mod){

		$stmt = Conexion::conectar()->prepare("UPDATE existencias_sucursales SET $columna = :valor, id_usuario_ult_mod = :id_usuario_ult_mod WHERE id_producto = :id_producto AND id_sucursal = :id_sucursal");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
		$stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);
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
  MOSTRAR inventarios
  =============================================*/

  static public function mdlMostrarProductosSucursal($id_sucursal){

      $stmt = Conexion::conectar()->prepare("SELECT existencias_sucursales.* FROM existencias_sucursales INNER JOIN productos ON existencias_sucursales.id_producto = productos.id_producto WHERE existencias_sucursales.id_sucursal = :id_sucursal ORDER BY productos.descripcion_corta ASC");

      $stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);

      $stmt -> execute();

      return $stmt -> fetchAll();


    $stmt -> close();

    $stmt = null;

  }









  /*=============================================
  MOSTRAR inventarios
  =============================================*/

  static public function mdlMostrarAnaquelesSucursal($id_sucursal){

      $stmt = Conexion::conectar()->prepare("SELECT substring(ubicacion,1,3) AS anaquel FROM existencias_sucursales WHERE id_sucursal = :id_sucursal GROUP BY anaquel ORDER BY anaquel ASC");

      $stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);

      $stmt -> execute();

      return $stmt -> fetchAll();


    $stmt -> close();

    $stmt = null;

  }











  static public function mdlExistenciasProductosMarcaCUPM($id_marca, $id_sucursal){

      $stmt = Conexion::conectar()->prepare("SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, productos.clave_producto, existencias_sucursales.precio_compra, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, existencias_sucursales.utilidad1, existencias_sucursales.utilidad2, existencias_sucursales.utilidad3, productos.descripcion_larga, productos.descripcion_corta, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE productos.descontinuado = 0 AND productos.id_marca = :id_marca AND existencias_sucursales.id_sucursal = :id_sucursal");

      $stmt -> bindParam(":id_marca", $id_marca, PDO::PARAM_INT);
      $stmt -> bindParam(":id_sucursal", $id_sucursal, PDO::PARAM_INT);

      $stmt -> execute();

      return $stmt -> fetchAll();


    $stmt -> close();

    $stmt = null;

  }










  static public function mdlCambiarUtilidadesProducto($datos){

    $stmt = Conexion::conectar()->prepare("UPDATE existencias_sucursales
      SET
      precio1 = :precio1,
      utilidad1 = :utilidad1,
      precio2 = :precio2,
      utilidad2 = :utilidad2,
      precio3 = :precio3,
      utilidad3 = :utilidad3,
      id_usuario_ult_mod = :id_usuario_ult_mod
      WHERE id_producto = :id_producto AND id_sucursal = :id_sucursal");

    $stmt -> bindParam(":precio1", $datos["precio1"], PDO::PARAM_STR);
    $stmt -> bindParam(":utilidad1", $datos["utilidad1"], PDO::PARAM_STR);
    $stmt -> bindParam(":precio2", $datos["precio2"], PDO::PARAM_STR);
    $stmt -> bindParam(":utilidad2", $datos["utilidad2"], PDO::PARAM_STR);
    $stmt -> bindParam(":precio3", $datos["precio3"], PDO::PARAM_STR);
    $stmt -> bindParam(":utilidad3", $datos["utilidad3"], PDO::PARAM_STR);
    $stmt -> bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
    $stmt -> bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
    $stmt -> bindParam(":id_usuario_ult_mod", $datos["id_usuario_ult_mod"], PDO::PARAM_INT);

    if($stmt -> execute()){

      return "ok";
    
    }else{

      return "error"; 

    }

    $stmt -> close();

    $stmt = null;

  }











  static public function mdlActualizarProductoCompraConfirmada1($datos){

    $stmt = Conexion::conectar()->prepare("UPDATE existencias_sucursales SET
      stock=:stock,
      fecha_ult_compra=:fecha_ult_compra,
      id_usuario_ult_mod = :id_usuario_ult_mod
          where id_producto= :id_producto AND id_sucursal = :id_sucursal");
          
    $stmt -> bindParam(":id_producto", $datos['id_producto'], PDO::PARAM_INT);
    $stmt -> bindParam(":id_sucursal", $datos['id_sucursal'], PDO::PARAM_INT);
      $stmt -> bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
      $stmt -> bindParam(":fecha_ult_compra", $datos["fecha_ult_compra"], PDO::PARAM_STR);
      $stmt -> bindParam(":id_usuario_ult_mod", $datos["id_usuario_ult_mod"], PDO::PARAM_INT);

    if($stmt -> execute()){

      return "ok";
    
    }else{

      return "error"; 

    }

    $stmt -> close();

    $stmt = null;

  }










  static public function mdlActualizarProductosMasivamente($datos){

    $stmt = Conexion::conectar()->prepare("UPDATE existencias_sucursales SET
      utilidad1=:utilidad1,
      utilidad2=:utilidad2,
      utilidad3=:utilidad3
      WHERE id_producto= :id_producto AND id_sucursal = :id_sucursal");
          
    $stmt -> bindParam(":id_producto", $datos['id_producto'], PDO::PARAM_INT);
    $stmt -> bindParam(":id_sucursal", $datos['id_sucursal'], PDO::PARAM_INT);
      $stmt -> bindParam(":utilidad1", $datos["utilidad1"], PDO::PARAM_STR);
      $stmt -> bindParam(":utilidad2", $datos["utilidad2"], PDO::PARAM_STR);
      $stmt -> bindParam(":utilidad3", $datos["utilidad3"], PDO::PARAM_STR);

    if($stmt -> execute()){

      return "ok";
    
    }else{

      return "error"; 

    }

    $stmt -> close();

    $stmt = null;

  }









  
	}