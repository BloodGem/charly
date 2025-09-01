<?php
session_start();
require_once "../controladores/anaqueles-inventarios.controlador.php";
require_once "../modelos/anaqueles-inventarios.modelo.php";
require_once "../controladores/partidas-inventarios.controlador.php";
require_once "../modelos/partidas-inventarios.modelo.php";

class AnaquelesInventariosAjax{

    public $id_anaquel_inventario;
    public $anaquel;
    
    public function ajaxAsignarAnaquelInventario(){

        $valor = $this->id_anaquel_inventario;

        $respuesta = ControladorAnaquelesInventarios::ctrAsignarAnaquelInventario($valor);
        
        echo $respuesta;


        
    }





    public function ajaxCerrarAnaquelInventario(){

        $valor = $this->id_anaquel_inventario;
        
        $respuesta = ControladorAnaquelesInventarios::ctrCerrarAnaquelInventario($valor);
        
        echo $respuesta;


        
    }


    

    
}


/*=============================================
ASIGNAR ANAQUEL
=============================================*/ 
if(isset($_POST["asignarAnaquelInventario"])){

    $asignaraAnaquel = new AnaquelesInventariosAjax();
    $asignaraAnaquel -> id_anaquel_inventario = $_POST["asignarAnaquelInventario"];
    $asignaraAnaquel -> ajaxAsignarAnaquelInventario();
}





/*=============================================
CERRAR ANAQUEL
=============================================*/ 
if(isset($_POST["cerrarAnaquelInventario"])){

    $cerrarAnaquelInventario = new AnaquelesInventariosAjax();
    $cerrarAnaquelInventario -> id_anaquel_inventario = $_POST["cerrarAnaquelInventario"];
    $cerrarAnaquelInventario -> ajaxCerrarAnaquelInventario();
}

