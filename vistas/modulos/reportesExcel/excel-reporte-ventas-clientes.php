<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "conexion.php";

$no_rango = $_GET['no_rango'];
$id_cliente = $_GET['id_cliente'];
$nombre_cliente = $_GET['nombre_cliente'];

if($no_rango == ""){
	return;
}

if(isset($_GET['rango_fecha'])){
        $rango_fecha = $_GET['rango_fecha'];
        $fecha1 = substr( $rango_fecha, 0, 10 );
        $fecha2 = substr( $rango_fecha, 13, 22 );
    }

    switch ($no_rango) {
    case 1:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, (VENTAS.BRUTO + VENTAS.IMPUESTO) AS TOTAL, SUCURSAL.NOMBRE, CLIENTES.NOMBRE AS NOMBRE_CLIENTE FROM (VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL) INNER JOIN CLIENTES ON VENTAS.IDCLIENTE = CLIENTES.IDCLIENTE WHERE Format( VENTAS.FECHA,'Short Date') = Date() AND VENTAS.COBRADA = true AND VENTAS.CANCELADA = false AND VENTAS.IDCLIENTE = $id_cliente";
        break;
    case 2:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, (VENTAS.BRUTO + VENTAS.IMPUESTO) AS TOTAL, SUCURSAL.NOMBRE, CLIENTES.NOMBRE AS NOMBRE_CLIENTE FROM (VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL) INNER JOIN CLIENTES ON VENTAS.IDCLIENTE = CLIENTES.IDCLIENTE WHERE Format( VENTAS.FECHA,'Short Date') = Date()-1 AND VENTAS.COBRADA = true AND VENTAS.CANCELADA = false AND VENTAS.IDCLIENTE = $id_cliente";
        break;
    case 3:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, (VENTAS.BRUTO + VENTAS.IMPUESTO) AS TOTAL, SUCURSAL.NOMBRE, CLIENTES.NOMBRE AS NOMBRE_CLIENTE FROM (VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL) INNER JOIN CLIENTES ON VENTAS.IDCLIENTE = CLIENTES.IDCLIENTE WHERE DATEDIFF('d',VENTAS.FECHA,now())<=6 AND VENTAS.COBRADA = true AND VENTAS.CANCELADA = false AND VENTAS.IDCLIENTE = $id_cliente";
        break;
        case 4:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, (VENTAS.BRUTO + VENTAS.IMPUESTO) AS TOTAL, SUCURSAL.NOMBRE, CLIENTES.NOMBRE AS NOMBRE_CLIENTE FROM (VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL) INNER JOIN CLIENTES ON VENTAS.IDCLIENTE = CLIENTES.IDCLIENTE WHERE DATEDIFF('d',VENTAS.FECHA,now())<=29 AND VENTAS.COBRADA = true AND VENTAS.CANCELADA = false AND VENTAS.IDCLIENTE = $id_cliente";
        break;
    case 5:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, (VENTAS.BRUTO + VENTAS.IMPUESTO) AS TOTAL, SUCURSAL.NOMBRE, CLIENTES.NOMBRE AS NOMBRE_CLIENTE FROM (VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL) INNER JOIN CLIENTES ON VENTAS.IDCLIENTE = CLIENTES.IDCLIENTE WHERE Year(VENTAS.FECHA) = Year(Now()) AND Month(VENTAS.FECHA) = Month(Now()) AND VENTAS.COBRADA = true AND VENTAS.CANCELADA = false AND VENTAS.IDCLIENTE = $id_cliente";
        break;
    case 6:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, (VENTAS.BRUTO + VENTAS.IMPUESTO) AS TOTAL, SUCURSAL.NOMBRE, CLIENTES.NOMBRE AS NOMBRE_CLIENTE FROM (VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL) INNER JOIN CLIENTES ON VENTAS.IDCLIENTE = CLIENTES.IDCLIENTE WHERE Year(VENTAS.FECHA)* 12 + DatePart('m', VENTAS.FECHA) = Year(Date())* 12 + DatePart('m', Date()) - 1 AND VENTAS.COBRADA = true AND VENTAS.CANCELADA = false AND VENTAS.IDCLIENTE = $id_cliente";
        break;

        case 7:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, (VENTAS.BRUTO + VENTAS.IMPUESTO) AS TOTAL, SUCURSAL.NOMBRE, CLIENTES.NOMBRE AS NOMBRE_CLIENTE FROM (VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL) INNER JOIN CLIENTES ON VENTAS.IDCLIENTE = CLIENTES.IDCLIENTE WHERE DateValue(Format(VENTAS.FECHA,'dd/mm/yyyy')) BETWEEN #$fecha1# AND #$fecha2# AND VENTAS.COBRADA = true AND VENTAS.CANCELADA = false AND VENTAS.IDCLIENTE = $id_cliente";

        break;
    
}
        

        $stmt = odbc_exec( $con, $sql );



			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'ventas del cliente'.$nombre_cliente.'.xls';

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
					<td style='font-weight:bold; border:1px solid #000000;'>ID VENTA</td> 
					<td style='font-weight:bold; border:1px solid #000000;'>FECHA</td>
					<td style='font-weight:bold; border:1px solid #000000;'>TIPO VENTA</td>
					<td style='font-weight:bold; border:1px solid #000000;'>TOTAL</td>
					<td style='font-weight:bold; border:1px solid #000000;'>SUCURSAL</td>
					</tr>");

/*$respuesta = odbc_fetch_array($stmt); 

var_dump($respuesta);*/

$total_acumulado = 0;

while ( $row = odbc_fetch_array($stmt) ) { 

$total = number_format($row[TOTAL],2);

$total_acumulado = $total_acumulado + $row[TOTAL];

			//foreach ($respuesta as $row => $item){

			 echo"<tr>
			 			<td style='border:1px solid #9B9B9B;'>$row[IDVENTA]</td> 
			 			<td style='border:1px solid #9B9B9B;'>$row[FECHA]</td>
			 			<td style='border:1px solid #9B9B9B;'>$row[IDTIPO]</td>
			 			<td style='border:1px solid #9B9B9B;'>$$total</td>
			 			<td style='border:1px solid #9B9B9B;'>$row[NOMBRE]</td></tr>";


			}

			$total_acumulado = number_format($total_acumulado,2);

			echo '<tr><td colspan="3";></td>
			<td style="font-weight:bold; border:1px solid #000000; text-align:right;"">TOTAL: $'.$total_acumulado.'</td></tr></table>';



?>
  

