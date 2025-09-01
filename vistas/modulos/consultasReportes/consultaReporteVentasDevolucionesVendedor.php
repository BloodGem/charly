<?php
//error_reporting(0);
//date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion.php";


require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/reportes-ventas.controlador.php";
require_once "../../../controladores/reportes-devoluciones.controlador.php";
require_once "../../../modelos/reportes-generales.modelo.php";




$no_rango = $_POST['no_rango'];
$id_sucursal = $_POST['id_sucursal'];

if($no_rango == "" || $id_sucursal == ""){
    return;
}


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



switch ($no_rango) {

    case 1:

    $dia = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59' ;

    //$fecha1 = date("Y/m/d", strtotime("today"));
    //$fecha2 = date("Y/m/d", strtotime("today"));


    break;

    case 2:

    $dia = date("Y-m-d", strtotime("yesterday"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59' ;





    
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
    $fecha2 = $dia2 . ' 23:59:59' ;


    

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
    $fecha2 = $dia2 . ' 23:59:59' ;

    

    break;

    case 5:
    $dia1 = date("Y-m-d", strtotime("today - 6 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    
    break;

    case 6:
    $dia1 = date("Y-m-d", strtotime("today - 29 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    

    break;

    case 7:

    $dia1 = date("Y-m-d", strtotime("first day of this month"));
    $dia2 = date("Y-m-d", strtotime("last day of this month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;


    

    break;

    case 8:

    $dia1 = date("Y-m-d", strtotime("first day of last month"));
    $dia2 = date("Y-m-d", strtotime("last day of last month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    

    break;

    case 9:

    $fecha1 = $fecha1 . ' 00:00:00';
    $fecha2 = $fecha2 . ' 23:59:59' ;

    


    break;
    
}

$traerVendedores = ControladorReportesVentas::ctrMostrarVendedores($fecha1, $fecha2, $id_sucursal);



echo '<table id="tablaReporteVentasDevolucionesVendedor" class="table table-bordered table-hover">
<thead>
<tr>
<th style="text-align: center;">NoVendedor</th>
<th style="text-align: center;">Vendedor</th>
<th style="text-align: right;">Importe Bruto</th>
<th style="text-align: right;">Impuesto</th>
<th style="text-align: right;">Importe</th>
<th style="text-align: right;">Bruto Devol</th>
<th style="text-align: right;">Impuesto Devol</th>
<th style="text-align: right;">Importe Devol</th>
<th style="text-align: right;">Gran Total</th>
</tr>
</thead>
<tbody>';

$total_devoluciones_acumulado = 0;

foreach ($traerVendedores as $key => $row) {

    $id_vendedor = $row['id_vendedor'];

    //echo $id_vendedor;


    $traerVentasVendedor = ControladorReportesVentas::ctrReporteVentasVendedor($fecha1, $fecha2, $id_vendedor, $id_sucursal);

    $traerDevolucionesVendedor = ControladorReportesDevoluciones::ctrReporteDevolucionesVendedor($fecha1, $fecha2, $id_vendedor, $id_sucursal);

    echo '<tr>
    <td style="text-align: center;">'.$id_vendedor.'</td>
    <td style="text-align: center;">'.$row["nombres"].'</td>';
    $total_ventas = 0;
    foreach ($traerVentasVendedor as $key2 => $row2) {

        $bruto2 = $row2["total_ventas"]/1.16;
        $impuesto2 = $row2["total_ventas"] - $bruto2;
        $total_ventas = $row2["total_ventas"];

        echo'<td style="text-align: right;">$'.number_format($bruto2,2).'</td>
        <td style="text-align: right;">$'.number_format($impuesto2,2).'</td>
        <td style="text-align: right;">$'.number_format($row2["total_ventas"],2).'</td>';
    }


    $total_devoluciones = 0;
    foreach ($traerDevolucionesVendedor as $key3 => $row3) {

        $bruto3 = $row3["total_devoluciones"]/1.16;
        $impuesto3 = $row3["total_devoluciones"] - $bruto3;
        $total_devoluciones = $row3["total_devoluciones"];

        echo'<td style="text-align: right;">$'.number_format($bruto3,2).'</td>
        <td style="text-align: right;">$'.number_format($impuesto3,2).'</td>
        <td style="text-align: right;">$'.number_format($row3["total_devoluciones"],2).'</td>';
    }

    $gran_total = $total_ventas - $total_devoluciones;
    echo'<td style="text-align: right;">$'.number_format($gran_total,2).'</td>
    </tr>';
}




echo '</tbody>
<tfoot>
<tr>
<th style="text-align: center;">NoVendedor</th>
<th style="text-align: center;">Vendedor</th>
<th style="text-align: right;">Importe Bruto</th>
<th style="text-align: right;">Impuesto</th>
<th style="text-align: right;">Importe</th>
<th style="text-align: right;">Bruto Devol</th>
<th style="text-align: right;">Impuesto Devol</th>
<th style="text-align: right;">Importe Devol</th>
<th style="text-align: right;">Gran Total</th>
</tr>
</tfoot>
</table>';






















?>