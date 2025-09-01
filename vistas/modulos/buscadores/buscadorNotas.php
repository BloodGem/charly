<?php 
error_reporting(0);
session_start();
require_once "../../../modelos/conexion2.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";


$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
$id_sucursal = $traerUsuario['id_sucursal'];




$busquedaNotas = $_POST["buscarNotas"];


if ($busquedaNotas != "") {


        

    $porcionesNotas = explode(" ", $busquedaNotas);
    $contadorNotas = count($porcionesNotas); 

    for ($iNotas=0; $iNotas < $contadorNotas; $iNotas++) { 
        $generaFiltroNotas = $generaFiltroNotas."ventas.id LIKE '%".$porcionesNotas[$iNotas]."%'";

        if ($iNotas < $contadorNotas-1) {
           $generaFiltroNotas = $generaFiltroNotas." AND ";
       }

   }


   $generaFiltroNotas = $generaFiltroNotas." OR ";

for ($iNotas=0; $iNotas < $contadorNotas; $iNotas++) { 
    $generaFiltroNotas = $generaFiltroNotas."DATE_FORMAT(ventas.fecha_creacion,'%d-%m-%Y') LIKE '%".$porcionesNotas[$iNotas]."%'";

    if ($iNotas < $contadorNotas-1) {
       $generaFiltroNotas = $generaFiltroNotas." AND ";
   }

}


$generaFiltroNotas = $generaFiltroNotas." OR ";

for ($iNotas=0; $iNotas < $contadorNotas; $iNotas++) { 
    $generaFiltroNotas = $generaFiltroNotas."ventas.folio LIKE '%".$porcionesNotas[$iNotas]."%'";

    if ($iNotas < $contadorNotas-1) {
       $generaFiltroNotas = $generaFiltroNotas." AND ";
   }
}



$generaFiltroNotas = $generaFiltroNotas." OR ";

for ($iNotas=0; $iNotas < $contadorNotas; $iNotas++) { 
    $generaFiltroNotas = $generaFiltroNotas."clientes.nombre LIKE '%".$porcionesNotas[$iNotas]."%'";

    if ($iNotas < $contadorNotas-1) {
       $generaFiltroNotas = $generaFiltroNotas." AND ";
   }

}


$consultaNotas= "SELECT ventas.id, clientes.nombre, ventas.total, ventas.saldo_actual, ventas.tipo_venta, DATE_FORMAT(ventas.fecha_creacion,'%d-%m-%Y') as fecha FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE (".$generaFiltroNotas.") AND ventas.tipo_venta = 'NT' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.id_sucursal = $id_sucursal ORDER BY id DESC LIMIT 50";


}else{

    $consultaNotas = "SELECT ventas.id, clientes.nombre, ventas.total, ventas.saldo_actual, ventas.tipo_venta, DATE_FORMAT(ventas.fecha_creacion,'%d-%m-%Y') as fecha FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE ventas.tipo_venta = 'NT' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.id_sucursal = $id_sucursal ORDER BY id DESC LIMIT 50";
}



$rsBuscadorNotas = $conexion->query($consultaNotas);

echo '<table class="table table-bordered table-striped">
            <thead>
              <tr>
              <th></th>
                <th>No.</th>
                <th>Cliente</th>
                <th style="text-align: right;">Total</th>
                <th>Tipo venta</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>';

$contador = 0;        

while($resultadoNotas = $rsBuscadorNotas->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;


echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
    

    <td>
    '.$resultadoNotas["id"].'
    </td>
    <td>
    '.$resultadoNotas["nombre"].'
    </td>
    <td style="text-align: right;">
    $'.number_format($resultadoNotas["total"], 2).'
    </td>
    <td>
    '.$resultadoNotas["tipo_venta"].'
    </td>  
    <td>
    '.$resultadoNotas["fecha"].'
    </td>
    <td class="botones">
        <div class="btn-group">
            <button type="button" class="btn btn-warning btnConvertirNotaFactura" id_venta_nota="'.$resultadoNotas["id"].'" accesskey="0" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalConvertirNotaFactura">Convertir</button>

            <button type="button" class="btn btn-success btnVerPartidasVenta" id_venta="'.$resultadoNotas["id"].'">Ver venta
            </button>
        </div>
    </td></tr>';

    

/*<button class="btn btn-info btnImprimirNota" id_venta="'.$resultadoNotas["id"].'">

                        <i class="fa fa-print"></i>

                      </button>*/
} 



echo '</tbody>
        <tfoot>
          <tr>
          <th></th>
            <th>No.</th>
            <th>Cliente</th>
            <th style="text-align: right;">Total</th>
            <th>Tipo venta</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </tfoot>
</table>';


?>
