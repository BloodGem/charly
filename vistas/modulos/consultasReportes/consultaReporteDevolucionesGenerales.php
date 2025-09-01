<?php
error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/cajas.controlador.php";
require_once "../../../modelos/cajas.modelo.php";
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/otros.controlador.php";
require_once "../../../modelos/otros.modelo.php";
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";
require_once "../../../controladores/vendedores.controlador.php";
require_once "../../../modelos/vendedores.modelo.php";



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





    $sql = "SELECT * FROM devoluciones WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND devoluciones.id_sucursal = $id_sucursal ORDER BY devoluciones.id_devolucion DESC";

    break;

    case 2:

    $dia = date("Y-m-d", strtotime("yesterday"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59' ;





    $sql = "SELECT * FROM devoluciones WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND devoluciones.id_sucursal = $id_sucursal ORDER BY devoluciones.id_devolucion DESC";
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


    $sql = "SELECT * FROM devoluciones WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND devoluciones.id_sucursal = $id_sucursal ORDER BY devoluciones.id_devolucion DESC";

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

    $sql = "SELECT * FROM devoluciones WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND devoluciones.id_sucursal = $id_sucursal ORDER BY devoluciones.id_devolucion DESC";

    break;

    case 5:
    $dia1 = date("Y-m-d", strtotime("today - 6 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    $sql = "SELECT * FROM devoluciones WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND devoluciones.id_sucursal = $id_sucursal ORDER BY devoluciones.id_devolucion DESC";
    break;

    case 6:
    $dia1 = date("Y-m-d", strtotime("today - 29 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    $sql = "SELECT * FROM devoluciones WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND devoluciones.id_sucursal = $id_sucursal ORDER BY devoluciones.id_devolucion DESC";

    break;

    case 7:

    $dia1 = date("Y-m-d", strtotime("first day of this month"));
    $dia2 = date("Y-m-d", strtotime("last day of this month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;


    $sql = "SELECT * FROM devoluciones WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND devoluciones.id_sucursal = $id_sucursal ORDER BY devoluciones.id_devolucion DESC";

    break;

    case 8:

    $dia1 = date("Y-m-d", strtotime("first day of last month"));
    $dia2 = date("Y-m-d", strtotime("last day of last month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    $sql = "SELECT * FROM devoluciones WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND devoluciones.id_sucursal = $id_sucursal ORDER BY devoluciones.id_devolucion DESC";

    break;

    case 9:

    $fecha1 = $fecha1 . ' 00:00:00';
    $fecha2 = $fecha2 . ' 23:59:59' ;

    $sql = "SELECT * FROM devoluciones WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND devoluciones.id_sucursal = $id_sucursal ORDER BY devoluciones.id_devolucion DESC";


    break;
    
}

//echo $sql;

$rs = $conexion->query($sql);                         
    //Recogemos las claves enviadas



echo '<table id="tablaReporteDevolucionesGenerales" class="table table-bordered table-hover">
<thead>
<tr>
<th style="text-align: center;">Id</th>
<th style="text-align: center;">Fecha</th>
<th style="text-align: right;">Total</th>
<th style="text-align: center;">Motivo</th>
<th style="text-align: center;">Cliente</th>
<th style="text-align: center;">Creador</th>
<th style="text-align: center;">IdVenta</th>
<th style="text-align: center;">Folio</th>
<th style="text-align: center;">Vendedor</th>
<th style="text-align: center;">Caja</th>
</tr>
</thead>
<tbody>';

$total_ventas_acumulado = 0;

while($row = $rs->fetch_array(MYSQLI_BOTH)){
    
    $traerCliente = ControladorClientes::ctrMostrarCliente($row['id_cliente']);

    $traerVenta = ControladorVentas::ctrMostrarVenta($row['id_venta']);

    $traerVendedor = ControladorVendedores::ctrMostrarVendedor2($traerVenta['id_vendedor']);

    $traerCreador = ControladorUsuarios::ctrMostrarUsuario($row['id_usuario_creador']);


    $traerCorteCaja = ControladorCajas::ctrMostrarCorteCaja($row['id_corte_caja']);

    $traerMotivoDevolucion = ControladorOtros::ctrMostrarMotivoDevolucion($row['id_motivo_devolucion']);

    $total_ventas_acumulado = $total_ventas_acumulado + $row['total'];



                        //$traerSucursal = ControladorSucursales::ctrMostrarSucursal($row['id_sucursal']);

    echo '<tr>
    <td style="text-align: center;">'.$row["id_devolucion"].'</td>
    <td style="text-align: center;">'.$row["fecha_creacion"].'</td>
    <td style="text-align: right;">$'.number_format($row["total"],2).'</td>
    <td style="text-align: center;">'.$traerMotivoDevolucion["motivo_devolucion"].'</td>
    <td style="text-align: center;">'.$traerCliente["nombre"].'</td>
    <td style="text-align: center;">'.$traerCreador["nombre"].'</td>
    <td style="text-align: center;">'.$row["id_venta"].'</td>
    <td style="text-align: center;">'.$traerVenta["folio"].'</td>
    <td style="text-align: center;">'.$traerVendedor["nombres"].'</td>
    <td style="text-align: center;">'.$row["id_corte_caja"].'</td>
    </tr>';
}




echo '</tbody>
<tfoot>
<tr>
<th style="text-align: center;">Id</th>
<th style="text-align: center;">Fecha</th>
<th style="text-align: right;">Total</th>
<th style="text-align: center;">Motivo</th>
<th style="text-align: center;">Cliente</th>
<th style="text-align: center;">Creador</th>
<th style="text-align: center;">IdVenta</th>
<th style="text-align: center;">Folio</th>
<th style="text-align: center;">Vendedor</th>
<th style="text-align: center;">Caja</th>

</tr>
</tfoot>
</table><br><br>
                <center><h3>Total Devoluciones: $'.number_format($total_ventas_acumulado, 2).'</h3></center>';



















    


?>