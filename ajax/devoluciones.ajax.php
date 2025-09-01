<?php
error_reporting(0);
session_start();
require_once "../controladores/sucursales.controlador.php";
require_once "../modelos/sucursales.modelo.php";
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/devoluciones.controlador.php";
require_once "../modelos/devoluciones.modelo.php";
require_once "../modelos/partdev.modelo.php";
require_once "../controladores/existencias-sucursales.controlador.php";
require_once "../modelos/existencias-sucursales.modelo.php";
require_once "../modelos/kardex-productos.modelo.php";


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












  public $id_venta;
  public $lista_devolucion;
  public $id_motivo;
  public function  ajaxCrearDevolucionModulo(){

    require_once "../controladores/ventas.controlador.php";
    require_once "../modelos/ventas.modelo.php";
    require_once "../modelos/partvta.modelo.php";

    $valor1 = $this->id_venta;
    $valor2 = $this->lista_devolucion;
    $valor3 = $this->id_motivo;
    $respuesta = ControladorDevoluciones::ctrCrearDevolucionModulo($valor1, $valor2, $valor3);

    if($respuesta == 0){
      echo 0;
    }else{
      echo json_encode($respuesta);
    }
    



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
if(isset($_POST["id_venta_devolucion_producto_entrega"]) && isset($_POST["lista_devolucion_producto_entrega"]) && isset($_POST["id_motivo_devolucion_producto_entrega"])){

  $crear_devolucion_modulo = new AjaxDevoluciones();
  $crear_devolucion_modulo -> id_venta = $_POST["id_venta_devolucion_producto_entrega"];
  $crear_devolucion_modulo -> lista_devolucion = $_POST["lista_devolucion_producto_entrega"];
  $crear_devolucion_modulo -> id_motivo = $_POST["id_motivo_devolucion_producto_entrega"];
  $crear_devolucion_modulo -> ajaxCrearDevolucionModulo();
}
