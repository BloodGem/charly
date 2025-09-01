<?php
session_start();
require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxCobro{

  /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_producto;

  public function ajaxMostrarVentaCobro(){

    $valor = $this->folio;

    $respuesta = ControladorVentas::ctrMostrarVentaCobro($valor);


    echo json_encode($respuesta);

  }







}




/*=============================================
EDITAR PRODUCTO
=============================================*/ 
if(isset($_POST["folio"])){

  $folio = new AjaxCobro();
  $folio -> folio = $_POST["folio"];
  $folio -> ajaxMostrarVentaCobro();
}





