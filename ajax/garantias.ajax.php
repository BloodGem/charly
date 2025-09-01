<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/garantias.controlador.php";
require_once "../modelos/garantias.modelo.php";

class AjaxGarantias{


  /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_garantia;

  public function ajaxMostrarGarantia(){

    $valor1 = $this->id_garantia;
    $respuesta = ControladorGarantias::ctrMostrarGarantia($valor1);

    echo json_encode($respuesta);



  }



}





/*=============================================

=============================================*/ 
if(isset($_POST["id_garantia"])){

  $garantia = new AjaxGarantias();
  $garantia -> id_garantia = $_POST["id_garantia"];
  $garantia -> ajaxMostrarGarantia();
}





