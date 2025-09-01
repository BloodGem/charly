<?php
session_start();
require_once "../controladores/inventarios.controlador.php";
require_once "../modelos/inventarios.modelo.php";

class InventariosAjax{

    public $id_inventario;
    
    public function ajaxVerificarInventario(){

        $valor = $this->id_inventario;
        
        $respuesta = ControladorInventarios::ctrVerificarInventario($valor);
        
        echo $respuesta;


        
    }


    

    
}


/*=============================================
REAPERTURA CORTE CAJA
=============================================*/ 
if(isset($_POST["verificar_inventario"])){

    $verificarInventario = new InventariosAjax();
    $verificarInventario -> id_inventario = $_POST["verificar_inventario"];
    $verificarInventario -> ajaxVerificarInventario();
}
