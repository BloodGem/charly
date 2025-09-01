<?php
session_start();
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/ajustes-inventario.controlador.php";
require_once "../modelos/ajustes-inventario.modelo.php";
require_once "../controladores/existencias-sucursales.controlador.php";
require_once "../modelos/existencias-sucursales.modelo.php";
require_once "../modelos/partidas-ajustes-inventario.modelo.php";
require_once "../modelos/kardex-productos.modelo.php";

class AjaxAjustesInventario{


  

  /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_producto;

  public function ajaxMostrarProducto(){

    $valor = $this->id_producto;

    $respuesta = ControladorExistenciasSucursales::ctrMostrarProductoES($valor);

    echo json_encode($respuesta);

  }



    /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_ajuste_inventario;

  public function ajaxConfirmarAjusteInventario(){

    $valor1 = $this->id_ajuste_inventario;

    $respuesta = ControladorAjustesInventario::ctrConfirmarAjusteInventario($valor1);

    echo json_encode($respuesta);



  }





  /*=============================================
  MOSTRAR
  =============================================*/ 


  public function ajaxMostrarAjusteInventario(){

    $valor1 = $this->id_ajuste_inventario;
    $respuesta = ControladorAjustesInventario::ctrMostrarAjusteInventario($valor1);

    echo  json_encode($respuesta);



  }



}

/*=============================================

=============================================*/ 
if(isset($_POST["id_producto"])){

  $producto = new AjaxAjustesInventario();
  $producto -> id_producto = $_POST["id_producto"];
  $producto -> ajaxMostrarProducto();
}






/*=============================================

=============================================*/ 
if(isset($_POST["confirmarAjusteInventario"])){

  $confirmarAjusteInventario = new AjaxAjustesInventario();
  $confirmarAjusteInventario -> id_ajuste_inventario = $_POST["confirmarAjusteInventario"];
  $confirmarAjusteInventario -> ajaxConfirmarAjusteInventario();
}






/*=============================================
CREAR ABONO
=============================================*/ 
if(isset($_POST["id_ajuste_inventario2"])){

  $traerAjusteInventario = new AjaxAjustesInventario();
  $traerAjusteInventario -> id_ajuste_inventario = $_POST["id_ajuste_inventario2"];
  $traerAjusteInventario -> ajaxMostrarAjusteInventario();
}
