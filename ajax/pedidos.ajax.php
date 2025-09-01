<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedidos.modelo.php";

class AjaxPedidos{


  

  /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_producto;

  public function ajaxMostrarProducto(){

    $columna = "id_producto";
    $valor = $this->id_producto;

    $respuesta = ControladorProductos::ctrMostrarProducto($valor);

    echo json_encode($respuesta);

  }



    /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_pedido;

  public function ajaxMostrarPedidoCliente(){

    $valor1 = $this->id_pedido;

    $respuesta = ControladorPedidos::ctrMostrarPedidoCliente($valor1);

    echo json_encode($respuesta);


  }





  /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_pedido2;

  public function ajaxMostrarPedido(){

    $valor1 = $this->id_pedido2;
    $respuesta = ControladorPedidos::ctrMostrarPedidoCliente($valor1);

    echo  json_encode($respuesta);



  }



}

/*=============================================

=============================================*/ 
if(isset($_POST["id_producto"])){

  $producto = new AjaxPedidos();
  $producto -> id_producto = $_POST["id_producto"];
  $producto -> ajaxMostrarProducto();
}






/*=============================================

=============================================*/ 
if(isset($_POST["id_pedido"])){

  $pedido = new AjaxPedidos();
  $pedido -> id_pedido = $_POST["id_pedido"];
  $pedido -> ajaxMostrarPedidoCliente();
}






/*=============================================
CREAR ABONO
=============================================*/ 
if(isset($_POST["id_pedido2"])){

  $pedido2 = new AjaxPedidos();
  $pedido2 -> id_pedido2 = $_POST["id_pedido2"];
  $pedido2 -> ajaxMostrarPedido();
}
