<?php

require_once "../controladores/subfamilias.controlador.php";
require_once "../modelos/subfamilias.modelo.php";

class AjaxSubfamilias{

	/*=============================================
	EDITAR AUTO
	=============================================*/	

	public $id_subfamilia;

	public function ajaxEditarSubfamilia(){

		$valor = $this->id_subfamilia;

		$respuesta = ControladorSubfamilias::ctrMostrarSubfamilia($valor);

		echo json_encode($respuesta);

	}




	/*=============================================
	VALIDAR NO REPETIR AUTO
	=============================================*/	

	public $validarSubfamiliaCompleta;

	public function ajaxValidarSubfamiliaCompleta(){

		$columna = "subfamilia_completa";
		$valor = $this->validarSubfamiliaCompleta;

		$respuesta = ControladorSubfamilias::ctrMostrarSubfamiliaFiltro($columna, $valor);

		echo json_encode($respuesta);

	}
	
	
	
	
	/*=============================================
  TRAER AUTOS
  =============================================*/ 

  public $traerSubfamiliasModulo;

  public function ajaxTraerSubfamiliasModulo(){

    if($this->traerSubfamiliasModulo == "ok"){

      $respuesta = ControladorSubfamilias::ctrMostrarSubfamiliasModulo();

      echo json_encode($respuesta);


    }

  }
}

/*=============================================
EDITAR AUTO
=============================================*/	
if(isset($_POST["id_subfamilia"])){

	$subfamilia = new AjaxSubfamilias();
	$subfamilia -> id_subfamilia = $_POST["id_subfamilia"];
	$subfamilia -> ajaxEditarSubfamilia();
}





/*=============================================
TRAER AUTOS
=============================================*/ 

if(isset($_POST["traerSubfamiliasModulo"])){

  $traerSubfamilias = new AjaxSubfamilias();
  $traerSubfamilias -> traerSubfamiliasModulo = $_POST["traerSubfamiliasModulo"];
  $traerSubfamilias -> ajaxTraerSubfamiliasModulo();

}





/*=============================================
VALIDAR NO REPETIR AUTO
=============================================*/

if(isset( $_POST["validarSubfamiliaCompleta"])){

	$validarSubfamiliaCompleta= new AjaxSubfamilias();
	$validarSubfamiliaCompleta-> validarSubfamiliaCompleta = $_POST["validarSubfamiliaCompleta"];
	$validarSubfamiliaCompleta-> ajaxValidarSubfamiliaCompleta();

}
