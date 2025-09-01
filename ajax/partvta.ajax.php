<?php

require_once "../modelos/partvta.modelo.php";

class AjaxPartvta{

  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $id_partvta;

  public function ajaxmostrarPartvta(){

    $valor = $this->id_partvta;

    $respuesta = ModeloPartvta::mdlMostrarPartvta($valor);

    echo json_encode($respuesta);

  }
}

/*=============================================
EDITAR PRODUCTO
=============================================*/ 
if(isset($_POST["id_partvta"])){

  $mostrar_partvta = new AjaxPartvta();
  $mostrar_partvta -> id_partvta = $_POST["id_partvta"];
  $mostrar_partvta -> ajaxmostrarPartvta();
}