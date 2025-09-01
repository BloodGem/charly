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
$id_marca = $_POST["id_marca"];



    $crearVistaProductos = ControladorResurtidos::ctrCrearVistaProductos($id_marca);

    //var_dump($crearVistaProductosProveedor);

    if($crearVistaProductos == "ok"){

    	echo '
    	<input type="hidden" id="serversideProductos2" value="serverside_productos_'.$id_sucursal.'_'.$id_usuario.'">
    	<table id="tablaProductos2" class="table table-striped table-bordered table-condensed" style="width:100%">
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




                    
              

