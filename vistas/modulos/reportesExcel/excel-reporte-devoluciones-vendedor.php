
<?php

error_reporting(0);
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
require_once "../../../controladores/vendedores.controlador.php";
require_once "../../../modelos/vendedores.modelo.php";


$no_rango = $_GET['no_rango'];
$id_sucursal = 1;
//$nombre_sucursal = $_GET['nombre_sucursal'];
$id_vendedor = $_GET['id_vendedor'];
/*if($no_rango == "" || $id_sucursal == "" || $id_vendedor == ""){
    return;
}*/

$traeVendedor = ControladorVendedores::ctrMostrarVendedor2($id_vendedor);
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

$traerDevoluciones = ModeloDevoluciones::consultaReporteDevolucionesVendedor($id_vendedor, $id_sucursal, $fecha1, $fecha2);



            /*=============================================
            CREAMOS EL ARCHIVO DE EXCEL
            =============================================*/

            if($id_sucursal !== "0"){
                    $Name = 'Devoluciones por vendedor de '.$traeVendedor['nombres'].'.xls';
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


echo utf8_decode("<table border='0'> 

                    <tr> 
                    <th style='font-weight:bold; border:1px solid #000000;'>Id Devolución</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Fecha</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Totql</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Id Venta</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Folio</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Id Corte Caja</th>
                    
                    </tr>");

/*$row = odbc_fetch_array($stmt); 

var_dump($row);*/

$total_devoluciones_acumulado = 0;

foreach ($traerDevoluciones as $key2 => $row) {

    $traerVenta = ControladorVentas::ctrMostrarVenta($row['id_venta']);
    $total_devoluciones_acumulado = $total_devoluciones_acumulado + $row['total'];


            //foreach ($row as $row => $item){

             echo"<tr>
                        <td style='border:1px solid #9B9B9B;'>".$row["id_devolucion"]."</td>
                        <td style='border:1px solid #9B9B9B;'>".$row["fecha_creacion"]."</td>
                        <td style='border:1px solid #9B9B9B;'>$".number_format($row["total"],2)."</td>
                        <td style='border:1px solid #9B9B9B;'>".$row["id_venta"]."</td>
                        <td style='border:1px solid #9B9B9B;'>".$traerVenta["folio"]."</td>
                        <td style='border:1px solid #9B9B9B;'>".$row["id_corte_caja"]."</td>
            </tr>";




            }
     

echo '<tr><td colspan="3" style="font-weight:bold; border:1px solid #EEEEEE; text-align:right;">TOTAL</td>
            <td style="font-weight:bold; border:1px solid #000000;">$'.number_format($total_devoluciones_acumulado, 2).'</td></tr>';


?>
  

