<?php
session_start();
require_once "../controladores/computadoras.controlador.php";
require_once "../modelos/computadoras.modelo.php";

class AjaxComputadoras{

	public $id_computadora;

	public function ajaxMostrarComputadora(){

		$valor = $this->id_computadora;
		$respuesta = ControladorComputadoras::ctrMostrarComputadora($valor);

		echo  json_encode($respuesta);

	}







	/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/	

	public $validarCodigo;

	public function ajaxValidarCodigo(){

		$columna = "codigo";
		$valor = $this->validarCodigo;

		$respuesta = ControladorComputadoras::ctrMostrarComputadora2($columna, $valor);

		echo json_encode($respuesta);

	}





	public $validarComputadora;

	public function ajaxValidarComputadora(){

		$columna = "computadora";
		$valor = $this->validarComputadora;

		$respuesta = ControladorComputadoras::ctrMostrarComputadora2($columna, $valor);

		echo json_encode($respuesta);

	}





}

if (isset($_POST["traerComputadora"])) {
	$editar = new AjaxComputadoras();
	$editar -> id_computadora = $_POST['traerComputadora'];
	$editar -> ajaxMostrarComputadora();
}





/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if(isset( $_POST["validarCodigo"])){

	$valCodigo = new AjaxComputadoras();
	$valCodigo -> validarCodigo = $_POST["validarCodigo"];
	$valCodigo -> ajaxValidarCodigo();

}





if(isset( $_POST["validarComputadora"])){

	$valComputadora = new AjaxComputadoras();
	$valComputadora -> validarComputadora = $_POST["validarComputadora"];
	$valComputadora -> ajaxValidarComputadora();

}

