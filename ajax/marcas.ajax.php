<?php

require_once "../controladores/marcas.controlador.php";
require_once "../modelos/marcas.modelo.php";

class AjaxMarcas{

	/*=============================================
	EDITAR MARCA
	=============================================*/	

	public $id_marca;

	public function ajaxEditarMarca(){

		$valor = $this->id_marca;

		$respuesta = ControladorMarcas::ctrMostrarMarca($valor);

		echo json_encode($respuesta);

	}



	/*=============================================
	VALIDAR NO REPETIR MARCA
	=============================================*/	

	public $validarMarca;

	public function ajaxValidarMarca(){

		$columna = "marca";
		$valor = $this->validarMarca;

		$respuesta = ControladorMarcas::ctrMostrarMarcaFiltro($columna, $valor);

		echo json_encode($respuesta);

	}






	/*=============================================
	CREAR MARCA DESDE ALGUN MODULO
	=============================================*/	

	public $marca;

	public function ajaxCrearMarcaMoludo(){

		$valor = $this->marca;

		$respuesta = ControladorMarcas::ctrCrearMarcaModulo($valor);

		echo json_encode($respuesta);

	}





}

/*=============================================
EDITAR AUTO
=============================================*/	
if(isset($_POST["id_marca"])){

	$marca = new AjaxMarcas();
	$marca -> id_marca = $_POST["id_marca"];
	$marca -> ajaxEditarMarca();
}





/*=============================================
VALIDAR NO REPETIR MARCA
=============================================*/

if(isset( $_POST["validarMarca"])){

	$valMarca = new AjaxMarcas();
	$valMarca -> validarMarca = $_POST["validarMarca"];
	$valMarca -> ajaxValidarMarca();

}





/*=============================================
CREAR MARCA DESDE ALGUN MODULO
=============================================*/

if(isset( $_POST["crearMarcaModulo"])){

	$crearMarcaModulo = new AjaxMarcas();
	$crearMarcaModulo -> marca = $_POST["crearMarcaModulo"];
	$crearMarcaModulo -> ajaxCrearMarcaMoludo();

}