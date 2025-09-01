<?php 
error_reporting(0);
session_start();
require_once "../../../modelos/conexion2.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";


$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
$id_sucursal = $traerUsuario['id_sucursal'];



$busqueda = $_POST["buscarComprasDevoluciones"];


if ($busqueda != "") {


        

    $porciones = explode(" ", $busqueda);
    $contador = count($porciones); 

    for ($i=0; $i < $contador; $i++) { 
        $generaFiltro = $generaFiltro."compras.id LIKE '%".$porciones[$i]."%'";

        if ($i < $contador-1) {
           $generaFiltro = $generaFiltro." AND ";
       }

   }


   $generaFiltro = $generaFiltro." OR ";

for ($i=0; $i < $contador; $i++) { 
    $generaFiltro = $generaFiltro."DATE_FORMAT(compras.fecha_creacion,'%d-%m-%Y') LIKE '%".$porciones[$i]."%'";

    if ($i < $contador-1) {
       $generaFiltro = $generaFiltro." AND ";
   }

}





$generaFiltro = $generaFiltro." OR ";

for ($i=0; $i < $contador; $i++) { 
    $generaFiltro = $generaFiltro."proveedores.nombre LIKE '%".$porciones[$i]."%'";

    if ($i < $contador-1) {
       $generaFiltro = $generaFiltro." AND ";
   }

}


$consultaCompras= "SELECT compras.id, proveedores.nombre, compras.total, DATE_FORMAT(compras.fecha_creacion,'%d-%m-%Y') as fecha FROM compras INNER JOIN proveedores ON compras.id_proveedor = proveedores.id_proveedor WHERE (".$generaFiltro.") AND compras.id_sucursal = $id_sucursal ORDER BY compras.id DESC LIMIT 50";


}else{

    //$consultaCompras = "SELECT compras.id, proveedores.nombre, compras.total, compras.saldo_actual, compras.tipo_venta, DATE_FORMAT(fecha,'%d-%m-%Y') as fecha FROM compras INNER JOIN proveedores ON compras.id_proveedor = proveedores.id_proveedor ORDER BY id DESC LIMIT 50";
}

//echo $consultaCompras;

$rsBuscadorCompras = $conexion->query($consultaCompras); 

$contador = 0; 

while($resultadoCompras = $rsBuscadorCompras->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
    

    <td>
    '.$resultadoCompras["id"].'
    </td>
    <td>
    '.$resultadoCompras["nombre"].'
    </td>
    <td style="text-align: right;">
    $'.number_format($resultadoCompras["total"], 2).'
    </td>
    <td>
    '.$resultadoCompras["fecha"].'
    </td>
    <td class="botones">
        <div class="btn-group">
            <button class="btn btn-info btnSeleccionaCompraDevolucion guardaFoco'.$contador.'" contador = "'.$contador.'" id_compra="'.$resultadoCompras["id"].'">Seleccionar</button>
        </div>
    </td>';
    

    


} 







