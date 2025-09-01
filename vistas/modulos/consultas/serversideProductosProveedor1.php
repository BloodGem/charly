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
$id_proveedor = $_POST["id_proveedor"];



    $crearVistaProductosProveedor = ControladorResurtidos::ctrCrearVistaProductosProveedor($id_proveedor);

    //var_dump($crearVistaProductosProveedor);

    if($crearVistaProductosProveedor == "ok"){

    	echo '
    	<input type="hidden" id="serversideProductosProveedor1" value="serverside_productos_proveedor_'.$id_sucursal.'_'.$id_usuario.'">
    	<table id="tablaProductosProveedor1" class="table table-striped table-bordered table-condensed" style="width:100%">
                <thead class="text-center">
                <tr>
                    <th>Clave</th>
                    <th>Producto</th>
                    <th>Acción</th>
                </tr>
                </thead>
            </table>';
    }
   

?>




                    
              

