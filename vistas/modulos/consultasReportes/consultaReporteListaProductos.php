<?php
//error_reporting(0);
//date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion.php";


require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/reportes-productos.controlador.php";
require_once "../../../modelos/reportes-productos.modelo.php";





$id_sucursal = $_POST['id_sucursal'];

if($id_sucursal == ""){
    return;
}


$traerProductos = ControladorReportesProductos::ctrReporteProductosAnaqueles($id_sucursal, $anaquel);

echo '<table id="tablaReporteDeProductosPorAnaquel" class="table table-bordered table-hover">
<thead>
<tr>
<th style="text-align: center;">Clave</th>
<th style="text-align: center;">Producto</th>
<th style="text-align: center;">Ubicación</th>
<th style="text-align: right;">Existencia</th>
</tr>
</thead>
<tbody>';


foreach ($traerProductos as $key => $row) {

    echo '<tr>
    <td style="text-align: center;">'.$row["clave_producto"].'</td>
    <td style="text-align: center;">'.$row["descripcion_corta"].'</td>
    <td style="text-align: center;">'.$row["ubicacion"].'</td>
    <td style="text-align: right;">'.$row["stock"].'</td>
    </tr>';
}




echo '</tbody>
<tfoot>
<tr>
<th style="text-align: center;">Clave</th>
<th style="text-align: center;">Producto</th>
<th style="text-align: center;">Ubicación</th>
<th style="text-align: right;">Existencia</th>
</tr>
</tfoot>
</table>';



















    


?>