<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class AjaxNotas{


    /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_venta_nota;

  public function ajaxMostrarVentaCliente(){

    $valor1 = $this->id_venta_nota;

    $respuesta = ControladorVentas::ctrMostrarVentaCliente($valor1);

    echo json_encode($respuesta);


  }






}
/*=============================================
EDITAR PRODUCTO
=============================================*/ 
if(isset($_POST["id_venta_nota"])){

  $ventaNota = new AjaxNotas();
  $ventaNota -> id_venta_nota = $_POST["id_venta_nota"];
  $ventaNota -> ajaxMostrarVentaCliente();
}
