<?php
session_start();
require_once "../modelos/partcom.modelo.php";

class AjaxPartcom{

  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $id_partcom;

  public $columna;

  public $valor;



  public function ajaxActualizarPartcom(){

    $columna = $this->columna;

    $valor = $this->valor;

    $id_partcom = $this->id_partcom;

    $respuesta = ModeloPartCom::mdlActualizarPartCom($columna, $valor, $id_partcom);

    echo $respuesta;

  }
}

/*=============================================
EDITAR PRODUCTO
=============================================*/ 
if(isset($_POST["actualizarPartcom"])){

  $mostrar_partcom = new AjaxPartcom();
  $mostrar_partcom -> id_partcom = $_POST["actualizarPartcom"];
  $mostrar_partcom -> columna = $_POST["columna"];
  $mostrar_partcom -> valor = $_POST["valor"];
  $mostrar_partcom -> ajaxActualizarPartcom();
}