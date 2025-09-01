<?php
session_start();
require_once "../controladores/resurtido.controlador.php";
require_once "../modelos/resurtido.modelo.php";
require_once "../modelos/partres.modelo.php";
class AjaxResurtidos{




    /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_resurtido;

  public $id_partres;

  public $a_pedir;

  public function ajaxConvertirResurtidoACompra(){

    $valor1 = $this->id_resurtido;

    $respuesta = ControladorResurtidos::ctrConvertirResurtidoACompra($valor1);

    echo json_encode($respuesta);



  }










  public function ajaxGuardaDatosPartidaResurtido(){

    $valor1 = $this->id_partres;

    $valor2 = $this->a_pedir;

    $respuesta = ControladorResurtidos::ctrGuardaDatosPartidaResurtido($valor1, $valor2);

    echo $respuesta;

  }











  public function ajaxEliminarPartidaResurtido(){

    $valor1 = $this->id_partres;

    $respuesta = ControladorResurtidos::ctrEliminarPartidaResurtido($valor1);

    echo $respuesta;

  }




}






/*=============================================

=============================================*/ 
if(isset($_POST["id_resurtido"])){

  $converirResurtidoACompra = new AjaxResurtidos();
  $converirResurtidoACompra -> id_resurtido = $_POST["id_resurtido"];
  $converirResurtidoACompra -> ajaxConvertirResurtidoACompra();
}





if(isset($_POST["eliminarPartidaResurtido"])){

  $eliminar_partida_resurtido = new AjaxResurtidos();
  $eliminar_partida_resurtido -> id_partres = $_POST["eliminarPartidaResurtido"];
  $eliminar_partida_resurtido -> ajaxEliminarPartidaResurtido();
}





if(isset($_POST["guardaDatosPartidaResurtido"])){

  $guardar_datos_partida_resurtido = new AjaxResurtidos();
  $guardar_datos_partida_resurtido -> id_partres = $_POST["guardaDatosPartidaResurtido"];
  $guardar_datos_partida_resurtido -> a_pedir = $_POST["a_pedir"];
  $guardar_datos_partida_resurtido -> ajaxGuardaDatosPartidaResurtido();
}