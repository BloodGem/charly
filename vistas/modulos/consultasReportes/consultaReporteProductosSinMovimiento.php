<?php
//error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();


require_once "../../../controladores/reportes-productos.controlador.php";
require_once "../../../modelos/reportes-generales.modelo.php";


$no_meses = $_POST['no_meses'];
$id_sucursal = $_POST['id_sucursal'];

if($no_meses == "" || $id_sucursal == ""){
    return;
}

$fecha = date("Y-m-d",strtotime("-$no_meses Month"));


$traerProductosSinMovimiento = ControladorReportesProductos::ctrReporteProductosSinMovimiento($fecha, $id_sucursal);

//echo $traerProductosSinMovimiento;

echo '<table id="tablaReporteProductosSinMovimiento" class="table-sm table-bordered table-hover">
<thead>
<tr>
<th style="text-align: center;">Id</th>
<th style="text-align: center;">Clave</th>
<th style="text-align: center;">Producto</th>
<th style="text-align: right;">Existencia</th>
<th style="text-align: center;">Ubicación</th>
<th style="text-align: center;">Ult Venta</th>
<th style="text-align: center;">Ult Compra</th>
</tr>
</thead>
<tbody>';


foreach ($traerProductosSinMovimiento as $key => $row) {

    $id_producto = $row['id_producto'];


    echo '<tr>
    <td style="text-align: center;">'.$id_producto.'</td>
    <td style="text-align: center;">'.$row["clave_producto"].'</td>
    <td style="text-align: center;">'.$row["descripcion_corta"].'</td>
    <td style="text-align: right;">'.number_format($row["stock"], 2).'</td>
    <td style="text-align: center;">'.$row["ubicacion"].'</td>
    <td style="text-align: center;">'.$row["fecha_ult_venta"].'</td>
    <td style="text-align: center;">'.$row["fecha_ult_compra"].'</td>
    </tr>';
}


echo '</tbody>
<tfoot>
<tr>
<th style="text-align: center;">Id</th>
<th style="text-align: center;">Clave</th>
<th style="text-align: center;">Producto</th>
<th style="text-align: right;">Existencia</th>
<th style="text-align: center;">Ubicación</th>
<th style="text-align: center;">Ult Venta</th>
<th style="text-align: center;">Ult Compra</th>
</tr>
</tfoot>
</table>';



















    


?>