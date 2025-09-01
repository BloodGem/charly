<?php
//error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/reportes-ventas.controlador.php";
require_once "../../../modelos/reportes-generales.modelo.php";



$fecha1 = $_POST['fecha1'];
$fecha2 = $_POST['fecha2'];
$id_sucursal = $_POST['id_sucursal'];


if($fecha1 == "" || $fecha2 == "" || $id_sucursal == ""){
    return;
}




    $fecha1 = $fecha1 . ' 00:00:00';
    $fecha2 = $fecha2 . ' 23:59:59';


$traerVentasProductos = ControladorReportesVentas::ctrReportesVentasProductos($fecha1, $fecha2, $id_sucursal);

//echo $traerVentasProductos;




echo '<table id="tablaReporteVentasProductos" class="table table-bordered table-hover">
<thead>
<tr>
<th style="text-align: center;">Clave producto</th>
<th style="text-align: center;">Descripción</th>
<th style="text-align: right;">Cantidad</th>
<th style="text-align: right;">Ventas</th>
<th style="text-align: right;">Utilidad</th>
</tr>
</thead>
<tbody>';

$total_ventas_acumulado = 0;
//$total_utilidad_acumulado = 0;

foreach ($traerVentasProductos as $key => $row) {

    $total_ventas_acumulado = $total_ventas_acumulado + $row['total_ventas'];


    echo '<tr>
    <td style="text-align: center;">'.$row["clave_producto"].'</td>
    <td style="text-align: center;">'.$row["descripcion_corta"].'</td>
    <td style="text-align: right;">'.$row["cantidad_vendida"].'</td>
    <td style="text-align: right;">'.number_format($row['total_ventas'], 2).'</td>
    <td style="text-align: right;">$'.number_format($row['total_utilidad'], 2).'</td>
    </tr>';
}


echo '</tbody>
<tfoot>
<tr>
<th style="text-align: center;">Clave producto</th>
<th style="text-align: center;">Descripción</th>
<th style="text-align: right;">Cantidad</th>
<th style="text-align: right;">Ventas</th>
<th style="text-align: right;">Utilidad</th>
</tr>
</tfoot>
</table><br><br>
                <center><h3>Ventas total: $'.number_format($total_ventas_acumulado, 2).'</h3></center>';



















    


?>