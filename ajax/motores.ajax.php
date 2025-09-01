<?php

require_once "../controladores/motores.controlador.php";
require_once "../modelos/motores.modelo.php";

class AjaxMotores{

	/*=============================================
	EDITAR MOTOR
	=============================================*/	

	public $id_motor;

	public function ajaxEditarMotor(){

		$valor = $this->id_motor;

		$respuesta = ControladorMotores::ctrMostrarMotor($valor);

		echo json_encode($respuesta);

	}



	/*=============================================
	VALIDAR NO REPETIR MOTOR
	=============================================*/	

	public $validarMotor;

	public function ajaxValidarMotor(){

		$columna = "motor";
		$valor = $this->validarMotor;

		$respuesta = ControladorMotores::ctrMostrarMotorFiltro($columna, $valor);

		echo json_encode($respuesta);

	}






	/*=============================================
	CREAR MOTOR DESDE ALGUN MODULO
	=============================================*/	

	public $motor;

	public function ajaxCrearMotorMoludo(){

		$valor = $this->motor;

		$respuesta = ControladorMotores::ctrCrearMotorModulo($valor);

		echo json_encode($respuesta);

	}





}

/*=============================================
EDITAR AUTO
=============================================*/	
if(isset($_POST["id_motor"])){

	$motor = new AjaxMotores();
	$motor -> id_motor = $_POST["id_motor"];
	$motor -> ajaxEditarMotor();
}





/*=============================================
VALIDAR NO REPETIR MOTOR
=============================================*/

if(isset( $_POST["validarMotor"])){

	$valMotor = new AjaxMotores();
	$valMotor -> validarMotor = $_POST["validarMotor"];
	$valMotor -> ajaxValidarMotor();

}





/*=============================================
CREAR MOTOR DESDE ALGUN MODULO
=============================================*/

if(isset( $_POST["crearMotorModulo"])){

	$crearMotorModulo = new AjaxMotores();
	$crearMotorModulo -> motor = $_POST["crearMotorModulo"];
	$crearMotorModulo -> ajaxCrearMotorMoludo();

}