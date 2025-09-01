<?php

require_once "../controladores/vendedores.controlador.php";
require_once "../modelos/vendedores.modelo.php";

class AjaxCrearVenta{


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
MOSTRAR VENDEDOR
=============================================*/

if(isset( $_POST["mostrar_vendedor"])){

	$mostrarVendedor = new AjaxCrearVenta();
	$mostrarVendedor -> valor = $_POST["mostrar_vendedor"];
	$mostrarVendedor -> columna = $_POST["columna"];
	$mostrarVendedor -> ajaxMostrarVendedor();

}
