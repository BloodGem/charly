<?php

session_start();

require_once "../controladores/partidas-inventarios.controlador.php";
require_once "../modelos/partidas-inventarios.modelo.php";
require_once "../controladores/anaqueles-inventarios.controlador.php";
require_once "../modelos/anaqueles-inventarios.modelo.php";

class PartidasInventariosAjax{

    public $id_partida_inventario;
    public $cantidad1;
    public $cantidad2;
    public $cantidad3;
    public $cantidad4;
    public $cantidad5;

    
    public function ajaxIngresarCantidadEncontrada(){

        $valor = $this->id_partida_inventario;

        $valor2 = $this->cantidad1;

        $valor3 = $this->cantidad2;

        $valor4 = $this->cantidad3;

        $valor5 = $this->cantidad4;

        $valor6 = $this->cantidad5;
        
        $respuesta = ControladorPartidasInventarios::ctrIngresarCantidadEncontrada($valor, $valor2, $valor3, $valor4, $valor5, $valor6);
        
        echo $respuesta;


        
    }










    public function ajaxMostrarPartidaInventario(){

        $valor = $this->id_partida_inventario;
        
        $respuesta = ControladorPartidasInventarios::ctrMostrarPartidaInventario($valor);
        
        echo json_encode($respuesta);


        
    }


    

    
}


/*=============================================
INGRESAR LA CANTIDAD ENCONTRADA
=============================================*/ 
if(isset($_POST["ingresarCantidadEncontrada"])){

    $ingresarCantidadEncontrada = new PartidasInventariosAjax();
    $ingresarCantidadEncontrada -> id_partida_inventario = $_POST["ingresarCantidadEncontrada"];
    $ingresarCantidadEncontrada -> cantidad1 = $_POST["cantidad1"];
    $ingresarCantidadEncontrada -> cantidad2 = $_POST["cantidad2"];
    $ingresarCantidadEncontrada -> cantidad3 = $_POST["cantidad3"];
    $ingresarCantidadEncontrada -> cantidad4 = $_POST["cantidad4"];
    $ingresarCantidadEncontrada -> cantidad5 = $_POST["cantidad5"];
    $ingresarCantidadEncontrada -> ajaxIngresarCantidadEncontrada();
}





/*=============================================
MOSTRAR PARTINV
=============================================*/ 
if(isset($_POST["traerPartidaInventario"])){

    $traer_partida_inventario = new PartidasInventariosAjax();
    $traer_partida_inventario -> id_partida_inventario = $_POST["traerPartidaInventario"];
    $traer_partida_inventario -> ajaxMostrarPartidaInventario();
}