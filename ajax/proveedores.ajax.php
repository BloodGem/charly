<?php

session_start();

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

class AjaxProveedores{

  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $id_proveedor;

  public function ajaxEditarProveedor(){

    $valor = $this->id_proveedor;

    $respuesta = ControladorProveedores::ctrMostrarProveedor($valor);

    echo json_encode($respuesta);

  }




  /*=============================================
  VALIDAR NO REPETIR NOMBRE FÍSCAL
  =============================================*/ 

  public $validarNombre;

  public function ajaxValidarNombre(){

    $columna = "nombre";
    $valor = $this->validarNombre;

    $respuesta = ControladorProveedores::ctrMostrarProveedor2($columna, $valor);

    echo json_encode($respuesta);

  }




  /*=============================================
  VALIDAR NO REPETIR RFC
  =============================================*/ 

  public $validarRfc;

  public function ajaxValidarRfc(){

    $columna = "rfc";
    $valor = $this->validarRfc;

    $respuesta = ControladorProveedores::ctrMostrarProveedor2($columna, $valor);

    echo json_encode($respuesta);

  }




}

/*=============================================
EDITAR PRODUCTO
=============================================*/ 
if(isset($_POST["id_proveedor"])){

  $proveedor = new AjaxProveedores();
  $proveedor -> id_proveedor = $_POST["id_proveedor"];
  $proveedor -> ajaxEditarProveedor();
}




/*=============================================
VALIDAR NO REPETIR NOMBRE
=============================================*/

if(isset( $_POST["validarNombre"])){

  $valNombre = new AjaxProveedores();
  $valNombre -> validarNombre = $_POST["validarNombre"];
  $valNombre -> ajaxValidarNombre();

}




/*=============================================
VALIDAR NO REPETIR RFC
=============================================*/

if(isset( $_POST["validarRfc"])){

  $valRfc = new AjaxProveedores();
  $valRfc -> validarRfc = $_POST["validarRfc"];
  $valRfc -> ajaxValidarRfc();

}