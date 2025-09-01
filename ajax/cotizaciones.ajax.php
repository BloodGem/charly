<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/cotizaciones.controlador.php";
require_once "../modelos/cotizaciones.modelo.php";

class AjaxCotizaciones{

  public $id_cotizacion;

  public function ajaxMostrarCotizacion(){

    $valor1 = $this->id_cotizacion;
    $respuesta = ControladorCotizaciones::ctrMostrarCotizacion($valor1);

    echo json_encode($respuesta);



  }



}



/*=============================================

=============================================*/ 
if(isset($_POST["traerCotizacion"])){

  $cotizacion = new AjaxCotizaciones();
  $cotizacion -> id_cotizacion = $_POST["traerCotizacion"];
  $cotizacion -> ajaxMostrarCotizacion();
}

