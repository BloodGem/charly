<?php
session_start();
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $id_cliente;
  public $nombre;
  public $validarRfc;
  public $rfc;
  public $email;
  public $telefono1;
  public $codigo_postal;
  public $id_regimen;
  public $no_precio;

  public function ajaxEditarCliente(){

    $columna = "id_cliente";
    $valor = $this->id_cliente;

    $respuesta = ControladorClientes::ctrMostrarClientes($columna, $valor);

    echo json_encode($respuesta);

  }




  /*=============================================
  VALIDAR NO REPETIR NOMBRE FÍSCAL
  =============================================*/ 

  

  public function ajaxValidarNombre(){

    $columna = "nombre";
    $valor = $this->nombre;

    $respuesta = ControladorClientes::ctrMostrarClientes($columna, $valor);

    echo json_encode($respuesta);

  }




  /*=============================================
  VALIDAR NO REPETIR RFC
  =============================================*/ 

  

  public function ajaxValidarRfc(){

    $columna = "rfc";
    $valor = $this->validarRfc;

    $respuesta = ControladorClientes::ctrMostrarClientes($columna, $valor);

    echo json_encode($respuesta);

  }





/*=============================================
  VALIDAR NO REPETIR RFC
  =============================================*/ 

  

  public function ajaxCrearClienteModulo(){

    $nombre = $this->nombre;
    $rfc = $this->rfc;
    $email = $this->email;
    $telefono1 = $this->telefono1;
    $codigo_postal = $this->codigo_postal;
    $id_regimen = $this->id_regimen;
    $no_precio = $this->no_precio;


    $respuesta = ControladorClientes::ctrCrearClienteModulo($nombre, $rfc, $email, $telefono1, $codigo_postal, $id_regimen, $no_precio);

    echo json_encode($respuesta);

  }










  public function ajaxEditarDatosCortosCliente(){

    $id_cliente = $this->id_cliente;
    $nombre = $this->nombre;
    $rfc = $this->rfc;
    $email = $this->email;
    $telefono1 = $this->telefono1;
    $codigo_postal = $this->codigo_postal;
    $id_regimen = $this->id_regimen;
    $no_precio = $this->no_precio;

    $datos = array("id_cliente" => $id_cliente,
      "nombre" => $nombre,
     "rfc" => $rfc,
     "email" => $email,
     "telefono1" => $telefono1,
     "codigo_postal" => $codigo_postal,
     "id_regimen" => $id_regimen,
     "no_precio" => $no_precio,
      "id_usuario_ult_mod" => $_SESSION['id']);


    $respuesta = ControladorClientes::ctrEditarDatosCortosCliente($datos);

    echo $respuesta;

  }


  
}

/*=============================================
EDITAR PRODUCTO
=============================================*/ 
if(isset($_POST["id_cliente"])){

  $cliente = new AjaxClientes();
  $cliente -> id_cliente = $_POST["id_cliente"];
  $cliente -> ajaxEditarCliente();
}




/*=============================================
VALIDAR NO REPETIR NOMBRE
=============================================*/

if(isset( $_POST["validarNombre"])){

  $validar_nombre = new AjaxClientes();
  $validar_nombre -> nombre = $_POST["validarNombre"];
  $validar_nombre -> ajaxValidarNombre();

}




/*=============================================
VALIDAR NO REPETIR RFC
=============================================*/

if(isset( $_POST["validarRfc"])){

  $valRfc = new AjaxClientes();
  $valRfc -> validarRfc = $_POST["validarRfc"];
  $valRfc -> ajaxValidarRfc();

}





/*=============================================
CREAR CLIENTE MODULO
=============================================*/

if(isset( $_POST["crearClienteModulo"])){

  $crearClienteModulo = new AjaxClientes();

  $crearClienteModulo -> nombre = $_POST["nombre"];
  $crearClienteModulo -> rfc = $_POST["rfc"];
  $crearClienteModulo -> email = $_POST["email"];
  $crearClienteModulo -> telefono1 = $_POST["telefono1"];
  $crearClienteModulo -> codigo_postal = $_POST["codigo_postal"];
  $crearClienteModulo -> id_regimen = $_POST["id_regimen"];
  $crearClienteModulo -> no_precio = $_POST["no_precio"];


  $crearClienteModulo -> ajaxCrearClienteModulo();

}










if(isset($_POST["editarDatosCortosCliente"])){

  $editarClienteModulo = new AjaxClientes();

  $editarClienteModulo -> id_cliente = $_POST["editarDatosCortosCliente"];
  $editarClienteModulo -> nombre = $_POST["nombre"];
  $editarClienteModulo -> rfc = $_POST["rfc"];
  $editarClienteModulo -> email = $_POST["email"];
  $editarClienteModulo -> telefono1 = $_POST["telefono1"];
  $editarClienteModulo -> codigo_postal = $_POST["codigo_postal"];
  $editarClienteModulo -> id_regimen = $_POST["id_regimen"];
  $editarClienteModulo -> no_precio = $_POST["no_precio"];


  $editarClienteModulo -> ajaxEditarDatosCortosCliente();

}