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


$busquedaDevoluciones = $_POST["buscarDevoluciones"];


if ($busquedaDevoluciones != "") {




    /*$porcionesDevoluciones = explode(" ", $busquedaDevoluciones);
    $contadorDevoluciones = count($porcionesDevoluciones); 

    for ($iDevoluciones=0; $iDevoluciones < $contadorDevoluciones; $iDevoluciones++) { 
        $generaFiltroDevoluciones = $generaFiltroDevoluciones."devoluciones.id_devolucion LIKE '%".$porcionesDevoluciones[$iDevoluciones]."%'";

        if ($iDevoluciones < $contadorDevoluciones-1) {
         $generaFiltroDevoluciones = $generaFiltroDevoluciones." AND ";
     }

 }


 $generaFiltroDevoluciones = $generaFiltroDevoluciones." OR ";

 for ($iDevoluciones=0; $iDevoluciones < $contadorDevoluciones; $iDevoluciones++) { 
    $generaFiltroDevoluciones = $generaFiltroDevoluciones."DATE_FORMAT(devoluciones.fecha_creacion,'%d-%m-%Y') LIKE '%".$porcionesDevoluciones[$iDevoluciones]."%'";

    if ($iDevoluciones < $contadorDevoluciones-1) {
     $generaFiltroDevoluciones = $generaFiltroDevoluciones." AND ";
 }

}





$generaFiltroDevoluciones = $generaFiltroDevoluciones." OR ";

for ($iDevoluciones=0; $iDevoluciones < $contadorDevoluciones; $iDevoluciones++) { 
    $generaFiltroDevoluciones = $generaFiltroDevoluciones."clientes.nombre LIKE '%".$porcionesDevoluciones[$iDevoluciones]."%'";

    if ($iDevoluciones < $contadorDevoluciones-1) {
     $generaFiltroDevoluciones = $generaFiltroDevoluciones." AND ";
 }

}





$generaFiltroDevoluciones = $generaFiltroDevoluciones." OR ";

for ($iDevoluciones=0; $iDevoluciones < $contadorDevoluciones; $iDevoluciones++) { 
    $generaFiltroDevoluciones = $generaFiltroDevoluciones."ventas.folio LIKE '%".$porcionesDevoluciones[$iDevoluciones]."%'";

    if ($iDevoluciones < $contadorDevoluciones-1) {
     $generaFiltroDevoluciones = $generaFiltroDevoluciones." AND ";
 }

}





$generaFiltroDevoluciones = $generaFiltroDevoluciones." OR ";

for ($iDevoluciones=0; $iDevoluciones < $contadorDevoluciones; $iDevoluciones++) { 
    $generaFiltroDevoluciones = $generaFiltroDevoluciones."ventas.id LIKE '%".$porcionesDevoluciones[$iDevoluciones]."%'";

    if ($iDevoluciones < $contadorDevoluciones-1) {
     $generaFiltroDevoluciones = $generaFiltroDevoluciones." AND ";
 }

}*/


$consultaDevoluciones= "SELECT devoluciones.id_devolucion, devoluciones.total, devoluciones.tipo_devolucion, clientes.nombre, DATE_FORMAT(devoluciones.fecha_creacion,'%d-%m-%Y') as fecha, devoluciones.facturado, devoluciones.uuid, devoluciones.id_venta, ventas.folio, ventas.tipo_venta FROM devoluciones INNER JOIN ventas ON devoluciones.id_venta = ventas.id INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE devoluciones.id_devolucion = $busquedaDevoluciones AND devoluciones.id_sucursal = $id_sucursal";


}else{

    $consultaDevoluciones = "SELECT devoluciones.id_devolucion, devoluciones.total, devoluciones.tipo_devolucion, clientes.nombre, DATE_FORMAT(devoluciones.fecha_creacion,'%d-%m-%Y') as fecha, devoluciones.facturado, devoluciones.uuid, devoluciones.id_venta, ventas.folio, ventas.tipo_venta FROM devoluciones INNER JOIN ventas ON devoluciones.id_venta = ventas.id INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE devoluciones.id_sucursal = $id_sucursal ORDER BY id_devolucion DESC LIMIT 75;";
}



$rsBuscadorDevoluciones = $conexion->query($consultaDevoluciones);

echo'<table class="table-sm table-bordered table-striped" id="tablaDevoluciones">
<thead>
<tr>
<th></th>
<th>No.</th>
<th>Cliente</th>
<th>Total</th>
<th>Fecha</th>
<th>Tipo D.</th>
<th>UUID</th>
<th>IdVenta</th>
<th>Folio</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>';


$contador = 0;  

while($resultadoDevoluciones = $rsBuscadorDevoluciones->fetch_array(MYSQLI_BOTH)){ 



    $contador = $contador + 1;


    echo '<tr class="contador'.$contador.'">
    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
    

    <td>
    '.$resultadoDevoluciones["id_devolucion"].'
    </td>
    <td>
    '.$resultadoDevoluciones["nombre"].'
    </td>
    <td>
    '.number_format($resultadoDevoluciones["total"], 2).'
    </td>
    <td>
    '.$resultadoDevoluciones["fecha"].'
    </td><td>';
    if($resultadoDevoluciones["tipo_devolucion"]== 1){
        echo 'Efectivo';
    }else if($resultadoDevoluciones["tipo_devolucion"]== 2){
        echo 'Físico';
    }
    echo'</td><td>
    '.$resultadoDevoluciones["uuid"].'
    </td>
    <td>
    '.$resultadoDevoluciones["id_venta"].'
    </td>
    <td>
    '.$resultadoDevoluciones["folio"].'
    </td>
    <td class="botones">
    <div class="btn-group">';
    echo '<button class="btn-sm btn-info btnVerPartidasDevolucion" id_devolucion="'.$resultadoDevoluciones["id_devolucion"].'" data-toggle="modal" data-target="#modalVerPartidasDevolucion">Ver</button>';

    $indiceReimprimirTicketDevoluciones = array_search("Reimprimir ticket devoluciones",$array,true);

    if($indiceReimprimirTicketDevoluciones !== false){

        echo '<button class="btn-sm btn-warning btnReimprimirTicket" id_devolucion="'.$resultadoDevoluciones["id_devolucion"].'">Reimprimir</button>';

    }


    $indiceTimbrarDevoluciones = array_search("Timbrar devoluciones",$array,true);

    if($indiceTimbrarDevoluciones !== false){

        if($resultadoDevoluciones['tipo_venta'] == "FC"){

            if($resultadoDevoluciones['uuid'] == "" && $resultadoDevoluciones['facturado'] == 1){

                echo '<button class="btn-sm btn-dark btnTimbrarDevolucion" id_devolucion="'.$resultadoDevoluciones["id_devolucion"].'">Timbrar</button>';
            }
        }

    }


    echo'</div>
    </td>';

    


} 



echo'</tbody>
<tfoot>
<tr>
<th></th>
<th>No.</th>
<th>Cliente</th>
<th>Total</th>
<th>Fecha</th>
<th>Tipo D.</th>
<th>UUID</th>
<th>IdVenta</th>
<th>Folio</th>
<th>Acciones</th>
</tr>
</tfoot>
</table>';


?>
