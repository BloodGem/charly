<?php

require_once "../controladores/autos.controlador.php";
require_once "../modelos/autos.modelo.php";

class AjaxAutos{

	/*=============================================
	EDITAR AUTO
	=============================================*/	

	public $id_auto;

	public function ajaxEditarAuto(){

		$valor = $this->id_auto;

		$respuesta = ControladorAutos::ctrMostrarAuto($valor);

		echo json_encode($respuesta);

	}




	/*=============================================
	VALIDAR NO REPETIR AUTO
	=============================================*/	

	public $validarAutoCompleto;

	public function ajaxValidarAutoCompleto(){

		$columna = "auto_completo";
		$valor = $this->validarAutoCompleto;

		$respuesta = ControladorAutos::ctrMostrarAutoFiltro($columna, $valor);

		echo json_encode($respuesta);

	}
	
	
	
	
	/*=============================================
  TRAER AUTOS
  =============================================*/ 

  public $traerAutosModulo;

  public function ajaxTraerAutosModulo(){

    if($this->traerAutosModulo == "ok"){

      $respuesta = ControladorAutos::ctrMostrarAutosModulo();

      echo json_encode($respuesta);


    }

  }
}

/*=============================================
EDITAR AUTO
=============================================*/	
if(isset($_POST["id_auto"])){

	$auto = new AjaxAutos();
	$auto -> id_auto = $_POST["id_auto"];
	$auto -> ajaxEditarAuto();
}





/*=============================================
TRAER AUTOS
=============================================*/ 

if(isset($_POST["traerAutosModulo"])){

  $traerAutos = new AjaxAutos();
  $traerAutos -> traerAutosModulo = $_POST["traerAutosModulo"];
  $traerAutos -> ajaxTraerAutosModulo();

}





/*=============================================
VALIDAR NO REPETIR AUTO
=============================================*/

if(isset( $_POST["validarAutoCompleto"])){

	$validarAutoCompleto= new AjaxAutos();
	$validarAutoCompleto-> validarAutoCompleto = $_POST["validarAutoCompleto"];
	$validarAutoCompleto-> ajaxValidarAutoCompleto();

}
