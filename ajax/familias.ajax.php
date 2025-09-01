<?php

require_once "../controladores/familias.controlador.php";
require_once "../modelos/familias.modelo.php";

class AjaxFamilias{

	/*=============================================
	EDITAR FAMILIA
	=============================================*/	

	public $id_familia;

	public function ajaxEditarFamilia(){

		$columna = "id_familia";
		$valor = $this->id_familia;

		$respuesta = ControladorFamilias::ctrMostrarFamilias($columna, $valor);

		echo json_encode($respuesta);

	}



	/*=============================================
	VALIDAR NO REPETIR FAMILIA
	=============================================*/	

	public $validarFamilia;

	public function ajaxValidarFamilia(){

		$columna = "familia";
		$valor = $this->validarFamilia;

		$respuesta = ControladorFamilias::ctrMostrarFamilias($columna, $valor);

		echo json_encode($respuesta);

	}





	/*=============================================
	CREAR FAMILIA DESDE ALGUN MODULO
	=============================================*/	

	public $familia;

	public function ajaxCrearFamiliaMoludo(){

		$valor = $this->familia;

		$respuesta = ControladorFamilias::ctrCrearFamiliaModulo($valor);

		echo json_encode($respuesta);

	}





}

/*=============================================
EDITAR AUTO
=============================================*/	
if(isset($_POST["id_familia"])){

	$familia = new AjaxFamilias();
	$familia -> id_familia = $_POST["id_familia"];
	$familia -> ajaxEditarFamilia();
}





/*=============================================
VALIDAR NO REPETIR FAMILIA
=============================================*/

if(isset( $_POST["validarFamilia"])){

	$valFamilia = new AjaxFamilias();
	$valFamilia -> validarFamilia = $_POST["validarFamilia"];
	$valFamilia -> ajaxValidarFamilia();

}





/*=============================================
CREAR FAMILIA DESDE ALGUN MODULO
=============================================*/

if(isset( $_POST["crearFamiliaModulo"])){

	$crearFamiliaModulo = new AjaxFamilias();
	$crearFamiliaModulo -> familia = $_POST["crearFamiliaModulo"];
	$crearFamiliaModulo -> ajaxCrearFamiliaMoludo();

}