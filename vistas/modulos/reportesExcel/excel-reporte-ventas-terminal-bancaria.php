<?php

//error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";
require_once "../../../controladores/reportes-ventas.controlador.php";
require_once "../../../modelos/reportes-generales.modelo.php";
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/terminales-bancarias.controlador.php";
require_once "../../../modelos/terminales-bancarias.modelo.php";
require_once "../../../controladores/vendedores.controlador.php";
require_once "../../../modelos/vendedores.modelo.php";

$no_rango = $_GET['no_rango'];
$id_terminal_bancaria = $_GET['id_terminal_bancaria'];

if($no_rango == "" || $id_terminal_bancaria == ""){
    return;
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
    $fecha2 = $dia2 . ' 23:59:59' ;

    break;


    case 8:

    $dia1 = date("Y-m-d", strtotime("first day of last month"));
    $dia2 = date("Y-m-d", strtotime("last day of last month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    break;


    case 9:

    $rango_fecha = $_GET['rango_fecha'];
    $mes1 = substr( $rango_fecha, 0, 2 );
    $dia1 = substr( $rango_fecha, 3, 2 );
    $ano1 = substr( $rango_fecha, 6, 4 );
    $fecha1 = $ano1 ."-". $mes1 ."-". $dia1;

    $mes2 = substr( $rango_fecha, 13, 2 );
    $dia2 = substr( $rango_fecha, 16, 2 );
    $ano2 = substr( $rango_fecha, 19, 4 );
    $fecha2 = $ano2 ."-". $mes2 ."-". $dia2;

    

    $fecha1 = $fecha1 . ' 00:00:00';
    $fecha2 = $fecha2 . ' 23:59:59' ;

    break;
    
}


$traerVentasTerminalBancaria = ControladorReportesVentas::ctrReporteVentasTerminalBancaria($fecha1, $fecha2, $id_terminal_bancaria);


//echo $traerVentasTerminalBancaria;



			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'reporte de ventas por terminal.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");


echo utf8_decode("<table border='0'> 


					<tr>
					<th style='font-weight:bold; border:1px solid #000000;'>Id venta</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Folio</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Fecha</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Tipo de venta</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Total</th>
					<th style='font-weight:bold; border:1px solid #000000;'>Cliente</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Vendedor</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Terminal Bancaria</th>
					</tr>");

$total_ventas_acumulado = 0;

foreach ($traerVentasTerminalBancaria as $key => $row) {

    $id_venta = $row['id'];

    $traerCliente = ControladorClientes::ctrMostrarCliente($row['id_cliente']);

    $traerVendedor = ControladorVendedores::ctrMostrarVendedor2($row['id_vendedor']);

     $traerTerminalBancaria = ControladorTerminalesBancarias::ctrMostrarTerminalBancaria($row['id_terminal_bancaria']);

    $total_ventas_acumulado = $total_ventas_acumulado + $row['total'];

			echo'<tr>
			 	<td style="border:1px solid #9B9B9B;">'.$id_venta.'</td> 
                <td style="border:1px solid #9B9B9B;">'.$row['folio'].'</td> 
			 	<td style="border:1px solid #9B9B9B;">'.$row['fecha_creacion'].'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$row['tipo_venta'].'</td>
			 	<td style="border:1px solid #9B9B9B;">$'.number_format($row["total"],2).'</td>
			 	<td style="border:1px solid #9B9B9B;">'.$traerCliente["nombre"].'</td>
                <td style="border:1px solid #9B9B9B;">'.$traerVendedor["nombres"].'</td>
                <td style="border:1px solid #9B9B9B;">'.$traerTerminalBancaria["terminal_bancaria"].'</td>
			</tr>';


			}

			


			echo '<tr><td colspan="4" style="font-weight:bold; border:1px solid #EEEEEE; text-align:right;">TOTAL</td>
			<td style="font-weight:bold; border:1px solid #000000;">$'.number_format($total_ventas_acumulado, 2).'</td></tr>';





            if($id_terminal_bancaria == 0){

                $traerResumenVentasTerminalBancaria = ControladorReportesVentas::ctrResumenReporteVentasTerminalBancaria($fecha1, $fecha2);


                echo '<tr></tr>
                <tr></tr>
                <tr><th style="font-weight:bold; border:1px solid #000000;">Vendedor</th>
                    <th style="font-weight:bold; border:1px solid #000000;">Terminal Bancaria</th></tr>';




                foreach ($traerResumenVentasTerminalBancaria as $key2 => $row2) {
                    echo'<tr>
                    <td style="border:1px solid #9B9B9B;">'.$row2['terminal_bancaria'].'</td> 
                    <td style="border:1px solid #9B9B9B;">$'.number_format($row2["total_ventas"],2).'</td>
                    </tr>';
                }


            }



?>
  
</table>
