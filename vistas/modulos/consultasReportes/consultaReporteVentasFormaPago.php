<?php
//error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";


$forma_pago = $_POST['forma_pago'];
$no_rango = $_POST['no_rango'];
$id_sucursal = $_POST['id_sucursal'];

if($no_rango == "" || $forma_pago == "" || $id_sucursal == ""){
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



if($id_sucursal !== "0"){
                    $sql_id_sucursal = " AND ventas.id_sucursal = $id_sucursal";
                }else{
                  $sql_id_sucursal = "";  
                }



if($forma_pago !== "0"){
    switch ($forma_pago) {

        case 1:
            $sql_forma_pago = " AND efectivo != 0";
        break;
        case 2:
            $sql_forma_pago = " AND tarjeta_debito != 0";
        break;
        case 3:
            $sql_forma_pago = " AND tarjeta_credito != 0";
        break;
        case 4:
            $sql_forma_pago = " AND transferencia != 0";
        break;
    }
        
    }else{
        $sql_forma_pago = "";
    }




$sql = "SELECT * FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 $sql_id_sucursal $sql_forma_pago ORDER BY ventas.id DESC";

//echo $sql;

$rs = $conexion->query($sql);
    


echo '<table id="tablaReporteVentasFormaPago" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th style="text-align: center;">Id</th>
                    <th style="text-align: center;">Folio</th>
                    <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Tipo V</th>
                    <th style="text-align: right;">Total</th>
                    <th style="text-align: right;">Dinero</th>
                    <th style="text-align: right;">Efectivo</th>
                    <th style="text-align: right;">Débito</th>
                    <th style="text-align: right;">Crédito</th>
                    <th style="text-align: right;">Transferencia</th>
                    <th style="text-align: center;">Cliente</th>
                  </tr>
                  </thead>
                  <tbody>';





    $total_efectivo = 0;
    $total_tarjeta_credito = 0;
    $total_tarjeta_debito = 0;
    $total_transferencia = 0;

    $total_acumulado = 0;
        
    while($row = $rs->fetch_array(MYSQLI_BOTH)){

        $total_acumulado = $total_acumulado + $row['total'];

        $total_efectivo = $total_efectivo + $row['efectivo'];
            
        $total_tarjeta_credito = $total_tarjeta_credito + $row['tarjeta_credito'];
       
        $total_tarjeta_debito = $total_tarjeta_debito + $row['tarjeta_debito'];

        $total_transferencia = $total_transferencia + $row['transferencia'];
             
       

        $traerCliente = ControladorClientes::ctrMostrarCliente($row['id_cliente']);

        
        echo'<tr>
                                            <td style="text-align: center;">
                                                     '.$row['id'].'   
                                            </td>
                                            <td style="text-align: center;">
                                                     '.$row['folio'].'   
                                            </td>
                                            <td style="text-align: center;">
                                                        '.$row['fecha_creacion'].'
                                            </td>
                                            <td style="text-align: center;">
                                                        '.$row['tipo_venta'].'
                                            </td>
                                            <td style="text-align: right;">
                                                        $'.number_format($row['total'], 2).'
                                            </td>
                                            <td style="text-align: right;">
                                                        $'.number_format($row['dinero'], 2).'
                                            </td>
                                            <td style="text-align: right;">
                                                        $'.number_format($row['efectivo'], 2).'
                                            </td>
                                            <td style="text-align: right;">
                                                        $'.number_format($row['tarjeta_debito'], 2).'
                                            </td>
                                            <td style="text-align: right;">
                                                        $'.number_format($row['tarjeta_credito'], 2).'
                                            </td>
                                            <td style="text-align: right;">
                                                        $'.number_format($row['transferencia'], 2).'
                                            </td>
                                            <td style="text-align: center;">
                                                        '.$traerCliente['nombre'].'
                                                    
                                            </td>
                                            </tr>';
    }
    

    $total_formas_acumulado = ($total_efectivo + $total_tarjeta_credito + $total_tarjeta_debito + $total_transferencia);
                  
                 
                  echo '</tbody>
                  <tfoot>
                  <tr>
                    <th style="text-align: center;">Id</th>
                    <th style="text-align: center;">Folio</th>
                    <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Tipo V</th>
                    <th style="text-align: right;">Total</th>
                    <th style="text-align: right;">Dinero</th>
                    <th style="text-align: right;">Efectivo</th>
                    <th style="text-align: right;">Débito</th>
                    <th style="text-align: right;">Crédito</th>
                    <th style="text-align: right;">Transferencia</th>
                    <th style="text-align: center;">Cliente</th>
                  </tr>
                  </tfoot>
                </table>

                <br><br>

                <center><h3>Ventas Total: $'.number_format($total_acumulado, 2).'</h3></center>

                <br><br>

                <table class="table table-sm table-bordered table-hover">
                    <tr>
                        <th style="text-align: center;">Método Pago</th>
                        <th style = "text-align: right;">Total Métodos</th>
                    </tr>
                    <tr>
                        <td style="text-align: center;">Efectivo</td>
                        <td style = "text-align: right;">$'.number_format($total_efectivo, 2).'</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">Tarjeta Crédito</td>
                        <td style = "text-align: right;">$'.number_format($total_tarjeta_credito, 2).'</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">Tarjeta Débito</td>
                        <td style = "text-align: right;">$'.number_format($total_tarjeta_debito, 2).'</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">Transferencia</td>
                        <td style = "text-align: right;">$'.number_format($total_transferencia, 2).'</td>
                    </tr>
                    
                </table>';





        
            
            
    
        
       
        ?>