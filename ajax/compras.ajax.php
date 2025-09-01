<?php
session_start();
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/compras.controlador.php";
require_once "../modelos/compras.modelo.php";
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/existencias-sucursales.controlador.php";
require_once "../modelos/existencias-sucursales.modelo.php";
require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";
require_once "../controladores/partcom.controlador.php";
require_once "../modelos/partcom.modelo.php";
require_once "../modelos/kardex-productos.modelo.php";

class AjaxCompras{


  

  /*=============================================
  MOSTRAR
  =============================================*/ 
  public $id_compra;
  public $id_producto;
  public $descuento;
  public $cantidad;
  public $precio_unitario;
  public $precio;
  public $total;
  public $id_partcom;

  public function ajaxInsertarProductoCompra(){

    $valor1 = $this->id_compra;

    $valor2 = $this->id_producto;

    $valor3 = $this->descuento;

    $respuesta = ControladorCompras::ctrInsertarProductoCompra($valor1, $valor2, $valor3);

    echo json_encode($respuesta);

  }






  public function ajaxGuardaDatosPartidaCompra(){

    $valor1 = $this->id_partcom;

    $valor2 = $this->cantidad;

    $valor3 = $this->descuento;

    $valor4 = $this->precio_unitario;

    $valor5 = $this->precio;

    $valor6 = $this->total;

    $respuesta = ControladorCompras::ctrGuardaDatosPartidaCompra($valor1, $valor2, $valor3, $valor4, $valor5, $valor6);

    echo $respuesta;

  }







  public function ajaxEliminarPartidaCompra(){

    $valor1 = $this->id_partcom;

    $respuesta = ControladorCompras::ctrEliminarPartidaCompra($valor1);

    echo $respuesta;

  }



    /*=============================================
  MOSTRAR
  =============================================*/ 

  
  public $es_credito;

  public function ajaxConfirmarCompra(){

    $valor1 = $this->id_compra;

    $valor2 = $this->es_credito;

    $respuesta = ControladorCompras::ctrConfirmarCompra($valor1, $valor2);

    echo json_encode($respuesta);



  }





  /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_compra2;

  public function ajaxMostrarCompra(){

    $valor1 = $this->id_compra2;
    $respuesta = ControladorCompras::ctrMostrarCompra($valor1);

    echo  json_encode($respuesta);



  }



}

/*=============================================

=============================================*/ 
if(isset($_POST["id_producto"])){

  $producto = new AjaxCompras();
  $producto -> id_compra = $_POST["id_compra"];
  $producto -> id_producto = $_POST["id_producto"];
  $producto -> descuento = $_POST["descuento"];
  $producto -> ajaxInsertarProductoCompra();
}






/*=============================================

=============================================*/ 
if(isset($_POST["confirmarCompra"])){

  $confirmarCompra = new AjaxCompras();
  $confirmarCompra -> id_compra = $_POST["confirmarCompra"];
  $confirmarCompra -> es_credito = $_POST["es_credito"];
  $confirmarCompra -> ajaxConfirmarCompra();
}






/*=============================================
CREAR ABONO
=============================================*/ 
if(isset($_POST["id_compra2"])){

  $compra2 = new AjaxCompras();
  $compra2 -> id_compra2 = $_POST["id_compra2"];
  $compra2 -> ajaxMostrarCompra();
}










if(isset($_POST["guardaDatosPartidaCompra"])){

  $guardar_datos_partida_compra = new AjaxCompras();
  $guardar_datos_partida_compra -> id_partcom = $_POST["guardaDatosPartidaCompra"];
  $guardar_datos_partida_compra -> cantidad = $_POST["cantidad"];
  $guardar_datos_partida_compra -> descuento = $_POST["descuento"];
  $guardar_datos_partida_compra -> precio_unitario = $_POST["precio_unitario"];
  $guardar_datos_partida_compra -> precio = $_POST["precio"];
  $guardar_datos_partida_compra -> total = $_POST["total"];
  $guardar_datos_partida_compra -> ajaxGuardaDatosPartidaCompra();
}








if(isset($_POST["eliminarPartidaCompra"])){

  $guardar_datos_partida_compra = new AjaxCompras();
  $guardar_datos_partida_compra -> id_partcom = $_POST["eliminarPartidaCompra"];
  $guardar_datos_partida_compra -> ajaxEliminarPartidaCompra();
}