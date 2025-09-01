
<?php

//error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/reportes-compras.controlador.php";
require_once "../../../modelos/reportes-generales.modelo.php";



$no_rango = $_GET['no_rango'];
$id_sucursal = $_GET['id_sucursal'];
$tipo = $_GET['tipo'];

/*if($no_rango == "" || $id_sucursal == "" || $tipo == ""){
    return;
}*/


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





$traerCompras = ControladorReportesCompras::ctrReporteComprasTipo($fecha1, $fecha2, $tipo, $id_sucursal);








			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

            if($id_sucursal !== "0"){
                    $Name = 'Compras de tipo factura.xls';
                }else{
                    $Name = 'Compras de tipo factura.xls';
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




/*$row = odbc_fetch_array($stmt); 

var_dump($row);*/





	echo utf8_decode("<table border='0'> 

                    <tr> 
                    <th style='font-weight:bold; border:1px solid #000000;'>No. Compra</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Fecha</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>No. Factura</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Proveedor</th>
                    <th style='font-weight:bold; border:1px solid #000000;'>Total</th>
                    </tr>");

    $total_compras_acumulado = 0;

    foreach ($traerCompras as $key2 => $row) { 

        $traerProveedor = ControladorProveedores::ctrMostrarProveedor($row['id_proveedor']);

        $total_compras_acumulado = $total_compras_acumulado + $row['total'];

			 echo"<tr>
			 			<td style='border:1px solid #9B9B9B;'>".$row['id']."</td> 
			 			<td style='border:1px solid #9B9B9B;'>".$row['fecha_creacion']."</td>
                        <td style='border:1px solid #9B9B9B;'>".$row['no_factura']."</td>
                        <td style='border:1px solid #9B9B9B;'>".$traerProveedor['nombre']."</td>
			 			<td style='border:1px solid #9B9B9B; text-align: right;'>$".number_format($row['total'], 2)."</td>
            </tr>";


}

echo '<tr> 
					<th colspan="4" style="font-weight:bold; border:1px solid #000000; text-align: right;">TOTAL</th>
					<th style="font-weight:bold; border:1px solid #000000; text-align: right;">$'.number_format($total_compras_acumulado, 2).'</th>
					</tr>';

			
     



?>
  

