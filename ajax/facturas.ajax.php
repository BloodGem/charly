<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";


class AjaxFacturas{

  /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_venta;

  public function ajaxMostrarVentaFactura(){

    $valor = $this->id_venta;

    $respuesta = ControladorVentas::ctrMostrarVentaFactura($valor);


    echo json_encode($respuesta);

  }







}




/*=============================================
BUSCAR VENTA PARA FACTURAR
=============================================*/ 
if(isset($_POST["id_venta"])){

  $buscarVentaFactura = new AjaxFacturas();
  $buscarVentaFactura -> id_venta = $_POST["id_venta"];
  $buscarVentaFactura -> ajaxMostrarVentaFactura();
}





