<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
require_once "../controladores/csxc.controlador.php";
require_once "../modelos/csxc.modelo.php";

class AjaxCsxc{




  /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_venta;

  public function ajaxMostrarVenta(){

    $valor1 = $this->id_venta;

    $respuesta = ControladorVentas::ctrMostrarVentaCliente($valor1);

    echo json_encode($respuesta);


  }


    /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_cliente;

  public function ajaxMostrarAdeudoTotalClienteC(){

    $valor1 = $this->id_cliente;

    $respuesta = ControladorCsxc::ctrMostrarAdeudoTotalClienteC($valor1);

    echo json_encode($respuesta);


  }





}


/*=============================================
VER LAS CUENTAS POR COBRAR DE UN CLIENTE Y SU ADEUDO TOTAL
=============================================*/ 
if(isset($_POST["id_cliente"])){

  $cxcCliente = new AjaxCsxc();
  $cxcCliente -> id_cliente = $_POST["id_cliente"];
  $cxcCliente -> ajaxMostrarAdeudoTotalClienteC();
}






/*=============================================
CREAR ABONO
=============================================*/ 
if(isset($_POST["id_venta"])){

  $venta = new AjaxCsxc();
  $venta -> id_venta = $_POST["id_venta"];
  $venta -> ajaxMostrarVenta();
}
