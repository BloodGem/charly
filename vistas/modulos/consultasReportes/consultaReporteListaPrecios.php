<?php 
session_start();
error_reporting(0);
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/reportes-productos.controlador.php";
require_once "../../../modelos/reportes-generales.modelo.php";
//require_once "conexion.php";
$id_usuario = $_SESSION['id'];
$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($id_usuario);
                
$id_sucursal = $traerUsuario['id_sucursal'];
$producto_inicial = $_POST["producto_inicial"];
$producto_final = $_POST["producto_final"];

$id_marca = $_POST["id_marca"];



    $crearVistaReporteListaPrecios = ControladorReportesProductos::ctrCrearVistaReporteListaPrecios($producto_inicial, $producto_final, $id_marca, $id_sucursal);

    //var_dump($crearVistaProductosAlfabeticos);
    //echo $crearVistaProductosAlfabeticos;

    if($crearVistaReporteListaPrecios == "ok"){

        echo '
        <input type="hidden" id="viewServersideReporteListaPrecios" value="reporte_lista_precios_'.$id_sucursal.'_'.$id_usuario.'">
        <table id="tablaReporteListaPrecios" class="table table-striped table-bordered table-condensed" style="width:100%">
                <thead class="text-center">
                <tr>
                    <th>Clave</th>
                    <th>Producto</th>
                    <th>Existencia</th>
                    <th>Ubicación</th>
                    <th>Precio</th>
                </tr>
                </thead>
            </table>';
    }
   

?>




                    
              

