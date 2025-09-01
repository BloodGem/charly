<?php
session_start();
require_once "../controladores/formas-pago.controlador.php";
require_once "../modelos/formas-pago.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxFormasPago{

  /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_forma_pago;

  public function ajaxMostrarFormaPago(){

    $valor = $this->id_forma_pago;

    $respuesta = ControladorFormasPago::ctrMostrarFormaPago($valor);


    echo json_encode($respuesta);

  }







}




/*=============================================
EDITAR PRODUCTO
=============================================*/ 
if(isset($_POST["id_forma_pago"])){

  $traer_forma_pago = new AjaxFormasPago();
  $traer_forma_pago -> id_forma_pago = $_POST["id_forma_pago"];
  $traer_forma_pago -> ajaxMostrarFormaPago();
}





