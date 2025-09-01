<?php
//error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion.php";


require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/devoluciones.controlador.php";
require_once "../../../modelos/devoluciones.modelo.php";





$no_rango = $_POST['no_rango'];
$id_usuario = $_POST['id_usuario'];
$id_sucursal = 1;

if($no_rango == "" || $id_sucursal == "" || $id_usuario == ""){
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

/*var_dump($id_usuario);
echo "<br>";
var_dump($id_sucursal);
echo "<br>";
var_dump($fecha1);
echo "<br>";
var_dump($fecha2);
echo "<br>";*/


$traerDevoluciones = ModeloDevoluciones::consultaReporteDevolucionesCajero($id_usuario, $id_sucursal, $fecha1, $fecha2);

//var_dump($traerDevoluciones);

echo '<table id="tablaReporteDevolucionesCajero" class="table table-bordered table-hover">
<thead>
<tr>
<th style="text-align: center;">IdDevol.</th>
<th style="text-align: center;">Fecha</th>
<th style="text-align: right;">Total</th>
<th style="text-align: center;">IdVenta</th>
<th style="text-align: center;">Folio</th>
<th style="text-align: center;">IdCorteCaja</th>
</tr>
</thead>
<tbody>';

$total_devoluciones_acumulado = 0;

foreach ($traerDevoluciones as $key2 => $row) {
    
    //$traerCliente = ControladorClientes::ctrMostrarCliente($row['id_cliente']);

    $traerVenta = ControladorVentas::ctrMostrarVenta($row['id_venta']);


    /*$traerCreador = ControladorUsuarios::ctrMostrarUsuario($row['id_usuario_creador']);


    $traerCorteCaja = ControladorCajas::ctrMostrarCorteCaja($row['id_corte_caja']);

    $traerMotivoDevolucion = ControladorOtros::ctrMostrarMotivoDevolucion($row['id_motivo_devolucion']);*/

    $total_devoluciones_acumulado = $total_devoluciones_acumulado + $row['total'];



                        //$traerSucursal = ControladorSucursales::ctrMostrarSucursal($row['id_sucursal']);

    echo '<tr>
    <td style="text-align: center;">'.$row["id_devolucion"].'</td>
    <td style="text-align: center;">'.$row["fecha_creacion"].'</td>
    <td style="text-align: right;">$'.number_format($row["total"],2).'</td>
    <td style="text-align: center;">'.$row["id_venta"].'</td>
    <td style="text-align: center;">'.$traerVenta["folio"].'</td>
    <td style="text-align: center;">'.$row["id_corte_caja"].'</td>
    </tr>';
}




echo '</tbody>
<tfoot>
<tr>
<th style="text-align: center;">IdDevol.</th>
<th style="text-align: center;">Fecha</th>
<th style="text-align: right;">Total</th>
<th style="text-align: center;">IdVenta</th>
<th style="text-align: center;">Folio</th>
<th style="text-align: center;">IdCorteCaja</th>
</tr>
</tfoot>
</table><br><br>
                <center><h3>Total Devoluciones: $'.number_format($total_devoluciones_acumulado, 2).'</h3></center>';



















    


?>