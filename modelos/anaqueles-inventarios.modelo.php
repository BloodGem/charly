<?php

require_once "conexion.php";



class ModeloAnaquelesInventarios{




  /*=============================================
  ACTUALIZAR STOCK DEL PRODUCTO POR SUCURSAL
  =============================================*/

  static public function mdlIngresarPartidaAnaquelInventario($datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO anaqueles_inventarios (id_inventario, anaquel) VALUES (:id_inventario, :anaquel)");

    $stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_INT);
    $stmt->bindParam(":anaquel", $datos["anaquel"], PDO::PARAM_STR);


    if($stmt->execute()){



      return "ok";

    }else{

      return "error";
    
    }

  }





  static public function mdlMostrarAnaquelesInventario($id_inventario){


      $stmt = Conexion::conectar()->prepare("SELECT * FROM anaqueles_inventarios WHERE id_inventario = :id_inventario");

      $stmt -> bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);


    $stmt -> execute();

    return $stmt -> fetchall();
    

    

    $stmt -> close();

    $stmt = null;

  

  }


  static public function mdlMostrarAnaquelInventario($id_anaquel_inventario){

  $stmt = Conexion::conectar()->prepare("SELECT * FROM anaqueles_inventarios WHERE id_anaquel_inventario = :id_anaquel_inventario");

      $stmt -> bindParam(":id_anaquel_inventario", $id_anaquel_inventario, PDO::PARAM_INT);


    $stmt -> execute();

    return $stmt -> fetch();
    

    

    $stmt -> close();

    $stmt = null;

  }











static public function mdlMostrarAnaquelesInventarioVendedor($id_inventario, $id_usuario){


      $stmt = Conexion::conectar()->prepare("SELECT * FROM anaqueles_inventarios WHERE id_inventario = :id_inventario AND id_usuario_asignacion = :id_usuario_asignacion");

      $stmt -> bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);
      $stmt -> bindParam(":id_usuario_asignacion", $id_usuario, PDO::PARAM_INT);

    $stmt -> execute();

    return $stmt -> fetchall();
    

    

    $stmt -> close();

    $stmt = null;

  

  }










  static public function mdlAsignarAnaquelInventario($id_anaquel_inventario, $id_usuario){

  $stmt = Conexion::conectar()->prepare("UPDATE anaqueles_inventarios SET id_usuario_asignacion = :id_usuario_asignacion, fecha_asignacion = NOW(), estatus = 1 WHERE id_anaquel_inventario = :id_anaquel_inventario");

    $stmt -> bindParam(":id_anaquel_inventario", $id_anaquel_inventario, PDO::PARAM_INT);
    $stmt -> bindParam(":id_usuario_asignacion", $id_usuario, PDO::PARAM_INT);

    if($stmt->execute() !== false && $stmt->rowCount() > 0){

      return 1;

    }else{

      return 2;
    
    }
    

    $stmt -> close();

    $stmt = null;

  }










  static public function mdlCerrarAnaquelInventario($id_anaquel_inventario){

  $stmt = Conexion::conectar()->prepare("UPDATE anaqueles_inventarios SET estatus = 2 WHERE id_anaquel_inventario = :id_anaquel_inventario");

    $stmt -> bindParam(":id_anaquel_inventario", $id_anaquel_inventario, PDO::PARAM_INT);

    if($stmt->execute() !== false && $stmt->rowCount() > 0){

      return 1;

    }else{

      return 0;
    
    }
    

    $stmt -> close();

    $stmt = null;

  }

  
}

?>