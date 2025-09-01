<?php
session_start();
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos{

  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $id_producto;

  public $multiclave;

  public $columna;

  public $valor;

  public $imagen;

  public $no_imagen;

  public function ajaxEditarProducto(){

    $columna = "id_producto";
    $valor = $this->id_producto;

    $respuesta = ControladorProductos::ctrMostrarProductos($columna, $valor);

    echo json_encode($respuesta);

  }
  
  
  
  
  
  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $clave_producto;

  public function ajaxValidarClaveProducto(){

    $columna = "clave_producto";
    $valor = $this->clave_producto;

    $respuesta = ControladorProductos::ctrMostrarProductos($columna, $valor);

    echo json_encode($respuesta);

  }










  public function ajaxMostrarProductoClaveProducto(){

    $columna = "clave_producto";
    $valor = $this->clave_producto;

    $respuesta = ControladorProductos::ctrMostrarProductos($columna, $valor);

    if($respuesta !== false){
      echo json_encode($respuesta);
    }else{
      $respuesta2 = ControladorProductos::ctrMostrarMulticlaveProducto3($valor);
      echo json_encode($respuesta2);
    }

    

  }










  public function ajaxCrearMulticlaveProducto(){

    $valor1 = $this->id_producto;
    $valor2 = $this->multiclave;
    $valor3 = $this->multiplo_entrega;

    $respuesta = ControladorProductos::ctrCrearMulticlaveProducto($valor1, $valor2, $valor3);

    echo $respuesta;

  }






  public function ajaxEliminarMulticlaveProducto(){

    $valor = $this->id_multiclave;

    $respuesta = ControladorProductos::ctrEliminarMulticlaveProducto($valor);

    echo $respuesta;

  }










public function ajaxActualizarProducto(){

    $valor1 = $this->columna;

    $valor2 = $this->valor;

    $valor3 = $this->id_producto;

    $respuesta = ControladorProductos::ctrActualizarProducto($valor1, $valor2, $valor3);

    echo $respuesta;

  }












  public function ajaxSubirImagenProducto(){

    $valor1 = $this->no_imagen;

    $valor2 = $this->imagen;

    $valor3 = $this->id_producto;

    $respuesta = ControladorProductos::ctrSubirImagenProducto($valor1, $valor2, $valor3);

    if($respuesta == 1){
      echo $valor2;
    }else{
      echo 0;
    }

  }










}










/*=============================================
EDITAR PRODUCTO
=============================================*/ 
if(isset($_POST["id_producto"])){

  $producto = new AjaxProductos();
  $producto -> id_producto = $_POST["id_producto"];
  $producto -> ajaxEditarProducto();
}



/*=============================================
REVISAR SI LA CLAVE DEL PRODUCTO YA ESTA REGISTRADA
=============================================*/ 
if(isset($_POST["validarClaveProducto"])){

  $validar_clave_producto = new AjaxProductos();
  $validar_clave_producto -> clave_producto = $_POST["validarClaveProducto"];
  $validar_clave_producto -> ajaxValidarClaveProducto();
}





if(isset($_POST["codigo_barras"])){

  $producto = new AjaxProductos();
  $producto -> clave_producto = $_POST["codigo_barras"];
  $producto -> ajaxMostrarProductoClaveProducto();
}











if(isset($_POST["crearMulticlaveProducto"])){

  $crear_multiclave_producto = new AjaxProductos();
  $crear_multiclave_producto -> id_producto = $_POST["crearMulticlaveProducto"];
  $crear_multiclave_producto -> multiclave = $_POST["multiclave"];
  $crear_multiclave_producto -> multiplo_entrega = $_POST["multiplo_entrega"];
  $crear_multiclave_producto -> ajaxCrearMulticlaveProducto();
}





if(isset($_POST["eliminarMulticlaveProducto"])){

  $eliminar_multiclave_producto = new AjaxProductos();
  $eliminar_multiclave_producto -> id_multiclave = $_POST["eliminarMulticlaveProducto"];
  $eliminar_multiclave_producto -> ajaxEliminarMulticlaveProducto();
}










if(isset($_POST["actualizarProducto"])){

  $actualizar_producto = new AjaxProductos();
  $actualizar_producto -> id_producto = $_POST["actualizarProducto"];
  $actualizar_producto -> columna = $_POST["columna"];
  $actualizar_producto -> valor = $_POST["valor"];
  $actualizar_producto -> ajaxActualizarProducto();
}









if(isset($_POST["subirImagenProducto"])){

  $subir_imagen_producto = new AjaxProductos();
  $subir_imagen_producto -> id_producto = $_POST["subirImagenProducto"];
  $subir_imagen_producto -> no_imagen = $_POST["no_imagen"];
  

  $imagenN = $_FILES["imagen"]["name"];
  $tempname = $_FILES["imagen"]["tmp_name"];    
  $folder = "../vistas/img/productos/".$imagenN;
  $imagen_db = "vistas/img/productos/".$imagenN;
  $subir_imagen_producto -> imagen = $imagen_db;
  if(move_uploaded_file($tempname, $folder)){
    $subir_imagen_producto -> ajaxSubirImagenProducto();
  }else{
    return 0;
  }

  
}