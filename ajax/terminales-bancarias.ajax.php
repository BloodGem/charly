<?php

require_once "../controladores/terminales-bancarias.controlador.php";
require_once "../modelos/terminales-bancarias.modelo.php";

class AjaxTerminalesBancarias{

	/*=============================================
	EDITAR MOTOR
	=============================================*/	

	public $id_terminal_bancaria;

	public function ajaxEditarTerminalBancaria(){

		$valor = $this->id_terminal_bancaria;

		$respuesta = ControladorTerminalesBancarias::ctrMostrarTerminalBancaria($valor);

		echo json_encode($respuesta);

	}



	/*=============================================
	VALIDAR NO REPETIR MOTOR
	=============================================*/	

	public $validarTerminalBancaria;

	public function ajaxValidarTerminalBancaria(){

		$columna = "terminal_bancaria";
		$valor = $this->validarTerminalBancaria;

		$respuesta = ControladorTerminalesBancarias::ctrMostrarTerminalBancariaFiltro($columna, $valor);

		echo json_encode($respuesta);

	}







}

/*=============================================
EDITAR AUTO
=============================================*/	
if(isset($_POST["id_terminal_bancaria"])){

	$motor = new AjaxTerminalesBancarias();
	$motor -> id_terminal_bancaria = $_POST["id_terminal_bancaria"];
	$motor -> ajaxEditarTerminalBancaria();
}





/*=============================================
VALIDAR NO REPETIR MOTOR
=============================================*/

if(isset( $_POST["validarTerminalBancaria"])){

	$valTerminalBancaria = new AjaxTerminalesBancarias();
	$valTerminalBancaria -> validarTerminalBancaria = $_POST["validarTerminalBancaria"];
	$valTerminalBancaria -> ajaxValidarTerminalBancaria();

}


