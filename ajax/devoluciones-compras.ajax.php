<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/devoluciones.controlador.php";
require_once "../modelos/devoluciones.modelo.php";

class AjaxDevoluciones{


  

  /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_producto;

  public function ajaxMostrarProducto(){

    $valor = $this->id_producto;

    $respuesta = ControladorProductos::ctrMostrarProducto($valor);

    echo json_encode($respuesta);

  }



    /*=============================================
  MOSTRAR
  =============================================*/ 

  /*public $id_devolucion;

  public function ajaxMostrarDevolucionCliente(){

    $valor1 = $this->id_devolucion;

    $respuesta = ControladorDevoluciones::ctrMostrarDevolucionCliente($valor1);

    echo json_encode($respuesta);


  }*/





  /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_devolucion;

  public function ajaxMostrarDevolucion(){

    $valor1 = $this->id_devolucion;
    $respuesta = ControladorDevoluciones::ctrMostrarDevolucion($valor1);

    echo json_encode($respuesta);



  }



}

/*=============================================

=============================================*/ 
if(isset($_POST["id_producto"])){

  $producto = new AjaxDevoluciones();
  $producto -> id_producto = $_POST["id_producto"];
  $producto -> ajaxMostrarProducto();
}






/*=============================================

=============================================*/ 
if(isset($_POST["id_devolucion"])){

  $devolucion = new AjaxDevoluciones();
  $devolucion -> id_devolucion = $_POST["id_devolucion"];
  $devolucion -> ajaxMostrarDevolucion();
}






/*=============================================
CREAR ABONO
=============================================*/ 
/*if(isset($_POST["id_devolucion2"])){

  $devolucion2 = new AjaxDevoluciones();
  $devolucion2 -> id_devolucion2 = $_POST["id_devolucion2"];
  $devolucion2 -> ajaxMostrarDevolucion();
}*/
