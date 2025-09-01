<?php
//error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();


require_once "../../../controladores/reportes-ventas.controlador.php";
require_once "../../../modelos/reportes-generales.modelo.php";


$no_rango = $_POST['no_rango'];
$id_sucursal = $_POST['id_sucursal'];
$id_vendedor = $_POST['id_vendedor'];
$id_producto = $_POST['id_producto'];

if($no_rango == "" || $id_vendedor == "" || $id_producto == "" || $id_sucursal == ""){
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



$traerVentasProductoVendedor = ControladorReportesVentas::ctrReporteVentasProductoVendedor($fecha1, $fecha2, $id_producto, $id_vendedor, $id_sucursal);

//echo $traerVentasProductoVendedor;

echo '<table id="tablaReporteVentasProductoVendedor" class="table table-bordered table-hover">
<thead>
<tr>
<th style="text-align: center;">IdVenta</th>
<th style="text-align: center;">Folio</th>
<th style="text-align: center;">Fecha</th>
<th style="text-align: center;">Clave</th>
<th style="text-align: center;">Producto</th>
<th style="text-align: right;">Cantidad</th>
<th style="text-align: right;">Precio</th>
<th style="text-align: right;">Total</th>
</tr>
</thead>
<tbody>';

$total_ventas_acumulado = 0;
//$total_utilidad_acumulado = 0;

foreach ($traerVentasProductoVendedor as $key => $row) {

    $id_venta = $row['id'];

    $total_ventas_acumulado = $total_ventas_acumulado + $row['total'];


    echo '<tr>
    <td style="text-align: center;">'.$id_venta.'</td>
    <td style="text-align: center;">'.$row["folio"].'</td>
    <td style="text-align: center;">'.$row["fecha_creacion"].'</td>
    <td style="text-align: center;">'.$row["clave_producto"].'</td>
    <td style="text-align: center;">'.$row["descripcion_corta"].'</td>
    <td style="text-align: right;">'.number_format($row["cantidad"], 2).'</td>
    <td style="text-align: right;">$'.number_format($row['precio_neto'], 2).'</td>
    <td style="text-align: right;">$'.number_format($row['total'], 2).'</td>
    </tr>';
}


echo '</tbody>
<tfoot>
<tr>
<th style="text-align: center;">IdVenta</th>
<th style="text-align: center;">Folio</th>
<th style="text-align: center;">Fecha</th>
<th style="text-align: center;">Clave</th>
<th style="text-align: center;">Producto</th>
<th style="text-align: right;">Cantidad</th>
<th style="text-align: right;">Precio</th>
<th style="text-align: right;">Total</th>
</tr>
</tfoot>
</table><br><br>
                <center><h3>Ventas total: $'.number_format($total_ventas_acumulado, 2).'</h3></center>';



















    


?>