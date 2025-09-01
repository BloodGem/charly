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
require_once "../../../controladores/reportes-devoluciones.controlador.php";
require_once "../../../modelos/reportes-generales.modelo.php";



$no_rango = $_GET['no_rango'];
$id_sucursal = $_GET['id_sucursal'];
$nombre_sucursal = $_GET['nombre_sucursal'];
$tipo = $_GET['tipo'];

if($no_rango == "" || $id_sucursal == "" || $tipo == ""){
    return;
}


if(isset($_GET['rango_fecha'])){
    $rango_fecha = $_GET['rango_fecha'];
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

$traerDevoluciones = ControladorReportesDevoluciones::ctrMostrarDevolucionesTipo($fecha1, $fecha2, $tipo, $id_sucursal);

//echo $sql;




			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

            if($id_sucursal !== "0"){
                    $Name = 'Devoluciones de tipo '.$tipo.'.xls';
                }else{
                    $Name = 'Devoluciones de tipo '.$tipo.' de sucursales en general '.date('d-m-Y').'.xls';
                }


			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");


echo utf8_decode("<table border='0'> <tr>
                        <td style='border:1px solid #9B9B9B;'>No. Devolución</td>
                        <td style='border:1px solid #9B9B9B;'>No. Venta</td>
                        <td style='border:1px solid #9B9B9B;'>Folio Venta</td>  
                        <td style='border:1px solid #9B9B9B;'>Fecha</td>
                        <td style='border:1px solid #9B9B9B;'>Total</td>
                        <td style='border:1px solid #9B9B9B;'>Cliente</td>
                        
            </tr>");

/*$row = odbc_fetch_array($stmt); 

var_dump($row);*/

$total_devoluciones_acumulado = 0;

foreach ($traerDevoluciones as $key => $row) {

    $id_devolucion = $row['id_devolucion'];

    $traerCliente = ControladorClientes::ctrMostrarCliente($row['id_cliente']);

    $total_devoluciones_acumulado = $total_devoluciones_acumulado + $row['total'];



			 echo"<tr>
			 			<td style='border:1px solid #9B9B9B;'>".$id_devolucion."</td>
                        <td style='border:1px solid #9B9B9B;'>".$row["id_venta"]."</td>
                        <td style='border:1px solid #9B9B9B;'>".$row['folio']."</td> 
			 			<td style='border:1px solid #9B9B9B;'>".$row['fecha_creacion']."</td>
                        <td style='border:1px solid #9B9B9B;'>$".number_format($row['total'], 2)."</td>
                        <td style='border:1px solid #9B9B9B;'>".$traerCliente['nombre']."</td>
                        
            </tr>";




			}
     

echo '<tr><td colspan="4" style="font-weight:bold; border:1px solid #EEEEEE; text-align:right;">TOTALES</td>
            <td style="font-weight:bold; border:1px solid #000000;">$'.number_format($total_devoluciones_acumulado, 2).'</td></tr>';


?>
  

