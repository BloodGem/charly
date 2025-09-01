<?php

require_once "../controladores/grupos.controlador.php";
require_once "../modelos/grupos.modelo.php";

class AjaxGrupos{

	/*=============================================
	EDITAR GRUPO
	=============================================*/	

	public $id_grupo;

	public function ajaxEditarGrupo(){

		$id_grupo = $this->id_grupo;

		$respuesta = ControladorGrupos::ctrMostrarGrupo($id_grupo);

		echo json_encode($respuesta);

	}



	/*=============================================
	VALIDAR NO REPETIR GRUPO
	=============================================*/	

	public $validarGrupo;

	public function ajaxValidarGrupo(){

		$columna = "nombre_grupo";
		$valor = $this->validarGrupo;

		$respuesta = ControladorGrupos::ctrMostrarGrupo2($columna, $valor);

		echo json_encode($respuesta);

	}





}

/*=============================================
EDITAR GRUPO
=============================================*/	
if(isset($_POST["id_grupo"])){

	$grupo = new AjaxGrupos();
	$grupo -> id_grupo = $_POST["id_grupo"];
	$grupo -> ajaxEditarGrupo();
}





/*=============================================
VALIDAR NO REPETIR GRUPO
=============================================*/

if(isset( $_POST["validarGrupo"])){

	$valGrupo = new AjaxGrupos();
	$valGrupo -> validarGrupo = $_POST["validarGrupo"];
	$valGrupo -> ajaxValidarGrupo();

}