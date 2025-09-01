<?php
error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";

require_once "../../../controladores/reportes-compras.controlador.php";
require_once "../../../modelos/reportes-generales.modelo.php";


$no_rango = $_POST['no_rango'];
$tipo = $_POST['tipo'];
$id_sucursal = $_POST['id_sucursal'];

if($no_rango == "" || $tipo == "" || $id_sucursal == ""){
    return;
}




switch ($no_rango) {

    case 1:

    $dia = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59';

    break;

    case 2:

    $dia = date("Y-m-d", strtotime("yesterday"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59';

    break;

    case 3:

    if(date("D")=="Mon"){
        $lunes = date("Y-m-d");
    }else{
        $lunes = date("Y-m-d", strtotime('last Monday', time()));
    }


    $dia1 = $lunes;
    $dia2 = date('Y-m-d', strtotime('this Sunday', time()));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';


    break;

    case 4:

    if(date("D")=="Mon"){
        $lunes = date("Y-m-d", strtotime('last Monday', time()));
    }else{
        $lunes = date("Y-m-d", strtotime('last Monday - 7 days', time()));
    }


    $dia1 = $lunes;
    $dia2 = date('Y-m-d', strtotime('last Sunday', time()));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';


    break;

    case 5:
    $dia1 = date("Y-m-d", strtotime("today - 6 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';

    
    break;

    case 6:
    $dia1 = date("Y-m-d", strtotime("today - 29 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';

    break;

    case 7:

    $dia1 = date("Y-m-d", strtotime("first day of this month"));
    $dia2 = date("Y-m-d", strtotime("last day of this month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';


    

    break;

    case 8:

    $dia1 = date("Y-m-d", strtotime("first day of last month"));
    $dia2 = date("Y-m-d", strtotime("last day of last month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';

    break;

    case 9:

    if(isset($_POST['rango_fecha'])){
    $rango_fecha = $_POST['rango_fecha'];
    $mes1 = substr( $rango_fecha, 0, 2 );
    $dia1 = substr( $rango_fecha, 3, 2 );
    $ano1 = substr( $rango_fecha, 6, 4 );
    $fecha1 = $ano1 ."-". $mes1 ."-". $dia1;

    $mes2 = substr( $rango_fecha, 13, 2 );
    $dia2 = substr( $rango_fecha, 16, 2 );
    $ano2 = substr( $rango_fecha, 19, 4 );
    $fecha2 = $ano2 ."-". $mes2 ."-". $dia2;

}

    $fecha1 = $fecha1 . ' 00:00:00';
    $fecha2 = $fecha2 . ' 23:59:59';

    break;
    
}

$traerCompras = ControladorReportesCompras::ctrReporteComprasTipo($fecha1, $fecha2, $tipo, $id_sucursal);

/*if($id_sucursal !== "0"){
            $sql_id_sucursal = " AND compras.id_sucursal = ".$id_sucursal;
        }else{
            $sql_id_sucursal = "";
        }

$sql = "SELECT * FROM  compras WHERE compras.fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND compras.estatus = 1 AND compras.tipo_compra = $tipo".$sql_id_sucursal." ORDER BY compras.id DESC";
echo $sql;*/
/*echo $traerPartidasCompra;
var_dump($traerPartidasCompra);*/

echo '<table id="tablaReporteComprasTipo" class="table table-bordered table-hover">
<thead>
<tr>
<th style="text-align: center;">Compra</th>
<th style="text-align: center;">Fecha</th>
<th style="text-align: center;">Factura</th>
<th style="text-align: center;">Proveedor</th>
<th style="text-align: right;">Total</th>
</tr>
</thead>
<tbody>';

$total_compras_acumulado = 0;

foreach ($traerCompras as $key => $row) {

    $traerProveedor = ControladorProveedores::ctrMostrarProveedor($row['id_proveedor']);

    $total_compras_acumulado = $total_compras_acumulado + $row['total'];



                        //$traerSucursal = ControladorSucursales::ctrMostrarSucursal($row['id_sucursal']);

    echo '<tr>
    <td style="text-align: center;">'.$row["id"].'</td>
    <td style="text-align: center;">'.$row["fecha_creacion"].'</td>
    <td style="text-align: center;">'.$row["no_factura"].'</td>
    <td style="text-align: center;">'.$traerProveedor['nombre'].'</td>
    <td style="text-align: right;">$'.number_format($row["total"], 2).'</td>
    </tr>';
}


echo '</tbody>
<tfoot>
<tr>
<th style="text-align: center;">Compra</th>
<th style="text-align: center;">Fecha</th>
<th style="text-align: center;">Factura</th>
<th style="text-align: center;">Proveedor</th>
<th style="text-align: right;">Total</th>
</tr>
</tfoot>
</table><br><br>
                <center><h3>Total Compras: $'.number_format($total_compras_acumulado, 2).'</h3></center>';



















    


?>