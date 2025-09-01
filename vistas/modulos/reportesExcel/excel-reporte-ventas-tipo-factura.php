
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



$no_rango = $_GET['no_rango'];
$id_sucursal = $_GET['id_sucursal'];
$nombre_sucursal = $_GET['nombre_sucursal'];
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

$sql = "SELECT DATE(fecha_creacion) AS dia, SUM(ventas.total) AS total_ventas FROM ventas WHERE fecha_creacion BETWEEN '".$fecha1."' AND '".$fecha2."'".$sql_id_sucursal." AND pagada = 1 AND cancelada = 0 AND tipo_venta = 'FC' GROUP BY DATE(fecha_creacion)";


$rs = $conexion->query($sql);




			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

            if($id_sucursal !== "0"){
                    $Name = 'Ventas de tipo factura.xls';
                }/*else{
                    $Name = 'Ventas de tipo '.$tipo.' de sucursales en general '.date('d-m-Y').'.xls';
                }*/


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



while($row = $rs->fetch_array(MYSQLI_BOTH)){

	echo utf8_decode("<table border='0'> 

					<tr> 
					<th colspan='9' style='font-weight:bold; border:1px solid #000000; background-color: #0087ff;'>FACTURADO ".$row['dia']."</th>
					</tr>");



    $sql2 = "SELECT id, folio, fecha_creacion, uuid, id_cliente, total FROM `ventas` WHERE fecha_creacion BETWEEN '".$row['dia']." 00:00:00' AND '".$row['dia']." 23:59:59'".$sql_id_sucursal." AND pagada = 1 AND cancelada = 0 AND tipo_venta = 'FC'";


        $rs2 = $conexion->query($sql2);  


    while($row2 = $rs2->fetch_array(MYSQLI_BOTH)){  

        $traerCliente = ControladorClientes::ctrMostrarCliente($row2['id_cliente']);

        $subtotal = round(($row2['total'] / 1.16), 2);

		$iva = round($subtotal * 0.16, 2);

			//foreach ($row as $row => $item){

			 echo"<tr>
			 			<td style='border:1px solid #9B9B9B;'>".$row2['id']."</td>
                        <td style='border:1px solid #9B9B9B;'>".$row2['folio']."</td>  
			 			<td style='border:1px solid #9B9B9B;'>".$row2['fecha_creacion']."</td>
                        <td style='border:1px solid #9B9B9B;'>".$row2['uuid']."</td>
                        <td style='border:1px solid #9B9B9B;'>".$traerCliente['nombre']."</td>
                        <td style='border:1px solid #9B9B9B;'>".$traerCliente['rfc']."</td>
			 			<td style='border:1px solid #9B9B9B; text-align: right;'>$".number_format($subtotal, 2)."</td>
			 			<td style='border:1px solid #9B9B9B; text-align: right;'>$".number_format($iva, 2)."</td>
			 			<td style='border:1px solid #9B9B9B; text-align: right;'>$".number_format($row2['total'], 2)."</td>
            </tr>";


}

echo '<tr> 
					<th colspan="7" style="font-weight:bold; border:1px solid #000000; text-align: right;">TOTAL</th>
					<th style="font-weight:bold; border:1px solid #000000; text-align: right;">$'.number_format($row['total_ventas'], 2).'</th>
					</tr>';

			}
     



?>
  

