<?php

require_once "../controladores/vendedores.controlador.php";
require_once "../modelos/vendedores.modelo.php";

class AjaxVendedores{

	/*ACTIVAR O DESACTIVAR USUARIO*/
	public $columna1;
	public $valor1;
	public $columna2;
	public $valor2;

	public function ajaxActivarDesactivarVendedor(){

		$columna1 = $this->columna1;
		$valor1 = $this->valor1;
		$columna2 = $this->columna2;
		$valor2 = $this->valor2;

		$respuesta = ModeloVendedores::mdlActualizarVendedor($columna1, $valor1, $columna2, $valor2);

	}




	public $columna;
	public $valor;
	/*=============================================
	VALIDAR NO REPETIR UN CODIGO DE VENDEDOR
	=============================================*/	

	public function ajaxMostrarVendedor(){

		$columna = $this->columna;
		$valor = $this->valor;

		$respuesta = ControladorVendedores::ctrMostrarVendedor($columna, $valor);

		echo json_encode($respuesta);

	}





}


/*=============================================
ACTIVAR USUARIO
=============================================*/	

if(isset($_POST["cambiar_estatus"])){

	$activarVendedor = new AjaxVendedores();
	$activarVendedor -> columna1 = $_POST["columna1"];
	$activarVendedor -> valor1 = $_POST["cambiar_estatus"];
	$activarVendedor -> columna2 = $_POST["columna2"];
	$activarVendedor -> valor2 = $_POST["valor2"];
	$activarVendedor -> ajaxActivarDesactivarVendedor();

}




/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if(isset( $_POST["mostrar_vendedor"])){

	$valVendedor = new AjaxVendedores();
	$valVendedor -> valor = $_POST["mostrar_vendedor"];
	$valVendedor -> columna = $_POST["columna"];
	$valVendedor -> ajaxMostrarVendedor();

}




