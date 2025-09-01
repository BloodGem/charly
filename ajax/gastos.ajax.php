<?php

require_once "../controladores/gastos.controlador.php";
require_once "../modelos/gastos.modelo.php";

class AjaxGastos{

	/*=============================================
	EDITAR GASTO
	=============================================*/	

	public $id_gasto;

	public function ajaxEditarGasto(){

		$columna = "id_gasto";
		$valor = $this->id_gasto;

		$respuesta = ControladorGastos::ctrMostrarGastos($columna, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR GASTO
=============================================*/	
if(isset($_POST["id_gasto"])){

	$gasto = new AjaxGastos();
	$gasto -> id_gasto = $_POST["id_gasto"];
	$gasto -> ajaxEditarGasto();
}
