<?php

require_once "../controladores/tipos.gastos.controlador.php";
require_once "../modelos/tipos.gastos.modelo.php";

class AjaxTiposGastos{

	/*=============================================
	EDITAR TIPO DE GASTO
	=============================================*/	

	public $id_tipo_gasto;

	public function ajaxEditarTipoGasto(){

		$columna = "id_tipo_gasto";
		$valor = $this->id_tipo_gasto;

		$respuesta = ControladorTiposGastos::ctrMostrarTiposGastos($columna, $valor);

		echo json_encode($respuesta);

	}




	/*=============================================
	VALIDAR NO REPETIR EL TIPO DE GASTO
	=============================================*/	

	public $validarTipoGasto;

	public function ajaxValidarTipoGasto(){

		$columna = "tipo_gasto";
		$valor = $this->validarTipoGasto;

		$respuesta = ControladorTiposGastos::ctrMostrarTiposGastos($columna, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR TIPO DE GASTO
=============================================*/	
if(isset($_POST["id_tipo_gasto"])){

	$tipo_gasto = new AjaxTiposGastos();
	$tipo_gasto -> id_tipo_gasto = $_POST["id_tipo_gasto"];
	$tipo_gasto -> ajaxEditarTipoGasto();
}




/*=============================================
VALIDAR NO REPETIR EL TIPO DE GASTO
=============================================*/

if(isset( $_POST["validarTipoGasto"])){

	$valTipoGasto = new AjaxTiposGastos();
	$valTipoGasto -> validarTipoGasto = $_POST["validarTipoGasto"];
	$valTipoGasto -> ajaxValidarTipoGasto();

}