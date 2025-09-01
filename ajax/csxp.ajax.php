<?php

session_start();

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/compras.controlador.php";
require_once "../modelos/compras.modelo.php";
require_once "../controladores/csxp.controlador.php";
require_once "../modelos/csxp.modelo.php";

class AjaxCsxp{




  /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_compra;

  public function ajaxMostrarCompra(){

    $valor1 = $this->id_compra;

    $respuesta = ControladorCompras::ctrMostrarCompra($valor1);

    echo json_encode($respuesta);


  }


    /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_proveedor;

  public function ajaxMostrarAdeudoTotalProveedorC(){

    $valor1 = $this->id_proveedor;

    $respuesta = ControladorCsxp::ctrMostrarAdeudoTotalProveedorC($valor1);

    echo json_encode($respuesta);


  }





}


/*=============================================
VER LAS CUENTAS POR COBRAR DE UN CLIENTE Y SU ADEUDO TOTAL
=============================================*/ 
if(isset($_POST["id_proveedor"])){

  $cxpProveedor = new AjaxCsxp();
  $cxpProveedor -> id_proveedor = $_POST["id_proveedor"];
  $cxpProveedor -> ajaxMostrarAdeudoTotalProveedorC();
}






/*=============================================
CREAR ABONO
=============================================*/ 
if(isset($_POST["id_compra"])){

  $mostrarCompra = new AjaxCsxp();
  $mostrarCompra -> id_compra = $_POST["id_compra"];
  $mostrarCompra -> ajaxMostrarCompra();
}




