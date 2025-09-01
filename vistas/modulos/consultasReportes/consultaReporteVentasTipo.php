<?php
error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/vendedores.controlador.php";
require_once "../../../modelos/vendedores.modelo.php";



$no_rango = $_POST['no_rango'];
$id_sucursal = $_POST['id_sucursal'];
$tipo = $_POST['tipo'];

if($no_rango == "" || $id_sucursal == "" || $tipo == ""){
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

if($id_sucursal !== "0"){
    $sql_id_sucursal = " AND ventas.id_sucursal = ".$id_sucursal;
}else{
    $sql_id_sucursal = "";
}




switch ($no_rango) {

    case 1:

    $dia = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59' ;

    //$fecha1 = date("Y/m/d", strtotime("today"));
    //$fecha2 = date("Y/m/d", strtotime("today"));





    $sql = "SELECT * FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.tipo_venta = '$tipo'".$sql_id_sucursal." ORDER BY ventas.id DESC";

    break;

    case 2:

    $dia = date("Y-m-d", strtotime("yesterday"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59' ;





    $sql = "SELECT * FROM ventas WHERE Date(fecha_creacion) BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.tipo_venta = '$tipo'".$sql_id_sucursal." ORDER BY ventas.id DESC";
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


    $sql = "SELECT * FROM ventas WHERE Date(fecha_creacion) BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.tipo_venta = '$tipo'".$sql_id_sucursal." ORDER BY ventas.id DESC";

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

    $sql = "SELECT * FROM ventas WHERE Date(fecha_creacion) BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.tipo_venta = '$tipo'".$sql_id_sucursal." ORDER BY ventas.id DESC";

    break;

    case 5:
    $dia1 = date("Y-m-d", strtotime("today - 6 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    $sql = "SELECT * FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.tipo_venta = '$tipo'".$sql_id_sucursal." ORDER BY ventas.id DESC";
    break;

    case 6:
    $dia1 = date("Y-m-d", strtotime("today - 29 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    $sql = "SELECT * FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.tipo_venta = '$tipo'".$sql_id_sucursal." ORDER BY ventas.id DESC";

    break;

    case 7:

    $dia1 = date("Y-m-d", strtotime("first day of this month"));
    $dia2 = date("Y-m-d", strtotime("last day of this month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;


    $sql = "SELECT * FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.tipo_venta = '$tipo'".$sql_id_sucursal." ORDER BY ventas.id DESC";

    break;

    case 8:

    $dia1 = date("Y-m-d", strtotime("first day of last month"));
    $dia2 = date("Y-m-d", strtotime("last day of last month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    $sql = "SELECT * FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.tipo_venta = '$tipo'".$sql_id_sucursal." ORDER BY ventas.id DESC";

    break;

    case 9:

    $fecha1 = $fecha1 . ' 00:00:00';
    $fecha2 = $fecha2 . ' 23:59:59' ;

    $sql = "SELECT * FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.tipo_venta = '$tipo'".$sql_id_sucursal." ORDER BY ventas.id DESC";


    break;
    
}

//echo $sql;

$rs = $conexion->query($sql);



    //Recogemos las claves enviadas



echo '<table id="tablaReporteVentasTipo" class="table table-bordered table-hover">
<thead>
<tr>
<th style="text-align: center;">Id</th>
<th style="text-align: center;">Folio</th>
<th style="text-align: center;">Fecha</th>
<th style="text-align: right;">Total</th>
<th style="text-align: center;">UUID</th>
<th style="text-align: center;">Cliente</th>
<th style="text-align: center;">RFC</th>
<th style="text-align: center;">Vendedor</th>
<th style="text-align: center;">Acciones</th>
</tr>
</thead>
<tbody>';

$total_ventas_acumulado = 0;
//$total_utilidad_acumulado = 0;

while($row = $rs->fetch_array(MYSQLI_BOTH)){

    $id_venta = $row['id'];

    $traerCliente = ControladorClientes::ctrMostrarCliente($row['id_cliente']);

    $traerVendedor = ControladorVendedores::ctrMostrarVendedor2($row['id_vendedor']);

    $total_ventas_acumulado = $total_ventas_acumulado + $row['total'];




    /*$sql2 = "SELECT productos.id_producto, productos.clave_producto, Sum(partvta.cantidad) AS cantidad_vendida, Sum(partvta.cantidad * partvta.precio_neto) AS total_ventas, Sum(partvta.cantidad*partvta.precio_compra) AS total_precio_compra, (Sum(partvta.cantidad * partvta.precio_neto)-Sum(partvta.cantidad*partvta.precio_compra)) AS total_utilidad FROM ventas INNER JOIN (partvta INNER JOIN productos ON partvta.id_producto = productos.id_producto) ON ventas.id = partvta.id_venta WHERE ventas.id = $id_venta GROUP BY productos.id_producto, productos.clave_producto";

        //echo $sql2;

    $rs2 = $conexion->query($sql2);  

    $utilidad_venta = 0;

    while($row2 = $rs2->fetch_array(MYSQLI_BOTH)){  

        $utilidad_venta = $utilidad_venta + $row2['total_utilidad'];
    }

    $total_utilidad_acumulado = $total_utilidad_acumulado + $utilidad_venta;*/

                        //$traerSucursal = ControladorSucursales::ctrMostrarSucursal($row['id_sucursal']);

    echo '<tr>
    <td style="text-align: center;">'.$row["id"].'</td>
    <td style="text-align: center;">'.$row["folio"].'</td>
    <td style="text-align: center;">'.$row["fecha_creacion"].'</td>
    <td style="text-align: right;">$'.number_format($row["total"],2).'</td>
    <td style="text-align: center;">'.$row["uuid"].'</td>
    <td style="text-align: center;">'.$traerCliente["nombre"].'</td>
    <td style="text-align: center;">'.$traerCliente["rfc"].'</td>
    <td style="text-align: center;">'.$traerVendedor["nombres"].'</td>';

    if($row['tipo_venta'] == "FC"){
        if($row['uuid'] !== "" && $row['uuid'] !== null){
            echo '<td style="text-align: center;">
                <div class="btn-group">
            <button class="btn-sm btn-warning btnDescargarXML" id_venta = '.$row['id'].' rfc = '.$traerCliente['rfc'].'>XML</button> 

            <button class="btn-sm btn-danger btnDescargarPDF" id_venta = '.$row['id'].' rfc = '.$traerCliente['rfc'].'>PDF</button> 
            </div>
            </td>';
        }else{
            echo '<td style="text-align: center;">No esta timbrada</td>';
        }

    }else{
        echo '<td style="text-align: center;">No aplica</td>';
    }

    echo '</tr>';
}


echo '</tbody>
<tfoot>
<tr>
<th style="text-align: center;">Id</th>
<th style="text-align: center;">Folio</th>
<th style="text-align: center;">Fecha</th>
<th style="text-align: right;">Total</th>
<th style="text-align: center;">UUID</th>
<th style="text-align: center;">Cliente</th>
<th style="text-align: center;">RFC</th>
<th style="text-align: center;">Vendedor</th>
<th style="text-align: center;">Acciones</th>
</tr>
</tfoot>
</table><br><br>
<center><h3>Ventas total: $'.number_format($total_ventas_acumulado, 2).'</h3></center>';











?>