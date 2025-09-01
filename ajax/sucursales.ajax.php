<?php

require_once "../controladores/sucursales.controlador.php";
require_once "../modelos/sucursales.modelo.php";

class AjaxSucursales{

  /*=============================================
  EDITAR AUTO
  =============================================*/ 

  public $id_sucursal;

  public function ajaxEditarSucursal(){

    $valor = $this->id_sucursal;

    $respuesta = ControladorSucursales::ctrMostrarSucursal($valor);

    echo json_encode($respuesta);

  }

}

/*=============================================
EDITAR AUTO
=============================================*/ 
if(isset($_POST["id_sucursal"])){

  $sucursal = new AjaxSucursales();
  $sucursal -> id_sucursal = $_POST["id_sucursal"];
  $sucursal -> ajaxEditarSucursal();
}


