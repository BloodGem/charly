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


$busqueda = $_POST["buscarDevolucionesCompras"];


if ($busqueda != "") {




    $porciones = explode(" ", $busqueda);
    $contador = count($porciones); 

    for ($i=0; $i < $contador; $i++) { 
        $generaFiltro = $generaFiltro."devoluciones_compras.id_devolucion_compra LIKE '%".$porciones[$i]."%'";

        if ($i < $contador-1) {
         $generaFiltro = $generaFiltro." AND ";
     }

 }


 $generaFiltro = $generaFiltro." OR ";

 for ($i=0; $i < $contador; $i++) { 
    $generaFiltro = $generaFiltro."DATE_FORMAT(devoluciones_compras.fecha_creacion,'%d-%m-%Y') LIKE '%".$porciones[$i]."%'";

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


$consultaDevolucionesCompras= "SELECT devoluciones_compras.id_devolucion_compra, devoluciones_compras.total, proveedores.nombre, devoluciones_compras.fecha_creacion, devoluciones_compras.id_motivo_devolucion_compra, devoluciones_compras.id_compra FROM devoluciones_compras INNER JOIN compras ON devoluciones_compras.id_compra = compras.id INNER JOIN proveedores ON devoluciones_compras.id_proveedor = proveedores.id_proveedor WHERE (".$generaFiltro.") AND devoluciones_compras.id_sucursal = $id_sucursal ORDER BY id_devolucion_compra DESC LIMIT 50";


}else{

    $consultaDevolucionesCompras = "SELECT devoluciones_compras.id_devolucion_compra, devoluciones_compras.total, proveedores.nombre, devoluciones_compras.fecha_creacion, devoluciones_compras.id_motivo_devolucion_compra, devoluciones_compras.id_compra FROM devoluciones_compras INNER JOIN compras ON devoluciones_compras.id_compra = compras.id INNER JOIN proveedores ON devoluciones_compras.id_proveedor = proveedores.id_proveedor WHERE devoluciones_compras.id_sucursal = $id_sucursal ORDER BY id_devolucion_compra DESC LIMIT 50;";
}

//echo $consultaDevolucionesCompras;


$rsBuscadorDevolucionesCompras = $conexion->query($consultaDevolucionesCompras);

echo'<table class="table table-bordered table-striped">
<thead>
<tr>
<th></th>
<th>No.</th>
<th>Proveedor</th>
<th>Total</th>
<th>Fecha</th>
<th>IdCompra</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>';


$contador = 0;  

while($resultadoDevolucionesCompras = $rsBuscadorDevolucionesCompras->fetch_array(MYSQLI_BOTH)){ 



    $contador = $contador + 1;


    echo '<tr class="contador'.$contador.'">
    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
    

    <td>
    '.$resultadoDevolucionesCompras["id_devolucion_compra"].'
    </td>
    <td>
    '.$resultadoDevolucionesCompras["nombre"].'
    </td>
    <td>
    '.number_format($resultadoDevolucionesCompras["total"], 2).'
    </td>
    <td>
    '.$resultadoDevolucionesCompras["fecha_creacion"].'
    </td>
    <td>
    '.$resultadoDevolucionesCompras["id_compra"].'
    </td>
    <td class="botones">
    <div class="btn-group">';
    echo '<button class="btn btn-info btnVerPartidasDevolucionCompra" id_devolucion_compra="'.$resultadoDevolucionesCompras["id_devolucion_compra"].'">Ver</button>';

    /*$indiceReimprimirTicketDevolucionesCompras = array_search("Reimprimir ticket devoluciones",$array,true);

    if($indiceReimprimirTicketDevolucionesCompras !== false){*/

        echo '<button class="btn btn-warning btnExportarPDFDevolucionCompra" id_devolucion_compra="'.$resultadoDevolucionesCompras["id_devolucion_compra"].'">PDF</button>';

    //}




    echo'</div>
    </td>';

    


} 



echo'</tbody>
<tfoot>
<tr>
<th></th>
<th>No.</th>
<th>Proveedor</th>
<th>Total</th>
<th>Fecha</th>
<th>IdCompra</th>
<th>Acciones</th>
</tr>
</tfoot>
</table>';


?>
