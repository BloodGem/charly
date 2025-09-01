<?php
session_start();
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/grupos.controlador.php";
require_once "../modelos/grupos.modelo.php";

class AjaxUsuarios{

	public $id_usuario;

	public function ajaxEditarUsuario(){

		$valor = $this->id_usuario;
		$respuesta = ControladorUsuarios::ctrMostrarUsuario($valor);

		echo  json_encode($respuesta);

	}

	



	/*ACTIVAR O DESACTIVAR USUARIO*/
	public $activarId;
	public $activarUsuario;

	public function ajaxActivarUsuario(){

		$columna1 = "estado";
		$valor1 = $this->activarUsuario;

		$id_usuario= $this->activarId;

		$id_usuario_ult_mod = $_SESSION['id'];

		$respuesta = ModeloUsuarios::mdlActualizarUsuario($columna1, $valor1, $id_usuario, $id_usuario_ult_mod);

	}





	/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/	

	public $validarUsuario;

	public function ajaxValidarUsuario(){

		$columna = "usuario";
		$valor = $this->validarUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($columna, $valor);

		echo json_encode($respuesta);

	}





	/*=============================================
	BUSQUEDA
	=============================================*/	

	public $buscar;

	public function ajaxBuscar(){

		$columna = "nombre";
		$valor = $this->busqueda;

		$respuesta = ControladorUsuarios::ctrBusquedaUsuarios($valor);

		echo json_encode($respuesta);

	}






	/*=============================================
	DAR PEMISO DE ALGO
	=============================================*/	

	public $usuario;
	public $password;
	public $codigo;
	public $permiso;

	public function ajaxDarPermiso(){

		$valor1 = $this->codigo;

		$valor2 = $this->permiso;

		$respuesta = ControladorUsuarios::ctrDarPermiso($valor1, $valor2);

		echo $respuesta;

	}






	public function ajaxVerificarSesion(){

		$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

		$objXmlDocument = simplexml_load_file("../sesiones/".$traerUsuario['usuario'].".xml");
		$objJsonDocument = json_encode($objXmlDocument);
          $arrOutput = json_decode($objJsonDocument, TRUE);
          foreach ($arrOutput as $key => $value) {
            $fecha_sesion = $value['fecha_sesion'];
            }

            if($fecha_sesion == $_SESSION['fecha_sesion']){
              echo 1;
            }else{
              echo 0;
            }

	}



}

if (isset($_POST["id_usuario"])) {
	$editar = new AjaxUsuarios();
$editar -> id_usuario = $_POST['id_usuario'];
$editar -> ajaxEditarUsuario();
}


/*=============================================
ACTIVAR USUARIO
=============================================*/	

if(isset($_POST["activarUsuario"])){

	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();

}




/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if(isset( $_POST["validarUsuario"])){

	$valUsuario = new AjaxUsuarios();
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];
	$valUsuario -> ajaxValidarUsuario();

}



/*=============================================
TREAR USUARIO
=============================================*/

if(isset( $_POST["mostrar_usuario"])){

	

		$mostrarUsuario = new AjaxUsuarios();
		$mostrarUsuario -> id_usuario = $_POST["id_usuario"];
		$mostrarUsuario -> ajaxMostrarUsuario();
	
}





if(isset( $_POST["darPermisoCodigo"]) && isset( $_POST["darPermisoPermiso"])){

		$dar_permiso = new AjaxUsuarios();
		$dar_permiso -> codigo = $_POST["darPermisoCodigo"];
		$dar_permiso -> permiso = $_POST["darPermisoPermiso"];
		$dar_permiso -> ajaxDarPermiso();
	
}





if(isset($_POST["verificarSesion"])){

	$checar_Sesion = new AjaxUsuarios();
	$checar_Sesion -> verificar_sesion = $_POST["verificarSesion"];
	$checar_Sesion -> ajaxVerificarSesion();
	
}