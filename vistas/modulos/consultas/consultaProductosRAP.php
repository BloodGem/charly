<?php 
session_start();
//error_reporting(0);
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/resurtido.controlador.php";
require_once "../../../modelos/resurtido.modelo.php";
//require_once "conexion.php";
$id_usuario = $_SESSION['id'];
$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($id_usuario);
				
$id_sucursal = $traerUsuario['id_sucursal'];
$producto_inicial = $_POST["producto_inicial"];
$producto_final = $_POST["producto_final"];
$id_proveedor = $_POST["id_proveedor"];



    $crearVistaProductosAlfabeticos = ControladorResurtidos::ctrCrearVistaProductosInicialFinalProveedor($producto_inicial, $producto_final, $id_proveedor, $id_sucursal);

    //echo $crearVistaProductosAlfabeticos;
    //var_dump($crearVistaProductosAlfabeticos);

    if($crearVistaProductosAlfabeticos == "ok"){

    	echo '
    	<input type="hidden" id="viewServersideRAP" name="listaProductosResurtido" value="resurtido_proveedor_'.$id_sucursal.'_'.$id_usuario.'">
    	<table id="tabla2" class="table table-striped table-bordered table-condensed" style="width:100%">
                <thead class="text-center">
                <tr>
                    <th>Clave</th>
                    <th>Producto</th>
                    <th>Precio compra</th>
                    <th>Existencia</th>
                    <th>Mínimo</th>
                    <th>Máximo</th>
                    <th>A pedir</th>
                </tr>
                </thead>
            </table>';
    }
   

?>




                    
              

