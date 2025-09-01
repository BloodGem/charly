<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductosProveedores{

  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $id_producto;
  public $id_proveedor;
  public $valor;
  public $columna;

  public function ajaxMostrarProductoProveedor(){

    $valor1 = $this->id_producto;
    $valor2 = $this->id_proveedor;

    $respuesta = ControladorProductos::ctrMostrarProductoProveedor2($valor1, $valor2);

    echo json_encode($respuesta);

  }





  public function ajaxActualizarProductoProveedor(){

    $valor1 = $this->columna;
    $valor2 = $this->valor;
    $valor3 = $this->id_producto;
    $valor4 = $this->id_proveedor;

    $respuesta = ControladorProductos::ctrActualizarProductoProveedor($valor1, $valor2, $valor3, $valor4);

    echo $respuesta;

  }


}

/*=============================================
EDITAR PRODUCTO
=============================================*/ 
if(isset($_POST["traerProductoProveedor"])){

  $traerProductoProveedor = new AjaxProductosProveedores();
  $traerProductoProveedor -> id_producto = $_POST["traerProductoProveedor"];
  $traerProductoProveedor -> id_proveedor = $_POST["id_proveedor"];
  $traerProductoProveedor -> ajaxMostrarProductoProveedor();
}






/*=============================================
EDITAR PRODUCTO
=============================================*/ 
if(isset($_POST["actualizarProductoProveedor"])){

  $actualizarProductoProveedor = new AjaxProductosProveedores();
  $actualizarProductoProveedor -> id_producto = $_POST["actualizarProductoProveedor"];
  $actualizarProductoProveedor -> id_proveedor = $_POST["id_proveedor"];
  $actualizarProductoProveedor -> valor = $_POST["valor"];
  $actualizarProductoProveedor -> columna = $_POST["columna"];
  $actualizarProductoProveedor -> ajaxActualizarProductoProveedor();
}

